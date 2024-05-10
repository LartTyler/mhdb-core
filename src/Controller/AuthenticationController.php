<?php
	namespace App\Controller;

	use App\Security\FirewallRole;
	use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Attribute\Route;
	use Symfony\Component\Security\Http\Attribute\IsGranted;

	class AuthenticationController extends AbstractController {
		#[IsGranted(FirewallRole::USER)]
		#[Route(path: '/auth/refresh', methods: [Request::METHOD_GET])]
		public function refresh(JWTTokenManagerInterface $tokenManager): Response {
			$user = $this->getUser();
			assert($user !== null);

			return new JsonResponse(
				[
					'token' => $tokenManager->create($user),
				],
			);
		}
	}
