<?php
	if(isset($_POST) && isset($_POST['save']) && $_POST['save']!=''){
		
		if(get_option('mdl_post_no')!=$_POST['mdl_post_no']){
			if(empty($_POST['mdl_post_no']))
				update_option( 'mdl_post_no', 10 );
			else
				update_option( 'mdl_post_no', $_POST['mdl_post_no'] );
		}
		if(get_option('mdl_post_word_count')!=$_POST['mdl_post_word_count']){
			if(empty($_POST['mdl_post_word_count']))
				update_option( 'mdl_post_word_count', 250 );
			else
				update_option( 'mdl_post_word_count', $_POST['mdl_post_word_count'] );
		}
	}
echo get_option('mdl_news_no');
?>
<div class="wrap">
	<h3>Archive Page Setting</h3>
	<form action=""  method="POST">

		<table class="form-table">
			
			<tr>
				<th><label for="mdl-post">Post's to show on Archive page:</label></th>

				<td>
					<input type="number" name="mdl_post_no" maxlength="2"  id="mdl_post_no" value="<?php echo get_option('mdl_post_no'); ?>" class="regular-text" /><br />
					<span class="description">Please enter post number you want to show on list page. Default 10. For all use 0.</span>
				</td>
			</tr>
			<tr>
				<th><label for="mdl-post">Words Count on list page:</label></th>
				<td>
					<input type="number" name="mdl_post_word_count" id="mdl_post_word_count" maxlength="3" value="<?php echo get_option('mdl_post_word_count'); ?>" class="regular-text" /><br />
					<span class="description">Please enter letter count in Number to show  content on list. Default 250.</span>
				</td>
			</tr>
			
			<tr>
				<td>
					<input type="submit" class="button-primary" value="Save Changes" name="save" />
				</td>
			</tr>
		</table>
	</form>
</div>
