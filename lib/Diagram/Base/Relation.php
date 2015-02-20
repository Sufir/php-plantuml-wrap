<?php

/**
 * ARelation.php
 *
 * @date 12.02.2015 18:13:08
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Base;

/**
 * Relation
 *
 * Класс связей элементов
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Base
 */
class Relation
{

    const DIRECTION_LEFT = 'left',   // <-
        DIRECTION_TOP = 'top',       // <--
        DIRECTION_BOTTOM = 'bottom', // -->
        DIRECTION_RIGHT = 'right';   // ->

    const LINE_DOTTED = 'dotted',
        LINE_SIMPLE = 'simple',
        LINE_SOLID = 'solid';

    const ARROW_NONE = 'none',
        ARROW_BRACKET = 'bracket',
        ARROW_EXTENSION = 'extension',
        ARROW_COMPOSITION = 'composition',
        ARROW_AGGREGATION = 'aggregation',
        ARROW_GENERALIZATION = 'generalization',
        ARROW_ASSOCIATION = 'association';

    /**
     * @var \sufir\PlantUml\Diagram\Base\AElement
     */
    protected $from;

    /**
     * @var \sufir\PlantUml\Diagram\Base\AElement
     */
    protected $to;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $direction;

    /**
     * @var string
     */
    protected $arrowFrom = self::ARROW_NONE;

    /**
     * @var string
     */
    protected $arrowTo = self::ARROW_NONE;

    /**
     * @var string
     */
    protected $color;

    /**
     * @var boolean
     */
    protected $hidden = false;

    /**
     * @var string
     */
    protected $line = self::LINE_SIMPLE;

    /**
     * @var length
     */
    protected $length = 1;

    /**
     * @var array
     */
    protected $lineSymbols = array(
            self::LINE_DOTTED => '.',
            self::LINE_SOLID => '=',
            self::LINE_SIMPLE => '-',
        );

    /**
     * @var array
     */
    protected $leftArrows = array(
            self::ARROW_NONE => '',
            self::ARROW_BRACKET => ')',
            self::ARROW_GENERALIZATION => '<<',
            self::ARROW_EXTENSION => '<|',
            self::ARROW_AGGREGATION => 'o',
            self::ARROW_ASSOCIATION => '<',
            self::ARROW_COMPOSITION => '*',
        );

    /**
     * @var array
     */
    protected $rightArrows = array(
            self::ARROW_NONE => '',
            self::ARROW_BRACKET => '(',
            self::ARROW_GENERALIZATION => '>>',
            self::ARROW_EXTENSION => '|>',
            self::ARROW_AGGREGATION => 'o',
            self::ARROW_ASSOCIATION => '>',
            self::ARROW_COMPOSITION => '*',
        );

    public function __construct(AElement $from = null, AElement $to = null)
    {
        if ($from) {
            $this->setFrom($from);
        }

        if ($to) {
            $this->setTo($to);
        }

        return $this;
    }

    /**
     *
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function from()
    {
        return $this->from;
    }

    /**
     *
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function to()
    {
        return $this->to;
    }

    /**
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
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
    public function getLineType()
    {
        return $this->line;
    }

    /**
     *
     * @return boolean
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     *
     * @param boolean $hidden
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function setHidden($hidden)
    {
        $this->hidden = !!$hidden;
        return $this;
    }


    /**
     * @param string $line
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function setLineType($line)
    {
        $this->line = strtolower($line);
        return $this;
    }

    /**
     *
     * @param string $color
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     *
     * @param \sufir\PlantUml\Diagram\Base\AElement $from
     * @param string $arrow
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function setFrom(AElement $from, $arrow = self::ARROW_NONE)
    {
        $this->from = $from;
        $this->arrowFrom = $arrow;

        return $this;
    }

    /**
     *
     * @param \sufir\PlantUml\Diagram\Base\AElement $to
     * @param string $arrow
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function setTo(AElement $to, $arrow = self::ARROW_NONE)
    {
        $this->to = $to;
        $this->arrowTo = $arrow;

        return $this;
    }

    /**
     *
     * @param string $label
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     *
     * @param string $direction
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function setDirection($direction)
    {
        $direction = strtolower($direction);

        if (!in_array(strtolower($direction), array(
            self::DIRECTION_TOP,
            self::DIRECTION_BOTTOM,
            self::DIRECTION_LEFT,
            self::DIRECTION_RIGHT,
        ))) {
            throw new \InvalidArgumentException('Недопустимое значение направления связи: ' . $direction);
        }

        $this->direction = $direction;
        return $this;
    }

    /**
     * @return integer
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Длинна связи (расстояние между элементами).
     * <br>
     * Поддерживается только для вертикальных связей!
     *
     * @param integer $length
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function setLength($length)
    {
        $this->length = (int) $length;
        return $this;
    }

    public function render() {
        $line = $this->getLine();

        if ($this->direction === self::DIRECTION_LEFT || $this->direction === self::DIRECTION_TOP) {
            $definition = $this->to()->getUniqueId() . ' ' . $this->getArrow($this->arrowTo, 'left') . $line . $this->getArrow($this->arrowFrom, 'right') . ' ' . $this->from()->getUniqueId();
        } else {
            $definition = $this->from()->getUniqueId() . ' ' . $this->getArrow($this->arrowFrom, 'left') . $line . $this->getArrow($this->arrowTo, 'right') . ' ' . $this->to()->getUniqueId();
        }

        if ($this->getLabel()) {
            $definition .= ' :"' . $this->getLabel() . '"';
        }

        return $definition . "\n";
    }

    /**
     * @param string $arrowType
     * @param string $direction
     * @return string
     */
    protected function getArrow($arrowType, $position)
    {
        if ($position === 'left') {
            return (isset($this->leftArrows[$arrowType])) ? $this->leftArrows[$arrowType] : '';
        }

        return (isset($this->rightArrows[$arrowType])) ? $this->rightArrows[$arrowType] : '';
    }

    /**
     *
     * @return string
     */
    protected function getLine()
    {
        $lineSymbol = (isset($this->lineSymbols[$this->getLineType()])) ? $this->lineSymbols[$this->getLineType()] : $this->lineSymbols[self::LINE_SIMPLE];

        if ($this->direction === self::DIRECTION_LEFT || $this->direction === self::DIRECTION_RIGHT) {
            $line = $lineSymbol;
        } else {
            $line = str_pad($lineSymbol, $this->getLength()+1, $lineSymbol);
        }

        if ($this->isHidden()) {
            $line = $line . '[hidden]';
        } elseif ($this->getColor()) {
            $line = $line . '[#' . ltrim($this->getColor(), '#') . ']';
        }

        return $line;
    }

}
