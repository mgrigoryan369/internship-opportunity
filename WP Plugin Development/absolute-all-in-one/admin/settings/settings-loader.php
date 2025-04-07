<?php // SETTINGS LOADER

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// === General Tab ===
require_once AAIO_PLUGIN_DIR . 'admin/settings/general/register.php';
require_once AAIO_PLUGIN_DIR . 'admin/settings/general/render.php';
require_once AAIO_PLUGIN_DIR . 'admin/settings/general/logic.php';
require_once AAIO_PLUGIN_DIR . 'admin/settings/general/controller.php';

// === Features Tab ===
require_once AAIO_PLUGIN_DIR . 'admin/settings/features/register.php';
require_once AAIO_PLUGIN_DIR . 'admin/settings/features/render.php';
require_once AAIO_PLUGIN_DIR . 'admin/settings/features/logic.php';
require_once AAIO_PLUGIN_DIR . 'admin/settings/features/controller.php';

// === Features: Testimonials (conditionally loads if enabled)
require_once AAIO_PLUGIN_DIR . 'admin/settings/features/testimonials/loader.php';

// === Help Tab  ===
require_once AAIO_PLUGIN_DIR . 'admin/settings/help/controller.php';
require_once AAIO_PLUGIN_DIR . 'admin/settings/help/render.php';
require_once AAIO_PLUGIN_DIR . 'admin/settings/help/logic.php';






