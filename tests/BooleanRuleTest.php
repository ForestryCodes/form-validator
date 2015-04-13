<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\BooleanRule;

class BooleanRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new BooleanRule();
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

    public function testValueOneIsValid()
    {
        $result = $this->rule->validate(1);

        $this->assertTrue($result);
    }

    public function testValueOnIsValid()
    {
        $result = $this->rule->validate('on');

        $this->assertTrue($result);
    }

    public function testValueYesIsValid()
    {
        $result = $this->rule->validate('yes');

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate(123);

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->rule->validate(123);

        $this->assertEquals(
            'value is not set',
            $this->rule->getMessage()
        );
    }

    public function testCustomMessage()
    {
        $this->rule->validate(123);

        $this->assertEquals(
            'Custom message',
            $this->rule->getMessage('Custom message')
        );
    }
}
 