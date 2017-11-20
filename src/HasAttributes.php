<?php

namespace Makeable\LaravelYoutube;

trait HasAttributes
{
    /**
     * @var
     */
    public $attributes = [];

    /**
     * @param $property
     * @return mixed
     */
    public function __get($property)
    {
        return array_get($this->attributes, $property);
    }

    /**
     * @param $property
     * @param $value
     */
    public function __set($property, $value)
    {
        $this->attributes[$property] = $value;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function fill(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }
}