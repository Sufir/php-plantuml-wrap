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
class Skin
{

    const GRADIENT_VTRTICAL = '-',
        GRADIENT_HORISONTAL = '|',
        GRADIENT_DIAGONAL_FROM_LEFT_TOP = '/',
        GRADIENT_DIAGONAL_FROM_LEFT_BOTTOM = '\\';

    protected $backgroundColor = 'white';
    protected $lineColor = 'black';
    protected $fontColor = 'black';
    protected $fontSize = '13';
    protected $fontStyle = 'plain';
    protected $fontName = 'Arial';
    protected $align = 'center';
    protected $shadow = true;
    protected $arrowColor = '#000000';
	protected $arrowFontColor = '#555555';
    protected $arrowFontName = 'Arial';

    /**
     *
     * @param string $from
     * @param string $to
     * @param string $direction
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setBackgroundGradient($from, $to, $direction = Skin::GRADIENT_DIAGONAL_FROM_LEFT_TOP)
    {
        $this->backgroundColor = $from . $direction . rtrim($to, '#');

        return $this;
    }

    /**
     *
     * @return type
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     *
     * @return string
     */
    public function getLineColor()
    {
        return $this->lineColor;
    }

    /**
     *
     * @return string
     */
    public function getFontColor()
    {
        return $this->fontColor;
    }

    /**
     *
     * @return string
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     *
     * @return string
     */
    public function getFontStyle()
    {
        return $this->fontStyle;
    }

    /**
     *
     * @return string
     */
    public function getFontName()
    {
        return $this->fontName;
    }

    /**
     *
     * @return string
     */
    public function getAlign()
    {
        return $this->align;
    }

    /**
     *
     * @return string
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     *
     * @return string
     */
    public function getArrowColor()
    {
        return $this->arrowColor;
    }

    /**
     *
     * @return string
     */
    public function getArrowFontColor()
    {
        return $this->arrowFontColor;
    }

    /**
     *
     * @return string
     */
    public function getArrowFontName()
    {
        return $this->arrowFontName;
    }

    /**
     *
     * @param string $arrowFontName
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setArrowFontName($arrowFontName)
    {
        $this->arrowFontName = $arrowFontName;
        return $this;
    }

    /**
     *
     * @param string $backgroundColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     *
     * @param string $lineColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setLineColor($lineColor)
    {
        $this->lineColor = $lineColor;
        return $this;
    }

    /**
     *
     * @param string $fontColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setFontColor($fontColor)
    {
        $this->fontColor = $fontColor;
        return $this;
    }

    /**
     *
     * @param string $fontSize
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = $fontSize;
        return $this;
    }

    /**
     *
     * @param string $fontStyle
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setFontStyle($fontStyle)
    {
        $this->fontStyle = $fontStyle;
        return $this;
    }

    /**
     *
     * @param string $fontName
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setFontName($fontName)
    {
        $this->fontName = $fontName;
        return $this;
    }

    /**
     *
     * @param string $align
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setAlign($align)
    {
        $this->align = $align;
        return $this;
    }

    /**
     *
     * @param string $shadow
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setShadow($shadow)
    {
        $this->shadow = $shadow;
        return $this;
    }

    /**
     *
     * @param string $arrowColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setArrowColor($arrowColor)
    {
        $this->arrowColor = $arrowColor;
        return $this;
    }

    /**
     *
     * @param string $arrowFontColor
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function setArrowFontColor($arrowFontColor)
    {
        $this->arrowFontColor = $arrowFontColor;
        return $this;
    }

}
