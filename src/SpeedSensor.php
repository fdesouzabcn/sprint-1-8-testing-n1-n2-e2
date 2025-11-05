<?php
declare(strict_types=1);

namespace SpeedSensor;

class SpeedSensor
{
    public function checkSpeed(int $speed): string
    {
        return match (true) {
            $speed > 100 => 'SEVERE_EXCESS',
            $speed >= 81 => 'MODERATE_EXCESS',
            $speed >= 61 => 'SLIGHT_EXCESS',
            $speed >= 30 => 'APPROPRIATE',
            default => 'SLOW',
        };
    }
}