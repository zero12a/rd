<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");

	//로그인 검사
    require_once("../c.g/include/incUtil.php");
    require_once("../c.g/include/incUser.php");
    require_once("../c.g/incConfig.php");

    require_once("../c.g/include/incLoginCheck.php");//로그인 검사

	
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>R.D</title>

	<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!--jquery / json-->
	<script src="/c.g/lib/jquery-1.11.1.min.js"></script>
	<script src="/c.g/lib/json2.min.js"></script>

	<!--dhmltx-->
    <script src="/c.g/lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>

    <!--공통-->
    <script src="/c.g/rst/common.js" type="text/javascript" charset="utf-8"></script>


    <link rel="stylesheet" href="/c.g/lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="utf-8">
    <style>

		html,body {margin:0;padding:0;height: 100%}

		div#layoutObj {
			position: relative;
			background-color:yellowgreen;
			margin-top: 0px;
			margin-left: 0px;
			width: 100%;
			height: 100%;
		}
    </style>



    <script>
    var myTabbar;
	var myLayout;
	var myTree;
	var tnum = 0;

    function initBody(){
		alog("initBody-----------------------------------start");

		//레이아웃
		myLayout = new dhtmlXLayoutObject({
			parent: "layoutObj",
			pattern: "3T",
			skin: "dhx_skyblue"     // optional, layout's skin
		});
		myLayout._minHeight = 25;

		//myLayout.cells("a").hideHeader();
		myLayout.cells("a").setHeight(25);
		myLayout.cells("a").hideHeader();
		myLayout.cells("a").fixSize(false, true);//가로, 세로
		myLayout.cells("a").attachURL("bo_main_top.php", true);

		myLayout.cells("b").setWidth(200);
		myLayout.cells("b").setText("Menu");
		myLayout.cells("b").attachURL("bo_menu.php", true);		
		myLayout.cells("c").hideHeader();

		//빈탭바 붙이기
		alog(111);
		myTabbar = myLayout.cells("c").attachTabbar();
		alog(122);

        myTabbar.setSkin('dhx_skyblue');
        myTabbar.enableAutoReSize(true);
		myTabbar.enableTabCloseButton(true);


		//메인페이지 호출
		myTabbar.addTab("INTRO", "인트로", null, null, true );
        myTabbar.tabs("INTRO").attachURL("../c.g/rst/<?=getIntroUrl()?>");		
		
		alog("initBody-----------------------------------end");
    }

	
	$(window).resize(function() {  
		alog("window resize -------------------start");
		myLayout.setSizes();
		alog("window resize -------------------end");
	}
	); 


    function tonclick(id){
        alog(myTree.getItemText(id));

        mnu_nm = myTree.getItemText(id);
        mnu_seq = id.split(":")[0];
        url = id.split(":")[1];
         
        if(myTabbar.tabs(mnu_seq)){
            //myTabbar.tabs(id).set_actions(true);
            myTabbar.tabs(mnu_seq).setActive();
        }else if(id.split(":").length > 1){
            myTabbar.addTab(mnu_seq, mnu_nm, null, null, true );
            //myTabbar.tabs(id).attachURL("cg_pjtinfo.php");
            myTabbar.tabs(mnu_seq).attachURL(url);
        }

        
    };
    </script>

</head>

<body onload="initBody();">
<div id="layoutObj" >aa</div>
</body>
</html>