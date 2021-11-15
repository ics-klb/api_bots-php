<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\Message;

/**
 * Class Url
 *
 * @package Viber\Api
 *
 * Available message types
 */
interface Type
{
    const TEXT = 'text';

    const PICTURE = 'picture';

    const VIDEO = 'video';

    const FILE = 'file';

    const STICKER = 'sticker';

    const CONTACT = 'contact';

    const URL = 'url';

    const LOCATION = 'location';

    const RICH_MEDIA = 'rich_media';

    const ERROR = 'error';
}
