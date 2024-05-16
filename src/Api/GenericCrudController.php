<?php
	namespace App\Api;

	use App\Security\FirewallRole;
	use DaybreakStudios\RestBundle\Controller\AbstractApiController;
	use DaybreakStudios\RestBundle\Serializer\ObjectNormalizerContextBuilder;
	use DaybreakStudios\RestBundle\Transformer\TransformerInterface;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Serializer\Context\ContextBuilderInterface;

	class GenericCrudController extends AbstractApiController {
		protected ?string $entity = null;
		protected ?string $dtoClass = null;
		protected string $protectedRouteRole = FirewallRole::USER;
		protected array $allowedCrudMethods = [];
		protected ?TransformerInterface $transformer = null;
		protected ?array $strict = null;

		public function setEntity(string $entity): static {
			$this->entity = $entity;
			return $this;
		}

		public function setDtoClass(?string $dtoClass): static {
			$this->dtoClass = $dtoClass;
			return $this;
		}

		public function setProtectedRouteRole(string $protectedRouteRole): static {
			$this->protectedRouteRole = $protectedRouteRole;
			return $this;
		}

		public function setAllowedCrudMethods(array $allowedCrudMethods): static {
			$this->allowedCrudMethods = array_flip($allowedCrudMethods);
			return $this;
		}

		public function setTransformer(TransformerInterface $transformer): static {
			$this->transformer = $transformer;
			return $this;
		}

		public function setStrict(?array $strict): static {
			$this->strict = $strict;
			return $this;
		}

		public function list(): Response {
			assert($this->check(AsCrudEntity::METHOD_LIST));
			return $this->doList($this->entity);
		}

		public function create(): Response {
			assert($this->check(AsCrudEntity::METHOD_CREATE));

			$this->denyAccessUnlessGranted($this->protectedRouteRole);
			return $this->doCreate($this->dtoClass, $this->transformer);
		}

		public function read(int $entity): Response {
			assert($this->check(AsCrudEntity::METHOD_READ));
			return $this->respond($this->findEntityOrThrow($entity));
		}

		public function update(int $entity): Response {
			assert($this->check(AsCrudEntity::METHOD_UPDATE));
			return $this->doUpdate($this->dtoClass, $this->findEntityOrThrow($entity), $this->transformer);
		}

		public function delete(int $entity): Response {
			assert($this->check(AsCrudEntity::METHOD_DELETE));
			return $this->doDelete($this->findEntityOrThrow($entity), $this->transformer);
		}

		protected function findEntityOrThrow(int $id): EntityInterface {
			$entity = $this->entityManager->find($this->entity, $id);
			return $entity ?? throw $this->createNotFoundException();
		}

		protected function check(string $method): bool {
			assert($this->entity !== null, static::class . ' was registered without calling setEntity()');

			assert(
				!$this->allowedCrudMethods || isset($this->allowedCrudMethods[$method]),
				$this->entity . ' is not configured to support the ' . $method . ' action',
			);

			switch ($method) {
				case AsCrudEntity::METHOD_CREATE:
				case AsCrudEntity::METHOD_UPDATE:
					$msg = 'Set the "transformer" and "dtoClass" properties on AsCrudEntity to create ' . $this->entity;

					assert($this->transformer !== null, $msg);
					assert($this->dtoClass !== null, $msg);

					break;

				case AsCrudEntity::METHOD_DELETE:
					assert(
						$this->transformer !== null,
						'Set the "transformer" property on AsCrudEntity to delete ' . $this->entity,
					);

					break;
			}

			return true;
		}

		protected function createSerializerContext(): ContextBuilderInterface|array {
			$context = (new ObjectNormalizerContextBuilder())->withContext(parent::createSerializerContext());

			if ($this->strict !== null)
				$context = $context->withStrict($this->strict);

			return $context;
		}
	}
