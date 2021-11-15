<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api_Core, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api;

/**
 * Class Core
 *
 * @package Telegram\Api
 *
 * Api entity interface
 */
class Core
        extends \App_Abstract_Socialnet_Core
{
    /** @var string Version number of the Telegram Bot PHP SDK. */
    const VERSION = '2.3.8';

    /** @var string The name of the environment variable that contains the Telegram Bot API Access Token. */
    const BOT_TOKEN_ENV_NAME = 'VIBER_BOT_TOKEN';

    /**
     * @var response from http-response
     */
    protected $response = null;

    protected $sender = null;

    /**
     * Create core for account. Options:
     * token  required  string  authentication token
     * http   optional  array   adapter parameters
     *
     * @param array $options
     * @throws CoreSDKException
     */
    public function __construct($options)
    {
        if (isset($options['account'])) {
            $this->setAccount($options['account']);
        }
        if (isset($options['user'])) {
            $this->setUser($options['user']);
        }
        if (isset($options['sender'])) {
            $this->setSender($options['sender']);
        }
    }

    /**
     * Get viber input stream
     *
     * @return string
     */
    public function getBody()
    {
        return $this->response instanceof Response
            ? $this->response->getDecodedBody()
            : array();
    }

    /**
     * Get viber stream
     *
     * @return string
     */
    public function isResponse()
    {
        return $this->response instanceof Response;
    }

    /**
     * Get viber stream
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * set viber stream
     *
     * @return string
     */
    public function setResponse(Response $response)
    {
            $this->response = &$response;
        return $this;
    }

    /**
     * Get HyberIm Request
     *
     * @return string
     */
    public function getRequest()
    {
        if ( !$this->account instanceof Account ) {

            $this->throwException('Empty account');
        }
        return $this->account->getRequest();
    }

    /**
     * Get current account
     *
     * @return account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set account
     *
     * @return account
     */
    public function setAccount($account)
    {
        if (isset($account['token'])) {

            $this->account = new Account($account);
        } elseif (isset($account['account']) && $account['account'] instanceof account) {

            $this->account = &$account['account'];
        } else {

            $this->throwException('Specify "account" or "token" parameter');
        }
        return $this;
    }

    /**
     * Get current user
     *
     * @return account
     */
    public function getUser()
    {
        if ( !$this->user instanceof User) {

            $this->throwException('Empty user');
        }
        return $this->user;
    }

    /**
     * Set account
     *
     * @return self
     */
    public function setUser($items = array())
    {
            $this->user = new User($items);
        return $this;
    }

    /**
     * Get current sender
     *
     * @return account
     */
    public function getSender()
    {
        if ( !$this->sender instanceof Sender) {

            $this->throwException('Empty user');
        }
        return $this->sender;
    }

    /**
     * Set sender
     *
     * @return self
     */
    public function setSender($items = array())
    {
        $this->sender = new Sender($items);
        return $this;
    }

    /**
     * Get signature header
     *
     * @return string
     * @throws CoreSDKException
     */
    public function getSignHeaderValue()
    {
        $signature = '';
        if (isset($_SERVER['HTTP_X_VIBER_CONTENT_SIGNATURE'])) {

            $signature = $_SERVER['HTTP_X_VIBER_CONTENT_SIGNATURE'];
        } elseif (isset($_GET['sig'])) {

            $signature = $_GET['sig'];
        }

        if (empty($signature)) {

            $this->throwException('Signature header not found', 1);
        }
        return $signature;
    }

    /**
     * Request with data
     *
     * @param Entity $entity
     * @return void
     */
    public function outputRequest()
    {
        $body = $this->getRequest()->toArray();
_develop('_core->sendMessage BODY:'); _develop($body);
        return $body;
    }

    /**
     * Response with entity
     *
     * @param Entity $entity
     * @return void
     */
    public function outputEntity(Entity $entity)
    {
        header('Content-Type: application/json');
        $body = \Core_Api::json_encode($entity->toApiArray());
_develop('_core->outputEntity BODY:'); _develop($body);
        echo $body;
    }

    /**
     * Register event handler callback
     *
     * @param \Closure $handler handler function
     *
     * @return Core
     */
    public function on(\Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) {
            return !($event instanceof Event\Error);
        }, $handler);
        return $this;
    }

    /**
     * Register error handler callback
     *
     * @param \Closure $handler handler function
     *
     * @return Core
     */
    public function onError(\Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) {
            return ($event instanceof Event\Error);
        }, $handler);
        return $this;
    }

    /**
     * Register text message handler by PCRE
     *
     * @param string $regexp valid regular expression
     * @param Closure $handler event handler
     * @return Core
     */
    public function onText($regexp, \Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) use ($regexp) {
            return (
                $event instanceof Event\Message
                && $event->getMessage() instanceof Message\Text
                && preg_match($regexp, $event->getMessage()->getText())
            );
        }, $handler);

        return $this;
    }

    /**
     * Register subscrive event handler
     *
     * @param Closure $handler valid function
     * @return Core
     */
    public function onSubscribe(\Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) {

            return ($event instanceof Event\Subscribed);
        }, $handler);
        return $this;
    }

    /**
     * Register Unsubscribed event handler
     *
     * @param Closure $handler valid function
     * @return Core
     */
    public function onUnsubscribed(\Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) {

            return ($event instanceof Event\Unsubscribed);
        }, $handler);
        return $this;
    }

    /**
     * Register conversation event handler
     *
     * @param Closure $handler valid function
     * @return Core
     */
    public function onConversation(\Closure $handler)
    {
        $this->managers[] = new Manager(function (Event $event) {

            return ($event instanceof Event\Conversation);
        }, $handler);
        return $this;
    }

    /**
     * Start bot commonEvent
     *
     * @throws \RuntimeException
     * @param  Event $event start bot with some event
     * @return Core
     */
    public function commonEvent($event = null)
    {
        if (!$event instanceof Event) {

            $this->throwException('Event must be instance of \App\Socialnet\Telegram\Api\Event', 4);
        }

        // main bot loop
        foreach ($this->managers as $manager)
        {
            if ($manager->isMatch($event))
            {
                $returnValue = $manager->runHandler($event);

                if ($returnValue && $returnValue instanceof Entity)
                { // reply with entity
                    $this->outputEntity($returnValue);
                }
                break;
            }
        }
        return $this;
    }

    /**
     * Start bot process
     *
     * @throws \RuntimeException
     * @param  Event $event start bot with some event
     * @return Core
     */

    public function process($event = null)
    {
        if (is_null($event)) {
            // check body
            $eventBody = $this->getBody();

            // make event from json
            $event = Event\Factory::makeFromApi($eventBody);
        } elseif (!$event instanceof Event) {

            $this->throwException('Event must be instance of \App\Socialnet\Telegram\Api\Event', 4);
        }

        $this->commonEvent($event);

        return $this;
    }

    /**
     * Throws the exception.
     *
     * @throws CoreSDKException
     */
    public function throwException($message, $level = null)
    {

        throw new Exceptions\CoreSDKException($message, $level);
    }

}