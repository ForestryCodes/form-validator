<?php

namespace Forestry\FormValidator\Test;

use Forestry\FormValidator\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @type Validator
     */
    private $validator;
    private $ruleset = [
        'name' => 'required|alpha|min:2|max:16',
        'username' => 'required|alphanum|min:2|max:8',
        'tos' => 'required|boolean--You need to accept the terms of service',
        'dob' => 'date',
        'booking' => 'date:Y-m-d H:i--Please select a booking time',
        'mail' => 'email',
        'donation' => 'float',
        'persons' => 'integer',
        'ip' => 'ip',
        'nat' => 'natural',
        'num' => 'number',
        'phone' => 'phone',
        'confirm_mail' => 'same:mail',
        'website' => 'url'
    ];

    public function setUp()
    {
        $this->validator = new Validator();
    }

    public function testInstance()
    {
        $this->assertInstanceOf('Forestry\FormValidator\Validator', $this->validator);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage rule already registered
     */
    public function testExceptionOnAlreadyRegisteredRule()
    {
        $this->validator->registerRule('email', '\Forestry\FormValidator\Rule\EmailRule');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage rule must implement a RuleInterface
     */
    public function testExceptionOnInvalidInterface()
    {
        $this->validator->registerRule('std', '\stdClass');
    }

    public function testUpdateRule()
    {
        $this->validator->updateRule('email', 'Forestry\FormValidator\Rule\EmailRule');
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage rule must implement a RuleInterface
     */
    public function testUpdateExceptionOnInvalidInterface()
    {
        $this->validator->updateRule('std', '\stdClass');
    }

    public function testValidFields()
    {
        $data = [
            'name' => 'John Doe',
            'username' => 'jd1970',
            'tos' => 'on',
            'dob' => '1970-01-01',
            'booking' => '2015-04-13 13:37',
            'mail' => 'john.doe@example.org',
            'donation' => '99.95',
            'persons' => '-1',
            'ip' => '127.0.0.1',
            'nat' => '5',
            'num' => '-23',
            'phone' => '(555) 123-4567',
            'confirm_mail' => 'john.doe@example.org',
            'website' => 'http://example.org/start'
        ];

        $this->validator->validate($data, $this->ruleset);

        $this->assertFalse($this->validator->hasErrors());
    }

    public function testInvalidFields()
    {
        $data = [
            'name' => 'John Doe',
            'username' => 'jd1970',
            'tos' => '',
            'dob' => 'Jan 1970',
            'booking' => '2015-04-13',
            'mail' => 'john.doe@example',
            'donation' => '99,95',
            'persons' => 'one',
            'ip' => '127001',
            'nat' => '-5',
            'num' => '23b',
            'phone' => '5551234567',
            'confirm_mail' => 'john.doe@example.org',
            'website' => 'example'
        ];

        $this->validator->validate($data, $this->ruleset);

        $this->assertTrue($this->validator->hasErrors());
    }

    public function testGetErrors()
    {
        $data = [
            'name' => 'John Doe',
            'username' => 'jd1970',
            'tos' => '',
            'dob' => 'Jan 1970',
            'booking' => '2015-04-13',
            'mail' => 'john.doe@example',
            'donation' => '99,95',
            'persons' => 'one',
            'ip' => '127001',
            'nat' => '-5',
            'num' => '23b',
            'phone' => '5551234567',
            'confirm_mail' => 'john.doe@example.org',
            'website' => 'example'
        ];

        $this->validator->validate($data, $this->ruleset);

        $this->assertArrayHasKey('website', $this->validator->getErrors());
    }

    public function testGetErrorForSingleField()
    {
        $data = [
            'name' => 'John Doe',
            'username' => 'jd1970',
            'tos' => '',
            'dob' => 'Jan 1970',
            'booking' => '2015-04-13',
            'mail' => 'john.doe@example',
            'donation' => '99,95',
            'persons' => 'one',
            'ip' => '127001',
            'nat' => '-5',
            'num' => '23b',
            'phone' => '5551234567',
            'confirm_mail' => 'john.doe@example.org',
            'website' => 'example'
        ];

        $this->validator->validate($data, $this->ruleset);

        $this->assertEquals('value is not a valid URL', Validator::error('website'));
    }

    public function testGetFormattedErrorForSingleField()
    {
        $data = [
            'name' => 'John Doe',
            'username' => 'jd1970',
            'tos' => '',
            'dob' => 'Jan 1970',
            'booking' => '2015-04-13',
            'mail' => 'john.doe@example',
            'donation' => '99,95',
            'persons' => 'one',
            'ip' => '127001',
            'nat' => '-5',
            'num' => '23b',
            'phone' => '5551234567',
            'confirm_mail' => 'john.doe@example.org',
            'website' => 'example'
        ];

        $this->validator->validate($data, $this->ruleset);

        $this->assertEquals(
            '<b>value is not a valid URL</b>',
            Validator::error('website', '<b>{message}</b>')
        );
    }
}
 