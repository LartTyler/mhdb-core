<?php
	namespace App\Game;

	enum Deviation: string {
		case None = 'none';
		case Low = 'low';
		case Average = 'average';
		case High = 'high';
	}
