<?php

namespace App\Socialnet\Telegram\Api\Objects;

/**
 * Class Document.
 *
 *
 * @property string    $fileId           Unique file identifier.
 * @property string    $fileUniqueId     Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property PhotoSize $thumb            (Optional). Document thumbnail as defined by sender.
 * @property string    $fileName         (Optional). Original filename as defined by sender.
 * @property string    $mimeType         (Optional). MIME type of the file as defined by sender.
 * @property int       $fileSize         (Optional). File size.
 */
class Document extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'file_id'     => array( 'value' => null, 'type' => 'string'),
        'file_name'   => array( 'value' => null, 'type' => 'string'),
        'file_size'   => array( 'value' => null, 'type' => 'string'),
        'file_unique_id'   => array( 'value' => null, 'type' => 'string'),
        'mime_type'   => array( 'value' => null, 'type' => 'string')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array();
    }

    public function toArray()
    {
        return array(
            'file_id'    => $this->_properties['file_id'],
            'file_name'  => $this->_properties['file_name'],
            'file_size'  => $this->_properties['file_size'],
            'file_unique_id'  => $this->_properties['file_unique_id'],
            'mime_type'      => $this->_properties['mime_type'],
            // Add
            'event'    => 'media',
            'requests'    => array(
                0 => array(
                    'class'  => 'Account',
                    'method' => 'getFile',
                    'outtype'   => 'json',
                    'parameters'  => array( 'file_id' => $this->_properties['file_id'], 'method' => 'POST')
                ),
                1 => array(
                    'class'  => 'Account',
                    'method' => 'getDownload',
                    'outtype'  => 'binary',
                    'parameters' => array( 'uri'  => '[file_path]', 'method' => 'GET')

                )
            )
        );
    }
}
