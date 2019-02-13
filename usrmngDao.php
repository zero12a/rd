<?php
//DAO
 
class usrmngDao
{
	function __construct(){
		alog("UsrmngDao-__construct");
	}
	function __destruct(){
		alog("UsrmngDao-__destruct");
	}
	function __toString(){
		alog("UsrmngDao-__toString");
	}
	//회원목록    
	public function selUsrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select 
	USR_SEQ, USR_ID, USR_NM, '--hashed--' as USR_PWD, PW_CHG_DT, PHONE
	, PW_ERR_CNT, LAST_STATUS, USE_YN, ADD_DT, MOD_DT 
from CMN_USR 
where USR_ID like if(#{G1-USR_ID}='','%',#{G1-USR_ID})";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//회원등록    
	public function insUsrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "INSERT INTO CMN_USR(
	USR_ID, USR_NM, USR_PWD, ADD_DT, ADD_ID
) VALUES (
	#{USR_ID}, #{USR_NM}, #{USR_PWD}, date_format(sysdate(),'%Y%m%d%H%i%s'), 0
)";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sss";
		return $RtnVal;
    }  
	//비번변경    
	public function updUsrPwG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "update CMN_USR set
	USR_PWD = #{USR_PWD}, PW_CHG_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
where USR_ID = #{USR_ID}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ss";
		return $RtnVal;
    }  
	//회원상세    
	public function selUsrF($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "DATING";
		$RtnVal["SQLTXT"] = "select 
	USR_SEQ, USR_ID, USR_NM, '--Hashed--' as USR_PWD, PW_CHG_DT, PHONE
	, PW_ERR_CNT, LAST_STATUS, ADD_DT, MOD_DT 
from CMN_USR 
where USR_SEQ = #{G2-USR_SEQ}
";
	$RtnVal["REQUIRE"] = array("G2-USR_SEQ"	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
}
                                                             
?>