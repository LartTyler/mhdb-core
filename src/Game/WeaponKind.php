<?php
	namespace App\Game;

	enum WeaponKind: string {
		case GreatSword = 'great-sword';
		case SwordAndShield = 'sword-shield';
		case DualBlades = 'dual-blades';
		case LongSword = 'long-sword';
		case Hammer = 'hammer';
		case HuntingHorn = 'hunting-horn';
		case Lance = 'lance';
		case Gunlance = 'gunlance';
		case SwitchAxe = 'switch-axe';
		case ChargeBlade = 'charge-blade';
		case InsectGlaive = 'insect-glaive';
		case Bow = 'bow';
		case HeavyBowgun = 'heavy-bowgun';
		case LightBowgun = 'light-bowgun';
	}
