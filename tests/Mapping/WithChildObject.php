<?php

/**
 * This file is part of the ObjectMapper package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectMapper\Tests\Mapping;

use FivePercent\Component\ObjectMapper\Annotation as DataMapping;

/**
 * Object for testing recursive mapping with
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class WithChildObject
{
    /**
     * @var string
     *
     * @DataMapping\Property()
     */
    protected $name;

    /**
     * @var SimpleObject
     *
     * @DataMapping\Property(class="FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObject")
     */
    protected $simpleObject;
}
