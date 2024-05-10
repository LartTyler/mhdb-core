<?php
	namespace App\Game;

	enum DamageKind: string {
		case Severing = 'severing';
		case Blunt = 'blunt';
		case Projectile = 'projectile';
	}
