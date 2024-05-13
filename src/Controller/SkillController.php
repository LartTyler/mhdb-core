<?php
	namespace App\Controller;

	use App\Api\Models\SkillModel;
	use App\Api\Transformers\SkillTransformer;
	use App\Entity\Skill;
	use App\Security\FirewallRole;
	use DaybreakStudios\Rest\Controller\AbstractApiController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;
	use Symfony\Component\Security\Http\Attribute\IsGranted;

	#[Route(path: '/skills', name: 'skills.')]
	class SkillController extends AbstractApiController {
		#[Route(name: 'list', methods: Request::METHOD_GET)]
		public function list(): Response {
			return $this->doList(Skill::class);
		}

		#[IsGranted(FirewallRole::USER)]
		#[Route(name: 'create', methods: Request::METHOD_PUT)]
		public function create(SkillTransformer $transformer): Response {
			return $this->doCreate(SkillModel::class, $transformer);
		}

		#[Route(path: '/{skill<\d+>}', name: 'read', methods: Request::METHOD_GET)]
		public function read(Skill $skill): Response {
			return $this->respond($skill);
		}

		#[IsGranted(FirewallRole::USER)]
		#[Route(path: '/{skill<\d+>}', name: 'update', methods: Request::METHOD_PATCH)]
		public function update(Skill $skill, SkillTransformer $transformer): Response {
			return $this->doUpdate(SkillModel::class, $skill, $transformer);
		}

		#[IsGranted(FirewallRole::USER)]
		#[Route(path: '/{skill<\d+>}', name: 'delete', methods: Request::METHOD_DELETE)]
		public function delete(Skill $skill, SkillTransformer $transformer): Response {
			return $this->doDelete($skill, $transformer);
		}
	}
