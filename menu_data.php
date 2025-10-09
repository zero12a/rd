<?php
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control:no-cache");
    header("Pragma:no-cache");


    require_once("../c.g/include/incUtil.php");
    require_once("../c.g/incConfig.php");
    require_once("../c.g/include/incDB.php");
    require_once("../c.g/include/incUser.php");



    //ServerViewTxt("N","N","Y","Y");

    $db=db_s_open();

    echo '
<?xml version="1.0" encoding="utf-8"?>
<tree id="0" radio="1">
';
    
alog("---------------GRP PGM ---------------------START");

    //folder 가져오기
    $to_coltype = "";
    alog("       1 to_coltype : " . $to_coltype);
    $sql = "
    select folder_seq,folder_nm from CMN_FOLDER where use_yn='Y' order by folder_ord asc
        ";
    alog("       1 selected : " );

    $REQ = null;
    $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
    if(!$stmt)   JsonMsg("500","108","stmt 생성 실패" . $db->errno . " -> " . $db->error);
    //var_dump( make_grid_read_array($stmt) );

    $tResultArrayFolder = make_grid_read_array($stmt);
    foreach($tResultArrayFolder->RTN_DATA->data as $tFolder) {

        echo '  <item   text="' . $tFolder["folder_nm"] . '" id="' . $tFolder["folder_seq"] . '" open="1">' . PHP_EOL;


        //menu 가져오기
        $to_coltype = "iis";
        alog("      2  to_coltype : " . $to_coltype);
        $sql = "
          select mnu_seq,mnu_nm,url 
          from CMN_MNU a
            join (
                    select PGMID from
                        CMN_GRP_USR b
                        join CMN_GRP_AUTH c on b.GRP_SEQ = c.GRP_SEQ
                    where b.USR_SEQ = #USR_SEQ#
                    group by PGMID
                ) d on a.PGMID = d.PGMID
          where folder_seq = #folder_seq# 
                and PGMTYPE in (
                    select PGMTYPE from CMN_IP where IP = #REMOTE_ADDR#
                )
          order by mnu_ord asc
              ";
        alog("      2  selected : " );
    
        $REQ["folder_seq"] = $tFolder["folder_seq"];
        $REQ["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"];        
        $REQ["USR_SEQ"] = getUserSeq();
        

        $stmt = make_stmt($db,$sql, $to_coltype, $REQ);
        if(!$stmt)   JsonMsg("500","108","stmt 생성 실패" . $db->errno . " -> " . $db->error);
        //var_dump( make_grid_read_array($stmt) );
    
        alog("      3  selected : " );
        $tResultArrayMenu = make_grid_read_array($stmt);
        //var_dump($tResultArrayMenu);
        alog("      3  selected : " );
        foreach($tResultArrayMenu->RTN_DATA->data as $tMenu) {
            echo '      <item text="' . $tMenu["mnu_nm"] . '" id="' . $tMenu["mnu_seq"] . ":" .$CFG_PGM_URL_ROOT . $tMenu["url"] . '"></item>' . PHP_EOL;
        }

        echo '  </item>' . PHP_EOL;
    }





   
    $db->close();
?>        
</tree>