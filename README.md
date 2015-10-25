# finder.com.au Developer Test

The assumption is that you have PHP and Git installed.

Installation steps:
==
 - Install composer
    - Linux/OSX --  https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
    - Windows -- https://getcomposer.org/doc/00-intro.md#installation-windows
 - Then run the following commands in a terminal window
```
git clone git@github.com:finderau/backend-test.git
cd backend-test
composer install
```

Once composer finishes installing, PHPUnit will be installed in `vendor/bin/phpunit`.

The idea around this test is to get all the unit tests in `tests/HelpersTest.php` to pass. If you run `vendor/bin/phpunit` you will see some tests are currently failing.

There is also
 - Code in `src/Helpers.php` that doesn't currently have unit tests
 - Unit tests that don't have matching code

The Test
==

- Make all existing unit tests pass
- Write new unit tests for following methods
    - `pluralize`
- Write methods for the following unit tests
    - `currency`
    - `list`
