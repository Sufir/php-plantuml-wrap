<?php

/**
 * PlantUml.php
 *
 * @date 12.02.2015 17:20:19
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml;

use sufir\PlantUml\Diagram\ADiagram;
use sufir\PlantUml\Diagram\Base\AElement;
use sufir\PlantUml\Diagram\Base\Relation;
use sufir\PlantUml\Diagram\Base\Stereotype;
use sufir\PlantUml\Diagram\Base\Skin;

/**
 * PlantUml
 *
 * Description of PlantUml
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml
 */
class PlantUml
{

    const OUTPUT_FORMAT_PNG = 'png',
        OUTPUT_FORMAT_SVG = 'svg';

    const DIAGRAM_COMPONENT = 'component';

    /**
     * @var string
     */
    protected $outputFormat = self::OUTPUT_FORMAT_SVG;

    /**
     * Создание связи между элементами
     *
     * @param \sufir\PlantUml\Diagram\Base\AElement $from
     * @param \sufir\PlantUml\Diagram\Base\AElement $to
     * @return \sufir\PlantUml\Diagram\Base\Relation
     */
    public function createRelation(AElement $from = null, AElement $to = null)
    {
        return new Relation($from, $to);
    }

    /**
     *
     * @param string $diagramType
     * @param string $elementType
     * @param string $elementTitle
     * @return \sufir\PlantUml\Diagram\Base\AElement
     * @throws \InvalidArgumentException
     */
    public function createElement($diagramType, $elementType, $elementTitle)
    {
        $diagramClass = '\sufir\PlantUml\Diagram\\' . ucfirst($this->camelize($diagramType));

        if (!class_exists($diagramClass)) {
            throw new \InvalidArgumentException('Неизвестный тип диаграммы: ' . $diagramType);
        }

        $elementClass = '\sufir\PlantUml\Diagram\\' . ucfirst($this->camelize($diagramType)) . '\\Element' . ucfirst($this->camelize($elementType));

        if (!class_exists($elementClass)) {
            throw new \InvalidArgumentException('Неизвестный тип элемента диаграммы: ' . $elementType);
        }

        return new $elementClass($elementTitle);
    }

    /**
     *
     * @param string $diagramType
     * @return \sufir\PlantUml\Diagram\ADiagram
     * @throws \InvalidArgumentException
     */
    public function createDiagram($diagramType)
    {
        $diagramClass = '\sufir\PlantUml\Diagram\\' . ucfirst($this->camelize($diagramType));

        if (!class_exists($diagramClass)) {
            throw new \InvalidArgumentException('Неизвестный тип диаграммы: ' . $diagramType);
        }

        return new $diagramClass();
    }

    /**
     *
     * @param string $name
     * @return \sufir\PlantUml\Diagram\Base\Stereotype
     */
    public function createStereotype($name)
    {
        return new Stereotype($name);
    }

    /**
     *
     * @return \sufir\PlantUml\Diagram\Base\Skin
     */
    public function createSkin()
    {
        return new Skin();
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

    /**
     *
     * @param \sufir\PlantUml\Diagram $diagram
     * @return string
     */
    public function convertDiagram(ADiagram $diagram)
    {
        $uml = $diagram->render();
        $jar = __DIR__ . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'plantuml.jar';
        $outputFormat = ($this->outputFormat === self::OUTPUT_FORMAT_SVG) ? '-tsvg' : '';

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
     * Преобразует строку в lowerCamelCase
     *
     * @author Sklyarov Alexey <sufir@lightsoft.ru>
     * @param string $var
     * @return string
     */
    protected static function camelize($var) {
        return lcfirst(str_replace(' ', '', ucwords(str_replace(array('_', '-'), ' ', $var))));
    }

}
