<?php

/**
 * Skin.php
 *
 * @date 12.02.2015 18:59:46
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Base;

/**
 * Skin
 *
 * Description of Skin
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Base
 */
class Skin implements \IteratorAggregate
{

    const GRADIENT_VTRTICAL = '-',
        GRADIENT_HORISONTAL = '|',
        GRADIENT_DIAGONAL_FROM_LEFT_TOP = '/',
        GRADIENT_DIAGONAL_FROM_LEFT_BOTTOM = '\\';

    protected $style = array(
        'backgroundColor' => null,
        'borderColor' => null,
        'lineColor' => null,
        'fontColor' => null,
        'fontSize' => null,
        'fontStyle' => null,
        'fontName' => null,
        'align' => null,
        'shadowing' => null,
        'arrowColor' => null,
        'arrowFontColor' => null,
        'arrowFontName' => null,
    );

    /**
     *
     * @return type
     */
    public function getBackgroundColor()
    {
        return $this->style['backgroundColor'];
    }

    /**
     *
     * @return type
     */
    public function getBorderColor()
    {
        return $this->style['borderColor'];
    }

    /**
     *
     * @return string
     */
    public function getLineColor()
    {
        return $this->style['lineColor'];
    }

    /**
     *
     * @return string
     */
    public function getFontColor()
    {
        return $this->style['fontColor'];
    }

    /**
     *
     * @return string
     */
    public function getFontSize()
    {
        return $this->style['fontSize'];
    }

    /**
     *
     * @return string
     */
    public function getFontStyle()
    {
        return $this->style['fontStyle'];
    }

    /**
     *
     * @return string
     */
    public function getFontName()
    {
        return $this->style['fontName'];
    }

    /**
     *
     * @return string
     */
    public function getAlign()
    {
        return $this->style['align'];
    }

    /**
     *
     * @return string
     */
    public function getShadow()
    {
        return $this->style['shadowing'];
    }

    /**
     *
     * @return string
     */
    public function getArrowColor()
    {
        return $this->style['arrowColor'];
    }

    /**
     *
     * @return string
     */
    public function getArrowFontColor()
    {
        return $this->style['arrowFontColor'];
    }

    /**
     *
     * @return string
     */
    public function getArrowFontName()
    {
        return $this->style['arrowFontName'];
    }

    /**
     *
     * @return \ArrayIterator
     */
    public function getIterator() {
        return new \ArrayIterator($this->style);
    }

    /**
     *
     * @param string $from
     * @param string $to
     * @param string $direction
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setBackgroundGradient($from, $to, $direction = Skin::GRADIENT_DIAGONAL_FROM_LEFT_TOP)
    {
        $this->style['backgroundColor'] = $from . $direction . ltrim($to, '#');

        return $this;
    }

    /**
     *
     * @param string $arrowFontName
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setArrowFontName($arrowFontName)
    {
        $this->style['arrowFontName'] = $arrowFontName;
        return $this;
    }

    /**
     *
     * @param string $backgroundColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->style['backgroundColor'] = $backgroundColor;
        return $this;
    }

    /**
     *
     * @param string $borderColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setBorderColor($borderColor)
    {
        $this->style['borderColor'] = $borderColor;
        return $this;
    }

    /**
     *
     * @param string $lineColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setLineColor($lineColor)
    {
        $this->style['lineColor'] = $lineColor;
        return $this;
    }

    /**
     *
     * @param string $fontColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setFontColor($fontColor)
    {
        $this->style['fontColor'] = $fontColor;
        return $this;
    }

    /**
     *
     * @param string $fontSize
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setFontSize($fontSize)
    {
        $this->style['fontSize'] = $fontSize;
        return $this;
    }

    /**
     *
     * @param string $fontStyle
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setFontStyle($fontStyle)
    {
        $this->style['fontStyle'] = $fontStyle;
        return $this;
    }

    /**
     *
     * @param string $fontName
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setFontName($fontName)
    {
        $this->style['fontName'] = $fontName;
        return $this;
    }

    /**
     *
     * @param string $align
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setAlign($align)
    {
        $this->style['align'] = $align;
        return $this;
    }

    /**
     *
     * @param string $shadow
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setShadow($shadow)
    {
        $this->style['shadowing'] = !!$shadow;
        return $this;
    }

    /**
     *
     * @param string $arrowColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setArrowColor($arrowColor)
    {
        $this->style['arrowColor'] = $arrowColor;
        return $this;
    }

    /**
     *
     * @param string $arrowFontColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setArrowFontColor($arrowFontColor)
    {
        $this->style['arrowFontColor'] = $arrowFontColor;
        return $this;
    }

}
