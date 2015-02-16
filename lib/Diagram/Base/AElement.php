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

    /**
     * @var string
     */
    protected $uniqueId;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var array|\sufir\PlantUml\Diagram\Base\Stereotype[]
     */
    protected $stereotypes = array();

    /**
     * @var string
     */
    protected $link;

    public function __construct($title)
    {
        $this->setTitle($title);

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getUniqueId()
    {
        if (!$this->uniqueId) {
            $this->uniqueId = md5(time() . $this->getTitle() . uniqid());
        }

        return $this->uniqueId;
    }

    /**
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     *
     * @return string
     */
    public function getStereotypes()
    {
        return $this->stereotypes;
    }

    /**
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     *
     * @param string $title
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     *
     * @param string $color
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     *
     * @param string $from
     * @param string $to
     * @param string $direction
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setGradient($from, $to, $direction = '/')
    {
        $this->color = $from . $direction . ltrim($to, '#');

        return $this;
    }

    /**
     *
     * @param string $stereotypes
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function setStereotypes($stereotypes)
    {
        $this->stereotypes = $stereotypes;
        return $this;
    }

    /**
     *
     * @param string $link
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
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

    /**
     *
     * @param string $offset
     * @return string
     */
    abstract public function render($offset = 0);

}
