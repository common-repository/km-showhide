<?php
/*
Plugin Name: KM ShowHide
Plugin URI: 
Description: This simple plugin allows you to toggle your content inside shortcode. Example usage: <code>[km_showhide]Hidden content goes in here.[/km_showhide]</code>
Version: 1.01
Author: KM
Author URI: 
Text Domain: km_showhide
License: GPL2
*/


add_shortcode( 'km_showhide', 'showhide_shortcode' );

function showhide_shortcode( $atts, $content = null ) {
	
	$output = '<a class="read-more-show hide" href="#">Read More</a>';
	$output .= '<span class="read-more-content">' . do_shortcode( $content ) . ' <a class="read-more-hide hide" href="#">Read Less</a></span>';
	return $output;
}

### Function: Add JavaScript To Footer
add_action( 'wp_footer', 'showhide_footer' );

function showhide_footer() {
	?>
	<style>
		.hide {
			display: none;
		}

	</style>
	
    <script type="text/javascript">
		jQuery( document ).ready( function () {
			jQuery( '.read-more-content' ).addClass( 'hide' )
			jQuery( '.read-more-show, .read-more-hide' ).removeClass( 'hide' )

			// Set up the toggle effect:
			jQuery( '.read-more-show' ).on( 'click', function ( e ) {
				jQuery( this ).next( '.read-more-content' ).removeClass( 'hide' );
				jQuery( this ).addClass( 'hide' );
				e.preventDefault();
			} );

			
			jQuery( '.read-more-hide' ).on( 'click', function ( e ) {
				var p = jQuery( this ).parent( '.read-more-content' );
				p.addClass( 'hide' );
				p.prev( '.read-more-show' ).removeClass( 'hide' ); // Hide only the preceding "Read More"
				e.preventDefault();
			} );
		} );
	</script>
	

	<?php
}