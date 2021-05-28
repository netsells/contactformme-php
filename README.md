# ContactForm.me PHP Wrapper

A wrapper round the contactform.me service

It is created and maintained by the [Netsells team](https://netsells.co.uk/)

## Usage

```php
$postman = new Netsells\ContactFormMe\Postman('CFMEPOSTIDENTIFIERHERE');

$postman->deliver([
    'name' => 'Sam Jordan',
    'email' => 'sam@netsells.co.uk',
    'message' => 'Hello! This is a postman test.',
]);
```

You can also specify the form name in the second argument of the constructor.

```php
$postman = new Netsells\ContactFormMe\Postman('CFMEPOSTIDENTIFIERHERE', 'quote_form');
```
