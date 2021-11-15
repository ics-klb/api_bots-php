<?php

namespace App\Socialnet\Telegram\Api\Objects;

use App\Socialnet\Telegram\Api\Objects\Passport\PassportData;
use App\Socialnet\Telegram\Api\Objects\Payments\Invoice;
use App\Socialnet\Telegram\Api\Objects\Payments\SuccessfulPayment;

/**
 * Class Message.
 *
 * @property int               $messageId              Unique message identifier.
 * @property User              $from                   (Optional). Sender, can be empty for messages sent to channels.
 * @property int               $date                   Date the message was sent in Unix time.
 * @property Chat              $chat                   Conversation the message belongs to.
 * @property User              $forwardFrom            (Optional). For forwarded messages, sender of the original message.
 * @property Chat              $forwardFromChat        (Optional). For messages forwarded from a channel, information about the original channel.
 * @property int               $forwardFromMessageId   (Optional). For forwarded channel posts, identifier of the original message in the channel.
 * @property string            $forwardSignature       (Optional). For messages forwarded from channels, identifier of the original message in the channel
 * @property string            $forwardSenderName      (Optional). Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
 * @property int               $forwardDate            (Optional). For forwarded messages, date the original message was sent in Unix time.
 * @property Message           $replyToMessage         (Optional). For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
 * @property int               $editDate               (Optional). Date the message was last edited in Unix time.
 * @property string            $mediaGroupId           (Optional). The unique identifier of a media message group this message belongs to
 * @property string            $authorSignature        (Optional). Signature of the post author for messages in channels
 * @property string            $text                   (Optional). For text messages, the actual UTF-8 text of the message, 0-4096 characters.
 * @property MessageEntity[]   $entities               (Optional). For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text.
 * @property MessageEntity[]   $captionEntities        (Optional). For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption.
 * @property Audio             $audio                  (Optional). Message is an audio file, information about the file.
 * @property Document          $document               (Optional). Message is a general file, information about the file.
 * @property Animation         $animation              (Optional). Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
 * @property Game              $game                   (Optional). Message is a game, information about the game.
 * @property PhotoSize[]       $photo                  (Optional). Message is a photo, available sizes of the photo.
 * @property Sticker           $sticker                (Optional). Message is a sticker, information about the sticker.
 * @property Video             $video                  (Optional). Message is a video, information about the video.
 * @property Voice             $voice                  (Optional). Message is a voice message, information about the file.
 * @property VideoNote         $videoNote              (Optional). Message is a video note, information about the video message.
 * @property string            $caption                (Optional). Caption for the document, photo or video, 0-200 characters.
 * @property Contact           $contact                (Optional). Message is a shared contact, information about the contact.
 * @property Location          $location               (Optional). Message is a shared location, information about the location.
 * @property Venue             $venue                  (Optional). Message is a venue, information about the venue.
 * @property Poll              $poll                   (Optional). Message is a native poll, information about the poll
 * @property User[]            $newChatMembers         (Optional). New members that were added to the group or supergroup and information about them (the bot itself may be one of these members).
 * @property User              $leftChatMember         (Optional). A member was removed from the group, information about them (this member may be the bot itself).
 * @property string            $newChatTitle           (Optional). A chat title was changed to this value.
 * @property PhotoSize[]       $newChatPhoto           (Optional). A chat photo was change to this value.
 * @property bool              $deleteChatPhoto        (Optional). Service message: the chat photo was deleted.
 * @property bool              $groupChatCreated       (Optional). Service message: the group has been created.
 * @property bool              $supergroupChatCreated  (Optional). Service message: the super group has been created.
 * @property bool              $channelChatCreated     (Optional). Service message: the channel has been created.
 * @property int               $migrateToChatId        (Optional). The group has been migrated to a supergroup with the specified identifier, not exceeding 1e13 by absolute value.
 * @property int               $migrateFromChatId      (Optional). The supergroup has been migrated from a group with the specified identifier, not exceeding 1e13 by absolute value.
 * @property Message           $pinnedMessage          (Optional). Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
 * @property Invoice           $invoice                (Optional). Message is an invoice for a payment, information about the invoice.
 * @property SuccessfulPayment $successfulPayment      (Optional). Message is a service message about a successful payment, information about the payment.
 * @property string            $connectedWebsite       (Optional). The domain name of the website on which the user has logged in.
 * @property PassportData      $passportData           (Optional). Telegram Passport data
 * @property string            $replyMarkup            (Optional). Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
 */
class Message extends BaseObject
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
    protected $propertiesMap = array(
        'text'        => array( 'value' => null, 'type' => 'object', 'handler' => 'setText'),
        'from'        => array( 'value' => null, 'type' => 'object'),
        'chat'        => array( 'value' => null, 'type' => 'object'),
        'photo'       => array( 'value' => null, 'type' => 'object'),
        'document'    => array( 'value' => null, 'type' => 'object'),
        'voice'       => array( 'value' => null, 'type' => 'object'),
        'video'       => array( 'value' => null, 'type' => 'object'),
        'audio'       => array( 'value' => null, 'type' => 'object')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array(
            'from'               => 'User',
            'chat'               => 'Chat',
            'forward_from'       => 'User',
            'forward_from_chat'  => 'Chat',
            'reply_to_message'   => 'Message',
            'entities'           => 'MessageEntity',
            'caption_entities'   => 'MessageEntity',
            'audio'              => 'Audio',
            'document'           => 'Document',
            'animation'          => 'Animation',
            'game'               => 'Game',
            'photo'              => 'Photo',
            'sticker'            => 'Sticker',
            'video'              => 'Video',
            'voice'              => 'Voice',
            'video_note'         => 'VideoNote',
            'contact'            => 'Contact',
            'location'           => 'Location',
            'venue'              => 'Venue',
            'poll'               => 'Poll',
            'new_chat_members'   => 'User',
            'left_chat_member'   => 'User',
            'new_chat_photo'     => 'Photo',
            'pinned_message'     => 'Message',
            'invoice'            => 'Invoice',
            'successful_payment' => 'SuccessfulPayment',
            'passport'           => 'PassportData'
        );
    }

    /**
     * Build array single-level array
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            'sender'   => $this->getUser()->toArray(),
            'text'     => $this->getText(),
        );
    }

    public function getUser() {

        return $this->getRelations('from');
    }

    public function relationFile() {

        return $this->getRelations('document');
    }

    public function relationVoice() {

        return $this->getRelations('voice');
    }

    public function relationChat() {

        return $this->getRelations('chat');
    }

    public function relationPhoto() {

        return $this->getRelations('photo');
    }

    public function relationVideo() {

        return $this->getRelations('video');
    }
    /**
     * Get the value of The text of the message
     *
     * @return string
     */
    public function getRelationText()
    {
        return $this->isRelations('text') ? $this->getRelations('text') : new Text();
    }
    /**
     * Get the value of The text of the message
     *
     * @return string
     */
    public function getText()
    {
//_develop("TEXT 1 %s", $this->text); _develop("TEXT 2 %s", $this->_properties['text']);
        return $this->getRelationText()->getText();
    }

    public function setText($value) {

        $this->_relations['text'] = new Text( array('text' => $value) );

        return $this;
    }

}
