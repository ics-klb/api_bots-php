<?php

namespace App\Socialnet\Telegram\Api\Objects\Payments;

use App\Socialnet\Telegram\Api\Objects\BaseObject;

/**
 * @property string          $name                 (Optional). User name
 * @property string          $phoneNumber          (Optional). User's phone number
 * @property string          $email                (Optional). User email
 * @property ShippingAddress $shippingAddress      (Optional). User shipping address
 *
 * @link https://core.telegram.org/bots/api#orderinfo
 */
class OrderInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'shipping_address' => ShippingAddress::class,
        );
    }
}
