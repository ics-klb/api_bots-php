<?php

namespace App\Socialnet\Telegram\Api\Objects;

use App\Socialnet\Telegram\Api\Message\Type;

/**
 * Class User.
 *
 *
 * @property int    $id             Unique identifier for this user or bot.
 * @property bool   $isBot          True, if this user is a bot
 * @property string $firstName      User's or bot's first name.
 * @property string $lastName       (Optional). User's or bot's last name.
 * @property string $username       (Optional). User's or bot's username.
 * @property string $languageCode   (Optional). IETF language tag of the user's language
 */
class User extends BaseObject
{
    protected $id;

    protected $login;

    protected $fistname;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::USER;
    }
    /**
     * {@inheritdoc}
     */
    protected $propertiesMap = array(
        'id' => array( 'value' => null,         'type' => 'string',  'handler' => 'setId'),
        'is_bot' => array( 'value' => null,     'type' => 'int'),
        'first_name' => array( 'value' => null, 'type' => 'string',  'handler' => 'setName'),
        'last_name' => array( 'value' => null,  'type' => 'string',   'handler' => 'setLastname'),
        'username' => array( 'value' => null,    'type' => 'string',    'handler' => 'setLogin'),
        'language_code' => array( 'value' => null, 'type' => 'string', 'handler' => 'setLanguage')
    );

    /**
     * {@inheritdoc}
     */
    public function relations()
    {
        return array();
    }

    /**
     * Build array single-level array
     *
     * @return array
     */
    public function toArray()
    {

        return array(
            'id' => $this->getId(),
            'userhash' => $this->getId(),
            'name' => $this->getName(),
            'first_name' => $this->getName(),
            'last_name' => $this->getLastname(),
            'username' => $this->getName(),

            'country' => $this->getCountry(),
            'language' => $this->getLanguage(),
        );
    }

    /**
     * Get the value of Unique Telegram user id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($value)
    {
        $this->login = $value;
        return $this;
    }
    /**
     * Get the value of User's Telegram name
     *
     * @return string
     */
    public function getName()
    {
        return $this->fistname;
    }

    /**
     * Set the value of User's Telegram name
     *
     * @return string
     */
    public function setName($value)
    {
        $this->fistname = $value;
    }

    /**
     * Get the value of User's Telegram name
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of User's Telegram name
     *
     * @return string
     */
    public function setLastname($value)
    {
        $this->lastname = $value;
        return $this;
    }
    /**
     * Get the value of User's country code
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the value of User’s phone language. Will be returned according to the device language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($value)
    {
        $this->language=$value;
        return $this;
    }
}
