<?php

/**
 * This file is part of the ObjectMapper package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectMapper\Metadata;

/**
 * All metadata factories should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface MetadataFactoryInterface
{
    /**
     * Load metadata for object
     *
     * @param object $object
     * @param string $group
     *
     * @return ObjectMetadata|null
     */
    public function load($object, $group);
}
