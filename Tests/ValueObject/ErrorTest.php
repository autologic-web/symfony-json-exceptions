<?php

namespace Autologic\JSONExceptions\Tests\ValueObject;

use Autologic\JSONExceptions\Tests\TestCase;
use Autologic\JSONExceptions\ValueObject\Error;

class ErrorTest extends TestCase
{
    const TITLE = 'Internal Server Error';
    const DETAIL = 'Something went wrong';
    const STATUS = 500;

    /**
     * @var Error
     */
    private $error;

    protected function setUp()
    {
        $this->error = new Error(self::TITLE, self::DETAIL, self::STATUS);
    }

    public function testGetters_ReturnsData()
    {
        $this->assertSame(self::TITLE, $this->error->getTitle());
        $this->assertSame(self::DETAIL, $this->error->getDetail());
        $this->assertSame(self::STATUS, $this->error->getStatus());
    }

    public function testToArray_ReturnsData()
    {
        $expected = [
            'title'  => self::TITLE,
            'detail' => self::DETAIL,
            'status' => self::STATUS,
        ];

        $this->assertSame($expected, $this->error->toArray());
    }
}
