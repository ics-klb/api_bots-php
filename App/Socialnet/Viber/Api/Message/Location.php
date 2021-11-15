<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\Message;

use App\Socialnet\Viber\Api as Api;

/**
 * Class Location
 *
 * @package Viber\Api
 *
 * Location as message
 */
class Location extends Api\Message
{
    /**
     * Location coordinates. With "lat" and "lon" keys
     *
     * @var array
     */
    protected $location = array('lat' => 0, 'lon' => 0);

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::LOCATION;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'location' => $this->getLocation()
        ));
    }

    /**
     * Get the value of Location coordinates.
     *
     * @return array
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of Location coordinates.
     *
     * @param array location [lat => 0, lon => 0]
     *
     * @return self
     */
    public function setLocation(array $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Set latitude coordinate part
     *
     * @param float $lat
     *
     * @return self
     */
    public function setLat($lat)
    {
        $this->location['lat'] = $lat;

        return $this;
    }

    /**
     * Set longitude coordinate part
     *
     * @param float $lon
     *
     * @return self
     */
    public function setLng($lon)
    {
        $this->location['lon'] = $lon;

        return $this;
    }
}
