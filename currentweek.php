<?php 
/**
 * @package WordPress
 * @subpackage WP-Skeleton
 */
?>

<!-- Declare Globals -->		
		<?php
			global $setdate;
			global $week;
		?>

<!-- DO THE MATH AND GET POSTS -->
	<?php
						
	/* Get Posts for This Week */	
	$posts = get_posts(array(
		'numberposts' => 5,
	    'category' => '15',
	    'post_type' => 'post',
		'meta_key' => 'week',
		'meta_value' => $week,
	));
			
	/* Put $posts into $queriedpsost_id (numbered array) */	
	if($posts)
	{				
		$q = 5;
				
		foreach($posts as $post)
		{
			$queriedpost_id[$q] = $post->ID;
			$q = $q - 1;
		}
	}
 
	?>

<!-- Find Sunday -->
	<?php
		$dayofweek = date('l', $setdate);
		if ($dayofweek == "Sunday"){
			$dayset = 0;
		}
		if ($dayofweek == "Monday"){
			$dayset = -1;
		}
		if ($dayofweek == "Tuesday"){
			$dayset = -2;
		}
		if ($dayofweek == "Wednesday"){
			$dayset = -3;
		}
		if ($dayofweek == "Thursday"){
			$dayset = -4;
		}
		if ($dayofweek == "Friday"){
			$dayset = -5;
		}
		if ($dayofweek == "Saturday"){
			$dayset = -6;
		}
				
		$setsunday = mktime(0, 0, 0, date("m", $setdate), date("j", $setdate)+$dayset, date("Y", $setdate));
	?>

<!-- ==================================================
		
		<a href="javascript:ReplaceContentInContainer('howtouse','
		<p>In reading the Bible it is important to do two things. It is important to read through the whole of the Bible regularly. Following this plan you will read thorugh the whole Bible once every three years. It is also important to read smaller portions of the Bible to study and reflect. With the strong foundation of Bible content you can pray over a particular passage and and ask that you would be transformed by the renewing of your mind.</p>
		
		<p><strong>The PLAN :: </strong>Monday, Wednesday, and Friday will be a short reading <em>for reflection</em>. Beginning next week, Tuesday will be an Old Testament Reading and Thursday will be a New Testament reading <em>for content</em>.</p>
		
		<p><strong>READ the BIBLE :: </strong>After you check BibleTogether for what scripture to read, open your Bible and read!</p>
		
		<p><strong>MEDITATE :: </strong>Especially on Monday, Wednesday, and Friday, spend a number of minutes reflecting on the passage yourself. Use a journal to write some of your thoughts and do a little of your own study.</p>
				
		<p><strong>READ the REFLECTION :: </strong><em>Only after</em> you have done some reflection yourself, read the reflection posted at BibleTogether.</p>
		
		<p><strong>SHARE :: </strong>Write some of your own reflections in the comments of that day. This is Bible<strong>Together</strong> after all.</p>
		
		<p><em>Don&rsquo;t underestimate how encouraging it can be to other readers at BibleTogether to see your comments. A major part of the benefit of BibleTogether is knowing that others are reading with you.</em></p>
		
		')"><center><h4>How to Use BibleTogether</h4></center></a>
		
		<p></p>
		
		<div id="howtouse" >
			<center><p>Read "How to Use BibleTogether" <strong>before</strong> you begin!</p></center>
		</div>
		
		<div class="styled"><hr /></div>

-->

	<!-- GET SERMON REFLECTION POST -->
		<?php
						
		$sermonposts = get_posts(array(
			'numberposts' => 1,
			'category' => '747',
			'post_type' => 'post',
			'meta_key' => 'week',
			'meta_value' => $week,
			));	
			
		?>
	
	<!-- GET BOOK OF THE WEEK POST -->
		<?php
						
		$bookoftheweekposts = get_posts(array(
			'numberposts' => 1,
		    'category' => '748',
		    'post_type' => 'post',
			'meta_key' => 'week',
			'meta_value' => $week,
		));	
			
		?>
		
		<h3>Week of <?php echo date("F", $setsunday), ' ', date("j", $setsunday), ', ', date("Y", $setsunday); ?></h3>

		<hr style="margin: 10px 0 0px" />
		
		<p id="navinstruction" ><em>Click on a day of the week below to view the reflection for that day.</em></p>
				
		<hr style="margin: 0px 0 10px" />
				
		<?php

		$sermon_ID = $sermonposts[0]->ID;
		$sermon_youversionurl = get_field('youversionurl', $sermon_ID);
		$sermon_logosurl = get_field('logosurl', $sermon_ID);
		$sermon_logosiphoneurl = get_field('logosiphoneurl', $sermon_ID);

		$bookoftheweek_ID = $bookoftheweekposts[0]->ID;
		$bookoftheweek_youversionurl = get_field('youversionurl', $bookoftheweek_ID);
		$bookoftheweek_logosurl = get_field('logosurl', $bookoftheweek_ID);
		$bookoftheweek_logosiphoneurl = get_field('logosiphoneurl', $bookoftheweek_ID);

        $daysOfWeek = array("MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY");
		?>
				
				
		<div class="eleven columns" clearfix>
            <?php foreach ($daysOfWeek as $index => $day) { ?>
                <div class="two columns <?php if ($index == 0) { echo "alpha"; } ?>" id="daynav">
                    <div style="display: none" id="reflectionContent<?php echo $dayNumber; ?>">
                        <?php
                        $dayNumber = $index + 1;
                        $post_id = $queriedpost_id[$dayNumber];
                        $queried_post = get_post($post_id);
                        $scripture = get_field('scripture', $post_id);
                        $youversionurl = get_field('youversionurl', $post_id);
                        $logosurl = get_field('logosurl', $post_id);
                        $logoiphoneurl = get_field('logosiphoneurl', $post_id);
                        ?>
                        <h2><?php echo $queried_post->post_title; ?></h2>
                        <p><?php echo $scripture; ?></p>
                        <p class="bible-link" id="bible-link">(
                            <a href="<?php echo $youversionurl; ?>" target="_blank">YouVersion</a> |
                            <a href="<?php echo $logosurl; ?>" target="_blank">Biblia</a> |
                            <a href="<?php echo $logoiphoneurl; ?>" target="_blank">Logos</a> )
                        </p>
                        <p id="perma-link"><a href="<?php echo get_permalink($queried_post->ID); ?>">View Reflection</a></p>
                    </div>
                    <a href="javascript:ReplaceContentInContainerWithContentFromOtherContainer('reflectioncontent','reflectionContent<?php echo $dayNumber; ?>')"><?php echo $day; ?></a>
                </div>
            <?php } ?>

			<div class="one coloum omega"></div>
		</div>		

		<hr style="margin: 10px 0 10px" />
		
			<div class="five columns alpha" id="daynav2">
                <div style="display: none" id="sermonReflectionContent">
                    <h2><?php echo $sermonposts[0]->post_title; ?></h2>
                    <p class="bible-link" id="bible-link">( <a href="<?php echo $sermon_youversionurl; ?>" target="_blank">YouVersion</a> | <a href="<?php echo $sermon_logosurl; ?>" target="_blank">Biblia</a> | <a href="<?php echo $sermon_logosiphoneurl; ?>" target="_blank">Logos</a> )</p>
                    <p id="perma-link"><a href="<?php echo get_permalink($sermon_ID); ?>">View Reflection</a></p>
                </div>
                <a href="javascript:ReplaceContentInContainerWithContentFromOtherContainer('reflectioncontent','sermonReflectionContent')">SERMON REFLECTION</a>
			</div>
			<div class="five columns" id="daynav2">
                <div style="display: none" id="bookOfTheWeekContent">
                    <h2><?php echo $bookoftheweekposts[0]->post_title; ?></h2>
                    <p class="bible-link" id="bible-link">( <a href="<?php echo $bookoftheweek_youversionurl; ?>" target="_blank">YouVersion</a> | <a href="<?php echo $bookoftheweek_logosurl; ?>" target="_blank">Biblia</a> | <a href="<?php echo $bookoftheweek_logosiphoneurl; ?>" target="_blank">Logos</a> )</p>
                    <p id="perma-link"><a href="<?php echo get_permalink($bookoftheweek_ID); ?>">View Reflection</a></p>
                </div>
                <a href="javascript:ReplaceContentInContainerWithContentFromOtherContainer('reflectioncontent','sermonReflectionContent')">BOOK of the WEEK</a>
			</div>
			<div class="one coloum omega"></div>
		<div class="eleven columns" clearfix>
			
		</div>

		<hr style="margin: 10px 0 0px" />
		
		<div id="reflectioncontent" >
			<p><em>In 2013 we are reading through the Bible in a year.</br> We read five days per week (Monday - Friday).</br>You can <a href="BibleTogether2013.pdf">download the PDF</a> of the 2013 reading plan in the menu.</p>
			<p>We will also post a short reflection from the sermon series at <a href="http://crosspointecoast.com">CrossPointe Coast</a>.</p>
			<p>Finally, if you're up for it, we invite you to read through one book of the Bible in one sitting each weekend. You can find a reflection on this book of the Bible below.</em></p>

<!--		
			<?php
		
			$field_number = $queried_post_id[1];
		
			$instructions_var = get_field('instructions', $field_number);
			$sermon_series_var = get_field('sermon_series', $field_number);
			$study_guide_var = get_field('study_guide', $field_number);
				
			if($instructions_var != "#")
			{
				echo '<p>', $instructions_var, '</p>';
			}
			if($sermon_series_var != "#")
			{
				echo '<p id="perma-link"><a href="', $sermon_series_var, '">Sermon Series at CrossPointeCoast.com</a></p>';
			}
			if($study_guide_var != "#")
			{
				echo '<p id="perma-link"><a href="', $study_guide_var, '">Download Study Guide</a></p>';
			}
 
			?>
-->

		</div>
		
	</div>	
</div>

