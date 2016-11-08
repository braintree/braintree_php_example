# Braintree PHP Example

[![Build Status](https://travis-ci.org/braintree/braintree_php_example.svg?branch=master)](https://travis-ci.org/braintree/braintree_php_example)

An example Braintree integration for PHP.

## Setup Instructions

1. Install composer within the example directory. You can find instructions on how to install composer [on composer's site](https://getcomposer.org/download/).

2. Run composer:

  ```sh
  php composer.phar install
  ```

  Or if you installed composer globally:

  ```sh
  composer install
  ```

3. Copy the contents of `example.env` into a new file named `.env` and fill in your Braintree API credentials. Credentials can be found by navigating to Account > My User > View Authorizations in the Braintree Control Panel. Full instructions can be [found on our support site](https://articles.braintreepayments.com/control-panel/important-gateway-credentials#api-credentials).

4. Start the internal PHP server on port 3000:

  ```sh
  php -S localhost:3000 -t public_html
  ```

## Deploying to Heroku

You can deploy this app directly to Heroku to see the app live. Skip the setup instructions above and click the button below. This will walk you through getting this app up and running on Heroku in minutes.

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/braintree/braintree_php_example&env[BT_ENVIRONMENT]=sandbox)

## Running Tests

All tests are integration tests. Integration tests make API calls to Braintree and require that you set up your Braintree credentials. You can run this project's integration tests by adding your sandbox API credentials to `.env` and running `./vendor/bin/phpunit --testsuite integration` on the command line.

## Testing Transactions

Sandbox transactions must be made with [sample credit card numbers](https://developers.braintreepayments.com/reference/general/testing/php#credit-card-numbers), and the response of a `Braintree_Transaction::sale()` call is dependent on the [amount of the transaction](https://developers.braintreepayments.com/reference/general/testing/php#test-amounts).

## Pro Tips

 * Run `php -S 0.0.0.0:3000 -t public_html` when launching the internal PHP server to listen on all interfaces on port 3000.

## Help

 * Found a bug? Have a suggestion for improvement? Want to tell us we're awesome? [Submit an issue](https://github.com/braintree/braintree_php_example/issues)
 * Trouble with your integration? Contact [Braintree Support](https://support.braintreepayments.com/) / support@braintreepayments.com
 * Want to contribute? [Submit a pull request](https://help.github.com/articles/creating-a-pull-request)

## Disclaimer

This code is provided as is and is only intended to be used for illustration purposes. This code is not production-ready and is not meant to be used in a production environment. This repository is to be used as a tool to help merchants learn how to integrate with Braintree. Any use of this repository or any of its code in a production environment is highly discouraged.
