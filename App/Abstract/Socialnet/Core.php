<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Abstract\Integration\Core.php, v1.03 2020/09/01 12:23:00 Exp $


/**
 * Class Core
 *
 * @package Abstract\Socialnet
 */
abstract class App_Abstract_Socialnet_Core
{
    /** @var array */
    protected $_symbolsToIgnore = array('+', '(', ')', '-', ' ');

    /**
     * Api account
     *
     * @var Account
     */
    protected $account;

    /**
     * Event managers collection
     *
     * @var array
     */
    protected $managers = array();

    abstract public function getAccount();

    abstract public function getUser();

    abstract public function outputRequest();

    abstract public function throwException($message, $level = null);

    /**
     * Register event handler callback
     *
     * @param \Closure $handler handler function
     *
     * @return Core
     */
    abstract public function on(\Closure $handler);

    /**
     * Register error handler callback
     *
     * @param \Closure $handler handler function
     *
     * @return Core
     */
    abstract public function onError(\Closure $handler);

    /**
     * @return string|null
     */
    public function validatePhoneNumber($phone)
    {
        $phone = str_replace($this->_symbolsToIgnore, "", trim($phone));
        if (false === is_numeric($phone)) {
            return null;
        }

        return $phone;
    }

    /**
     * Magic method to process any dynamic method calls.
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {

        if (method_exists($this, $method)) {
            return call_user_func_array( array($this, $method), $arguments);
        }

        //If the method does not exist on the API, try the commandBus.
        if (preg_match('/^\w+Commands?/', $method, $matches)) {
            return call_user_func_array( array($this->getCommandBus(), $matches[0]), $arguments);
        }

        $this->throwException("Method [$method] does not exist.");
    }


    public function getCommandBus()
    {
        return null;
    }
}