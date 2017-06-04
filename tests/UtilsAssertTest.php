<?php

declare(strict_types=1);

/*
 * This file is part of the Event package.
 *
 * (c) Aleksei Akireikin <opexus@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Akireikin\EventTest;

use Akireikin\Event\UtilsAssert;
use PHPUnit\Framework\TestCase;
use Serializable;
use stdClass;

/**
 * @coversDefaultClass \Akireikin\Event\UtilsAssert
 */
final class UtilsAssertTest extends TestCase
{
    /**
     * @test
     * @covers ::interfaceOrClassExists
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Expected an existing class or interface name. Got: "foo"
     */
    public function it_throws_exception_when_neither_class_nor_interface_given(): void
    {
        // act
        UtilsAssert::interfaceOrClassExists('foo');

        // assert - exception
    }

    /**
     * @test
     * @covers ::interfaceOrClassExists
     */
    public function it_passes_by_when_class_name_given(): void
    {
        // act
        UtilsAssert::interfaceOrClassExists(stdClass::class);

        // assert - no exception thrown
        $this->addToAssertionCount(1);
    }

    /**
     * @test
     * @covers ::interfaceOrClassExists()
     */
    public function it_passes_by_when_interface_name_given(): void
    {
        // act
        UtilsAssert::interfaceOrClassExists(Serializable::class);

        // assert - no exception thrown
        $this->addToAssertionCount(1);
    }
}
