<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\AlphanumRule;

class AlphanumRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new AlphanumRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testValueIsValid()
    {
        $result = $this->rule->validate('This contains text only - no numbers. ' .
            'And it has some special chars ÄÖÜßäüö');

        $this->assertTrue($result);
    }

    public function testTextWithNumbersIsValid()
    {
        $result = $this->rule->validate('This contains the number 1.');

        $this->assertTrue($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid alphanumerical value',
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
 