<?php
declare(strict_types=1);

namespace SpeedSensor\Tests;

use PHPUnit\Framework\TestCase;
use SpeedSensor\SpeedSensor;

class SpeedSensorGreenTest extends TestCase
{
    private SpeedSensor $sensor;
    
    protected function setUp(): void
    {
        $this->sensor = new SpeedSensor();
    }
    
    public function testVerySlowSpeed(): void
    {
        $this->assertEquals('SLOW', $this->sensor->checkSpeed(10));
        $this->assertEquals('SLOW', $this->sensor->checkSpeed(29));
    }
    
    public function testAppropriateSpeed(): void
    {
        $this->assertEquals('APPROPRIATE', $this->sensor->checkSpeed(30));
        $this->assertEquals('APPROPRIATE', $this->sensor->checkSpeed(60));
    }
    
    public function testSlightExcess(): void
    {
        $this->assertEquals('SLIGHT_EXCESS', $this->sensor->checkSpeed(61));
        $this->assertEquals('SLIGHT_EXCESS', $this->sensor->checkSpeed(80));
    }
    
    public function testModerateExcess(): void
    {
        $this->assertEquals('MODERATE_EXCESS', $this->sensor->checkSpeed(81));
        $this->assertEquals('MODERATE_EXCESS', $this->sensor->checkSpeed(100));
    }
    
    public function testSevereExcess(): void
    {
        $this->assertEquals('SEVERE_EXCESS', $this->sensor->checkSpeed(101));
        $this->assertEquals('SEVERE_EXCESS', $this->sensor->checkSpeed(200));
    }
}