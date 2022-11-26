<?php
spl_autoload_register(function ($class) {
  return include dirname(__DIR__) . "/include/" . $class . ".php";
});
