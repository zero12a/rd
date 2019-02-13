<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('usrmngService.php');

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
alog("UsrmngControl___________________________start");

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
}else if($objAuth->isAuth("USRMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"USRMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"USRMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));
$REQ["G3-CTLCUD"] = reqPostString("G3-CTLCUD",2);

//로그인정보 및 환경경수 받기

//FILE먼저 : G1, 조회조건
//FILE먼저 : G2, 회원목록
//FILE먼저 : G3, 회원상세

//G1, 조회조건
$REQ["G1-USR_SEQ"] = reqPostNumber("G1-USR_SEQ",10);//USR_SEQ	
$REQ["G1-USR_SEQ"] = getFilter($REQ["G1-USR_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G1-USR_ID"] = reqPostString("G1-USR_ID",10);//USR_ID	
$REQ["G1-USR_ID"] = getFilter($REQ["G1-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G1-USR_NM"] = reqPostString("G1-USR_NM",10);//USR_NM	
$REQ["G1-USR_NM"] = getFilter($REQ["G1-USR_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G1-PHONE"] = reqPostString("G1-PHONE",20);//PHONE	
$REQ["G1-PHONE"] = getFilter($REQ["G1-PHONE"],"REGEXMAT","/^[0-9]{10,11}$/");	

//G2, 회원목록
$REQ["G2-USR_SEQ"] = reqPostNumber("G2-USR_SEQ",10);//USR_SEQ	
$REQ["G2-USR_SEQ"] = getFilter($REQ["G2-USR_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-USR_ID"] = reqPostString("G2-USR_ID",10);//USR_ID	
$REQ["G2-USR_ID"] = getFilter($REQ["G2-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G2-USR_NM"] = reqPostString("G2-USR_NM",10);//USR_NM	
$REQ["G2-USR_NM"] = getFilter($REQ["G2-USR_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-USR_PWD"] = reqPostString("G2-USR_PWD",10);//USR_PWD	
$REQ["G2-USR_PWD"] = getFilter($REQ["G2-USR_PWD"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-PW_CHG_DT"] = reqPostString("G2-PW_CHG_DT",20);//PW_CHG_DT	
$REQ["G2-PW_CHG_DT"] = getFilter($REQ["G2-PW_CHG_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-PHONE"] = reqPostString("G2-PHONE",20);//PHONE	
$REQ["G2-PHONE"] = getFilter($REQ["G2-PHONE"],"REGEXMAT","/^[0-9]{10,11}$/");	
$REQ["G2-PW_ERR_CNT"] = reqPostNumber("G2-PW_ERR_CNT",2);//PW_ERR_CNT	
$REQ["G2-PW_ERR_CNT"] = getFilter($REQ["G2-PW_ERR_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-LAST_STATUS"] = reqPostString("G2-LAST_STATUS",40);//LAST_STATUS	
$REQ["G2-LAST_STATUS"] = getFilter($REQ["G2-LAST_STATUS"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-USE_YN"] = reqPostString("G2-USE_YN",1);//USE_YN	
$REQ["G2-USE_YN"] = getFilter($REQ["G2-USE_YN"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-ADD_DT"] = reqPostString("G2-ADD_DT",14);//ADD	
$REQ["G2-ADD_DT"] = getFilter($REQ["G2-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G2-MOD_DT"] = reqPostString("G2-MOD_DT",50);//MOD	
$REQ["G2-MOD_DT"] = getFilter($REQ["G2-MOD_DT"],"SAFETEXT","/--미 정의--/");	

//G3, 회원상세
$REQ["G3-USR_SEQ"] = reqPostNumber("G3-USR_SEQ",10);//USR_SEQ	
$REQ["G3-USR_SEQ"] = getFilter($REQ["G3-USR_SEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-USR_ID"] = reqPostString("G3-USR_ID",10);//USR_ID	
$REQ["G3-USR_ID"] = getFilter($REQ["G3-USR_ID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G3-USR_NM"] = reqPostString("G3-USR_NM",10);//USR_NM	
$REQ["G3-USR_NM"] = getFilter($REQ["G3-USR_NM"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-USR_PWD"] = reqPostString("G3-USR_PWD",10);//USR_PWD	
$REQ["G3-USR_PWD"] = getFilter($REQ["G3-USR_PWD"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-PHONE"] = reqPostString("G3-PHONE",20);//PHONE	
$REQ["G3-PHONE"] = getFilter($REQ["G3-PHONE"],"REGEXMAT","/^[0-9]{10,11}$/");	
$REQ["G3-PW_ERR_CNT"] = reqPostNumber("G3-PW_ERR_CNT",2);//PW_ERR_CNT	
$REQ["G3-PW_ERR_CNT"] = getFilter($REQ["G3-PW_ERR_CNT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-LAST_STATUS"] = reqPostString("G3-LAST_STATUS",40);//LAST_STATUS	
$REQ["G3-LAST_STATUS"] = getFilter($REQ["G3-LAST_STATUS"],"SAFETEXT","/--미 정의--/");	
$REQ["G3-ADD_DT"] = reqPostString("G3-ADD_DT",14);//ADD	
$REQ["G3-ADD_DT"] = getFilter($REQ["G3-ADD_DT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-MOD_DT"] = reqPostString("G3-MOD_DT",50);//MOD	
$REQ["G3-MOD_DT"] = getFilter($REQ["G3-MOD_DT"],"SAFETEXT","/--미 정의--/");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//회원목록	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"USR_SEQ,USR_ID,USR_NM,USR_PWD,PW_CHG_DT,PHONE,PW_ERR_CNT,LAST_STATUS,USE_YN,ADD_DT,MOD_DT"
		,"VALID"=>
			array(
			"USR_SEQ"=>array("NUMBER",10)	
			,"USR_ID"=>array("STRING",10)	
			,"USR_NM"=>array("STRING",10)	
			,"USR_PWD"=>array("STRING",10)	
			,"PW_CHG_DT"=>array("STRING",20)	
			,"PHONE"=>array("STRING",20)	
			,"PW_ERR_CNT"=>array("NUMBER",2)	
			,"LAST_STATUS"=>array("STRING",40)	
			,"USE_YN"=>array("STRING",1)	
			,"ADD_DT"=>array("STRING",14)	
			,"MOD_DT"=>array("STRING",50)	
					)
		,"FILTER"=>
			array(
			"USR_SEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USR_ID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"USR_NM"=>array("SAFETEXT","/--미 정의--/")
			,"USR_PWD"=>array("SAFETEXT","/--미 정의--/")
			,"PW_CHG_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"PHONE"=>array("REGEXMAT","/^[0-9]{10,11}$/")
			,"PW_ERR_CNT"=>array("REGEXMAT","/^[0-9]+$/")
			,"LAST_STATUS"=>array("SAFETEXT","/--미 정의--/")
			,"USE_YN"=>array("SAFETEXT","/--미 정의--/")
			,"ADD_DT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MOD_DT"=>array("SAFETEXT","/--미 정의--/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new usrmngService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G1_SEARCHALL" :
  		echo $objService->goG1Searchall(); //조회조건, 조회(전체)
  		break;
	case "G1_SAVE" :
  		echo $objService->goG1Save(); //조회조건, 저장
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //회원목록, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //회원목록, 저장
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //회원목록, 엑셀다운로드
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //회원목록, 선택저장
  		break;
	case "G2_SAVEPWD" :
  		echo $objService->goG2Savepwd(); //회원목록, 비번변경
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //회원상세, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //회원상세, 저장
  		break;
	case "G3_DELETE" :
  		echo $objService->goG3Delete(); //회원상세, 삭제
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

alog("UsrmngControl___________________________end");

?>	