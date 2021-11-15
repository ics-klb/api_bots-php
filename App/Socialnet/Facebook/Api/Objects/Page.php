<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/Summary.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class Page (develop)
 *
 * @package Facebook\Api\Objects
 */
class Page extends BaseObject
{
    /**
     * @var array
     */
    protected $data = array();

    protected $_entry = array();

    protected function toInit() {

        foreach($this->_properties['entry'] as $field => $value )
            $this->_entry[$field] = new Entry($value);
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
