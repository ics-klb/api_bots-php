<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Viber_Extended_Api, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Viber\Api\Message;

use App\Socialnet\Viber\Api as Api;

/**
 * Class Video
 *
 * @package Viber\Api
 *
 * Video as message
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Video extends Api\Message
{
    /**
     * URL of the video (MP4, H264)
     *
     * @var string
     */
    protected $media;

    /**
     * Size of the video in bytes
     *
     * @var integer
     */
    protected $size;

    /**
     * Filename of the video (MP4, H264)
     *
     * @var string
     */
    protected $file_name;

    /**
     * Video duration in seconds
     *
     * @var integer
     */
    protected $duration;

    /**
     * URL of a reduced size image (JPEG)
     *
     * @var string
     */
    protected $thumbnail;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::VIDEO;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'media' => $this->getMedia(),
            'size' => $this->getSize(),
            'duration' => $this->getDuration(),
            'thumbnail' => $this->getThumbnail()
        ));
    }

    /**
     * Get the value of URL of the video (MP4, H264)
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of URL of the video (MP4, H264)
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
     * Get the value of Size of the video in bytes
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of Size of the video in bytes
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
     * Get the value of Video duration in seconds
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set the value of Video duration in seconds
     *
     * @param integer duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get the value of URL of a reduced size image (JPEG)
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set the value of URL of a reduced size image (JPEG)
     *
     * @param string thumbnail
     *
     * @return self
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
