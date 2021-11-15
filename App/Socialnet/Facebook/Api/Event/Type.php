<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Facebook_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Event;

/**
 * Available event types
 *
 */
interface Type
{
    const DELIVERED = 'delivered';

    const FAILED = 'failed';

    const SUBSCRIBED = 'subscribed';

    const UNSUBSCRIBED = 'unsubscribed';

    const PAGE = 'page';

    const MESSAGE = 'message';

    const WEBHOOK = 'webhook';

    const ACCOUNTINFO = 'accountinfo';

    const USERSONLINE  = 'usersonline';

    const USERDETAILS = 'userdetails';

    const UNKNOW = 'unknow';

    const ERROR = 'error';

}
