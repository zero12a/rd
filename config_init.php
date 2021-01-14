<?php
header("Content-Type: text/html; charset=UTF-8");

//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = require_once("../common/include/incConfig.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>vuetify stepper</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

  <!--css-->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

  <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

  <!--js-->
  <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  

</head>
<body>

<div id="app">
  <v-app id="inspire">
    <v-stepper v-model="e1">
      <v-stepper-header>
        <v-stepper-step
          :complete="e1 > 1"
          step="1"
        >
        기본설정 of step 1
        </v-stepper-step>
  
        <v-divider></v-divider>
  
        <v-stepper-step
          :complete="e1 > 2"
          step="2"
        >
        DB/파일 스토어 of step 2
        </v-stepper-step>
  
        <v-divider></v-divider>
  
        <v-stepper-step step="3">
        초기DB세팅 of step 3
        </v-stepper-step>
      </v-stepper-header>
  
      <v-stepper-items>
        <v-stepper-content step="1">
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
              <br>
              * 저장시 암호화 : ADMIN PWD
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
                    <v-subheader v-text="'ADMIN ID'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="PROPERTY.ADMIN_ID"
                    dense
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'ADMIN PWD *'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="PROPERTY.ADMIN_PWD"
                    dense
                    label="password"
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                    <v-text-field
                    v-model="PROPERTY.ADMIN_PWD_CONFIRM"
                    dense
                    label="password confirm"
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
                    v-model="PROPERTY.LDAP_HOST"
                    label="IP or DOMAIN"
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                    <v-text-field
                    v-model="PROPERTY.LDAP_PORT"
                    dense
                    label="PORT"
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>


          <v-btn
            color="primary"
            @click="e1 = 2;msg();"
          >
            Continue
          </v-btn>
  
          <v-btn text>
            Cancel
          </v-btn>
        </v-stepper-content>
  
        <v-stepper-content step="2">
  
            <!--
            ####
            #### step 2
            ####
            -->
            <v-card
            class="mx-auto"
            elevation="2"
            color="blue lighten-5 mb-2"
            >
              <v-card-text>
              STORETYPE은 LOCAL 또는 S3이 가능하고<BR>
              S3는 AWS의 S3서비스로 CREKEY, CRESECRET, REGION, BUCKET, ACL이 필수 항목이고<BR>
              LOCAL은 UPLOADDIR, ACL이 필수 항목임<BR>
              ACL은 private, public-read, public-read-write가 가능함.<BR>
              <BR>
              * 저장시 암호화 : DBMS PW, AWS CREKEY, AWS CRESECRET
              </v-card-text>
            </v-card>
            <v-divider></v-divider>
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
            <v-divider></v-divider>


          <v-btn
            color="primary"
            @click="e1 = 3"
          >
            Continue
          </v-btn>
  
          <v-btn text>
            Cancel
          </v-btn>
        </v-stepper-content>
  
        <v-stepper-content step="3">
            <!--
            ####
            #### step 3
            ####
            -->
            <v-card
            class="mx-auto"
            elevation="2"
            color="blue lighten-5 mb-2"
            >
              <v-card-text>
              SQL FILE is download at GitHub Link.
              </v-card-text>
              <v-card-actions>
                <v-btn
                  text
                  color="blue darken-4"
                  @click="reveal = true"
                >
                  Download
                </v-btn>
              </v-card-actions>
            </v-card>
            <v-row align="center" no-gutters style="background-color:red;">
                <v-col cols="12" sm="4" style="background-color:gray;">
                    <v-subheader v-text="'SQL - Common init file'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8" style="background-color:silver;">
                    <v-file-input
                    dense
                    multiple
                    show-size
                    v-model="SQL_FILES"
                    hint="hint text"
                    ></v-file-input>
                </v-col>
            </v-row>
            <v-divider></v-divider>

            <v-row align="center" no-gutters style="background-color:red;">
                <v-col cols="12" sm="4" style="background-color:gray;">
                    <v-subheader v-text="'SQL - Service init file'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8" style="background-color:silver;">
                    <v-file-input
                    dense
                    multiple
                    hint="hint text"
                    ></v-file-input>
                </v-col>
            </v-row>
            <v-divider></v-divider>


          <v-btn
            color="primary"
            @click="stepEndSave"
          >
            Continue
          </v-btn>
  
          <v-btn text>
            Cancel
          </v-btn>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-app>
</div>


<script>
new Vue({
  el: '#app',
  vuetify: new Vuetify(),
  data () {
    return {
        PROPERTY : { 
          CFG_PROJECT_NAME : "1"
          , CFG_SEC_KEY: "2"
          , CFG_SEC_IV: "3"
          , CFG_SEC_SALT: "4"
          , CFG_URL_LIBS_ROOT: "http://localhost:8070/"
          , ADMIN_PWD: "5"
          , ADMIN_ID: "6"
          , ADMIN_PWD_CONFIRM: "7"
          , LDAP_HOST: "8"
          , LDAP_PORT: "9"
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
        , DBMS_DATA: [
          {
            DBID: "DB1"
            , DRIVER: "MYSQLI"
            , HOST: "1"
            , PORT: "2"
            , DBNM: "3"
            , UID: "4"
            , PW: "5"
          },
          {
            DBID: "DB2"
            ,DRIVER : "PDO_MYSQL"
            , HOST: "6"
            , PORT: "7"
            , DBNM: "8"
            , UID: "9"
            , PW: "0"
          }
        ]
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
        , FILESTORE_DATA: [
          {
            STOREID: "FS1"
            , STORETYPE: "LOCAL"
            , UPLOADDIR: "/data/www/up"
            , CREKEY: ""
            , CRESECRET: ""
            , REGION: ""
            , BUCKET: ""
            , ACL: "public"
          },
          {
            STOREID: "FS2"
            , STORETYPE: "S3"
            , UPLOADDIR: ""
            , CREKEY: "aaa"
            , CRESECRET: "bbb"
            , REGION: "ccc"
            , BUCKET: "ddd"
            , ACL: "private"
          },
        ]
        , SQL_FILES : []
        , e1: 1
    }
  },
  methods: {
      msg : function(){
          alert(this.CFG_PROJECT_NAME);
      },
      stepEndSave: function(t){

          var fd = new FormData();
          fd.append("PROPERTY",JSON.stringify(this.PROPERTY));
          fd.append("DBMS_DATA",JSON.stringify(this.DBMS_DATA));
          fd.append("FILESTORE_DATA",JSON.stringify(this.FILESTORE_DATA));
          //alog(this.SQL_FILES);

          if(this.SQL_FILES.length > 1){
            for(var i=0;i<this.SQL_FILES.length;i++){
              fd.append("SQL_FILES[" + i + "]", this.SQL_FILES[i]);
            }
          }else if(this.SQL_FILES.length == 1){
            fd.append("SQL_FILES", this.SQL_FILES[0]);
          }


          //fd.set("test1","axios");
          alog(222);
          axios.post('config_init_api.php',
                fd, {
                  headers: {
                    'Content-Type': 'multipart/form-data'
                  }
                }
          ).then( response => {
            alog('SUCCESS!!');
            alog(response.data)
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
            this.DBMS_DATA[i].PW = this.PW;
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
