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

        // $args = [];

        $args = [
            'number' => 5,
        ];

        $users = get_users($args);

        echo '<pre>';
        print_r($users);
        echo '</pre>';

        ?>

    </header><!-- #masthead -->

</main><!-- #main -->


<?php
get_footer();