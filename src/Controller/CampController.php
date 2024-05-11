<?php
	namespace App\Controller;

	use App\Api\Models\CampModel;
	use App\Api\Transformers\CampTransformer;
	use App\Entity\Camp;
	use DaybreakStudios\Rest\Controller\AbstractApiController;
	use DaybreakStudios\Rest\Serializer\ObjectNormalizerContextBuilder;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;
	use Symfony\Component\Serializer\Context\ContextBuilderInterface;

	#[Route(path: '/camps', name: 'camps.')]
	class CampController extends AbstractApiController {
		#[Route(name: 'list', methods: [Request::METHOD_GET])]
		public function list(): Response {
			return $this->doList(Camp::class);
		}

		#[Route(name: 'create', methods: [Request::METHOD_PUT])]
		public function create(CampTransformer $transformer): Response {
			return $this->doCreate(CampModel::class, $transformer);
		}

		#[Route(path: '/{camp<\d+>}', name: 'read', methods: [Request::METHOD_GET])]
		public function read(Camp $camp): Response {
			return $this->respond($camp);
		}

		#[Route(path: '/{camp<\d+>}', name: 'update', methods: [Request::METHOD_PATCH])]
		public function update(Camp $camp, CampTransformer $transformer): Response {
			return $this->doUpdate(CampModel::class, $camp, $transformer);
		}

		#[Route(path: '/{camp<\d+>}', name: 'delete', methods: [Request::METHOD_DELETE])]
		public function delete(Camp $camp, CampTransformer $transformer): Response {
			return $this->doDelete($camp, $transformer);
		}

		protected function createSerializerContext(): ContextBuilderInterface|array {
			return (new ObjectNormalizerContextBuilder())
				->withStrict(
					[
						'location' => [
							'*',
							'-id',
							'-name',
						],
					],
				);
		}
	}
