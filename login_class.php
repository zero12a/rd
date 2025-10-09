<?php

class loginObject
{

    private $db;

	//생성자
	function __construct(){
        alog("authLog-__construct");
        global $CFG;

        //DB연결 정보 생성
        $this->db = getDbConn($CFG["CFG_DB"]["RDCOMMON"]);

	}
	//파괴자
	function __destruct(){
		alog("authLog-__destruct");

        closeDb($this->db);
    }

    function setAuth(&$objAuth,&$objLogin,$REQ){
        alog("setAuth().....................start");


        alog("setAuth().....................end");
    }

    function getUserInfo($REQ){
        alog("getUserInfo().....................start");
        $coltype = "s";
        $sql = "
            SELECT
                USR_SEQ, USR_ID, USR_NM, USR_PWD, PW_ERR_CNT
                , LOCK_LIMIT_DT, LDAP_LOGIN_YN
            FROM CMN_USR 
            WHERE USE_YN = 'Y' and USR_ID = #{F_EMAIL}
        ";
        
        $stmt = makeStmt($this->db,$sql,$coltype,$REQ);
        
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
        
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $this->db->errno . " -> " . $this->db->error);
        
        alog("getUserInfo().....................end");
        return $stmt->get_result();        

    }

    function getUserAuthArray($REQ){
        alog("getUserAuthArray().....................start");
        //global $db,$REQ;
        $sql = "
        select
        *
        from
        (
            /* default auth */
            select PGMID, AUTH_ID
            from CMN_DEFAULT_AUTH
            union
            /* group auth */
            select b.PGMID as PGMID, b.AUTH_ID as AUTH_ID
            from CMN_GRP_USR a
                join CMN_GRP_AUTH b on a.GRP_SEQ = b.GRP_SEQ
                join CMN_MNU c on b.PGMID = c.PGMID
            where a.USR_SEQ = #{USR_SEQ}
            and c.PGMTYPE IN (
                    select PGMTYPE from CMN_IP where ALLOW_IP = #{REMOTE_ADDR} or ALLOW_IP = '0.0.0.0'
                )
            union
            /* team auth */
            select a2.PGMID as PGMID, a2.AUTH_ID as AUTH_ID
            from CMN_TEAM_AUTH a2
                join CMN_MNU b2 on a2.PGMID = b2.PGMID
            where a2.TEAM_SEQ = 
                (
                        select TEAM_SEQ from CMN_TEAM c2 
                            join CMN_USR d2 on c2.TEAMCD = d2.TEAMCD and d2.USR_SEQ = #{USR_SEQ} 
                        where d2.TEAMCD is not null and d2.TEAMCD <> ''
                )
            and b2.PGMTYPE IN (
                    select PGMTYPE from CMN_IP where ALLOW_IP = #{REMOTE_ADDR} or ALLOW_IP = '0.0.0.0'
                )
        ) uniondata
        order by PGMID, AUTH_ID
        ";
        $coltype = "isis";


        $stmt = makeStmt($this->db,$sql,$coltype,$REQ);
        
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
        
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $this->db->errno . " -> " . $this->db->error);
        
    
        $tArr =  getStmtArray($stmt);
        $stmt->close();
    
        $lastPgmid = "";
        $rtnVal = null;
        for($i=0;$i<count($tArr);$i++){
            $tMap = $tArr[$i];
            if($lastPgmid != $tMap["PGMID"]){
                $rtnVal[$tMap["PGMID"]] = array();
                $j=0;          
            }else{
                $j++;        
            }
            $rtnVal[$tMap["PGMID"]][$j] = $tMap["AUTH_ID"];
            $lastPgmid = $tMap["PGMID"];
        }
        
        alog("getUserAuthArray().....................end");
        return $rtnVal;
    }


    function getMyGrpIntroUrl($REQ){
        alog("getMyGrpIntroUrl().....................start");

        //global $db,$REQ;
        $coltype = "i";
        $sql = "
            select c.PGMID, c.MNU_SEQ, c.MNU_NM, c.URL
            from CMN_GRP_USR a
                join CMN_GRP b on a.GRP_SEQ = b.GRP_SEQ
                join CMN_MNU c on b.INTRO_PGMID = c.PGMID
            where a.USR_SEQ = #{USR_SEQ}
        ";
        
        $stmt = makeStmt($this->db,$sql,$coltype,$REQ);
        
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
        
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $this->db->errno . " -> " . $this->db->error);
        
    
        $tArr =  getStmtArray($stmt);
        $stmt->close();

        alog("getMyGrpIntroUrl().....................end");
        return $tArr;
    }


    function saveLoginLog($REQ){
        //global $db, $_SERVER;
        alog("saveLoginLog().....................start");

        $coltype = "sssss isiss ss";
        $sql = "
            insert into CMN_LOG_LOGIN ( 
                USR_ID, SESSION_ID, SUCCESS_YN, RESPONSE_MSG, LOCKCD
                , PW_ERR_CNT, LOCK_LIMIT_DT, USR_SEQ, SERVER_NAME, REMOTE_ADDR
                , USER_AGENT, AUTH_JSON
                , ADD_DT
            ) values (
                #{USR_ID}, #{SESSION_ID}, #{SUCCESS_YN}, #{RESPONSE_MSG}, #{LOCKCD}
                , #{PW_ERR_CNT}, #{LOCK_LIMIT_DT},#{USR_SEQ}, #{SERVER_NAME}, #{REMOTE_ADDR}
                , #{USER_AGENT}, #{AUTH_JSON}
                , date_format(sysdate(),'%Y%m%d%H%i%s')
            ) 
        ";
        
        $stmt = makeStmt($this->db,$sql,$coltype,$REQ);
        
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 생성 실패 했습니다.");
        
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패 " .  $stmt->error);
        
        alog("saveLoginLog().....................end");        
        return  $db->insert_id;
    }


    //
    function ldapLoginSuccessUserAdd($REQ){
        alog("ldapLoginSuccessUserAdd().....................start");
        //이미 등록된 사용자 인지 확인하기

        $sql = "insert into CMN_USR (
            USR_ID, USR_NM, PHONE, USE_YN, USR_PWD
            , PW_ERR_CNT, LAST_STATUS, LOCK_LIMIT_DT, LOCK_LAST_DT, EXPIRE_DT
            , PW_CHG_DT, PW_CHG_ID, LDAP_LOGIN_YN, TEAMCD, TEAMNM
            , EMAIL
            , ADD_DT, ADD_ID
            ) values (
                #{USR_ID}, #{USR_NM}, #{PHONE}, 'Y', null
                ,0, null, null, null, null
                , null, null, 'Y', #{TEAMCD}, #{TEAMNM}
                , #{EMAIL}
                , date_format(sysdate(),'%Y%m%d%H%i%s'), 0
            )
            ";
        $coltype = "sssss s";

        $sqlMap = getSqlParam($sql,$coltype,$req);
        $stmt = getStmt($this->db,$sqlMap);
        if(!$stmt->execute())JsonMsg("500","102","(Save usr error) stmt 실행 실패 " .  $stmt->error);

        if($stmt instanceof PDOStatement){
            alog("SEQYN PDO : " . $this->db->lastInsertId());
            $newUserSeq = $this->db->lastInsertId(); //insert문인 경우 insert id받기                            
        }else{
            alog("SEQYN Mysqli : " . $this->db->insert_id);
            $newUserSeq = $this->db->insert_id; //insert문인 경우 insert id받기
        }

        closeStmt($stmt);

        alog("ldapLoginSuccessUserAdd().....................end");
        return $newUserSeq;
    }


    //
    function ldapLoginSuccessUserMod($REQ){
        alog("ldapLoginSuccessUserMod().....................start");

        //기존사용자 로그인 성공시 비번오류 및 잠금해제 초기화 
        $sql = "update CMN_USR set
                USR_NM = #{USR_NM}, PHONE = #{PHONE}, TEAMCD = #{TEAMCD}, TEAMNM = #{TEAMNM}, EMAIL = #{EMAIL}
                , PW_ERR_CNT = 0, LOCK_LIMIT_DT = null, LOCK_LAST_DT = null
                , MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s'), MOD_ID = 0
            where USR_SEQ = #{USR_SEQ}
        ";
        $coltype = "sssss i";
        
        $sqlMap = getSqlParam($sql,$coltype,$REQ);
        $stmt = getStmt($this->db,$sqlMap);
        if(!$stmt->execute())JsonMsg("500","102","(Save usr error) stmt 실행 실패 " .  $stmt->error);

        //usr_SEQ 알아오기
        closeStmt($stmt);

        alog("ldapLoginSuccessUserMod().....................end");
    }


    //비밀번호가 일치한 경우 틀린횟수 클리어
    function pwClearFailCnt($REQ){
        alog("pwClearFailCnt().....................start");

        //비번틀림 및 잠금정보 초기화        
        $coltype = "is";
        $sql = "
            UPDATE  CMN_USR SET 
                PW_ERR_CNT = 0, LOCK_LIMIT_DT = null, LOCK_LAST_DT = null
                , MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
                , MOD_ID = #{USR_SEQ}
            WHERE USR_ID = #{F_EMAIL} 
        ";

        $stmt = makeStmt($this->db,$sql,$coltype,$REQ);
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);

        alog("pwClearFailCnt().....................end");
    }

    //패스워드 오류 로직 처리 (PW오류횟수 및 잠금 시간 처리)
    function loginFailUserAdd($REQ){
        alog("loginFailUserAdd().....................start");
        alog("  USR_ID = " . $REQ["USR_ID"]);
        //등록된 사용자가 아니라고 하면 빈 사용자 사번 추가(pw 실패 기록관리)
        $REQ["PHONE"] = "";
        $REQ["EMAIL"] = "";
        $REQ["TEAMCD"] = "";
        $REQ["TEAMNM"] = "";

        $sql = "insert into CMN_USR (
            USR_ID, USR_NM, PHONE, USE_YN, USR_PWD
            , PW_ERR_CNT, LAST_STATUS, LOCK_LIMIT_DT, LOCK_LAST_DT, EXPIRE_DT
            , PW_CHG_DT, PW_CHG_ID, LDAP_LOGIN_YN, TEAMCD, TEAMNM
            , EMAIL
            , ADD_DT, ADD_ID
            ) values (
                #{USR_ID}, #{USR_NM}, #{PHONE}, 'Y', null
                ,1, null, null, null, null
                , null, null, 'Y', ifnull(#{TEAMCD},''), ifnull(#{TEAMNM},'')
                , #{EMAIL}
                , date_format(sysdate(),'%Y%m%d%H%i%s'), 0
            )
            ";
        $coltype = "sssss s";


        $sqlMap = getSqlParam($sql,$coltype,$REQ);
        $stmt = getStmt($this->db,$sqlMap);
        if(!$stmt->execute())JsonMsg("500","102","(Save usr error) stmt 실행 실패 " .  $stmt->error);
        
        if($stmt instanceof PDOStatement){
            alog("SEQYN PDO : " . $this->db->lastInsertId());
            $newUserSeq = $this->db->lastInsertId(); //insert문인 경우 insert id받기                            
        }else{
            alog("SEQYN Mysqli : " . $this->db->insert_id);
            $newUserSeq = $this->db->insert_id; //insert문인 경우 insert id받기
        }

        return $newUserSeq;
        alog("loginFailUserAdd().....................end");
    }





    //패스워드 오류 로직 처리 (PW오류횟수 및 잠금 시간 처리)
    function loginFailUserMod($REQ){
        alog("loginFailUserMod().....................start");
        alog("  OLD.PW_ERR_CNT = " . $REQ["PW_ERR_CNT"]);

        //비밀번호가 일치하지 않는 경우 (5번 5분, 10번 10분)
        $REQ["LOCK_LIMIT_DT"] = "";
        if($REQ["PW_ERR_CNT"]+1 == 5){
            $REQ["LOCK_LIMIT_DT"] = date("YmdHis", mktime(date("H"), date("i")+5, date("s"), date("m")  , date("d"), date("Y")) );
        }else if($REQ["PW_ERR_CNT"]+1 == 10){
            $REQ["LOCK_LIMIT_DT"] = date("YmdHis", mktime(date("H"), date("i")+10, date("s"), date("m")  , date("d"), date("Y")) );      
        }else if($REQ["PW_ERR_CNT"]+1 == 15){
            $REQ["LOCK_LIMIT_DT"] = date("YmdHis", mktime(date("H")+1, date("i"), date("s"), date("m")  , date("d"), date("Y")) );      
        }else if($REQ["PW_ERR_CNT"]+1 >= 20){
            $REQ["LOCK_LIMIT_DT"] = date("YmdHis", mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y")) );      
        }else{
            //처리 없음
        }

        $responseMsg = "";
        if( $REQ["LOCK_LIMIT_DT"] != ""){
            //[기존유저] 잠금 처리
            $coltype = "sis";
            $sql = "
                UPDATE  CMN_USR SET 
                    PW_ERR_CNT = PW_ERR_CNT + 1,  LOCK_LIMIT_DT = #{LOCK_LIMIT_DT}
                    , LOCK_LAST_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
                    , MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
                    , MOD_ID = #{USR_SEQ}
                WHERE USR_ID = #{F_EMAIL} 
            ";
            $responseMsg = "ID EXIST, NO LOCK, GO LOCK, PW NOT EQUAL."; 	


        }else{
            //[기존유저] PW 오류 카운트 증가        
            $coltype = "is";
            $sql = "
                UPDATE  CMN_USR SET 
                    PW_ERR_CNT = PW_ERR_CNT + 1
                    , MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s')
                    , MOD_ID = #{USR_SEQ}
                WHERE USR_ID = #{F_EMAIL} 
            ";
            $responseMsg = "ID EXIST, NO LOCK, GO PW_ERR_CNT, PW NOT EQUAL."; 	
       
        }

        $stmt = makeStmt($this->db,$sql,$coltype,$REQ);
        if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");
        if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);     

        return $responseMsg;
    }

}