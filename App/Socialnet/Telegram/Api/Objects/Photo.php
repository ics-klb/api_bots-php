<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram\Api\Objects\Photo.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Objects;

/**
 * Class Photo of list
 *
 * @package Telegram\Api\Objects
 */
class Photo extends BaseObject
{

    protected $_elements = array();

    protected function toInit() {

        if (sizeof($this->_properties) ) {
            foreach($this->_properties as $field => $value )
                $this->_elements[$field] = new PhotoSize($value);
        }
    }

    public function toArray()
    {
        $_elements = array();
        foreach($this->_elements as &$value) {
            $_elements[] = $value->toArray();
        }

        return array( 'photos' => $_elements);
    }

}