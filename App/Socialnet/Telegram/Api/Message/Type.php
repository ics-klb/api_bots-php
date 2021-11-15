<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Message;

/**
 * Class Type
 *
 * @package Telegram\Api
 *
 * Available message types
 */
interface Type
{
    const CHANNEL = 'channel';

    const USER = 'user';

    const CHAT = 'chat';

    const TEXT = 'text';

    const PHOTO   = 'photo';

    const PICTURE = 'picture';

    const VIDEO = 'video';

    const POLL  = 'poll';

    const FILE = 'file';

    const STICKER = 'sticker';

    const CONTACT = 'contact';

    const URL = 'url';

    const LOCATION = 'location';

    const RICH_MEDIA = 'rich_media';

    const UNKNOW = 'unknow';

    const ERROR = 'error';
}
