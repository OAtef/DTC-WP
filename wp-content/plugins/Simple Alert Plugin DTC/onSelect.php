<?php

$optionValue = $_REQUEST['option'];

$generatedOptions = "";

$queryArgs = array(
    'post_type'=> $optionValue
);              

$the_query = new WP_Query( $queryArgs );
if($the_query->have_posts() ) : 
    while ( $the_query->have_posts() ) : 
        $post = $the_query->the_post(); 

        // echo $the_query;
        $generatedOptions = $generatedOptions.'<p>hamada: '.$the_query->have_posts().'<br /></p>';
        $generatedOptions = $generatedOptions.'<p>hamada: '.$the_query->the_post().'<br /></p>';
        $generatedOptions = $generatedOptions.'<p>hamada: '.$the_query->post->post_name.'<br /></p>';
    //    echo '<p>hamada: '.$post.'<br />';
    the_title();
    endwhile; 
    wp_reset_postdata(); 
else: 
endif;

echo $generatedOptions;


?>