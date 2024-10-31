<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the settings page.
 *
 * @link       https://makewebbetter.com
 * @since      1.0.0
 *
 * @package    Mwb_Cf7_Integration_With_Salesforce_Crm
 * @subpackage Mwb_Cf7_Integration_With_Salesforce_Crm/admin/partials/templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="mwb_sf_cf7__account-wrap">

	<div class="mwb-sf_cf7__logo-wrap">
		<div class="mwb-sf_cf7__logo-salesforce">
			<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/salesforce-logo.png' ); ?>" alt="<?php esc_html_e( 'Salesforce', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
		</div>
		<div class="mwb-sf_cf7__logo-contact">
			<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/contact-form.svg' ); ?>" alt="<?php esc_html_e( 'CF7', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
		</div>
	</div>

	<form method="post" id="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7_settings_form">

		<div class="mwb_sf_cf7_table_wrapper">
			<table class="mwb_sf_cf7_table">
				<tbody>

					<!-- Enable logs start -->
					<tr>
						<th>
							<label><?php esc_html_e( 'Enable logs', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>
						</th>

						<td>
							<?php
							$desc = esc_html__( 'Enable logging of all the form data to be sent over salesforce', 'mwb-cf7-integration-with-salesforce-crm' );
							echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );

							$enable_logs = ! empty( $params['option']['enable_logs'] ) ? sanitize_text_field( wp_unslash( $params['option']['enable_logs'] ) ) : '';
							?>
							<input type="checkbox" name="mwb_setting[enable_logs]" value="yes" <?php checked( 'yes', $enable_logs ); ?>>
						</td>
					</tr>
					<!-- Enable logs end-->

					<!-- Data delete start -->
					<tr>
						<th>
							<label><?php esc_html_e( 'Plugin Data', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>
						</th>

						<td>
							<?php
							$desc = esc_html__( 'Enable to delete the plugin data after uninstallation of plugin', 'mwb-cf7-integration-with-salesforce-crm' );
							echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );

							$data_delete = ! empty( $params['option']['data_delete'] ) ? sanitize_text_field( wp_unslash( $params['option']['data_delete'] ) ) : '';
							?>
							<input type="checkbox" name="mwb_setting[data_delete]" value="yes"  <?php checked( 'yes', $data_delete ); ?>>
						</td>
					</tr>
					<!-- data delete end -->

					<!-- Enable email notif start -->
					<tr>
						<th>
							<label><?php esc_html_e( 'Email notification', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>
						</th>

						<td>
							<?php
								$desc = esc_html__( 'Enable email notification on errors when connected via REST API while it sends debug Email when connected via Web-to-Lead/Web-to-Case', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );

								$enable_notif = ! empty( $params['option']['enable_notif'] ) ? sanitize_text_field( wp_unslash( $params['option']['enable_notif'] ) ) : '';
							?>
							<input type="checkbox" name="mwb_setting[enable_notif]" value="yes" <?php checked( 'yes', $enable_notif ); ?> >
						</td>
					</tr>
					<!-- Enable email notif end -->

					<!-- Email field start -->
					<tr >
						<th>
						</th>
						<td>
							<div id="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7_email_notif" class="<?php echo esc_attr( ( 'yes' != $enable_notif ) ? 'is_hidden' : '' ); // phpcs:ignore ?>">
								<?php

									$email_notif = ! empty( $params['option']['email_notif'] ) ? sanitize_email( wp_unslash( $params['option']['email_notif'] ) ) : get_bloginfo( 'admin_email' );
								?>
								<input type="email" name="mwb_setting[email_notif]" value="<?php echo esc_html( $email_notif ); ?>" >
							</div>
						</td>
					</tr>	
					<!-- Email field end -->

					<!-- Delete logs start -->
					<tr>
						<th>
							<label><?php esc_html_e( 'Delete logs after N days', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>
						</th>

						<td>
							<?php
							$desc = esc_html__( 'This will delete the logs data after N no. of days', 'mwb-cf7-integration-with-salesforce-crm' );
							echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );

							$delete_logs = ! empty( $params['option']['delete_logs'] ) ? sanitize_text_field( wp_unslash( $params['option']['delete_logs'] ) ) : 7;
							?>
							<input type="number" name="mwb_setting[delete_logs]" min="7" maxlenght="4" step="1" pattern="[0-9]" value="<?php echo esc_html( $delete_logs ); ?>">
						</td>
					</tr>
					<!-- Delete logs end -->

					<?php do_action( 'mwb_' . $this->crm_slug . '_cf7_add_settings' ); ?>

					<!-- Save settings start -->
					<tr>
						<th>
						</th>
						<td>
							<input type="submit" name="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7_submit_setting" class="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7_submit_setting" value="<?php esc_html_e( 'Save', 'mwb-cf7-integration-with-salesforce-crm' ); ?>" >
						</td>
					</tr>
					<!-- Save settings end -->

				</tbody>
			</table>
		</div>
	</form>
</div>
