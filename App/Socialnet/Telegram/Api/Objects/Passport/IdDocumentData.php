<?php

namespace App\Socialnet\Telegram\Api\Objects\Passport;

use App\Socialnet\Telegram\Api\Objects\BaseObject;

/**
 * @property string $documentNo    Document number
 * @property string $expiryDate    Optional. Date of expiry, in DD.MM.YYYY format
 *
 * @link https://core.telegram.org/bots/api#iddocumentdata
 */
class IdDocumentData extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array();
    }
}
