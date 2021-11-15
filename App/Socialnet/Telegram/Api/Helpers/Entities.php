<?php

namespace App\Socialnet\Telegram\Api\Helpers;

/**
 * Class Entities.
 */
class Entities
{
    /** @var string Message or Caption */
    protected $text;
    /** @var array Entities from Telegram */
    protected $entities;
    /** @var int Formatting Mode: 0:Markdown | 1:HTML */
    protected $mode = 0;

    /**
     * Entities constructor.
     *
     * @param  string  $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @param  string  $text
     *
     * @return static
     */
    public static function format(string $text)
    {
        return new static($text);
    }

    /**
     * @param  array  $entities
     *
     * @return $this
     */
    public function withEntities(array $entities)
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * Format it to markdown style.
     *
     * @return string
     */
    public function toMarkdown()
    {
        $this->mode = 0;

        return $this->apply();
    }

    /**
     * Format it to HTML syntax.
     *
     * @return string
     */
    public function toHTML()
    {
        $this->mode = 1;

        return $this->apply();
    }

    /**
     * Apply format for given text and entities.
     *
     * @return mixed|string
     */
    protected function apply()
    {
        $syntax = $this->syntax();

        $this->entities = array_reverse($this->entities);
        foreach ($this->entities as $entity) {
            $value = mb_substr($this->text, $entity['offset'], $entity['length']);
            $type = $entity['type'];
            if (isset($syntax[$type])) {
                if ($type === 'text_link') {
                    $replacement = sprintf($syntax[$type][$this->mode], $value, $entity['url']);
                } else {
                    $replacement = sprintf(
                        $syntax[$type][$this->mode],
                        ($type === 'text_mention') ? $entity['user']['username'] : $value
                    );
                }
                $this->text = substr_replace($this->text, $replacement, $entity['offset'], $entity['length']);
            }
        }

        return $this->text;
    }

    /**
     * Formatting Syntax.
     *
     * @return array
     */
    protected function syntax()
    {
        // No need of any special formatting for these entity types.
        // 'url', 'bot_command', 'hashtag', 'cashtag', 'email', 'phone_number', 'mention'

        return array(
            'bold'         => array('*%s*', '<strong>%s</strong>'),
            'italic'       => array('_%s_', '<i>%s</i>'),
            'code'         => array('`%s`', '<code>%s</code>'),
            'pre'          => array("```\n%s```", '<pre>%s</pre>'),
            'text_mention' => array('[%1$s](tg://user?id=%1$s)', '<a href="tg://user?id=%1$s">%1$s</a>'),
            'text_link'    => array('[%s](%s)', '<a href="%2$s">%1$s</a>')
        );
    }
}
