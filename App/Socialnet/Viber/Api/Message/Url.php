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
 * Class Url
 *
 * @package Viber\Api
 */
class Url extends Api\Message
{
    /**
     * URL. Max 2,000 characters
     *
     * @var string
     */
    protected $media;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::URL;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'media' => $this->getMedia()
        ));
    }

    /**
     * Get the value of URL. Max 2,000 characters
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of URL. Max 2,000 characters
     *
     * @param string media
     *
     * @return self
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }
}
