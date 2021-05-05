<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


$CFG = require_once("../common/include/incConfig.php");

require_once($CFG["CFG_LIBS_VENDOR"]);

require_once("../common/include/incUtil.php");
require_once("../common/include/incDB.php");
require_once("../common/include/incUser.php");
require_once("../common/include/incSec.php");    
require_once("../common/include/incRequest.php");
require_once("../common/include/incAuth.php");




//로그인 검사
require_once("../common/include/incLoginCheck.php");//로그인 검사

//로거
$reqToken = reqGetString("TOKEN",37);
$CTL = reqGetString("CTL",20);
$resToken = uniqid();
$log = getLogger(
    array(
    "LIST_NM"=>"log_CG"
    , "PGM_ID"=>"BO_MAIN_V3"
    , "REQTOKEN" => $reqToken
    , "RESTOKEN" => $resToken
    , "LOG_LEVEL" => Monolog\Logger::DEBUG
    )
);

if($CTL == "getMenu"){

    //권한 정보 세션에서 조회하기
    $authObj= new authObject();
    $authArray = $authObj->getUserAuth();
    //print_r($authArray);



    $db = getDbConn($CFG["CFG_DB"]["RDCOMMON"]);
    $sql = "select 
        mnu1_seq as mnu1_seq
        , m1.FOLDER_YN
        , m1.PGMID as id
        , case when m1.FOLDER_YN = 'Y' then 
                m1.FOLDER_NM
            else
                m.mnu_nm
            end
            as nm
        , m.url as url
        , mnu_icon as icon
        from CMN_MNU1 m1
            left outer join CMN_MNU m on m1.PGMID = m.PGMID
        order by m1.MNU_ORD asc
        ";
    
    $sqlMap = getSqlParam($sql,$coltype="",$REQ);
    $stmt = getStmt($db,$sqlMap);
    $mnu1Info = getStmtArray($stmt);
    //print_r($mnu1Info);
    closeStmt($stmt);

    //권한이 있는 메뉴만 인가배열에 추가하기
    $mnu1InfoAuthed = array();
    for($i=0;$i<count($mnu1Info);$i++){
        if( $mnu1Info[$i]["FOLDER_YN"] == "Y"){
            array_push($mnu1InfoAuthed,$mnu1Info[$i]);
        }else if( $mnu1Info[$i]["FOLDER_YN"] == "N" && count($authArray[$mnu1Info[$i]["id"]]) > 0 ){
            array_push($mnu1InfoAuthed,$mnu1Info[$i]);
        } 
    }

    for($i=0;$i<count($mnu1InfoAuthed);$i++){

        $mnu2InfoAuthed = array();
        if($mnu1InfoAuthed[$i]["FOLDER_YN"] == "Y"){
            //echo $i . PHP_EOL;
            $sql = "select 
            mnu2_seq as mnu2_seq
            , m2.PGMID as id
            , m.mnu_nm as nm
            , m.url as url
            from CMN_MNU2 m2
                left outer join CMN_MNU m on m2.PGMID = m.PGMID
            where MNU1_SEQ = #{MNU1_SEQ} 
            order by m2.MNU_ORD asc
            ";

            $REQ = array();
            alog("mnu1_seq = " . $mnu1InfoAuthed[$i]["mnu1_seq"]);
            $REQ["MNU1_SEQ"] = $mnu1InfoAuthed[$i]["mnu1_seq"];

            $sqlMap = getSqlParam($sql,$coltype="i",$REQ);
            $stmt = getStmt($db,$sqlMap);
            $mnu2Info = getStmtArray($stmt);
            closeStmt($stmt);
            if(sizeof($mnu2Info) > 0){

                //권한이 있는 메뉴만 인가배열에 추가하기

                for($t=0;$t<count($mnu2Info);$t++){
                    if( count($authArray[$mnu2Info[$t]["id"]]) > 0 ){
                        array_push($mnu2InfoAuthed,$mnu2Info[$t]);
                    } 
                }
            }

        }

        if( count($mnu2InfoAuthed) > 0 ){
            $mnu1InfoAuthed[$i]["submenus"] = $mnu2InfoAuthed;
            //$mnu1Info[$i]["submenu_cnt"] = sizeof($mnu2Info);
        }else{
            $mnu1InfoAuthed[$i]["submenus"] = array();
            //$mnu1Info[$i]["submenu_cnt"] = "0";
        }

    }

    echo json_encode($mnu1InfoAuthed);

    closeDb($db);

}else if($CTL == "getUserInfo"){

    $rtnVal = array();


    $db = getDbConn($CFG["CFG_DB"]["RDCOMMON"]);
    $sql = "
        select c.PGMID, c.MNU_SEQ, c.MNU_NM, c.URL, d.MSG_CNT
        from CMN_GRP_USR a
            join CMN_GRP b on a.GRP_SEQ = b.GRP_SEQ
            join CMN_MNU c on b.INTRO_PGMID = c.PGMID
            join ( select USR_SEQ, count(MSG_BOX_SEQ) as MSG_CNT from CMN_MSG_BOX where USR_SEQ = #{USR_SEQ} and READ_DT is null ) d on a.USR_SEQ = d.USR_SEQ
        where a.USR_SEQ = #{USR_SEQ}
    ";

    $REQ["USR_SEQ"] = getUserSeq(); //incUser.php
    $sqlMap = getSqlParam($sql,$coltype="ii",$REQ);
    $stmt = getStmt($db,$sqlMap);
    $arrIntroUrl = getStmtArray($stmt);
    closeStmt($stmt);

    //사용자ID 가져오기
    $rtnVal["UID"] = getUserId();

    //세션에서 인트로URL 가져오기
    $rtnVal["intro"] = $arrIntroUrl;

    //알림 목록 가져오기
    $rtnVal["msg_cnt"] = $arrIntroUrl[0]["MSG_CNT"];

    echo json_encode($rtnVal);

    closeDb($db);
}else{
    ?>
    {"ctl":"not good"}
    <?php
}

?>