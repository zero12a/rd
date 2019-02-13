<?php
//DAO
 
class usermngDao
{
	function __construct(){
		alog("UsermngDao-__construct");
	}
	function __destruct(){
		alog("UsermngDao-__destruct");
	}
	function __toString(){
		alog("UsermngDao-__toString");
	}
	//사용자목록    
	public function selUserG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select 
 USERSEQ, EMAIL,'--Hashed--' as PASSWD, EMAILVALIDYN,LASTPWCHGDT
 , PWFAILCNT, LOCKYN, FREEZEDT, LOCKDT, SERVERSEQ
 , ADDDT, MODDT
from
 CG_USERS
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//사용자추가    
	public function insUserG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//사용자수정    
	public function updUserG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_USERS set
 EMAIL = #{EMAIL}, PWFAILCNT = #{PWFAILCNT}, LOCKYN = #{LOCKYN},LOCKDT = #{LOCKDT}
 , MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where USERSEQ = #{USERSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sissi";
		return $RtnVal;
    }  
	//프로젝목록    
	public function selPjtG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select
	USERSEQ, PJTSEQ, ADDDT, MODDT
from 
	CG_PJTUSER
where USERSEQ = #{G2-USERSEQ}
 ";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//서버록록    
	public function selSvrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select
	SVRSEQ,SVRID,SVRNM, PJTSEQ, USERSEQ
	,DBHOST,DBPORT,DBNAME,DBUSRID,DBUSRPW,USEYN
	,ADDDT, MODDT
from 
	CG_SVR
where USERSEQ = #{G2-USERSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//서버변경    
	public function updSvrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_SVR
set
	SVRNM = #{SVRNM}, USERSEQ = #{USERSEQ},DBHOST = #{DBHOST},DBPORT = #{DBPORT},DBNAME = #{DBNAME}
	,DBUSRID = #{DBUSRID},DBUSRPW = #{DBUSRPW},USEYN = #{USEYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where SVRSEQ = #{SVRSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sissssssi";
		return $RtnVal;
    }  
	//사용자비번변경    
	public function chgUserPwG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_USERS set
 PASSWD = #{PASSWD}
 , LASTPWCHGDT = date_format(sysdate(),'%Y%m%d%H%i%s')
where USERSEQ = #{USERSEQ}";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "si";
		return $RtnVal;
    }  
	//서버추가    
	public function insSvrG($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "INSERT INTO CG_SVR (
	SVRID,SVRNM,PJTSEQ,USERSEQ,DBHOST
	,DBPORT,DBNAME,DBUSRID,DBUSRPW,USEYN
	,ADDDT
)VALUES(
	#{SVRID},#{SVRNM},#{PJTSEQ}, #{USERSEQ},#{DBHOST}
	,#{DBPORT},#{DBNAME},#{DBUSRID},#{DBUSRPW},#{USEYN}
	,date_format(sysdate(),'%Y%m%d%H%i%s')
)";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssiissssss";
		return $RtnVal;
    }  
}
                                                             
?>