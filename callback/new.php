<?php
   
include($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

header('Content-Type: application/json;charset=utf-8');

 
$daytypes_args = array(
	//'post__not_in'=>$rooms_to_exclude,
	'posts_per_page' => 1200,
	'cat'=> '344',					
	'meta_key' => 'sort',
	'orderby' => 'meta_value_num',
	//'paged' => $page_num	 
);
 
$daytypes_posts_obj = new WP_Query($daytypes_args);										
$daytypes_posts_array=$daytypes_posts_obj->posts; 

$ar_daytypes=array();

?> 
		 
<? 
 

foreach( $daytypes_posts_array as $daytypes_post_single ) :

	$post_id=$daytypes_post_single->ID;	

	$result = array();

	$result['TITLE'] = $daytypes_post_single->post_title;
	$result['URL'] = get_permalink( $daytypes_post_single );
	$result['DETAIL_TEXT'] = $daytypes_post_single->post_content;
	$result['BEDS'] = get_post_meta($post_id, 'beds')[0];
	$result['BEDS_MAX'] = get_post_meta($post_id, 'max_volume')[0];

	$photos = get_post_meta($post_id, 'photos'); 

	foreach ($photos as $photo) {
		$result['MORE_PHOTO'][] = str_replace('http://', 'https://', $photo['guid']); 

	}

	// if(is_array($price[0])) $price[0]='no';
	// else $price[0]=$price[0].' KZT'; 

	$result['PRICE_WINTER'] = get_post_meta($post_id, 'daypricefood')[0];
	$result['PRICE_SUMMER'] = get_post_meta($post_id, 'daypricefood_summer')[0];
	$result['PRICE_HOLIDAY_WINTER'] = get_post_meta($post_id, 'holiday_price')[0];
	$result['PRICE_HOLIDAY_SUMMER'] = get_post_meta($post_id, 'holiday_price_summer')[0];
	$result['PRICE_NEWYEAR'] = get_post_meta($post_id, 'newyear_price')[0];
 
	$result['PRICE_VV_WINTER'] = get_post_meta($post_id, 'vv_35')[0];
	$result['PRICE_VV_SUMMER'] = get_post_meta($post_id, 'vv_35_summer')[0];
	$result['PRICE_VV_NEWYEAR'] = get_post_meta($post_id, 'vv_35_ng')[0];
	$result['PRICE_VV_HOLIDAY'] = get_post_meta($post_id, 'vv_35_hol')[0];

	
	// $result['hit']=get_post_meta($post_id, "hit");
	// $result['hid']=get_post_meta($post_id, "hid");
	$result['NUMID']=get_post_meta($post_id, "numid");
 
 
	$results[] = $result;

endforeach;

$filename = 'arraytest.txt';
$test = serialize($results); 
file_put_contents($filename, $test);
echo $test;

//print_r(json_decode($test, true)); 
?>