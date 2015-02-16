<?php

/**
 * ADiagram.php
 *
 * @date 12.02.2015 18:48:44
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram;

use SplObjectStorage;
use sufir\PlantUml\Diagram\Base\AElement;
use sufir\PlantUml\Diagram\Base\ARelation;

/**
 * ADiagram
 *
 * Базоывй класс диаграмм
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram
 */
abstract class ADiagram
{

    /**
     * @var string
     */
    protected $title,
        $header,
        $footer;

    /**
     * @var integer|float
     */
    protected $scale;

    /**
     * @var boolean
     */
    protected $monochrome = false;

    /**
     *
     * @var array|\sufir\PlantUml\Diagram\Base\Skin[]
     */
    protected $skins = array();

    /**
     *
     * @var array|\sufir\PlantUml\Diagram\Base\AElement[]
     */
    protected $elements = array();

    /**
     *
     * @var \SplObjectStorage|\sufir\PlantUml\Diagram\Base\AElement[]
     */
    protected $relations;

    public function __construct()
    {
        $this->relations = new SplObjectStorage;
    }

    /**
     *
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     *
     * @return string
     */
    public function getFooter()
    {
        return $this->footer;
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
     * Включен монохромный вывод?
     *
     * @return boolean
     */
    public function isMonochrome()
    {
        return $this->monochrome;
    }

    /**
     * Принудительно задает использование черно-белого вывода
     *
     * @param boolean $monochrome
     * @return \sufir\PlantUml\Diagram\ADiagram
     */
    public function setMonochrome($monochrome)
    {
        $this->monochrome = !!$monochrome;
        return $this;
    }

    /**
     * Устанавливает масштаб генерируемой диаграммы.
     * <br>
     * Должно быть десятичной дробью или целым числом. По умолчанию 1.
     *
     * @param float|integer $scale
     * @return \sufir\PlantUml\Diagram\ADiagram
     */
    public function setScale($scale)
    {
        $this->scale = (is_numeric($scale)) ? $scale : 1;
        return $this;
    }

    /**
     *
     * @param string $header
     * @return \sufir\PlantUml\Diagram\ADiagram
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     *
     * @param string $footer
     * @return \sufir\PlantUml\Diagram\ADiagram
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     *
     * @param string $title
     * @return \sufir\PlantUml\Diagram\ADiagram
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Устанавливает оформление для указанного типа элементов.
     * <br>
     * По умолчанию общее для всей диаграммы.
     *
     * @param \sufir\PlantUml\Diagram\Base\Skin $skin
     * @return \sufir\PlantUml\Diagram\ADiagram
     */
    public function setSkin(\sufir\PlantUml\Diagram\Base\Skin $skin, $elementType = '_MAIN_')
    {
        $elementType = ($elementType) ? $elementType : '_MAIN_';

        if ($elementType !== '_MAIN_' && !$this->isSupported($elementType)) {
            throw new \InvalidArgumentException('Недопустимый тип элемента: ' . $elementType);
        }

        $this->skins[$elementType] = $skin;
        return $this;
    }

    /**
     * Возвращает true, если указанный элемент поддерживается данным типом диаграмм.
     * <br>
     * В качестве единственного параметра принимает объект реализующий интерфейс AElement или строку идентифицирующую тип элемента.
     *
     * @param string|\sufir\PlantUml\Diagram\Base\AElement $element
     * @return boolean
     */
    abstract public function isSupported($element);

    /**
     * @param \sufir\PlantUml\Diagram\Base\AElement $element
     * @return \sufir\PlantUml\Diagram\ADiagram
     */
    public function addElement(AElement $element)
    {
        $this->elements[$element->getUniqueId()] = $element;

        return $this;
    }

    /**
     * @param \sufir\PlantUml\Diagram\Base\AElement $relation
     * @return \sufir\PlantUml\Diagram\ADiagram
     */
    public function addRelation(ARelation $relation)
    {
        if (!$this->relations->contains($relation)) {
            $this->relations->attach($relation);
        }

        return $this;
    }

}
