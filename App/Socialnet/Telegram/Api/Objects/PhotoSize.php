<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram\Api\Objects\PhotoSize.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Objects;

/**
 * Class PhotoSize.
 *
 *
 * @property string $fileId         Unique identifier for this file.
 * @property string $fileUniqueId   Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
 * @property int    $width          Photo width.
 * @property int    $height         Photo height.
 * @property int    $fileSize       (Optional). File size.
 */
class PhotoSize extends BaseObject
{

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'file_id'     => array( 'value' => null, 'type' => 'string'),
        'file_size'   => array( 'value' => null, 'type' => 'string'),
        'width'       => array( 'value' => null, 'type' => 'integer'),
        'height'      => array( 'value' => null, 'type' => 'integer')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array();
    }

    public function toApiArray()
    {
        return array(
            'file_id'    => $this->_properties['file_id'],
            'file_size'  => $this->_properties['file_size'],
            'width'      => $this->_properties['width'],
            'height'     => $this->_properties['height']
        );
    }

    public function toArray()
    {
        return array(
          'file_id'    => $this->_properties['file_id'],
          'file_size'  => $this->_properties['file_size'],
          'width'      => $this->_properties['width'],
          'height'     => $this->_properties['height'],
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
