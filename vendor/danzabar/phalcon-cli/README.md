CLI Tools for the Phalcon Framework
===================================

[![Build Status](https://travis-ci.org/Danzabar/phalcon-cli.svg?branch=master)](https://travis-ci.org/Danzabar/phalcon-cli) [![Coverage Status](https://coveralls.io/repos/Danzabar/phalcon-cli/badge.png?branch=master)](https://coveralls.io/r/Danzabar/phalcon-cli?branch=master) [![Latest Stable Version](https://poser.pugx.org/danzabar/phalcon-cli/v/stable.svg)](https://packagist.org/packages/danzabar/phalcon-cli) [![Total Downloads](https://poser.pugx.org/danzabar/phalcon-cli/downloads.svg)](https://packagist.org/packages/danzabar/phalcon-cli) [![Latest Unstable Version](https://poser.pugx.org/danzabar/phalcon-cli/v/unstable.svg)](https://packagist.org/packages/danzabar/phalcon-cli) [![License](https://poser.pugx.org/danzabar/phalcon-cli/license.svg)](https://packagist.org/packages/danzabar/phalcon-cli)

An expansion to the Phalcon Frameworks CLI Classes. This includes things like Questions, Confirmation, Command test class, Input/Output Streams and Application wrapper that allows you to start a CLI with minimal Effort.

## Setting up your application

Setting up your CLI app is easy, heres a little example:

	#!/usr/bin/env php
	<?php 

	$app = new Danzabar\CLI\Application;

	// Add your Tasks
	$app->add(new MyTask);

	try {
		
		$app->start($argv);

	} catch(\Exception $e) {
		
		echo $e->getMessage();
		exit(255);
	}
	
Want to use your own DI instance? cool:

	#!/usr/bin/env php
	<?php 

	$di = new Phalcon\DI;
	$app = new Danzabar\CLI\Application($di);

	$app->add(new Task);

	$app->start($argv);

See the documentation below for more details, how to create task classes, setup argument and option variables and more...

## Documentation

 - [Installation](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Installation.md)
 - [Writing Tasks](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Writing%20Tasks.md)
 - [Working with params](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Working%20With%20Params.md)
 - [Arguments and Options](https://github.com/Danzabar/phalcon-cli/blob/master/docs/InputArgumentInputOption.md)
 - [Input Output](https://github.com/Danzabar/phalcon-cli/blob/master/docs/InputOutput.md)
 - [Helpers](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Helpers.md)
 - [Questions](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Questions.md)
 - [Confirmation](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Confirmation.md)
 - [Tables](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Tables.md)
 - [Format](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Formats.md)
 - [Testing Commands](https://github.com/Danzabar/phalcon-cli/blob/master/docs/Testing%20Commands.md)

## Look to the source

The source code and tests contain a lot of usage practises and tricks for using this, so if you are unsure, take a look it might point you in the right direction!

## Contributing
If you want to contribute, great. Just fork this repo and make a pull request with changes. 
