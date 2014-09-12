<?php

/**
 * Project : VN-oEmbed
 * User: thuytien
 * Date: 9/12/2014
 * Time: 3:51 PM
 */
class EmbedRuler
{
    private $regex;
    private $callback;

    function __construct($regex, $callback)
    {
        $this->callback = $callback;
        $this->regex = $regex;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @param mixed $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * @return mixed
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * @param mixed $regex
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;
    }
} 