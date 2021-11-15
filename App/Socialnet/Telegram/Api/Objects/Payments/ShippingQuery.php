<?php

namespace App\Socialnet\Telegram\Api\Objects\Payments;

use App\Socialnet\Telegram\Api\Objects\BaseObject;
use App\Socialnet\Telegram\Api\Objects\User;

/**
 * @property string          $id                   Unique query identifier
 * @property User            $from                 User who sent the query.
 * @property string          $invoicePayload       Bot specified invoice payload
 * @property ShippingAddress $shippingAddress      User specified shipping address
 *
 * @link https://core.telegram.org/bots/api#shippingquery
 */
class ShippingQuery extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'from'             => User::class,
            'shipping_address' => ShippingAddress::class,
        );
    }
}
