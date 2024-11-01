<?php
/**
 * Handle Gutenberg blocks registration.
 *
 * @package YoubouCodeBlock
 * @since 1.0.0
 */

namespace YoubouCodeBlock;

use ParagonIE\Sodium\Core\Util;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block main class
 */
final class Block {

	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function hooks() {
		add_action( 'init', array( $this, 'register_blocks' ) );
	}

	/**
	 * Register blocks
	 *
	 * @return void
	 */
	public function register_blocks() {
		register_block_type( Utils::plugin_path() . '/build/v-1' );
	}
}
