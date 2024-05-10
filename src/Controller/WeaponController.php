<?php
	namespace App\Controller;

	use App\Entity\Weapon;
	use DaybreakStudios\Rest\Controller\AbstractApiController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;

	#[Route(path: '/weapons', name: 'weapons.')]
	class WeaponController extends AbstractApiController {
		#[Route(name: 'list', methods: [Request::METHOD_GET])]
		public function list(): Response {
			return $this->doList(Weapon::class);
		}

		#[Route(path: '/{weapon<\d+>}', name: 'read', methods: [Request::METHOD_GET])]
		public function read(Weapon $weapon): Response {
			return $this->respond($weapon);
		}
	}
