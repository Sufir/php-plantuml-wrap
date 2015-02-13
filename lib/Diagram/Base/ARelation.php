<?php

/**
 * ARelation.php
 *
 * @date 12.02.2015 18:13:08
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Base;

/**
 * ARelation
 *
 * Базовый класс для связей элементов
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Base
 */
abstract class ARelation
{

    const DIRECTION_LEFT = 'left',   // <-
        DIRECTION_TOP = 'top',       // <--
        DIRECTION_BOTTOM = 'bottom', // -->
        DIRECTION_RIGHT = 'right';   // ->

    /**
     *
     * @var \sufir\PlantUml\Diagram\Base\AElement
     */
    protected $from;

    /**
     *
     * @var \sufir\PlantUml\Diagram\Base\AElement
     */
    protected $to;

    /**
     *
     * @var string
     */
    protected $label;

    /**
     *
     * @var string
     */
    protected $direction;

    /**
     *
     * @var string
     */
    protected $color;

    /**
     *
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     *
     * @return \sufir\PlantUml\Diagram\Base\AElement
     */
    public function getTo()
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
     * @param string $color
     * @return \sufir\PlantUml\Diagram\Base\ARelation
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     *
     * @param \sufir\PlantUml\Diagram\Base\AElement $from
     * @return \sufir\PlantUml\Diagram\Base\ARelation
     */
    public function setFrom(AElement $from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     *
     * @param \sufir\PlantUml\Diagram\Base\AElement $to
     * @return \sufir\PlantUml\Diagram\Base\ARelation
     */
    public function setTo(AElement $to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     *
     * @param string $label
     * @return \sufir\PlantUml\Diagram\Base\ARelation
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     *
     * @param string $direction
     * @return \sufir\PlantUml\Diagram\Base\ARelation
     */
    public function setDirection($direction)
    {
        $direction = strtolower($direction);

        if (in_array(strtolower($direction), array(
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

}
