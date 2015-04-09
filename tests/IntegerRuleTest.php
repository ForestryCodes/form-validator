<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\IntegerRule;

class IntegerRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new IntegerRule();
    }

    public function textValidRuleInstance()
    {
        $this->assertInstanceOf('RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate(123);

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate(1.23);

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid integer',
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
 