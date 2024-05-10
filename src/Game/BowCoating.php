<?php
	namespace App\Game;

	enum BowCoating: string {
		case CloseRange = 'close-range';
		case Power = 'power';
		case Paralysis = 'paralysis';
		case Poison = 'poison';
		case Sleep = 'sleep';
		case Blast = 'blast';
	}
