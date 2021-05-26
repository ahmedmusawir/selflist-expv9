<?php
/**
 * The template for displaying all pages
 * Template Name: Test Page
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cyberize-app-dev
 */

get_header('loggedout');
?>

<main id="primary" class="site-main container">

    <header id="header-test" class="site-header container py-5">

        <h1>Copy This Template for testing ...</h1>

        <?php
echo 'Result goes here..';

// Args for User Query
$args = array(
    'role' => 'subscriber',
);

// THE USER QUERY
$user_query = new WP_User_Query($args);

// THE USER LOOP
if (!empty($user_query->get_results())) {
    foreach ($user_query->get_results() as $user) {
        // $user_id = $user->id;
        echo '<pre>';
        print_r($user->id);
        echo '</pre>';
    }
}
?>

    </header><!-- #masthead -->

</main><!-- #main -->


<?php
get_footer();