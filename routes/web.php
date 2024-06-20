<?php

use Minamell\Minamell\Router;

Router::get("/", function () {
	return die("Hello");
});
