<?php

/**
 * BaseGroupElement.php
 *
 * @date 16.02.2015 13:24:15
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Component;

use sufir\PlantUml\Diagram\Base\ACompositeElement;

/**
 * BaseGroupElement
 *
 * Description of BaseGroupElement
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Component
 */
class BaseCompositeElement extends ACompositeElement
{

    public function getType()
    {
        $tmp = explode('\\', get_class($this));

        return substr(strtolower(end($tmp)), 7);
    }

    public function render($offset = 0)
    {
        $definition = $this->getType() . ' "' . $this->getTitle() . '" as ' . $this->getUniqueId();

        if (!empty($this->stereotypes)) {
            foreach ($this->stereotypes as $stereotype) {
                $definition .= ' <<' . $stereotype->getName() . '>>';
            }
        }

        if ($this->getLink()) {
            $definition .= ' [[' . $this->getLink() . ']]';
        }

        if ($this->getColor()) {

            if (strpos($this->getColor(), '#') !== 0) {
                $definition .= ' #' . $this->getColor();
            } else {
                $definition .= ' ' . $this->getColor();
            }

        }

        $definition = str_pad($definition, strlen($definition)+$offset, " ", STR_PAD_LEFT);

        if (!empty($this->elements)) {
            $definition .= " {\n";

            foreach ($this->elements as $element) {
                $definition .= $element->render($offset+2);
            }

            $definition .= str_pad("}\n", strlen("}\n")+$offset, " ", STR_PAD_LEFT);
        }

        if ($this->getNote()) {
            $definition .= "\n"
                . str_pad("", $offset, " ", STR_PAD_LEFT)
                . "note {$this->notePosition} of " . $this->getUniqueId() . "\n"
                . trim($this->getNote()) . "\n"
                . str_pad("", $offset, " ", STR_PAD_LEFT)
                . "end note";
        }

        return $definition . "\n";
    }

}
