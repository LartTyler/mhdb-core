<?php
	use App\Api\AsCrudEntity;
	use App\Api\EntityLocator;
	use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

	return static function (RoutingConfigurator $configurator): void {
		$locator = new EntityLocator(__DIR__ . '/../../src/Entity');

		// If you change this, make sure you also change the same list in /config/routes.yaml
		$routes = $configurator->collection()
			->prefix(
				[
					'en' => '',
					'fr' => '/fr',
					'de' => '/de',
					'zh' => '/zh',
					'zh-Hant' => '/zh-Hant',
				],
			)
			->defaults(['_format' => 'json']);

		foreach ($locator as $class) {
			$attr = AsCrudEntity::getInstance($class);

			if (!$attr)
				continue;

			$namePrefix = AsCrudEntity::getEntityPrefix($class);
			$controller = AsCrudEntity::getEntityControllerName($class);

			if ($attr->isList()) {
				$routes->add($namePrefix . '.list', $attr->basePath . '.{_format}')
					->methods(['GET'])
					->controller([$controller, 'list']);
			}

			if ($attr->isCreate()) {
				$routes->add($namePrefix . '.create', $attr->basePath . '.{_format}')
					->methods(['PUT'])
					->controller([$controller, 'create']);
			}

			$pathWithParam = $attr->basePath . '/{entity<\d+>}';

			if ($attr->isRead()) {
				$routes->add($namePrefix . '.read', $pathWithParam . '.{_format}')
					->methods(['GET'])
					->controller([$controller, 'read']);
			}

			if ($attr->isUpdate()) {
				$routes->add($namePrefix . '.update', $pathWithParam . '.{_format}')
					->methods(['PATCH'])
					->controller([$controller, 'update']);
			}

			if ($attr->isDelete()) {
				$routes->add($namePrefix . '.delete', $pathWithParam .'.{_format}')
					->methods(['DELETE'])
					->controller([$controller, 'delete']);
			}
		}
	};
