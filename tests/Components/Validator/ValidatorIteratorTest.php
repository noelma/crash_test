<?php

namespace Soosyze\Tests\Components\Validator;

use Soosyze\Components\Validator\Validator;
use Soosyze\Components\Validator\ValidatorIterator;

class ValidatorIteratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Validator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Validator;
    }

    public function testIteratorSimple()
    {
        /* $this->object->setInputs([
          'field_simple' => 'test',
          'field_object' => [
          1 => [
          'name'      => 'foo',
          'firstname' => 'bar'
          ],
          2 => [
          'name'      => 'foo',
          'firstname' => 'bar'
          ]
          ]
          ])->setRules([
          'field_simple' => 'required|string',
          'field_object' => (new ValidatorIterator)
          ->setRuleKey('required|int|inarray:1,2,3,4')
          ->setRules([
          'name'      => 'string',
          'firstname' => 'string|max:255'
          ])
          ]);

          $this->assertTrue(true); */
    }

    public function testIteratorMultiple()
    {
        /* $this->object->setInputs([
          'field_simple' => 'test',
          'field_object' => [
          1 => 'value_1',
          2 => 'value_2'
          ]
          ])->setRules([
          'field_simple' => 'required|string',
          'field_object' => (new ValidatorIterator)
          ->setRuleKey('required|int|inarray:1,2,3,4')
          ->setRule('string|max:255')
          ]);

          $this->assertTrue(true); */
    }
}
