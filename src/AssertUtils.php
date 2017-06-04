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

namespace Akireikin\Event;

use Webmozart\Assert\Assert;

class AssertUtils extends Assert
{
    /**
     * Interface or class exists.
     *
     * @param string $value
     * @param string $message
     */
    public static function interfaceOrClassExists(string $value, string $message = ''): void
    {
        if (!class_exists($value) && !interface_exists($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Expected an existing class or interface name. Got: %s',
                static::valueToString($value)
            ));
        }
    }
}
