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
 * Collection metadata
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class CollectionMetadata
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var bool
     */
    private $saveKeys;

    /**
     * Construct
     *
     * @param string $class
     * @param bool   $saveKeys
     */
    public function __construct($class, $saveKeys)
    {
        $this->class = $class;
        $this->saveKeys = $saveKeys;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Is save keys
     *
     * @return bool
     */
    public function isSaveKeys()
    {
        return $this->saveKeys;
    }
}
