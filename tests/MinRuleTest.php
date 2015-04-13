<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\MinRule;

class MinRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new MinRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate('test', 3);

        $this->assertTrue($result);
    }

    public function testEmptyIsInvalid()
    {
        $result = $this->rule->validate('', 3);

        $this->assertFalse($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate(12, 3);

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value to short',
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
 