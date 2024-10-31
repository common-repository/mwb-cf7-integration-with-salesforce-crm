<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://makewebbetter.com/
 * @since      1.0.3
 *
 * @package    Mwb_Cf7_Integration_With_Zoho_Crm
 * @subpackage Mwb_Cf7_Integration_With_Zoho_Crm/setup
 */

?>
<div class="mwb-crm-setup-content-wrap">
	<div class="mwb-crm-setup-list-wrap">
		<ul class="mwb-crm-setup-list">

			<?php if ( 'api' == $method ) : // phpcs:ignore ?>
				<?php if ( 'yes' == $custom_app ) : // phpcs:ignore ?>
					<li>
						<?php esc_html_e( 'Login to your Salesforce account.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Click on the settings icon at the right top menu.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Click on setup. It will open a new tab.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'In the new screen, search for "App Manager" in the search box provided at the left section.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Click on the App Manager. A new screen will appear listing all the available apps.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Click on "New Connected App".', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'It will lead to open a form to create a new connected app.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Fill up mandatory informations like "Connected App Name" and "Contact Email".', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Enable OAuth Settings by checking the checkbox next to it.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php
						echo wp_kses(
							sprintf(
							/* translators: Feed object name */
								__( 'Enter  <strong> %s </strong> as call back url.', 'mwb-cf7-integration-with-salesforce-crm' ),
								$params['callback_url']
							),
							$params['allowed_html']
						);
						?>
					</li>
					<li>
						<?php esc_html_e( 'Select OAuth Scopes "Access and manage your data (api)" and "Perform requests on your behalf at any time (refresh_token, offline_access)".', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Scroll down to the bottom and click on save.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'New app will be created and you will be redirected to the app details page.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Copy "Consumer key" and "Consumer Sceret" from there and enter it in Authentication form.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<img style="width: 100%; border: 2px solid;" src="<?php echo esc_url( $params['api_key_image'] ); ?>">
				<?php else : ?>
					<li>
						<?php esc_html_e( 'Click on login and authorize button.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'It will redirect you to salesforce login panel.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'After successful login, it will redirect you to consent page, where it will ask your permissions to access the data.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>
					<li>
						<?php esc_html_e( 'Click on allow, it should redirect back to your plugin admin page and your connection part is done.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</li>

				<?php endif; ?>
			<?php else : ?>
				<li>
					<?php esc_html_e( 'In Salesforce Go to Company Information -> Salesforce.com Organization ID', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
				</li>
				<li>
					<?php esc_html_e( 'Enter your Salesforce domain with https( For e.g: https://example.salesforce.com ) in Salesforce Domain field. This field is Optional.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
				</li>
				<img style="width: 100%; border: 2px solid;" src="<?php echo esc_url( $params['web_key_image'] ); ?>">
			<?php endif; ?>

			<li>
			<?php
			echo wp_kses(
				sprintf(
				/* translators: Feed object name */
					__( 'Still facing issue! Please check detailed app setup <a href="%s" target="_blank"  >documentation</a>.', 'mwb-cf7-integration-with-zoho' ),
					$params['setup_guide_url']
				),
				$params['allowed_html']
			);
			?>
			</li>
		</ul>
`
	</div>
</div>
