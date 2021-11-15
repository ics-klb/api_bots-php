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
 * Class Poll.
 *
 * @package Telegram\Api
 *
 * @property string       $id                     Unique poll identifier
 * @property string       $question               Poll question, 1-255 characters.
 * @property PollOption[] $options                List of poll options
 * @property int          $totalVoterCount        Total number of users that voted in the poll
 * @property bool         $isClosed               True, if the poll is closed.
 * @property bool         $isAnonymous            True, if the poll is anonymous.
 * @property string       $type                   Poll type, currently can be “regular” or “quiz”
 * @property bool         $allowMultipleAnswers   True, if the poll allows multiple answers.
 * @property int          $correctOptionId        Optional. 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
 */
class Poll extends Api\Objects\Poll
{
    /**
     * The text of the message
     *
     * @var string
     */
    protected $text;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::POLL;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), array(
            'text' => !$this->text ? 'Unknow message data' : $this->text
        ));
    }


}
