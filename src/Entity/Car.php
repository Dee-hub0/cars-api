<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CarRepository;
use App\Dto\Car\CarTimeResponseDto;
use App\Dto\Car\CarTimeDto;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\State\Car\CarTimeProcessor;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Put(),
        new Post(),
        new Delete(),
        new Patch(),
        new Post(
            uriTemplate: '/cars/calculate-time',
            input: CarTimeDto::class,
            output: CarTimeResponseDto::class,
            processor: CarTimeProcessor::class,
        ),
    ],
    normalizationContext: ['groups' => ['car:read']],
    denormalizationContext: ['groups' => ['car:write']],
)]
#[ApiFilter(SearchFilter::class, properties: ['model' => 'exact'])]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['car:read'])]
    private int $id;

    #[ORM\Column(length: 50, unique: true)]
    #[Groups(['car:read', 'car:write'])]
    private ?string $model = null;

    #[ORM\Column]
    #[Groups(['car:read', 'car:write'])]
    private ?int $kmPerHour = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['car:read', 'car:write'])]
    private ?array $features = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getKmPerHour(): ?int
    {
        return $this->kmPerHour;
    }

    public function setKmPerHour(int $kmPerHour): static
    {
        $this->kmPerHour = $kmPerHour;

        return $this;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function setFeatures(?array $features): static
    {
        $this->features = $features;

        return $this;
    }
}
