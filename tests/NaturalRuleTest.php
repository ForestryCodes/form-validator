<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\NaturalRule;

class NaturalRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new NaturalRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate(123);

        $this->assertTrue($result);
    }

    public function testFloatValueIsInvalid()
    {
        $result = $this->rule->validate(123.4);

        $this->assertFalse($result);
    }

    public function testNegativeValueIsInvalid()
    {
        $result = $this->rule->validate(-123);

        $this->assertFalse($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate('invalid');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid natural number',
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
 