<?php

/**
 * BaseElement.php
 *
 * @date 16.02.2015 10:52:02
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Component;

use sufir\PlantUml\Diagram\Base\AElement;

/**
 * BaseElement
 *
 * Description of BaseElement
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Component
 */
abstract class BaseElement extends AElement
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

        if ($this->getNote()) {
            $definition .= "\n"
                . str_pad("", $offset, " ", STR_PAD_LEFT)
                . "note {$this->notePosition} of " . $this->getUniqueId() . "\n"
                . str_pad("", $offset+2, " ", STR_PAD_LEFT)
                . $this->getNote() . "\n"
                . str_pad("", $offset, " ", STR_PAD_LEFT)
                . "end note";
        }

        return $definition . "\n";
    }

}
