<?php

namespace App\Tests;

trait TestCaseTrait
{
    /**
     * Call protected/private method of a class.
     *
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     * @throws \ReflectionException
     */
    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Sets value to property
     *
     * @param $class
     * @param string $propertyName
     * @param $value
     * @throws \ReflectionException
     */
    public function setPropertyValue($class, string $propertyName, $value): void
    {
        $property = new \ReflectionProperty($class, $propertyName);
        $property->setAccessible(true);
        $property->setValue($class, $value);
    }

    /**
     * @param string $property
     * @param mixed $value
     * @param $class
     * @param mixed $type
     */
    public function simpleTestSetGet(string $property, $value, $class, $type = null): void
    {
        $property = ucfirst($property);
        $set = 'set' . $property;
        $get = 'get' . $property;
        self::assertInstanceOf(get_class($class), $class->$set($value));

        if ($type !== null) {
            self::assertInternalType($type, $class->$get());
        }

        self::assertEquals($value, $class->$get());
    }
}