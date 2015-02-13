<?php

/**
 * AElement.php
 *
 * @date 12.02.2015 18:25:20
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Base;

/**
 * AElement
 *
 * Базовый класс элементов диаграммы
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Base
 */
abstract class AElement
{

    protected $uniqueId;

    protected $title;

    protected $color;

    protected $stereotypes = array();

    protected $link;

    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getStereotypes()
    {
        return $this->stereotypes;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function setStereotypes($stereotypes)
    {
        $this->stereotypes = $stereotypes;
        return $this;
    }

    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * Возвращает идентификатор типа элемента
     *
     * @return string Идентификатор типа элемента
     */
    abstract public function getType();

}
