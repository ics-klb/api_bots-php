<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Abstract\Integration\Manager.php, v1.03 2020/09/01 12:23:00 Exp $


/**
 * Class Manager
 *
 * @package Abstract\Socialnet
 */
abstract class App_Abstract_Socialnet_Manager
{
    /**
     * Check if we trigger handler
     *
     * @var \Closure
     */
    protected $checker;

    /**
     * Handler function
     *
     * @var \Closure
     */
    protected $handler;

    /**
     * Create new event manager (event checker and event handler)
     *
     * @param  Closure $checker
     * @param  Closure $handler
     */
    public function __construct(\Closure $checker, \Closure $handler)
    {
        $this->checker = $checker;
        $this->handler = $handler;
    }

    /**
     * Get the value of Check if we trigger handler
     *
     * @return \Closure
     */
    public function getChecker()
    {
        return $this->checker;
    }

    /**
     * Get the value of Handler function
     *
     * @return \Closure
     */
    public function getHandler()
    {
        return $this->handler;
    }
}