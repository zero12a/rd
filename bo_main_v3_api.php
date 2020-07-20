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

//로그인 검사
require_once("../common/include/incLoginCheck.php");//로그인 검사

//로거
$reqToken = reqGetString("TOKEN",37);
$CTL = reqGetString("CTL",20);
$resToken = uniqid();
$log = getLogger(
    array(
    "LIST_NM"=>"log_CG"
    , "PGM_ID"=>"BO_MAIN_V2"
    , "REQTOKEN" => $reqToken
    , "RESTOKEN" => $resToken
    , "LOG_LEVEL" => Monolog\Logger::DEBUG
    )
);

if($CTL == "getMenu"){

    $db = getDbConn($CFG["CFG_DB"]["OS"]);
    $sql = "select 
        mnu1_seq as mnu1_seq
        , mnu_id as id
        , mnu_nm as nm
        , mnu_url as url
        , mnu_icon as icon
        from CMN_MNU1 
        order by MNU_ORD asc
        ";
    
    $sqlMap = getSqlParam($sql,$coltype="",$REQ);
    $stmt = getStmt($db,$sqlMap);
    $mnu1Info = getStmtArray($stmt);
    closeStmt($stmt);


    for($i=0;$i<count($mnu1Info);$i++){
        //echo $i . PHP_EOL;
        $sql = "select 
        mnu2_seq as mnu2_seq
        , mnu_id as id
        , mnu_nm as nm
        , mnu_url as url
        , mnu_icon as icon
        from CMN_MNU2
        where MNU1_SEQ = #{MNU1_SEQ} 
        order by MNU_ORD asc
        ";
    
        $REQ = array();
        alog("mnu1_seq = " . $mnu1Info[$i]["mnu1_seq"]);
        $REQ["MNU1_SEQ"] = $mnu1Info[$i]["mnu1_seq"];

        $sqlMap = getSqlParam($sql,$coltype="i",$REQ);
        $stmt = getStmt($db,$sqlMap);
        $mnu2Info = getStmtArray($stmt);
        closeStmt($stmt);
        if(sizeof($mnu2Info) > 0){
            $mnu1Info[$i]["submenus"] = $mnu2Info;
            //$mnu1Info[$i]["submenu_cnt"] = sizeof($mnu2Info);
        }else{
            $mnu1Info[$i]["submenus"] = array();
            //$mnu1Info[$i]["submenu_cnt"] = "0";
        }

    }

    echo json_encode($mnu1Info);

    closeDb($db);

}else if($CTL == "getUserInfo"){
    ?>
    {
        "infro":
            [
                {id:"tab1", nm:"nm1", url:"demo_webix.php"}
                ,{id:"tab2", nm:"nm2", url:"demo_webixtab.php"}
            ],
        "notice" : []
    }
    <?php
}else{
    ?>
    {"ctl":"not good"}
    <?php
}

?>