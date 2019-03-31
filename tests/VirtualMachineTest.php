<?php

namespace OzanAkman\ServerPlanner\Tests;

use OzanAkman\ServerPlanner\Resources;
use OzanAkman\ServerPlanner\VirtualMachine;
use PHPUnit\Framework\TestCase;

class VirtualMachineTest extends TestCase
{
    public function testGetResources()
    {
        $resources = $this->createMock(Resources::class);
        $subject = new VirtualMachine($resources);

        $this->assertSame($resources, $subject->getResources());
    }
}
