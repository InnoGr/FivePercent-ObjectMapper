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
 * Object for testing mapping with collections
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class WithCollectionObject
{
    /**
     * @DataMapping\Property()
     */
    protected $name;

    /**
     * @DataMapping\Property(class="FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObject")
     */
    protected $simpleObject;

    /**
     * @DataMapping\Property(collection=true, class="FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObject")
     */
    protected $simpleObjects;
}