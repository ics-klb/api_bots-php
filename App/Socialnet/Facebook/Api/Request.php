<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api;

/**
 * Class Request
 *
 * @package Facebook\Api
 *
 * Manage backend response, translate api error ot exception
 */
class Request extends \App_Abstract_Socialnet_Request
{
    const TYPE = 'json';

    /**
     * Api endpoint base
     *
     * @var string
     */
    const CORE_URI = 'https://graph.facebook.com/';

    protected  $relative_url = array('v8.0');

    /**
     * Create api request. Options:
     */
    public function __construct($options)
    {
        if (isset($options['relative_url']))
            $this->relative_url = $options['relative_url'] ;

        if (isset($options['base_uri']))
            $this->base_uri = $options['base_uri'];
        else
            $this->base_uri = static::CORE_URI;
    }

    public function getType() {

        return static::TYPE;
    }

    public function getRequestUrl() {

        return $this->getBaseUrl() . $this->getRelativeUrl();
    }

    public function getUrl() {

        return array(
            'base_uri' => $this->getBaseUrl(),
            'requesturl' => $this->getRequestUrl(),

            'scheme'  => 'https',
            'host' => false,
            'port' => '443'
        );
    }
}