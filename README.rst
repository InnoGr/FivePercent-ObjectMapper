.. title:: Object Mapper

=============
Object Mapper
=============

With this package, you can map ``array`` data to ``object`` instances.

Installation
------------

Add **FivePercent/ObjectMapper** in your composer.json:

.. code-block:: json

    {
        "require": {
            "fivepercent/object-mapper": "~1.0"
        }
    }


Now tell composer to download the library by running the command:


.. code-block:: bash

    $ php composer.phar update fivepercent/object-mapper

Basic usage
-----------

Before use **ObjectMapper** you must configure instance:

1. Create a metadata factory for loads metadata from objects
2. Create a strategy manager

.. code-block:: php

    use Doctrine\Common\Annotations\AnnotationReader;
    use FivePercent\Component\ObjectMapper\Strategy\StrategyManager;
    use FivePercent\Component\ObjectMapper\Metadata\MetadataFactory;
    use FivePercent\Component\ObjectMapper\Metadata\Loader\AnnotationLoader;
    use FivePercent\Component\ObjectMapper\ObjectMapper;
    use FivePercent\Component\ObjectMapper\Metadata\ObjectMetadata;

    $strategyManager = StrategyManager::createDefault();

    $annotationLoader = new AnnotationLoader(new AnnotationReader());
    $metadataFactory = new MetadataFactory($annotationLoader);

    $objectMapper = new ObjectMapper($metadataFactory, $strategyManager);

    // Or create default object mapper
    $objectMapper = ObjectMapper::createDefault(); // Used AnnotationLoader for load metadata


**Attention:** now supported only annotation metadata loader.

After configure and create instance, you can use ``ObjectMapper`` map function.

Example object for maps:

.. code-block:: php

    use FivePercent\Component\ObjectMapper\Annotation\Object;
    use FivePercent\Component\ObjectMapper\Annotation\Property;

    /**
     * @Object()
     */
    class MyClass
    {
        /**
         * @Property()
         */
        public $id;

        /**
         * @Property()
         */
        public $name;
    }

And map array data:

.. code-block:: php

    $object = new MyClass();
    $objectMapper->map($object, [
        'id' => 1,
        'name' => 'Foo Bar'
    ]);


If you want map all properties in object, you can set attribute **allProperties** for **@Object**, then this indicate
for load all properties from class.

.. code-block:: php

    use FivePercent\Component\ObjectMapper\Annotation\Object;

    /**
     * @Object(allProperties=true)
     */
    class MyClass
    {
        public $id;
        public $name;
    }

If key of array not equals to property name of object, you can set attribute **fieldName** for **@Property**

.. code-block:: php

    use FivePercent\Component\ObjectMapper\Annotation\Object;
    use FivePercent\Component\ObjectMapper\Annotation\Property;

    /**
     * @Object()
     */
    class MyClass
    {
        /**
         * @Property()
         */
        public $id;

        /**
         * @Property(fieldName="first_name")
         */
        public $firstName;
    }

    $object = new MyClass();
    $objectMapper->map($object, [
        'id' => 1,
        'first_name' => 'Foo Bar'
    ]);

Recursive mapping
^^^^^^^^^^^^^^^^^

You can recursive map data to object.

With simple object:

.. code-block:: php

    use FivePercent\Component\ObjectMapper\Annotation\Object;
    use FivePercent\Component\ObjectMapper\Annotation\Property;

    class MyClass
    {
        /**
         * @DataMapping\Property(class="Tag")
         */
        protected $tag;
    }

    /**
     * @DataMapping\Object(allProperties=true)
     */
    class Tag
    {
        protected $name;
    }

    $object = new MyClass();
    $objectMapper->map($object, [
        'tag' => [
            'name' => 'Foo Bar'
        ]
    ]);


With collection:

.. code-block:: php

    use FivePercent\Component\ObjectMapper\Annotation\Object;
    use FivePercent\Component\ObjectMapper\Annotation\Property;

    class MyClass
    {
        /**
         * @DataMapping\Property(collection=true, class="Tag")
         */
        protected $tag;
    }

    /**
     * @DataMapping\Object(allProperties=true)
     */
    class Tag
    {
        protected $name;
    }

    $object = new MyClass();
    $objectMapper->map($object, [
        'tag' => [
            ['name' => 'Foo Bar'],
            ['name' => 'Bar Foo']
        ]
    ]);

And you can set the collection class if necessary, to attribute **collection** ``collection="MyCollectionClass"`
All keys as default will be saved.
