<?php
/*
Plugin Name: EDD Quantities
Plugin URI: http://creativeg.gr
Description: Add a + / - quantity countrer to easy digital downloads checkout page
Author: Basilis Kanonidis
Author URI: http://creativeg.gr
Version: 1.0
License: GPLv2 or later
*/
add_action( 'wp_footer', 'quantity_custom_scripts' );
function quantity_custom_scripts() {
?>
<script type = "text/javascript">
jQuery( function( $ ) {

	// Quantity buttons
	$( 'td.edd_cart_actions:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

	$( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.edd_cart_actions' ).find( '.edd-item-quantity' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event
		$qty.trigger( 'change' );

	});
});
</script>
<style>
.minus {
    padding: 2px 10px;
    color: #EF7D46;
    border: 1px solid #EF7D46 !important;
    background-color: #fff;
}
.plus {
    color: #EF7D46;
    border: 1px solid #EF7D46 !important;
    background-color: #fff;
    padding: 3px 8px 4px 8px;
    font-size: 15px;
}
.edd-item-quantity {
    padding: 2px 10px;
    text-align: center;
    width: 80px;
    border: 1px solid #CCC0B1;
}
</style>
<?php
}
