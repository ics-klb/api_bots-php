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
 * Class Post
 *
 * @package App\Abstract\Socialnet
 */
class App_Abstract_Socialnet_Post
{
    private $_contenttype = Core_Api::FORMAT_TYPE_JSON;

    protected $_params = array( 'evname' => 'default',
                                'channel' => '',
                                'default'  => '',
                                'serverhost' => '',
                                'bgcallback' => '');
    /**
     * @var array
     */
    protected $_thread   = array();

    protected $_sender   = array();

    protected $_operator = array();

    protected $_user     = array();

    protected $_content  = array();

    public function prepareRequest($details){

        if (isset($details['evname']))   $this->_params['evname'] = $details['evname'];
        if (isset($details['channel']))  $this->_params['channel'] = $details['channel'];
        if (isset($details['default']))  $this->_params['default'] = $details['default'];

        if (isset($details['thread']))    $this->_thread   = $details['thread'];
        if (isset($details['user']))      $this->_user     = $details['user'];
        if (isset($details['sender']))    $this->_sender   = $details['sender'];
        if (isset($details['operator']))  $this->_operator = $details['operator'];
        if (isset($details['content_type']))  $this->_contenttype = $details['content_type'];
        if (isset($details['content'])) {

            $this->_content = $this->_contenttype == Core_Api::FORMAT_TYPE_JSON
                                ?  Core_Api::getInstance()->json_decode($details['content'])
                                : $details['content'];
        }
        return $this;
    }

    public function toArray()
    {
        return array(
            'evname'   => $this->_params['evname'],
            'channel'  => $this->_params['channel'],
            'default'  => $this->_params['default'],

            'thread'   => $this->_thread,
            'user'     => $this->_user,
            'sender'   => $this->_sender,
            'operator' => $this->_operator,

            'content_type'  => $this->_contenttype,
            'content'  => $this->_content
        );
    }

    public function getEvname() {

        return $this->_params['evname'];
    }

    public function setEvname($value) {

        $this->_params['evname'] = $value;
        return $this;
    }

    public function getDefault() {

        return $this->_params['default'];
    }

    public function setDefault($value) {

        $this->_params['default'] = $value;
        return $this;
    }

    public function getChannel() {
        return $this->_params['channel'];
    }

    public function setChannel($value) {

        $this->_params['channel'] = $value;
        return $this;
    }

    /**
     * Get Data
     *
     * @return array
     */
    public function getThread()
    {
        return $this->_thread;
    }

    public function setThread($value)
    {
        $this->_thread = $value;
        return $this;
    }

    /**
     * Get Content
     *
     * @return array
     */
    public function getContent($isone = true)
    {
        return isset($this->_content[0]) && $isone ? $this->_content[0] : $this->_content;
    }

    public function setContent($value)
    {
        $this->_content = $value;
        return $this;
    }

    /**
     * Get Sender
     *
     * @return array
     */
    public function getUser()
    {
        return $this->_user;
    }

    public function setUser($value)
    {
        $this->_user = $value;
        return $this;
    }

    /**
     * Get Sender
     *
     * @return array
     */
    public function getSender()
    {
        return $this->_sender;
    }

    public function setSender($value)
    {
        $this->_sender = $value;
        return $this;
    }

    /**
     * Get Operator
     *
     * @return array
     */
    public function getOperator()
    {
        return $this->_operator;
    }

    public function setOperator($value)
    {
        $this->_operator = $value;
        return $this;
    }
}