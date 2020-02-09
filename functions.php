<?php 

//  CUSTOM SEARCH META_KEY FOR TURISM CUSTOM POST TYPE
function custom_search_query( $query ) {
    $custom_fields = array(
        // put all the meta fields you want to search for here
        "country",
        "state"
    );
    $searchterm = $query->query_vars['s'];

    // we have to remove the "s" parameter from the query, because it will prevent the posts from being found
    $query->query_vars['s'] = "";

    if ($searchterm != "") {
        $meta_query = array('relation' => 'OR');
        foreach($custom_fields as $cf) {
            array_push($meta_query, array(
                'key' => $cf,
                'value' => $searchterm,
                'compare' => 'LIKE'
            ));
        }
     
          $query->set("post_type", 'turism');
		  $query->set("posts_per_page", -1);

        $query->set("meta_query", $meta_query);
    };
}
add_filter( "pre_get_posts", "custom_search_query"); 



?>