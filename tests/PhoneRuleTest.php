<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Rule\PhoneRule;

class PhoneRuleTest extends \PHPUnit_Framework_TestCase
{

    private $rule;

    public function setUp()
    {
        $this->rule = new PhoneRule();
    }

    public function testValidRuleInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\RuleInterface', $this->rule);
    }

    public function testUsLocalIsValid()
    {
        $this->assertTrue($this->executevalidation('754-3010'));
    }

    public function testUsDomesticIsValid()
    {
        $this->assertTrue($this->executevalidation('(541) 754-3010'));
    }

    public function testUsInternationalIsValid()
    {
        $this->assertTrue($this->executevalidation('+1-541-754-3010'));
    }

    public function testUsDialedInUsIsValid()
    {
        $this->assertTrue($this->executevalidation('1-541-754-3010'));
    }

    public function testUsDialedFromGermanyIsValid()
    {
        $this->assertTrue($this->executevalidation('001-541-754-3010'));
    }

    public function testUsDialedFromFranceIsValid()
    {
        $this->assertTrue($this->executevalidation('191 541 754 3010'));
    }

    public function testGermanLocalIsValid()
    {
        $this->assertTrue($this->executevalidation('636-48018'));
    }

    public function testGermanDomesticIsValid()
    {
        $this->assertTrue($this->executevalidation('(089) / 636-48018'));
    }

    public function testGermanInternationalIsValid()
    {
        $this->assertTrue($this->executevalidation('+49 89 63648018'));
    }

    public function testGermanFromFranceIsValid()
    {
        $this->assertTrue($this->executevalidation('19 49 89 63648018'));
    }

    public function testValueIsInvalid()
    {
        $this->assertFalse($this->executevalidation('This ist not a phone number'));
    }

    public function testDefaultMessage()
    {
        $this->assertEquals(
            'value is not a valid phone number',
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

    private function executevalidation($value)
    {
        return $this->rule->validate($value);
    }
}
 