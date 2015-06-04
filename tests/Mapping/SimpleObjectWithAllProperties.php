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
 * Simple object for mapping testing with indicate all properties
 *
 * @DataMapping\Object(allProperties=true)
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class SimpleObjectWithAllProperties
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;
}
