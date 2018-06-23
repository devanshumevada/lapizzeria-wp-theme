<?php
function lapizzeria_option() {
	add_menu_page('La Pizzeria','La Pizzeria Options','administrator','lapizzeria_options',
		'lapizzeria_adjustments','',20);

	add_submenu_page('lapizzeria_options','Reservations', 'Reservations','administrator',
		'lapizzeria_reservations','lapizzeria_reservations');
}
add_action('admin_menu','lapizzeria_option');


function lapizzeria_gmap_setting() {
	register_setting('lapizzeria_gmap_setting','lapizzeria_gmap_latitude');
	register_setting('lapizzeria_gmap_setting','lapizzeria_gmap_longitude');
	register_setting('lapizzeria_gmap_setting','lapizzeria_gmap_zoom');
	register_setting('lapizzeria_gmap_setting','lapizzeria_gmap_apikey');

}

add_action('init','lapizzeria_gmap_setting');


function lapizzeria_adjustments() { ?>
	<div class="wrap">
		<h1>Lapizzeria Adjustments</h1>
		<form action="options.php" method="post">
			<?php
				settings_fields('lapizzeria_gmap_setting');
				do_settings_sections('lapizzeria_gmap_setting');
			?>
			<h2>Google Maps</h2>
			<table class="form-table">

				<tr valign="top">
					<th scope="row">Latitude</th>
					<td>
						<input type="text" name="lapizzeria_gmap_latitude" value="<?php echo esc_attr(get_option('lapizzeria_gmap_latitude')); ?>">
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">Longitude</th>
					<td>
						<input type="text" name="lapizzeria_gmap_longitude" value="<?php echo esc_attr(get_option('lapizzeria_gmap_longitude')); ?>">
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">Zoom</th>
					<td>
						<input type="number" name="lapizzeria_gmap_zoom" max="21" min="12" value="<?php echo esc_attr(get_option('lapizzeria_gmap_zoom')); ?>">
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">Api Key</th>
					<td>
						<input type="text" name="lapizzeria_gmap_apikey" value="<?php echo esc_attr(get_option('lapizzeria_gmap_apikey')); ?>">
					</td>
				</tr>





			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }

function lapizzeria_reservations() { ?>
	<div class="wrap">
		<h1>Reservations</h1>
		<table class="wp-list-table widefat striped">
			<thead>
			<tr>
				<th class="manage-column">ID</th>
				<th class="manage-column">Name</th>
				<th class="manage-column">Date for Reservation</th>
				<th class="manage-column">Email</th>
				<th class="manage-column">Phone</th>
				<th class="manage-column">Message</th>
                <th class="manage-column">Delete</th>
			</tr>
			</thead>

			<tbody>
			<?php
			global $wpdb;
			$table = $wpdb->prefix . 'reservations';
			$reservations = $wpdb->get_results("SELECT * FROM $table" ,ARRAY_A);

			foreach ($reservations as $reservation) : ?>

				<tr>
					<td><?php echo $reservation['id']; ?></td>
					<td><?php echo $reservation['name']; ?></td>
					<td><?php echo $reservation['date']; ?></td>
					<td><?php echo $reservation['email']; ?></td>
					<td><?php echo $reservation['phone']; ?></td>
					<td><?php echo $reservation['message']; ?></td>
                    <td>
                        <a href="#" class="remove_reservation" data-reservation="<?php echo $reservation['id']; ?>">Remove</a>
                    </td>

				</tr>

			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

<?php }
?>