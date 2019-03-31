<?php

namespace OzanAkman\ServerPlanner\Tests;

use OzanAkman\ServerPlanner\Resources;
use PHPUnit\Framework\TestCase;

class ResourcesTest extends TestCase
{
    /**
     * @dataProvider reducedByProvider
     * @param Resources $minuend
     * @param Resources $subtrahend
     * @param Resources $result
     */
    public function testReducedBy(Resources $minuend, Resources $subtrahend, Resources $result)
    {
        $this->assertEquals($result, $minuend->reducedBy($subtrahend));
    }

    public function reducedByProvider()
    {
        return [
            [new Resources(1000, 2000, 3000), new Resources(200, 300, 400), new Resources(800, 1700, 2600)],
            [new Resources(1200, 300, 600), new Resources(200, 100, 400), new Resources(1000, 200, 200)]
        ];
    }

    /**
     * @dataProvider isGreaterOrEqualToProvider
     * @param Resources $subject
     * @param Resources $another
     * @param bool $expectedResult
     */
    public function testIsGreaterOrEqualTo(Resources $subject, Resources $another, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, $subject->isGreaterOrEqualTo($another));
    }

    public function isGreaterOrEqualToProvider()
    {
        return [
            [new Resources(1000, 2000, 3000), new Resources(200, 300, 400), true],
            [new Resources(1200, 300, 600), new Resources(200, 100, 400), true],
            [new Resources(1200, 300, 600), new Resources(2000, 1000, 4000), false],
            [new Resources(200, 1300, 1600), new Resources(100, 1400, 4000), false],
            [new Resources(1200, 5000, 16000), new Resources(1200, 1400, 4000), true],
            [new Resources(1200, 5000, 16000), new Resources(1200, 5000, 16000), true],
        ];
    }
}
