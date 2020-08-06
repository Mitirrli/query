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
    public function testKey()
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
        self::assertEquals($test2[1], TestData::TEST_DATA2[$key].'%');

        //Test 3. all fuzzy search
        $key = 'test';
        $object = $this->param(TestData::TEST_DATA2)->key($key, Search::PERCENT_ALL);

        $property = new \ReflectionProperty($object, 'init');
        $property->setAccessible(true);

        self::assertIsArray($test2 = $property->getValue($object)[$key]);
        self::assertEquals($test2[0], 'LIKE');
        self::assertEquals($test2[1], '%'.TestData::TEST_DATA2[$key].'%');
    }

    /**
     * test function orKey.
     */
    public function testOrKey()
    {
        $key = 'test';
        $new_key = 'new key';

        $result = $this->param(TestData::TEST_DATA2)->orKey($new_key, $key)->result();

        self::assertIsArray($result);
        self::assertArrayHasKey($new_key, $result);

        //Test 1. accurate search
        $key = 'JS';
        $new_key = 'NEW_JS';
        $object = $this->param(TestData::TEST_DATA3)->orKey($new_key, $key);

        $property = new \ReflectionProperty($object, 'init');
        $property->setAccessible(true);
        self::assertEquals(TestData::TEST_DATA3[$key], $property->getValue($object)[$new_key]);

        //Test 2. right fuzzy search
        $key = 'PHP';
        $new_key = 'NEW_PHP';
        $object = $this->param(TestData::TEST_DATA3)->orKey($new_key, $key, Search::PERCENT_RIGHT);

        $property = new \ReflectionProperty($object, 'init');
        $property->setAccessible(true);

        self::assertIsArray($test2 = $property->getValue($object)[$new_key]);
        self::assertEquals($test2[0], 'LIKE');
        self::assertEquals($test2[1], TestData::TEST_DATA3[$key].'%');

        //Test 2. right fuzzy search
        $key = 'C';
        $new_key = 'NEW_C';
        $object = $this->param(TestData::TEST_DATA3)->orKey($new_key, $key, Search::PERCENT_ALL);

        $property = new \ReflectionProperty($object, 'init');
        $property->setAccessible(true);

        self::assertIsArray($test2 = $property->getValue($object)[$new_key]);
        self::assertEquals($test2[0], 'LIKE');
        self::assertEquals($test2[1], '%'.TestData::TEST_DATA3[$key].'%');
    }

    /**
     * test function result.
     */
    public function testResult()
    {
        $keys = array_keys(TestData::TEST_DATA2);

        array_map(function ($value) {
            self::assertArrayHasKey($value, $this->param(TestData::TEST_DATA2)->key($value)->result());
        }, $keys);
    }
}
