<?php
	namespace App\Controller;

	use App\Api\Models\LocationModel;
	use App\Api\Transformers\LocationTransformer;
	use App\Entity\Location;
	use DaybreakStudios\Rest\Controller\AbstractApiController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;

	#[Route(path: '/locations', name: 'locations.')]
	class LocationController extends AbstractApiController {
		#[Route(name: 'list', methods: [Request::METHOD_GET])]
		public function list(): Response {
			return $this->doList(Location::class);
		}

		#[Route(name: 'create', methods: [Request::METHOD_PUT])]
		public function create(LocationTransformer $transformer): Response {
			return $this->doCreate(LocationModel::class, $transformer);
		}

		#[Route(path: '/{location<\d+>}', methods: [Request::METHOD_GET])]
		public function read(Location $location): Response {
			return $this->respond($location);
		}

		#[Route(path: '/{location<\d+>}', methods: [Request::METHOD_PATCH])]
		public function update(Location $location, LocationTransformer $transformer): Response {
			return $this->doUpdate(LocationModel::class, $location, $transformer);
		}
	}
