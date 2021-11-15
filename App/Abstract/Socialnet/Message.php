<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Abstract\Integration\Client.php.php, v1.03 2020/09/01 12:23:00 Exp $

/**
 * Class Message
 *
 * @package App\Abstract\Socialnet
 */
class App_Abstract_Socialnet_Message
{
    /**
     * @var array
     */
    protected $data = array();

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