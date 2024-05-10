<?php
	namespace App\Game;

	enum Status: string {
		case Poison = 'poison';
		case Paralysis = 'paralysis';
		case Sleep = 'sleep';
		case Blastblight = 'blastblight';
	}
