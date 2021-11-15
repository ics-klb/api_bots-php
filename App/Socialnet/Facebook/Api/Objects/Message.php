<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/Message.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;

/**
 * Class Message
 *
 * @package Facebook\Api\Objects
 */
class Message extends BaseObject
{

    /**
     * @var null|string
     */
    protected $notification_type = null;

    /**
     * @var null|string
     */
    protected $messaging_type = null;

    /**
     * @var null|array
     */
    protected $quick_replies = null;

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'title'        => array( 'value' => null, 'type' => 'object', 'handler' => 'setTitle'),
        'text'        => array( 'value' => null, 'type' => 'object', 'handler' => 'setText'),
        'attachments' => array( 'value' => null, 'type' => 'object'),
        'postback'    => array( 'value' => null, 'type' => 'object')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'attachments' => 'Attachments',
            'postback'    => 'Postback'
        );
    }

    public function setTitle($value) {

            $this->_relations['title'] = new Text( array('text' => $value) );
        return $this;
    }

    public function setText($value) {

        $this->_relations['text'] = new Text( array('text' => $value) );
        return $this;
    }
    /**
     * Get the value of The text of the message
     *
     * @return string
     */
    public function getRelationTitle()
    {
        return $this->isRelations('title') ? $this->getRelations('title') : new Text();
    }

    public function getRelationText()
    {
        return $this->isRelations('text') ? $this->getRelations('text') : new Text();
    }

    public function getRelationAttachment()
    {
        return $this->isRelations('attachments') ? $this->getRelations('attachments') : new Attachments();
    }

    public function getRelationPostback()
    {
        return $this->isRelations('postback') ? $this->getRelations('postback') : new Postback();
    }

}
