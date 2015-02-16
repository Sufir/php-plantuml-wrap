<?php

/**
 * Stereotype.php
 *
 * @date 12.02.2015 18:11:25
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Base;

/**
 * Stereotype
 *
 * Description of Stereotype
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Base
 */
class Stereotype
{

    protected $name;

    /**
     *
     * @var \sufir\PlantUml\Diagram\Base\Skin
     */
    protected $skin = array();

    public function __construct($name)
    {
        $clearName = trim($name, " \t\n\r\0\x0B<>");
        if (strlen($clearName) <= 0) {
            throw new \InvalidArgumentException('Недопустимое имя стереотипа: "' . $name . '"');
        }

        $this->name = $clearName;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return string
     */
    public function getSkin()
    {
        return $this->skin;
    }

    /**
     *
     * @param \sufir\PlantUml\Diagram\Base\Skin $skin
     * @return \sufir\PlantUml\Diagram\Base\Stereotype
     */
    public function setSkin(\sufir\PlantUml\Diagram\Base\Skin $skin)
    {
        $this->skin = $skin;
        return $this;
    }

}
