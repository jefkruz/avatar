<?php

require('widget-functions2.php');

require("link.inc2.php");



if(isset($_GET['i']))
$id = addslashes($_GET['i']);
else header("location: ./");

$refid = 1;
if(isset($_GET['ui']))
{
	$refid = $_GET['ui'];
}//end if

$language = 'en';
if(isset($_GET['l']))
$language = addslashes($_GET['l']);

$referral = '-';
if(isset($_GET['r']))
$referal = addslashes($_GET['r']);

//xss starts
$v = trim($referal);

$v=str_replace("\n","[NEWLINE]",$v);

$v = filter_var($v, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW 
| FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);
   
$referral = str_replace("[NEWLINE]","\n",$v);

// xss ends

$category = "%%";
if(isset($_GET['c']))
$category = addslashes($_GET['c']);

if(isset($_GET['ref'])){

$ambreferal = addslashes($_GET['ref']);
//xss starts
$v = trim($ambreferal);

$v=str_replace("\n","[NEWLINE]",$v);

$v = filter_var($v, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW 
| FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);
   
$ambreferral = str_replace("[NEWLINE]","\n",$v);
// xss ends

$contentid = addslashes($_GET['i']);
$points = 5;
$userip = $_SERVER['REMOTE_ADDR'];


$dbhost = 'localhost';
$dbuser = 'hsdb_proddist';
$dbpass = 'j7vf6@i-PBJ81';
$dbname = 'prod_dist';

$myconn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
   
         if(! $myconn ){
            die('Could not connect to the database. Please contact the site admin');
         }
        // echo 'Connected successfully';

$sql1 = 'INSERT INTO views(content_id, user_ip, views, username) VALUES ('.$contentid.', "'.$userip.'", 1 , "'.$ambreferral.'") ON DUPLICATE KEY UPDATE views = views+1 ';

if (mysqli_query($myconn, $sql1)) {
     // echo "Record updated successfully";
   } else {
     // echo "Error updating record: " . mysqli_error($conn);
   }

if (mysqli_affected_rows($myconn) != 2){

$sql3 = 'SELECT * FROM user_activity WHERE username="'.$ambreferral.'" AND content_id='.$contentid.'';
$result2 = mysqli_query($myconn, $sql3);

         if (mysqli_num_rows($result2) > 0) {

$sqlquery = ' UPDATE user_activity SET points=points + 5 WHERE content_id='.$contentid.' ' ;

if (mysqli_query($myconn, $sqlquery)) {
    //  echo "Record updated successfully";
   } else {
     // echo "Error updating record: " . mysqli_error($conn);
   }


   } else {

   	$sqlquery = "INSERT INTO user_activity(username, content_id, points)VALUES ('".$ambreferral."', $contentid, 5)";

      if (mysqli_query($myconn, $sqlquery)) {
              // echo "New record created successfully";
            } else {
              // echo "Error: " . $sqlquery . "" . mysqli_error($myconn);
            }

   }
}
 




}



function getCategory($category_id)
{
	//echo "id: ".$category_id;
	if($category_id == 1)
	return "Videos";
	else
	if($category_id == 2)
	return "Magazines";
	else
	if($category_id == 3)
	return "Audio Confessions";
	else
	if($category_id == 4)
	return "News";
	else
	if($category_id == 5)
	return "News";
	else
	if($category_id == 6)
	return "Prayer Network";
	else
	return "Post";
	
}//end fn getCategory

//initial query
$query = "Select * FROM content where content_id LIKE :id ";


$query_params = array(
        ':id' => $id
    );
	
//execute query
try {
    $stmt   = $db->prepare($query);
    $result = $stmt->execute($query_params);
}
catch (PDOException $ex) {
    $response["success"] = 0;
    $response["message"] = "Database Error!";
    echo $response["message"];
}

// Finally, we can retrieve all of the found rows into an array using fetchAll 
$rows = $stmt->fetchAll();
					 
if ($rows) {
    $response["success"] = 1;
    $response["message"] = "Post Available!";
    $response["posts"]   = array();
   
   
        $row             = $rows[0];
        $title = $row["title"];
        $content_date    = $row["content_date"];
        $thumbnail_name  = $row["thumbnail"];
		$content_id = $row["content_id"];
		$content_type = $row["content_type"];
		$content_data = $row["content_data"];
		$category_id = $row["category_id"];
    
    if($category_id == 6)
    header("location: http://enterthehealingschool.org/prayer/");
    
		$language = $row["language"];
		$content_description = $row["content_description"];
		$short_description = truncate($content_description, 140);
		$views = number_format($row['views']);
		$widget_image = $row['widget_image'];
		$video_url = $row['video_url'];
		$magazine_url = $row['interactive_mag'];
		$likes = 0;
		$likes_response = getLikes($db, $content_id);
		if($likes_response['success'] == 1)
		{
			$likes = $likes_response['likes_count'];
		}

		
		$add_likes_response = addView($db, $content_id);
		if($add_likes_response['success'] == 0)
		echo $add_likes_response['message'];
		
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		/*$add_postview_response = addNewPostView($db, $content_id, $referral);
		if($add_postview_response['success'] == 0)
		echo $add_postview_response['message'];
		*/
		//addVOTWView($db, $content_id, $referral);
		
		
}//end if rows

		$weekVideoResponse = getWeekVideoLanguage($db, $language);
		$nextPostResponse = getNextPostLang($db, $content_id, $category_id, $language);
		
		$previousPostresponse = getPreviousPostLang($db, $content_id, $category_id, $language);
		$category_vids_response = getMoreCategoryVideosLang($db, $category_id, $language);
		
$lang_response = getLanguages($db);

$category = $category_id;


?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class=""> <!--<![endif]-->
<head>

	
<meta name="keywords" content="christ embassy healing school, pastor chris oyakhilome, watch inspiring video testimonies, of healings and miracles, receive daily faith confessions, download our free magazines, healing magazine, <?php echo $title; ?>">
    <meta name="description" content="<?php echo strip_tags(addslashes($content_description)); ?>">

	<meta property="al:android:url" content="https://enterthehealingschool.org/content/content.php?i=<?php echo $content_id; ?>">
   
    <meta property="al:android:package" content="org.enterthehealingschool.hsmobile">
    <meta property="al:android:app_name" content="HS Mobile">
    <meta property="al:ios:url" content="https://enterthehealingschool.org/content/content.php" />
     <meta property="al:ios:app_store_id" content="703895884" />
     <meta property="al:ios:app_name" content="HS Mobile" />
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:type" content="article"/>
    <meta content="https://enterthehealingschool.org/content/content.php?i=<?php echo $content_id; ?>" property="og:url">
    <meta property="fb:app_id" content="1858282071081648" />
    <meta content="<?php echo $widget_image; ?>" property="og:image">
    <meta content="<?php echo $title; ?>" property="og:title">
    <meta content="<?php echo strip_tags(addslashes($short_description)); ?>" property="og:description">

    <title><?php echo $title; ?></title>
		
	<link rel="shortcut icon" href="images/favicon.ico">
    <link href="libraries/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <linK href="libraries/owl-carousel/owl.carousel.css" rel="stylesheet" />
    <linK href="libraries/owl-carousel/owl.theme.css" rel="stylesheet" /> 
	<link href="libraries/flexslider/flexslider.css" rel="stylesheet" /> 
	<link href="libraries/fonts/font-awesome.min.css" rel="stylesheet" />
	<link href="libraries/animate/animate.min.css" rel="stylesheet" />
    <link href="css/components.css" rel="stylesheet" />
	<link href="style.css" rel="stylesheet" />
    <link href="css/media.css" rel="stylesheet" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><!-- jQuery Latest -->
	<script src="media/build/mediaelement-and-player.min.js"></script><!-- Audio/Video Player jQuery -->
	<script src="media/build/mep-feature-playlist.js"></script><!-- Playlist JavaSCript -->
     <script src='comment_system/stopwatch/src/timer.jquery.js'></script>
	
	<link rel="stylesheet" href="media/css/progression-player.css" /><!-- Default Player Styles -->
	<link href="media/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /><!-- Player Icons -->
	
	<link rel="stylesheet" href="media/css/skin-fancy.css" /><!-- Fancy Skin -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5/html5shiv.min.js"></script>
      <script src="js/html5/respond.min.js"></script>
    <![endif]-->

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../assets/stylesheets/arthref.min.css">
    <script src="translate.js">	
      </script>
</head>

<body data-offset="200" data-spy="scroll" data-target=".primary-navigation">
<div id="container" class="boxed">
	<?php echo "<h4>".$messenger."</h4>"; ?>
	<a id="top"></a>
	
	<?php require("menu.php"); ?>

	
	<!-- Single Post -->
	<div id="single-post" class="single-post">
			
		<!-- Container -->
		<div class="container">
			<div class="row">
				<!-- col-md-8 -->
				<div class="col-md-8 col-sm-6">

					<?php
					 
					if ($rows) {
		$shareUrl = "http://ethsch.org/c/?i=$content_id";
                        $shareUrl = "http://enterthehealingschool.org/content/?i=$content_id";
		$encodedShareURL = urlencode($shareUrl);
	
		      ?>

						<article>	

							

						
 
						<!-- blog-box -->
						<div class="blog-box">
                        <a href="./?c=<?php echo $category_id; ?>"><img src="<?php echo $widget_image; ?>" height="0px" width="0px" /></a>
							<div class="entry-cover">
								
								

							<?php 
							if($category_id == 1 || $video_url != "")
							{
								show_video($title, $content_date, $thumbnail_name, $content_id, $content_type, $content_data, $category_id, $content_description, $views, $widget_image, $video_url );

								$votw_response = addVOTWView($db, $content_id, $referral);
								if($votw_response['success'] == 0)
								echo $votw_response['message'];
								
							}
							
							

							else
							if($category_id == 3)
							show_audio($title, $content_date, $thumbnail_name, $content_id, $content_type, $content_data, $category_id, $content_description, $views, $widget_image);
							
							else
							if($category_id == 2 && isset($_POST['demail']) )
							{

								$fname = addslashes($_POST['fname']);
								//$lname = addslashes($_POST['lname']);
								$demail = addslashes($_POST['demail']);
								$distribute = $_POST['distribute'];
								$dlanguage = $_POST['dlanguage'];
								$translate = $_POST['translate'];
								$tlanguage = $_POST['tlanguage'];
								//$rid = 1;
								$download_date = date('Y-m-d');
								$clientIp = $_SERVER['REMOTE_ADDR'];//get_client_ip();
								$country = ip_info($clientIp, 'Country');
								$country_val = $country;
								$country = ($country_val == "")?"na":$country_val;
								
								$magd = add_download($db, $title, $clientIp, $country, $download_date, $fname, $demail, $distribute, $dlanguage, $translate, $tlanguage);

								if ($magd['success'] == 1)
								{
									//https://enterthehealingschool.org/magazine/images/pdf/April2020.pdf
								 addNewPostView($db, $content_id, $referral);
								  $cdata =  substr($content_data,54);
								  header("Refresh: 5; url=$content_data");
				                   //header('Content-type: application/pdf');
                                   //header('Content-Disposition: attachment; filename="$cdata"');
				                  echo '<span style="color:blue;"><b>'.$magd["message"].'</b></span>';
                   				}//end if
			                    
			                    else
			                    {
			                       echo $magd['message'];
			                    }//end else
							    //show_interactive_magazine($magazine_url, $content_data, $widget_image);

						    }
							
							else
							if($category_id == 2)
							show_magazine($title, $content_date, $thumbnail_name, $content_id, $content_type, $content_data, $category_id, $content_description, $views, $widget_image, $magazine_message, $refid); 
							
							
							else
							show_post($title, $content_date, $thumbnail_name, $content_id, $content_type, $content_data, $category_id, $content_description, $views, $widget_image);
							
							?>
						<br>	

						<!-- Latest Updates -->
    <div class="container">
        
        <div class="col-md-5 latest-post-list no-padding" style=" width: 710px; height: 50px; margin-bottom: 0px; border-bottom-width: 0px; border-top-width: 0px;">
            <div data-speed="10000" data-direction="left" class="marquee">    
			
			 
			<!--<a href="https://www.enterthehealingschool.org/session/summer">
                    <img src="images/ca.png" style=" height: 50px; width: 50px;" alt="Healing School Summer Session in Canada" />The Healing School Summer Session 2020 - <strong>BOOK TO ATTEND</a></strong></a>-->
                    
			
			<a href="https://www.enterthehealingschool.org/part/donation.php?l=12">
                    <img src="images/do.jpg" style=" height: 50px; width: 50px;" alt="Donate" />Give Today - <strong>DONATE</a></strong></a>


            <a href="https://www.enterthehealingschool.org/cyberchurch/">
                    <img src="images/CyberChurchLogo.png" style=" height: 50px; width: 70px;" alt="Donate" />- <strong>JOIN OUR CYBER CHURCH</a></strong></a>
			
			<!-- <a href="https://www.enterthehealingschool.org/session/summer/pre-book1.php">
                    <img src="images/ca.png" style=" height: 50px; width: 50px;" alt="Donate" />The Healing School Summer Session 2019 - <strong>BOOK TO ATTEND</a></strong></a> -->
		
		<a href="https://www.enterthehealingschool.org/prayerconference/signup.php?r=online">
                    <img src="images/pr.jpg" style=" height: 50px; width: 50px;" alt="Pray" />- <strong>JOIN OUR PRAYER NETWORK</a></strong></a
                    

			 ></div>
        </div>
    </div>
    <!-- Latest Updates -->
							</div>
					
							<div class="blog-content" style="margin-top: 20px;">
								<h2 class="entry-title"><?php echo $title; ?> </h2>
								<?php
								if($category_id == 6)
								{
								?>
                                    <p class="time"><i class="fa fa-clock-o"></i> <?php echo $content_date; ?></span> |  <i class="fa fa-eye fa-lg"></i> <?php echo $views; ?> <span id="lang_body_views">Views </span>
                                    <?php
                                    $id_post = $content_id;
                                    
                                    $f_userId = get_client_ip();
                                    
                                    $praying_resp = getPrayers($id_post, $db);
                                    $praying = $praying_resp['count']+$likes;
                                    $prayed_resp = getPrayed($f_userId, $id_post, $db);
                                    $prayed = $prayed_resp['count'];
                                    echo ($prayed == 0)?
                                    ' <button type="button"  class="btn  pull-right  pause-timer-btn btn-danger">Stop</button> 
                                    
                                    <input type="text" name="timer" class="timer pull-right" placeholder="0 sec" contenteditable="false" value="timer" maxlength="10"  style="max-width:70px; border:none; font-weight:bold; margin-right:5px;"/> 
                                    
                                    <button type="button" name="btn_pray" id="btn_pray" class="btn btn-primary pull-right" style="margin-right:30px">Start Praying ('.$praying.')</button>
                                    
                                    <button type="button" name="btn_praying" id="btn_praying" class="btn btn-success pull-right" style="margin-right:30px"> Praying ('.$praying.') </button> ':
                                    '<button type="button" name="btn_praying2" id="btn_praying2" class="btn btn-success pull-right" style="margin-right:30px"> Prayed ('.$praying.') </button>';
                                    ?>
                                    
                                   

                                    
<script>
	$(document).ready(function () {
		var hasTimer = false;
		$('.shareSelector').socialShare({
			social: 'facebook,twitter,yahoo,linkedin,pinterest,reddit,stumbleupon,tumblr',
			whenSelect: true,
			selectContainer: '.shareSelector',
			title: '<?php echo $title ?>',
			shareUrl: '<?php echo $shareUrl; ?>'
		});
		
		$('#btn_praying').hide();
		$('.timer').hide();
		$('.pause-timer-btn').hide();
		
		$('#btn_pray').click(function(event){    
            $('#btn_pray').hide();
				$('#btn_praying').show();
				 $("#btn_praying").css({opacity:0.6});
				 $('.timer').show();
		$('.pause-timer-btn').show();
				hasTimer = true;
				
				$('.timer').timer({
					editable: false
                });
				
			 $.ajax({
                    type: "POST",
                    url: "comment_system/ajax/add_prayer.php",
                    data: 'act=like-com&id_post='+<?php echo $id_post; ?>+'&likerId=<?php echo $f_userId; ?>'+'&likes=<?php echo $likes; ?>',
                    success: function(html)
					{
                        
                       $('#btn_praying').text(html); 
						
                    }  
                });
            //$('.new-com-cnt').show();
            //$('#name-com').focus();
			//alert("I am praying!");
			
        });
		
		// Init timer pause
			$('.pause-timer-btn').on('click', function() {
				$('.timer').timer('pause');
				alert("Thank you for joining us in prayer. Kindly post a comment in the comment box below.");
				//$('.comment_frame').focus();
			});
		
	});

	

</script>
                                <?php
								}//end if
								else
								{
								?> 
                                <p class="time"><i class="fa fa-clock-o"></i> <?php echo $content_date; ?></span> |  <i class="fa fa-eye fa-lg"></i> <?php echo $views; ?> <span id="lang_body_views">Views</span> <!--<span style="float:right" id="lang_body_views"><a class="btn btn-danger" href="#" role="button">MAKE A DONATION</a></span>--></p>

                                <?php
								}//end else
								?>
                      
								<p style="color:black"><?php echo $content_description; ?></p>
								
								
								<div class="tags">
									<a href="./?c=<?php echo $category_id; ?>">#<?php echo getCategory($category_id); ?></a> 
                                      <div style="float:right"><a href="https://www.enterthehealingschool.org/part/donation.php?l=12"><span id="lang_body_share">Make a Donation</span> </a></div>
                          <!--Social media share buttons --> 
								</div>

                                      <div><span style="float:right"><!-- AddToAny BEGIN -->
							<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
							<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
							<a href="https://web.kingsch.at/superusers/5654a35a38da4d68b300ff68" target="_blank"><img src="../hsch/images/kingschat.png"></a>
							<a class="a2a_button_facebook"></a>
							<a class="a2a_button_twitter"></a>
							<a class="a2a_button_email"></a>
							<a class="a2a_button_pinterest"></a>
							<a class="a2a_button_linkedin"></a>
							<a class="a2a_button_whatsapp"></a>
							<a class="a2a_button_telegram"></a>
							<a class="a2a_button_wechat"></a>
							</div>
							<script>
							var a2a_config = a2a_config || {};
							a2a_config.onclick = 1;
							</script>
							<script async src="https://static.addtoany.com/menu/page.js"></script>
							<!-- AddToAny END --></span></div>
								<div class="blog-social blog-content-inner">
									
										

									
                                    
                         
 <script src="../assets/javascripts/socialShare.min.js"></script>

<script>


	$(document).ready(function () {

		$('.shareSelector').socialShare({
			social: 'facebook,twitter,yahoo,linkedin,pinterest,reddit,stumbleupon,tumblr',
			whenSelect: true,
			selectContainer: '.shareSelector',
			title: "<?php echo $title ?>",
			shareUrl: '<?php echo $shareUrl; ?>'
		});

	});

</script>

								<iframe src='comment_system/index.php?id=<?php echo $content_id; ?>' style='border:0' width="100%" height="300px"></iframe>
                                </div>

								 
								
								<div class="blog-content-inner prev-next-post">
									<?php
									if($previousPostresponse['success'] == 1)
									{
										$previousVideo = $previousPostresponse['video'];
									?>
                                    <div class="col-md-6">
										<a href="content.php?i=<?php echo $previousVideo['content_id'] ?>" class="col-md-4 col-sm-4 col-xs-3"><img src="<?php echo $previousVideo['thumbnail'] ?>" alt="previous" /></a>
										<div class="col-md-8 col-sm-8 col-xs-9">
											<a href="content.php?i=<?php echo $previousVideo['content_id'] ?>"><i class="fa fa-angle-double-left"></i> <span id="lang_body_more_post">Previous Post</span></a>
											<a href="content.php?i=<?php echo $previousVideo['content_id'] ?>" class="block-title"><?php echo $previousVideo['title'] ?></a>
										</div>
                                        <?php
									}//end if
										?>
									</div>
									<?php if($nextPostResponse['success'] == 1)
									{
										$nextVideo = $nextPostResponse['video'];
										 ?>
                                    <div class="col-md-6">
										<div class="col-md-8 col-sm-8 col-xs-9">
											<a href="content.php?i=<?php echo $nextVideo['content_id'] ?>"><span id="lang_body_newer_post">Next Post</span> <i class="fa fa-angle-double-right"></i></a>
											<a href="content.php?i=<?php echo $nextVideo['content_id'] ?>" class="block-title"><?php echo $nextVideo['title'] ?></a>
										</div>
										<a href="content.php?i=<?php echo $nextVideo['content_id'] ?>" class="col-md-4 col-sm-4 col-xs-3"><img src="<?php echo $nextVideo['thumbnail'] ?>" alt="next" /></a>
									</div>
                                    <?php
									}//end if
									?>
								</div>
								
							</div>	


							
						</div><!-- blog-box /- -->
						
					</article>

					<?php
     
    // echoing JSON response
    //echo json_encode($response);
    
    
} 
else {
    $response["success"] = 0;
    $response["message"] = "No Post Available!";
    echo $response["message"];
}

					 ?>   
                        
				</div><!-- col-md-8 /- -->
			
				<!-- col-md-4 -->
				<div class="col-md-4 col-sm-6 widget-sidebar">
					
					<!-- Latest Post -->
					<aside class="widget widget_latest_post">
						<h3 class="widget-title"><span id="lang_body_votw">Video Of The Week</span></h3>
						<div class="widget-inner">
							<ul class="post">
								<?php
								if($weekVideoResponse['success'] == 1)
								{
									$weekVideo = $weekVideoResponse['video'];
									$vow_likes = 0;
									$likes_response = getLikes($db, $weekVideo['content_id']);
									if($likes_response['success'] == 1)
									{
										$vow_likes = $likes_response['likes_count'];
									}
								?>
                                <li>
									<div class="col-md-5 col-sm-5 col-xs-4">
										<a href="content.php?i=<?php echo $weekVideo['content_id'] ?>"><img src="<?php echo $weekVideo['thumbnail']; ?>" alt="popular-post" /></a>
									</div>
									<div class="col-md-7 col-sm-7 col-xs-8">
										<h4><?php echo $weekVideo['title']; ?></h4>
										<a href="content.php?i=<?php echo $weekVideo['content_id'] ?>" class="post-title"><?php echo truncate($weekVideo['content_description'], 60); ?> </a>
										<p>
											<i class="fa fa-thumbs-o-up fa-lg"></i> <?php echo $vow_likes; ?> 
											<span style="padding-left:5px"><i class="fa fa-eye fa-lg"></i> <?php echo number_format($weekVideo['views']); ?> <?php echo ($language == "en")?" Views":""; ?> </span>
											
										</p>
									</div>
								</li>
                                <?php 
								}//end if
								?>
								
							</ul>
						</div>
					</aside><!-- Latest Post /- -->
					<!-- Latest Post -->
					<aside class="widget widget_latest_post">
						<a href="./?c=<?php echo $category_id; ?>"><h3 class="widget-title"><span id="lang_body_readmore">View More</span></h3></a>
						<div class="widget-inner">
							<ul class="post">
								<?php
								if($category_vids_response['success'] == 1)
								{
									$cat_vids = $category_vids_response['content'];
									foreach($cat_vids as $cat_vid)
									{
										
									$cat_vid_likes = 0;
									$cat_vid_likes_response = getLikes($db, $cat_vid['content_id']);
									if($cat_vid_likes_response['success'] == 1)
									{
										$cat_vid_likes = $cat_vid_likes_response['likes_count'];
									}
								?>
                                
                                <li>
									<div class="col-md-5 col-sm-5 col-xs-4">
										<a href="content.php?i=<?php echo $cat_vid['content_id'] ?>"><img src="<?php echo $cat_vid['thumbnail'] ?>" alt="popular-post" /></a>
									</div>
									<div class="col-md-7 col-sm-7 col-xs-8">
										<a href="content.php?i=<?php echo $cat_vid['content_id'] ?>" class="post-title"><?php echo $cat_vid['title']; ?> </a>
										<p>
											<i class="fa fa-thumbs-o-up"></i> <?php echo $cat_vid_likes; ?>
											<span> <i class="fa fa-eye fa-lg"></i> <?php echo number_format($cat_vid['views']); ?> <?php echo ($language == "en")?" Views":""; ?></span>
										</p>
									</div>
								</li>
                                <?php }//end for
								 }//end if
								 else
								 echo $category_vids_response['message'] ?>
								
							</ul>
						</div>
						<hr />
                        <center><div class="tags2"><a href="./?c=<?php echo $cat_vid['category_id'] ?>" style="color:#ffffff;"><span id="lang_body_more">More</span></a></div></center>
					</aside><!-- Latest Post /- -->
					
					
					
					
					
					
				</div><!-- col-md-4 /- -->
			</div>
		</div><!-- container /- -->
	</div><!-- Single Post /- -->
	
	<!-- Footer Section -->
	<div id="footer-section" class="footer-section">
		
		<!-- Footer Bootom -->
		<div class="footer-bottom">
			<div class="container">
				<div class="col-md-6 col-sm-6">
					<p>&copy; <?php echo date('Y'); ?> <?php echo ($language == "en")?" Healing School Communications":""; ?> - <span id="lang_body_all_rights">All Rights Reserved</span></p>
				</div>
				
			</div>
		</div><!-- Footer Bootom /- -->
	</div>
	<!-- Footer Section /- -->


<script>
$('.progression-single').mediaelementplayer({
    audioWidth: 640, // width of audio player
    audioHeight:50, // height of audio player
    startVolume: 0.5, // initial volume when the player starts
    features: ['playpause','current','progress','duration','tracks','volume','fullscreen']
    });
</script>	
	<!-- jQuery Include -->
	
	<!-- <script src="libraries/jquery.min.js"></script> -->	
	<script src="libraries/jquery.easing.min.js"></script><!-- Easing Animation Effect -->
	<script src="libraries/bootstrap/bootstrap.min.js"></script> <!-- Core Bootstrap v3.2.0 -->
	<script src="libraries/jquery.animateNumber.min.js"></script> <!-- Used for Animated Numbers -->
	<script src="libraries/jquery.appear.js"></script> <!-- It Loads jQuery when element is appears -->
	<script src="libraries/jquery.knob.js"></script> <!-- Used for Loading Circle -->
	<script src="libraries/wow.min.js"></script> <!-- Use For Animation -->
	<script src="libraries/flexslider/jquery.flexslider-min.js"></script> <!-- flexslider   -->
	<script src="libraries/owl-carousel/owl.carousel.min.js"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
	<script src="libraries/expanding-search/modernizr.custom.js"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
	<script src="libraries/expanding-search/classie.js"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
	<script src="libraries/expanding-search/uisearch.js"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
	<script>
		new UISearch( document.getElementById( 'sb-search' ) );
	</script>
	<script type="text/javascript" src="libraries/jssor.js"></script>
    <script type="text/javascript" src="libraries/jssor.slider.min.js"></script>
	<script type="text/javascript" src="libraries/jquery.marquee.js"></script>
	<!-- Customized Scripts -->
	<script src="js/functions.js"></script>

<script>
      localize("<?php echo $language; ?>");
	// $(document).load(localize);
   </script>

</div>	
</body>
</html>
