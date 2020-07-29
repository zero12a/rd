<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


$CFG = require_once("../common/include/incConfig.php");	
?>
<!DOCTYPE html>
<html>
<head>
    <title>rd login(vuetify)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!--css-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/materialdesignicons/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/vuetify2x.min.css" rel="stylesheet">

    <!--js-->
    <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/vue2x.min.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/vuetify2x.min.js"></script>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.5.1.min.js"></script>

    <script>
    var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";
    </script>
    <script src="/common/common.js"></script>

</head>
<body>

<div id="app">
    <v-app id="inspire">

    <v-container fluid>

        <v-row align="center">
            <v-spacer></v-spacer>
            <v-col cols="6">
                <p class="text-center text-h3"><v-icon x-large>mdi-lock</v-icon>Login</p>
            </v-col>
            <v-spacer></v-spacer>
        </v-row>
        <v-row align="center" no-gutters>
            <v-spacer></v-spacer>

            <v-col cols="6">
                <v-text-field

                label="ID"
                v-model="id"
                ></v-text-field>
            </v-col>
            <v-spacer></v-spacer>
        </v-row>

        <v-row align="center" no-gutters>
            <v-spacer></v-spacer>

            <v-col cols="6">
                <v-text-field

                type="password"
                label="PASSWORD"
                v-model="passwd"
                ></v-text-field>
            </v-col>
            <v-spacer></v-spacer>
        </v-row>

        <v-row align="center" no-gutters>
            <v-spacer></v-spacer>

            <v-col cols="6">
                <v-row class="mx-0">
                    <v-checkbox
                    dense
                    label="Remember me"
                    required
                    ></v-checkbox>
                </v-row>
            </v-col>
            <v-spacer></v-spacer>
        </v-row>

        <v-row align="center" no-gutters>
            <v-spacer></v-spacer>

            <v-col cols="6">
                <v-btn color="primary" @click="goLogin();">Login</v-btn>
            </v-col>
            <v-spacer></v-spacer>
        </v-row>

       

    </v-app>
</div>
<script>




new Vue({
  el: '#app',
  vuetify: new Vuetify(),
  data: () => ({
      id: "2"
      ,passwd: "3"
      ,g1: {
        user_cd: []
        ,radioGroup: 1
      }
      ,chk_selected: ["value3"]
      ,chk_list: [
           { label: "label1", value: "value1" }
          ,{ label: "label2", value: "value2" }
          ,{ label: "label3", value: "value3" }
          ,{ label: "label4", value: "value4" }
          ,{ label: "label5", value: "value5" }
      ]
      ,items1: [
            {"nm" : "text1", "cd" : "value1"}
            ,{"nm" : "text2", "cd" : "value2"}
            ,{"nm" : "text3", "cd" : "value3"}
            ,{"nm" : "text4", "cd" : "value4"}
      ]
  }),
  methods: {
      alog: function(t){
        if(console)console.log(t);
      },
      goLogin: function(){
          
        var login_url = "http://localhost:8052/newToken/?";

        //post param nm : client_id, client_secret, username, password
        var client_id = "svcfront";
        var client_secret = "frontoffice";

        var req_token = uuidv4();
        //alert(req_token);
        var tId = this.id;
        var tPasswd = this.passwd;

        //서버에서 DD가져오기
        $.ajax({
            type : "POST",
            url : login_url + "req_token=" + req_token,
            data : { "client_id" : client_id, "client_secret" : client_secret, "username" : tId , "password" :  tPasswd  },
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

                    $("#client_id").val(client_id);
                    $("#access_token").val(data.RTN_DATA.access_token);
                    $("#refresh_token").val(data.RTN_DATA.refresh_token);

                    $("#redirectForm").attr("action", data.RTN_DATA.redirect_uri + "?req_token=" + req_token);
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
      }
  }
})
function alog(t){
    if(console)console.log(t);
}





</script>

<form method=post id="redirectForm" action="">
<input type="hidden" name="client_id" id="client_id" value="">
<input type="hidden" name="access_token" id="access_token" value="">
<input type="hidden" name="refresh_token" id="refresh_token" value="">
</form>

</body>
</html>
