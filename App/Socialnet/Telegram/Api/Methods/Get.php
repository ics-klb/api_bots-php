<?php

namespace App\Socialnet\Telegram\Api\Methods;

use App\Socialnet\Telegram\Api\Exceptions\CoreSDKException;
use App\Socialnet\Telegram\Api\Objects\File;
use App\Socialnet\Telegram\Api\Objects\User;
use App\Socialnet\Telegram\Api\Objects\UserProfilePhotos;
use App\Socialnet\Telegram\Api\Traits\Http;

/**
 * Class Get.
 * @mixin Http
 */
trait Get
{
    /**
     * A simple method for testing your bot's auth token.
     * Returns basic information about the bot in form of a User object.
     *
     * @link https://core.telegram.org/bots/api#getme
     *
     * @throws CoreSDKException
     *
     * @return User
     */
    public function getMe(): User
    {
        $response = $this->get('getMe');

        return new User($response->getDecodedBody());
    }

    /**
     * Returns a list of profile pictures for a user.
     *
     * <code>
     * $params = [
     *   'user_id' => '',
     *   'offset'  => '',
     *   'limit'   => '',
     * ];
     * </code>
     *
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     *
     * @param array $params [
     *
     * @var int $user_id Required. Unique identifier of the target user
     * @var int $offset  Optional. Sequential number of the first photo to be returned. By default, all photos are returned.
     * @var int $limit   Optional. Limits the number of photos to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     *
     * ]
     *
     * @throws CoreSDKException
     *
     * @return UserProfilePhotos
     */
    public function getUserProfilePhotos(array $params): UserProfilePhotos
    {
        $response = $this->get('getUserProfilePhotos', $params);

        return new UserProfilePhotos($response->getDecodedBody());
    }

    /**
     * Returns basic info about a file and prepare it for downloading.
     *
     * <code>
     * $params = [
     *   'file_id' => '',
     * ];
     * </code>
     *
     * The file can then be downloaded via the link
     * https://api.telegram.org/file/bot<token>/<file_path>,
     * where <file_path> is taken from the response.
     *
     * @link https://core.telegram.org/bots/api#getFile
     *
     * @param array $params [
     *
     * @var string $file_id Required. File identifier to get info about
     *
     * ]
     *
     * @throws CoreSDKException
     *
     * @return File
     */
    public function getFile(array $params): File
    {
        $response = $this->get('getFile', $params);

        return new File($response->getDecodedBody());
    }
}
