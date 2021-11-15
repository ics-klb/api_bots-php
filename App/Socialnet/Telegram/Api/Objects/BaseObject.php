<?php

namespace App\Socialnet\Telegram\Api\Objects;

use App\Socialnet\Telegram\Api as Api;

/**
 * Class BaseObject.
 *
 */
class BaseObject extends Api\Entity
{

    /**
     * Make new instance from api response array
     *
     * @param mixed $items list of properties
     */
    public function __construct($items = null)
    {
        $_relations = $this->relations();

        foreach($_relations as $field => $value )
            array_push($this->propertiesMap,
                    array($field  => array( 'value' => null, 'type' => 'object')) );

        parent::__construct($items);

    }

    protected function toInit() {

        foreach($this->relations() as $field => $value) {
            if ( isset($this->_properties[$field]) )
                $this->setRelations($field, $this->getPropertyValue($field));
        }
    }

    public static function make($properties) {

        return new static($properties);
    }

    /**
     * Property relations objects for request.
     *
     * @return array
     */
    public function relations() {

        return array();
    }

    public function getEvents() {

        return $this->keysRelations();
    }

    /**
     * Magically access collection data.
     *
     * @param $property
     *
     * @return mixed
     */
//    public function __get($property)
//    {
//        return $this->getPropertyValue($property);
//    }

    /**
     * Magically map to an object class (if exists) and return data.
     *
     * @param      $property
     * @param null $default
     *
     * @return mixed
     */
    protected function getPropertyValue($property, $default = null)
    {

        $property = verifyval($property, "/^[A-Za-z0-9_]{1,32}$/", false);

_error('getPropertyValue -1- %s ', $property);
        if ($property && !$this->offsetExists($property)) {
            return $default;
        }

        $value = $this->_properties[$property];

        $relations = $this->relations();

        if (isset($relations[$property])) {

            $class = '\App\Socialnet\Telegram\Api\Objects\\'.$relations[$property];
_develop($class);
            return $class::make($value);
        }

        if (is_array($value)) {
            return TelegramObject::make($value);
        }

        return $value;
    }

    /**
     * Get an item from the collection by key.
     *
     * @param mixed $key
     * @param mixed $default
     *
     * @return mixed|static
     */
    public function get($key, $default = null)
    {
        $value = $this->_properties[$key];

        if (null !== $value && is_array($value)) {
            return $this->getPropertyValue($key, $default);
        }

        return $value;
    }

    /**
     * Returns raw response.
     *
     * @return array|mixed
     */
    public function getRawResponse()
    {
        return $this->_properties;
    }

    /**
     * Returns raw result.
     *
     * @param $data
     *
     * @return mixed
     */
    public function getRawResult($data)
    {
        return data_get($data, 'result', $data);
    }

    /**
     * Get Status of request.
     *
     * @return mixed
     */
    public function getStatus()
    {
        return data_get($this->_properties, 'ok', false);
    }

    /**
     * Build array single-level array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getProperties();
    }    

}
