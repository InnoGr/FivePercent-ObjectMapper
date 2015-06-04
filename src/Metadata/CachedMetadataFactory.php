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

use FivePercent\Component\Cache\CacheInterface;

/**
 * Cached metadata factory for caching metadata
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class CachedMetadataFactory implements MetadataFactoryInterface
{
    /**
     * @var MetadataFactoryInterface
     */
    private $delegate;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * Construct
     *
     * @param MetadataFactoryInterface $delegate
     * @param CacheInterface           $cache
     */
    public function __construct(MetadataFactoryInterface $delegate, CacheInterface $cache)
    {
        $this->delegate = $delegate;
        $this->cache = $cache;
    }

    /**
     * {@inheritDoc}
     */
    public function load($object, $group)
    {
        $class = get_class($object);
        $key = 'object_mapper:' . $class . ':' . $group;

        $metadata = $this->cache->get($key);

        if (!$metadata) {
            $metadata = $this->delegate->load($object, $group);
            $this->cache->set($key, $metadata);
        }

        return $metadata;
    }
}
