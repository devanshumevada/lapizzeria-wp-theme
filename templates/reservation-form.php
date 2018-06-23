<div class="reservation-info">
	<form method="post" class="reservation-form">
		<h2>Make a Reservation</h2>
		<div class="field">
			<input type="text" name="name" placeholder="Name" required>
		</div>

		<div class="field">
			<input type="datetime-local" name="date" placeholder="Date" required>
		</div>

		<div class="field">
			<input type="email" name="email" placeholder="E-Mail" required>
		</div>

		<div class="field">
			<input type="tel" name="phone" placeholder="Phone" required>
		</div>

		<div class="field">
			<textarea name="message" placeholder="Message" required></textarea>
		</div>

        <div class="g-recaptcha" data-sitekey="6LdBWD4UAAAAAMkhT1cL1xlxErNURekD3QB0f2CP"></div>

		<input type="submit" name="reservation" class="button">

		<input type="hidden" name="hidden" value="1">
	</form>

</div>