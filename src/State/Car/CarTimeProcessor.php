<?php

namespace App\State\Car;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Dto\Car\CarTimeResponseDto;
use App\Dto\Car\CarTimeDto;
use App\Service\Car\CarTimeHandler;

/**
 * @implements ProcessorInterface<CarTimeDto, CarTimeResponseDto>
 */
final class CarTimeProcessor implements ProcessorInterface
{
    public function __construct(private CarTimeHandler $carTimeHandler)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): CarTimeResponseDto
    {
        return $this->carTimeHandler->calculateTime($data);
    }
}
