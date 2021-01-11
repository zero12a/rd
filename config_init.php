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
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'CFG_PROJECT_NAME'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="CFG_PROJECT_NAME"
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
                    v-model="CFG_SEC_KEY"
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
                    v-model="CFG_SEC_IV"
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
                    v-model="CFG_SEC_SALT"
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
                    v-model="ADMIN_ID"
                    dense
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'ADMIN PWD'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                    <v-text-field
                    v-model="ADMIN_PWD"
                    dense
                    label="password"
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                    <v-text-field
                    v-model="ADMIN_PWD_CONFIRM"
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
                    v-model="LDAP_HOST"
                    label="IP or DOMAIN"
                    hint="hint text"
                    counter="25"
                    ></v-text-field>
                    <v-text-field
                    v-model="LDAP_PORT"
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

            <v-row align="center" no-gutters style="background-color:blue;">
                <v-col cols="12" sm="4"  style="background-color:gray;">
                    <v-subheader v-text="'DBMS - CG'"></v-subheader>
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
                    <v-col cols="12" sm="3">
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
                    <v-col cols="12" sm="1">
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
                    <v-col cols="12" sm="2">
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
                    <v-subheader v-text="'FILESTORE - CG'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8"  style="background-color:silver;">
                  <v-row align="center" no-gutters>
                    <v-col cols="12" sm="1">
                      <v-text-field
                      dense hide-details
                      v-model="FILESTORE_FSID"
                      label="FSID"
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
                    <v-col cols="12" sm="2">
                      <v-btn @click="btnFilestoreEdit" block>EDIT</v-btn>
                    </v-col>
                      
                  </v-row>


                    <v-subheader>로컬 저장</v-subheader>
                    <v-data-table
                    :headers="FILESTORE_LOCAL_HEADERS"
                    :items="FILESTORE_LOCAL_DATA"
                    class="elevation-1"
                    :hide-default-footer="true"
                    @click:row="filestoreLocalRowClick"
                  ></v-data-table>

                  <v-subheader>AWS S3 저장</v-subheader>
                  <v-data-table
                    :headers="FILESTORE_S3_HEADERS"
                    :items="FILESTORE_S3_DATA"
                    class="elevation-1"
                    :hide-default-footer="true"
                    @click:row="filestoreS3RowClick"
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

            <v-row align="center" no-gutters style="background-color:red;">
                <v-col cols="12" sm="4" style="background-color:gray;">
                    <v-subheader v-text="'SQL - Common init file'"></v-subheader>
                </v-col>
                <v-col cols="12" sm="8" style="background-color:silver;">
                    <v-file-input
                    dense
                    multiple
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
        CFG_PROJECT_NAME: ""
        , CFG_SEC_KEY: ""
        , CFG_SEC_IV: ""
        , CFG_SEC_SALT: ""
        , ADMIN_PWD: ""
        , ADMIN_ID: ""
        , ADMIN_PWD_CONFIRM: ""
        , LDAP_HOST: ""
        , LDAP_PORT: ""
        , DBMS_DBID: ""
        , DBMS_HOST: ""
        , DBMS_PORT: ""
        , DBMS_DBNM: ""
        , DBMS_UID: ""
        , DBMS_PW: ""
        , DBMS_HEADERS: [
          {text: 'dbid', value: 'DBID', sortable: true},
          {text: 'host', value: 'HOST', sortable: true},
          {text: 'port', value: 'PORT', sortable: true},
          {text: 'dbnm', value: 'DBNM', sortable: true},
          {text: 'uid', value: 'UID', sortable: true},
          {text: 'pw', value: 'PW', sortable: true}
        ]
        , DBMS_DATA: [
          {
            DBID: "DB1"
            , HOST: "1"
            , PORT: "2"
            , DBNM: "3"
            , UID: "4"
            , PW: "5"
          },
          {
            DBID: "DB2"
            , HOST: "6"
            , PORT: "7"
            , DBNM: "8"
            , UID: "9"
            , PW: "0"
          }
        ]
        , FILESTORE_FSID: ""
        , FILESTORE_UPLOADDIR: ""
        , FILESTORE_ACL: ""
        , FILESTORE_CREKEY: ""
        , FILESTORE_CRESECRET: ""
        , FILESTORE_REGION: ""
        , FILESTORE_BUCKET: ""
        , FILESTORE_LOCAL_HEADERS : [
          {text: 'FSID', value: 'FSID', sortable: true},
          {text: 'UPLOADDIR', value: 'UPLOADDIR', sortable: true},
          {text: 'ACL', value: 'ACL', sortable: true},
        ]
        , FILESTORE_LOCAL_DATA: [
          {
            FSID: "FS1"
            , UPLOADDIR: "1"
            , ACL: "2"
          },
          {
            FSID: "FS2"
            , UPLOADDIR: "3"
            , ACL: "4"
          },
        ]
        , FILESTORE_S3_HEADERS : [
          {text: 'FSID', value: 'FSID', sortable: true},
          {text: 'CREKEY', value: 'CREKEY', sortable: true},
          {text: 'CRESECRET', value: 'CRESECRET', sortable: true},
          {text: 'REGION', value: 'REGION', sortable: true},
          {text: 'BUCKET', value: 'BUCKET', sortable: true},
          {text: 'ACL', value: 'ACL', sortable: true},
        ]
        , FILESTORE_S3_DATA: [
          {
            FSID: "FS3"
            , CREKEY: "31"
            , CRESECRET: "32"
            , REGION: "32"
            , BUCKET: "32"
            , ACL: "32"
          },
          {
            FSID: "FS4"
            , CREKEY: "41"
            , CRESECRET: "42"
            , REGION: "42"
            , BUCKET: "42"
            , ACL: "42"
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
          fd.append('SQL_FILES', this.SQL_FILES);
          
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

      },
      btnFilestoreEdit: function(t){
        alog(t);
        for(i=0;i< this.FILESTORE_LOCAL_DATA.length; i++){
          alog("i1 = " + i);
          alog(" old dbid = " + this.FILESTORE_LOCAL_DATA[i].FSID);
          alog(" new dbid = " + this.FILESTORE_FSID);
          
          if(this.FILESTORE_LOCAL_DATA[i].FSID == this.FILESTORE_FSID){
            this.FILESTORE_LOCAL_DATA[i].FSID = this.FILESTORE_FSID;
            this.FILESTORE_LOCAL_DATA[i].UPLOADDIR = this.FILESTORE_UPLOADDIR;
            this.FILESTORE_LOCAL_DATA[i].ACL = this.FILESTORE_ACL;
          }
        }

        for(i=0;i< this.FILESTORE_S3_DATA.length; i++){
          alog("i2 = " + i);
          alog(" old dbid = " + this.FILESTORE_S3_DATA[i].FSID);
          alog(" new dbid = " + this.FILESTORE_FSID);
          
          if(this.FILESTORE_S3_DATA[i].FSID == this.FILESTORE_FSID){
            this.FILESTORE_S3_DATA[i].FSID = this.FILESTORE_FSID;
            this.FILESTORE_S3_DATA[i].CREKEY = this.FILESTORE_CREKEY;
            this.FILESTORE_S3_DATA[i].CRESECRET = this.FILESTORE_CRESECRET;
            this.FILESTORE_S3_DATA[i].BUCKET = this.FILESTORE_BUCKET;
            this.FILESTORE_S3_DATA[i].REGION = this.FILESTORE_REGION;
            this.FILESTORE_S3_DATA[i].ACL = this.FILESTORE_ACL;
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
            this.DBMS_DATA[i].DBID = this.DBMS_DBID;
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
        this.DBMS_HOST = value.HOST;
        this.DBMS_PORT = value.PORT;
        this.DBMS_DBNM = value.DBNM;
        this.DBMS_UID = value.UID;
        this.DBMS_PW = value.PW;
        //this.highlightClickedRow(value);
        //this.viewDetails(value);
      },
      filestoreLocalRowClick: function(value){
        alog(value);
        this.FILESTORE_FSID = value.FSID;
        this.FILESTORE_UPLOADDIR = value.UPLOADDIR;
        this.FILESTORE_ACL = value.ACL;

        this.FILESTORE_CREKEY = "";
        this.FILESTORE_CRESECRET = "";
        this.FILESTORE_REGION = "";
        this.FILESTORE_BUCKET = "";
      },
      filestoreS3RowClick: function(value){
        alog(value);
        this.FILESTORE_FSID = value.FSID;
        this.FILESTORE_ACL = value.ACL;
        this.FILESTORE_CREKEY = value.CREKEY;
        this.FILESTORE_CRESECRET = value.CRESECRET;
        this.FILESTORE_REGION = value.REGION;
        this.FILESTORE_BUCKET = value.BUCKET;

        this.FILESTORE_UPLOADDIR = "";
      },
  }
});

function alog(t){
    if(console)console.log(t);
}
</script>
</body>
</html>
