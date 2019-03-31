<?php

namespace OzanAkman\ServerPlanner\Tests;

use Exception;
use OzanAkman\ServerPlanner\Calculator;
use OzanAkman\ServerPlanner\Resources;
use OzanAkman\ServerPlanner\ServerType;
use OzanAkman\ServerPlanner\VirtualMachine;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param ServerType $serverType
     * @param array $virtualMachines
     * @param int $expectedResult
     * @throws Exception
     */
    public function testCalculate(ServerType $serverType, array $virtualMachines, int $expectedResult)
    {
        $subject = new Calculator();
        $this->assertEquals($expectedResult, $subject->calculate($serverType, $virtualMachines));
    }

    public function dataProvider()
    {
        return [
            [
                new ServerType(new Resources(100, 200, 300)),
                [
                    new VirtualMachine(new Resources(50, 50, 50)),
                    new VirtualMachine(new Resources(50, 50, 50))
                ],
                1
            ],
            [
                new ServerType(new Resources(2, 32, 100)),
                [
                    new VirtualMachine(new Resources(1, 16, 10)),
                    new VirtualMachine(new Resources(1, 16, 10)),
                    new VirtualMachine(new Resources(2, 32, 100))
                ],
                2
            ],
            [
                new ServerType(new Resources(4, 64, 200)),
                [
                    new VirtualMachine(new Resources(2, 32, 10)),
                    new VirtualMachine(new Resources(3, 16, 100)),
                    new VirtualMachine(new Resources(2, 32, 100))
                ],
                3
            ]
        ];
    }
}
