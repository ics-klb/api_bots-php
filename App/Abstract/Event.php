<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Abstract\Event.php, v1.03 2020/09/01 12:23:00 Exp $


/**
 * Class Event
 *
 * @package Abstract\Core
 */
abstract class App_Abstract_Event
{
    /**
     * Event
     *
     * @var string
     */
    protected $event;

    /**
     * Time of the event that triggered the callback
     *
     * @var integer
     */
    protected $timestamp;

    protected $_properties   = array();
    protected $propertiesMap = array();

    /**
     * Init event from api array
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->_properties = $properties;
        foreach ($this->_properties as $propName => $propValue) {

            $this->setProperties($propName, $propValue)
                ->setPropertiesMap($propName, $propValue);
        }

        $this-> toInit();
    }

    public function getProperties($propName)
    {
        if ( property_exists(get_class($this), $propName) )
        {
            return $this->$propName;
        }
        return isset($this->_properties[$propName]) ? $this->_properties[$propName] : $this->_properties;
    }

    public function setProperties($propName, $propValue)
    {
        if ( property_exists(get_class($this), $propName) )
            $this->$propName = $propValue;
        return $this;
    }

    public function setPropertiesMap($name, $value)
    {
        if ( isset($this->propertiesMap[$name])) {

            $setterName = $this->propertiesMap[$name]['handler'];
            if ( !empty($setterName) )
                $this->$setterName($value);
        }
        return $this;
    }

    public function toInit()
    {
        return $this;
    }

    /**
     * Get the value of Event type
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Get the value of Event type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the value of Time of the event that triggered the callback
     *
     * @return integer
     */
    public function getTimestamp()
    {
        return $this->timestamp;
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

    /**
     * Build multi-level array for api call`s, filter or upgrade properties
     *
     * @return array
     */
    public function toApiArray()
    {
        $entity = $this->toArray();
        foreach ($entity as $name => &$value)
        {
            if (is_null($value)) {

                unset($entity[$name]);
            } elseif ( is_object($value) ) {

                $value = $value->toArray();
            }
        }
        return $entity;
    }

}