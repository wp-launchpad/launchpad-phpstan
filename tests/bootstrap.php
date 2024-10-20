<?php
namespace Launchpad\Dependencies\LaunchpadCore\Container;

abstract class AbstractServiceProvider {
	abstract protected function define();
}

class Options {

}

require_once __DIR__ . '/../vendor/autoload.php';