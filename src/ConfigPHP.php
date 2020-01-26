<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Soosyze;

/**
 * Description of ConfigPHP
 *
 * @author mnoel
 */
class ConfigPHP
{
    protected $values = [];

    public function make($filename, array $values)
    {
        $handle = fopen($filename, 'w+');
        fwrite($handle, '<?php' . PHP_EOL . 'return [' . $this->render($values) . '];');
        fclose($handle);
    }

    public function render(array $values = [])
    {
        $out = '';
        foreach ($values as $key => $data) {
            $out .= '\'' . $key . '\'=>';
            if (is_array($data)) {
                $out .= '[' . PHP_EOL . $this->render($data) . '],';
            } elseif (is_string($data)) {
                $out .= '\'' . $data . '\',';
            } elseif (is_int($data) || is_float($data)) {
                $out .= $data . ',';
            } elseif ($data === null) {
                $out .= 'null,';
            }
        }

        return $out;
    }
}
