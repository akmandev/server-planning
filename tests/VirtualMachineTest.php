<?php

namespace OzanAkman\ServerPlanner\Tests;

use PHPUnit\Framework\TestCase;
use OzanAkman\ServerPlanner\Resources;
use OzanAkman\ServerPlanner\VirtualMachine;

class VirtualMachineTest extends TestCase
{
    public function testGetResources()
    {
        $resources = $this->createMock(Resources::class);
        $subject = new VirtualMachine($resources);

        $this->assertSame($resources, $subject->getResources());
    }
}
