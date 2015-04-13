<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\UrlRule;

class UrlRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new UrlRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate('http://forestry.codes');

        $this->assertTrue($result);
    }

    public function testValueIsInvalid()
    {
        $result = $this->rule->validate('forestry.codes');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid URL',
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
