﻿<?php
$para = $_GET;
if( !isset($para['n']) ){
	$para['n'] = 100;
	//exit;
}
$wr_id = $para['n'];

include_once $_SERVER['DOCUMENT_ROOT']."/customPage/libDB.php";
$datas = select("g5_write_300","*","wr_id='".sqlFilter($wr_id)."' ");

$view = array();
if( isset($datas[0]) ){
	$view = $datas[0];
}

$view['wr_12_show'] = "";
if($view['wr_12']=='일반등기'){
	$view['wr_12_show'] = "신청자가 직접 확인,검증한후 등기";
}
else if($view['wr_12']=='일반등기'){
	$view['wr_12_show'] = "관련 서류를 제출받아 KNCA에서 확인후 등기";
}
else if($view['wr_12']=='검증등기'){
	$view['wr_12_show'] = "KNCA에서 직접 실사,방문을 통해 검증한후 등기";
}

$block_info = array();

$owner_info = select("g5_write_300_owner", "*", "owner_num=".$view['wr_id']." and option_type='owner' and state=1 limit 1");
if( isset($owner_info[0]) ){
	$data = $owner_info[0];
	$view['wr_20'] = $data['show_name'];
	$view['wr_21'] = $data['dateOf'];
	$view['wr_22'] = $data['email'];
	$view['wr_23'] = $data['phone'];
	$view['wr_24'] = $data['home_address'];
	$view['wr_25'] = $data['wallet_address'];
	$view['wr_10'] = $data['sign_img'];

	$block_info[0]['num'] = 1;
	$block_info[0]['show'] = '등기생성';
	$block_info[0]['date'] = date("Y-m-d H:i", strtotime($data['regtime']));
	$block_info[0]['hash'] = $data['owhash'];
}

$copyr_info = select("g5_write_300_owner", "*", "owner_num=".$view['wr_id']." and option_type='copyright' and state=1 limit 1");
if( isset($copyr_info[0]) ){
	$data = $copyr_info[0];
	$view['wr_31'] = $data['show_name'];
	$view['wr_32'] = $data['dateOf'];
	$view['wr_33'] = $data['email'];
	$view['wr_34'] = $data['phone'];
	$view['wr_35'] = $data['home_address'];
	$view['wr_36'] = $data['wallet_address'];

	$block_info[1]['num'] = 2;
	$block_info[1]['show'] = '소유권변경';
	$block_info[1]['date'] = date("Y-m-d H:i", strtotime($data['regtime']));
	$block_info[1]['hash'] = $data['owhash'];
}

$new1_info = select("g5_write_300_owner", "*", "owner_num=".$view['wr_id']." and option_type='newItem1' and state=1 limit 1");
if( isset($new1_info[0]) ){
	$data = $new1_info[0];
	$view['wr_51'] = $data['wr_51'];
	$view['wr_52'] = $data['wr_52'];
	$view['wr_53'] = $data['wr_53'];
	$view['wr_54'] = $data['wr_54'];
	$view['wr_55'] = $data['wr_55'];
	$view['wr_56'] = $data['wr_56'];
	$view['wr_57'] = $data['wr_57'];
	$view['wr_58'] = $data['wr_58'];
	$view['wr_59'] = $data['wr_59'];
	$view['wr_60'] = $data['wr_60'];
	$view['wr_61'] = $data['wr_61'];
	$view['wr_62'] = $data['wr_62'];

    $view['wr_75'] = $data['wr_75'];
    $view['wr_76'] = $data['wr_76'];

	$block_info[2]['num'] = 3;
	$block_info[2]['show'] = '근저당설정';
	$block_info[2]['date'] = date("Y-m-d H:i", strtotime($data['regtime']));
	$block_info[2]['hash'] = $data['owhash'];
}

$owners = select("g5_write_300_owner", "*", "state IN (1,2) and option_type='owner' and owner_num=".$view['wr_id']." order by regtime desc limit 100");
$copyr = select("g5_write_300_owner", "*", "state IN (1,2) and option_type='copyright' and owner_num=".$view['wr_id']." order by regtime desc limit 100");
$new1 = select("g5_write_300_owner", "*", "state IN (1,2) and option_type='newItem1' and owner_num=".$view['wr_id']." order by regtime desc limit 100");

//print_r($view);
?>
<!DOCTYPE html>
<html>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<head>
    <title>KNCA 블록체인 등기부등본</title>
    <meta http_quiv="content-type" content="text/html; charset=utf-8">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Noto+Serif+KR:wght@200,300,400,500,600,700,900&display=swap&subset=korean"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="knca_style.css">
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="jquery-barcode.js"></script>
</head>

<body>



    <div class="hpa" style="width:210mm;height:296.99mm;">
        <div class="hsR"
            style="top:-0.12mm;left:-0.12mm;width:210.70mm;height:296.99mm;background-repeat:no-repeat;background-image:url('knca_hd1.png');">
        </div>

        <!-- 발급확인번호,발급일 -->
        <div class="hcD" style="left:20mm;top:266.99mm;">
            <div class="hcI" style="top:7.57mm;">
                <div class="hls ps30"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:-0.16mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs14">발급확인번호: ARTER-1234
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;발급일:
                        2022년 2월 25일 11:23:32&nbsp;</span><span
                        class="hrt cs22">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                        class="hrt cs25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <div class="haN" style="left:0mm;top:0mm;width:1.59mm;height:3.17mm;"><span
                            class="hrt cs25">1</span></div><span class="hrt cs25">/4</span>
                </div>
                <div class="hls ps9"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:4.61mm;height:3.17mm;width:0mm;"></div>
                <div class="hls ps9"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:14.09mm;height:3.17mm;width:170mm;"></div>
            </div>
        </div>

        <!-- 하단바코드 -->
        <div class="htb" style="left:20mm;width:170mm;top:279.34mm;height:9.48mm;">

            <svg class="hs" viewBox="-2.50 -2.50 175 14.48"
                style="left:-2.50mm;top:-2.50mm;width:175mm;height:14.48mm;">
                <path d="M147.64,0 L147.64,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M170,0 L170,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,0 L170.01,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,9.48 L170.01,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M170,0 L170,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,0 L147.64,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,9.48 L170.01,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M147.64,0 L170.01,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>

            <div class="hce" style="left:0mm;top:0mm;width:147.64mm;height:9.48mm;">
                <div class="hcD" style="left:0mm;top:0mm;">
                    <div class="hcI">
                        <div class="hls ps0"
                            style="line-height:9.09mm;white-space:nowrap;left:0mm;top:0mm;height:9.48mm;width:147.63mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:147.94mm;height:9.48mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hd2.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hce" style="left:147.64mm;top:0mm;width:22.37mm;height:9.48mm;">
                <div class="hcD" style="left:0mm;top:0mm;">
                    <div class="hcI" style="top:0.79mm;">
                        <div class="hls ps20"
                            style="line-height:7.22mm;white-space:nowrap;left:0mm;top:0mm;height:7.90mm;width:22.37mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:18.55mm;height:7.90mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hd3.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <div class="hcD" style="left:20mm;top:20mm;">
            <div class="hcI">
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:-0.32mm;height:6.35mm;width:170mm;"><span
                        class="hrt cs33">블록체인 등기부 등본 (말소사항포함)</span><span class="hrt cs34">&nbsp;</span></div>

                <div class="hls ps20"
                    style="line-height:5.16mm;white-space:nowrap;left:0mm;top:9.86mm;height:6mm;width:170mm;"></div>

                <!-- 등기고유번호,바코드 -->
                <div class="hls ps25"
                    style="line-height:7.22mm;white-space:nowrap;left:0mm;top:19.76mm;height:7.90mm;width:170mm;">
                    <div class="htb"
                        style="left:0.50mm;width:169.96mm;top:0.50mm;height:7.90mm;display:inline-block;position:relative;vertical-align:middle;">
                        <div class="hce" style="left:0mm;top:0mm;width:28.01mm;height:6.91mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1.02mm;">
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:24.41mm;">
                                        <span class="hrt cs12">등기고유번호</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:28.01mm;top:0mm;width:45.98mm;height:6.91mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1.02mm;">
                                    <div class="hls ps24"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:42.38mm;">
                                        <span class="hrt cs35"><?=$view['wr_11']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:74mm;top:0mm;width:37mm;height:6.91mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1.19mm;">
                                    <div class="hls ps0"
                                        style="line-height:2.79mm;white-space:nowrap;left:0mm;top:-0.18mm;height:3.53mm;width:33.40mm;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:111mm;top:0mm;width:57.96mm;height:6.91mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI">
                                    <div class="hls ps23"
                                        style="line-height:5.07mm;left:0mm;top:0mm;height:5.91mm;width:54.36mm; text-align:right;">
                                    <!-- 바코드 -->
                                        <div>
                                            <div id="bcTarget" style="margin-top:0px;"></div>
                                            <script type="text/javascript">
                                                $("#bcTarget").barcode("<?=$view['wr_11']?>", "code128");
                                            </script>
                                        </div>
                                    <!-- 끝 바코드-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hls ps25"
                    style="line-height:150.76mm;white-space:nowrap;left:0mm;top:27.05mm;height:150.76mm;width:170mm;">
                    <div class="htb"
                        style="left:1mm;width:170.96mm;top:1mm;height:150.76mm;display:inline-block;position:relative;vertical-align:middle;">
                        <svg class="hs" viewBox="-2.50 -2.50 175.96 155.76"
                            style="left:-2.50mm;top:-2.50mm;width:175.96mm;height:155.76mm;">
                            <defs>
                                <pattern id="w_00" width="10" height="10" patternUnits="userSpaceOnUse">
                                    <rect width="10" height="10" fill="rgb(217,217,217)" />
                                </pattern>
                            </defs>
                            <path fill="url(#w_00)" d="M0,0L168.96,0L168.96,9.33L0,9.33L0,0Z "></path>
                            <path d="M0,0 L0,148.77" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                            </path>
                            <path d="M27.02,9.33 L27.02,148.77"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M62.02,17.20 L62.02,79.05"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M89.03,17.20 L89.03,44.69"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M114.96,79.05 L114.96,115.51"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M168.96,0 L168.96,148.77"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                            </path>
                            <path d="M0,9.33 L168.97,9.33"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                            <path d="M0,17.20 L168.97,17.20"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,24.07 L168.97,24.07"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,30.95 L168.97,30.95"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M62.02,37.82 L168.97,37.82"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,44.69 L168.97,44.69"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M27.02,51.56 L168.97,51.56"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M27.02,58.43 L168.97,58.43"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M27.02,65.31 L168.97,65.31"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M27.02,72.18 L168.97,72.18"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,79.05 L168.97,79.05"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,115.51 L168.97,115.51"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,127.81 L168.97,127.81"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,141.89 L168.97,141.89"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,148.76 L168.97,148.76"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M168.96,0 L168.96,148.77"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,0 L0,148.77" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                            </path>
                            <path d="M0,148.76 L168.97,148.76"
                                style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                            <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                            </path>
                        </svg>

                        <!-- 표제부  -->
                        <div class="hce" style="left:0mm;top:0mm;width:168.96mm;height:9.33mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:2.05mm;">
                                    <div class="hls ps20"
                                        style="line-height:3.43mm;white-space:nowrap;left:0mm;top:-0.21mm;height:4.23mm;width:165.35mm;">
                                        <span class="hrt cs13">등기물건의 표시 [표제부]</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:9.33mm;width:27.02mm;height:7.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1.50mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">물건의 명칭</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:9.33mm;width:141.95mm;height:7.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1.32mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.43mm;white-space:nowrap;left:0mm;top:-0.21mm;height:4.23mm;width:138.35mm;">
                                        <span class="hrt cs28"><?=$view['wr_subject']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:17.20mm;width:27.02mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">등기의 종류</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:17.20mm;width:35mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:31.40mm;">
                                        <span class="hrt cs11"><?=$view['wr_12']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:17.20mm;width:27.02mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps20"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">검증수준</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:89.03mm;top:17.20mm;width:79.93mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:76.33mm;">
                                        <span class="hrt cs11"><?=$view['wr_12_show']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:24.07mm;width:27.02mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">물건의 유형</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:24.07mm;width:35mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:31.40mm;">
                                        <span class="hrt cs11"><?=$view['wr_13']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:24.07mm;width:27.02mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps20"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">카테고리</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:89.03mm;top:24.07mm;width:79.93mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:76.33mm;">
                                        <span class="hrt cs11"><?=$view['wr_14']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:30.95mm;width:27.02mm;height:13.74mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:4.43mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">등록범위</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:30.95mm;width:35mm;height:13.74mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:4.43mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:31.40mm;">
                                        <span class="hrt cs11"><?php echo $view['wr_46']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:30.95mm;width:27.02mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps20"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">에디션번호</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:89.03mm;top:30.95mm;width:79.93mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:76.33mm;">
                                        <span class="hrt cs11"><?='#'. number_format($view['wr_49'])?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:37.82mm;width:27.02mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps20"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">전체발행수</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:89.03mm;top:37.82mm;width:79.93mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:76.33mm;">
                                        <span class="hrt cs11"><?=number_format($view['wr_48'])?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:44.69mm;width:27.02mm;height:34.36mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:11.64mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">블록체인&nbsp;</span>
                                    </div>
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">등록정보</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:44.69mm;width:35mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:31.40mm;">
                                        <span class="hrt cs10">프로토콜</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:44.69mm;width:106.94mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:103.34mm;">
                                        <span class="hrt cs11">bep-721(binance Smart Chain)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:51.56mm;width:35mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:31.40mm;">
                                        <span class="hrt cs10">토큰ID</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:51.56mm;width:106.94mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:103.34mm;">
                                        <span class="hrt cs11"><?='#'.$view['wr_40']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:58.43mm;width:35mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:31.40mm;">
                                        <span class="hrt cs10">스마트컨트렉트</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:58.43mm;width:106.94mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:103.34mm;">
                                        <span class="hrt cs11"><?=$view['wr_41']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:65.31mm;width:35mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:31.40mm;">
                                        <span class="hrt cs10">IPFS링크</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:65.31mm;width:106.94mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:103.34mm;">
                                        <span class="hrt cs11"><?=$view['wr_43']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:72.18mm;width:35mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:31.40mm;">
                                        <span class="hrt cs10">블록체인 등록일</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:62.02mm;top:72.18mm;width:106.94mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:103.34mm;">
                                        <span class="hrt cs11"><?=date("Y-m-d", strtotime($view['wr_44']))?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:79.05mm;width:27.02mm;height:36.46mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                    </div>
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">대표이미지</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:79.05mm;width:87.94mm;height:36.46mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI">
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:51.98mm;top:-0.19mm;height:3.88mm;width:32.36mm;">
                                    </div>
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:51.98mm;top:6.01mm;height:3.88mm;width:32.36mm;">
                                    </div>
                                </div>
                            </div>
                            <div class="hsR"
                                style="top:0.91mm;left:1.68mm;width:51.98mm;height:34.93mm;background-repeat:no-repeat;background-image:url('<?=get_file_thumbnail2($wr_id, 0)?>');">
                            </div>
                        </div>
                        <div class="hce" style="left:114.96mm;top:79.05mm;width:54mm;height:36.46mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI">
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:50.40mm;">
                                    </div>
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:50.40mm;">
                                        <span class="hrt cs10">등기자 확인서명</span>
                                    </div>
                                    <div class="hls ps0"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:0mm;">
                                    </div>
                                </div>
                            </div>
                            <div class="hsR"
                                style="top:12.92mm;left:1.80mm;width:65.59mm;height:19.31mm;background-repeat:no-repeat;background-image:url('<?=$view['wr_10']?>');">
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:115.51mm;width:27.02mm;height:12.30mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:3.71mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">등기물건 개요</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:115.51mm;width:141.95mm;height:12.30mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps32"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:138.35mm;">
                                        <span class="hrt cs11"><?=$view['wr_content']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:127.81mm;width:27.02mm;height:14.08mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:4.60mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">특성 및 사양</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:127.81mm;width:141.95mm;height:14.08mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1.88mm;">
                                    <div class="hls ps32"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:138.35mm;">
                                        <span class="hrt cs11"><?=$view['wr_15']?></span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:0mm;top:141.89mm;width:27.02mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.41mm;">
                                        <span class="hrt cs10">물건 보관방식</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hce" style="left:27.02mm;top:141.89mm;width:141.95mm;height:6.87mm;">
                            <div class="hcD" style="left:1.80mm;top:0.50mm;">
                                <div class="hcI" style="top:1mm;">
                                    <div class="hls ps22"
                                        style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:138.35mm;">
                                        <span class="hrt cs11"><?=$view['wr_16']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hls ps20"
                    style="line-height:3.10mm;white-space:nowrap;left:0mm;top:177.01mm;height:3.88mm;width:170mm;">
                </div>
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:183.09mm;height:6.35mm;width:0mm;"></div>
            </div>
        </div>
        <div class="htb" style="left:20.50mm;width:169.96mm;top:203.91mm;height:59.33mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 64.33" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:64.33mm;">
                <path fill="url(#w_00)" d="M0,0L168.96,0L168.96,9.33L0,9.33L0,0Z "></path>
                <path d="M0,0 L0,58.34" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M12.04,9.33 L12.04,58.34" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M38.69,9.33 L38.69,58.34" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M60.35,9.33 L60.35,58.34" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M148.30,9.33 L148.30,58.34" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M168.96,0 L168.96,58.34" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,9.33 L168.97,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                <path d="M0,17.20 L168.97,17.20" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,58.33 L168.97,58.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M168.96,0 L168.96,58.34" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,58.34" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,58.33 L168.97,58.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:168.96mm;height:9.33mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.05mm;">
                        <div class="hls ps20"
                            style="line-height:3.43mm;white-space:nowrap;left:0mm;top:-0.21mm;height:4.23mm;width:165.35mm;">
                            <span class="hrt cs13">소유권에 관한 표시&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:0mm;top:9.33mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs12">순위</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:9.33mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs12">소유권자</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:9.33mm;width:21.66mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs12">등기일</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:9.33mm;width:87.94mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">소유권자 내역</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:148.30mm;top:9.33mm;width:20.67mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:17.06mm;">
                            <span class="hrt cs12">상태</span>
                        </div>
                    </div>
                </div>
            </div>

      
			<?php if( isset($owners[0]) ): ?>
			<?php $data = $owners[0]; ?>

          <div>
            <div class="hce" style="left:0mm;top:17.20mm;width:12.04mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs11">1</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:17.20mm;width:26.65mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs11"><?=$data['show_name']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:17.20mm;width:21.66mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:15.60mm;">
                        <div class="hls ps27"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs11"><?=date("Y-m-d", strtotime($data['regtime']))?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:17.20mm;width:87.94mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.60mm;">
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*개인코드 :&nbsp;</span><span
                                class="hrt cs11"><?=$data['wallet_address']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*주 소</span><span class="hrt cs10">&nbsp;</span><span
                                class="hrt cs12">:&nbsp;</span><span class="hrt cs11"><?=$data['home_address']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*연락처 :&nbsp;</span><span class="hrt cs11"><?=$data['phone']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*이메일 :&nbsp;</span><span class="hrt cs11"><?=$data['email']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:24.64mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*생년월일</span><span class="hrt cs10">&nbsp;:&nbsp;</span><span
                                class="hrt cs11"><?=$data['dateOf']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:30.85mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*Hash</span><span class="hrt cs10">&nbsp;</span><span
                                class="hrt cs12">:&nbsp;</span><span class="hrt cs11"><?=$data['owhash']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:148.30mm;top:17.20mm;width:20.67mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:17.06mm;">
                            <span class="hrt cs11">현재사항</span>
                        </div>
                    </div>
                </div>
            </div>
          </div>
			<?php endif; ?>




        </div>
    </div>


    <div class="hpa" style="width:210mm;height:296.99mm;">
        <div class="hsR"
            style="top:-0.12mm;left:-0.12mm;width:210.70mm;height:296.99mm;background-repeat:no-repeat;background-image:url('knca_hd7.png');">
        </div>
        <div class="hcD" style="left:20mm;top:266.99mm;">
            <div class="hcI" style="top:7.57mm;">
                <div class="hls ps30"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:-0.16mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs14">발급확인번호: ARTER-1234
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;발급일:
                        2022년 2월 25일 11:23:32&nbsp;</span><span
                        class="hrt cs22">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                        class="hrt cs25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <div class="haN" style="left:0mm;top:0mm;width:1.59mm;height:3.17mm;"><span
                            class="hrt cs25">2</span></div><span class="hrt cs25">/4</span>
                </div>
                <div class="hls ps9"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:4.61mm;height:3.17mm;width:0mm;"></div>
                <div class="hls ps9"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:14.09mm;height:3.17mm;width:170mm;"></div>
            </div>
        </div>
        <div class="htb" style="left:20mm;width:170mm;top:279.34mm;height:9.48mm;"><svg class="hs"
                viewBox="-2.50 -2.50 175 14.48" style="left:-2.50mm;top:-2.50mm;width:175mm;height:14.48mm;">
                <path d="M147.64,0 L147.64,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M170,0 L170,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,0 L170.01,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,9.48 L170.01,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M170,0 L170,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,0 L147.64,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,9.48 L170.01,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M147.64,0 L170.01,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:147.64mm;height:9.48mm;">
                <div class="hcD" style="left:0mm;top:0mm;">
                    <div class="hcI">
                        <div class="hls ps0"
                            style="line-height:9.09mm;white-space:nowrap;left:0mm;top:0mm;height:9.48mm;width:147.63mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:147.94mm;height:9.48mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hd8.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:147.64mm;top:0mm;width:22.37mm;height:9.48mm;">
                <div class="hcD" style="left:0mm;top:0mm;">
                    <div class="hcI" style="top:0.79mm;">
                        <div class="hls ps20"
                            style="line-height:7.22mm;white-space:nowrap;left:0mm;top:0mm;height:7.90mm;width:22.37mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:18.55mm;height:7.90mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hd9.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hcD" style="left:20mm;top:20mm;">
            <div class="hcI">
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:41.81mm;height:6.35mm;width:170mm;"></div>
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:152.17mm;height:6.35mm;width:170mm;">
                </div>
            </div>
        </div>
        <div class="htb" style="left:20.50mm;width:169.96mm;top:20.49mm;height:42.13mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 47.12" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:47.12mm;">
                <path d="M0,0 L0,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M12.04,0 L12.04,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M38.69,0 L38.69,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M60.35,0 L60.35,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M148.30,0 L148.30,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M168.96,0 L168.96,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,41.13 L168.97,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M168.96,0 L168.96,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,41.13 L168.97,41.13" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
            </svg>


         <!-- 소유권 변경내역-->
			<?php if( isset($owners[1]) ): ?>
			<?php $data = $owners[1]; ?>
           
            <div class="hce" style="left:0mm;top:0mm;width:12.04mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt_cancel cs11">2</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:0mm;width:26.65mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt_cancel cs11"><?=$data['show_name']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:0mm;width:21.66mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:15.60mm;">
                        <div class="hls ps27"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt_cancel cs11"><?=date("Y-m-d", strtotime($data['regtime']))?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:0mm;width:87.94mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.60mm;">
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*개인코드 :&nbsp;</span><span
                                class="hrt_cancel cs11"><?=$data['wallet_address']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*주 소 :</span><span class="hrt_cancel cs11"><?=$data['home_address']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*연락처 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['phone']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*이메일 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['email']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:24.64mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*생년월일 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['dateOf']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:30.85mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*Hash :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['owhash']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:148.30mm;top:0mm;width:20.67mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:17.06mm;">
                            <span class="hrt_cancel cs11">변경</span>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>




        </div>
        <div class="htb" style="left:20.54mm;width:169.96mm;top:72.53mm;height:100.46mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 105.46" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:105.46mm;">
                <defs>
                    <pattern id="w_10" width="10" height="10" patternUnits="userSpaceOnUse">
                        <rect width="10" height="10" fill="rgb(217,217,217)" />
                    </pattern>
                </defs>
                <path fill="url(#w_10)" d="M0,0L168.96,0L168.96,9.33L0,9.33L0,0Z "></path>
                <path d="M0,0 L0,99.47" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M12.04,9.33 L12.04,99.47" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M38.69,9.33 L38.69,99.47" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M60.35,9.33 L60.35,99.47" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M148.30,9.33 L148.30,99.47" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M168.96,0 L168.96,99.47" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,9.33 L168.97,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                <path d="M0,17.20 L168.97,17.20" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,58.33 L168.97,58.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,99.46 L168.97,99.46" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M168.96,0 L168.96,99.47" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,99.47" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,99.46 L168.97,99.46" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:168.96mm;height:9.33mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.05mm;">
                        <div class="hls ps20"
                            style="line-height:3.43mm;white-space:nowrap;left:0mm;top:-0.21mm;height:4.23mm;width:165.35mm;">
                            <span class="hrt cs13">저작권에 관한 표시&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:0mm;top:9.33mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs12">순위</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:9.33mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs12">저작권자</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:9.33mm;width:21.66mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs12">등기일</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:9.33mm;width:87.94mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">저작권자 내역</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:148.30mm;top:9.33mm;width:20.67mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:17.06mm;">
                            <span class="hrt cs12">상태</span>
                        </div>
                    </div>
                </div>
            </div>



			<?php if( isset($copyr[0]) ): ?>
			<?php $data = $copyr[0]; ?>
            <div class="hce" style="left:0mm;top:17.20mm;width:12.04mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs11">1</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:17.20mm;width:26.65mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs11"><?=$data['show_name']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:17.20mm;width:21.66mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:15.80mm;">
                        <div class="hls ps28"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs11"><?=date("Y-m-d", strtotime($data['regtime']))?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:17.20mm;width:87.94mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.60mm;">
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*개인코드 :&nbsp;</span><span
                                class="hrt cs11"><?=$data['wallet_address']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*주 소</span><span class="hrt cs10">&nbsp;</span><span
                                class="hrt cs12">:&nbsp;</span><span class="hrt cs11"><?=$data['home_address']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*연락처 :&nbsp;</span><span class="hrt cs11"><?=$data['phone']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*이메일 :&nbsp;</span><span class="hrt cs11"><?=$data['email']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:24.64mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*생년월일</span><span class="hrt cs10">&nbsp;:&nbsp;</span><span
                                class="hrt cs11"><?=$data['dateOf']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:30.85mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt cs12">*Hash</span><span class="hrt cs10">&nbsp;</span><span
                                class="hrt cs12">:&nbsp;</span><span class="hrt cs11"><?=$data['owhash']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:148.30mm;top:17.20mm;width:20.67mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:17.06mm;">
                            <span class="hrt cs11">현재사항</span>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>



			<?php if( isset($copyr[1]) ): ?>
			<?php $data = $copyr[1]; ?>
            <div class="hce" style="left:0mm;top:58.33mm;width:12.04mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt_cancel cs11">2</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:58.33mm;width:26.65mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt_cancel cs11"><?=$data['show_name']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:58.33mm;width:21.66mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:15.80mm;">
                        <div class="hls ps28"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt_cancel cs11"><?=date("Y-m-d", strtotime($data['regtime']))?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:58.33mm;width:87.94mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.60mm;">
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*개인코드 :&nbsp;</span><span
                                class="hrt_cancel cs11"><?=$data['wallet_address']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*주 소 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['home_address']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*연락처 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['phone']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*이메일 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['email']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:24.64mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*생년월일 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['dateOf']?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:30.85mm;height:3.88mm;width:84.34mm;">
                            <span class="hrt_cancel cs12">*Hash :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['owhash']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:148.30mm;top:58.33mm;width:20.67mm;height:41.13mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:18.13mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:17.06mm;">
                            <span class="hrt_cancel cs11">변경</span>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>




        </div>
        <div class="htb" style="left:20.54mm;width:169.96mm;top:182.89mm;height:84.24mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 89.24" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:89.24mm;">
                <path fill="url(#w_10)" d="M0,0L168.96,0L168.96,9.33L0,9.33L0,0Z "></path>
                <path d="M0,0 L0,83.25" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M12.04,9.33 L12.04,83.25" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M38.69,9.33 L38.69,83.25" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M60.35,9.33 L60.35,83.25" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M168.96,0 L168.96,83.25" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,9.33 L168.97,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                <path d="M0,17.20 L168.97,17.20" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,83.24 L168.97,83.24" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M168.96,0 L168.96,83.25" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,83.25" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,83.24 L168.97,83.24" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:168.96mm;height:9.33mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.05mm;">
                        <div class="hls ps20"
                            style="line-height:3.43mm;white-space:nowrap;left:0mm;top:-0.21mm;height:4.23mm;width:165.35mm;">
                            <span class="hrt cs13">권리제한(근저당,압류등설정)에 관한 표시&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:0mm;top:9.33mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs12">순위</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:9.33mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs12">등기원인</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:9.33mm;width:21.66mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs12">설정일</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:9.33mm;width:108.61mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">권리자 및 기타사항</span>
                        </div>
                    </div>
                </div>
            </div>



			<?php if( isset($new1[0]) ): ?>
			<?php $data = $new1[0]; ?>
            <div class="hce" style="left:0mm;top:17.20mm;width:12.04mm;height:66.04mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:30.58mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs11">1</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:17.20mm;width:26.65mm;height:66.04mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:30.58mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs11"><?=$data['wr_51']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:17.20mm;width:21.66mm;height:66.04mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:28.25mm;">
                        <div class="hls ps28"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs11"><?=date("Y-m-d", strtotime($data['wr_52']))?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:17.20mm;width:108.61mm;height:66.04mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.64mm;">
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">채권최고액 :&nbsp;</span><span class="hrt cs11">금 <?=number_format($data['wr_53'])?>원</span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">설정근거 :&nbsp;</span><span class="hrt cs11"><?=$data['wr_60']?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">채권자명(개인코드) :&nbsp;</span><span class="hrt cs11"><?=$data['wr_54'].' ('.$data['wr_55'].')'?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">채권자정보 :&nbsp;</span><span class="hrt cs11"><?=$data['wr_56']?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:24.64mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">채무자명(개인코드) :&nbsp;</span><span class="hrt cs11"><?=$data['wr_57'].' ('.$data['wr_58'].')'?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:30.85mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">채무자정보 :&nbsp;</span><span class="hrt cs11"><?=$data['wr_59']?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:37.06mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">기타 설정사항 :&nbsp;</span><span class="hrt cs11"><?=$data['wr_61']?>&nbsp;</span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:49.48mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">설정해제(말소)일 :&nbsp;</span><span class="hrt cs11"><?php echo ($data['wr_62']) ? $data['wr_62'] : "<span class='text-red'>설정중</span>" ?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:55.69mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">설정해쉬값 :&nbsp;</span><span
                                class="hrt cs11"><?=$data['owhash']?></span>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>




        </div>
    </div>
    <div class="hpa" style="width:210mm;height:296.99mm;">
        <div class="hsR"
            style="top:-0.12mm;left:-0.12mm;width:210.70mm;height:296.99mm;background-repeat:no-repeat;background-image:url('knca_hda.png');">
        </div>
        <div class="hcD" style="left:20mm;top:266.99mm;">
            <div class="hcI" style="top:7.57mm;">
                <div class="hls ps30"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:-0.16mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs14">발급확인번호: ARTER-1234
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;발급일:
                        2022년 2월 25일 11:23:32&nbsp;</span><span
                        class="hrt cs22">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                        class="hrt cs25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <div class="haN" style="left:0mm;top:0mm;width:1.59mm;height:3.17mm;"><span
                            class="hrt cs25">3</span></div><span class="hrt cs25">/4</span>
                </div>
                <div class="hls ps9"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:4.61mm;height:3.17mm;width:0mm;"></div>
                <div class="hls ps9"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:14.09mm;height:3.17mm;width:170mm;"></div>
            </div>
        </div>
        <div class="htb" style="left:20mm;width:170mm;top:279.34mm;height:9.48mm;"><svg class="hs"
                viewBox="-2.50 -2.50 175 14.48" style="left:-2.50mm;top:-2.50mm;width:175mm;height:14.48mm;">
                <path d="M147.64,0 L147.64,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M170,0 L170,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,0 L170.01,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,9.48 L170.01,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M170,0 L170,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,0 L147.64,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,9.48 L170.01,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M147.64,0 L170.01,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:147.64mm;height:9.48mm;">
                <div class="hcD" style="left:0mm;top:0mm;">
                    <div class="hcI">
                        <div class="hls ps0"
                            style="line-height:9.09mm;white-space:nowrap;left:0mm;top:0mm;height:9.48mm;width:147.63mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:147.94mm;height:9.48mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hdb.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:147.64mm;top:0mm;width:22.37mm;height:9.48mm;">
                <div class="hcD" style="left:0mm;top:0mm;">
                    <div class="hcI" style="top:0.79mm;">
                        <div class="hls ps20"
                            style="line-height:7.22mm;white-space:nowrap;left:0mm;top:0mm;height:7.90mm;width:22.37mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:18.55mm;height:7.90mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hdc.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hcD" style="left:20mm;top:20mm;">
            <div class="hcI">
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:67.84mm;height:6.35mm;width:170mm;"></div>
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:78mm;height:6.35mm;width:0mm;"></div>
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:129.55mm;height:6.35mm;width:170mm;">
                </div>
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:139.71mm;height:6.35mm;width:0mm;"></div>
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:225.63mm;height:6.35mm;width:170mm;">
                </div>
                <div class="hls ps20"
                    style="line-height:5.52mm;white-space:nowrap;left:0mm;top:235.79mm;height:6.35mm;width:0mm;"></div>
            </div>
        </div>
        <div class="htb" style="left:20.54mm;width:169.96mm;top:20.49mm;height:68.15mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 73.15" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:73.15mm;">
                <path d="M0,0 L0,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M12.04,0 L12.04,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M38.69,0 L38.69,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M60.35,0 L60.35,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M168.96,0 L168.96,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,67.16 L168.97,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M168.96,0 L168.96,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,67.16 L168.97,67.16" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
            </svg>



			<?php if( isset($new1[1]) ): ?>
			<?php $data = $new1[1]; ?>
            <div class="hce" style="left:0mm;top:0mm;width:12.04mm;height:67.16mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:31.14mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt_cancel cs11">2</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:0mm;width:26.65mm;height:67.16mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:31.14mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt_cancel cs11"><?=$data['wr_51']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:0mm;width:21.66mm;height:67.16mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:28.81mm;">
                        <div class="hls ps28"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt_cancel cs11"><?=date("Y-m-d", strtotime($data['wr_52']))?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:0mm;width:108.61mm;height:67.16mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:3.20mm;">
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">채권최고액 :&nbsp;</span><span class="hrt_cancel cs11">금 <?=number_format($data['wr_53'])?>원</span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">설정근거 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['wr_60']?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">채권자명(개인코드) :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['wr_54'].' ('.$data['wr_55'].')'?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">채권자정보 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['wr_56']?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:24.64mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">채무자명(개인코드) :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['wr_57'].' ('.$data['wr_58'].')'?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:30.85mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">채무자정보 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['wr_59']?></span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:37.06mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">기타 설정사항 :&nbsp;</span><span class="hrt_cancel cs11"><?=$data['wr_61']?>&nbsp;</span>
                        </div>
                        <div class="hls ps31"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:49.48mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">설정해제(말소)일 :&nbsp;</span><span class="hrt_cancel cs11"><?php echo ($data['wr_62']) ? $data['wr_62'] : "<span class='text-red'>설정중</span>" ?></span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:55.69mm;height:3.88mm;width:105mm;">
                            <span class="hrt_cancel cs12">설정해쉬값 :&nbsp;</span><span
                                class="hrt_cancel cs11"><?=$data['owhash']?></span>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>




        </div>
        <div class="htb" style="left:20.50mm;width:169.96mm;top:98.81mm;height:51.56mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 56.56" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:56.56mm;">
                <defs>
                    <pattern id="w_20" width="10" height="10" patternUnits="userSpaceOnUse">
                        <rect width="10" height="10" fill="rgb(217,217,217)" />
                    </pattern>
                </defs>
                <path fill="url(#w_20)" d="M0,0L168.96,0L168.96,9.33L0,9.33L0,0Z "></path>
                <path d="M0,0 L0,50.57" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M12.04,9.33 L12.04,50.57" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M38.69,9.33 L38.69,50.57" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M60.35,9.33 L60.35,50.57" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M168.96,0 L168.96,50.57" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,9.33 L168.97,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                <path d="M0,17.20 L168.97,17.20" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,50.56 L168.97,50.56" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M168.96,0 L168.96,50.57" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,50.57" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,50.56 L168.97,50.56" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:168.96mm;height:9.33mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.05mm;">
                        <div class="hls ps20"
                            style="line-height:3.43mm;white-space:nowrap;left:0mm;top:-0.21mm;height:4.23mm;width:165.35mm;">
                            <span class="hrt cs13">서류검증에 관한 표시&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:0mm;top:9.33mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs12">순위</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:9.33mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs12">등기원인</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:9.33mm;width:21.66mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs12">검증등록</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:9.33mm;width:108.61mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">서류검증에 관한 내역</span>
                        </div>
                    </div>
                </div>
            </div>




            <div class="hce" style="left:0mm;top:17.20mm;width:12.04mm;height:33.36mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:14.24mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs11">1</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:17.20mm;width:26.65mm;height:33.36mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:14.24mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs11">서류검증</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:17.20mm;width:21.66mm;height:33.36mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:11.72mm;">
                        <div class="hls ps27"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs11"><?=$view['wr_75']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:17.20mm;width:108.61mm;height:33.36mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.82mm;">
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">신청자KYC확인</span><span class="hrt cs10">&nbsp;:&nbsp;</span><span
                                class="hrt cs11"><?= ($view['wr_71'] == '0') ? '확인함' : '아니요' ?></span>
                        </div>
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">등기물건확인(보증)서</span><span class="hrt cs10">&nbsp;:&nbsp;</span><span
                                class="hrt cs11"><?= ($view['wr_72'] == '0') ? '확인함' : '아니요' ?></span>
                        </div>
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">저작권 확인서</span><span class="hrt cs10">&nbsp;:&nbsp;</span><span
                                class="hrt cs11"><?= ($view['wr_73'] == '0') ? '확인함' : '아니요' ?></span>
                        </div>
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">검증관련첨부자료</span><span class="hrt cs10">&nbsp;:&nbsp;</span><span
                                class="hrt cs11"><?=$view['wr_74']?></span>
                        </div>
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:24.64mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">검증해쉬값</span><span class="hrt cs10">&nbsp;:&nbsp;</span><span
                                class="hrt cs11"><?=$view['wr_76']?></span>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <div class="htb" style="left:20.50mm;width:169.96mm;top:160.52mm;height:85.91mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 90.91" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:90.91mm;">
                <path fill="url(#w_20)" d="M0,0L168.96,0L168.96,9.33L0,9.33L0,0Z "></path>
                <path d="M0,0 L0,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M12.04,9.33 L12.04,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M38.69,9.33 L38.69,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M60.35,9.33 L60.35,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M119.15,49.55 L119.15,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M168.96,0 L168.96,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,9.33 L168.97,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                <path d="M0,17.20 L168.97,17.20" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M60.35,49.55 L168.97,49.55" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;">
                </path>
                <path d="M60.35,56.42 L168.97,56.42" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;">
                </path>
                <path d="M0,84.92 L168.97,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M168.96,0 L168.96,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,84.92 L168.97,84.92" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>




            <div class="hce" style="left:0mm;top:0mm;width:168.96mm;height:9.33mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.05mm;">
                        <div class="hls ps20"
                            style="line-height:3.43mm;white-space:nowrap;left:0mm;top:-0.21mm;height:4.23mm;width:165.35mm;">
                            <span class="hrt cs13">실사검증에 관한 표시&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:0mm;top:9.33mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs12">순위</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:9.33mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs12">등기원인</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:9.33mm;width:21.66mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs12">검증등록</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:9.33mm;width:108.61mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">실사검증에 관한 내역</span>
                        </div>
                    </div>
                </div>
            </div>



			<?php if( trim($view['wr_80']) != '' ):?>
            <div class="hce" style="left:0mm;top:17.20mm;width:12.04mm;height:67.72mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:31.42mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs11">1</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:17.20mm;width:26.65mm;height:67.72mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:31.42mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs11">실사검증</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:17.20mm;width:21.66mm;height:67.72mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:28.89mm;">
                        <div class="hls ps27"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:18.06mm;">
                            <span class="hrt cs11"><?=date("Y-m-d", strtotime($view['wr_87']))?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:17.20mm;width:108.61mm;height:32.35mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.32mm;">
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">검증기관</span><span class="hrt cs11">&nbsp;: <?=$view['wr_88']?></span>
                        </div>
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">검증장소</span><span class="hrt cs11">&nbsp;: <?=$view['wr_81']?></span>
                        </div>
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">검증기간</span><span class="hrt cs11">&nbsp;:<?=$view['wr_87']." ~ ".$view['wr_93']?></span>
                        </div>
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">검증위원</span><span class="hrt cs11">&nbsp;: <?=$view['wr_90']?></span>
                        </div>
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:24.64mm;height:3.88mm;width:105mm;">
                            <span class="hrt cs12">검증해쉬값</span><span class="hrt cs11">&nbsp;:
                                <?=$view['wr_94']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:49.55mm;width:58.80mm;height:6.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:55.19mm;">
                            <span class="hrt cs10">검증결과</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:119.15mm;top:49.55mm;width:49.81mm;height:6.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:46.21mm;">
                            <span class="hrt cs10">검증위원 서명</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:60.35mm;top:56.42mm;width:58.80mm;height:28.49mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">

                  <div class="hcI" style="top:2.49mm;">
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:55.19mm;">
                            <span class="hrt cs12">등기물건 실체 :</span><span class="hrt cs11"> 확인함</span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:6.01mm;height:3.88mm;width:55.19mm;">
                            <span class="hrt cs12">저작권 :</span><span class="hrt cs11"> 확인함</span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:12.22mm;height:3.88mm;width:55.19mm;">
                            <span class="hrt cs12">소유권 :</span><span class="hrt cs11"> 확인함</span>
                        </div>
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:18.43mm;height:3.88mm;width:55.19mm;">
                            <span class="hrt cs12"><strong>상기 기재내용과 동일함을 확인함 </strong></span>
                        </div>
                    </div> 

                </div>
            </div>
            <div class="hce" style="left:119.15mm;top:56.42mm;width:49.81mm;height:28.49mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI">
                        <div class="hls ps22"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:0mm;">
                        </div>
                    </div>
                </div>
                <div class="hsR"
                    style="top:4.02mm;left:3.06mm;width:46.87mm;height:19.31mm;background-repeat:no-repeat;background-image:url('<?=$view['wr_9']?>');">
                </div>
            </div>
			<?php endif; ?>




        </div>
        <div class="htb" style="left:20.50mm;width:169.96mm;top:256.60mm;height:10.33mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 15.32" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:15.32mm;">
                <path fill="url(#w_20)" d="M0,0L168.96,0L168.96,9.33L0,9.33L0,0Z "></path>
                <path d="M0,0 L0,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M168.96,0 L168.96,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,9.33 L168.97,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                <path d="M168.96,0 L168.96,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,9.33 L168.97,9.33" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:168.96mm;height:9.33mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:2.05mm;">
                        <div class="hls ps20"
                            style="line-height:3.43mm;white-space:nowrap;left:0mm;top:-0.21mm;height:4.23mm;width:165.35mm;">
                            <span class="hrt cs13">블록체인 해쉬정보 등록 히스토리</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hpa" style="width:210mm;height:296.99mm;">
        <div class="hsR"
            style="top:-0.12mm;left:-0.12mm;width:210.70mm;height:296.99mm;background-repeat:no-repeat;background-image:url('knca_hde.png');">
        </div>
        <div class="hcD" style="left:20mm;top:266.99mm;">
            <div class="hcI" style="top:7.57mm;">
                <div class="hls ps30"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:-0.16mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs14">발급확인번호: ARTER-1234
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;발급일:
                        2022년 2월 25일 11:23:32&nbsp;</span><span
                        class="hrt cs22">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
                        class="hrt cs25">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <div class="haN" style="left:0mm;top:0mm;width:1.59mm;height:3.17mm;"><span
                            class="hrt cs25">4</span></div><span class="hrt cs25">/4</span>
                </div>
                <div class="hls ps9"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:4.61mm;height:3.17mm;width:0mm;"></div>
                <div class="hls ps9"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:14.09mm;height:3.17mm;width:170mm;"></div>
            </div>
        </div>
        <div class="htb" style="left:20mm;width:170mm;top:279.34mm;height:9.48mm;"><svg class="hs"
                viewBox="-2.50 -2.50 175 14.48" style="left:-2.50mm;top:-2.50mm;width:175mm;height:14.48mm;">
                <path d="M147.64,0 L147.64,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M170,0 L170,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,0 L170.01,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,9.48 L170.01,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M170,0 L170,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,0 L147.64,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M147.64,9.48 L170.01,9.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;">
                </path>
                <path d="M147.64,0 L170.01,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:147.64mm;height:9.48mm;">
                <div class="hcD" style="left:0mm;top:0mm;">
                    <div class="hcI">
                        <div class="hls ps0"
                            style="line-height:9.09mm;white-space:nowrap;left:0mm;top:0mm;height:9.48mm;width:147.63mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:147.94mm;height:9.48mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hdf.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:147.64mm;top:0mm;width:22.37mm;height:9.48mm;">
                <div class="hcD" style="left:0mm;top:0mm;">
                    <div class="hcI" style="top:0.79mm;">
                        <div class="hls ps20"
                            style="line-height:7.22mm;white-space:nowrap;left:0mm;top:0mm;height:7.90mm;width:22.37mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:18.55mm;height:7.90mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hd10.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hcD" style="left:20mm;top:20mm;">
            <div class="hcI">
                <div class="hls ps0"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:32.32mm;height:3.17mm;width:170mm;"></div>
                <div class="hls ps20"
                    style="line-height:5.90mm;white-space:nowrap;left:0mm;top:37.22mm;height:6.70mm;width:170mm;"></div>
                <div class="hls ps0"
                    style="line-height:2.79mm;white-space:nowrap;left:0mm;top:48.10mm;height:3.53mm;width:170mm;"></div>
                <div class="hls ps20"
                    style="line-height:3.43mm;white-space:nowrap;left:0mm;top:53.71mm;height:4.23mm;width:170mm;"><span
                        class="hrt cs27">위 증명서는 KNCA 규정에 따라 등록된 등기기록 내용과 틀림없음을 증명합니다.</span></div>
                <div class="hls ps20"
                    style="line-height:3.43mm;white-space:nowrap;left:0mm;top:60.49mm;height:4.23mm;width:170mm;"><span
                        class="hrt cs27">서기 2022년 02월 25일</span></div>



                <div class="hls ps0"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:189.77mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs22">*실선으로 그어진 부분은 말소(변경)된 등기사항을 표시함.</span></div>
                <div class="hls ps0"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:194.85mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs22">*등기부에 등록된 사항이 없는 항목은 생략함.&nbsp;</span></div>
                <div class="hls ps0"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:199.93mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs22">*등기부는 컬러 또는 흑백으로 출력가능함.</span></div>
                <div class="hls ps0"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:205.01mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs22">*[인터넷발급] 문서하단의 바코드를 스캐너로 확인하거나 발급확인번호를 일벽하여 위변조 여부를 확인할 수 있습</span></div>
                <div class="hls ps0"
                    style="line-height:2.48mm;white-space:nowrap;left:0mm;top:210.09mm;height:3.17mm;width:170mm;"><span
                        class="hrt cs22">니다. 발급확인번호를 통한 확인은 발행일로부터 3개월까지 가능합니다.</span></div>
            </div>
        </div>
        <div class="htb" style="left:20.50mm;width:169.96mm;top:20.49mm;height:32.48mm;"><svg class="hs"
                viewBox="-2.50 -2.50 174.96 37.48" style="left:-2.50mm;top:-2.50mm;width:174.96mm;height:37.48mm;">
                <path d="M0,0 L0,31.49" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M12.04,0 L12.04,31.49" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M38.69,0 L38.69,31.49" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M75.33,0 L75.33,31.49" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M168.96,0 L168.96,31.49" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
                <path d="M0,7.87 L168.97,7.87" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,15.74 L168.97,15.74" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,23.61 L168.97,23.61" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,31.48 L168.97,31.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M168.96,0 L168.96,31.49" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,0 L0,31.49" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.12;"></path>
                <path d="M0,31.48 L168.97,31.48" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.10;"></path>
                <path d="M0,0 L168.97,0" style="stroke:#000000;stroke-linecap:butt;stroke-width:0.50;"></path>
            </svg>
            <div class="hce" style="left:0mm;top:0mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs12">순위</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:0mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs12">등기원인</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:0mm;width:36.64mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:33.03mm;">
                            <span class="hrt cs12">등록일시</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:75.33mm;top:0mm;width:93.63mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:90.03mm;">
                            <span class="hrt cs12">해쉬값</span>
                        </div>
                    </div>
                </div>
            </div>



			<?php if( isset($block_info[0]) ): ?>
			<?php $data = $block_info[0]; ?>
            <div class="hce" style="left:0mm;top:7.87mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs11"><?=$data['num']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:7.87mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs11"><?=$data['show']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:7.87mm;width:36.64mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:33.03mm;">
                            <span class="hrt cs11"><?=$data['date']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:75.33mm;top:7.87mm;width:93.63mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:90.03mm;">
                            <span class="hrt cs11"><?=$data['hash']?></span>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>



			<?php if( isset($block_info[1]) ): ?>
			<?php $data = $block_info[1]; ?>
            <div class="hce" style="left:0mm;top:15.74mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs11"><?=$data['num']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:15.74mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs11"><?=$data['show']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:15.74mm;width:36.64mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:33.03mm;">
                            <span class="hrt cs11"><?=$data['date']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:75.33mm;top:15.74mm;width:93.63mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:90.03mm;">
                            <span class="hrt cs11"><?=$data['hash']?></span>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>



			<?php if( isset($block_info[2]) ): ?>
			<?php $data = $block_info[2]; ?>
            <div class="hce" style="left:0mm;top:23.61mm;width:12.04mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:8.44mm;">
                            <span class="hrt cs11"><?=$data['num']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:12.04mm;top:23.61mm;width:26.65mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:23.04mm;">
                            <span class="hrt cs11"><?=$data['show']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:38.69mm;top:23.61mm;width:36.64mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps20"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:33.03mm;">
                            <span class="hrt cs11"><?=$data['date']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hce" style="left:75.33mm;top:23.61mm;width:93.63mm;height:7.87mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.50mm;">
                        <div class="hls ps0"
                            style="line-height:3.10mm;white-space:nowrap;left:0mm;top:-0.19mm;height:3.88mm;width:90.03mm;">
                            <span class="hrt cs11"><?=$data['hash']?></span>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif; ?>



        </div>
        <div class="hsR" style="top:204.91mm;left:20mm;width:170mm;height:1.06mm;"><svg class="hs"
                viewBox="-0.15 -0.15 170.29 1.35" style="left:-0.15mm;top:-0.15mm;width:170.29mm;height:1.35mm;">
                <defs>
                    <pattern id="w_30" width="10" height="10" patternUnits="userSpaceOnUse">
                        <rect width="10" height="10" fill="rgb(0,0,0)" />
                    </pattern>
                </defs>
                <path fill="url(#w_30)" d="M0,0L170,0L170,1.06L0,1.06L0,0Z "></path>
            </svg></div>
        <div class="htb" style="left:20.50mm;width:169mm;top:94.74mm;height:21.63mm;">
            <div class="hce" style="left:0mm;top:0mm;width:131.92mm;height:20.64mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI" style="top:1.07mm;">
                        <div class="hls ps29"
                            style="line-height:3.76mm;white-space:nowrap;left:0mm;top:-0.23mm;height:4.59mm;width:128.33mm;">
                            <span class="hrt cs8">한국NFT공인인증원 등기정보중앙관리소 전산운영책임관</span>
                        </div>
                        <div class="hls ps23"
                            style="line-height:12.44mm;white-space:nowrap;left:0mm;top:5.05mm;height:12.44mm;width:128.33mm;">
                            <div class="hsR"
                                style="top:0mm;left:0mm;margin-bottom:0mm;margin-right:0mm;width:91.02mm;height:12.44mm;display:inline-block;position:relative;vertical-align:middle;background-repeat:no-repeat;background-image:url('knca_hd11.png');">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      

            <div class="hce" style="left:131.92mm;top:0mm;width:36.08mm;height:20.64mm;">
                <div class="hcD" style="left:1.80mm;top:0.50mm;">
                    <div class="hcI">
                        <div class="hls ps26"
                            style="line-height:3.76mm;white-space:nowrap;left:0mm;top:-0.23mm;height:4.59mm;width:32.48mm;">
                        </div>
                    </div>
                </div>
                <div class="hsR"
                    style="top:0.50mm;left:0.12mm;width:19.59mm;height:19.64mm;background-repeat:no-repeat;background-image:url('knca_hd12.png');">
                </div>
            </div>
        </div>
    </div>



</body>

</html>