<?php

/**
 * ElementComponent.php
 *
 * @date 13.02.2015 18:08:18
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Diagram\Component;

/**
 * ElementComponent
 *
 * Description of ElementComponent
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Diagram\Component
 */
class ElementComponent extends BaseElement
{
    public function getType()
    {
        return 'component';
    }

}
