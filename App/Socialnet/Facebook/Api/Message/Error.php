<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Message;

use App\Socialnet\Facebook\Api as Api;

/**
 * Class Error
 *
 * @package Facebook\Api
 */
class Error extends Api\Message
{
    /**
     * The text of the message
     *
     * @var string
     */
    protected $text;

    /**
     * The text of the error
     *
     * @var string
     */
    protected $exception;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::ERROR;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'text' => !$this->text ? 'Unknow message data' : $this->text
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
