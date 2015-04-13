<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\SameRule;

class SameRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new SameRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate('test', 'test');

        $this->assertTrue($result);
    }

    public function testArrayIsValid()
    {
        $result = $this->rule->validate(['a', 'b'], ['a', 'b']);

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate('test', 'not a test');

        $this->assertFalse($result);
    }

    public function testArrayIsInvalid()
    {
        $result = $this->rule->validate(['a', 'b'], ['a', 'c']);

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'values are not the same',
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
 