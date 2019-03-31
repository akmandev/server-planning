<?php

namespace OzanAkman\ServerPlanner\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use OzanAkman\ServerPlanner\Calculator;
use OzanAkman\ServerPlanner\Resources;
use OzanAkman\ServerPlanner\ServerType;
use OzanAkman\ServerPlanner\VirtualMachine;

class CalculatorTest extends TestCase
{
    /**
     * @var Calculator
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new Calculator();
    }


    /**
     * @dataProvider calculateDataProvider
     * @param ServerType $serverType
     * @param array $virtualMachines
     * @param int $expectedResult
     * @throws Exception
     */
    public function testCalculate(ServerType $serverType, array $virtualMachines, int $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->subject->calculate($serverType, $virtualMachines));
    }

    public function calculateDataProvider()
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

    public function testCalculateThrowsExceptionWhenVirtualMachinesResourcesHigherThanServerType()
    {
        $serverType = new ServerType(new Resources(2, 16, 50));
        $virtualMachines = [
            new VirtualMachine(new Resources(2, 32, 10)),
        ];

        $this->expectException(Exception::class);
        $this->subject->calculate($serverType, $virtualMachines);
    }
}
