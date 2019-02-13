<?php
//PGMID : USERMNG
//PGMNM : 사용자관리
header("Content-Type: text/html; charset=UTF-8"); //HTML

require_once("../include/incUtil.php");
include_once('../include/incRequest.php');//CG REQUEST
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
<title>사용자관리</title>
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<script src="../lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="../lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="../lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="../lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="/lib/chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="/chartjs_util.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="../common/common.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX EXT-->
<script src="/lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<link rel="stylesheet" href="../lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="../lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<script src="usermng.js?<?=getRndVal(10)?>"></script>
<link href="../common/common.css" rel="stylesheet" type="text/css" />
<script>
	//팝업창인 경우 오프너에게서 파라미터 받기
    var grpId = "<?=getFilter(reqPostString("GRPID",20),"SAFEECHO","")?>";
    var rowId = "<?=getFilter(reqPostString("ROWID",30),"SAFEECHO","")?>";
    var colId = "<?=getFilter(reqPostString("COLID",30),"SAFEECHO","")?>";
    var btnNm = "<?=getFilter(reqPostString("BTNNM",30),"SAFEECHO","")?>";
</script>
</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->	<!--D72 : STARTTXT, TAG-->
	<!--G.GRPID : C1-->
	<div class="GRP_OBJECT" style="width:100%;height:60px;border-radius:3px;-moz-border-radius: 3px;">
	  <div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
			<div class="DETAIL_LABELGRP">
			<div class="DETAIL_LABEL"  style="">
				<b>* 사용자관리</b>	
				<!--popup--><a href="?" target="_blank"><img src="/c.g/img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="/c.g/img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="DETAIL_LABELBTN">				<input type="button" name="BTN_C1_SEARCHALL" value="조회(전체)" onclick="C1_SEARCHALL(uuidv4());">
				<input type="button" name="BTN_C1_SAVE" value="저장" onclick="C1_SAVE(uuidv4());">
				<input type="button" name="BTN_C1_RESET" value="입력 초기화" onclick="C1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:18px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
			<!--D101: STARTTXT, TAG-->
			<!--I.COLID : EMAIL-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:px;text-align:left;">
						이메일
					</div>
					<!-- style="width:60px;"-->
					<div class="CON_OBJECT">
	<!--EMAIL오브젝트출력-->						<input type="text" name="C1-EMAIL" value="<?=getFilter(reqPostString("EMAIL",20),"SAFEECHO","")?>" id="C1-EMAIL" style="width:60px;">
					</div>
				</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
	</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:45%;height:500px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				* 사용자1      
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
<input type="button" name="BTN_G2_USERDEF" value="비번변경" onclick="G2_USERDEF(uuidv4());">
<input type="button" name="BTN_G2_SAVE" value="S" onclick="G2_SAVE(uuidv4());">
<input type="button" name="BTN_G2_ROWDELETE" value="-" onclick="G2_ROWDELETE(uuidv4());">
<input type="button" name="BTN_G2_ROWADD" value="+" onclick="G2_ROWADD(uuidv4());">
<input type="button" name="BTN_G2_RELOAD" value="R" onclick="G2_RELOAD(uuidv4());">
<input type="button" name="BTN_G2_HIDDENCOL" value="V" onclick="G2_HIDDENCOL(uuidv4());">
<input type="button" name="BTN_G2_EXCEL" value="E" onclick="G2_EXCEL(uuidv4());">
<input type="button" name="BTN_G2_CHKSAVE" value="선택저장" onclick="G2_CHKSAVE(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG2"  style="background-color:white;overflow:hidden;height:478px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:15%;height:500px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG3_GRID_LABEL"class="GRID_LABEL" >
	  				* 프로젝트2      
			</div>
			<div id="div_gridG3_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG3Cnt" name="그리드 ROW 갯수">N</span>
<input type="button" name="BTN_G3_USERDEF" value="사용자정의" onclick="G3_USERDEF(uuidv4());">
<input type="button" name="BTN_G3_SAVE" value="S" onclick="G3_SAVE(uuidv4());">
<input type="button" name="BTN_G3_ROWDELETE" value="-" onclick="G3_ROWDELETE(uuidv4());">
<input type="button" name="BTN_G3_ROWADD" value="+" onclick="G3_ROWADD(uuidv4());">
<input type="button" name="BTN_G3_RELOAD" value="R" onclick="G3_RELOAD(uuidv4());">
<input type="button" name="BTN_G3_HIDDENCOL" value="V" onclick="G3_HIDDENCOL(uuidv4());">
<input type="button" name="BTN_G3_EXCEL" value="E" onclick="G3_EXCEL(uuidv4());">
<input type="button" name="BTN_G3_CHKSAVE" value="선택저장" onclick="G3_CHKSAVE(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG3"  style="background-color:white;overflow:hidden;height:478px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
	<div class="GRP_OBJECT" style="width:40%;height:500px;">

		<div  class="GRID_LABELGRP">
  			<div id="div_gridG4_GRID_LABEL"class="GRID_LABEL" >
	  				* 서버4      
			</div>
			<div id="div_gridG4_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG4Cnt" name="그리드 ROW 갯수">N</span>
<input type="button" name="BTN_G4_USERDEF" value="사용자정의" onclick="G4_USERDEF(uuidv4());">
<input type="button" name="BTN_G4_SAVE" value="S" onclick="G4_SAVE(uuidv4());">
<input type="button" name="BTN_G4_ROWDELETE" value="-" onclick="G4_ROWDELETE(uuidv4());">
<input type="button" name="BTN_G4_ROWADD" value="+" onclick="G4_ROWADD(uuidv4());">
<input type="button" name="BTN_G4_RELOAD" value="R" onclick="G4_RELOAD(uuidv4());">
<input type="button" name="BTN_G4_HIDDENCOL" value="V" onclick="G4_HIDDENCOL(uuidv4());">
<input type="button" name="BTN_G4_EXCEL" value="E" onclick="G4_EXCEL(uuidv4());">
<input type="button" name="BTN_G4_CHKSAVE" value="선택저장" onclick="G4_CHKSAVE(uuidv4());">
			</div>
		</div>
		<div  class="GRID_OBJECT"  style="">
			<div id="gridG4"  style="background-color:white;overflow:hidden;height:478px;width:100%;"></div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
<div style="width:0px;height:0px;overflow: hidden">
	<form name="excelDownForm" id="excelDownForm">
	<input type="hidden" name="DATA_HEADERS" id="DATA_HEADERS">
	<input type="hidden" name="DATA_WIDTHS" id="DATA_WIDTHS">
	<input type="hidden" name="DATA_ROWS" id="DATA_ROWS">
	</form>
</div>
<div style="width:0px;height:0px;overflow: hidden">
	<form name="popupForm" id="popupForm">
	<input type="text" name="GRPID" id="GRPID">
	<input type="text" name="ROWID" id="ROWID">	
	<input type="text" name="COLID" id="COLID">
	<input type="text" name="BTNNM" id="BTNNM">
	</form>
</div>
</div>



</body>
</html>
