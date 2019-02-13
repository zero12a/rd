<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('appapiService.php');

array_push($_RTIME,array("[TIME 10.INCLUDE SERVICE]",microtime(true)));
include_once('../include/incUtil.php');//CG UTIL
	include_once('../include/incRequest.php');//CG REQUEST
	include_once('../include/incDB.php');//CG DB
	include_once('../include/incSEC.php');//CG SEC
	include_once('../include/incAuth.php');//CG AUTH
	include_once('./incConfig.CG.php');//CG CONFIG
	include_once('../include/incUser.php');//CG USER
	//하위에서 LOADDING LIB 처리
	array_push($_RTIME,array("[TIME 20.IMPORT]",microtime(true)));
alog("AppapiControl___________________________start");

$reqToken = reqGetString("TOKEN",37);
$resToken = uniqid();
alog("reqToken : " . $reqToken);
alog("resToken : " . $resToken);

$objAuth = new authObject();	
	

//컨트롤 명령 받기
$ctl = "";
$ctl1 = reqGetString("CTLGRP",50);
$ctl2 = reqGetString("CTLFNC",50);


if($ctl1 == "" || $ctl2 == ""){
	JsonMsg("500","100","처리 명령이 잘못되었습니다.(no input ctl)");
}else{
	$ctl = $ctl1 . "_" . $ctl2;
}
//로그인 : 권한정보 검사하기 in_array("aix", $os)
if(!isLogin()){
	JsonMsg("500","110"," 로그아웃되었습니다.");
}else if(!$objAuth->isOneConnection()){
	logOut();
	JsonMsg("500","120"," 다른기기(PC,브라우저 등)에서 로그인하였습니다. 다시로그인 후 사용해 주세요.");
}else if($objAuth->isAuth("APPAPI",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"APPAPI",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"APPAPI",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "NORMAL";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["F4-CTLCUD"] = reqPostString("F4-CTLCUD",2);

//로그인정보 및 환경경수 받기

//FILE먼저 : C2, 컨디션1
//FILE먼저 : G3, 그리드1
//FILE먼저 : F4, 폼뷰1
$REQ["F4-MYFILE_name"] = $_FILES["F4-MYFILE"]["name"];//MYFILE
$REQ["F4-MYFILE_type"] = $_FILES["F4-MYFILE"]["type"];//MYFILE
$REQ["F4-MYFILE_tmp_name"] = $_FILES["F4-MYFILE"]["tmp_name"];//MYFILE
$REQ["F4-MYFILE_size"] = $_FILES["F4-MYFILE"]["size"];//MYFILE
$REQ["F4-MYFILE_error"] = $_FILES["F4-MYFILE"]["error"];//MYFILE

//C2, 컨디션1
$REQ["C2-API_SEQ"] = reqPostString("C2-API_SEQ",10);//SEQ	
$REQ["C2-API_SEQ"] = getFilter($REQ["C2-API_SEQ"],"","//");	
$REQ["C2-API_NM"] = reqPostString("C2-API_NM",50);//NM	
$REQ["C2-API_NM"] = getFilter($REQ["C2-API_NM"],"","//");	
$REQ["C2-PGM_ID"] = reqPostString("C2-PGM_ID",50);//ID	
$REQ["C2-PGM_ID"] = getFilter($REQ["C2-PGM_ID"],"","//");	
$REQ["C2-URL"] = reqPostString("C2-URL",50);//URL	
$REQ["C2-URL"] = getFilter($REQ["C2-URL"],"","//");	

//G3, 그리드1
$REQ["G3-API_SEQ"] = reqPostString("G3-API_SEQ",10);//SEQ	
$REQ["G3-API_SEQ"] = getFilter($REQ["G3-API_SEQ"],"","//");	
$REQ["G3-API_NM"] = reqPostString("G3-API_NM",50);//NM	
$REQ["G3-API_NM"] = getFilter($REQ["G3-API_NM"],"","//");	
$REQ["G3-PGM_ID"] = reqPostString("G3-PGM_ID",50);//ID	
$REQ["G3-PGM_ID"] = getFilter($REQ["G3-PGM_ID"],"","//");	
$REQ["G3-URL"] = reqPostString("G3-URL",50);//URL	
$REQ["G3-URL"] = getFilter($REQ["G3-URL"],"","//");	
$REQ["G3-REQ_ENCTYPE"] = reqPostString("G3-REQ_ENCTYPE",55);//REQENCTYPE	
$REQ["G3-REQ_ENCTYPE"] = getFilter($REQ["G3-REQ_ENCTYPE"],"","//");	
$REQ["G3-REQ_DATATYPE"] = reqPostString("G3-REQ_DATATYPE",50);//REQDATATYPE	
$REQ["G3-REQ_DATATYPE"] = getFilter($REQ["G3-REQ_DATATYPE"],"","//");	
$REQ["G3-REQ_BODY"] = reqPostString("G3-REQ_BODY",50);//REQBODY	
$REQ["G3-REQ_BODY"] = getFilter($REQ["G3-REQ_BODY"],"","//");	
$REQ["G3-RES_BODY"] = reqPostString("G3-RES_BODY",50);//RESBODY	
$REQ["G3-RES_BODY"] = getFilter($REQ["G3-RES_BODY"],"","//");	
$REQ["G3-MYFILE"] = reqPostString("G3-MYFILE",40);//MYFILE	
$REQ["G3-MYFILE"] = getFilter($REQ["G3-MYFILE"],"","//");	
$REQ["G3-MYFILESVRNM"] = reqPostString("G3-MYFILESVRNM",40);//MYFILESVRNM	
$REQ["G3-MYFILESVRNM"] = getFilter($REQ["G3-MYFILESVRNM"],"","//");	
$REQ["G3-ADD_DT"] = reqPostString("G3-ADD_DT",14);//ADD	
$REQ["G3-ADD_DT"] = getFilter($REQ["G3-ADD_DT"],"","//");	
$REQ["G3-MOD_DT"] = reqPostString("G3-MOD_DT",50);//MOD	
$REQ["G3-MOD_DT"] = getFilter($REQ["G3-MOD_DT"],"","//");	
$REQ["G3-CHK"] = reqPostNumber("G3-CHK",1);//CHK	
$REQ["G3-CHK"] = getFilter($REQ["G3-CHK"],"","//");	

//F4, 폼뷰1
$REQ["F4-API_SEQ"] = reqPostString("F4-API_SEQ",10);//SEQ	
$REQ["F4-API_SEQ"] = getFilter($REQ["F4-API_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["F4-API_NM"] = reqPostString("F4-API_NM",50);//NM	
$REQ["F4-API_NM"] = getFilter($REQ["F4-API_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-PGM_ID"] = reqPostString("F4-PGM_ID",50);//ID	
$REQ["F4-PGM_ID"] = getFilter($REQ["F4-PGM_ID"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-URL"] = reqPostString("F4-URL",50);//URL	
$REQ["F4-URL"] = getFilter($REQ["F4-URL"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-REQ_ENCTYPE"] = reqPostString("F4-REQ_ENCTYPE",55);//REQENCTYPE	
$REQ["F4-REQ_ENCTYPE"] = getFilter($REQ["F4-REQ_ENCTYPE"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-REQ_DATATYPE"] = reqPostString("F4-REQ_DATATYPE",50);//REQDATATYPE	
$REQ["F4-REQ_DATATYPE"] = getFilter($REQ["F4-REQ_DATATYPE"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-REQ_BODY"] = reqPostString("F4-REQ_BODY",50);//REQBODY	
$REQ["F4-REQ_BODY"] = getFilter($REQ["F4-REQ_BODY"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-RES_BODY"] = reqPostString("F4-RES_BODY",50);//RESBODY	
$REQ["F4-RES_BODY"] = getFilter($REQ["F4-RES_BODY"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-MYFILESVRNM"] = reqPostString("F4-MYFILESVRNM",40);//MYFILESVRNM	
$REQ["F4-MYFILESVRNM"] = getFilter($REQ["F4-MYFILESVRNM"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-MYFILE"] = reqPostString("F4-MYFILE",40);//MYFILE	
$REQ["F4-MYFILE"] = getFilter($REQ["F4-MYFILE"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-MYFILE_VIEWER"] = reqPostString("F4-MYFILE_VIEWER",100);//이미지뷰어	
$REQ["F4-MYFILE_VIEWER"] = getFilter($REQ["F4-MYFILE_VIEWER"],"SAFETEXT","/--미 정의--/");	
$REQ["F4-ADD_DT"] = reqPostString("F4-ADD_DT",14);//ADD	
$REQ["F4-ADD_DT"] = getFilter($REQ["F4-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["F4-MOD_DT"] = reqPostString("F4-MOD_DT",50);//MOD	
$REQ["F4-MOD_DT"] = getFilter($REQ["F4-MOD_DT"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//그리드1	
	//,  입력값 필터 
	$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"ROWCHK,API_SEQ,API_NM,PGM_ID,URL,REQ_ENCTYPE,REQ_DATATYPE,REQ_BODY,RES_BODY,MYFILE,MYFILESVRNM,ADD_DT,MOD_DT,CHK"
		,"VALID"=>
			array(
			"ROWCHK"=>array("NUMBER",1)	
			,"API_SEQ"=>array("STRING",10)	
			,"API_NM"=>array("STRING",50)	
			,"PGM_ID"=>array("STRING",50)	
			,"URL"=>array("STRING",50)	
			,"REQ_ENCTYPE"=>array("STRING",55)	
			,"REQ_DATATYPE"=>array("STRING",50)	
			,"REQ_BODY"=>array("STRING",50)	
			,"RES_BODY"=>array("STRING",50)	
			,"MYFILE"=>array("STRING",40)	
			,"MYFILESVRNM"=>array("STRING",40)	
			,"ADD_DT"=>array("STRING",14)	
			,"MOD_DT"=>array("STRING",50)	
			,"CHK"=>array("NUMBER",1)	
					)
		,"FILTER"=>
			array(
					)
	)
);
	
$REQ["G3-CHK"] = $_POST["G3-CHK"];//CHK 받기
//filterGridChk($tStr,$tDataType,$tDataSize,$tValidType,$tValidRule)
$REQ["G3-CHK"] = filterGridChk($REQ["G3-CHK"],"STRING",10,"","//");//API_SEQ 입력값검증
	array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new appapiService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "C2_SAVE" :
  		echo $objService->goC2Save(); //컨디션1, 저장
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //그리드1, 조회
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //그리드1, 완전삭제
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //그리드1, S
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //그리드1, E
  		break;
	case "F4_SEARCH" :
  		echo $objService->goF4Search(); //폼뷰1, 조회
  		break;
	case "F4_SAVE" :
  		echo $objService->goF4Save(); //폼뷰1, 저장
  		break;
	case "F4_DELETE" :
  		echo $objService->goF4Delete(); //폼뷰1, 삭제
  		break;
	default:
		JsonMsg("500","110","처리 명령을 찾을 수 없습니다. (no search ctl)");
		break;
}
	array_push($_RTIME,array("[TIME 50.SVC]",microtime(true)));
if($PGM_CFG["SECTYPE"] == "POWER" || $PGM_CFG["SECTYPE"] == "PI") $objAuth->logUsrAuthD($reqToken,$resToken);;	//권한변경 로그 저장
	array_push($_RTIME,array("[TIME 60.AUGHD_LOG]",microtime(true)));
//실행시간 검사
for($j=1;$j<sizeof($_RTIME);$j++){
	alog( $_RTIME[$j][0] . " " . number_format($_RTIME[$j][1]-$_RTIME[$j-1][1],4) );

	if($j == sizeof($_RTIME)-1) alog( "RUN TIME : " . number_format($_RTIME[$j][1]-$_RTIME[0][1],4) );
}
//서비스 클래스 비우기
unset($objService);
unset($objAuth);

alog("AppapiControl___________________________end");

?>	