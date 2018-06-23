<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>

	<div class="hero" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">

		<div class="hero-content">

			<div class="hero-text">

				<h2><?php the_title(); ?></h2>

			</div>

		</div>

	</div>



	<div class="main-content container">

		<main class="text-center content-text">

			<p class="ingredients">Ingredients:</p>

			<?php the_content(); ?>

			<p><span class="price-text">Price:</span> $ <span><?php the_field('price_items'); ?></span></p>

		</main>
	</div>

<?php endwhile; ?>



<?php get_footer(); ?>
