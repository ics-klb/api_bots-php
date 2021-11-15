<?php

namespace App\Socialnet\Telegram\Api\Traits;

use App\Socialnet\Telegram\Api\Core;

/**
 * Class Telegram.
 */
trait Telegram
{
    /** @var Core Holds the Super Class Instance. */
    protected $telegram = null;

    /**
     * Returns Super Class Instance.
     *
     * @return Core
     */
    public function getTelegram()
    {
        return $this->telegram;
    }

    /**
     * Set Telegram Api Instance.
     *
     * @param Core $telegram
     *
     * @return $this
     */
    public function setTelegram(Core $telegram)
    {
        $this->telegram = $telegram;

        return $this;
    }
}
