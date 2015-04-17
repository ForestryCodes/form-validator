<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\AlphaRule;

class AlphaRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new AlphaRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate('This contains text only - no numbers.');

        $this->assertTrue($result);
    }

    public function testIntValueIsInvalid()
    {
        $result = $this->rule->validate(123);

        $this->assertFalse($result);
    }

    public function testTextWithNumbersIsInvalid()
    {
        $result = $this->rule->validate('This contains the number 1.');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid alphabetical value',
            $this->rule->getMessage()
        );
    }

    public function testCustomMessage()
    {
        $this->assertEquals(
            'Custom message',
            $this->rule->getMessage('Custom message')
        );
    }
}
 