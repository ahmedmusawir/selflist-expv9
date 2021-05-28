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
    'role' => 'subscriber',
    // 'role' => 'customer',
    // 'number' => -1,
    'number' => 5,
];

// THE USER QUERY
$user_query = new WP_User_Query($args);

// echo '<h2>Total Number of Subscribers: ' . $user_query->get_total() . '</h2>';
echo '<h3 class="font-weight-bold">Total Number of Customers: ' . $user_query->get_total() . '</h3>';
echo '<hr>';

// THE USER LOOP
if (!empty($user_query->get_results())) {
    foreach ($user_query->get_results() as $user) {

        // ACF PREFIX 
        $acf_user_id = 'user_' . $user->ID;
        $user_phone = get_field('your_profile_phone', $acf_user_id);
        $user_website = get_field('your_profile_site', $acf_user_id);
        $user_facebook = get_field('your_profile_facebook', $acf_user_id);

        echo '<h3>' . $user->display_name . '</h3>';
        echo '<h6>MEMBER TYPE: <span class="text-danger">' . $user->roles[0] . '</span></h6>';
        echo '<h6>MEMBER EMAIL: <span class="text-danger">' . $user->user_email . '</span></h6>';
        echo '<h6>MEMBER SINCE: <span class="text-danger">' . $user->user_registered . '</span></h6>';

        echo '<div class="card bg-light p-4">';
        echo '<p>ADDITIONAL INFO:</p>';
        echo '<p>Phone: <span class="text-danger">' . $user_phone . '</span></p>';
        echo '<p>Website: <span class="text-danger">' . $user_website . '</span></p>';
        echo '<p>Facebook: <span class="text-danger">' . $user_facebook . '</span></p>';
        echo '</div>';
        
        echo '<pre>';
        // print_r($user);
        echo '</pre>';
        echo '<hr>';
    }
}

?>
        <hr>


    </header><!-- #masthead -->

</main><!-- #main -->


<?php
get_footer();