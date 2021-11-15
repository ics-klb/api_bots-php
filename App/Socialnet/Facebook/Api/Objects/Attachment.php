<?php

// +-------------------------------------------------------------------------+
// | Copyright (c) 2008 - 2020 LLC ICS, Development Center (www.icstime.com) |
// | license   http://www.gnu.org/licenses/agpl.html AGPL Version 3          |
// | Written by:  KoloBizCom                                                 |
// | Version 2.3.8                                                           |
// | Created by Denys P. Zherebyatyev                                        |
// +-------------------------------------------------------------------------+-
// | $Id: Api_Messages/Attachment.php, v1.03 2020/09/01 12:23:00 Exp $

namespace App\Socialnet\Facebook\Api\Objects;
/**
 * Class Attachment
 *
 * @package Facebook\Api\Objects
 */
class Attachment extends BaseObject
{
    const TYPE_IMAGE = 'image';
    const TYPE_AUDIO = 'audio';
    const TYPE_VIDEO = 'video';
    const TYPE_FILE  = 'file';
    const TYPE_LOCATION = 'location';

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $fileData;

    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'type'       => array( 'value' => null, 'type' => 'string', 'handler' => 'setType'),
        'payload'    => array( 'value' => null, 'type' => 'object', 'handler' => 'setPayload')
    );

    /**
     * {@inheritdoc}
     */
//    public function relations()
//    {
//        return array(
//            'payload'   => 'Payload',
//        );
//    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getPayload()
    {
//        return $this->getRelations('payload');
    }

    /**
     * @param array $payload
     */
    public function setPayload($payload)
    {
//        $this->_relations['payload'] = $payload;
        $this->payload=$payload;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileData()
    {
        return $this->fileData;
    }

    /**
     * @param string $fileData
     */
    public function setFileData($fileData)
    {
        $this->fileData = $fileData;
    }

    public function toArray()
    {
        return array(
            'url'     => $this->payload['url'],
            'type' => $this->type,

            // Add
            'event'    => 'media',
            'requests'    => array(
                0 => array(
                    'class'  => 'Account',
                    'method' => 'getDownload',
                    'outtype'   => 'binnary',
                    'parameters'  => array( 'uri' => $this->payload['url'], 'method' => 'GET')
                )
            )
        );
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = array(
            'attachment' => array(
                'type' => $this->type,
                'url' => $this->payload['url'],
                'payload' => $this->payload
            )
        );

        foreach ($this->quick_replies as $qr) {
            $data['quick_replies'][] = $qr->getData();
        }

        if (!empty($this->fileData)) {
            $data['filedata'] = $this->fileData;
        }
        return $data;
    }
}
