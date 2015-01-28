<?php
/*
 * The template for displaying archive custom pages
 */

get_header();

$mdl_post_no		 = get_option('mdl_post_no');//limit
if($mdl_post_no==0) $mdl_post_no = "-1";
$mdl_count_mob_no		 = get_option('mdl_count_mob_no');
$mdl_post_word_count	 = get_option('mdl_post_word_count');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'posts_per_page'   => $mdl_post_no,
	'orderby'          => 'post_date',
	'order'            => "ASC",
	'post_type'        => 'custom_post',
	'post_status'      => 'publish',
	'paged' 	       => $paged,
	'suppress_filters' => false );
$postList = get_posts($args);

?>
<!--service-details-wrapper start-->

	<section class="">
		<div class="details">
			<ul class="details-block">
				<?php foreach($serviceList as $all): ?>
<!--
					<?php if($count>2) echo'<li class="show_mob_list">';else echo'<li>'; ?>
-->
					<li>
						<div class="">
							<a href="<?php echo get_permalink($all->ID); ?>" title="<?php echo get_the_title($all->ID); ?>">
								<div class="img-box">
									<?php
										if ( get_the_post_thumbnail( $all->ID) ) {
											  $image_link  = wp_get_attachment_image_src( get_post_thumbnail_id( $all->ID ),array(150,150));
											  $image_title = esc_attr( get_the_title( $all->ID  ) );
											echo"<img src='".$image_link[0]."' title='".$image_title."' alt='".$image_title."' />";
											echo"<a href='".get_permalink($all->ID)."' class='on-name-btn'>Zoom</a>";
										}
										//else condition for default image
									?>
								</div>
							</a>
							<div class="text-box">
								<div class="title">
									<h5><a href="<?php echo get_permalink($all->ID); ?>" title="<?php echo get_the_title($all->ID); ?>"><?php echo get_the_title($all->ID); ?></a></h5>
								</div>
								<div class="info">

									<?php
										$postContent =   trim(strip_tags($all->post_content));
										$desk_content =  substr($postContent,0,$mdl_post_word_count);
										
									?>
									<?php if(strlen($postContent)>$mdl_post_word_count): ?>
										<p class="view_contents"><?php echo $desk_content ?>...</p>
										<?php else: ?>
										<p class="view_contents"><?php echo $postContent ?></p>
									<?php endif; ?>

									
								</div>
								<div class="link">
									<span><a class="read-more" title="read-more" href="<?php echo get_permalink($all->ID); ?>">Read more...</a></span>
									<span><a class="share" title="share"  href="javascript:void(0);" onclick="postShare('<?php echo get_permalink($all->ID); ?>','<?php echo get_the_title($all->ID); ?>')">Share</a></span>									
								</div>
							</div>
						</div>
					</li>
					<?php 	endforeach;?>

				</ul>
			</div>
		</section>

<?php get_sidebar(); ?>
<?php

	$wp_query = new WP_Query($args);
	if($wp_query->max_num_pages>1){
			$paging_args = array(
			'base'         => '%_%',
			'format'       => '?paged=%#%',
			'total'        => $wp_query->max_num_pages,
			'current'      => max(1, get_query_var('paged')),
			//'end_size'     => 1,
			//'mid_size'     => 1,
			'prev_next'    => True,
			'prev_text'    => __('« Previous'),
			'next_text'    => __('Next »')
		);
		echo $lateset_posts_paging = paginate_links($paging_args);
	}

?>


<script type="text/javascript">
function postShare(u,t){
		 window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
}

</script>

<?php get_footer();?>
