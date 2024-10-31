<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the feeds listing aspects of the plugin.
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

<div id="mwb-feeds" class="mwb-sf-cf7__feedlist-wrap">

	<div class="mwb-sf_cf7__logo-wrap">
		<div class="mwb-sf_cf7__logo-salesforce">
			<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/salesforce-logo.png' ); ?>" alt="<?php esc_html_e( 'Salesforce', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
		</div>
		<div class="mwb-sf_cf7__logo-contact">
			<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/contact-form.svg' ); ?>" alt="<?php esc_html_e( 'CF7', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
		</div>
		<div class="mwb-sf_cf7__filterfeed">
			<Select class="filter-feeds-by-form" name="filter-feeds-by-form" >
				<option value="-1"><?php esc_html_e( 'Select CF7 form', 'mwb-cf7-integration-with-salesforce-crm' ); ?></option>
				<option value="all"><?php esc_html_e( 'All Feeds', 'mwb-cf7-integration-with-salesforce-crm' ); ?></option>
				<?php if ( ! empty( $params['wpcf7'] ) && is_array( $params['wpcf7'] ) ) : ?>
					<?php foreach ( $params['wpcf7'] as $cf_post => $val ) : ?>
						<option value="<?php echo esc_attr( $val->ID ); ?>"><?php echo esc_html( $val->post_title ); ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</Select>
		</div>
	</div>

	<ul class="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7__feed-list" id="mwb-<?php echo esc_attr( $this->crm_slug ); ?>-cf7_independent">
		<?php
		$feed_module = Mwb_Cf7_Integration_With_Salesforce_Crm::get_integration_module( 'feed' );
		foreach ( $params['feeds'] as $key => $feed ) :


			$feed_title     = $feed->post_title;
			$_status        = get_post_status( $feed->ID );
			$active         = ( 'publish' === $feed->post_status ) ? 'yes' : 'no';
			$edit_link      = get_edit_post_link( $feed->ID );
			$cf7_from       = $feed_module->fetch_feed_data( $feed->ID, 'mwb-' . $this->crm_slug . '-cf7-form', '-' );
			$crm_object     = $feed_module->fetch_feed_data( $feed->ID, 'mwb-' . $this->crm_slug . '-cf7-object', '-' );
			$primary_field  = $feed_module->fetch_feed_data( $feed->ID, 'mwb-' . $this->crm_slug . '-cf7-primary-field', '-' );
			$filter_applied = $feed_module->fetch_feed_data( $feed->ID, 'mwb-' . $this->crm_slug . '-cf7-enable-filters', '-' );
			?>
			<li class="mwb-sf-cf7__feed-row">
				<div class="mwb-sf-cf7__left-col">
					<h3 class="mwb-about__list-item-heading">
						<?php echo esc_html( $feed_title ); ?>
					</h3>
					<div class="mwb-feed-status__wrap">
						<p class="mwb-feed-status-text_<?php echo esc_attr( $feed->ID ); ?>" ><strong><?php echo 'publish' == $_status ? esc_html__( 'Active', 'mwb-cf7-integration-with-salesforce-crm' ) : esc_html__( 'Sandbox', 'mwb-cf7-integration-with-salesforce-crm' ); // phpcs:ignore ?></strong></p>
						<p><input type="checkbox" class="mwb-feed-status" value="publish" <?php checked( 'publish', $_status ); ?> feed-id=<?php echo esc_attr( $feed->ID ); ?> ></p>
					</div>
					<p>
						<span class="mwb-about__list-item-sub-heading"><?php esc_html_e( 'Form : ', 'mwb-cf7-integration-with-salesforce-crm' ); ?></span>
						<span><?php echo esc_html( get_the_title( $cf7_from ) ); ?></span>   
					</p>
					<p>
						<span class="mwb-about__list-item-sub-heading"><?php esc_html_e( 'Object : ', 'mwb-cf7-integration-with-salesforce-crm' ); ?></span>
						<span><?php echo esc_html( $crm_object ); ?></span> 
					</p>
					<?php if ( isset( $params['method'] ) && 'api' == $params['method'] ) : // phpcs:ignore ?>
						<p> 
							<span class="mwb-about__list-item-sub-heading"><?php esc_html_e( 'Primary Key : ', 'mwb-cf7-integration-with-salesforce-crm' ); ?></span>
							<span><?php echo esc_html( $primary_field ); ?></span> 
						</p>
					<?php endif; ?>
					<p>
						<span class="mwb-about__list-item-sub-heading"><?php esc_html_e( 'Conditions : ', 'mwb-cf7-integration-with-salesforce-crm' ); ?></span>
						<span><?php echo 'yes' != $filter_applied ? esc_html__( '-', 'mwb-cf7-integration-with-salesforce-crm' ) : esc_html__( 'Applied', 'mwb-cf7-integration-with-salesforce-crm' ); // phpcs:ignore ?></span> 
					</p>
				</div>
				<div class="mwb-sf-cf7__right-col">
					<a href="<?php echo esc_url( $edit_link ); ?>">
						<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/edit.svg' ); ?>" alt="<?php esc_html_e( 'Edit feed', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
					</a>
					<div class="mwb-sf-cf7__right-col1">
						<a href="javascript:void(0)" class="mwb_<?php echo esc_attr( $this->crm_slug ); ?>_cf7__trash_feed" feed-id="<?php echo esc_html( $feed->ID ); ?>">
							<img src="<?php echo esc_url( MWB_CF7_INTEGRATION_WITH_SALESFORCE_CRM_URL . 'admin/images/trash.svg' ); ?>" alt="<?php esc_html_e( 'Trash feed', 'mwb-cf7-integration-with-salesforce-crm' ); ?>">
						</a>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ul>
	<div class="mwb-about__list-item mwb-about__list-add">            
		<div class="mwb-about__list-item-btn">
			<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=mwb_' . $this->crm_slug . '_cf7' ) ); ?>" class="mwb-btn mwb-btn--filled">
				<?php esc_html_e( 'Add Feeds', 'mwb-cf7-integration-with-salesforce-crm' ); ?>
			</a>
		</div>
	</div>

	<?php do_action( 'mwb_' . $this->crm_slug . '_cf7_display_dependent_feeds' ); ?>
</div>
