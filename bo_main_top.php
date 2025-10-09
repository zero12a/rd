<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");

    require_once("../c.g/include/incUtil.php");
    require_once("../c.g/incConfig.php");
    require_once("../c.g/include/incDB.php");
    require_once("../c.g/include/incUser.php");
    require_once("../c.g/include/incSec.php");    
    require_once("../c.g/include/incRequest.php");


    //DB에서 마지막 로그인 정보 가져오기
    $db = db_obj_open(getDbSvrInfo("DATING"));

    $coltype = "ss";
    $sql = "
    select REMOTE_ADDR, ADD_DT from CMN_LOG_LOGIN
    where usr_seq = #{USR_SEQ}
        and login_seq = (
            select max(login_seq) 
            from CMN_LOG_LOGIN 
            where login_seq < #{LOGIN_SEQ} and success_yn = 'Y'
            )
        and success_yn = 'Y'
    ";
    $REQ["USR_SEQ"] = getUserSeq();    
    $REQ["LOGIN_SEQ"] = getLoginSeq();

    $stmt = makeStmt($db,$sql,$coltype,$REQ);

    if(!$stmt)JsonMsg("500","300","SQL makeStmt 실패 했습니다.");

    if(!$stmt->execute())JsonMsg("500","100","stmt 실행 실패" . $stmt->errno . " -> " . $stmt->error);

    $result = $stmt->get_result();

    //기본정보
    $REQ["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"]; 
    $REQ["SERVER_NAME"] = $_SERVER["SERVER_NAME"]; 
    $REQ["USER_AGENT"] = $_SERVER["HTTP_USER_AGENT"]; 
    $REQ["SESSION_ID"] = session_id(); 

    if($row = $result->fetch_array(MYSQLI_NUM))
    {
        $RecentRemoteAddr = $row[0];
        $RecentAddDt = $row[1];
    }
    //객체 해제
    $stmt->close();       
    $db->close();
    unset($objAuth);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>	
    <meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
    <link href="../c.g/common/common.css?313" rel="stylesheet" type="text/css" /><!--CSS/JS 불러오기-->
    <script src="../c.g/lib/jquery-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
    <script src="../c.g/lib/jquery-ui-1.11.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
    <link rel="stylesheet" href="../c.g/lib/jquery-ui-1.8.18.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
</head>
<body onload="alert('top onload');">
    <div id="BODY_BOX_TOP" class="BODY_BOX_TOP">
        <div class="GRP_OBJECT" style="width:30%;height:36px;font-size:20pt">
        <?=$CFG_PROJECT_NAME?>
        </div>
        <div class="GRP_OBJECT" style="width:70%;height:18px;text-align:right">
            <a href="logout.php">Logout</a>
        </div>
        <div class="GRP_OBJECT" style="width:70%;height:18px;text-align:right">
            <b><?=getUserNm()?></b>님 어서 오세요. 최근 <b><?=$RecentRemoteAddr?></b>에서 로그인 시간은 
            <b><?=getFullDate($RecentAddDt,".",":")?></b>입니다.
        </div>
    </div>
</body>
</html>