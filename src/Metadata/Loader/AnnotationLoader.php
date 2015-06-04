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

use Doctrine\Common\Annotations\Reader;
use FivePercent\Component\ObjectMapper\Metadata\CollectionMetadata;
use FivePercent\Component\Reflection\Reflection;
use FivePercent\Component\ObjectMapper\Annotation\Object;
use FivePercent\Component\ObjectMapper\Annotation\Property;
use FivePercent\Component\ObjectMapper\Metadata\ObjectMetadata;
use FivePercent\Component\ObjectMapper\Metadata\PropertyMetadata;

/**
 * Annotation loader
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class AnnotationLoader implements LoaderInterface
{
    /**
     * @var Reader
     */
    private $reader;

    /**
     * Construct
     *
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * {@inheritDoc}
     */
    public function load($object, $group)
    {
        $reflection = Reflection::loadClassReflection($object);

        $objectMappingAnnotation = $this->getObjectMappingAnnotation($reflection, $group);

        if ($objectMappingAnnotation && $objectMappingAnnotation->allProperties) {
            // Include all properties
            $propertiesMappingAnnotation = $this->getAllPropertiesMapping($reflection, $objectMappingAnnotation->group);
        } else {
            $propertiesMappingAnnotation = $this->getPropertiesMappingAnnotation($reflection, $group);
        }

        if (!$objectMappingAnnotation && !$propertiesMappingAnnotation) {
            return null;
        }

        if (!$objectMappingAnnotation) {
            $strategy = 'reflection';
        } else {
            $strategy = $objectMappingAnnotation->strategy;
        }

        $properties = array();
        foreach ($propertiesMappingAnnotation as $propertyName => $propertyAnnotation) {
            $fieldName = $propertyAnnotation->fieldName ?: $propertyName;

            if ($propertyAnnotation->collection) {
                $collection = new CollectionMetadata(
                    $propertyAnnotation->collection->class,
                    $propertyAnnotation->collection->saveKeys
                );
            } else {
                $collection = null;
            }

            $property = new PropertyMetadata($propertyName, $fieldName, $propertyAnnotation->class, $collection);

            $properties[] = $property;
        }

        $objectMetadata = new ObjectMetadata($strategy, $properties);

        return $objectMetadata;
    }

    /**
     * Get object mapping annotation for class
     *
     * @param \ReflectionClass $refClass
     * @param string           $group
     *
     * @return Object|null
     */
    private function getObjectMappingAnnotation(\ReflectionClass $refClass, $group)
    {
        $classAnnotations = $this->reader->getClassAnnotations($refClass);

        foreach ($classAnnotations as $classAnnotation) {
            if ($classAnnotation instanceof Object) {
                if ($classAnnotation->group == $group) {
                    return $classAnnotation;
                }
            }
        }

        return null;
    }

    /**
     * Get properties mapping annotation for class
     *
     * @param \ReflectionClass $refClass
     * @param string           $group
     *
     * @return Property[]
     */
    private function getPropertiesMappingAnnotation(\ReflectionClass $refClass, $group)
    {
        $reflectionProperties = $refClass->getProperties(
            \ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PUBLIC
        );

        $properties = [];

        foreach ($reflectionProperties as $reflectionProperty) {
            $propertyAnnotations = $this->reader->getPropertyAnnotations($reflectionProperty);

            foreach ($propertyAnnotations as $propertyAnnotation) {
                if ($propertyAnnotation instanceof Property && in_array($group, $propertyAnnotation->groups)) {
                    if (isset($properties[$reflectionProperty->getName()])) {
                        throw new \RuntimeException(sprintf(
                            'Many @Property annotations in property "%s->%s" for group "%s".',
                            $refClass->getName(),
                            $reflectionProperty->getName(),
                            $group
                        ));
                    }

                    $properties[$reflectionProperty->getName()] = $propertyAnnotation;
                }
            }
        }

        return $properties;
    }

    /**
     * Get all properties for mapping
     *
     * @param \ReflectionClass $refClass
     * @param string           $group
     *
     * @return Property[]
     */
    public function getAllPropertiesMapping(\ReflectionClass $refClass, $group)
    {
        $reflectionProperties = $refClass->getProperties(
            \ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PUBLIC
        );

        $properties = [];

        foreach ($reflectionProperties as $reflectionProperty) {
            $property = new Property([]);
            $property->fieldName = $reflectionProperty->getName();
            $property->groups = [$group];

            $properties[$reflectionProperty->getName()] = $property;
        }

        return $properties;
    }
}
