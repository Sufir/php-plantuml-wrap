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

    public function render()
    {
        $definition = $this->getType() . ' "' . $this->getTitle() . '" as ' . $this->getUniqueId();

        if (!empty($this->stereotypes)) {
            foreach ($this->stereotypes as $stereotype) {
                $definition .= ' <<' . $stereotype->getName() . '>>';
            }
        }

        if ($this->color) {

            if (strpos($this->color, '#') !== 0) {
                $definition .= ' #' . $this->color;
            } else {
                $definition .= ' ' . $this->color;
            }

        }

        return $definition . "\n";
    }

}
