<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api/UserProfile.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api;

class UserProfile
{
    protected $data = array();

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getFirstName()
    {
        return isset($this->data['first_name']) ? $this->data['first_name'] : null;
    }

    public function getLastName()
    {
        return isset($this->data['last_name']) ? $this->data['last_name'] : null;
    }

    public function getPicture()
    {
        return isset($this->data['profile_pic']) ? $this->data['profile_pic'] : null;
    }

    public function getLocale()
    {
        return isset($this->data['locale']) ? $this->data['locale'] : null;
    }

    public function getTimezone()
    {
        return isset($this->data['timezone']) ? $this->data['timezone'] : null;
    }

    public function getGender()
    {
        return isset($this->data['gender']) ? $this->data['gender'] : null;
    }

    /**
     * Get Data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
