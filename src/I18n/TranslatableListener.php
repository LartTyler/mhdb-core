<?php
	namespace App\I18n;

	use Gedmo\Translatable\TranslatableListener as Base;
	use Symfony\Component\HttpFoundation\RequestStack;

	class TranslatableListener extends Base {
		public function __construct(RequestStack $requestStack) {
			parent::__construct();
			$this->locale = $requestStack->getCurrentRequest()->getLocale();
		}

		protected function getNamespace(): string {
			return 'Gedmo\\Translatable';
		}
	}
