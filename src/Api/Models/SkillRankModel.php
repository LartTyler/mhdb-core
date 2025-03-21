<?php
	namespace App\Api\Models;

	use App\Entity\Skill;
	use DaybreakStudios\RestBundle\Payload\Intent;
	use Symfony\Component\Validator\Constraints as Assert;

	class SkillRankModel {
		#[Assert\NotNull(groups: [Intent::CREATE])]
		#[Assert\IsNull(groups: [Intent::UPDATE])]
		public Skill $skill;

		#[Assert\NotNull(groups: [Intent::CREATE])]
		public int $level;

		#[Assert\NotBlank(allowNull: true)]
		public string $description;
	}
