<?php
	namespace App\Security;

	final class FirewallRole {
		public const ADMIN = 'ROLE_ADMIN';
		public const USER = 'ROLE_USER';

		private function __construct() {}
	}
