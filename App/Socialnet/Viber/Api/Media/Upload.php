<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\Media;

use App\Socialnet\Viber\Api as Api;

/**
 * Class Upload
 *
 * @package Viber\Api
 *
 * Manage backend response, translate api error ot exception
 */
class Upload extends Api\Request
{
    const TYPE = 'binary';

    protected  $relative_url = '';

    public function getRequestUrl() {

        return $this->getRelativeUrl();
    }

    public function getRelativeUrl() {

        return $this->relative_url;
    }

}