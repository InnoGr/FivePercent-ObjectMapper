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
 * Chain metadata loader
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ChainLoader implements LoaderInterface
{
    /**
     * @var array|LoaderInterface[]
     */
    protected $loaders = [];

    /**
     * Construct
     *
     * @param array|LoaderInterface[] $loaders
     */
    public function __construct(array $loaders = [])
    {
        foreach ($loaders as $loader) {
            $this->addLoader($loader);
        }
    }

    /**
     * Add loader
     *
     * @param LoaderInterface $loader
     *
     * @return ChainLoader
     */
    public function addLoader(LoaderInterface $loader)
    {
        $this->loaders[spl_object_hash($loader)] = $loader;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function load($object, $group)
    {
        foreach ($this->loaders as $loader) {
            $metadata = $loader->load($object, $group);

            if (null !== $metadata) {
                return $metadata;
            }
        }

        return null;
    }
}
