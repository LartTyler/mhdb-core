<?php
	namespace App\Entity;

	use App\Api\AsCrudEntity;
	use App\Api\Models\CampModel;
	use App\Api\Transformers\CampTransformer;
	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\ORM\Mapping as ORM;
	use Gedmo\Mapping\Annotation\Translatable;

	#[ORM\Entity]
	#[ORM\Table(name: 'camps')]
	#[AsCrudEntity(
		basePath: '/locations/camps',
		transformer: CampTransformer::class,
		dtoClass: CampModel::class,
		strict: [
			'location' => [
				'camps',
			],
		]
	)]
	class Camp implements EntityInterface {
		use EntityTrait;

		#[ORM\ManyToOne(targetEntity: Location::class, inversedBy: 'camps')]
		#[ORM\JoinColumn(onDelete: 'CASCADE')]
		private Location $location;

		#[Translatable]
		#[ORM\Column(nullable: true)]
		private ?string $name;

		#[ORM\Column(options: ['unsigned' => true])]
		private int $zone;

		public function __construct(Location $location, string $name, int $zone) {
			$this->name = $name;
			$this->location = $location;
			$this->zone = $zone;
		}

		public function getLocation(): Location {
			return $this->location;
		}

		public function getName(): ?string {
			return $this->name;
		}

		public function setName(?string $name): static {
			$this->name = $name;
			return $this;
		}

		public function getZone(): int {
			return $this->zone;
		}

		public function setZone(int $zone): static {
			$this->zone = $zone;
			return $this;
		}
	}
