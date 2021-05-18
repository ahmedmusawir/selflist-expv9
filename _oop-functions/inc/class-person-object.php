<?php

class Person_Object
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function set_name($name)
    {
        $this->name = $name;
    }

    public function get_name()
    {
        $posts = get_posts();
        echo '<pre>';
        print_r($posts);
        echo '</pre>';
        // return $this->name;
    }

}