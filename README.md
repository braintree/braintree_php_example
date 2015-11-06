# braintree_php_example
An example Braintree integration for PHP.

## Setup Instructions

1. Install composer. You can find instructions on how to install composer [on composer's site](https://getcomposer.org/download/).

2. Run composer
  `php composer.phar install`

  Or if you installed composer globally:
  `composer install`

3. Copy the `example.env` file to `.env` and fill in your Braintree API credentials. Credentials can be found by navigating to Account > My user > View API Keys in the Braintree control panel. Full instructions can be [found on our support site](https://articles.braintreepayments.com/control-panel/important-gateway-credentials#api-credentials).

4. Start the internal PHP server on port 3000
   `php -S localhost:3000 -t public_html`

## Running Tests

All tests are integration tests. Integration tests make api calls to Braintree and require that you set up your Braintree credentials. You can run this project's integration tests by adding your sandbox api credentials to `.env` and running `./vendor/bin/phpunit --testsuite integration` on the command line.

## Pro Tips

 * Run `php -S 0.0.0.0:3000 -t public_html` when launching the internal PHP server to listen on all interfaces on port 3000.

## Disclaimer

This code is provided as is and is only intended to be used for illustration purposes. This code is not production-ready and is not meant to be used in a production environment. This repository is to be used as a tool to help merchants learn how to integrate with Braintree. Any use of this repository or any of its code in a production environment is highly discouraged.
