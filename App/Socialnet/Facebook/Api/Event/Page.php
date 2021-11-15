<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Event;

use App\Socialnet\Facebook\Api as Api;

/**
 * Class Page
 *
 * @package Facebook\Api\Event
 *
 * Triggers when user send message from page
 */
class Page extends Api\Event
{
    protected $type = 'page';

    protected $id;

    protected $timeis;

    /**
     * @var array
     */
    protected $data = array();

    protected $_entry = array();

    /**
     * Init event from api array
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {

        $_entry = $properties['entry'][0];
        $this->id=$_entry['id'];
        $this->timeis=$_entry['time'];

        $_event = isset($_entry['standby']) ? $_entry['standby'][0] : $_entry['messaging'];

  	parent::__construct(  sizeof($_event)  ?  $_event : array());

    }

    public function toInit() {

        return $this;
    }

    public function getWho() {

        return $this->id == $this->sender->getId() ? \Core_Api::TAG_AGENT : \Core_Api::TAG_USER;
    }
}
