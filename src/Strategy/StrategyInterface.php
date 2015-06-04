<?php

/**
 * This file is part of the ObjectMapper package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectMapper\Strategy;

use FivePercent\Component\ObjectMapper\Metadata\PropertyMetadata;

/**
 * All mapping strategies should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface StrategyInterface
{
    /**
     * Map parameters to object
     *
     * @param PropertyMetadata $property
     * @param object           $object
     * @param mixed            $value
     */
    public function map(PropertyMetadata $property, $object, $value);
}
