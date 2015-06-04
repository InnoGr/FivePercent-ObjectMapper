<?php

/**
 * This file is part of the ObjectMapper package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectMapper\Annotation;

use Doctrine\Common\Annotations\AnnotationException;
use FivePercent\Component\ObjectMapper\Metadata\ObjectMetadata;

/**
 * Indicate property for available in mapping
 *
 * @Annotation
 * @Target("PROPERTY")
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class Property
{
    /** @var string */
    public $fieldName;
    /** @var string */
    public $class;
    /** @var Collection|bool */
    public $collection;
    /** @var array */
    public $groups = [ ObjectMetadata::DEFAULT_GROUP ];

    /**
     * Construct
     *
     * @param array $values
     *
     * @throws AnnotationException
     */
    public function __construct(array $values)
    {
        if (!empty($values['value'])) {
            // Send only one parameter: @Property("my_field_name")
            $this->fieldName = $values['value'];
        } else {
            if (!empty($values['collection'])) {
                $collection = $values['collection'];

                if (is_bool($collection)) {
                    $collection = new Collection();
                } else if (is_scalar($collection)) {
                    $collectionClass = $collection;
                    $collection = new Collection();
                    $collection->class = $collectionClass;
                } else if ($collection && !$collection instanceof Collection) {
                    throw new AnnotationException(sprintf(
                        '[Type error] The "collection" attribute should be a Collection instance, or class name, ' .
                        'but "%s" given.',
                        is_object($collection) ? get_class($collection) : gettype($collection)
                    ));
                }

                $values['collection'] = $collection;
            }

            foreach ($values as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}
