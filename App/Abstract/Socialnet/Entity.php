<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

/**
 * Class Entity
 *
 * @package Abstract\Socialnet
 *
 * Api entity interface
 */
abstract class App_Abstract_Socialnet_Entity
{
    /** @var hashid */
    protected $hashid;

    /**
     * relations objects.
     *
     * @return array
     */
    protected $_relations = array();

    protected $_properties = array();

    /**
     * Map api-response keys to class setters
     *
     * @var array
     */
    protected $propertiesMap = array();

    /**
     * Instantiates an exception to be thrown later.
     */
    abstract public function thrownException($error);

    /**
     * Make new instance from api response array
     *
     * @param mixed $properties list of properties
     */
    public function __construct($properties = null)
    {

        $this-> hashid = isset($properties['hashid']) ? $properties['hashid'] : \Core_Api::getUniqueId();
        if (is_null($properties)) {
                $this->toInit();
            return;
        }

        $this->_properties = $properties;

        if (!is_array($this->_properties) && !$this->_properties instanceof ArrayAccess) {

            $this->thrownException('Properties must be an array or implement ArrayAccess');
        }


        if (empty($this->propertiesMap)) { // no property map

            $_className =  get_class($this);
            foreach ($this->_properties as $propName => $propValue) {

                if (property_exists($_className, $propName)) {
                    $this->$propName = $propValue;
                }
            }
        } else { // call setters

            foreach ($this->_properties as $propName => $propValue) {

                $this->setPropertiesMap($propName, $propValue);
            }
        }

        $this->toInit();
    }

    protected function toInit()
    {

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

    public function setProperties($name, $value)
    {
        return $this;
    }

    public function setPropertiesMap($name, $value)
    {
_develop('setPropertiesMap %s => %s,%s', $name, $value, get_class($this));
        if ( isset($this->propertiesMap[$name]['handler'])) {

            $setterName = $this->propertiesMap[$name]['handler'];
_develop('setPropertiesMap %s => %s', $setterName, $value);
            if ( !empty($setterName) && method_exists($this, $setterName) )
                $this->$setterName($value);
        } else {
//            $this->_properties[$name] = \Core_Api::getPattern();
        }
        return $this;
    }
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

        $_className =  get_class($this);
        if (property_exists($_className, $property)) {

            return $this->$property;
        }
        return isset($this->_properties[$property]) ? $this->_properties[$property] : $default;
    }

    public function offsetExists($property)
    {
        return isset($this->propertiesMap[$property]);
    }

    public static function make($properties) {

        return new static($properties);
    }

    public function getEvents() {

        return $this->keysRelations();
    }

    /**
     * Property relations objects for request.
     *
     * @return array
     */
    public function relations() {

        return array();
    }

    public function keysRelations()
    {
        return array_keys($this->_relations);
    }

    public function isRelations($key)
    {
        return isset($this->_relations[$key]);
    }

    public function getRelations($key = false)
    {
        return $this->isRelations($key) ? $this->_relations[$key] : static::make( array() );
    }

    public function setRelations($key, $value)
    {
        $this->_relations[$key] = $value;

        return $this;
    }

    /**
     * @param string
     *
     * @return array
     */
    public function getProperties($name = false)
    {
        return $name? ( isset($this->_properties[$name]) ? $this->_properties[$name] : null)
            : $this->_properties;
    }

    /**
     * @return string
     */

    public function getPhoneNumber()
    {
        return $this->_phoneNumber;
    }

    /**
     * Build array single-level array
     *
     * @return array
     */
    public function toArray()
    {
        return array();
    }

}