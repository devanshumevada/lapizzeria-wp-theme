<?php


	function lapizzeria_delete_reservation() {
		if($_POST['type'] == 'delete'):

			global $wpdb;
			$table = $wpdb->prefix . 'reservations';
			$id_reservation = $_POST['id'];

			$result = $wpdb->delete($table, array('id'=> $id_reservation), array('%d'));

			if($result == 1) {
				$response = array(
					'response' => 1,
					'id' => $id_reservation
				);
			} else {
				$response = array(
					'response' => 'error'
				);
			}

		endif;

		die(json_encode($response));
	}

	add_action('wp_ajax_lapizzeria_delete_reservation','lapizzeria_delete_reservation');
	function lapizzeria_save_reservation() {


		if(isset($_POST['reservation']) && $_POST['hidden'] == 1) {
			// Read values from recaptcha response
			$captcha = $_POST['g-recaptcha-response'];

			//Sending the values to the server
			$fields = array(
				'secret'   => '6LdBWD4UAAAAAEpbDCcFmkiuPiWRmZhxOOioHWGs',
				'response' => $captcha,
				'remoteip' => $_SERVER['REMOTE_ADDR']
			);

			//Start the request to server

			$ch = curl_init( 'https://www.google.com/recaptcha/api/siteverify' );

			//configuring the request
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_TIMEOUT, 15 );

			//Sending the value in the url
			curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $fields ) );

			//Reading the returned value
			$response = json_decode( curl_exec( $ch ) );

			if ( $response->success ) {
				global $wpdb;
				$name    = sanitize_text_field( $_POST['name'] );
				$date    = sanitize_text_field( $_POST['date'] );
				$email   = sanitize_email( $_POST['email'] );
				$phone   = sanitize_text_field( $_POST['phone'] );
				$message = sanitize_text_field( $_POST['message'] );

				$table = $wpdb->prefix . 'reservations';

				$data = array(
					'name'    => $name,
					'date'    => $date,
					'email'   => $email,
					'phone'   => $phone,
					'message' => $message
				);

				$format = array(
					'%s',
					'%s',
					'%s',
					'%s',
					'%s'

				);

				$wpdb->insert( $table, $data, $format );

				$url = get_page_by_title( 'Thanks for Reservation' );
				wp_redirect( get_permalink( $url ) );
				exit();
			}

		}
	}

	add_action('init','lapizzeria_save_reservation');
?>
