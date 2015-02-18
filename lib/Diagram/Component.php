<?php

/**
 * Component.php
 *
 * @date 12.02.2015 18:46:49
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram;

use sufir\PlantUml\Diagram\Base\AElement;
use sufir\PlantUml\Diagram\Base\ACompositeElement;
use sufir\PlantUml\Diagram\Base\Skin;

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

    public function render()
    {
        $definition = "@startuml\n";

        if ($this->scale && $this->scale != 1) {
            $definition .= "scale " . $this->scale . "\n";
        }

        if (!$this->isStereotypeVisible()) {
            $definition .= "hide stereotype\n";
        }

        if ($this->isOrientationVertical()) {
            $definition .= "left to right direction\n";
        }

        if ($this->umlNotation) {
            $definition .= "skinparam componentStyle " . $this->umlNotation . "\n";
        }

        if ($this->getTitle()) {
            $definition .= "title " . str_replace("\n", '\n', $this->getTitle()) . "\n";
        }

        if ($this->getHeader()) {
            $definition .= "header\n" . $this->getHeader() . "\nendheader\n";
        }

        if ($this->getFooter()) {
            $definition .= "footer\n" . $this->getFooter() . "\nendfooter\n";
        }

        $definition .= "\n' Объявление элементов -------------------------------------------------------------------\n";
        foreach ($this->elements as $element) {
            $definition .= $element->render();
        }

        $definition .= "\n' Объявление отношений -------------------------------------------------------------------\n";
        foreach ($this->relations as $relation) {
            $definition .= $relation->render();
        }

        $definition .= "\n' Стилизация диаграммы -------------------------------------------------------------------\n";
        foreach ($this->skins as $elementType => $skin) {
            $definition .= $this->renderSkin($skin, $elementType);
        }

        $definition .= "\n' Стили отдельных стереотипов\n";
        $stereotypes = $this->findStereotypes($this->elements);
        //var_dump($stereotypes); die;

        foreach ($stereotypes as $elementType => $stereotypeList) {
            foreach ($stereotypeList as $stereotype) {
                if (!$stereotype->hasSkin()) {
                    continue;
                }

                $definition .= $this->renderSkin($stereotype->getSkin(), $elementType, $stereotype->getName());
            }
        }

        $definition .= "\n@enduml";
        return $definition;
    }

    /**
     * @param Skin $skin
     * @param string $elementType
     * @param string $stereotypeName
     * @return string
     */
    protected function renderSkin(Skin $skin, $elementType, $stereotypeName = null)
    {
        $elementType = ($elementType === '_MAIN_') ? '' : $elementType;

        $definition = "skinparam {$elementType} {\n";

        foreach ($skin as $prop => $value) {
            if (is_bool($value)) {
                $value = ($value) ? 'true' : 'false';
            } elseif (!$value) {
                continue;
            }

            $definition .= (!$stereotypeName) ? "  {$prop} {$value}\n" : "  {$prop}<<{$stereotypeName}>> {$value}\n";
        }

        $definition .= "}\n";
        return $definition;
    }

    /**
     *
     * @param AElement[] $elements
     * @param array $stereotypes
     * @return array
     */
    protected function findStereotypes(array $elements, array &$stereotypes = array()) {

        foreach ($elements as $element) {

            if ($element instanceof ACompositeElement) {

                foreach ($element->getStereotypes() as $stereotype) {
                    $stereotypes[$element->getType()][$stereotype->getName()] = $stereotype;
                }

                $this->findStereotypes($element->getChilds(), $stereotypes);

            } elseif ($element instanceof AElement) {

                foreach ($element->getStereotypes() as $stereotype) {
                    $stereotypes[$element->getType()][$stereotype->getName()] = $stereotype;
                }

            }


        }

        return $stereotypes;
    }

}
