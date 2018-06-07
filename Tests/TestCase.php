<?php

namespace Autologic\JSONExceptions\Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * m::close() is required so Mockery can clean up it's container and run verifications
     * on our expectations i.e. shouldReceive()->once().
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    /**
     * @param string $class
     * @return m\Mock
     */
    public function createMock($class)
    {
        return m::mock($class)->shouldIgnoreMissing();
    }
}
