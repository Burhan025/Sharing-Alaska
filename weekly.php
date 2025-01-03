
<?php 

$today = date('Ymd');

$date_query = '';
$photo_title = 'Latest Photo Of The Week';

if(is_front_page()) {
	$date_query = array(
       /*
        array(
            'key'		=> 'start_date',
            'compare'	=> '<=',
            'value'		=> $today,
            'type'		=> 'DATE'
        ), */
        array(
            'key'		=> 'end_date',
            'compare'	=> '>=',
            'value'		=> $today,
            'type'		=> 'DATE'
        ),
        
    );
	
	$photo_title = 'Photo Of The Week';
	
}

$photo_args =  array( 
    
    'post_type' => 'photos',
    'posts_per_page' => 1,
    'meta_query' => $date_query,
    
 ); 

$photo_posts = new WP_Query($photo_args);

if ( $photo_posts->have_posts() ) : ?>
<div id="weeklies">
	<h3><?php echo $photo_title; ?></h3>
	<?php while ( $photo_posts->have_posts() ) : $photo_posts->the_post(); 
	
	$classes = 'weekly media';
	
	$image_id = get_post_thumbnail_id($post->ID);
	
	$image_src = wp_get_attachment_image_src( $image_id, '');
	$image_w = $image_src[1];
	$image_h = $image_src[2];

	if ($image_w > $image_h) { 
		$classes .= ' landscape';
	}
	elseif ($image_w == $image_h) {
		$classes .= ' square';
	}
	else { 
		$classes .= ' portrait';
	} 
	
	$image = wp_get_attachment_image( $image_id, 'large' );
	
	?>
		<div class="<?php echo $classes; ?>">
			<?php if (has_post_thumbnail()) { ?>
			<div class="frame">
				<?php echo $image; //the_post_thumbnail(); ?>
			</div>
			<?php } ?>
			<?php 
			echo '<div class="caption">';
			the_field('caption');
			echo '</div>';
			
			if(get_field('location')) {
				echo '<p class="meta">Location: '.get_field('location').'</p>';
			}
			if(get_field('credit_author')) {
				echo '<p class="meta">Taken by '.get_field('credit_author'); 
					if(get_field('date_shot')) { echo ' on '.get_field('date_shot'); }
				echo '</p>';
			}
			
			?>
			<?php if (get_field('ad_url')) { ?> 
			<div class="ad-area">
				<span>Brought to you by:</span>
			</div>
			<?php } ?>
		</div>
	<?php endwhile;  wp_reset_postdata(); ?> 
</div>	
<?php endif; ?>
<?php if(is_front_page()) {

	$sidebar_widgets = get_field('sidebar_widgets', 'option');
	$widgets = $sidebar_widgets['social_widgets'];

	//grabbing facebook - it's the first one in the repeater
	$widget = $widgets[0];
/*
	echo '<pre>';
	echo '<h6>sidebar widgets</h6>';
	print_r($sidebar_widgets);
	echo '<h6>widgets</h6>';
	print_r($widgets);
	echo '<h6>widget</h6>';
	print_r($widget);
	echo '</pre>';
*/

	echo ws_add_widget($widget['title'], $widget['account'], $widget['shortcode'], $widget['icon_picker']);



