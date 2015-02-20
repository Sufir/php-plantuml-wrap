<?php

/**
 * IConverter.php
 *
 * @date 20.02.2015 12:49:50
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Converter;

use sufir\PlantUml\Diagram\ADiagram;

/**
 * IConverter
 *
 * Description of IConverter
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Converter
 */
interface IConverter
{

    /**
     * @param \sufir\PlantUml\Diagram\ADiagram $diagram
     * @return string
     */
    public function convertDiagram(ADiagram $diagram);

    public function setOutputFormat($outputFormat);

}
