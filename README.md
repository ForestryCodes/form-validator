# Forestry Form validator

[![Latest Version](https://img.shields.io/github/release/ForestryCodes/form-validator.svg?style=flat-square)](https://github.com/ForestryCodes/form-validator/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/ForestryCodes/form-validator/master.svg?style=flat-square)](https://travis-ci.org/ForestryCodes/log)
[![Codacy Badge](https://www.codacy.com/project/badge/fee5eb49eb604e1697d756d433f3ecd8)](https://www.codacy.com/app/forestrycodes/form-validator)
[![Total Downloads](https://img.shields.io/packagist/dt/forestry/form-validator.svg?style=flat-square)](https://packagist.org/packages/forestry/form-validator)

Library to validate form data based on rules.

## Install
Via Composer

```bash
$ composer require forestry/form-validator
```

## Usage
### Create a validator
```php
$validator = new Forestry\FormValidator\Validator();
```

### Define a ruleset for a form
```php
$rules = [
    'name' => 'alpha|required',
    'age' => 'num|required',
];
```

### Validate the form data
```php
$validator->validate($_POST, $rules);

if ($validator->hasErrors()) {
    $errors = $validator->getErrors();
}
```

### Show error message
```html
<label for="name">Name</label>
<input type="text" name="name" id="name">
<?= (!empty(Forestry\FormValidator\Validator::error('name')) ? Forestry\FormValidator\Validator::error('name') : '') ?>
```

You can also wrap error messages with custom markup:

```php
Forestry\FormValidator\Validator::error('confirm_password', '<span class="text-danger">{message}</span>');
```

## Rules
This package comes with the following built-in rules:

| Rule | Parameter | Description |
| --- | --- | --- |
| alpha | none | Allows only text, space, . and - |
| alphanum | none | Allows text and numerical values |
| boolean | none | Checks if the value can be interpreted as a boolean true (`true`, `1`, `yes` or `on`).  |
| date | format | Checks if the value is a valid date, time or date-time string. You can provide a date format to check against. |
| email | none | Checks if the value is a valid email address. |
| float | none | Checks if the value is a valid float value. |
| integer | none | Checks if the value is a valid integer value. |
| ip | none | Checks if the value is a valid IP address. |
| max | number | Checks if the value exceeds `number` characters. |
| min | number | Checks if the value has at least `number` characters. |
| natural | none | Checks if the value is a natural number. |
| number | none | Checks if the value is a number. |
| phone | none | Checks if the value is a valid phone number format. |
| required | none | Checks if the value is set. |
| same | fieldname | Compares if the value matches with the one in `fieldname`. |
| url | none | Checks if the value is a valid URL. |

### `same` rule example
With this rule, you can define that two fields must have the same value, e.g. password fields:

```php
$rules['password'] = 'required|min:8';
$rules['confirm_password'] = 'same:password';
```

### Custom messages
Instead of using the default error messages, you can also pass a custom one with each rule:

```php
$rules['tos'] = "required--Please accept the terms of service";
```

### Custom rules
You can define your own rules:

First, create a class which implements the `Forestry\FormValidator\SimpleRuleInterface` or `Forestry\FormValidator\ParameterRuleInterface`. The later on is used for rules whose have a parameter.

```php
use Forestry\FormValidator\SimpleRuleInterface;

MyRule implements SimpleRuleInterface
{
    public function validate($value)
    {
        // Your code.
    }
    
    public function getMessage($value)
    {
        // Your code.
    }
}
```

Next, register your rule with a name and the full qualified class name.

```php
$validator->registerRule('myrule', '\MyRule');
```

If you want to change an already registered rule, use the `updateRule()` method.

```php
$validator->updateRule('url', '\MyRule');
```

## Testing
``` bash
$ phpunit
```

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits
- [daniel-melzer](https://github.com/daniel-melzer)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.