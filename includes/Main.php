<?php
/**
 * Main Class.
 *
 * @package YoubouCodeBlock
 * @since 1.0.0
 */

namespace YoubouCodeBlock;

use YoubouCodeBlock\Block;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin main class.
 */
final class Main {

	/**
	 * Set the minimum required versions for the plugin.
	 */
	const PLUGIN_REQUIREMENTS = array(
		'php_version' => '7.2',
		'wp_version'  => '5.2',
	);

	/**
	 * Constructor
	 */
	public function init() {

		$toggle = new Toggle();

		register_activation_hook( PLUGIN_FILE, array( $toggle, 'activate' ) );
		register_deactivation_hook( PLUGIN_FILE, array( $toggle, 'deactivate' ) );

		add_action( 'plugins_loaded', array( $this, 'load' ) );
	}

	/**
	 * Include plugins files and hook into actions and filters.
	 *
	 * @since  1.0.0
	 */
	public function load() {

		if ( ! $this->check_plugin_requirements() ) {
			return;
		}

		$blocks = new Block();
		$blocks->hooks();

		load_plugin_textdomain( 'youbou-code-block', false, plugin_basename( PLUGIN_FILE ) . '/languages' );

		do_action( 'youboucodeblock_loaded' );
	}

	/**
	 * Checks all plugin requirements. If run in admin context also adds a notice.
	 *
	 * @return boolean
	 */
	private function check_plugin_requirements() {

		$errors = array();
		global $wp_version;

		if ( ! version_compare( PHP_VERSION, self::PLUGIN_REQUIREMENTS['php_version'], '>=' ) ) {
			/* Translators: The minimum PHP version */
			$errors[] = sprintf( esc_html__( 'Youbou Show Hooks Plugin requires a minimum PHP version of %s.', 'youbou-code-block' ), self::PLUGIN_REQUIREMENTS['php_version'] );
		}

		if ( ! version_compare( $wp_version, self::PLUGIN_REQUIREMENTS['wp_version'], '>=' ) ) {
			/* Translators: The minimum WP version */
			$errors[] = sprintf( esc_html__( 'Youbou Show Hooks Plugin requires a minimum WordPress version of %s.', 'youbou-code-block' ), self::PLUGIN_REQUIREMENTS['wp_version'] );
		}

		if ( empty( $errors ) ) {
			return true;
		}

		if ( Utils::is_request( 'admin' ) ) {

			add_action(
				'admin_notices',
				function () use ( $errors ) {
					?>
						<div class="notice notice-error">
							<?php
							foreach ( $errors as $error ) {
								echo '<p>' . esc_html( $error ) . '</p>';
							}
							?>
						</div>
					<?php
				}
			);

			return;
		}

		return false;
	}
}
