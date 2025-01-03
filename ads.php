<?php

$ads_source = get_field('ads_source');
$ads = get_field('site_ads', 'options');

if($ads_source === 'custom' && !empty(get_field('custom_ads'))) {
	$ads = get_field('custom_ads');
}

if(!empty($ads)) {

    $total = count($ads);
    $total--;

    $index = rand(0, $total);

    $ad = $ads[$index];

	$ad_url = $ad['site_ad_url'];
	$ad_image = $ad['site_ad_image'];
	$ad_copy = $ad['site_ad_copy'];
    
    $adHTML = '<div class="ad-area">';
        if ($ad_url) {
            $adHTML .= '<a href="'.$ad_url.'" target="_blank">';
	    }

        $adHTML .=  wp_get_attachment_image($ad_image, 'large');

        if ($ad_url) {
		    $adHTML .= '</a>';
	    }
	    $adHTML .=  $ad_copy;
		$adHTML .= '</div>';

} else {
	$ad_default_image = get_field('ad_default_image', 'option');
	$ad_default_copy = get_field('ad_default_copy', 'option');

	if(!empty($ad_default_image) || !empty($ad_default_copy) ) {

		$adHTML = '<div  class="ad-area text-center is-default">';

		if ($ad_default_image) {
			$adHTML .= wp_get_attachment_image($ad_default_image, 'large');
		}

		if ($ad_default_copy) { echo $ad_default_copy; }

		$adHTML .= '</div>';


	}
}
return $adHTML;
/*
if (have_rows('ads', get_the_ID())) {
	echo '<div class="ad-area">';
	while( have_rows('ads') ): the_row(); 

		$ad_url = get_sub_field('ad_url');
		$ad_image = get_sub_field('ad_image');
		$ad_title = get_sub_field('ad_title');
		$ad_copy = get_sub_field('ad_copy');

	?>

		<?php if ($ad_url) { ?>
			<a href="<?php echo $ad_url; ?>">
		<?php } ?>

			<?php if ($ad_image) { ?>
				<img src="<?php echo $ad_image['sizes'][ 'medium' ]; ?>" alt=""/>
			<?php } ?>

			<?php if ($ad_title) { ?>
				<h5><?php echo $ad_title; ?></h5>
			<?php } ?>

			<?php if ($ad_copy) { echo $ad_copy; } ?>

		<?php if ($ad_url) { ?>
			</a>
		<?php }
	 endwhile;
	echo '</div>';						   
} else if( have_rows('ads', 'option') ) { 
	echo '<div class="ad-area">';
	while( have_rows('ads', 'option') ): the_row(); 

		$ad_url = get_sub_field('ad_url');
		$ad_image = get_sub_field('ad_image');
		$ad_title = get_sub_field('ad_title');
		$ad_copy = get_sub_field('ad_copy');

        ?>
		<?php if ($ad_url) { ?>
			<a href="<?php echo $ad_url; ?>">
		<?php } ?>

			<?php if ($ad_image) { ?>
				<img src="<?php echo $ad_image['sizes'][ 'medium' ]; ?>" alt=""/>
			<?php } ?>

			<?php if ($ad_title) { ?>
				<h5><?php echo $ad_title; ?></h5>
			<?php } ?>

			<?php if ($ad_copy) { echo $ad_copy; } ?>

		<?php if ($ad_url) { ?>
			</a>
		<?php }
	endwhile;
	echo '</div>';
} /* else {
	
	$ad_default_image = get_field('ad_default_image', 'option');
	$ad_default_title = get_field('ad_default_title', 'option');
	$ad_default_copy = get_field('ad_default_copy', 'option');
	
	if(!empty($ad_default_image) || !empty($ad_default_title) || !empty($ad_default_copy) ) {
	
		echo '<div  class="ad-area text-center is-default">';

		if ($ad_default_image) { 
			echo wp_get_attachment_image($ad_default_image, 'medium'); 
		}
		if ($ad_default_title) { 
			echo '<h5>'.$ad_default_title.'</h5>';
		} 
		if ($ad_default_copy) { echo $ad_default_copy; }

		echo '</div>';
		
	}
	
 }
*/
 ?>
