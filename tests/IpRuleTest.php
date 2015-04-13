<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\IpRule;

class IpRuleTest extends \PHPUnit_Framework_TestCase
{
    private $rule;

    public function setUp()
    {
        $this->rule = new IpRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testIpv4IsValid()
    {
        $result = $this->rule->validate('127.0.0.1');

        $this->assertTrue($result);
    }

    public function testIpv6IsValid()
    {
        $result = $this->rule->validate('fe00::0');

        $this->assertTrue($result);
    }

    public function testIpv4IsInvalid()
    {
        $result = $this->rule->validate('127.00.1');

        $this->assertFalse($result);
    }

    public function testIpv6IsInvalid()
    {
        $result = $this->rule->validate('fg00::0');

        $this->assertFalse($result);
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid IP',
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
 