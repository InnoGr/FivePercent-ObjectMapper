<?php

/**
 * This file is part of the ObjectMapper package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectMapper;

use FivePercent\Component\ObjectMapper\Metadata\ObjectMetadata;

/**
 * All data mappers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface ObjectMapperInterface
{
    /**
     * Get metadata factory
     *
     * @return \FivePercent\Component\ObjectMapper\Metadata\MetadataFactoryInterface
     */
    public function getMetadataFactory();

    /**
     * Is object supported
     *
     * @param object $object
     * @param string $group
     *
     * @return bool
     */
    public function isSupported($object, $group = ObjectMetadata::DEFAULT_GROUP);

    /**
     * Map parameters for object
     *
     * @param object $object
     * @param array  $parameters
     * @param string $group
     */
    public function map($object, array $parameters, $group = ObjectMetadata::DEFAULT_GROUP);
}
