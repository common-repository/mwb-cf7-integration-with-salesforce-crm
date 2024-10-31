<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the accounts creation page.
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
$connected = get_option( 'mwb-' . $this->crm_slug . '-cf7-crm-connected', false );

?>
<?php if ( '1' !== get_option( 'mwb-' . $this->crm_slug . '-cf7-active', false ) || '1' !== get_option( 'mwb-' . $this->crm_slug . '-cf7-crm-connected', false ) ) : ?>
	<?php if ( '1' !== $connected ) : ?>
		<section class="mwb-intro">
			<div class="mwb-content-wrap">
				<div class="mwb-intro__header">
					<h2 class="mwb-section__heading">
						<?php
						echo sprintf(
							/* translators: %s: CRM name */
							esc_html__( 'Getting started with CF7 and %s', 'mwb-cf7-integration-with-salesforce-crm' ),
							esc_html( $this->crm_name )
						);
						?>
					</h2>
				</div>
				<div class="mwb-intro__body mwb-intro__content">
					<p>
					<?php
					echo sprintf(
						/* translators: %1$s: CRM name, %2$s: CRM name, %3$s: CRM modules, %4$s: CRM name  */
						esc_html__( 'With this CF7 %1$s Integration you can easily sync all your CF7 Form Submissions data over %2$s . It will create %3$s over %4$s CRM, based on your CF7 Form Feed data.', 'mwb-cf7-integration-with-salesforce-crm' ),
						esc_html( $this->crm_name ),
						esc_html( $this->crm_name ),
						esc_html__( 'Contacts, Leads, Case etc.', 'mwb-cf7-integration-with-salesforce-crm' ),
						esc_html( $this->crm_name )
					);
					?>
					</p>
					<ul class="mwb-intro__list">
						<li class="mwb-intro__list-item">
							<?php
							echo sprintf(
								/* translators: %s: CRM name */
								esc_html__( 'Connect your %s account with CF7.', 'mwb-cf7-integration-with-salesforce-crm' ),
								esc_html( $this->crm_name )
							);
							?>
						</li>
						<li class="mwb-intro__list-item">
							<?php
							echo sprintf(
								/* translators: %s: CRM name */
								esc_html__( 'Sync your data over %s.', 'mwb-cf7-integration-with-salesforce-crm' ),
								esc_html( $this->crm_name )
							);
							?>
						</li>
					</ul>
					<div class="mwb-intro__button">
						<a href="javascript:void(0)" class="mwb-btn mwb-btn--filled" id="mwb-showauth-form">
							<?php esc_html_e( 'Connect your Account.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
						</a>
					</div>
				</div> 
			</div>
		</section>
	<?php endif; ?>

	<!--============================================================================================
										Authorization form start.
	================================================================================================-->

	<div class="mwb_sf_cf7__account-wrap <?php echo esc_html( false === $connected ? 'row-hide' : '' ); ?>" id="mwb-cf7-auth_wrap">

		<!-- Logo section start -->
		<div class="mwb-sf_cf7__logo-wrap">
			<div class="mwb-sf_cf7__logo-salesforce">
				<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/salesforce-logo.png' ); ?>" alt="<?php esc_html_e( 'Salesforce', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
			</div>
			<div class="mwb-sf_cf7__logo-contact">
				<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/contact-form.svg' ); ?>" alt="<?php esc_html_e( 'CF7', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
			</div>
		</div>
		<!-- Logo section end -->

		<!-- Login form start -->
		<form method="post" id="mwb_sf_cf7_account_form">

			<div class="mwb_sf_cf7_table_wrapper">
				<div class="mwb_sf_cf7_account_setup">
					<h2>
						<?php esc_html_e( 'Enter your credentials here', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
					</h2>
				</div>

				<table class="mwb_sf_cf7_table">
					<tbody>
						<div class="mwb-auth-notice-wrap row-hide">
							<p class="mwb-auth-notice-text">
								<?php esc_html_e( 'Authorization has been successful ! Validating Connection .....', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
							</p>
						</div>

						<!-- Integration method start -->
						<tr class="mwb-cf7-integration-method-tr">
							<th>
								<label><?php esc_html_e( 'Integration Method', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>

								<?php
								$desc = esc_html__( 'Choose the type of Integration method to connect with Salesforce', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );
								?>
							</th>

							<td class="mwb-cf7-integration-method-td">
								<?php
								$method = ! empty( $params['method'] ) ? sanitize_text_field( wp_unslash( $params['method'] ) ) : '';
								?>
								<label>
									<input type="radio" name="mwb_account[integration_method]" value="api" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-api-method" <?php checked( 'api', $method ); ?> >
									<?php esc_html_e( 'REST API', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
								</label>
								<label>
									<input type="radio" name="mwb_account[integration_method]" value="web" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-web-method" <?php checked( 'web', $method ); ?> >
									<?php esc_html_e( 'Web-to-Lead or Web-to-Case (use this if REST API is disabled for your Org)', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
								</label> 
							</td>
						</tr>
						<!-- Integration method end -->

						<!-- Environment start  -->
						<tr>
							<th>							
								<label><?php esc_html_e( 'Environment', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>

								<?php
								$desc = esc_html__( 'Select the type of Environment of your Salesforce Account.', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
								$env = ! empty( $params['environment'] ) ? sanitize_text_field( wp_unslash( $params['environment'] ) ) : '';
								?>

								<select  name="mwb_account[env]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-environment" required>
									<option value="production" <?php selected( $env, 'production' ); ?> ><?php esc_html_e( 'Production', 'mwb-cf7-integration-with-salesforce-crm' ); ?></option>
									<option value="sandbox" <?php selected( $env, 'sandbox' ); ?> ><?php esc_html_e( 'Sandbox', 'mwb-cf7-integration-with-salesforce-crm' ); ?></option>
								</select>

							</td>
						</tr>
						<!-- Environment end -->

						<!-- Own app start  -->
						<tr class="mwb-api-fields">
							<th>							
								<label><?php esc_html_e( 'Use Own App', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>

								<?php
								$desc = esc_html__( 'Enable this to connect with your own Salesforce app.', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
								$own_app = ! empty( $params['own_app'] ) ? sanitize_text_field( wp_unslash( $params['own_app'] ) ) : '';
								?>

								<input type="checkbox" name="mwb_account[own_app]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-own-app" value="yes" <?php checked( 'yes', $params['own_app'] ); ?> >

							</td>
						</tr>
						<!-- Own app end -->

						<!-- Consumer key start  -->
						<tr class="mwb-api-fields_field">
							<th>							
								<label><?php esc_html_e( 'Consumer Key', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>

								<?php
								$desc = esc_html__( 'Enter your Salesforce Consumer key.', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
								$consumer_key = ! empty( $params['consumer_key'] ) ? sanitize_text_field( wp_unslash( $params['consumer_key'] ) ) : '';
								?>
								<div class="mwb-sf-cf7__secure-field">
									<input type="password"  name="mwb_account[app_id]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-consumer-key" value="<?php echo esc_html( $consumer_key ); ?>" required>
									<div class="mwb-sf-cf7__trailing-icon">
										<span class="dashicons dashicons-visibility mwb-toggle-view"></span>
									</div>
								</div>
							</td>
						</tr>
						<!-- Consumer key end -->

						<!-- Consumer Secret Key start -->
						<tr class="mwb-api-fields_field">
							<th>
								<label><?php esc_html_e( 'Consumer Secret', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>

								<?php
								$desc = esc_html__( 'Enter your Salesforce Consumer Secret key.', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
								$secret_key = ! empty( $params['consumer_secret'] ) ? sanitize_text_field( wp_unslash( $params['consumer_secret'] ) ) : '';
								?>

								<div class="mwb-sf-cf7__secure-field">
									<input type="password" name="mwb_account[secret_key]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-consumer-secret" value="<?php echo esc_html( $secret_key ); ?>" required>
									<div class="mwb-sf-cf7__trailing-icon">
										<span class="dashicons dashicons-visibility mwb-toggle-view"></span>
									</div>
								</div>
							</td>
						</tr>
						<!-- Consumer Secret Key End -->

						<!-- Callback url start -->
						<tr class="mwb-api-fields_field">
							<th>
								<label><?php esc_html_e( 'Callback URL', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>

								<?php
								$desc = esc_html__( 'Copy this callback URL and enter it in your app callback URL. Web-Protocol of callback URL must be HTTPS in order to successfully authorize with Salesforce', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );
								?>
							</th>

							<td>
								<input type="url" name="mwb_account[redirect_url]" value="<?php echo esc_html( rtrim( admin_url() ) ); ?>" readonly>
							</td>
						</tr>
						<!-- Callback url end -->

						<!-- Org ID start -->
						<tr class="mwb-web-fields">
							<th>
								<label><?php esc_html_e( 'Organization ID', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>

								<?php
								$desc = esc_html__( 'Enter your Salesforce Organization ID. You will find it under Company Information in Salesforce.', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
								$orgid = ! empty( $params['orgid'] ) ? sanitize_text_field( wp_unslash( $params['orgid'] ) ) : '';
								?>
								<div class="mwb-sf-cf7__secure-field">
									<input type="password" name="mwb_account[org_id]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-orgid" value="<?php echo esc_attr( $orgid ); ?>" required>
									<div class="mwb-sf-cf7__trailing-icon">
										<span class="dashicons dashicons-visibility mwb-toggle-view"></span>
									</div>
								</div>
							</td>
						</tr>
						<!-- Org ID end -->

						<!-- Salesforce domain start -->
						<tr class="mwb-web-fields">
							<th>
								<label><?php esc_html_e( 'Salesforce Domain', 'mwb-cf7-integration-with-salesforce-crm' ); ?></label>

								<?php
								$desc = esc_html__( 'Enter your Salesforce Account domain ( Optional ).', 'mwb-cf7-integration-with-salesforce-crm' );
								echo esc_html( $params['admin_class']::mwb_sf_cf7_tooltip( $desc ) );
								?>
							</th>

							<td>
								<?php
									$_domain = ! empty( $params['domain'] ) ? sanitize_text_field( wp_unslash( $params['domain'] ) ) : '';
								?>
								<input type="url" name="mwb_account[sf_domain]" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-domain" value="<?php echo esc_attr( $_domain ); ?>">
							</td>
						</tr>
						<!-- Salesforce domain end -->


						<!-- Save & connect account start -->
						<tr>
							<th>
							</th>
							<td>
								<a href="<?php echo esc_url( wp_nonce_url( admin_url( '?mwb-cf7-perform-auth=1' ) ) ); ?>" class="mwb-btn mwb-btn--filled mwb_sf_cf7_submit_account" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7-authorize-button" ><?php esc_html_e( 'Authorize', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a>
							</td>
						</tr>
						<!-- Save & connect account end -->
					</tbody>
				</table>
			</div>
		</form>
		<!-- Login form end -->

		<!-- Info section start -->
		<div class="mwb-intro__bottom-text-wrap ">
			<p>
				<?php esc_html_e( 'Don’t have an account yet . ', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
				<a href="https://www.salesforce.com/" target="_blank" class="mwb-btn__bottom-text"><?php esc_html_e( 'Create A Free Account', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a>
			</p>
			<p>
				<?php esc_html_e( 'Check app setup guide . ', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
				<a href="javascript:void(0)" class="mwb-btn__bottom-text trigger-setup-guide"><?php esc_html_e( 'Show Me How', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a>
			</p>
		</div>
		<!-- Info section end -->
	</div>

<?php else : ?>

	<!-- Successfull connection start -->
	<section class="mwb-sync">
		<div class="mwb-content-wrap">
			<div class="mwb-sync__header">
				<h2 class="mwb-section__heading">
					<?php
					echo sprintf(
						/* translators: %s: CRM name */
						esc_html__( 'Congrats! You’ve successfully set up the MWB CF7 Integration with %s Plugin.', 'mwb-cf7-integration-with-salesforce-crm' ),
						esc_html( $this->crm_name )
					);
					?>
				</h2>
			</div>
			<div class="mwb-sync__body mwb-sync__content-wrap">            
				<div class="mwb-sync__image">    
					<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/congo.jpg' ); ?>" >
				</div>       
				<div class="mwb-sync__content">            
					<p> 
						<?php
						echo sprintf(
							/* translators: %s: CRM name */
							esc_html__( 'Now you can go to the dashboard and check for the synced data. You can check your feeds, edit them and resync the data if you want. If you do not see your data over %s, you can check the logs for any possible error.', 'mwb-cf7-integration-with-salesforce-crm' ),
							esc_html( $this->crm_name )
						);
						?>
					</p>
					<div class="mwb-sync__button">
						<a href="javascript:void(0)" class="mwb-btn mwb-btn--filled mwb-onboarding-complete">
							<?php esc_html_e( 'View Dashboard', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
						</a>
					</div>
				</div>             
			</div>       
		</div>
	</section>
	<!-- Successfull connection end -->

<?php endif; ?>
