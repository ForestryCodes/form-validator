<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\RequiredRule;

class RequiredRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new RequiredRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueTrueIsValid()
    {
        $result = $this->rule->validate(true);

        $this->assertTrue($result);
    }

    public function testValueIntIsValid()
    {
        $result = $this->rule->validate(0);

        $this->assertTrue($result);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate('on');

        $this->assertTrue($result);
    }

    public function testValueFloatIsValid()
    {
        $result = $this->rule->validate(0.1);

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate('');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not set',
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
 