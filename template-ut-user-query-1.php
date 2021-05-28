<?php
/**
 * The template for displaying all pages
 * Template Name: UT USER QUERY
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cyberize-app-dev
 */

get_header('empty');
?>

<main id="primary" class="site-main container">

    <header id="header-test" class="site-header container py-5">

        <h1 class="text-center">WP_User_Query</h1>
        <hr class="bg-danger">
        <?php

// Args for User Query
$args = [
    // 'role' => 'subscriber',
    'number' => -1,
    // 'search' => 'moose@one.com', // by default only searches Username column
    'search' => '*@one*', 
    // 'search_columns' => array( 'display_name' ),
    'search_columns' => [ 'user_email', 'display_name' ],
];

// THE USER QUERY
$user_query = new WP_User_Query($args);

echo 'Total Number of Users: ' . $user_query->get_total() . '<br>';
echo '<hr>';

// THE USER LOOP
if (!empty($user_query->get_results())) {
    foreach ($user_query->get_results() as $user) {

        echo $user->display_name;
        
        echo '<pre>';
        // print_r($user);
        echo '</pre>';
    }
}

?>
        <hr>


    </header><!-- #masthead -->

</main><!-- #main -->


<?php
get_footer();