<?php
//DAO
 
class pgmmngDao
{
	function __construct(){
		alog("PgmmngDao-__construct");
	}
	function __destruct(){
		alog("PgmmngDao-__destruct");
	}
	function __toString(){
		alog("PgmmngDao-__toString");
	}
	//PJT    
	public function sql1($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select
	PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL
	,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT
	,DELYN,ADDDT,MODDT 
from
 CG_PJTINFO	
where DELYN = 'N'
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "";
		return $RtnVal;
    }  
	//PJT    
	public function sql2($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_PJTINFO set DELYN = 'Y' where PJTSEQ = #{PJTSEQ} 
";
	$RtnVal["REQUIRE"] = array("PJTSEQ"	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//PJT    
	public function sql3($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_PJTINFO set 
PJTID = #{PJTID}, PJTNM = #{PJTNM},FILECHARSET = #{FILECHARSET}, UITOOL = #{UITOOL}
, SVRLANG = #{SVRLANG}, STARTDT = #{STARTDT}, ENDDT = #{ENDDT}
, DEPLOYKEY = #{DEPLOYKEY}, PKGROOT = #{PKGROOT}
, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
where PJTSEQ = #{PJTSEQ} 

";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssssssii";
		return $RtnVal;
    }  
	//PJT    
	public function sql4($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "insert into CG_PJTINFO (
	PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG
	,DEPLOYKEY,PKGROOT,STARTDT,ENDDT
	,ADDDT,ADDID
) values (
	#{PJTID},#{PJTNM},#{FILECHARSET},#{UITOOL},#{SVRLANG}
	, #{DEPLOYKEY},#{PKGROOT},#{STARTDT},#{ENDDT}
	,date_format(sysdate(),'%Y%m%d%H%i%s'),#{USER.SEQ}
	)
	";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssssssi";
		return $RtnVal;
    }  
	//PGM    
	public function sql6($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select PJTSEQ,PGMSEQ,PGMID,PGMNM,VIEWURL,PGMTYPE,POPWIDTH,POPHEIGHT,SECTYPE,PKGGRP,LOGINYN,ADDDT,MODDT 
from
 CG_PGMINFO	
where PJTSEQ = #{G3-PJTSEQ} 
 ";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//PGM    
	public function sql7($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "insert into CG_PGMINFO(
	 PJTSEQ, PGMID, PGMNM, PKGGRP, PGMTYPE
	, POPWIDTH, POPHEIGHT, SECTYPE, LOGINYN
	, ADDDT, ADDID
) values (
	 #{PJTSEQ},#{PGMID},#{PGMNM}, #{PKGGRP}, #{PGMTYPE}
	, #{POPWIDTH}, #{POPHEIGHT}, #{SECTYPE}, #{LOGINYN}
	 ,date_format(sysdate(),'%Y%m%d%H%i%s'),#{USER.SEQ}
) 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "issssssssi";
		return $RtnVal;
    }  
	//PGM    
	public function sql8($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update
 CG_PGMINFO
set 
 PGMNM = #{PGMNM}, PGMID = #{PGMID}, PKGGRP = #{PKGGRP}, PGMTYPE = #{PGMTYPE}
 , POPWIDTH = #{POPWIDTH}, POPHEIGHT = #{POPHEIGHT}, SECTYPE = #{SECTYPE}, LOGINYN = #{LOGINYN}
 , MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssssssiii";
		return $RtnVal;
    }  
	//PGM    
	public function sql9($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "delete from CG_PGMINFO
where PJTSEQ = #{PJTSEQ} and PGMSEQ = #{PGMSEQ} 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//DD    
	public function sql10($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select 
 a.PJTSEQ, a.DDSEQ, a.COLID, a.COLNM, a.COLSNM
 ,a.DATATYPE, a.DATASIZE, a.OBJTYPE, b.OBJTYPE as OBJTYPE_FORMVIEW, c.OBJTYPE as OBJTYPE_GRID
 ,a.LBLWIDTH, a.LBLHEIGHT, a.LBLALIGN, a.OBJWIDTH, a.OBJHEIGHT, a.OBJALIGN
 ,a.CRYPTCD, a.VALIDSEQ, a.PIYN
 ,a.ADDDT, a.MODDT
from CG_DD a
	left outer join CG_DDOBJ b on a.DDSEQ = b.DDSEQ and b.GRPTYPE = 'FORMVIEW'
	left outer join CG_DDOBJ c on a.DDSEQ = c.DDSEQ and c.GRPTYPE = 'GRID'
where PJTSEQ = #{G3-PJTSEQ} 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "i";
		return $RtnVal;
    }  
	//DD    
	public function sql11($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "insert into CG_DD (
	PJTSEQ, COLID, COLNM, COLSNM, DATATYPE
	, DATASIZE, OBJTYPE, LBLWIDTH, LBLHEIGHT, LBLALIGN,
	, OBJWIDTH, OBJHEIGHT, OBJALIGN, CRYPTCD, VALIDSEQ
	, PIYN
	, ADDDT, ADDID
) values (
	#{PJTSEQ}, #{COLID}, #{COLNM}, #{COLSNM}, #{DATATYPE}
	, #{DATASIZE}, #{OBJTYPE}, #{LBLWIDTH}, #{LBLHEIGHT}, #{LBLALIGN}
	, #{OBJWIDTH}, #{OBJHEIGHT}, #{OBJALIGN}, #{CRYPTCD}, #{VALIDSEQ}, if(#{PIYN}='','N',#{PIYN})
	,date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
) 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "issssissssssssissi";
		return $RtnVal;
    }  
	//DD    
	public function sql12($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_DD
set
	COLID = #{COLID}, COLNM = #{COLNM}, COLSNM = #{COLSNM}, DATATYPE = #{DATATYPE}, DATASIZE = #{DATASIZE}
	, OBJTYPE = #{OBJTYPE}, LBLWIDTH = #{LBLWIDTH}, LBLHEIGHT = #{LBLHEIGHT}, LBLALIGN = #{LBLALIGN}
	, OBJWIDTH = #{OBJWIDTH}, OBJHEIGHT = #{OBJHEIGHT}, OBJALIGN = #{OBJALIGN}, CRYPTCD = #{CRYPTCD}, VALIDSEQ = #{VALIDSEQ}
	, PIYN = #{PIYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
where PJTSEQ = #{PJTSEQ} and DDSEQ = #{DDSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ssssissssssssisiii";
		return $RtnVal;
    }  
	//DD    
	public function sql13($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "delete from CG_DD 
where PJTSEQ = #{PJTSEQ} and DDSEQ = #{DDSEQ} 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//CONFIG    
	public function impR($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "select 
 PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT
from CG_PJTCFG
where PJTSEQ = #{G3-PJTSEQ} 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//CONFIG    
	public function impC($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "insert into CG_PJTCFG (
 PJTSEQ, CFGID, CFGNM, MVCGBN, PATH
 , CFGORD, USEYN
 , ADDDT, ADDID
) values (
 #{PJTSEQ}, #{CFGID}, #{CFGNM}, #{MVCGBN}, #{PATH}
 , #{CFGORD}, #{USEYN}
 , date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
) 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "issssisi";
		return $RtnVal;
    }  
	//CONFIG    
	public function impU($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "update CG_PJTCFG set
	CFGID = #{CFGID}, CFGNM = #{CFGNM}, MVCGBN = #{MVCGBN}, PATH = #{PATH}, USEYN = #{USEYN}
	, CFGORD = #{CFGORD}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
where PJTSEQ = #{PJTSEQ} and CFGSEQ = #{CFGSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssiiii";
		return $RtnVal;
    }  
	//CONFIG    
	public function impD($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "D";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "delete from CG_PJTCFG
where PJTSEQ = #{PJTSEQ} and CFGSEQ = #{CFGSEQ} 
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "ii";
		return $RtnVal;
    }  
	//FILE    
	public function fileR($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "R";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "SELECT PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT
FROM CG_PJTFILE
WHERE PJTSEQ = #{G3-PJTSEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "s";
		return $RtnVal;
    }  
	//FILE    
	public function fileC($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "C";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "INSERT INTO CG_PJTFILE (
	PJTSEQ, MKFILETYPE, MKFILETYPENM, MKFILEFORMAT, MKFILEEXT
	, TEMPLATE, FILEORD, USEYN, ADDDT, ADDID
) VALUES (
	#{PJTSEQ}, #{MKFILETYPE}, #{MKFILETYPENM}, #{MKFILEFORMAT}, #{MKFILEEXT}
	,#{TEMPLATE}, #{FILEORD}, #{USEYN}, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
)";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "isssssssi";
		return $RtnVal;
    }  
	//FILE    
	public function fileU($req){
		//조회
		$RtnVal = null;
		$RtnVal["FNCTYPE"] = "U";//CRUD 
		$RtnVal["SVRID"] = "CG";
		$RtnVal["SQLTXT"] = "UPDATE CG_PJTFILE SET
	MKFILETYPE = #{MKFILETYPE}, MKFILETYPENM = #{MKFILETYPENM}, MKFILEFORMAT = #{MKFILEFORMAT}, MKFILEEXT = #{MKFILEEXT}, TEMPLATE = #{TEMPLATE}
	, FILEORD = #{FILEORD}, USEYN = #{USEYN}
	, MODDT = date_format(sysdate(),'%Y%m%d%H%i%s'), MODID = #{USER.SEQ}
WHERE PJTSEQ = #{PJTSEQ} AND FILESEQ = #{FILESEQ}
";
	$RtnVal["REQUIRE"] = array(	);
		$RtnVal["BINDTYPE"] = "sssssssiis";
		return $RtnVal;
    }  
}
                                                             
?>