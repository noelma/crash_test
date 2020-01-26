<?php

/**
 * Soosyze Framework http://soosyze.com
 *
 * @package Soosyze\Components\Validator
 * @author  Mathieu NOËL <mathieu@soosyze.com>
 * @license https://github.com/soosyze/framework/blob/master/LICENSE (MIT License)
 */

namespace Soosyze\Components\Validator;

/**
 * Valide des valeurs à partir de tests chaînés.
 *
 * @author Mathieu NOËL
 */
class ValidatorIterator extends Validator
{
    protected function execute($key, array $rules)
    {
        foreach ($rules as $rule) {
            foreach ($this->inputs as $i => $input) {
                $value = $this->getCorrectInput($key, $input);
                $rule->execute($value);
                if ($rule->isStop()) {
                    break;
                }
                if ($rule->hasErrors()) {
                    $this->key[ $key ] = 1;
//                    var_dump($rule->getErrors());
                    if (!isset($this->errors[ $i ][ $key ])) {
                        $this->errors[ $i ][ $key ] = [];
                    }
                    $this->errors[ $i ][ $key ] += $rule->getErrors();
                }
                $this->inputs[ $i ][ $key ] = $rule->getValue();
            }
        }
    }
}
