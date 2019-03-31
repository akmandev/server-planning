<?php

namespace OzanAkman\ServerPlanner\Tests;

use PHPUnit\Framework\TestCase;
use OzanAkman\ServerPlanner\Resources;
use OzanAkman\ServerPlanner\ServerType;

class ServerTypeTest extends TestCase
{
    public function testGetResources()
    {
        $resources = $this->createMock(Resources::class);
        $subject = new ServerType($resources);

        $this->assertSame($resources, $subject->getResources());
    }
}
