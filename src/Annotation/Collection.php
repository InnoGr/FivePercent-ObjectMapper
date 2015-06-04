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

/**
 * Indicate property as collection for mapping
 *
 * @Annotation
 * @Target("ANNOTATION")
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class Collection
{
    /** @var string */
    public $class = 'ArrayObject';
    /** @var bool */
    public $saveKeys = true;
}
