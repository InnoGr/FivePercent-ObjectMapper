<?php

/**
 * This file is part of the ObjectMapper package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectMapper\Annotation;

use FivePercent\Component\ObjectMapper\Metadata\ObjectMetadata;

/**
 * Indicate object for available mapping
 *
 * @Annotation
 * @Target("CLASS")
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class Object
{
    /** @var string */
    public $strategy = 'reflection';
    /** @var string */
    public $group = ObjectMetadata::DEFAULT_GROUP;
    /** @var bool */
    public $allProperties = false; // Available only for reflection strategy
}
