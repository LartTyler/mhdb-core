<?php
	namespace App\Controller;

	use App\Entity\Camp;
	use DaybreakStudios\Rest\Controller\AbstractApiController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;

	#[Route(path: '/camps', name: 'camps.')]
	class CampController extends AbstractApiController {
		#[Route(name: 'list', methods: [Request::METHOD_GET])]
		public function list(): Response {
			return $this->doList(Camp::class);
		}

		#[Route(path: '/{camp<\d+>}', methods: [Request::METHOD_GET])]
		public function read(Camp $camp): Response {
			return $this->respond($camp);
		}
	}
