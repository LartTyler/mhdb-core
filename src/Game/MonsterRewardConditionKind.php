<?php
	namespace App\Game;

	enum MonsterRewardConditionKind: string {
		case Carve = 'carve';
		case Investigation = 'investigation';
		case Mining = 'mining';
		case Palico = 'palico';
		case Reward = 'reward';
		case Shiny = 'shiny';
		case Track = 'track';
		case Wound = 'wound';
	}
