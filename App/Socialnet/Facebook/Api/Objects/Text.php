<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Objects, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

use App\Socialnet\Facebook\Api\Message\Type;

/**
 * Class Text
 *
 * @package Facebook\Api
 * Text-only message
 */
class Text extends BaseObject
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
        return Type::TEXT;
    }

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'id'    => array( 'value' => null, 'type' => 'object',    'handler' => 'setId'),
        'text'  => array( 'value' => null, 'type' => 'object',    'handler' => 'setText')
    );

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
     * Get the value of Unique Facebook user id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($value)
    {
_error('setText => %s', $value);
        $this->text = $value;

        return $this;
    }
}
