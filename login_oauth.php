<?php
$CFG = require_once("../common/include/incConfig.php");
?><!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>rd login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>/lib/bootstrap4/css/bootstrap.min.css">

    <!--부트스트랩 js -->

    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/bootstrap4/js/bootstrap.min.js"></script>

    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/uuidv4.js"></script>

    <!-- 아이콘-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/feather.min.js"></script>


    <!--dhmltx/공통-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/Chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->    
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
    <script src="/common/common.js"></script>


    <script language=javascript>

    var login_url = "http://localhost:8052/newToken/?";

    //post param nm : client_id, client_secret, username, password
    var client_id = "demoapp";
    var client_secret = "demopass";




    $( document ).ready( function() {
        //alog("페이지 준비 완료1");

        $( "#btnLogin" ).click(function() {
            //alert( "Login go." + $("#F_EMAIL").val()  );

            var req_token = uuidv4();
            //alert(req_token);

            //서버에서 DD가져오기
            $.ajax({
                type : "POST",
                url : login_url + "req_token=" + req_token,
                data : { "client_id" : client_id, "client_secret" : client_secret, "username" :  $("#F_EMAIL").val() , "password" :  $("#F_PASSWD").val()  },
                dataType: "json",
                success: function(data){
                    alog("   json return----------------------");
                    //alog("   json data : " + data);
                    alog("   json RTN_CD : " + data.RTN_CD);
                    alog("   json ERR_CD : " + data.ERR_CD);
                    alog("   json RTN_MSG : " + data.RTN_MSG);

                    //그리드 저장 처리
                    if(data.RTN_CD == "200" && data.ERR_CD == "200"){
                        //alert("로그인이 성공했습니다.");
                        //$(location).attr('href', "bo_main_v2.php");

                        $("#access_token").val(data.RTN_DATA.access_token);
                        $("#refresh_token").val(data.RTN_DATA.refresh_token);

                        $("#redirectForm").attr("action", "login_oauth_ok.php?req_token=" + req_token);
                        $("#redirectForm").first().submit();
                    }else{
                        alert("로그인이 실패했습니다." + data.RTN_MSG);
                    }
                },
                error: function(error){
                    alert("[LOGIN] Ajax http 500 error ( " + error + " )",3);
                    alog("[LOGIN] Ajax http 500 error ( " + error + " )");
                }
            });//AJAX         

        });//CLICK


        //아이콘
        feather.replace();
    });
    </script>
  </head>

  <body class="text-center">
    <form class="form-signin" onsubmit="return false;" method="post">
    <i style="padding-left:0px;padding-top:0px;"
                        color="silver" 
                        width="70"
                        height="70"
                        data-feather="moon"></i>
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email or Id</label>
      <input type="text"  name="F_EMAIL" id="F_EMAIL" class="form-control" placeholder="Email or Id" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password"  name="F_PASSWD" id="F_PASSWD" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" id="btnLogin" name="btnLogin">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>




<form method=post id="redirectForm" action="">
<input type="hidden" name="access_token" id="access_token" value="">
<input type="hidden" name="refresh_token" id="refresh_token" value="">
</form>

  </body>
</html>