<?php

namespace App\Socialnet\Telegram\Api\Objects\Payments;

use App\Socialnet\Telegram\Api\Objects\BaseObject;

/**
 * @property string         $id        Shipping option identifier.
 * @property string         $title     Option title.
 * @property LabeledPrice[] $prices    List of price portions.
 *
 * @link https://core.telegram.org/bots/api#shippingoption
 */
class ShippingOption extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'prices' => LabeledPrice::class,
        );
    }
}
