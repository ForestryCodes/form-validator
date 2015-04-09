<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\EmailRule;

class EmailRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new EmailRule();
    }

    public function textValidRuleInstance()
    {
        $this->assertInstanceOf('RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate('test@example.org');

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate('test@example');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->rule->validate(123);

        $this->assertEquals(
            'value is not a valid email',
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
 