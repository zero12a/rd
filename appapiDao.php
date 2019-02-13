<?php
//DAO
 
class appapiDao
{
	function __construct(){
		alog("AppapiDao-__construct");
	}
	function __destruct(){
		alog("AppapiDao-__destruct");
	}
	function __toString(){
		alog("AppapiDao-__toString");
	}
	//조회    
	public function searchApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT
	 '0' AS ROWCHK,API_SEQ, API_NM, PGM_ID, URL 
	, REQ_ENCTYPE, REQ_DATATYPE, REQ_BODY, RES_BODY, MYFILE, MYFILESVRNM
	, ADD_DT, MOD_DT,'0' AS CHK
FROM 
	APP_API
WHERE DEL_YN='N'
ORDER BY API_SEQ DESC";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//상세    
	public function detailApi($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "SELECT
	API_SEQ, API_NM, PGM_ID, URL, REQ_BODY
	,REQ_ENCTYPE, REQ_DATATYPE, RES_BODY, MYFILE, concat('/c.g/up/',MYFILESVRNM) as MYFILE_link
	, '/c.g/up/PIC_171213122506BdIm.png:/c.g/up/PIC_171213122506BdIm.png,/c.g/up/PIC_171213122506BdIm.png:/c.g/up/PIC_171213122506BdIm.png' MYFILE_VIEWER
	, MYFILESVRNM, ADD_DT, MOD_DT
FROM 
	APP_API
WHERE DEL_YN='N'
	AND API_SEQ = #{G3-API_SEQ} ";
	$RtnVal["REQUIRE"] = array("G3-API_SEQ"	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//상세수정    
	public function updApi($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "UPDATE
	APP_API
SET 
	API_NM = #{F4-API_NM}
	,PGM_ID = #{F4-PGM_ID}
	,URL = #{F4-URL}
	,REQ_ENCTYPE = #{F4-REQ_ENCTYPE}
	,REQ_DATATYPE = #{F4-REQ_DATATYPE}
	,REQ_BODY = #{F4-REQ_BODY}
	,RES_BODY = #{F4-RES_BODY}
	,MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
WHERE API_SEQ = #{F4-API_SEQ} ";
	$RtnVal["REQUIRE"] = array("F4-API_NM"	);
		$RtnVal["BINDTYPE"] = "ssssssss";
		return $RtnVal;
    }  
	//상세삭제    
	public function delApi($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "UPDATE APP_API SET DEL_YN='Y' WHERE API_SEQ = #{F4-API_SEQ}
 ";
	$RtnVal["REQUIRE"] = array("F4-API_SEQ"	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//추가    
	public function insApi($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "INSERT INTO APP_API(
	API_NM, PGM_ID, URL, REQ_BODY, REQ_DATATYPE
	, REQ_ENCTYPE, RES_BODY, MYFILE, MYFILESVRNM
	, ADD_DT
) VALUES (
	#{F4-API_NM}, #{F4-PGM_ID}, #{F4-URL}, #{F4-REQ_BODY}, #{F4-REQ_DATATYPE}
	,#{F4-REQ_ENCTYPE},#{F4-RES_BODY}, #{F4-MYFILE_name}, #{F4-MYFILE_svr_name}
	,date_format(sysdate(),'%Y%m%d%H%i%s')
) ";
	$RtnVal["REQUIRE"] = array("F4-API_NM"	);
		$RtnVal["BINDTYPE"] = "sssssssss";
		return $RtnVal;
    }  
	//G상세수정    
	public function updApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "UPDATE
	APP_API
SET 
	API_NM = #{API_NM}
	,PGM_ID = #{PGM_ID}
	,URL = #{URL}
	,REQ_ENCTYPE = #{REQ_ENCTYPE}
	,REQ_DATATYPE = #{REQ_DATATYPE}
	,REQ_BODY = #{REQ_BODY}
	,RES_BODY = #{RES_BODY}
	,MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
WHERE API_SEQ = #{API_SEQ} ";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssssss";
		return $RtnVal;
    }  
	//목록추가    
	public function insApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "INSERT INTO APP_API(
	API_NM, PGM_ID, URL, REQ_BODY, REQ_DATATYPE
	, REQ_ENCTYPE, RES_BODY, MYFILE, MYFILESVRNM
	, ADD_DT
) VALUES (
	#{API_NM}, #{PGM_ID}, #{URL}, #{REQ_BODY}, #{REQ_DATATYPE}
	,#{REQ_ENCTYPE},#{RES_BODY}, #{MYFILE}, #{MYFILESVRNM}
	,date_format(sysdate(),'%Y%m%d%H%i%s')
)";
	$RtnVal["REQUIRE"] = array("API_NM"	);
		$RtnVal["BINDTYPE"] = "sssssssss";
		return $RtnVal;
    }  
	//삭제    
	public function delApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "UPDATE  APP_API SET DEL_YN ='Y' WHERE API_SEQ = #{API_SEQ}";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//완전삭제    
	public function delCompApiG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "DELETE FROM APP_API WHERE API_SEQ = #{API_SEQ}";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
}
                                                             
?>