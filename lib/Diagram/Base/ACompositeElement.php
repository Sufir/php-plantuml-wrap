<?php

/**
 * ACompositeElement.php
 *
 * @date 13.02.2015 19:28:57
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Base;

use sufir\PlantUml\Diagram\Base\AElement;
use sufir\PlantUml\Diagram\Base\ACompositeElement;

/**
 * ACompositeElement
 *
 * Базовый класс элементов диаграммы которые могут группировать в себе другие элементы
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Base
 */
abstract class ACompositeElement extends AElement
{

    /**
     *
     * @var array|\sufir\PlantUml\Diagram\Base\AElement[]
     */
    protected $elements = array();

    /**
     *
     * @param \sufir\PlantUml\Diagram\Base\AElement $element
     * @return \sufir\PlantUml\Diagram\Base\ACompositeElement
     */
    public function addElement(AElement $element)
    {
        $this->elements[$element->getUniqueId()] = $element;

        return $this;
    }

    /**
     *
     * @return \sufir\PlantUml\Diagram\Base\AElement[]
     */
    public function getChilds()
    {
        return $this->elements;
    }

}
