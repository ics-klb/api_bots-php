<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Abstract\Integration\Signature.php, v1.03 2020/09/01 12:23:00 Exp $


/**
 * Class Signature
 *
 * @package Abstract\Socialnet
 */
abstract class App_Abstract_Socialnet_Signature
{
    /**
     * Make signature value
     *
     * @param  string $messageBody request body
     * @param  string $token       bot token
     * @return string              signature
     */
    public static function make($messageBody, $token)
    {
        return hash_hmac('sha256', $messageBody, $token);
    }

    /**
     * Is message signatore valid?
     *
     * @param  string  $sign        from request headers
     * @param  string  $messageBody from request body
     * @param  string  $token       bot access token
     * @return boolean              valid or not
     */
    public static function isValid($sign, $messageBody, $token)
    {
        return hash_equals($sign, self::make($messageBody, $token));
    }
}