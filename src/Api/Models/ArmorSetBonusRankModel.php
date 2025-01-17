<?php
	namespace App\Api\Models;

	use App\Entity\SkillRank;
	use Symfony\Component\Validator\Constraints as Assert;

	class ArmorSetBonusRankModel {
		#[Assert\NotNull]
		public int $pieces;

		#[Assert\NotNull]
		public SkillRank $skill;
	}