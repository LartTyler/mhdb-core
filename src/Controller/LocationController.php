<?php
	namespace App\Controller;

	use App\Api\Models\LocationModel;
	use App\Api\Transformers\LocationTransformer;
	use App\Entity\Location;
	use App\Security\FirewallRole;
	use DaybreakStudios\Rest\Controller\AbstractApiController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;
	use Symfony\Component\Security\Http\Attribute\IsGranted;

	#[Route(path: '/locations', name: 'locations.')]
	class LocationController extends AbstractApiController {
		#[Route(name: 'list', methods: [Request::METHOD_GET])]
		public function list(): Response {
			return $this->doList(Location::class);
		}

		#[IsGranted(FirewallRole::USER)]
		#[Route(name: 'create', methods: [Request::METHOD_PUT])]
		public function create(LocationTransformer $transformer): Response {
			return $this->doCreate(LocationModel::class, $transformer);
		}

		#[Route(path: '/{location<\d+>}', name: 'read', methods: [Request::METHOD_GET])]
		public function read(Location $location): Response {
			return $this->respond($location);
		}

		#[IsGranted(FirewallRole::USER)]
		#[Route(path: '/{location<\d+>}', name: 'update', methods: [Request::METHOD_PATCH])]
		public function update(Location $location, LocationTransformer $transformer): Response {
			return $this->doUpdate(LocationModel::class, $location, $transformer);
		}

		#[IsGranted(FirewallRole::USER)]
		#[Route(path: '/{location<\d+>}', name: 'delete', methods: Request::METHOD_DELETE)]
		public function delete(Location $location, LocationTransformer $transformer): Response {
			return $this->doDelete($location, $transformer);
		}
	}
