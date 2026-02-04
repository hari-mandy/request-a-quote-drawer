<?php

namespace Mandy\QuoteDrawer;

/**
 * Plugin Name:       Request a Quote Drawer
 * Description:       This plugin contains the clairfi tax calculator and elite access registration form.
 * Version:           0.0.1
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Mandy Technologies
 * Author URI:        https://mandytechnologies.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       clairfi-calculator
 * Requires Plugins:  woocommerce-request-a-quote
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/includes/class-quote-drawer.php';

class Quote_Drawer_Initial {

	public static function init() {
		add_action( 'wp_footer', [ __CLASS__, 'render_drawer' ] );
	}

	public static function render_drawer() {
		?>
		<div id="quote-drawer">
			<div class="qd-overlay"></div>
			<div class="qd-panel">
				<button class="qd-close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path></svg></button>
				<h2>Your Quote</h2>
				<div id="qd-content"><?php Quote_Drawer::html_structure(); ?><a href="/request-a-quote" class="wc-block-components-button wp-element-button">Go to Quote Page</a></div>
			</div>
		</div>
		<?php
	}
}

add_action( 'plugins_loaded', function () {

	if ( ! class_exists( 'WooCommerce' ) || ! class_exists( 'Addify_Request_For_Quote' ) ) {
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-error"><p>
				Quote Drawer requires WooCommerce and Request a Quote for WooCommerce (Addify).
			</p></div>';
		} );
		return;
	}

	\Mandy\QuoteDrawer\Quote_Drawer_Initial::init();
	require_once __DIR__ . '/includes/enqueuer.php';

});


