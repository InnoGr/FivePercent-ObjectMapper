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
 * Object metadata
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ObjectMetadata
{
    const STRATEGY_REFLECTION   = 'reflection';

    const DEFAULT_GROUP         = 'Default';

    /**
     * @var string
     */
    protected $strategy;

    /**
     * @var array|PropertyMetadata[]
     */
    protected $properties = [];

    /**
     * READ-ONLY. Used only for ReflectionStrategy
     *
     * @var \ReflectionObject
     */
    public $reflection;

    /**
     * Construct
     *
     * @param string $strategy
     * @param array  $properties
     */
    public function __construct($strategy, array $properties)
    {
        $this->strategy = $strategy;
        $this->properties = $properties;
    }

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * Get properties
     *
     * @return array|PropertyMetadata[]
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
