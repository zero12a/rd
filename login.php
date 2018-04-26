<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>rd login</title>

    <!-- Bootstrap core CSS -->
    <link href="./lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./lib/bootstrap/examples/signin.css" rel="stylesheet">

    <!--부트스트랩 js -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!--dhmltx/공통-->
    <script src="/c.g/lib/dhtmlxSuite/codebase/dhtmlx461_beautify.js" type="text/javascript" charset="utf-8"></script>
    <script src="../c.g/common/common.js"></script>


    <script language=javascript>

    var login_url = "login_ok.php?";

    $( document ).ready( function() {
        //alog("페이지 준비 완료1");

        $( "#btnLogin" ).click(function() {
            //alert( "Login go." + $("#F_EMAIL").val()  );

            //서버에서 DD가져오기
            $.ajax({
                type : "POST",
                url : login_url+"&G5_CRUD_MODE=read&",
                data : { F_EMAIL :  $("#F_EMAIL").val() , F_PASSWD :  $("#F_PASSWD").val()  },
                dataType: "json",
                success: function(data){
                    alog("   json return----------------------");
                    alog("   json data : " + data);
                    alog("   json RTN_CD : " + data.RTN_CD);
                    alog("   json ERR_CD : " + data.ERR_CD);
                    alog("   json RTN_MSG : " + data.RTN_MSG);

                    //그리드 저장 처리
                    if(data.RTN_CD == "200" && data.ERR_CD == "100"){
                        //alert("로그인이 성공했습니다.");
                        $(location).attr('href', "bo_main.php");
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

    });
    </script>
  </head>

  <body class="text-center">
    <form class="form-signin" onsubmit="return false;" method="post">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
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


    <script src="http://wzrd.in/standalone/uuid%2Fv4@latest"></script>
    <script>
    //alert(uuidv4()); // -> v4 UUID
    </script> 



  </body>
</html>