<?php

/**
 * Stereotype.php
 *
 * @date 12.02.2015 18:11:25
 * @copyright Sklyarov Alexey
 */

namespace Stereotype;

/**
 * Stereotype
 *
 * Description of Stereotype
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package Stereotype
 */
class Stereotype
{

    protected $name;

    public function __construct($name)
    {
        if (strlen(trim($name)) <= 0) {

        }

        $this->name = $name;
    }

}
