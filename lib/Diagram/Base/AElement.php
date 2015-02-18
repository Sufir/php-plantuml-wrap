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

    /**
     * @var string
     */
    protected $note;

    /**
     * @var string
     */
    protected $notePosition = 'left';

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
     * @return array
     */
    public function getStereotypes()
    {
        return $this->stereotypes;
    }

    /**
     *
     * @return array
     */
    public function hasStereotypes()
    {
        return !empty($this->stereotypes);
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
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     *
     * @param string $note
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function setNote($note, $position = 'left')
    {
        $this->note = $note;
        $this->notePosition = strtolower($position);

        return $this;
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
     * @param \sufir\PlantUml\Diagram\Base\Stereotype $stereotypes
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function addStereotype(Stereotype $stereotype)
    {
        $this->stereotypes[$stereotype->getName()] = $stereotype;
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
