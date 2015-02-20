<?php

/**
 * LocalJar.php
 *
 * @date 20.02.2015 12:51:49
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Converter;

use sufir\PlantUml\Diagram\ADiagram;
use sufir\PlantUml\PlantUml;

/**
 * LocalJar
 *
 * Description of LocalJar
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Converter
 */
class LocalJar implements IConverter
{

    /**
     * @var string
     */
    protected $outputFormat = PlantUml::OUTPUT_FORMAT_SVG;

    /**
     *
     * @param \sufir\PlantUml\Diagram\ADiagram $diagram
     * @return string
     */
    public function convertDiagram(ADiagram $diagram)
    {
        $uml = $diagram->render();
        $jar = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'plantuml.jar';

        if (!file_exists($jar)) {
            throw new \InvalidArgumentException('plantuml.jar not found: ' . $jar);
        }

        $outputFormat = ($this->outputFormat === PlantUml::OUTPUT_FORMAT_SVG) ? '-tsvg' : '';

        $tmpInputFile = tempnam(sys_get_temp_dir(), 'plantuml');
        file_put_contents($tmpInputFile, $uml);

        $tmpOutputFile = tempnam(sys_get_temp_dir(), 'image');

        if (stristr(PHP_OS, 'WIN')) {
            shell_exec('type "' . $tmpInputFile . '" | java -jar "' . $jar . '" ' . $outputFormat . ' -charset UTF-8 -pipe > "' . $tmpOutputFile . '"');
        } elseif (stristr(PHP_OS, 'LINUX')) {
            shell_exec('cat "' . $tmpInputFile . '" | java -jar "' . $jar . '" ' . $outputFormat . ' -charset UTF-8 -pipe > "' . $tmpOutputFile . '"');
        }

        $result = file_get_contents($tmpOutputFile);

        unlink($tmpInputFile);
        unlink($tmpOutputFile);

        return $result;
    }

    /**
     *
     * @param string $outputFormat
     * @return \sufir\PlantUml\PlantUml
     */
    public function setOutputFormat($outputFormat)
    {
        $this->outputFormat = strtolower($outputFormat);
        return $this;
    }

}
