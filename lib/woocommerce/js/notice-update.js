/**
 * Trigger AJAX request to save state when the WooCommerce notice is dismissed.
 *
 * @version 2.3.0
 *
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @package GenesisSample
 */

// eslint-disable-next-line no-undef
jQuery(document).on( 
	"click",
	".genesis-reengage-woocommerce-notice .notice-dismiss",
	function() {
		// eslint-disable-next-line no-undef
		jQuery.ajax({
			// eslint-disable-next-line no-undef
		url: ajaxurl,
			data: {
				action: "genesis_reengage_dismiss_woocommerce_notice"
			}
		});
	}
);
