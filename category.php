<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cyberize-app-dev
 */
if (is_user_logged_in()) {
  get_header();
} else {
  get_header('loggedout');
}

// GETTING CURRENT CATEGORY OBJECT
$current_category = $wp_query->get_queried_object();
$current_cat_id = $current_category->term_id;
$current_post_count = $current_category->count;
// echo "<pre>";
//   print_r($current_category);
// echo "</pre>";
?>
<style>
.error {
    display: block;
    border: 1px solid red;
    border-radius: 10px;
    background-color: #ffdddc;
    padding: .5rem;
    color: red;
    font-size: .8rem;
    font-weight: bold;
}

input {
    color: red;
    font-size: .8rem;
    font-weight: bold;
}

textarea {
    color: red;
    font-size: .8rem;
    font-weight: bold;
}

input::placeholder {
    font-size: .8rem !important;
}

textarea::placeholder {
    font-size: .8rem !important;
}
</style>
<main id="primary" class="site-main container">

    <button id="filter-by-state-city-btn" class="btn btn-outline-danger mb-2">Filter by State & City</button>
    <button class="btn btn-outline-dark mb-2" onclick='window.location.reload(true);'>Reset</button>
    <!-- STATE & CITY CATEGORY PROTOTYPING STARTS -->
    <?php 
    // Getting all States (Parent Taxonomies)
    $all_states = get_terms(['taxonomy' => 'states', 'parent' => 0 ]);
    get_state_and_cities($all_states, $current_cat_id);
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

                <?php
                the_archive_title( '<h3 class="page-title">', '<span class="badge badge-pill badge-dark ml-2">' . $current_post_count . 
                '</span></h3>' );
                // the_archive_description( '<div class="archive-description">', '</div>' );
                ?>

                <!-- HMU BUTTON -->
                <a id="start-hmu-btn" href="#" class="btn btn-dark btn-sm float-right disabled">START HMU </a>
                <!-- END HMU BUTTON -->

            </header><!-- .page-header -->

            <?php
		/* Start the Loop */
		while ( have_posts() ) :
      the_post();
     
      // This one is for the nice cascading effect
      echo '<article id="list-index-container" class="animate__animated animate__zoomIn">';
      // CITY & STATE TAXONMY DISPLAY BY LIST START
      // $tax = get_the_terms( get_the_ID(), 'states');
      
      // echo '
      // <p class="text-dark text-uppercase" style="font-size: .8rem; margin-bottom: 0;">
      //   <small class="font-weight-bold">City: 
      //     <span class="text-info">' . $tax[0]->name .',</span> State: <span class="text-info">' . $tax[1]->name .'</span>
      //   </small>
      // </p>';
      
      // CITY & STATE TAXONMY DISPLAY BY LIST END
      
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


<!-- FLAG FORM MODAL -->

<!-- Modal -->
<div class="modal fade text-center" id="the-flag-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <!-- <div class="modal-dialog" role="document"> -->
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center bg-danger">
                <h5 class="modal-title text-light" id="exampleModalLabel">Flag This List</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
            </div>
            <!-- <div class="modal-body">
        <form action="" class="form">

        </form>
      </div> -->
            <div class="modal-footer justify-content-center">

                <form id="flag-insert-form" class="form">
                    <label for="flag-textara">Insert your reason for flagging this list:</label>
                    <textarea class="form-control mb-3" name="flag-textarea" id="flag-textarea" cols="30" rows="10"
                        required autocomplete="off">
          </textarea>
                    <small class="float-right mb-3">140 Character Limit</small>
                    <button id="flag-ajax-submit-btn" type="submit"
                        class="btn btn-primary btn-block flag-ajax-submit-btn">
                        Flag It Now
                    </button>
                    <button id="flag-close-btn" type="button" class="btn btn-secondary btn-block" data-dismiss="modal">
                        Cancel
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- END FLAG FORM MODAL -->

<?php
get_footer();