/**
 * Beginning of everything.
 */
( function( $, wp ) {
	$( document ).ready(
		function() {

			// $( 'form#demo-form' ).submit(
			// 	function(e) {
			// 		e.preventDefault();
			//
			// 		const formData   = new FormData( $( 'form#demo-form' )[0] )
			// 		const searchTerm = formData.get( 'search_term' );
			//
			// 		console.log( searchTerm );
			// 	}
			// );

			// wp.api() .
			// wp.api.loadPromise.done(function() {
			//
			// 	$( 'form#demo-form' ).submit(
			// 		function(e) {
			// 			e.preventDefault();
			//
			// 			const formData   = new FormData( $( 'form#demo-form' )[0] )
			// 			const searchTerm = formData.get( 'search_term' );
			//
			// 			const response = new wp.api.collections[ searchTerm ]();
			// 			const items = response.fetch().then( (res) => {
			// 				res.map(( item ) => {
			// 					$('#demo-content').prepend( `<p>${item.title.rendered}</p>` );
			// 				})
			// 			} );
			// 		}
			// 	);
			// });

			// wp.apiFetch() .
			$( 'form#demo-form' ).submit(
				function(e) {
					e.preventDefault();

					const formData   = new FormData( $( 'form#demo-form' )[0] )
					const searchTerm = formData.get( 'search_term' );

					// const response = new wp.api.collections[ searchTerm ]();
					// const items = response.fetch().then( (res) => {
					// 	res.map(( item ) => {
					// 		$('#demo-content').prepend( `<p>${item.title.rendered}</p>` );
					// 	})
					// } );

					wp.apiFetch({ path: '/wp/v2/posts' }).then( ( res ) => {
						res.map(( item ) => {
							$('#demo-content').prepend( `<p>${item.title.rendered}</p>` );
						})
					} )
				}
			);
		}
	);
} )( jQuery, wp )
