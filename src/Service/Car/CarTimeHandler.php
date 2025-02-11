<?php

namespace App\Service\Car;

use App\Entity\Car;
use App\Dto\Car\CarTimeDto;
use App\Dto\Car\CarTimeResponseDto;
use Doctrine\ORM\EntityManagerInterface;

class CarTimeHandler
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function calculateTime(CarTimeDto $data): CarTimeResponseDto
    {
        $distance = $data->distance;
        $model = $data->model;
        $time = null;
        
        if (!$distance || !$model) {
            // A parameter missing error.
            return new CarTimeResponseDto($time , 'Distance and model are required.', 400);
        }

        $car = $this->entityManager->getRepository(Car::class)->findOneBy(['model' => $model]);
        if (!$car) {
            return new CarTimeResponseDto($time, 'Car not found.', 404);
        }

        $speed = $car->getKmPerHour();
        if ($speed == 0) {
            // Car not found error
            return new CarTimeResponseDto($time, 'The car’s speed cannot be zero.', 400);
        }

        $timeInHours = $distance / $speed;
        // Convert time to minutes
        $time = $timeInHours * 60;

        // Return the calculated time with a success message
        return new CarTimeResponseDto($time, 'The car’s time was calculated successfully.', 200);
        
    }
}
