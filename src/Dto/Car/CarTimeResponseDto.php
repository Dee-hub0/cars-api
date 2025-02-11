<?php

namespace App\Dto\Car;

use Symfony\Component\Serializer\Annotation\Groups;

class CarTimeResponseDto
{

    #[Groups(['car:read'])]
    public ?float $time = null;

    #[Groups(['car:read'])]
    public string $message;

    #[Groups(['car:read'])]
    public int $httpCode;

    public function __construct(?float $time, string $message, int $httpCode)
    {
        $this->time = $time;
        $this->message = $message;
        $this->httpCode = $httpCode;
    }
}
