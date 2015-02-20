<?php

/**
 * RemoteService.php
 *
 * @date 20.02.2015 12:50:23
 * @copyright Sklyarov Alexey
 */

namespace sufir\PlantUml\Converter;

use sufir\PlantUml\Diagram\ADiagram;
use sufir\PlantUml\PlantUml;

/**
 * RemoteService
 *
 * Description of RemoteService
 *
 * @author Sklyarov Alexey <sufir@mihailovka.info>
 * @package sufir\PlantUml\Converter
 */
class RemoteService implements IConverter
{

    /**
     * @var string
     */
    protected $outputFormat = PlantUml::OUTPUT_FORMAT_SVG;

    public function convertDiagram(ADiagram $diagram)
    {
        return file_get_contents("http://www.plantuml.com:80/plantuml/{$this->outputFormat}/" . $this->encode64(gzdeflate($diagram->render(), 9)));
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
     * Copy from http://plantuml.com/
     *
     * @param string $b
     * @return string
     */
    protected function encode6bit($b)
    {
        if ($b < 10) {
            return chr(48 + $b);
        }
        $b -= 10;
        if ($b < 26) {
            return chr(65 + $b);
        }
        $b -= 26;
        if ($b < 26) {
            return chr(97 + $b);
        }
        $b -= 26;
        if ($b == 0) {
            return '-';
        }
        if ($b == 1) {
            return '_';
        }
        return '?';
    }

    /**
     * Copy from http://plantuml.com/
     *
     * @param string $b1
     * @param string $b2
     * @param string $b3
     * @return string
     */
    protected function append3bytes($b1, $b2, $b3)
    {
        $c1 = $b1 >> 2;
        $c2 = (($b1 & 0x3) << 4) | ($b2 >> 4);
        $c3 = (($b2 & 0xF) << 2) | ($b3 >> 6);
        $c4 = $b3 & 0x3F;
        $r = "";
        $r .= $this->encode6bit($c1 & 0x3F);
        $r .= $this->encode6bit($c2 & 0x3F);
        $r .= $this->encode6bit($c3 & 0x3F);
        $r .= $this->encode6bit($c4 & 0x3F);
        return $r;
    }

    /**
     * Copy from http://plantuml.com/
     *
     * @param string $c
     * @return string
     */
    protected function encode64($c)
    {
        $str = "";
        $len = strlen($c);
        for ($i = 0; $i < $len; $i+=3) {
            if ($i + 2 == $len) {
                $str .= $this->append3bytes(ord(substr($c, $i, 1)), ord(substr($c, $i + 1, 1)), 0);
            } else if ($i + 1 == $len) {
                $str .= $this->append3bytes(ord(substr($c, $i, 1)), 0, 0);
            } else {
                $str .= $this->append3bytes(ord(substr($c, $i, 1)), ord(substr($c, $i + 1, 1)), ord(substr($c, $i + 2, 1)));
            }
        }
        return $str;
    }

}
