<?php

namespace App\helper;

class Language
{
    protected string $controller;
    protected string $method;

    /**
     * To init value
     *
     * @param $controller
     * @param $method
     */
    function __construct($controller, $method)
    {
        $this->controller = $controller;
        $this->method     = $method;
    }

    /**
     * Get data translation from lang file
     *
     * @param string $text
     * @param array $options
     * @return array
     */
    public function text(string $text,array $options = []): array
    {
        return __($this->controller.'\\'.$this->method.'.'.$text,$options);
    }

    //TODO::func Get data from custom position
}
