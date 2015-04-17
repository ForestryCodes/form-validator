<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\DateRule;

class DateRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new DateRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate('13.04.2015', 'd.m.Y');

        $this->assertTrue($result);
    }

    public function testDefaultValueIsValid()
    {
        $result = $this->rule->validate('2015-04-13');

        $this->assertTrue($result);
    }

    public function testTimeIsValid()
    {
        $result = $this->rule->validate('13:37:42', 'H:i:s');

        $this->assertTrue($result);
    }

    public function testDateTimeIsValid()
    {
        $result = $this->rule->validate('2015-04-13 13:37:42', 'Y-m-d H:i:s');

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate('2015-04-13', 'Y-m');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid date',
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
 