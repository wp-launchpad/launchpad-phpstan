<?php

namespace Launchpad;

class Subscriber {

	/**
	 * Enqueue assets.
	 *
	 * @hook
	 */
	public function enqueue() {
		if ( has_block( 'my-block' ) ) {
			return;
		}

		wp_register_script( 'my_key', '/app.js', [ 'jquery' ], '1.0.0', false );
	}
}