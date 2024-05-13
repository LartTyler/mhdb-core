<?php
	namespace App\Controller;

	use App\Api\Models\SkillRankModel;
	use App\Api\Transformers\SkillRankTransformer;
	use App\Entity\SkillRank;
	use DaybreakStudios\Rest\Controller\AbstractApiController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;

	#[Route(path: '/skills/ranks', name: 'skills.ranks.')]
	class SkillRankController extends AbstractApiController {
		#[Route(name: 'list', methods: Request::METHOD_GET)]
		public function list(): Response {
			return $this->doList(SkillRank::class);
		}

		#[Route(name: 'create', methods: Request::METHOD_PUT)]
		public function create(SkillRankTransformer $transformer): Response {
			return $this->doCreate(SkillRankModel::class, $transformer);
		}

		#[Route(path: '/{rank<\d+>}', name: 'read', methods: Request::METHOD_GET)]
		public function read(SkillRank $rank): Response {
			return $this->respond($rank);
		}
	}
