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

use FivePercent\Component\Exception\UnexpectedTypeException;
use FivePercent\Component\ObjectMapper\Metadata\PropertyMetadata;
use FivePercent\Component\Reflection\Reflection;

/**
 * Reflection strategy mapping
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ReflectionStrategy implements StrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function map(PropertyMetadata $property, $object, $value)
    {
        if (!is_object($object)) {
            throw UnexpectedTypeException::create($object, 'object');
        }

        if (!$property->reflection) {
            $objectReflection = Reflection::loadObjectReflection($object);
            $propertyName = $property->getPropertyName();
            $propertyReflection = $objectReflection->getProperty($propertyName);

            if (!$propertyReflection->isPublic()) {
                $propertyReflection->setAccessible(true);
            }

            $property->reflection = $propertyReflection;
        }

        $property->reflection->setValue($object, $value);
    }
}
