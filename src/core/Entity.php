<?php
namespace Core;
class Entity {

    public function __get($property)
    {
        $reflectionClass = new \ReflectionClass($this);
        if ($reflectionClass->hasProperty($property)) {
            $reflectionProperty = $reflectionClass->getProperty($property);
            $reflectionProperty->setAccessible(true);
            return $reflectionProperty->getValue($this);
        }
        return null; 
    }
    
    public function __set($property, $value)
    {
        $reflectionClass = new \ReflectionClass($this);
        if ($reflectionClass->hasProperty($property)) {
            $reflectionProperty = $reflectionClass->getProperty($property);
            $reflectionProperty->setAccessible(true);
            $reflectionProperty->setValue($this, $value);
            return $this;
        }
        throw new \Exception("Property $property does not exist");
    }

    //toObject() method
    //toArray
    
    
}