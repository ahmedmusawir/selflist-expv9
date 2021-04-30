<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cyberize-app-dev
 */

get_header();
// GETTING CURRENT CATEGORY OBJECT
$current_category = $wp_query->get_queried_object();
$current_cat_id = $current_category->term_id;
$current_post_count = $current_category->count;
// echo "<pre>";
//   print_r($current_category);
// echo "</pre>";
?>
<main id="primary" class="site-main container">

  <!-- STATE & CITY CATEGORY PROTOTYPING STARTS -->
  <?php 
  // Getting all States (Parent Taxonomies)
  $all_states = get_terms(['taxonomy' => 'states', 'parent' => 0 ]);
  echo "<pre>";
  // echo print_r($all_states);
  echo "</pre>";

  foreach ($all_states as $state) {
    get_cities($state->slug);
  }

  function get_cities($state) {
    // Getting State
    $state_cat_georgia = get_term_by('slug', $state, 'states');
    $state_cat_georgia_link = get_category_link($state_cat_georgia);
    // Getting the children Category IDs Array with no List/Post attached
    $cities_of_ga = get_term_children($state_cat_georgia->term_id, 'states');
    
    // echo "<pre>";
    // print_r($state_cat_georgia);
    echo '<a href="'. $state_cat_georgia_link .'">' . $state_cat_georgia->name . ' (' . $state_cat_georgia->count . ')</a>';
    // echo "<h6>$state_cat_georgia->name [$state_cat_georgia->count]</h6>";
    // print_r($cities_of_ga);
    // echo "</pre>";

    foreach ( $cities_of_ga as $city_id ) {
      $city_obj = get_term($city_id);
      $city_cat_link = get_category_link($city_obj);

      echo "<pre>";
      // print_r($city_obj);
      echo '<a href="' .$city_cat_link . '">';
      echo "<small>$city_obj->name</small> [$city_obj->count]";
      echo '</a>';
      echo "</pre>";
    }
  }


  
  ?>
  <!-- STATE & CITY CATEGORY PROTOTYPING ENDS -->

  <div class="row">
    <div class="col-md-9">

      <section id="selflist-search-input-box" class="selflist-search-input-box">

        <input type="text" id="post-search-input" class="selflist-search-input">
        <i class="fas fa-search"></i>

      </section>

      <?php if ( have_posts() ) : ?>

      <header class="page-header">
        <!-- <span class="badge badge-dark float-right"><?php echo $current_post_count ?></span> -->

        <?php
			the_archive_title( '<h3 class="page-title">', '<span class="badge badge-pill badge-dark ml-2">' . $current_post_count . '</span>
        </h3>' );
        // the_archive_description( '<div class="archive-description">', '</div>' );
        ?>
      </header><!-- .page-header -->

      <?php
		/* Start the Loop */
		while ( have_posts() ) :
      the_post();
     
      // This one is for the nice cascading effect
      echo '<article class="animate__animated animate__zoomIn">';
      // CITY & STATE TAXONMY DISPLAY BY LIST START
      $tax = get_the_terms( get_the_ID(), 'states');
      echo "<pre>";
      // print_r($tax);
      echo "</pre>";
      echo '
      <p class="text-dark text-uppercase" style="font-size: .8rem; margin-bottom: 0;">
        <small class="font-weight-bold">City: 
          <span class="text-info">' . $tax[0]->name .',</span> State: <span class="text-info">' . $tax[1]->name .'</span>
        </small>
      </p>';
      
      // CITY & STATE TAXONMY DISPLAY BY LIST END
      
      // SHOW STATE & CITY IN A PARENT CHILD ORDER
      // print_taxonomy_ranks( get_the_terms( get_the_ID(), 'states' ) );
			
      /**
       * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
       * 
       */
			 
      get_template_part( 'template-parts/content', 'category' );

      echo '<article>'; //END .post-item



		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>
    </div>
    <div class="col-md-3">

      <article class="category-sidebar">
        <ul class="primo">
          <?php 
        
        
        $cat_list = get_selflist_sub_cats($current_cat_id);
        
      ?>
        </ul>

      </article>

    </div>
  </div>



</main><!-- #main -->

<?php
get_footer();