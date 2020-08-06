<?php

namespace Mitirrli\TpQuery\Tests;

use Mitirrli\TpQuery\Constant\Search;
use PHPUnit\Framework\TestCase;
use Mitirrli\TpQuery\SearchTrait;
use Mitirrli\TpQuery\Constant\TestData;

class QueryTest extends TestCase
{
    use SearchTrait;

    /**
     * test function initial.
     */
    public function testInitial()
    {
        array_map(function ($value) {
            $object = $this->initial($value);

            self::assertEquals($object->result(), $value);
        }, TestData::TEST_DATA1);
    }

    /**
     * test function param.
     */
    public function testParam()
    {
        array_map(function ($value) {
            $object = $this->param($value);

            $property = new \ReflectionProperty($object, 'params');
            $property->setAccessible(true);

            self::assertEquals($value, $property->getValue($object));
        }, TestData::TEST_DATA1);
    }

    /**
     * test function key.
     */
    public function testAccurateKey()
    {
        //Test 1. accurate search
        $key = 'name';
        $object = $this->param(TestData::TEST_DATA2)->key($key);

        $property = new \ReflectionProperty($object, 'init');
        $property->setAccessible(true);
        self::assertEquals(TestData::TEST_DATA2[$key], $property->getValue($object)[$key]);

        //Test 2. right fuzzy search
        $key = 'language';
        $object = $this->param(TestData::TEST_DATA2)->key($key, Search::PERCENT_RIGHT);

        $property = new \ReflectionProperty($object, 'init');
        $property->setAccessible(true);

        self::assertIsArray($test2 = $property->getValue($object)[$key]);
        self::assertEquals($test2[0], 'LIKE');
        self::assertEquals($test2[1], TestData::TEST_DATA2[$key] . '%');

        //Test 3. all fuzzy search
        $key = 'test';
        $object = $this->param(TestData::TEST_DATA2)->key($key, Search::PERCENT_ALL);

        $property = new \ReflectionProperty($object, 'init');
        $property->setAccessible(true);

        self::assertIsArray($test2 = $property->getValue($object)[$key]);
        self::assertEquals($test2[0], 'LIKE');
        self::assertEquals($test2[1], '%' . TestData::TEST_DATA2[$key] . '%');
    }
}