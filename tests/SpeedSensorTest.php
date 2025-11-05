<?php
declare(strict_types=1);

namespace SpeedSensor\Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use SpeedSensor\SpeedSensor;

class SpeedSensorTest extends TestCase
{
    private SpeedSensor $sensor;
    
    protected function setUp(): void
    {
        $this->sensor = new SpeedSensor();
    }
    
    #[DataProvider('speedCategoryProvider')] // attribute syntax (new PHP 8+ Style)

    public function testSpeedCategories(int $speed, string $expectedCategory): void
    {
        $result = $this->sensor->checkSpeed($speed);
        
        $this->assertEquals(
            $expectedCategory, 
            $result,
            "Speed {$speed} km/h should be '{$expectedCategory}'"
        );
    }
    
    public static function speedCategoryProvider(): array
    {
        return [

            [10, 'SLOW'],
            [29, 'SLOW'],
            [30, 'APPROPRIATE'],
            [60, 'APPROPRIATE'],
            [61, 'SLIGHT_EXCESS'],
            [80, 'SLIGHT_EXCESS'],
            [81, 'MODERATE_EXCESS'],
            [100, 'MODERATE_EXCESS'],
            [101, 'SEVERE_EXCESS'],
            [200, 'SEVERE_EXCESS'],
        ];
    }
    
    #[DataProvider('boundaryValueProvider')] 

    public function testBoundaryValues(int $speed, string $expectedCategory): void
    {
        $result = $this->sensor->checkSpeed($speed);
        
        $this->assertEquals(
            $expectedCategory,
            $result,
            "Boundary value {$speed} km/h failed"
        );
    }
    
    public static function boundaryValueProvider(): array
    {
        return [
            'boundary_29_slow' => [29, 'SLOW'],
            'boundary_30_appropriate' => [30, 'APPROPRIATE'],
            'boundary_60_appropriate' => [60, 'APPROPRIATE'],
            'boundary_61_slight' => [61, 'SLIGHT_EXCESS'],
            'boundary_80_slight' => [80, 'SLIGHT_EXCESS'],
            'boundary_81_moderate' => [81, 'MODERATE_EXCESS'],
            'boundary_100_moderate' => [100, 'MODERATE_EXCESS'],
            'boundary_101_severe' => [101, 'SEVERE_EXCESS'],
        ];
    }
}