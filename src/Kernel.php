<?php
	namespace App;

	use App\Api\AsCrudEntity;
	use App\Api\EntityLocator;
	use App\Api\GenericCrudController;
	use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
	use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
	use Symfony\Component\DependencyInjection\ContainerBuilder;
	use Symfony\Component\DependencyInjection\Definition;
	use Symfony\Component\DependencyInjection\Reference;
	use Symfony\Component\HttpKernel\Kernel as BaseKernel;

	class Kernel extends BaseKernel implements CompilerPassInterface {
		use MicroKernelTrait;

		public function process(ContainerBuilder $container): void {
			$container->addObjectResource(GenericCrudController::class);

			$locator = new EntityLocator($this->getProjectDir() . '/src/Entity');

			foreach ($locator as $class) {
				$attr = AsCrudEntity::getInstance($class);

				if (!$attr)
					continue;

				$def = (new Definition(GenericCrudController::class))
					->addMethodCall('setEntity', [$class])
					->addMethodCall('setDtoClass', [$attr->dtoClass])
					->addMethodCall('setProtectedRouteRole', [$attr->firewallRole])
					->addMethodCall('setAllowedCrudMethods', [$attr->methods])
					->addMethodCall('setStrict', [$attr->strict])
					->addTag('controller.service_arguments')
					->addTag('container.service_subscriber')
					->setPublic(true)
					->setAutoconfigured(true)
					->setAutowired(true);

				if ($transformer = $attr->transformer)
					$def->addMethodCall('setTransformer', [new Reference($transformer)]);

				$container->setDefinition(AsCrudEntity::getEntityControllerName($class), $def);
				$container->addObjectResource($class);
			}
		}
	}
