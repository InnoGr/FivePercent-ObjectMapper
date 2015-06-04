<?php

/**
 * This file is part of the ObjectMapper package
 *
 * (c) InnovationGroup
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FivePercent\Component\ObjectMapper\Tests;

use FivePercent\Component\ObjectMapper\ObjectMapper;
use FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObject;
use FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObjectWithAllProperties;
use FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObjectWithAnyFieldNames;
use FivePercent\Component\ObjectMapper\Tests\Mapping\WithChildObject;
use FivePercent\Component\ObjectMapper\Tests\Mapping\WithCollectionObject;
use FivePercent\Component\Reflection\Reflection;

/**
 * Functional testing ObjectMapper with annotation loader
 *
 * @author Vitaliy Zhuk <zhuk2205@gmail.com>
 */
class ObjectMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectMapper
     */
    private $objectMapper;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->objectMapper = ObjectMapper::createDefault();
    }

    /**
     * Test with simple object
     */
    public function testWithSimpleObject()
    {
        $object = new SimpleObject();
        $this->objectMapper->map($object, [
            'name' => 'Name',
            'description' => 'Description'
        ]);

        $this->assertEquals('Name', Reflection::getPropertyValue($object, 'name'));
        $this->assertEquals('Description', Reflection::getPropertyValue($object, 'description'));
    }

    /**
     * Test with simple object and groups
     */
    public function testWithSimpleObjectAndGroup()
    {
        $object = new SimpleObject();
        $this->objectMapper->map($object, [
            'name' => 'Name',
            'description' => 'Description'
        ], 'Name');

        $this->assertEquals('Name', Reflection::getPropertyValue($object, 'name'));
        $this->assertNull(Reflection::getPropertyValue($object, 'description'));
    }

    /**
     * Test with simple object and indicate all properties in object
     */
    public function testWithSimpleObjectWithAllProperties()
    {
        $object = new SimpleObjectWithAllProperties();
        $this->objectMapper->map($object, [
            'name' => 'New name',
            'description' => 'New description'
        ]);

        $this->assertEquals('New name', Reflection::getPropertyValue($object, 'name'));
        $this->assertEquals('New description', Reflection::getPropertyValue($object, 'description'));
    }

    /**
     * Test with simple object and any field names
     */
    public function testWithSimpleObjectWithAnyFieldNames()
    {
        $object = new SimpleObjectWithAnyFieldNames();
        $this->objectMapper->map($object, [
            'title' => 'Title',
            'help' => 'Help'
        ]);

        $this->assertEquals('Title', Reflection::getPropertyValue($object, 'name'));
        $this->assertEquals('Help', Reflection::getPropertyValue($object, 'description'));
    }

    /**
     * Test with child object (recursive)
     */
    public function testWithChildObject()
    {
        $object = new WithChildObject();
        $this->objectMapper->map($object, [
            'name' => 'Foo',
            'simpleObject' => [
                'name' => 'New name'
            ]
        ]);

        $this->assertEquals('Foo', Reflection::getPropertyValue($object, 'name'));
        $child = Reflection::getPropertyValue($object, 'simpleObject');
        $this->assertInstanceOf('FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObject', $child);
        $this->assertEquals('New name', Reflection::getPropertyValue($child, 'name'));
    }

    /**
     * Test with child object and invalid input parameters
     *
     * @expectedException \FivePercent\Component\ObjectMapper\Exception\MapException
     * @expectedExceptionMessage The value of parameter "simpleObject" should be a type of array, but "string" given.
     */
    public function testWithChildObjectAndInvalidInput()
    {
        $object = new WithChildObject();
        $this->objectMapper->map($object, [
            'name' => 'Foo',
            'simpleObject' => 'bar'
        ]);
    }

    /**
     * Test with child collection
     */
    public function testWithChildCollection()
    {
        $object = new WithCollectionObject();
        $this->objectMapper->map($object, [
            'name' => 'Foo',
            'simpleObject' => [
                'name' => 'Simple object'
            ],
            'simpleObjects' => [
                [
                    'name' => '#1'
                ],

                [
                    'name' => '#2'
                ]
            ]
        ]);

        $this->assertEquals('Foo', Reflection::getPropertyValue($object, 'name'));

        $simpleObject = Reflection::getPropertyValue($object, 'simpleObject');
        $this->assertInstanceOf('FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObject', $simpleObject);
        $this->assertEquals('Simple object', Reflection::getPropertyValue($simpleObject, 'name'));

        $simpleObjects = Reflection::getPropertyValue($object, 'simpleObjects');
        $this->assertInstanceOf('ArrayAccess', $simpleObjects);
        $this->assertFalse(empty($simpleObjects[0]));
        $this->assertFalse(empty($simpleObjects[1]));

        $object1 = $simpleObjects[0];
        $this->assertInstanceOf('FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObject', $object1);
        $this->assertEquals('#1', Reflection::getPropertyValue($object1, 'name'));

        $object2 = $simpleObjects[1];
        $this->assertInstanceOf('FivePercent\Component\ObjectMapper\Tests\Mapping\SimpleObject', $object2);
        $this->assertEquals('#2', Reflection::getPropertyValue($object2, 'name'));
    }

    /**
     * Test with child collection and invalid input parameters
     *
     * @expectedException \FivePercent\Component\ObjectMapper\Exception\MapException
     * @expectedExceptionMessage The value of parameter "simpleObjects[0]" should be a type of array, but "string" given.
     */
    public function testWithChildCollectionAndInvalidInput()
    {
        $object = new WithCollectionObject();
        $this->objectMapper->map($object, [
            'name' => 'Foo',
            'simpleObjects' => [
                'foo',
                'bar'
            ]
        ]);
    }
}
