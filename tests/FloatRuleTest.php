<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\FloatRule;

class FloatRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new FloatRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate(12.345);

        $this->assertTrue($result);
    }

    public function testIntValueIsValid()
    {
        $result = $this->rule->validate(12);

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate('1,000.01');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid float',
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
 