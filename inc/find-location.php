<?php


class Find_Location {


	public static function init() {
		self::attach_hooks();
	}

	public static function attach_hooks() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ) );
		add_shortcode( 'find-location', array( __CLASS__, 'shortcode' ) );
	}

	private static function select_element() {
		return '<option value="">--- Select ---</option>';
	}

	private static function practice_type() {

		ob_start();
		?>
		<div class="form-group"><label for="practicetype">Practice Type </label><select class="form-control"
		                                                                                name="practicetype">
				<?php echo self::select_element(); ?>
				<option value="Small Animal">Small Animal</option>
				<option value="Feline Only">Feline Only</option>
				<option value="Mixed Animal">Mixed Animal</option>
				<option value="Academic">Academic</option>
				<option value="Exotic">Exotic</option>
				<option value="Government">Government</option>
				<option value="Industry">Industry</option>
				<option value="Other">Other</option>
			</select></div> <?php
		return ob_get_clean();
	}

	private static function country_wrapper() {

		ob_start();
		?>
		<div class="country-wrapper">
		<div class="form-group">
			<label for="country">Country </label>
			<select class="form-control country" name="country">
				<?php echo self::select_element(); ?>
			</select></div>
		<div class="states form-group"></div>
		<div class="form-group">
			<label for="city">City</label>
			<input name="city" class="form-control">
		</div>
		</div><?php

		return ob_get_clean();
	}

	public static function shortcode() {


		ob_start(); ?>
		<style>.map-container {
				height: 0;
				overflow: hidden;
				padding-bottom: 75%;
				position: relative;
				width: 100%;
			}

			.map-canvas {
				height: 100%;
				left: 0;
				position: absolute;
				top: 0;
				width: 100%;
			}

		</style>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<form class="search-form" data-type="location">
					<div class="form-group">
						<label for="zip">Zip Code</label>
						<input class="form-control" name="zip">
					</div>
					<div class="form-group">
						<label for="distance">Distance</label>
						<select class="form-control" name="distance">
							<option value="10">10 Miles</option>
							<option value="20">20 Miles</option>
							<option value="30">30 miles</option>
							<option value="40">40 miles</option>
							<option value="50">50 miles</option>
							<option value="100">100 miles</option>
						</select>
					</div>
					<div class="more-options"><span>More Options</span><span style="display:none;">Less Options</span>
					</div>
					<div class="more-options-wrap" style="display:none;">
						%country_wrapper%
						%practice_type%
					</div>
					<button type="submit" class="btn btn-default">Search</button>
				</form>


			</div>

			<div class="col-xs-12 col-md-6">
				<form class="search-form" data-type="name">
					<div class="form-group">
						<label for="fName">First Name</label>
						<input class="form-control" name="fName">
					</div>

					<div class="form-group">
						<label for="lName">Last Name</label>
						<input class="form-control" name="lName">
					</div>

					<div class="form-group">
						<label for="practiceName">Practice Clinical Hospital</label>
						<input class="form-control" name="practiceName">
					</div>


					<div class="more-options"><span>More Options</span><span style="display:none;">Less Options</span>
					</div>
					<div class="more-options-wrap" style="display:none;">
						%country_wrapper%
						%practice_type%
					</div>
					<button type="submit" class="btn btn-default">Search</button>
				</form>


			</div>


			<div class="col-xs-12" id="scroll-map-container">
				<div class="results" style="display:none;">
					<div class="form-group"><input type="checkbox" class="cat-friendly-checkbox" name="cat-friendly"
					                               value="1"> <label
							for="cat-friendly">Toggle Cat Friendly</label></div>

					<div class="map-container">
						<div id="map-container" class="map-canvas" style=""></div>
					</div>
					<div class="no-results" style="display:none;">No Results</div>
					<div class="inner">

					</div>
				</div>
			</div>


		<?php

		$shortcode_html = ob_get_clean();

		$shortcode_html = str_replace( '%practice_type%', self::practice_type(), $shortcode_html );
		$shortcode_html = str_replace( '%country_wrapper%', self::country_wrapper(), $shortcode_html );

		return $shortcode_html;


	}

	public static function enqueue() {

		wp_enqueue_script( 'find-location', get_template_directory_uri() . '/js/searchData.js', array(
			'jquery',
			'underscore'
		), '20151215', true );
		wp_enqueue_script( 'gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCohVajP49HROwnrcM7lqTq12vlhNC8Xx8', array( 'find-location' ) );

	}

}

