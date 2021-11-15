<?php

namespace App\Socialnet\Telegram\Api\Objects;

/**
 * Class Video.
 *
 *
 * @property string    $fileId         Unique identifier for this file.
 * @property string    $fileUniqueId   Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int       $width          Video width as defined by sender.
 * @property int       $height         Video height as defined by sender.
 * @property int       $duration       Duration of the video in seconds as defined by sender.
 * @property PhotoSize $thumb          (Optional). Video thumbnail.
 * @property string    $mimeType       (Optional). Mime type of a file as defined by sender.
 * @property int       $fileSize       (Optional). File size.
 */
class Video extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'file_id'        => array( 'value' => null, 'type' => 'string'),
        'file_unique_id' => array( 'value' => null, 'type' => 'string'),
        'width'          => array( 'value' => null, 'type' => 'int'),
        'height'         => array( 'value' => null, 'type' => 'int'),
        'duration'       => array( 'value' => null, 'type' => 'int'),
        'thumb'          => array( 'value' => null, 'type' => 'string'),
        'file_name'      => array( 'value' => null, 'type' => 'string'),
        'mime_type'      => array( 'value' => null, 'type' => 'string'),
        'file_size'      => array( 'value' => null, 'type' => 'int')
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

    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'events'    => 'media',
            'requests'  => array(
                0 => array(
                    'class'  => 'Account',
                    'method' => 'getFile',
                    'outtype'   => 'json',
                    'parameters'  => array( 'uri' => '[file_id]', 'file_id' => $this->_properties['file_id'])
                ),
                1 => array(
                    'class'  => 'Account',
                    'method' => 'getDownload',
                    'outtype'   => 'binary',
                    'parameters'    => array('uri'  => '[file_path]', 'method' => 'GET')
                )
            )
        ));
    }

}
