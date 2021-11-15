<?php

namespace App\Socialnet\Telegram\Api\Objects;

/**
 * Class Animation.
 *
 * @property string    $fileId           Unique file identifier.
 * @property string    $fileUniqueId     Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int       $width            Video width as defined by sender.
 * @property int       $height           Video height as defined by sender.
 * @property int       $duration         Duration of the video in seconds as defined by sender.
 * @property PhotoSize $thumb            (Optional). Animation thumbnail as defined by sender.
 * @property string    $fileName         (Optional). Original animation filename as defined by sender.
 * @property string    $mimeType         (Optional). MIME type of the file as defined by sender.
 * @property int       $fileSize         (Optional). File size.
 */
class Animation extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'file_id'        => array( 'value' => null, 'type' => 'string'),
        'file_unique_id' => array( 'value' => null, 'type' => 'string'),
        'width'     => array( 'value' => null, 'type' => 'int'),
        'height'    => array( 'value' => null, 'type' => 'int'),
        'duration'  => array( 'value' => null, 'type' => 'int'),
        'thumb'     => array( 'value' => null, 'type' => 'string'),
        'file_name'   => array( 'value' => null, 'type' => 'string'),
        'mime_type'   => array( 'value' => null, 'type' => 'string'),
        'file_size'   => array( 'value' => null, 'type' => 'int')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'thumb' => 'PhotoSize',
        );
    }
}
