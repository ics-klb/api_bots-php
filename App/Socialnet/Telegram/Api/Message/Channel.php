<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Message;

use App\Socialnet\Telegram\Api as Api;

/**
 * Class Channel
 *
 * @package Telegram\Api
 * Text-only message
 */
class Channel extends Api\Message
{
    /**
     * The text of the message
     *
     * @var string
     */
    protected $text;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::CHANNEL;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'text' => $this->getText()
        ));
    }

    /**
     * Get the value of The text of the message
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of The text of the message
     *
     * @param string text
     *
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
