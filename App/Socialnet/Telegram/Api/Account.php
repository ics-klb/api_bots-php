<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $


namespace App\Socialnet\Telegram\Api;

/**
 * Class Account
 *
 * @package Telegram\Api
 * Api entity interface
 */
class Account extends \App_Abstract_Socialnet_Account
{

    protected $authentication = array(
        'type' => 'token'
    );

    /**
     * Create api account. Options:
     * token  required  string  authentication token
     * http   optional  array   adapter parameters
     *
     * @throws Exceptions\CoreSDKException
     * @param array $options
     */
    public function __construct($options)
    {
        if (!isset($options['token'])) {
            $this->thrownException('No token provided');
        }
        $this->token = $options['token'];

        $this->_properties = $options;

        if (isset($options['callback']) )
            $this->_properties['callback'] = $options['callback'];
    }

    public function getAuthentication() {
        return $this->authentication;
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    public function getCallbackUrl()
    {
        return $this->_properties['callback'];
    }

    public function sendRequest($request = null){

        if ( isnull($request) ) $request = $this->getRequest();

        $details = $request->toArray();

        $_result = array(
            'uri'    => $details['url']['requesturl'] . $this->token.'/' . $details['params']['uri'],
            'method' => $details['method'],
            'type'    => $details['type'],
            'headers' => $details['headers'],
            'body'    => $details['params']['content'],

            'callback'  => $details['params']['callback']
        );

        $this->request = null;

        return $_result;
    }

    public function getRequest()
    {
        if ( !$this->request instanceof Request)
        {
            $this->setReguest();
        }
        return $this->request;
    }

    public function setRequest($request = null, $options = array() )
    {
        if ( $request && $request instanceof Request) {

            $this->request = $request;
        } elseif ( \isnull($this->request) ) {

            $this->request = new Request();

            $this->request
               ->setMethod('POST')
               ->setParams(array(
                        'get'  => array(),
                        'post' => array(),
                        'proxy' => isset($this->_properties['proxy']) ? $this->_properties['proxy'] : null,
                        'authentication' => $this->authentication
                    )
                );
        }
        return $this;
    }

    public function getMedia($options) {

        $_parameters = array();
            $_method = $options['file_path'];
            $_uri = array(
                'relative_url' => array('file')
            );
        return $this->call($_method, $_parameters, $_uri);
    }

    public function getDownload($options) {

        $this->request = new Media\Download();

        $this->request
            ->setMethod('GET')
            ->setParams(array(
                    'get'  => array(),
                    'post' => array(),
                    'proxy' => isset($this->_properties['proxy']) ? $this->_properties['proxy'] : null,
                    'authentication' => $this->authentication
                )
            );

        $this->request->setParams( array( 'uri'  => $options['uri']));

        return $this;
    }

    public function getFile($options) {
        $_parameters = array();
            $_parameters['file_id'] = $options['file_id'];
        return $this->call('getFile', $_parameters);
    }

    /**
     * Set webhook url.
     *
     * For security reasons only URLs with valid and * official SSL certificate
     * from a trusted CA will be allowed.
     *
     * @see    Event\Type
     * @throws Exceptions\CoreSDKException
     * @param string $url webhook url
     * @param array|null $eventTypes subscribe to certain events
     * @return Account
     */
    public function getWebhook($url = false) {

        $_parameters = array();
        if ($url) $_parameters['url'] = $url;

        return $this->call('getWebhookInfo', $_parameters);
    }

    public function setWebhook($url, $eventTypes = null)
    {
        if (empty($url) || !preg_match('|^https://.*|s', $url)) {

            $this->thrownException('Invalid webhook url: ' . $url);
        }

        $_parameters = array();
            $_parameters['url'] = $url;
            //$_parameters['certificate'] = '';
        return $this->call('setWebhook', $_parameters);
    }

    /**
     * Fetch the public account’s details as registered in Telegram
     *
     * @throws Exceptions\CoreSDKException
     * @return Account
     */
    public function getAccountInfo()
    {
        return $this->call('get_account_info', array(1 => 1) );
    }

    /**
     * Process the update object for a command using the getUpdates method.
     *
     * @throws Exceptions\CoreSDKException
     * @return Account
     */

    public function getUpdates() {

        return $this->call('getUpdates', array() );
    }

    /**
     * Fetch the details of a specific Telegram user based on his unique user ID.
     *
     * The user ID can be obtained from the callbacks sent to the PA regrading
     * user's actions. This request can be sent twice during a 12 hours period
     * for each user ID.
     *
     * @throws Exceptions\CoreSDKException
     * @param string $userId
     * @return Account
     */
    public function getUserDetails($userId)
    {
        return $this->call('get_user_details', array(
            'id' => $userId
        ));
    }

    /**
     * Fetch the online status of a given subscribed PA members.
     *
     * The API supports up to 100 user id per request and those users must be
     * subscribed to the PA.
     *
     * @throws Exceptions\CoreSDKException
     * @param  array $userIds list of user ids
     * @return Account
     */
    public function getOnlineStatus(array $userIds)
    {
        return $this->call('getMe', array(
            'ids' => $userIds
        ));
    }

    /**
     * Send messages to Telegram users who subscribe to the PA.
     *
     * @param  Message $message
     * @return Account
     */
    public function sendMessage(Message $message)
    {
        return $this->call('sendMessage', $message->toApiArray());
    }

    /**
     * Call api method
     *
     * @throws Exceptions\CoreSDKException
     * @param  string $method method name
     * @param  mixed $data method data
     * @param  mixed $options method data
     * @return Account
     */
    public function call($method, $data, $options = array() )
    {
        try {
_develop('ACCOUNT CALL--------'); _develop($data);
            $this->setRequest($options);
            $this->request->setParams(
                    array(
                        'uri'  => $method,
                        'content' => $data,
                        'callback' => $this->getCallbackUrl()
                    )
                );

        } catch (\RuntimeException $e) {

            $this->thrownException($e->getMessage(), $e);
        }

        return $this;
    }

    /**
     * Instantiates an exception to be thrown later.
     */
    public function thrownException($message, $exception = null)
    {
        if ($exception instanceof \RuntimeException)
        {

            throw new Exceptions\CoreSDKException($message, $exception->getCode(), $exception);
        } else {

            throw new Exceptions\CoreSDKException($message);
        }
    }

}