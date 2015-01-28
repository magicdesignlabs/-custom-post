<?php
/**
 * The Template for displaying all single Custom posts.
 **/
 get_header(); ?>
 
<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				?>
				
				<div class="single-post-box">
					<div class="single-post-img-box">
						<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('large');
							}
							//else condition for default image
						?>
					</div>
					<div class="single-post-text-box">
						<div class="single-post-title">
							<h5><?php the_title() ?></h5>
							<em><?php echo get_the_date('d.m.Y',get_the_ID()); ?></em>
						</div>
						<div class="single-post-info">
							<?php the_content() ?>
							<div class="single-post-link">
								<span><a class="share" title="share"  href="javascript:void(0);" onclick="postShare()">Share</a></span>
							</div>

						</div>
					</div>
				</div>
				<?php			
				
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;
		?>
	</div><!-- #content -->
</div><!-- #primary -->
<script>
function postShare(){
	u = location.href;
	t = document.title;
	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
	return false;
}
</script>
<?php
get_sidebar();
get_footer();
?>