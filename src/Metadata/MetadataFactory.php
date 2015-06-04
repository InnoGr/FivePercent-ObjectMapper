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

use FivePercent\Component\ObjectMapper\Metadata\Loader\LoaderInterface;

/**
 * Base metadata factory
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class MetadataFactory implements MetadataFactoryInterface
{
    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * Construct
     *
     * @param LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * {@inheritDoc}
     */
    public function load($object, $group)
    {
        return $this->loader->load($object, $group);
    }
}
