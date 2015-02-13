<?php

/**
 * Component.php
 *
 * @date 12.02.2015 18:46:49
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram;

use sufir\PlantUml\Diagram\Base\AElement;

/**
 * Component
 *
 * Диаграмма компонентов
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram
 */
class Component extends ADiagram
{

    const NOTATION_UML1 = 'UML1';
    const NOTATION_UML2 = 'UML2';

    const ELEMENT_COMPONENT = 'component';
    const ELEMENT_INTERFACE = 'interface';
    const ELEMENT_USECASE = 'usecase';
    const ELEMENT_ACTOR = 'actor';
    const ELEMENT_PACKAGE = 'package';
    const ELEMENT_NODE = 'node';
    const ELEMENT_FOLDER = 'folder';
    const ELEMENT_FRAME = 'frame';
    const ELEMENT_CLOUD = 'cloud';
    const ELEMENT_DATABASE = 'database';
    const ELEMENT_RECTANGLE = 'rectangle';

    protected $umlNotation = self::NOTATION_UML2;

    public function setUmlNotation($umlNotation)
    {
        if (!in_array(strtoupper($umlNotation), array(Component::NOTATION_UML1, Component::NOTATION_UML2))) {
            throw new \InvalidArgumentException('Недопустимое значение версии нотации UML: ' . $umlNotation);
        }

        $this->umlNotation = $umlNotation;

        return $this;
    }

    public function isSupported($element)
    {
        if ($element instanceof AElement) {
            $element = $element->getType();
        }

        return in_array($element, array(
            Component::ELEMENT_ACTOR,
            Component::ELEMENT_CLOUD,
            Component::ELEMENT_COMPONENT,
            Component::ELEMENT_DATABASE,
            Component::ELEMENT_FOLDER,
            Component::ELEMENT_FRAME,
            Component::ELEMENT_INTERFACE,
            Component::ELEMENT_NODE,
            Component::ELEMENT_PACKAGE,
            Component::ELEMENT_RECTANGLE,
        ));
    }

    //put your code here
}
