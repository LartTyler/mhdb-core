<?php
	namespace App;

	use App\Import\AsImporter;
	use App\Import\ImporterInterface;
	use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
	use Symfony\Component\DependencyInjection\ChildDefinition;
	use Symfony\Component\DependencyInjection\ContainerBuilder;
	use Symfony\Component\HttpKernel\Kernel as BaseKernel;

	class Kernel extends BaseKernel {
		use MicroKernelTrait;

		protected function build(ContainerBuilder $container): void {
			$container->registerForAutoconfiguration(ImporterInterface::class)
				->addTag(AsImporter::TAG);

			$container->registerAttributeForAutoconfiguration(
				AsImporter::class,
				static function(ChildDefinition $definition, AsImporter $attribute): void {
					$definition->addTag($attribute::TAG, ['priority' => $attribute->priority]);
				},
			);
		}
	}
