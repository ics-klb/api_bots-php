<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Telegram_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Telegram\Api\Message;

use App\Socialnet\Telegram\Api as Api;

/**
 * Class File
 *
 * @package Telegram\Api
 *
 * File as message
 */
class File extends Api\Message
{
    /**
     * URL of the file
     *
     * @var string
     */
    protected $media;

    /**
     * Size of the file in bytes
     *
     * @var integer
     */
    protected $size;

    /**
     * Name of the file.
     * File name should include extension.
     * Max 256 characters (including file extension)
     *
     * @var string
     */
    protected $file_name;

    /**
     * message type
     * @return [type] [description]
     */
    public function getType()
    {
        return Type::FILE;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'media' => $this->getMedia(),
            'size' => $this->getSize(),
            'file_name' => $this->getFileName()
        ));
    }

    /**
     * Get the value of URL of the file
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of URL of the file
     *
     * @param string media
     *
     * @return self
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get the value of Size of the file in bytes
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of Size of the file in bytes
     *
     * @param integer size
     *
     * @return self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of Name of the file.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set the value of Name of the file.
     *
     * @param string file_name
     *
     * @return self
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;

        return $this;
    }
}
