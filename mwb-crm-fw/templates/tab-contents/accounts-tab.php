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

?>
<div class="mwb_sf_cf7__account-wrap">

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

	<!--============================================================================================
											Dashboard page start.
	================================================================================================-->

	<!-- Connection status start -->
	<div class="mwb_sf_cf7_crm_connected">
		<ul>
			<li class="mwb-sf_cf7__conn-row">
				<div class="mwb-sf_cf7__content-wrap">
					<div class="mwb-section__sub-heading__wrap">
						<h3 class="mwb-section__sub-heading">
							<?php echo sprintf( '%s %s', esc_html( $this->crm_name ), esc_html__( 'Connection Status', 'mwb-cf7-integration-with-salesforce-crm' ) ); ?>
						</h3>
						<div class="mwb-dashboard__header-text">
							<span class="<?php echo esc_attr( 'is-connected' ); ?>" >
								<?php esc_html_e( 'Connected', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
							</span>
						</div>
					</div>

					<div class="mwb-sf_cf7__status-wrap">
						<div class="mwb-sf_cf7__left-col">
							<?php if ( ! empty( $params['method'] ) ) : ?>
								<?php if ( 'api' == $params['method'] ) : // phpcs:ignore ?>

									<div class="mwb-sf_cf7-token-notice__wrap">
										<p>
											<?php echo sprintf( '%s : %s', esc_html__( 'Connected via', 'mwb-cf7-integration-with-salesforce-crm' ), esc_html__( 'REST API', 'mwb-cf7-integration-with-salesforce-crm' ) ); ?>
										</p>
									</div>
									<div class="mwb-sf_cf7-token-notice__wrap">
										<p id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>_cf7-token-notice" >
											<?php if ( empty( $params['issue_time'] ) ) : ?>
												<?php esc_html_e( 'Access token has expired.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
											<?php else : ?>
												<?php echo sprintf( '%s : %s', esc_html__( 'Last token issued at ', 'mwb-cf7-integration-with-salesforce-crm' ), esc_html( gmdate( 'd M y h:i A', $params['issue_time'] ) ) ); ?>
											<?php endif; ?>
										</p>
										<p class="mwb-sf_cf7-token_refresh ">
											<img id ="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7_refresh_token" src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/refresh.svg' ); ?>" title="<?php esc_html_e( 'Refresh Access Token', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
										</p>
									</div>
									<div class="mwb-sf_cf7-token-notice__wrap">
										<?php if ( ! empty( $params['instance_url'] ) ) : ?>
											<p>
												<?php esc_html_e( 'Connected Instance : ', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
												<a href="<?php echo esc_url( $params['instance_url'] ); ?>" target="_blank"><?php echo esc_html( $params['instance_url'] ); ?></a>
											</p>
										<?php endif; ?>
									</div>

								<?php elseif ( 'web' == $params['method'] ) : // phpcs:ignore ?>

									<div class="mwb-sf_cf7-token-notice__wrap">
										<p id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>_cf7-token-notice" >
											<?php echo sprintf( '%s : %s', esc_html__( 'Connected via', 'mwb-cf7-integration-with-salesforce-crm' ), esc_html__( 'WebtoLead/WebtoCase', 'mwb-cf7-integration-with-salesforce-crm' ) ); ?>
										</p>
									</div>
									<div class="mwb-sf_cf7-token-notice__wrap">
										<?php if ( ! empty( $params['domain'] ) ) : ?>
											<p>
												<?php esc_html_e( 'Connected Instance : ', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
												<a href="<?php echo esc_url( $params['domain'] ); ?>" target="_blank"><?php echo esc_html( $params['domain'] ); ?></a>
											</p>
										<?php endif; ?>
									</div>

								<?php endif; ?>
							<?php endif; ?>
						</div>

						<div class="mwb-sf_cf7__right-col">
							<a id="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7_reauthorize" href="<?php echo esc_url( wp_nonce_url( admin_url( '?mwb-cf7-perform-reauth=1' ) ) ); ?>" class="mwb-btn mwb-btn--filled"><?php esc_html_e( 'Reauthorize', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a>
							<a id="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7_revoke" href="javascript:void(0)" class="mwb-btn mwb-btn--filled"><?php esc_html_e( 'Disconnect', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
	<!-- Connection status end -->

	<!-- About list start -->
	<div class="mwb-dashboard__about">
		<div class="mwb-dashboard__about-list">
			<div class="mwb-content__list-item-text">
				<h2 class="mwb-section__heading"><?php esc_html_e( 'Synced Contact Forms', 'mwb-cf7-integration-with-salesforce-crm' ); ?></h2>
				<div class="mwb-dashboard__about-number">
					<span><?php echo esc_html( ! empty( $params['count'] ) ? $params['count'] : '0' ); ?></span>
				</div>
				<div class="mwb-dashboard__about-number-desc">
					<p>
						<i><?php esc_html_e( 'Total number of Contact Form 7 submission data which are synced over Salesforce.', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=mwb_' . $this->crm_slug . '_cf7_page&tab=logs' ) ); ?>" target="_blank"><?php esc_html_e( 'View log', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a></i>
					</p>
				</div>
			</div>
			<div class="mwb-content__list-item-image">
				<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/deals.svg' ); ?>" alt="<?php esc_html_e( 'Synced Contact Forms', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
			</div>
		</div>

		<?php do_action( 'mwb_' . $this->crm_slug . '_cf7_about_list' ); ?>

	</div>
	<!-- About list end -->

	<!-- Support section start -->
	<div class="mwb-content-wrap">
		<ul class="mwb-about__list">
			<li class="mwb-about__list-item">
				<div class="mwb-about__list-item-text">
					<p><?php esc_html_e( 'Need any help ? Check our documentation.', 'mwb-cf7-integration-with-salesforce-crm' ); ?></p>
				</div>
				<div class="mwb-about__list-item-btn">
					<a href="<?php echo esc_url( ! empty( $params['links']['doc'] ) ? $params['links']['doc'] : '' ); ?>" class="mwb-btn mwb-btn--filled"><?php esc_html_e( 'Documentation', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a>
				</div>
			</li>
			<li class="mwb-about__list-item">
				<div class="mwb-about__list-item-text">
					<p><?php esc_html_e( 'Facing any issue ? Open a support ticket.', 'mwb-cf7-integration-with-salesforce-crm' ); ?></p>
				</div>
				<div class="mwb-about__list-item-btn">
					<a href="<?php echo esc_url( ! empty( $params['links']['ticket'] ) ? $params['links']['ticket'] : '' ); ?>" class="mwb-btn mwb-btn--filled"><?php esc_html_e( 'Support', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a>
				</div>
			</li>
			<li class="mwb-about__list-item">
				<div class="mwb-about__list-item-text">
					<p><?php esc_html_e( 'Need personalized solution, contact us !', 'mwb-cf7-integration-with-salesforce-crm' ); ?></p>
				</div>
				<div class="mwb-about__list-item-btn">
					<a href="<?php echo esc_url( ! empty( $params['links']['contact'] ) ? $params['links']['contact'] : '' ); ?>" class="mwb-btn mwb-btn--filled"><?php esc_html_e( 'Connect', 'mwb-cf7-integration-with-salesforce-crm' ); ?></a>
				</div>
			</li>
		</ul>	
	</div>
	<!-- Support section end -->

</div>
<?php

