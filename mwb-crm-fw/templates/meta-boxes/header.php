<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the header of feeds section.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    Mwb_Cf7_Integration_With_Zoho
 * @subpackage Mwb_Cf7_Integration_With_Zoho/includes/framework/templates/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7__feeds-wrap">
	<div class="mwb-sf_cf7__logo-wrap">
		<div class="mwb-sf_cf7__logo-zoho">
			<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/salesforce-logo.png' ); ?>" alt="<?php esc_html_e( 'Salesforce', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
		</div>
		<div class="mwb-sf_cf7__logo-contact">
			<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/contact-form.svg' ); ?>" alt="<?php esc_html_e( 'CF7', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
		</div>
	</div>

