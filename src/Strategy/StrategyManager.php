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

use FivePercent\Component\ObjectMapper\Exception\StrategyNotFoundException;
use FivePercent\Component\ObjectMapper\Metadata\ObjectMetadata;

/**
 * Base strategy manager
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class StrategyManager implements StrategyManagerInterface
{
    /**
     * @var array
     */
    private $strategies = [];

    /**
     * Add strategy
     *
     * @param string            $key
     * @param StrategyInterface $strategy
     *
     * @return StrategyManager
     */
    public function addStrategy($key, StrategyInterface $strategy)
    {
        $this->strategies[$key] = $strategy;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getStrategy($key)
    {
        if (!isset($this->strategies[$key])) {
            throw new StrategyNotFoundException(sprintf(
                'Not found strategy with key "%s".',
                $key
            ));
        }

        return $this->strategies[$key];
    }

    /**
     * Create default manager
     *
     * @return StrategyManager
     */
    public static function createDefault()
    {
        /** @var StrategyManager $manager */
        $manager = new static();

        $manager
            ->addStrategy(ObjectMetadata::STRATEGY_REFLECTION, new ReflectionStrategy());

        return $manager;
    }
}
