<?php
include_once('./_common.php');
include_once(G5_THEME_PATH.'/SF.lib.php');
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SOFTZONE - 소프트존 반응형 홈페이지 템플릿 ABOUT 6 템플릿</title>

        <!-- Bootstrap -->
        <link href="<?php echo G5_THEME_URL ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- font awesome for icons -->
        <link href="<?php echo G5_THEME_URL ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- flex slider css -->
        <link href="<?php echo G5_THEME_URL ?>/css/flexslider.css" rel="stylesheet" type="text/css" media="screen">
        <!-- animated css  -->
        <link href="<?php echo G5_THEME_URL ?>/css/animate.css" rel="stylesheet" type="text/css" media="screen"> 
        <!-- Revolution Style-sheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_URL ?>/rs-plugin/css/settings.css">
        <link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_URL ?>/css/rev-style.css">
        <!--owl carousel css-->
        <link href="<?php echo G5_THEME_URL ?>/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css" media="screen">
        <link href="<?php echo G5_THEME_URL ?>/owl-carousel/assets/owl.theme.default.css" rel="stylesheet" type="text/css" media="screen">
        <!--mega menu -->
        <link href="<?php echo G5_THEME_URL ?>/css/yamm.css" rel="stylesheet" type="text/css">
        <!--cube css-->
        <link href="<?php echo G5_THEME_URL ?>/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/bootstrap-select.css">
        <!-- custom css-->
        <link href="<?php echo G5_THEME_URL ?>/css/style_aqours.css" rel="stylesheet" type="text/css" media="screen">
		<link href="<?php echo G5_THEME_URL ?>/css/common.css" rel="stylesheet" type="text/css" media="screen">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
		<?php
		include_once(G5_THEME_PATH.'/navigation.php');
		?>
        <div class="breadcrumb-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>About</h4>
                    </div>
                    <div class="col-sm-6 hidden-xs text-right">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo G5_URL?>">Home</a></li>
                            <li>About</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div><!--breadcrumbs-->
        <div class="divide80 mobile-none"></div>
        <div class="container">
            <div class="row" style="overflow: hidden;">
                <div class="col-sm-3" style="overflow-y: auto;">
					<?php include_once(G5_THEME_PATH.'/left_menu.php');?>
                </div><!--sidebar col end-->
                <div class="col-sm-9">

					<div class="row mb40">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="img-box mb20">
								<img src="https://via.placeholder.com/408x245" class="img-responsive">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="img-box mb20">
								<img src="https://via.placeholder.com/408x245" alt="" class="img-responsive">
							</div>
						</div>
					</div><!-- //row -->

					<div class="row">
						<div class="col-md-12 margin20">
						<h3>COMPANY</h3>
								<p class="ko">
								1~2년 전만 해도 수많은 악성코드의 한 종류에 불과했던 랜섬웨어는 현재 막대한 피해를 동반하며 전세계를 휩쓰는 광풍이 되었다. 이와 관련해 안랩 시큐리티대응센터(AhnLab Security Emergency-response Center, 이하 ASEC)는 2017년 2분기 ASEC 리포트를 통해 2017년 상반기 랜섬웨어 동향을 발표할 예정이다. ASEC에 따르면 감염된 시스템의 파일을 암호화하는 랜섬웨어가 본격적으로 등장한 것은 2016년으로, 이후 공격자 관점의 랜섬웨어 수익 모델과 시장이 형성되기 시작했다. 2017년에 들어서면서 랜섬웨어의 기능은 더욱 고도화되었으며 시장확대, 고수익 추구 등의 경향이 두드러진다는 것이 ASEC의 설명이다. 
								</p>
								<p>
								2016년 1분기에 발견된 랜섬웨어의 종류가 65종이었으나, 2017년 1분기에는 79종에 달했다. 전년도 동기 대비 랜섬웨어의 종류가 늘어난 원인은 랜섬웨어 제작 서비스(Ransomware as a Service, RaaS)와 오픈소스를 이용한 랜섬웨어 제작의 활성화로 판단된다. 랜섬웨어는 이미 등장기와 성장기를 넘어서 관련 시장 형성을 통한 성숙기로 접어든 것으로 볼 수 있다. 
								</p>
						</div>
						<div class="col-md-12">
							
						</div>
					</div><!--about intro-->

					<div class="divide50"></div>



					<div class="divide50"></div>

					<!-- faq -->
					<div class="row">
						<div class="col-md-12">
							<h3>FAQ</h3>
							<div class="divide20"></div>
							<div class="panel-group wow animated bounceInUp animated" data-wow-delay="0.2s" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
												<i class="fa fa-desktop"></i>    반응형 홈페이지
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											반응형 웹 디자인(responsive web design, RWD)이란 하나의 웹사이트에서 PC, 스마트폰, 태블릿 PC 등 접속하는 디스플레이의 종류에 따라 화면의 크기가 자동으로 변하도록 만든 웹페이지 접근 기법을 말한다.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
												<i class="fa fa-crop"></i>    템플릿 
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											일반적인 홈페이지를 비교해봐도 저렴하게 구매할 수 있는 완성형 웹디자인 문서를 말합니다. 저렴한 금액에 맞춤 개발을 진행 할 수 있는 장점이 있습니다.
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
												<i class="fa fa-cogs"></i>    템플릿 사용법
											</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">
											HTML5, CSS , CSS3 , PHOTOSHOP , JAVASCRIPT 등의 언어로 개발되어 편리한 뷰와 일관성을 제공하며 1개의 도메인에 1개의 사이트만 사용 가능 합니다.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- //row -->

					<div class="divide50"></div>
					<!-- skill -->
					<div class="row">
						<div class="col-md-12 margin20">
							<h3>Skills</h3>
							<div class="divide20"></div>
							<div class="skills-wrapper wow animated bounceInUp animated" data-wow-delay="0.2s">
								<h3 class="heading-progress">Web Design <span class="pull-right">90%</span></h3>
								<div class="progress">
									<div class="progress-bar" style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar">
									</div>
								</div>
								<h3 class="heading-progress">Web Development <span class="pull-right">100%</span></h3>
								<div class="progress">
									<div class="progress-bar" style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar">
									</div>
								</div>
								<h3 class="heading-progress">Marketing <span class="pull-right">50%</span></h3>
								<div class="progress">
									<div class="progress-bar" style="width: 50%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar">
									</div>
								</div>   
								<h3 class="heading-progress">Photography <span class="pull-right">60%</span></h3>
								<div class="progress">
									<div class="progress-bar" style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar">
									</div>
								</div> 
							</div><!--skills-->
						</div><!--col-->
					</div>


                </div><!-- //col -->
            </div><!-- //row -->
        </div><!--left sidebar container-->

		<div class="divide80"></div>
        <div class="intro-text-1 light">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="animated slideInDown">SOFTZONE is Applicaton & creative Template
                        </h4>

                        <p>
                            Clean & powerful Easy to use multipurpose business HTML5 template.
                        </p>                   
                    </div>
                    <div class="col-sm-4">
                        <a href="#" target="_blank" class="btn border-theme btn-lg">Purchase now</a>
                    </div>
                </div>
            </div>
        </div> <!--intro text end-->
		<?php
		include_once(G5_THEME_PATH."/footer.php");
		?>


        <!--must need plugin jquery-->
        <script src="<?php echo G5_THEME_URL ?>/js/jquery.min.js"></script>        
        <!--bootstrap js plugin-->
        <script src="<?php echo G5_THEME_URL ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>       
        <!--easing plugin for smooth scroll-->
        <script src="<?php echo G5_THEME_URL ?>/js/jquery.easing.1.3.min.js" type="text/javascript"></script>
        <!--sticky header-->
        <script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/jquery.sticky.js"></script>
        <!--flex slider plugin-->
        <script src="<?php echo G5_THEME_URL ?>/js/jquery.flexslider-min.js" type="text/javascript"></script>
        <!--parallax background plugin-->
        <script src="<?php echo G5_THEME_URL ?>/js/jquery.stellar.min.js" type="text/javascript"></script>
		<script src="<?php echo G5_THEME_URL ?>/js/jquery.backstretch.js"></script>
        <!--digit countdown plugin-->
        <script src="<?php echo G5_THEME_URL ?>/js/waypoints.min.js"></script>
        <!--digit countdown plugin-->
        <script src="<?php echo G5_THEME_URL ?>/js/jquery.counterup.min.js" type="text/javascript"></script>
        <!--on scroll animation-->
        <script src="<?php echo G5_THEME_URL ?>/js/wow.min.js" type="text/javascript"></script> 
        <!--owl carousel slider-->
        <script src="<?php echo G5_THEME_URL ?>/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
        <!--popup js-->
        <script src="<?php echo G5_THEME_URL ?>/js/jquery.magnific-popup.min.js" type="text/javascript"></script>
		<!-- responsive-slider -->
        <!--popup js-->
        <script src="<?php echo G5_THEME_URL ?>/js/jquery.magnific-popup.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo G5_THEME_URL ?>/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
        <script type="text/javascript" src="<?php echo G5_THEME_URL ?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/revolution-custom.js"></script>

		<script src="<?php echo G5_THEME_URL ?>/slide/responsive-slider.js"></script>    		
		<script src="<?php echo G5_THEME_URL ?>/js/raphael-min.js"></script>
		<script src="<?php echo G5_THEME_URL ?>/morris/morris.min.js"></script>   
		<script src="<?php echo G5_THEME_URL ?>/js/bootstrap-select.js"></script>
        <script src="<?php echo G5_THEME_URL ?>/js/custom.js" type="text/javascript"></script>

	</body>
</html>

<script>
$(document).ready(function(){
	$('.breadcrumb-wrap').backstretch([
	  "<?php echo G5_THEME_URL?>/img/etc/sub-1.png",
	  "<?php echo G5_THEME_URL?>/img/etc/sub-2.png",
	  "<?php echo G5_THEME_URL?>/img/etc/sub-3.png",
	  "<?php echo G5_THEME_URL?>/img/etc/sub-5.png",
	  "<?php echo G5_THEME_URL?>/img/etc/sub-6.png"
	], {
		fade: 750,
		duration: 4000
	});
});
</script>