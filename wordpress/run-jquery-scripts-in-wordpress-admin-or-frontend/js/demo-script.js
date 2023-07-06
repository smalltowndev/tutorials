(function($, dd) {
    $( document ).ready(function() {
        console.log( 'hi' );
        console.log(dd);

        $( '.wp-block-site-title' ).text( dd.wp_version )
    })
})(jQuery, demoData);