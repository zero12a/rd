<?php
header("Content-Type: text/html; charset=UTF-8"); //SVRCTL
header("Cache-Control:no-cache");
header("Pragma:no-cache");
$_RTIME = array();
array_push($_RTIME,array("[TIME 00.START]",microtime(true)));
include_once('pgmmngService.php');

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
alog("PgmmngControl___________________________start");

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
}else if($objAuth->isAuth("PGMMNG",$ctl)){
	$objAuth->LAUTH_SEQ = $objAuth->logUsrAuth($reqToken,$resToken,"PGMMNG",$ctl,"Y");
}else{
	$objAuth->logUsrAuth($reqToken,$resToken,"PGMMNG",$ctl,"N");
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
$REQ["USER.SEQ"] = getUserSeq();

//FILE먼저 : G2, 2
//FILE먼저 : G3, PJT
//FILE먼저 : G4, PGM
//FILE먼저 : G5, DD
//FILE먼저 : G6, CONFIG
//FILE먼저 : G7, FILE

//G2, 2
$REQ["G2-PJTID"] = reqPostString("G2-PJTID",30);//프로젝트ID	
$REQ["G2-PJTID"] = getFilter($REQ["G2-PJTID"],"","//");	
$REQ["G2-ADDDT"] = reqPostString("G2-ADDDT",14);//생성일	
$REQ["G2-ADDDT"] = getFilter($REQ["G2-ADDDT"],"","//");	

//G3, PJT
$REQ["G3-PJTSEQ"] = reqPostNumber("G3-PJTSEQ",20);//SEQ	
$REQ["G3-PJTSEQ"] = getFilter($REQ["G3-PJTSEQ"],"","//");	
$REQ["G3-PJTID"] = reqPostString("G3-PJTID",30);//프로젝트ID	
$REQ["G3-PJTID"] = getFilter($REQ["G3-PJTID"],"","//");	
$REQ["G3-PJTNM"] = reqPostString("G3-PJTNM",100);//프로젝트명	
$REQ["G3-PJTNM"] = getFilter($REQ["G3-PJTNM"],"","//");	
$REQ["G3-FILECHARSET"] = reqPostString("G3-FILECHARSET",30);//파일 CHARSET	
$REQ["G3-FILECHARSET"] = getFilter($REQ["G3-FILECHARSET"],"","//");	
$REQ["G3-UITOOL"] = reqPostString("G3-UITOOL",10);//UITOOL	
$REQ["G3-UITOOL"] = getFilter($REQ["G3-UITOOL"],"","//");	
$REQ["G3-SVRLANG"] = reqPostString("G3-SVRLANG",10);//서버언어	
$REQ["G3-SVRLANG"] = getFilter($REQ["G3-SVRLANG"],"","//");	
$REQ["G3-DEPLOYKEY"] = reqPostString("G3-DEPLOYKEY",50);//DEPLOYKEY	
$REQ["G3-DEPLOYKEY"] = getFilter($REQ["G3-DEPLOYKEY"],"CLEARTEXT","/--미 정의--/");	
$REQ["G3-PKGROOT"] = reqPostString("G3-PKGROOT",10);//패키지ROOT	
$REQ["G3-PKGROOT"] = getFilter($REQ["G3-PKGROOT"],"","//");	
$REQ["G3-STARTDT"] = reqPostString("G3-STARTDT",8);//시작일	
$REQ["G3-STARTDT"] = getFilter($REQ["G3-STARTDT"],"","//");	
$REQ["G3-ENDDT"] = reqPostString("G3-ENDDT",8);//종료일	
$REQ["G3-ENDDT"] = getFilter($REQ["G3-ENDDT"],"","//");	
$REQ["G3-DELYN"] = reqPostString("G3-DELYN",1);//삭제YN	
$REQ["G3-DELYN"] = getFilter($REQ["G3-DELYN"],"","//");	
$REQ["G3-ADDDT"] = reqPostString("G3-ADDDT",14);//ADDDT	
$REQ["G3-ADDDT"] = getFilter($REQ["G3-ADDDT"],"","//");	
$REQ["G3-MODDT"] = reqPostString("G3-MODDT",14);//수정일	
$REQ["G3-MODDT"] = getFilter($REQ["G3-MODDT"],"","//");	

//G4, PGM
$REQ["G4-PJTSEQ"] = reqPostNumber("G4-PJTSEQ",20);//PJTSEQ	
$REQ["G4-PJTSEQ"] = getFilter($REQ["G4-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-PGMSEQ"] = reqPostNumber("G4-PGMSEQ",30);//SEQ	
$REQ["G4-PGMSEQ"] = getFilter($REQ["G4-PGMSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-PGMID"] = reqPostString("G4-PGMID",20);//프로그램ID	
$REQ["G4-PGMID"] = getFilter($REQ["G4-PGMID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G4-PGMNM"] = reqPostString("G4-PGMNM",50);//프로그램이름	
$REQ["G4-PGMNM"] = getFilter($REQ["G4-PGMNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-VIEWURL"] = reqPostString("G4-VIEWURL",30);//VIEWURL	
$REQ["G4-VIEWURL"] = getFilter($REQ["G4-VIEWURL"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-PGMTYPE"] = reqPostString("G4-PGMTYPE",10);//PGMTYPE	
$REQ["G4-PGMTYPE"] = getFilter($REQ["G4-PGMTYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-POPWIDTH"] = reqPostString("G4-POPWIDTH",10);//POPWIDTH	
$REQ["G4-POPWIDTH"] = getFilter($REQ["G4-POPWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-POPHEIGHT"] = reqPostString("G4-POPHEIGHT",10);//POPHEIGHT	
$REQ["G4-POPHEIGHT"] = getFilter($REQ["G4-POPHEIGHT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-SECTYPE"] = reqPostString("G4-SECTYPE",10);//SECTYPE	
$REQ["G4-SECTYPE"] = getFilter($REQ["G4-SECTYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G4-PKGGRP"] = reqPostString("G4-PKGGRP",15);//PKGGRP	
$REQ["G4-PKGGRP"] = getFilter($REQ["G4-PKGGRP"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-LOGINYN"] = reqPostString("G4-LOGINYN",1);//로그인필요	
$REQ["G4-LOGINYN"] = getFilter($REQ["G4-LOGINYN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G4-ADDDT"] = reqPostString("G4-ADDDT",14);//ADDDT	
$REQ["G4-ADDDT"] = getFilter($REQ["G4-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G4-MODDT"] = reqPostString("G4-MODDT",14);//MODDT	
$REQ["G4-MODDT"] = getFilter($REQ["G4-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G5, DD
$REQ["G5-PJTSEQ"] = reqPostNumber("G5-PJTSEQ",20);//PJTSEQ	
$REQ["G5-PJTSEQ"] = getFilter($REQ["G5-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-DDSEQ"] = reqPostNumber("G5-DDSEQ",10);//DDSEQ	
$REQ["G5-DDSEQ"] = getFilter($REQ["G5-DDSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-COLID"] = reqPostString("G5-COLID",30);//컬럼ID	
$REQ["G5-COLID"] = getFilter($REQ["G5-COLID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-COLNM"] = reqPostString("G5-COLNM",30);//컬럼명	
$REQ["G5-COLNM"] = getFilter($REQ["G5-COLNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-COLSNM"] = reqPostString("G5-COLSNM",30);//단축명	
$REQ["G5-COLSNM"] = getFilter($REQ["G5-COLSNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-DATATYPE"] = reqPostString("G5-DATATYPE",30);//데이터타입	
$REQ["G5-DATATYPE"] = getFilter($REQ["G5-DATATYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G5-DATASIZE"] = reqPostNumber("G5-DATASIZE",30);//데이터사이즈	
$REQ["G5-DATASIZE"] = getFilter($REQ["G5-DATASIZE"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-OBJTYPE"] = reqPostString("G5-OBJTYPE",30);//오브젝트타입	
$REQ["G5-OBJTYPE"] = getFilter($REQ["G5-OBJTYPE"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G5-OBJTYPE_FORMVIEW"] = reqPostString("G5-OBJTYPE_FORMVIEW",30);//OBJ폼뷰	
$REQ["G5-OBJTYPE_FORMVIEW"] = getFilter($REQ["G5-OBJTYPE_FORMVIEW"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G5-OBJTYPE_GRID"] = reqPostString("G5-OBJTYPE_GRID",30);//OBJ그리드	
$REQ["G5-OBJTYPE_GRID"] = getFilter($REQ["G5-OBJTYPE_GRID"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G5-LBLWIDTH"] = reqPostString("G5-LBLWIDTH",30);//라벨가로	
$REQ["G5-LBLWIDTH"] = getFilter($REQ["G5-LBLWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-LBLHEIGHT"] = reqPostString("G5-LBLHEIGHT",30);//가벨세로	
$REQ["G5-LBLHEIGHT"] = getFilter($REQ["G5-LBLHEIGHT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-LBLALIGN"] = reqPostString("G5-LBLALIGN",20);//LBLALIGN	
$REQ["G5-LBLALIGN"] = getFilter($REQ["G5-LBLALIGN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G5-OBJWIDTH"] = reqPostString("G5-OBJWIDTH",30);//오브젝트가로	
$REQ["G5-OBJWIDTH"] = getFilter($REQ["G5-OBJWIDTH"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-OBJHEIGHT"] = reqPostString("G5-OBJHEIGHT",30);//오브젝트세로	
$REQ["G5-OBJHEIGHT"] = getFilter($REQ["G5-OBJHEIGHT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-OBJALIGN"] = reqPostString("G5-OBJALIGN",30);//가로정렬	
$REQ["G5-OBJALIGN"] = getFilter($REQ["G5-OBJALIGN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-CRYPTCD"] = reqPostString("G5-CRYPTCD",10);//CRYPTCD	
$REQ["G5-CRYPTCD"] = getFilter($REQ["G5-CRYPTCD"],"CLEARTEXT","/--미 정의--/");	
$REQ["G5-VALIDSEQ"] = reqPostNumber("G5-VALIDSEQ",30);//VALIDSEQ	
$REQ["G5-VALIDSEQ"] = getFilter($REQ["G5-VALIDSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-PIYN"] = reqPostString("G5-PIYN",1);//PIYN	
$REQ["G5-PIYN"] = getFilter($REQ["G5-PIYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G5-ADDDT"] = reqPostString("G5-ADDDT",14);//등록일	
$REQ["G5-ADDDT"] = getFilter($REQ["G5-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G5-MODDT"] = reqPostString("G5-MODDT",14);//수정일	
$REQ["G5-MODDT"] = getFilter($REQ["G5-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G6, CONFIG
$REQ["G6-PJTSEQ"] = reqPostNumber("G6-PJTSEQ",20);//PJTSEQ	
$REQ["G6-PJTSEQ"] = getFilter($REQ["G6-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G6-CFGSEQ"] = reqPostNumber("G6-CFGSEQ",30);//SEQ	
$REQ["G6-CFGSEQ"] = getFilter($REQ["G6-CFGSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G6-USEYN"] = reqPostString("G6-USEYN",1);//사용	
$REQ["G6-USEYN"] = getFilter($REQ["G6-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G6-CFGID"] = reqPostString("G6-CFGID",30);//CFGID	
$REQ["G6-CFGID"] = getFilter($REQ["G6-CFGID"],"CLEARTEXT","/--미 정의--/");	
$REQ["G6-CFGNM"] = reqPostString("G6-CFGNM",100);//CFGNM	
$REQ["G6-CFGNM"] = getFilter($REQ["G6-CFGNM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G6-MVCGBN"] = reqPostString("G6-MVCGBN",30);//MVCGBN	
$REQ["G6-MVCGBN"] = getFilter($REQ["G6-MVCGBN"],"CLEARTEXT","/--미 정의--/");	
$REQ["G6-PATH"] = reqPostString("G6-PATH",300);//PATH	
$REQ["G6-PATH"] = getFilter($REQ["G6-PATH"],"SAFETEXT","/--미 정의--/");	
$REQ["G6-CFGORD"] = reqPostNumber("G6-CFGORD",30);//ORD	
$REQ["G6-CFGORD"] = getFilter($REQ["G6-CFGORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G6-ADDDT"] = reqPostString("G6-ADDDT",14);//ADDDT	
$REQ["G6-ADDDT"] = getFilter($REQ["G6-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G6-MODDT"] = reqPostString("G6-MODDT",14);//MODDT	
$REQ["G6-MODDT"] = getFilter($REQ["G6-MODDT"],"REGEXMAT","/^[0-9]+$/");	

//G7, FILE
$REQ["G7-PJTSEQ"] = reqPostNumber("G7-PJTSEQ",20);//PJTSEQ	
$REQ["G7-PJTSEQ"] = getFilter($REQ["G7-PJTSEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G7-FILESEQ"] = reqPostString("G7-FILESEQ",0);//SEQ	
$REQ["G7-FILESEQ"] = getFilter($REQ["G7-FILESEQ"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G7-MKFILETYPE"] = reqPostString("G7-MKFILETYPE",0);//파일타입	
$REQ["G7-MKFILETYPE"] = getFilter($REQ["G7-MKFILETYPE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G7-MKFILETYPENM"] = reqPostString("G7-MKFILETYPENM",0);//타입명	
$REQ["G7-MKFILETYPENM"] = getFilter($REQ["G7-MKFILETYPENM"],"CLEARTEXT","/--미 정의--/");	
$REQ["G7-MKFILEFORMAT"] = reqPostString("G7-MKFILEFORMAT",0);//포멧	
$REQ["G7-MKFILEFORMAT"] = getFilter($REQ["G7-MKFILEFORMAT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G7-MKFILEEXT"] = reqPostString("G7-MKFILEEXT",0);//확장자	
$REQ["G7-MKFILEEXT"] = getFilter($REQ["G7-MKFILEEXT"],"CLEARTEXT","/--미 정의--/");	
$REQ["G7-TEMPLATE"] = reqPostString("G7-TEMPLATE",0);//템플릿	
$REQ["G7-TEMPLATE"] = getFilter($REQ["G7-TEMPLATE"],"CLEARTEXT","/--미 정의--/");	
$REQ["G7-FILEORD"] = reqPostString("G7-FILEORD",0);//순번	
$REQ["G7-FILEORD"] = getFilter($REQ["G7-FILEORD"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G7-USEYN"] = reqPostString("G7-USEYN",1);//사용	
$REQ["G7-USEYN"] = getFilter($REQ["G7-USEYN"],"REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/");	
$REQ["G7-ADDDT"] = reqPostString("G7-ADDDT",14);//ADDDT	
$REQ["G7-ADDDT"] = getFilter($REQ["G7-ADDDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G7-MODDT"] = reqPostString("G7-MODDT",14);//MODDT	
$REQ["G7-MODDT"] = getFilter($REQ["G7-MODDT"],"REGEXMAT","/^[0-9]+$/");	
$REQ["G3-XML"] = getXml2Array($_POST["G3-XML"]);//PJT	
	$REQ["G4-XML"] = getXml2Array($_POST["G4-XML"]);//PGM	
	$REQ["G5-XML"] = getXml2Array($_POST["G5-XML"]);//DD	
	$REQ["G6-XML"] = getXml2Array($_POST["G6-XML"]);//CONFIG	
	$REQ["G7-XML"] = getXml2Array($_POST["G7-XML"]);//FILE	
	//,  입력값 필터 
	$REQ["G3-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G3-XML"]
		,"COLORD"=>"PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT,DELYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"PJTID"=>array("STRING",30)	
			,"PJTNM"=>array("STRING",100)	
			,"FILECHARSET"=>array("STRING",30)	
			,"UITOOL"=>array("STRING",10)	
			,"SVRLANG"=>array("STRING",10)	
			,"DEPLOYKEY"=>array("STRING",50)	
			,"PKGROOT"=>array("STRING",10)	
			,"STARTDT"=>array("STRING",8)	
			,"ENDDT"=>array("STRING",8)	
			,"DELYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"DEPLOYKEY"=>array("CLEARTEXT","/--미 정의--/")
					)
	)
);
$REQ["G4-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G4-XML"]
		,"COLORD"=>"PJTSEQ,PGMSEQ,PGMID,PGMNM,VIEWURL,PGMTYPE,POPWIDTH,POPHEIGHT,SECTYPE,PKGGRP,LOGINYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"PGMSEQ"=>array("NUMBER",30)	
			,"PGMID"=>array("STRING",20)	
			,"PGMNM"=>array("STRING",50)	
			,"VIEWURL"=>array("STRING",30)	
			,"PGMTYPE"=>array("STRING",10)	
			,"POPWIDTH"=>array("STRING",10)	
			,"POPHEIGHT"=>array("STRING",10)	
			,"SECTYPE"=>array("STRING",10)	
			,"PKGGRP"=>array("STRING",15)	
			,"LOGINYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PGMID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PGMNM"=>array("CLEARTEXT","/--미 정의--/")
			,"VIEWURL"=>array("CLEARTEXT","/--미 정의--/")
			,"PGMTYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"POPWIDTH"=>array("CLEARTEXT","/--미 정의--/")
			,"POPHEIGHT"=>array("CLEARTEXT","/--미 정의--/")
			,"SECTYPE"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"PKGGRP"=>array("CLEARTEXT","/--미 정의--/")
			,"LOGINYN"=>array("CLEARTEXT","/--미 정의--/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G5-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G5-XML"]
		,"COLORD"=>"PJTSEQ,DDSEQ,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,OBJTYPE_FORMVIEW,OBJTYPE_GRID,LBLWIDTH,LBLHEIGHT,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,CRYPTCD,VALIDSEQ,PIYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"DDSEQ"=>array("NUMBER",10)	
			,"COLID"=>array("STRING",30)	
			,"COLNM"=>array("STRING",30)	
			,"COLSNM"=>array("STRING",30)	
			,"DATATYPE"=>array("STRING",30)	
			,"DATASIZE"=>array("NUMBER",30)	
			,"OBJTYPE"=>array("STRING",30)	
			,"OBJTYPE_FORMVIEW"=>array("STRING",30)	
			,"OBJTYPE_GRID"=>array("STRING",30)	
			,"LBLWIDTH"=>array("STRING",30)	
			,"LBLHEIGHT"=>array("STRING",30)	
			,"LBLALIGN"=>array("STRING",20)	
			,"OBJWIDTH"=>array("STRING",30)	
			,"OBJHEIGHT"=>array("STRING",30)	
			,"OBJALIGN"=>array("STRING",30)	
			,"CRYPTCD"=>array("STRING",10)	
			,"VALIDSEQ"=>array("NUMBER",30)	
			,"PIYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"DDSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"COLID"=>array("CLEARTEXT","/--미 정의--/")
			,"COLNM"=>array("CLEARTEXT","/--미 정의--/")
			,"COLSNM"=>array("CLEARTEXT","/--미 정의--/")
			,"DATATYPE"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"DATASIZE"=>array("REGEXMAT","/^[0-9]+$/")
			,"OBJTYPE"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"OBJTYPE_FORMVIEW"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"OBJTYPE_GRID"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"LBLWIDTH"=>array("CLEARTEXT","/--미 정의--/")
			,"LBLHEIGHT"=>array("CLEARTEXT","/--미 정의--/")
			,"LBLALIGN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"OBJWIDTH"=>array("CLEARTEXT","/--미 정의--/")
			,"OBJHEIGHT"=>array("CLEARTEXT","/--미 정의--/")
			,"OBJALIGN"=>array("CLEARTEXT","/--미 정의--/")
			,"CRYPTCD"=>array("CLEARTEXT","/--미 정의--/")
			,"VALIDSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"PIYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G6-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G6-XML"]
		,"COLORD"=>"PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"CFGSEQ"=>array("NUMBER",30)	
			,"USEYN"=>array("STRING",1)	
			,"CFGID"=>array("STRING",30)	
			,"CFGNM"=>array("STRING",100)	
			,"MVCGBN"=>array("STRING",30)	
			,"PATH"=>array("STRING",300)	
			,"CFGORD"=>array("NUMBER",30)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"CFGSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"CFGID"=>array("CLEARTEXT","/--미 정의--/")
			,"CFGNM"=>array("CLEARTEXT","/--미 정의--/")
			,"MVCGBN"=>array("CLEARTEXT","/--미 정의--/")
			,"PATH"=>array("SAFETEXT","/--미 정의--/")
			,"CFGORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
$REQ["G7-XML"] = filterGridXml(
	array(
		"XML"=>$REQ["G7-XML"]
		,"COLORD"=>"PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT"
		,"VALID"=>
			array(
			"PJTSEQ"=>array("NUMBER",20)	
			,"FILESEQ"=>array("STRING",0)	
			,"MKFILETYPE"=>array("STRING",0)	
			,"MKFILETYPENM"=>array("STRING",0)	
			,"MKFILEFORMAT"=>array("STRING",0)	
			,"MKFILEEXT"=>array("STRING",0)	
			,"TEMPLATE"=>array("STRING",0)	
			,"FILEORD"=>array("STRING",0)	
			,"USEYN"=>array("STRING",1)	
			,"ADDDT"=>array("STRING",14)	
			,"MODDT"=>array("STRING",14)	
					)
		,"FILTER"=>
			array(
			"PJTSEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"FILESEQ"=>array("REGEXMAT","/^[0-9]+$/")
			,"MKFILETYPE"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILETYPENM"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILEFORMAT"=>array("CLEARTEXT","/--미 정의--/")
			,"MKFILEEXT"=>array("CLEARTEXT","/--미 정의--/")
			,"TEMPLATE"=>array("CLEARTEXT","/--미 정의--/")
			,"FILEORD"=>array("REGEXMAT","/^[0-9]+$/")
			,"USEYN"=>array("REGEXMAT","/^[a-zA-Z]{1}[a-zA-Z0-9]*$/")
			,"ADDDT"=>array("REGEXMAT","/^[0-9]+$/")
			,"MODDT"=>array("REGEXMAT","/^[0-9]+$/")
					)
	)
);
	
array_push($_RTIME,array("[TIME 40.REQ_VALID]",microtime(true)));
	//서비스 클래스 생성
$objService = new pgmmngService();
	//컨트롤 명령별 분개처리
alog("ctl:" . $ctl);
switch ($ctl){
			case "G3_SEARCH" :
  		echo $objService->goG3Search(); //PJT, 조회
  		break;
	case "G3_SAVE" :
  		echo $objService->goG3Save(); //PJT, 저장
  		break;
	case "G4_SEARCH" :
  		echo $objService->goG4Search(); //PGM, 조회
  		break;
	case "G4_SAVE" :
  		echo $objService->goG4Save(); //PGM, 저장
  		break;
	case "G5_SEARCH" :
  		echo $objService->goG5Search(); //DD, 조회
  		break;
	case "G5_SAVE" :
  		echo $objService->goG5Save(); //DD, 저장
  		break;
	case "G6_USERDEF" :
  		echo $objService->goG6Userdef(); //CONFIG, 사용자정의
  		break;
	case "G6_SEARCH" :
  		echo $objService->goG6Search(); //CONFIG, 조회
  		break;
	case "G6_SAVE" :
  		echo $objService->goG6Save(); //CONFIG, 저장
  		break;
	case "G6_EXCEL" :
  		echo $objService->goG6Excel(); //CONFIG, 엑셀다운로드
  		break;
	case "G7_USERDEF" :
  		echo $objService->goG7Userdef(); //FILE, 사용자정의
  		break;
	case "G7_SEARCH" :
  		echo $objService->goG7Search(); //FILE, 조회
  		break;
	case "G7_SAVE" :
  		echo $objService->goG7Save(); //FILE, 저장
  		break;
	case "G7_EXCEL" :
  		echo $objService->goG7Excel(); //FILE, 엑셀다운로드
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

alog("PgmmngControl___________________________end");

?>	