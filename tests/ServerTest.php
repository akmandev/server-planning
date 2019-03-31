<?php

namespace OzanAkman\ServerPlanner\Tests;

use OzanAkman\ServerPlanner\Resources;
use OzanAkman\ServerPlanner\Server;
use OzanAkman\ServerPlanner\ServerType;
use OzanAkman\ServerPlanner\VirtualMachine;
use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase
{
    /**
     * @var Server
     */
    private $subject;

    public function setUp()
    {
        $resources = new Resources(100, 200, 300);
        $serverType = new ServerType($resources);

        $this->subject = new Server($serverType);
    }

    /**
     * @dataProvider canFitProvider
     * @param VirtualMachine $virtualMachine
     * @param bool $expectedResult
     */
    public function testCanFit(VirtualMachine $virtualMachine, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->subject->canFit($virtualMachine));
    }

    public function canFitProvider()
    {
        return [
            [new VirtualMachine(new Resources(50, 50, 50)), true],
            [new VirtualMachine(new Resources(100, 200, 300)), true],
            [new VirtualMachine(new Resources(200, 200, 300)), false],
            [new VirtualMachine(new Resources(100, 2000, 300)), false],
            [new VirtualMachine(new Resources(100, 50, 3000)), false],
        ];
    }

    public function testAddVirtualMachineThrowsExceptionIfVmIsTooLargeToFit()
    {
        $vm = new VirtualMachine(new Resources(100, 50, 3000));
        $this->expectException(\LogicException::class);
        $this->subject->addVirtualMachine($vm);
    }

    /**
     * @dataProvider addVirtualMachineProvider
     * @param VirtualMachine $virtualMachine
     * @param Resources $remainingResources
     */
    public function testAddVirtualMachineReducesResourcesOfServer(
        VirtualMachine $virtualMachine,
        Resources $remainingResources
    ) {
        $this->subject->addVirtualMachine($virtualMachine);
        $this->assertEquals($remainingResources, $this->subject->getCurrentResources());
    }

    public function addVirtualMachineProvider()
    {
        return [
            [new VirtualMachine(new Resources(50, 50, 50)), new Resources(50, 150, 250)],
            [new VirtualMachine(new Resources(100, 200, 300)), new Resources(0, 0, 0)]
        ];
    }

    /**
     * @dataProvider addVirtualMachineStackProvider
     * @param array $virtualMachines
     * @param Resources $remainingResources
     */
    public function testAddVirtualMachinesWithStackOfVirtualMachines(
        array $virtualMachines,
        Resources $remainingResources
    ) {
        foreach ($virtualMachines as $virtualMachine) {
            $this->subject->addVirtualMachine($virtualMachine);
        }
        $this->assertEquals($remainingResources, $this->subject->getCurrentResources());
    }

    public function addVirtualMachineStackProvider()
    {
        return [
            [
                [
                    new VirtualMachine(new Resources(50, 50, 50)),
                    new VirtualMachine(new Resources(20, 20, 20)),
                ],
                new Resources(30, 130, 230)
            ],
            [
                [
                    new VirtualMachine(new Resources(75, 55, 35)),
                    new VirtualMachine(new Resources(20, 20, 20)),
                ],
                new Resources(5, 125, 245)
            ]
        ];
    }
}
