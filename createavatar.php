<?php 
    if(!isset($_POST['submit'])){
       header('location:index.php');
    }
    

?>


<!DOCTYPE html>
<html lang="en">
<title>LGGC 2021 AVATAR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <?php 
    $image = 'images/favicon.ico'; 
    $description = "LGGC 2021 AVATAR";
    $title = 'LGGC 2021 AVATAR | Create your avatar';
    ?>

    <meta name="description" content="<?php echo $description; ?>">

    <meta name="msapplication-TileImage" content="<?php echo $image; ?>">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="<?php echo $title; ?>">
    <meta itemprop="description" content="<?php echo $description; ?>">
    <meta itemprop="image" content="<?php echo $image; ?>">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $title; ?>">
    <meta property="og:description" content="<?php echo $description; ?>">
    <meta property="og:image" content="<?php echo $image; ?>">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $title; ?>">
    <meta name="twitter:description" content="<?php echo $description; ?>">
    <meta name="twitter:image" content="<?php echo $image; ?>">
    <link rel="shortcut icon" type="image/x-icon" href=" <?php echo $image; ?>">

    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

    <style type="text/css" media="screen">
      

        .video-con {
        position: relative; height: 150px; 
        margin-bottom: 20px;
        border-radius: 10px;
        border: 5px dotted #065592;
      }

      .tt {position: relative; 
        line-height: 150px;
        font-size: 16px;
        text-align: center;
        color: #333;
      }

      .custom-file-input::-webkit-file-upload-button {
        visibility: hidden;
      }
      .custom-file-input::before {
        content: 'Select some files';
        display: inline-block;
        background: linear-gradient(top, #f9f9f9, #e3e3e3);
        border: 1px solid #999;
        border-radius: 3px;
        padding: 5px 8px;
        outline: none;
        white-space: nowrap;
        -webkit-user-select: none;
        cursor: pointer;
        text-shadow: 1px 1px #fff;
        font-weight: 700;
        font-size: 10pt;
      }
      .custom-file-input:hover::before {
        border-color: black;
      }
      .custom-file-input:active::before {
        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
      }

      #upload_overlay {position:fixed; width:100%; height:100%; background:rgba(0,0,0,0.8); z-index:999939999999; display:none; overflow:auto;}
      #upload_con {position:relative; width:400px; height:auto; padding:10px 0px; background:; margin:70px auto; 
      border-radius:5px; box-shadow:0px 0px 0px 0px #999; border:0px solid #FFF; background: url(images/bb2.jpg1) center center; background-size: cover;}

      .imageBox
      {
          position: relative;
          height: 320px;
          width: 320px;
          border:1px solid #aaa;
          background: #fff;
          overflow: hidden;
          background-repeat: no-repeat;
          cursor:move;
      }

      .imageBox .thumbBox
      {
          position: absolute;
          top: 50%;
          left: 50%;
          width: 300px;
          height: 300px;
          margin-top: -150px;
          margin-left: -150px;
          box-sizing: border-box;
          border: 3px solid pink;
          box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.8);
          background: none repeat scroll 0% 0% transparent;
      }

      .imageBox .spinner
      {
          position: absolute;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
          text-align: center;
          line-height: 150px;
          background: rgba(0,0,0,0.7);
      }

      .cropped img {width:100%; height:auto;}

      .hidden {display:none;}

       .center1 {
            width: 125px;
            height: 122px;
            position: absolute;
            bottom: 0px;
            text-align: center;
            color: #fff;
            z-index: 2;
            top: 82.1%;
            left: 50.56%;
            transform: translate(-50%, -50%);

        }

        @-webkit-keyframes effect-2 {
            from {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes effect-2 {
            from {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media screen and (max-width: 1920px) {
            .banner-form-w3 h1 {
                margin: 100px 0;
            }
            .banner-form-w3 h2 {
                margin: 50px 0;
            }
            .clock {
                margin-top: 50px;
            }
        }

        @media screen and (max-width: 1680px) {
            .banner-form-w3 h1 {
                margin: 100px 0 50px;
            }
        }

        @media screen and (max-width: 1600px) {
            .banner-form-w3 h1 {
                margin: 75px 0 50px;
            }
        }

        @media screen and (max-width: 1366px) {
            .banner-form-w3 h1 {
                margin: 50px 0;
            }
            .banner-form-w3 h2 {
                margin: 50px 0 30px;
            }
            .clock {
                margin-top: 30px;
            }
            .footer {
                margin-top: 50px;

            }
        }

        @media screen and (max-width: 1024px) {
            .banner-form-w3 h1 {
                font-size: 50px;
                margin: 40px 0;
            }
            .spinner {
                width: 90px;
                height: 90px;
            }
            .banner-form-w3 h2 {
                margin: 30px 0;
            }
            .timer {
                font-size: 75px;
            }
        }

        @media screen and (max-width: 991px) {
            .banner-form-w3 h1 {
                font-size: 40px;
            }

            .center1 {
                width: 125px;
                height: 122px;
                position: absolute;
                bottom: 0px;
                text-align: center;
                color: #fff;
                z-index: 2;
                top: 82.1%;
                left: 51.2%;
                transform: translate(-50%, -50%);

            }
        }

        @media screen and (max-width: 640px) {
            .banner-form-w3 h1 {
                font-size: 35px;
            }

            .center1 {
                width: 125px;
                height: 122px;
                position: absolute;
                bottom: 0px;
                text-align: center;
                color: #fff;
                z-index: 2;
                top: 82.1%;
                left: 51.2%;
                transform: translate(-50%, -50%);

            }
        }

        @media screen and (max-width: 568px) {
            .banner-form-w3 h1 {
                font-size: 30px;
                margin: 30px 0;
            }
            .spinner {
                width: 75px;
                height: 75px;
            }
            .banner-form-w3 h2 {
                margin: 20px 0;
                font-size: 25px;
            }
            .banner-form-w3 h3 {
                font-size: 14px;
            }
            .timer {
                font-size: 65px;
                letter-spacing: 0;
            }

            .center1 {
                width: 125px;
                height: 122px;
                position: absolute;
                bottom: 0px;
                text-align: center;
                color: #fff;
                z-index: 2;
                top: 82.1%;
                left: 51.2%;
                transform: translate(-50%, -50%);

            }
            
        }

        @media screen and (max-width: 414px) {
            .wrapper {
                padding: 0 10px;
            }
            .text {
                font-size: 16px;
            }

            .center1 {
                width: 125px;
                height: 122px;
                position: absolute;
                bottom: 0px;
                text-align: center;
                color: #fff;
                z-index: 2;
                top: 82.1%;
                left: 51.2%;
                transform: translate(-50%, -50%);

            }
        }

        @media screen and (max-width: 384px) {
            .timer {
                font-size: 55px;
            }

            .center1 {
                width: 125px;
                height: 122px;
                position: absolute;
                bottom: 0px;
                text-align: center;
                color: #fff;
                z-index: 2;
                top: 82.1%;
                left: 51.2%;
                transform: translate(-50%, -50%);

            }
        }

        @media screen and (max-width: 375px) {
            .banner-form-w3 h1 {
                font-size: 25px;
                margin: 30px 0;
            }
            .timer {
                font-size: 40px;
            }

            .center1 {
                width: 125px;
                height: 122px;
                position: absolute;
                bottom: 0px;
                text-align: center;
                color: #fff;
                z-index: 2;
                top: 82.1%;
                left: 51.2%;
                transform: translate(-50%, -50%);

            }
        }

        @media screen and (max-width: 360px) {
            .clock {
                margin-left: -20px;
            }
            .clock .column {
                width: 20%;
            }

            .center1 {
                width: 125px;
                height: 122px;
                position: absolute;
                bottom: 0px;
                text-align: center;
                color: #fff;
                z-index: 2;
                top: 82.1%;
                left: 51.2%;
                transform: translate(-50%, -50%);

            }
        }

        @media screen and (max-width: 320px) {
            .clock {
                margin-left: -10px;
            }
            .text {
                font-size: 13px;
            }

            .center1 {
                width: 125px;
                height: 122px;
                position: absolute;
                bottom: 0px;
                text-align: center;
                color: #fff;
                z-index: 2;
                top: 82.1%;
                left: 51.2%;
                transform: translate(-50%, -50%);

            }
        }

       

    </style>
  </head>
  <body>
    
	  <?php //include('nav.php') ?>
    <!-- END nav -->

    <?php 

    ?>


    <div class="overlay"></div>

     <div id="top1"></div>

    <br />

    <section class="ftco-section ftco-no-pb">
			<div class="container">
        <!--<div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center mb-5">
           
            <div style="margin:10px auto; text-align: center;">
                <img src="images/iconnectlogo.png" style="width: 300px;">
             </div>
          </div>
        </div>-->

        <div style="height: auto; width: 100%;">
            <div class="row justify-content-center mb-4" style="padding-top: 40px; padding-bottom: 40px; padding-left: 10px; padding-right: 10px;">
              <div class="col-md-12 heading-section text-center ">
                <span class="subheading" style="color: #333;">AVATAR</span>
                <h2 class="mb-2" style="color: #333;">Graduates Global Connect with Pastor Chris</h2>
                <div style="max-width: 800px; margin:0px auto; font-size:20px;">
                  <p>
                  

                </p>
              </div>
              </div>
            </div>
        </div>


        <div class=" justify-content-center mb-5">
          <div class="">
            
            <div id="">
               

                <h2 class="mb-4 text-center text-success rt1">Creating avatar, please wait..</h2>

                <div style="width: 1200px; margin:0px auto; display: none1;" class="fm">

                 

                  

                  <button data-toggle="modal" data-target="#modal-11" id="btn-Preview-Image" class="btn btn-primary btn-lg print2" style="margin-left: 0px; display: none1;"><strong>Loading please wait..</strong></button>

                 

                  <div id="html-content-holder" style="margin-bottom:200px;">
                    
                    

                    <div style="">

                        <?php 
                                $df = $_POST['df'];
                                /*$imageFile = $_FILES['file']['tmp_name'];
                                $imageFileContents = file_get_contents($imageFile);
                                $withBase64 = base64_encode($imageFileContents);
                                $imageType = substr($imageFile ,strrpos($imageFile, '.')+1, strlen($imageFile));*/
                                $data = $df;
                                echo ' <div class="bg-img1" style=" position:absolute; width: 425px; height: 425px; background-position: center; background-size: cover; background-repeat: no-repeat; 
                     margin:0px auto; margin-top: 612px; margin-left: 400.46px; border-radius:547px/547px; background-image:url('.$data.'); ">

                     </div><!--<img src="data:image/;base64," class="img12 img-responsive" style="width:100%;"/>-->';
                    ?>

                    

                    
                 </div>
                            
                            
                            <img src="images/banner.png" class="img12 img-responsive" style="width:100%;">
                        </div>




              </div>


             

                

              </div>

              <br />

              
          
          </div>
        </div>


				
			</div>
		</section>

		<div id="DebugContainer">..</div>


    <?php //include('footer.php'); ?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <!--<script src="js/html2canvas.js"></script>
  <script src="js/html2canvas.esm.js"></script>
  <script src="js/FileSaver.js"></script>-->



  <script src="js/jquery.min.js"></script>
  <!--<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>-->
  <!--<script src="js/html2canvas33.js"></script>-->
  <script src="js/html2canvas.js"></script>
  <script src="js/html2canvas.esm.js"></script>

  <script src="js/FileSaver2.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>


  

  <!--<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>-->

  <script src="js/cropbox.js"></script>


      <script type="text/javascript">
            
            

            $(document).ready(function($) {

              $('.print2').text("Click here to download now !");
              $('.rt1').text('Your avatar is ready !');
              
              var element = $("#html-content-holder"); // global variable
              var getCanvas; // global variable
               
                  $("#btn-Preview-Image").on('click', function () {

                     

                          /*html2canvas(element, {
                           onrendered: function (canvas) {
                                  $("#previewImage").append(canvas);
                                  getCanvas = canvas;

                                  canvas.toBlob(function(blob) {
                                      saveAs(blob, "LW-MENA-CONF.png"); 
                                  });
                               }
                           });*/

                          html2canvas(document.querySelector("#html-content-holder"), { logging: true, letterRendering: 1, allowTaint: false, useCORS: true } ).then(canvas => {
                   
                            //document.body.appendChild(canvas)
                       
                            //$("#previewImage").html('')
                            //$("#previewImage").append(canvas);
                            getCanvas = canvas;

                               canvas.toBlob(function(blob) {
                                    saveAs(blob, "lggc2021.jpg"); 
                                });

                       
                        
                            });

                            
                          
                      });
            });

        </script>

    
  </body>
</html>