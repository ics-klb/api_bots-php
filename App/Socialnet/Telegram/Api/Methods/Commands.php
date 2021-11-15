<?php

namespace App\Socialnet\Telegram\Api\Methods;

use App\Socialnet\Telegram\Api\Traits\Http;
use App\Socialnet\Telegram\Api\Objects\BotCommand;
use App\Socialnet\Telegram\Api\Exceptions\CoreSDKException;

/**
 * Class Commands.
 * @mixin Http
 */
trait Commands
{

    /**
     * Get the current list of the bot's commands.
     *
     * @link https://core.telegram.org/bots/api#getmycommands
     *
     * @return BotCommand[]
     * @throws CoreSDKException
     */
    public function getMyCommands(): array
    {
        $response = $this->get('getMyCommands');

        return collect($response->getResult())
            ->map(function ($botCommand) {
                return new BotCommand($botCommand);
            })
            ->all();
    }

    /**
     * Change the list of the bot's commands.
     *
     * <code>
     * $params = [
     *   'commands'              => '',
     * ];
     * </code>
     *
     * @link https://core.telegram.org/bots/api#setmycommands
     *
     * @param array $params   [
     *
     * @var array   $commands Required. A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
     *
     * ]
     *
     * @throws CoreSDKException
     *
     * @return Bool
     */
    public function setMyCommands(array $params): Bool
    {
        $params['commands'] = json_encode($params['commands']);

        return $this->post('setMyCommands', $params)->getResult();
    }
}
