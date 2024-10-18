<?php

namespace Launchpad\Dependencies\LaunchpadCore\Container;

abstract class AbstractServiceProvider {
	abstract protected function define();
}

namespace Launchpad\Subnamespace;

use Launchpad\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider {

	/**
	 * Define your services.
	 *
	 * @return void
	 */
	protected function define() {
		// Add your services.
		$test = $this->getContainer()->get( '' );
	}
}
