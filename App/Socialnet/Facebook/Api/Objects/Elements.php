<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/MessageElement.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class Elements of list
 *
 * @package Facebook\Api\Objects
 */
class Elements extends BaseObject
{

    protected $_elements = array();

    protected function toInit() {

        foreach($this->_properties as $field => $value )
            $this->_elements[$field] = new Element($value);
    }

    /**
     * Get Element data
     *
     * @return array
     */
    public function getData()
    {
        $result = array(
        );

        foreach($this->_elements as &$value) {
            $result[] = $value->getDAta();
        }
        return $result;
    }

}