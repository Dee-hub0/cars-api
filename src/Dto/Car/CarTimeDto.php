<?php

namespace App\Dto\Car;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CarTimeDto
{
    #[Groups(['car:read', 'car:write'])]
    #[Assert\NotBlank]
    public string $model;

    #[Groups(['car:read', 'car:write'])]
    #[Assert\NotBlank]
    public float $distance;
}
