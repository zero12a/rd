<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('usermngService.php');

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
alog("UsermngControl___________________________start");

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
}else if($objAuth->isAuth("USERMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"USERMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"USERMNG",$ctl,"N");
	JsonMsg("500","120",$ctl . " 권한이 없습니다.");
}
		//사용자 정보 가져오기
//로그 저장 방식 결정
//일반로그, 권한변경로그, PI로그
//NORMAL, POWER, PI
$PGM_CFG["SECTYPE"] = "POWER";
$PGM_CFG["SQLTXT"] = array();
array_push($_RTIME,array("[TIME 30.AUTH_CHECK]",microtime(true)));

//로그인정보 및 환경경수 받기

//FILE먼저 : C1, 조건1
//FILE먼저 : G2, 사용자1
//FILE먼저 : G3, 프로젝트2
//FILE먼저 : G4, 서버4

//C1, 조건1
$REQ["C1-EMAIL"] = reqPostString("C1-EMAIL",20);//이메일	
$REQ["C1-EMAIL"] = getFilter($REQ["C1-EMAIL"],"","//");	

//G2, 사용자1
$REQ["G2-USERSEQ"] = reqPostNumber("G2-USERSEQ",20);//USERSEQ	
$REQ["G2-USERSEQ"] = getFilter($REQ["G2-USERSEQ"],"","//");	
$REQ["G2-EMAIL"] = reqPostString("G2-EMAIL",20);//이메일	
$REQ["G2-EMAIL"] = getFilter($REQ["G2-EMAIL"],"","//");	
$REQ["G2-PASSWD"] = reqPostString("G2-PASSWD",20);//PASSWD	
$REQ["G2-PASSWD"] = getFilter($REQ["G2-PASSWD"],"","//");	
$REQ["G2-EMAILVALIDYN"] = reqPostString("G2-EMAILVALIDYN",20);//이메일인증	
$REQ["G2-EMAILVALIDYN"] = getFilter($REQ["G2-EMAILVALIDYN"],"","//");	
$REQ["G2-LASTPWCHGDT"] = reqPostString("G2-LASTPWCHGDT",20);//비번변경일	
$REQ["G2-LASTPWCHGDT"] = getFilter($REQ["G2-LASTPWCHGDT"],"","//");	
$REQ["G2-PWFAILCNT"] = reqPostNumber("G2-PWFAILCNT",20);//로그인실패횟수	
$REQ["G2-PWFAILCNT"] = getFilter($REQ["G2-PWFAILCNT"],"","//");	
$REQ["G2-LOCKYN"] = reqPostString("G2-LOCKYN",20);//잠금유무	
$REQ["G2-LOCKYN"] = getFilter($REQ["G2-LOCKYN"],"","//");	
$REQ["G2-FREEZEDT"] = reqPostString("G2-FREEZEDT",20);//잠금대기시간	
$REQ["G2-FREEZEDT"] = getFilter($REQ["G2-FREEZEDT"],"","//");	
$REQ["G2-LOCKDT"] = reqPostString("G2-LOCKDT",20);//잠긴시간	
$REQ["G2-LOCKDT"] = getFilter($REQ["G2-LOCKDT"],"","//");	
$REQ["G2-SERVERSEQ"] = reqPostNumber("G2-SERVERSEQ",20);//SERVERSEQ	
$REQ["G2-SERVERSEQ"] = getFilter($REQ["G2-SERVERSEQ"],"","//");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//ADDDT	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"","//");	
$REQ["G2-MODDT"] = reqPostString("G2-MODDT",14);//수정일	
$REQ["G2-MODDT"] = getFilter($REQ["G2-MODDT"],"","//");	

//G3, 프로젝트2
$REQ["G3-USERSEQ"] = reqPostNumber("G3-USERSEQ",20);//USERSEQ	
$REQ["G3-USERSEQ"] = getFilter($REQ["G3-USERSEQ"],"","//");	
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//SEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"","//");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"","//");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//수정일	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"","//");	

//G4, 서버4
$REQ["G4-SVRSEQ"] = reqPostNumber("G4-SVRSEQ",20);//SERVERSEQ	
$REQ["G4-SVRSEQ"] = getFilter($REQ["G4-SVRSEQ"],"","//");	
$REQ["G4-SVRID"] = reqPostString("G4-SVRID",20);//SVRID	
$REQ["G4-SVRID"] = getFilter($REQ["G4-SVRID"],"","//");	
$REQ["G4-SVRNM"] = reqPostString("G4-SVRNM",100);//SVRNM	
$REQ["G4-SVRNM"] = getFilter($REQ["G4-SVRNM"],"","//");	
$REQ["G4-PJTSEQ"] = reqPostNumber("G4-PJTSEQ",20);//PJTSEQ	
$REQ["G4-PJTSEQ"] = getFilter($REQ["G4-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-USERSEQ"] = reqPostNumber("G4-USERSEQ",20);//USERSEQ	
$REQ["G4-USERSEQ"] = getFilter($REQ["G4-USERSEQ"],"","//");	
$REQ["G4-DBHOST"] = reqPostString("G4-DBHOST",60);//DBHOST	
$REQ["G4-DBHOST"] = getFilter($REQ["G4-DBHOST"],"","//");	
$REQ["G4-DBPORT"] = reqPostString("G4-DBPORT",60);//DBPORT	
$REQ["G4-DBPORT"] = getFilter($REQ["G4-DBPORT"],"","//");	
$REQ["G4-DBNAME"] = reqPostString("G4-DBNAME",60);//DBNAME	
$REQ["G4-DBNAME"] = getFilter($REQ["G4-DBNAME"],"","//");	
$REQ["G4-DBUSRID"] = reqPostString("G4-DBUSRID",60);//DBUSERID	
$REQ["G4-DBUSRID"] = getFilter($REQ["G4-DBUSRID"],"","//");	
$REQ["G4-DBUSRPW"] = reqPostString("G4-DBUSRPW",100);//DBUSERPW	
$REQ["G4-DBUSRPW"] = getFilter($REQ["G4-DBUSRPW"],"","//");	
$REQ["G4-USEYN"] = reqPostString("G4-USEYN",1);//사용유무	
$REQ["G4-USEYN"] = getFilter($REQ["G4-USEYN"],"","//");	
$REQ["G4-ADDDT"] = reqPostString("G4-ADDDT",14);//ADDDT	
$REQ["G4-ADDDT"] = getFilter($REQ["G4-ADDDT"],"","//");	
$REQ["G4-MODDT"] = reqPostString("G4-MODDT",14);//수정일	
$REQ["G4-MODDT"] = getFilter($REQ["G4-MODDT"],"","//");	
$REQ["G2-XML"] = getXml2Array($_POST["G2-XML"]);//사용자1	
	$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//프로젝트2	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//서버4	
	//,  입력값 필터 
	$REQ["G2-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G2-XML"]
		,"COLORD"=>"USERSEQ,EMAIL,PASSWD,EMAILVALIDYN,LASTPWCHGDT,PWFAILCNT,LOCKYN,FREEZEDT,LOCKDT,SERVERSEQ,ADDDT,MODDT"
		,"VALID"=>
			array(
			"USERSEQ"=>array("NUMBER",20)	
			,"EMAIL"=>array("STRING",20)	
			,"PASSWD"=>array("STRING",20)	
			,"EMAILVALIDYN"=>array("STRING",20)	
			,"LASTPWCHGDT"=>array("STRING",20)	
			,"PWFAILCNT"=>array("NUMBER",20)	
			,"LOCKYN"=>array("STRING",20)	
			,"FREEZEDT"=>array("STRING",20)	
			,"LOCKDT"=>array("STRING",20)	
			,"SERVERSEQ"=>array("NUMBER",20)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
					)
	)
);
$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"USERSEQ,PJTSEQ,ADDDT,MODDT"
		,"VALID"=>
			array(
			"USERSEQ"=>array("NUMBER",20)	
			,"PJTSEQ"=>array("NUMBER",20)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"SVRSEQ,SVRID,SVRNM,PJTSEQ,USERSEQ,DBHOST,DBPORT,DBNAME,DBUSRID,DBUSRPW,USEYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"SVRSEQ"=>array("NUMBER",20)	
			,"SVRID"=>array("STRING",20)	
			,"SVRNM"=>array("STRING",100)	
			,"PJTSEQ"=>array("NUMBER",20)	
			,"USERSEQ"=>array("NUMBER",20)	
			,"DBHOST"=>array("STRING",60)	
			,"DBPORT"=>array("STRING",60)	
			,"DBNAME"=>array("STRING",60)	
			,"DBUSRID"=>array("STRING",60)	
			,"DBUSRPW"=>array("STRING",100)	
			,"USEYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new usermngService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G2_USERDEF" :
  		echo $objService->goG2Userdef(); //사용자1, 비번변경
  		break;
	case "G2_SEARCH" :
  		echo $objService->goG2Search(); //사용자1, 조회
  		break;
	case "G2_SAVE" :
  		echo $objService->goG2Save(); //사용자1, S
  		break;
	case "G2_EXCEL" :
  		echo $objService->goG2Excel(); //사용자1, E
  		break;
	case "G2_CHKSAVE" :
  		echo $objService->goG2Chksave(); //사용자1, 선택저장
  		break;
	case "G3_USERDEF" :
  		echo $objService->goG3Userdef(); //프로젝트2, 사용자정의
  		break;
	case "G3_SEARCH" :
  		echo $objService->goG3Search(); //프로젝트2, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //프로젝트2, S
  		break;
	case "G3_EXCEL" :
  		echo $objService->goG3Excel(); //프로젝트2, E
  		break;
	case "G3_CHKSAVE" :
  		echo $objService->goG3Chksave(); //프로젝트2, 선택저장
  		break;
	case "G4_USERDEF" :
  		echo $objService->goG4Userdef(); //서버4, 사용자정의
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //서버4, 조회
  		break;
	case "G4_SAVE" :
  		echo $objService->goG4Save(); //서버4, S
  		break;
	case "G4_EXCEL" :
  		echo $objService->goG4Excel(); //서버4, E
  		break;
	case "G4_CHKSAVE" :
  		echo $objService->goG4Chksave(); //서버4, 선택저장
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

alog("UsermngControl___________________________end");

?>	