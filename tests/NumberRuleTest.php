<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\NumberRule;

class NumberRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new NumberRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testIntValueIsValid()
    {
        $result = $this->rule->validate(123);

        $this->assertTrue($result);
    }

    public function testFloatValueIsValid()
    {
        $result = $this->rule->validate(123.4);

        $this->assertTrue($result);
    }

    public function testNegativeValueIsValid()
    {
        $result = $this->rule->validate('-123.4');

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate('+123');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid number',
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
 