<?php

namespace OzanAkman\ServerPlanner\Tests;

use OzanAkman\ServerPlanner\Resources;
use OzanAkman\ServerPlanner\ServerType;
use PHPUnit\Framework\TestCase;

class ServerTypeTest extends TestCase
{
    public function testGetResources()
    {
        $resources = $this->createMock(Resources::class);
        $subject = new ServerType($resources);

        $this->assertSame($resources, $subject->getResources());
    }
}
