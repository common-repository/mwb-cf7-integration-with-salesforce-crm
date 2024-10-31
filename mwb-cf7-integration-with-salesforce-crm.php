<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://makewebbetter.com
 * @since             1.0.0
 * @package           Mwb_Cf7_Integration_With_Salesforce_Crm
 *
 * @wordpress-plugin
 * Plugin Name:       MWB CF7 Integration with Salesforce
 * Plugin URI:        https://wordpress.org/plugins/mwb-cf7-integration-with-salesforce-crm
 * Description:       MWB CF7 Integration with Salesforce sends over your multiple Contact form 7 submissions to Salesforce based on its modules with error email notifications and a complete log of synced contact forms.
 * Version:           1.0.2
 * Author:            MakeWebBetter
 * Author URI:        https://makewebbetter.com/?utm_source=MWB-salesforce-org&utm_medium=MWB-org-backend&utm_campaign=MWB-salesforce-site
 *
 * Requires at least: 4.0
 * Tested up to:      5.8.1
 *
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       mwb-cf7-integration-with-salesforce-crm
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// check if cf7 is activated.
if ( ! mwb_sf_cf7_is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
	// wc not activated, show error and return.
	add_action( 'admin_init', 'mwb_sf_cf7_plugin_deactivate' );
	return;
}

// All set activate the plugin.
register_activation_hook( __FILE__, 'activate_mwb_cf7_integration_with_salesforce_crm' );
register_deactivation_hook( __FILE__, 'deactivate_mwb_cf7_integration_with_salesforce_crm' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mwb-cf7-integration-with-salesforce-crm.php';

// define plugin constants.
define_mwb_sf_cf7();

// begin plugin execution.
run_mwb_cf7_integration_with_salesforce_crm();


/**
 * Deactivate plugin hook admin notice.
 */
function mwb_sf_cf7_plugin_deactivate() {
	deactivate_plugins( plugin_basename( __FILE__ ) );
	add_action( 'admin_notices', 'mwb_sf_cf7_plugin_error_notice' );
}

/**
 * Show admin notice on plugin deactivation
 */
function mwb_sf_cf7_plugin_error_notice() {

	$dependent = esc_html__( 'Contact Form 7', 'mwb-cf7-integration-with-salesforce-crm' );
	$plugin    = esc_html__( 'MWB CF7 Integration with Salesforce', 'mwb-cf7-integration-with-salesforce-crm' );
	?>

	<div class="error notice is-dismissible">
		<p>
			<?php
			printf(
				/* translators: %1$s: Dependent plugin, %2$s: The plugin. */
				esc_html__( ' %1$s is not activated, Please activate %1$s first to activate %2$s', 'mwb-cf7-integration-with-salesforce-crm' ),
				'<strong>' . esc_html( $dependent ) . '</strong>',
				'<strong>' . esc_html( $plugin ) . '</strong>'
			);
			?>
		</p>
	</div>
	<?php

	// To hide Plugin activated notice.
	unset( $_GET['activate'] ); // phpcs:ignore
}

/**
 * Function to check for plugin activation.
 *
 * @param    string $slug   Slug of the plugin.
 * @return   bool
 */
function mwb_sf_cf7_is_plugin_active( $slug = '' ) {

	if ( empty( $slug ) ) {
		return;
	}

	$active_plugins = get_option( 'active_plugins', array() );

	if ( is_multisite() ) {
		$active_plugins = array_merge( $active_plugins, get_option( 'active_sitewide_plugins', array() ) );
	}

	return in_array( $slug, $active_plugins, true ) || array_key_exists( $slug, $active_plugins );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mwb-cf7-integration-with-salesforce-crm-activator.php
 */
function activate_mwb_cf7_integration_with_salesforce_crm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mwb-cf7-integration-with-salesforce-crm-activator.php';
	Mwb_Cf7_Integration_With_Salesforce_Crm_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mwb-cf7-integration-with-salesforce-crm-deactivator.php
 */
function deactivate_mwb_cf7_integration_with_salesforce_crm() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mwb-cf7-integration-with-salesforce-crm-deactivator.php';
	Mwb_Cf7_Integration_With_Salesforce_Crm_Deactivator::deactivate();
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mwb_cf7_integration_with_salesforce_crm() {

	$plugin = new Mwb_Cf7_Integration_With_Salesforce_Crm();
	$plugin->run();

}

/**
 * Define Plugin Contants
 */
function define_mwb_sf_cf7() {
	mwb_sf_cf7_constant( 'MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_VERSION', '1.0.2' );
	mwb_sf_cf7_constant( 'MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL', plugin_dir_url( __FILE__ ) );
	mwb_sf_cf7_constant( 'MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_DIRPATH', plugin_dir_path( __FILE__ ) );
	mwb_sf_cf7_constant( 'MWB_CF7_SF_ONBOARD_PLUGIN_NAME', 'MWB CF7 Integration with Salesforce' );
}

/**
 * Defining Constants
 *
 * @param string $name Name of constant.
 * @param string $value Value of contant.
 */
function mwb_sf_cf7_constant( $name, $value ) {
	if ( ! defined( $name ) ) {
		define( $name, $value );
	}
}

// If pro version is inactive add setings link to org version.
if ( ! mwb_sf_cf7_is_plugin_active( 'cf7-integration-with-salesforce-crm/cf7-integration-with-salesforce-crm.php' ) ) {

	// Add settings link in plugin action links.
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'mwb_sf_cf7_settings_link' );

	/**
	 * Add settings link callback.
	 *
	 * @since  1.0.0
	 * @param  string $links link to the admin area of the plugin.
	 * @return array
	 */
	function mwb_sf_cf7_settings_link( $links ) {
		$plugin_links = array(
			'<a href="' . admin_url( 'admin.php?page=mwb_salesforce_cf7_page&tab=accounts' ) . '">' . esc_html__( 'Settings', 'mwb-cf7-integration-with-salesforce-crm' ) . '</a>',
			'<a style="background: #2196f3; color: white; font-weight: 700; padding: 2px 5px; border: 1px solid #2196f3; border-radius: 10px;" href="' . esc_url( 'https://makewebbetter.com/product/cf7-integration-with-salesforce/?utm_source=MWB-salesforce-site&utm_medium=MWB-site-backend&utm_campaign=MWB-salesforce-site' ) . '" target="_blank">' . esc_html__( 'GO PRO', 'mwb-cf7-integration-with-salesforce-crm' ) . '</a>',
		);

		return array_merge( $plugin_links, $links );
	}
}

add_filter( 'plugin_row_meta', 'mwb_sf_cf7_important_links', 10, 2 );

/**
 * Add custom links.
 *
 * @param   string $links   Link to index file of plugin.
 * @param   string $file    Index file of plugin.
 * @since   1.0.0
 * @return  array
 */
function mwb_sf_cf7_important_links( $links, $file ) {
	if ( strpos( $file, 'mwb-cf7-integration-with-salesforce-crm.php' ) !== false ) {

		$row_meta = array(
			'demo'    => '<a href="' . esc_url( 'https://demo.makewebbetter.com/mwb-cf7-integration-salesforce-crm/?utm_source=MWB-salesforce-org&utm_medium=MWB-org-backend&utm_campaign=MWB-salesforce-demo' ) . '" target="_blank"><img src="' . MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/Demo.svg" style="width: 20px;padding-right: 5px;"></i>' . esc_html__( 'Demo', 'mwb-cf7-integration-with-salesforce-crm' ) . '</a>',
			'doc'     => '<a href="' . esc_url( 'https://docs.makewebbetter.com/mwb-cf7-integration-salesforce-crm/?utm_source=org&utm_medium=plugin-backend&utm_campaign=salesforce' ) . '" target="_blank"><img src="' . MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/Documentation.svg" style="width: 20px;padding-right: 5px;"></i>' . esc_html__( 'Documentation', 'mwb-cf7-integration-with-salesforce-crm' ) . '</a>',
			'support' => '<a href="' . esc_url( 'https://makewebbetter.com/contact-us/?utm_source=org&utm_medium=plugin-backend&utm_campaign=salesforce' ) . '" target="_blank"><img src="' . MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/Support.svg" style="width: 20px;padding-right: 5px;"></i>' . esc_html__( 'Support', 'mwb-cf7-integration-with-salesforce-crm' ) . '</a>',
		);

		return array_merge( $links, $row_meta );
	}

	return (array) $links;
}
