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

	//로그인 검사
    require_once("../c.g/include/incLoginCheck.php");//로그인 검사

    //세션에서 인트로URL 가져오기
    $arrIntro = getIntroUrl();

    $CFG_PGM_URL_ROOT = "/c.g/CG/";
    //마지막 로그인 정보 가져오기

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

	
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$CFG_PROJECT_NAME?></title>
    <link rel="stylesheet" href="/lib/bootstrap4/css/bootstrap.min.css">


    <script src="/lib/bootstrap4/jquery-3.4.1.slim.min.js"></script>
    <script src="/lib/bootstrap4/js/bootstrap.min.js"></script>

    <!-- 아이콘-->
    <script src="/lib/feather.min.js"></script>

    <style>
    
    body, html {
        height: 100%;
        padding:0px 0px 0px 0px;
        margin:0px 0px 0px 0px;
        overflow:auto;
    }
    .BODY_BOX {
        overflow:visible;
        width:100%;
        height:100%;
        padding:0px 0px 0px 0px;
        margin:0px 0px 0px 0px;
        z-index:1;
        font-family: "Nanum Gothic", sans-serif;
    }
    
    .tab-iframe{
        padding:0px 0px 0px 0px;
    }



    /* 활성화 탭 생상 변경 */
    .nav-tabs .nav-link.active{
        background-color:silver;
        border-color: silver;
    }

    /* 좌측 메뉴 사이즈 고정 */
    .col-pixel-width { flex: 0 0 200px; }

    </style>
    <script>
    function alog(tLog){
        if(typeof console == "object")console.log(tLog);
    }

    function tabClose(tmpId){
        //alert(tmpId + "-close click");
        $( "#" + tmpId + "-li" ).remove();
        $( "#" + tmpId + "-content" ).remove();

        //첫번째 tab 활성화
        $('#myTab2 a').removeClass('active'); //탭선택 모두 제거
        $("#myTab2 a:first").addClass('active'); //탭선택 

        //컨텐츠 active show
        $('#myTabContent div').removeClass('active show'); //탭선택 모두 제거            
        $("#myTabContent div:first").addClass('active show'); //탭선택 

        //alert("close 처리 완료");

    }

    function tabOpen(id, nm, url){
        alog("tabOpen................................start");
        //$(this).closest('li').before('<li><a href="#contact_' + id + '">New Tab</a> <span>x</span></li>');
        var closeTxt = '<button onclick="tabClose(\'' + id + '\');" id="' + id + '-close" type="button" class="close small" style="padding-left:10px;" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

        $('#myTab2').append('<li id="' + id + '-li" class="nav-item"><a class="nav-link" id="' + id + '-tab" data-toggle="tab" href="#' + id + '-content" role="tab" aria-controls="' + id + '-content" aria-selected="false">' + nm + ' ' + closeTxt + '</a></li>');
        $('#myTabContent').append('<div class="tab-pane tab-iframe" id="' + id + '-content" role="tabpanel" aria-labelledby="' + id + '-tab"  style="background-color:green;height:inherit;"><iframe frameborder=”0″ marginwidth=”0″ marginheight=”0″ style="background-color:white;height:100%;width:100%;border-width:1px;border-color:silver;" id="' + id + '-iframe" src=""></iframe></div>');
        
        imestampSecond = Math.floor(+ new Date() / 1000);            
        $("#" + id + "-iframe").attr('src', url + "?" + imestampSecond);
        alog("tabOpen................................end");        
    }

    $( document ).ready(function() {
        alog("document.ready............................start");

        $("#menu a").click(function (e){
            //alert("inbox click");
            //alert($(this).attr("id"));
            var id = $(this).attr("id");
            var nm = $(this).text();
            var url = $(this).attr("my-url");
            //alert(id);
            //alert($("#" + id + "-li").attr("class"));
            if($(this).attr("id") == undefined)return; //ID 없으면 폴더임.

            //동일 ID의 탭이 없으면 생성
            if($("#" + id + "-li").attr("class") == undefined){
                tabOpen(id,nm,url);            
            }
            //탭 active
            $('#myTab2 a').removeClass('active'); //탭선택 모두 제거
            $("#" + id + "-tab").addClass('active'); //탭선택 

            //컨텐츠 active show
            $('#myTabContent div').removeClass('active show'); //탭선택 모두 제거            
            $("#" + id + "-content").addClass('active show'); //탭선택 
            //alert(1);
        });
        $('#myTab2 a').click(function (e) {
            e.preventDefault();
        
            var url = $(this).attr("data-url");
            
            var href = this.hash;
            var pane = $(this);
            
            imestampSecond = Math.floor(+ new Date() / 1000);

            $("#iframe1").attr('src', url + "?" + imestampSecond);

            $('myTab2 li').removeClass('active');
            $(this).addClass('active');
            // ajax load from data-url
            //$(href).load(url,function(result){      
            //pane.tab('show');
            //});
        });

        //alert( "document ready!" );
        feather.replace();

    //인프로 URL 열기
    <?php
    for($i=0;$i<sizeof($arrIntro);$i++){
        ?>

        id = "mnu_<?=$arrIntro[$i]["MNU_SEQ"]?>";
        nm = "<?=$arrIntro[$i]["MNU_NM"]?>";
        url = "<?=$CFG_PGM_URL_ROOT . $arrIntro[$i]["URL"]?>";
        
        tabOpen(id,nm,url);
        <?php

        //첫번째 탭 오픈 시키기
        if($i == 0){
        ?>
            
        //컨텐츠 active show
        //$('#myTabContent div').removeClass('active show'); //탭선택 모두 제거       

        $("#" + id + "-tab").addClass('active'); //탭 활성화    
        $("#" + id + "-content").addClass('active show'); //탭컨텐츠 활성화             
        <?php
        }
                
    }
    ?>
        alog("document.ready............................end");
    });

    function menuToggle(){
        //alert($("#divMenu").css("display"));
        if($("#divMenu").css("display") != "none"){
            $("#divMenu").css("display","none");
            $("#divLogo").css("display","none");
        }else{
            $("#divMenu").css("display","");
            $("#divLogo").css("display","");
        }
        //alert($("#divMenu").css("display"));
    }

    </script>
            
</head>

<body>
<div id="BODY_BOX" class="BODY_BOX">
    
    <div class="row container-fluid p-0 m-0">
        <div id="divLogo" class="col-pixel-width border-bottom border-right border-dark" style="background-color:gray;height:40px;z-index:2;padding:6px 10px 0px 10px;">
            <div class="d-inline font-weight-bold"><?=$CFG_PROJECT_NAME?> </div>     
        </div>
        <div class="col text-right border-bottom border-dark"
         style="font-size:9pt;background-color:gray;height:40px;z-index:2;padding:8px 20px 0px 10px;">
            <div class="d-inline float-left">
                <a href="#" onclick="menuToggle()" >
                        <i style="padding-left:0px;padding-top:0px;"
                        color="silver" 
                        width="24"
                        height="24"
                        data-feather="menu"></i>
                    </a>
            </div>        
            <div class="d-inline float-right">
                <b><?=getUserNm()?></b>님 어서 오세요. 최근 <b><?=$RecentRemoteAddr?></b>에서 로그인 시간은 
                <b><?=getFullDate($RecentAddDt,".",":")?></b>입니다.
                [<a href="logout.php"><i style="padding-left:0px;padding-top:0px;"
                        color="silver" 
                        width="24"
                        height="24"
                        data-feather="log-out"></i></a>]
            </div>        


        </div>
    </div>
    <div class="fixed-top container-fluid h-100 m-0" style="padding-top:40px;z-index:1;">
        <div class="row h-100">
            <div id="divMenu" class="col-pixel-width h-100 p-0 border-right border-dark overflow-auto">
                <div class="panel list-group" id="menu">
                <?php


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

                    //echo '  <item   text="' . $tFolder["folder_nm"] . '" id="' . $tFolder["folder_seq"] . '" open="1">' . PHP_EOL;

                    ?>
                    <!-- list-group-item 0-->
                    <a href="#" class="list-group-item rounded-0" data-toggle="collapse"
                     data-target="#folder_<?=$tFolder["folder_seq"]?>" data-parent="#menu"><i style="padding-left:0px;padding-top:0px;"
                    color="silver" 
                    width="20"
                    height="20"
                    data-feather="folder"></i> <span class="align-middle"><?=$tFolder["folder_nm"]?></span>
                    </a>
                        <!-- list-group-item start-->
                        <div id="folder_<?=$tFolder["folder_seq"]?>" class="sublinks collapse">

                        <?php
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
                        order by mnu_ord asc, mnu_nm asc
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
                            //echo '      <item text="' . $tMenu["mnu_nm"] . '" id="' . $tMenu["mnu_seq"] . ":" .$CFG_PGM_URL_ROOT . $tMenu["url"] . '"></item>' . PHP_EOL;

                            ?>
                            <!-- list-group-item 0-->
                            <a id="mnu_<?=$tMenu["mnu_seq"]?>" href="#" my-url="<?=$CFG_PGM_URL_ROOT . $tMenu["url"]?>" class="list-group-item small rounded-0"><i style="padding-left:0px;padding-top:0px;"
                                color="silver" 
                                width="20"
                                height="20"
                                data-feather="chevron-right"></i> <?=$tMenu["mnu_nm"]?>
                            </a>                            
                            <?php

                        }

                        echo '</div>' . PHP_EOL;
                    }

                    $db->close();
                    unset($objAuth);    
                    ?>

                </div>                
            </div>
            <div class="col h-100 p-0">
                <ul class="nav nav-tabs nav-tabs-mystyle" id="myTab2" role="tablist">
                    
                </ul>
                <div class="tab-content h-100" id="myTabContent" style="padding-bottom:40px;">
                    
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>