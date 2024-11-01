<?php
/**
 * Handle Activation/Deactivation actions.
 *
 * @package YoubouCodeBlock
 * @since 1.0.0
 */

namespace YoubouCodeBlock;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/**
 * Install class
 */
final class Toggle {

	/**
	 * Activate action.
	 */
	public function activate() {

		do_action( 'youboucodeblock_activate' );
	}

	/**
	 * Deactivate action.
	 */
	public function deactivate() {

		do_action( 'youboucodeblock_deactivate' );
	}
}
