<?php

/**
 * This file is part of the ObjectMapper package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectMapper\Metadata\Loader;

/**
 * All data mapper metadata loaders should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface LoaderInterface
{
    /**
     * Load metadata for object and group
     *
     * @param object $object
     * @param string $group
     *
     * @return \FivePercent\Component\ObjectMapper\Metadata\ObjectMetadata
     */
    public function load($object, $group);
}
