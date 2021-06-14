<?php
header("Content-Type: text/html; charset=UTF-8");

//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = require_once("../common/include/incConfig.php");

//호출하면 캐쉬 초기화
apcu_store($CFG["CONFIG_NM"], null);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Config modify</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

  <!--css-->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

  <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

  <!--js-->
  <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  

</head>
<body>

<div id="app">
  <v-app id="inspire">
            <!--
            ####
            #### step 1
            ####
            -->
            <v-card
            class="mx-auto"
            elevation="2"
            color="blue lighten-5 mb-2"
            >
              <v-card-text>
              REDIS_HOST : <?=$CFG["REDIS_HOST"]?><br>
              REDIS_PORT : <?=$CFG["REDIS_PORT"]?><br>
              REDIS_PASSWD : <?=($CFG["REDIS_PASSWD"] != "")?"Yes":"No";?><br>
              CONFIG_NM : <?=$CFG["CONFIG_NM"]?><br>
              <BR>
              STORETYPE은 LOCAL 또는 S3이 가능하고<BR>
              S3는 AWS의 S3서비스로 CREKEY, CRESECRET, REGION, BUCKET, ACL이 필수 항목이고<BR>
              LOCAL은 UPLOADDIR, ACL이 필수 항목임<BR>
              ACL은 private, public-read, public-read-write가 가능함.<BR>
              <BR>
                * 저장시 암호화 : ADMIN PWD, DBMS PW, AWS CREKEY, AWS CRESECRET
              </v-card-text>
            </v-card>
            <v-divider></v-divider>
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'CFG_PROJECT_NAME'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="PROPERTY.CFG_PROJECT_NAME"
                    dense
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'CFG_SEC_KEY'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="PROPERTY.CFG_SEC_KEY"
                    dense
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'CFG_SEC_IV'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="PROPERTY.CFG_SEC_IV"
                    dense
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'CFG_SEC_SALT'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="PROPERTY.CFG_SEC_SALT"
                    dense
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'CFG_URL_LIBS_ROOT'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="PROPERTY.CFG_URL_LIBS_ROOT"
                    dense
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>

            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'LDAP AUTH(OPTION)'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    dense
                    v-model="PROPERTY.CFG_LDAP_HOST"
                    label="IP or DOMAIN"
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                    <v-text-field
                    v-model="PROPERTY.CFG_LDAP_PORT"
                    dense
                    label="PORT"
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>


  
            <!--
            ####
            #### step 2
            ####
            -->
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'DBMS'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                  <v-row align="center" no-gutters>
                  <v-col cols="12" sm="1">
                      <v-text-field
                        dense hide-details
                        v-model="DBMS_DBID"
                        label="DBMS ID"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="1">
                      <v-text-field
                        dense hide-details
                        v-model="DBMS_DRIVER"
                        label="DRIVER"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="2">
                      <v-text-field
                        dense hide-details
                        v-model="DBMS_HOST"
                        label="IP or DOMAIN"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="1">
                      <v-text-field
                      dense hide-details
                      v-model="DBMS_PORT"
                      label="PORT"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="2">
                      <v-text-field
                      dense hide-details
                      v-model="DBMS_DBNM"
                      label="DBNM"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="2">
                      <v-text-field
                      dense hide-details
                      v-model="DBMS_UID"
                      label="UID"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="2">
                      <v-text-field
                      dense hide-details
                      v-model="DBMS_PW"
                      label="PW"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="1">
                      <v-btn block @click="btnDbmsEdit">EDIT</v-btn>
                    </v-col>
                  </v-row>
                  <v-data-table
                    :headers="DBMS_HEADERS"
                    :items="DBMS_DATA"
                    class="elevation-1"
                    :hide-default-footer="true"
                    @click:row="dbmsRowClick"
                  ></v-data-table>
                </v-col>
            </v-row>
            <v-divider></v-divider>


            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'FILESTORE'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                  <v-row align="center" no-gutters>
                    <v-col cols="12" sm="1">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_STOREID"
                      label="STOREID"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="1">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_STORETYPE"
                      label="STORETYPE"
                      ></v-text-field>
                    </v-col>                    
                    <v-col cols="12" sm="2">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_UPLOADDIR"
                      label="UPLOADDIR"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="2">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_CREKEY"
                      label="CREKEY"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="2">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_CRESECRET"
                      label="CRESECRET"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="1">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_REGION"
                      label="REGION"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="1">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_BUCKET"
                      label="BUCKET"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="1">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_ACL"
                      label="ACL"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="1">
                      <v-btn @click="btnFilestoreEdit" block>EDIT</v-btn>
                    </v-col>
                      
                  </v-row>

                  <v-data-table
                    :headers="FILESTORE_HEADERS"
                    :items="FILESTORE_DATA"
                    class="elevation-1"
                    :hide-default-footer="true"
                    @click:row="filestoreRowClick"
                  ></v-data-table>
                </v-col>
            </v-row>
            <v-divider></v-divider>s

          <v-btn
            color="primary"
            @click="step1EndSave"
          >
            Continue
          </v-btn>
  




  </v-app>
</div>


<script>
new Vue({
  el: '#app',
  vuetify: new Vuetify(),
  mounted() { 
    console.log("Parent mounted");
    this.step1Start();
  },
  data () {
    return {
        PROPERTY : { 
          CFG_PROJECT_NAME : "1"
          , CFG_SEC_KEY: "2"
          , CFG_SEC_IV: "3"
          , CFG_SEC_SALT: "4"
          , CFG_URL_LIBS_ROOT: "http://localhost:8070/"
          , ADMIN_PWD_CONFIRM: "7"
          , CFG_LDAP_HOST: "8"
          , CFG_DAP_PORT: "9"
        }
        , DBMS_DBID: ""
        , DBMS_DRIVER: ""
        , DBMS_HOST: ""
        , DBMS_PORT: ""
        , DBMS_DBNM: ""
        , DBMS_UID: ""
        , DBMS_PW: ""
        , DBMS_HEADERS: [
          {text: 'dbid', value: 'DBID', sortable: true},
          {text: 'driver', value: 'DRIVER', sortable: true},
          {text: 'host', value: 'HOST', sortable: true},
          {text: 'port', value: 'PORT', sortable: true},
          {text: 'dbnm', value: 'DBNM', sortable: true},
          {text: 'uid', value: 'UID', sortable: true},
          {text: 'pw *', value: 'PW', sortable: true}
        ]
        , DBMS_DATA: []
        , FILESTORE_STOREID: ""
        , FILESTORE_STORETYPE: ""
        , FILESTORE_UPLOADDIR: ""
        , FILESTORE_ACL: ""
        , FILESTORE_CREKEY: ""
        , FILESTORE_CRESECRET: ""
        , FILESTORE_REGION: ""
        , FILESTORE_BUCKET: ""
        , FILESTORE_HEADERS : [
          {text: 'STOREID', value: 'STOREID', sortable: true},
          {text: 'STORETYPE', value: 'STORETYPE', sortable: true},
          {text: 'UPLOADDIR', value: 'UPLOADDIR', sortable: true},
          {text: 'CREKEY *', value: 'CREKEY', sortable: true},
          {text: 'CRESECRET *', value: 'CRESECRET', sortable: true},
          {text: 'REGION', value: 'REGION', sortable: true},
          {text: 'BUCKET', value: 'BUCKET', sortable: true},
          {text: 'ACL', value: 'ACL', sortable: true},
        ]
        , FILESTORE_DATA: []
        , e1: 1
    }
  },
  methods: {
      msg : function(){
          alert(this.CFG_PROJECT_NAME);
      },
      step1Start: function(t){
        var fd = new FormData();        
        //fd.set("test1","axios");
        alog(222);
        axios.post('config_mod_api.php?CTL=STEP1_START',
              fd, {}
        ).then( response => {
          alog('SUCCESS!!');
          alog(response.data);

          if(response.data.RTN_CD != "200"){
            alert(response.data.RTN_MSG);
          }else{
            var firstJson = JSON.parse(response.data.RTN_MSG);
            //초기값 설정
            this.PROPERTY.CFG_PROJECT_NAME = firstJson.CFG_PROJECT_NAME;
            this.PROPERTY.CFG_SEC_KEY = firstJson.CFG_SEC_KEY;
            this.PROPERTY.CFG_SEC_IV = firstJson.CFG_SEC_IV;
            this.PROPERTY.CFG_SEC_SALT = firstJson.CFG_SEC_SALT;
            this.PROPERTY.CFG_URL_LIBS_ROOT = firstJson.CFG_URL_LIBS_ROOT;
            this.PROPERTY.CFG_LDAP_HOST = firstJson.CFG_LDAP_HOST;
            this.PROPERTY.CFG_LDAP_PORT = firstJson.CFG_LDAP_PORT;

            //alog(firstJson.CFG_DB);
            i = 0;
            for(key in firstJson.CFG_DB) {

                //alert('key:' + key + ' / ' + 'value:' + firstJson.CFG_DB[key]);
                //array[i] = {}와 같이 직접 업데이트는 vue갱신이 안되고, 배열을 반드시 push로 업데이트 해야함.
                this.DBMS_DATA.push({
                    "DBID": key
                    ,"DRIVER": firstJson.CFG_DB[key].DRIVER
                    ,"HOST": firstJson.CFG_DB[key].HOST
                    ,"PORT": firstJson.CFG_DB[key].PORT
                    ,"DBNM": firstJson.CFG_DB[key].DBNM
                    ,"UID": firstJson.CFG_DB[key].ID
                    ,"PW": firstJson.CFG_DB[key].PW
                });
                //alog(this.DBMS_DATA[i]);
                
                i++;
            }

            i = 0;
            for(key in firstJson.CFG_FILESTORE) {

                //alert('key:' + key + ' / ' + 'value:' + firstJson.CFG_DB[key]);
                //array[i] = {}와 같이 직접 업데이트는 vue갱신이 안되고, 배열을 반드시 push로 업데이트 해야함.
                this.FILESTORE_DATA.push({
                    "STOREID": key
                    ,"STORETYPE": firstJson.CFG_FILESTORE[key].STORETYPE
                    ,"UPLOADDIR": firstJson.CFG_FILESTORE[key].UPLOADDIR
                    ,"READURL": firstJson.CFG_FILESTORE[key].READURL
                    ,"CREKEY": firstJson.CFG_FILESTORE[key].CREKEY
                    ,"CRESECRET": firstJson.CFG_FILESTORE[key].CRESECRET
                    ,"REGION": firstJson.CFG_FILESTORE[key].REGION
                    ,"BUCKET": firstJson.CFG_FILESTORE[key].BUCKET
                    ,"ACL": firstJson.CFG_FILESTORE[key].ACL
                });
                //alog(this.DBMS_DATA[i]);
                
                i++;
            }


          }

        })
        .catch(function () {
          alert('FAILURE!!');
        });

      },
      step1EndSave: function(t){

          var fd = new FormData();
          fd.append("PROPERTY",JSON.stringify(this.PROPERTY));
          fd.append("DBMS_DATA",JSON.stringify(this.DBMS_DATA));
          fd.append("FILESTORE_DATA",JSON.stringify(this.FILESTORE_DATA));

          //fd.set("test1","axios");
          alog(222);
          axios.post('config_mod_api.php?CTL=STEP1_END',
                fd, {
                  headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                  }
                }
          ).then( response => {
            alog('SUCCESS!!');
            alog(response.data);
            if(response.data.RTN_CD != "200"){
              alert(response.data.RTN_MSG);
            }else{
              alert("Success saved.")
            }


          })
          .catch(function () {
            alert('FAILURE!!');
          });
          alog(333);

      },
      btnFilestoreEdit: function(t){
        alog(t);

        for(i=0;i< this.FILESTORE_DATA.length; i++){
          alog("i2 = " + i);
          alog(" old dbid = " + this.FILESTORE_DATA[i].STOREID);
          alog(" new dbid = " + this.FILESTORE_STOREID);
          
          if(this.FILESTORE_DATA[i].STOREID == this.FILESTORE_STOREID){
            //this.FILESTORE_DATA[i].STOREID = this.FILESTORE_STOREID;
            this.FILESTORE_DATA[i].STORETYPE = this.FILESTORE_STORETYPE;
            this.FILESTORE_DATA[i].UPLOADDIR = this.FILESTORE_UPLOADDIR;
            this.FILESTORE_DATA[i].CREKEY = this.FILESTORE_CREKEY;
            this.FILESTORE_DATA[i].CRESECRET = this.FILESTORE_CRESECRET;
            this.FILESTORE_DATA[i].BUCKET = this.FILESTORE_BUCKET;
            this.FILESTORE_DATA[i].REGION = this.FILESTORE_REGION;
            this.FILESTORE_DATA[i].ACL = this.FILESTORE_ACL;
          }
        }
        
      },
      btnDbmsEdit: function (t){
        alog(t);
        for(i=0;i< this.DBMS_DATA.length; i++){
          alog("i = " + i);
          alog(" old dbid = " + this.DBMS_DATA[i].DBID);
          alog(" new dbid = " + this.DBMS_DBID);
  
          if(this.DBMS_DATA[i].DBID == this.DBMS_DBID){
            //this.DBMS_DATA[i].DBID = this.DBMS_DBID;
            this.DBMS_DATA[i].DRIVER = this.DBMS_DRIVER;
            this.DBMS_DATA[i].HOST = this.DBMS_HOST;
            this.DBMS_DATA[i].PORT = this.DBMS_PORT;
            this.DBMS_DATA[i].DBNM = this.DBMS_DBNM;
            this.DBMS_DATA[i].UID = this.DBMS_UID;
            this.DBMS_DATA[i].PW = this.DBMS_PW;
          }
        }
      },
      dbmsRowClick : function(value) {
        //alert(value);
        alog(value);
        this.DBMS_DBID = value.DBID;
        this.DBMS_DRIVER = value.DRIVER;
        this.DBMS_HOST = value.HOST;
        this.DBMS_PORT = value.PORT;
        this.DBMS_DBNM = value.DBNM;
        this.DBMS_UID = value.UID;
        this.DBMS_PW = value.PW;
        //this.highlightClickedRow(value);
        //this.viewDetails(value);
      },
      filestoreRowClick: function(value){
        alog(value);
        this.FILESTORE_STOREID = value.STOREID;
        this.FILESTORE_STORETYPE = value.STORETYPE;
        this.FILESTORE_UPLOADDIR = value.UPLOADDIR;
        this.FILESTORE_ACL = value.ACL;
        this.FILESTORE_CREKEY = value.CREKEY;
        this.FILESTORE_CRESECRET = value.CRESECRET;
        this.FILESTORE_REGION = value.REGION;
        this.FILESTORE_BUCKET = value.BUCKET;
      },
  }
});

function alog(t){
    if(console)console.log(t);
}
</script>
</body>
</html>
