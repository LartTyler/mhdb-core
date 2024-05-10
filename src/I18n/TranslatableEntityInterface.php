<?php
	namespace App\I18n;

	use Gedmo\Translatable\Translatable;

	interface TranslatableEntityInterface extends Translatable {
		public function setTranslatableLocale(string $locale): static;
	}
