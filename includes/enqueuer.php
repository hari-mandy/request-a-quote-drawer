<?php

namespace Clarifi\Calculator;

if (! defined('ABSPATH')) {
	exit;
}

if (! class_exists('\Clarifi\Calculator\Enqueuer')) {

	class Enqueuer {

		public static function setup() {
			add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);
			add_action('admin_enqueue_scripts', [__CLASS__, 'admin_enqueue_scripts']);
		}

		/**
		 * Frontend assets
		 */
		public static function enqueue_scripts() {

			$plugin_dir = plugin_dir_path(dirname(__FILE__));
			$plugin_url = plugin_dir_url(dirname(__FILE__));

			$asset_path = $plugin_dir . 'build/main.asset.php';

			if (! file_exists($asset_path)) {
				return;
			}

			$asset = include $asset_path;

			wp_enqueue_script(
				'clarifi-calculator-main',
				$plugin_url . 'build/main.js',
				$asset['dependencies'],
				$asset['version'],
				true
			);

			wp_enqueue_style(
				'clarifi-calculator-main',
				$plugin_url . 'build/main.css',
				[],
				$asset['version']
			);
		}

		/**
		 * Admin assets
		 */
		public static function admin_enqueue_scripts($hook) {

			$plugin_dir = plugin_dir_path(dirname(__FILE__));
			$plugin_url = plugin_dir_url(dirname(__FILE__));

			$asset_path = $plugin_dir . 'build/admin.asset.php';

			if (! file_exists($asset_path)) {
				return;
			}

			$asset = include $asset_path;

			wp_enqueue_script(
				'clarifi_calculator_admin',
				$plugin_url . 'build/admin.js',
				$asset['dependencies'],
				$asset['version'],
				true
			);

			wp_enqueue_style(
				'clarifi_calculator_admin',
				$plugin_url . 'build/admin.css',
				[],
				$asset['version']
			);
		}
	}

	// Register hooks
	add_action('init', ['\\Clarifi\\Calculator\\Enqueuer', 'setup']);
}
