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

/**
 * All strategy managers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
interface StrategyManagerInterface
{
    /**
     * Get strategy
     *
     * @param string $key
     *
     * @return StrategyInterface
     *
     * @throws \FivePercent\Component\ObjectMapper\Exception\StrategyNotFoundException
     */
    public function getStrategy($key);
}
