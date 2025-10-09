<?php
header("Content-Type: text/html; charset=UTF-8");
header("Cache-Control:no-cache");
header("Pragma:no-cache");


$CFG = require_once("../common/include/incConfig.php");	
?><!DOCTYPE html>
<html>
<head>
    <title><?=$CFG["CFG_PROJECT_NAME"]?></title>
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

  <style>
    /*
    우측 스크롤 문제 생기는거 해결
    https://stackoverflow.com/questions/46522331/scroll-bar-in-the-main-section-of-a-v-app
    */
    html{
      overflow-y: hidden;
    }
  </style>
</head>
<body>

<div id="app">

    <v-app id="inspire">
      <v-navigation-drawer
        v-model="drawer"
        app
        clipped
      >
        <v-list dense>

        
          <v-subheader>Menus</v-subheader>

          <!--그냥 메뉴-->
          <div v-for="m in myMenu" :key="m.id">
          
          <v-list-item v-if="m.submenus.length == 0" link  @click="addTab(m.id,m.nm,m.url);">
            <v-list-item-icon>
             <v-icon>{{m.icon}}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>{{m.nm}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>


          <!--하위메뉴 있는 메뉴폴더 -->
          <v-list-group v-else no-action>
            <template v-slot:activator  @click="addTab(m.id,m.nm,m.url);">
              <v-list-item-icon>
                <v-icon>{{m.icon}}</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>{{m.nm}}</v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item v-for="s in m.submenus" :key="s.id" link   @click="addTab(s.id,s.nm,s.url);">
              <v-list-item-content>
                <v-list-item-title>{{s.nm}}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>

          </div>

        </v-list>
      </v-navigation-drawer>
  
      <v-app-bar
        app
        clipped-left
        dense
      >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title><?=$CFG["CFG_PROJECT_NAME"]?></v-toolbar-title>

        <v-spacer></v-spacer>



        <v-switch 
        class="pt-5"
        v-model="dark_theme" @change="changeTheme" label="Dark theme"></v-switch>
        <v-btn icon>
          <v-badge
            color="green"
            :content="msg_cnt"
            :value="msg_cnt"
            overlap
          >
          <v-icon>mdi-bell</v-icon>
        </v-btn>        
        <v-chip class="pl-4 pr-1">
          {{usr_navi_msg}}
          <v-btn icon @click="location='logout.php'">
            <v-icon>mdi-location-exit</v-icon>
          </v-btn>
        </v-chip>


      </v-app-bar>
  
      <v-main>
        <v-container
          class="pa-0 fill-height"
          fluid
        >

        <v-layout
          justify-center
          align-center 
          class=""
        >
          <v-flex id="vflex" text-xs-center fill-height>
            <v-tabs
                dark
                background-color="light-blue darken-2"
                show-arrows
                v-on:change="changeTabs"
                v-model="active_tab"
            >
                <v-tabs-slider color="teal lighten-3"></v-tabs-slider>

                <v-tab
                v-for="i in mytab"
                :key="i.id"
                class="pr-0"
                @click="changeTab(i.id)"
                >
                {{ i.name }}&nbsp;<v-btn icon small @click.prevent="closeTab(i.id)"><v-icon small>fas fa-times</v-icon></v-btn>
                </v-tab>
            </v-tabs>
        
            <div id="tabContent" class="divTab" ref="refTabContent" 
             style="overflow:hidden;height:calc(100% - 48px)"></div>


            </v-flex>
        </v-layout>
        
        </v-container>
      </v-main>
    </v-app>

</div>

<script>


new Vue({
  el: '#app'
  , watch:{
      mytab : {
        //alog("[watch] mytab = " + val);
        deep: true,
        handler(val){
          alog("[watch] mytab change ");
          //alog(val);
        }
      },
      active_tab : function(val){
        alog("[watch] active_tab = " + val);
        if(typeof val == 'undefined')return; //탭이 하나도 없으면 처리하지 마세요

        var tId = this.mytab[val].id;
        for(t=0;t<this.mytab.length;t++){
          //alog(t + "   #div-"+ this.mytab[t].id);
          if(this.mytab[t].id == tId){
              this.mytab[t].isdisplay = "";
              //$("#div-"+ this.mytab[t].id).css("display","");
              alog("tId 를 노출 = " + tId);

              $("#div-"+ this.mytab[t].id).css("visibility","visible");
              $("#div-"+ this.mytab[t].id).css("z-index","1");
              //$("#div-"+ this.mytab[t].id).css("top","0px");   
          }else{
              this.mytab[t].isdisplay = "none";
              //$("#div-"+ this.mytab[t].id).css("display","none");

              $("#div-"+ this.mytab[t].id).css("visibility","hidden");
              $("#div-"+ this.mytab[t].id).css("z-index","0");
              //$("#div-"+ this.mytab[t].id).css("top","-5000px");                    
          }
        }

      }
    }
  , vuetify: new Vuetify(),
    props: {
        source: String,
    },
    data: () => ({
        drawer: null,
        active_tab : null, //0, 1, 2, 3 ~ 숫자 인덱스 순서임
        mytab : [],
        myMenu : [],
        myNotice : [],
        dark_theme : false,
        usr_navi_msg : "",
        msg_cnt : 0,
        CFG_RD_URL_MNU_ROOT : '<?=$CFG["CFG_RD_URL_MNU_ROOT"]?>'
    }),
    created () {
        this.$vuetify.theme.dark = this.dark_theme
    },
    mounted () {
      alog("vue.mounted()...............................start");
      this.loadMenus();
      this.loadUserInfo();
    },
    methods:{
        changeTheme: function(){
          alog("methods.changeTheme()...............................start");
          this.$vuetify.theme.dark = this.dark_theme;
          return !this.dark_theme;
        },
        loadMenus: function(){
          alog("methods.loadTabs()...............................start");          
            var self = this;

            $.getJSON( "bo_main_v3_api.php?CTL=getMenu", function() {
                alog( "success" );
            })
            .done(function(data) {
                alog( "second success" );
                alog(data);
                self.myMenu = data;
            })
            .fail(function() {
                alert( "error" );
            });

        },
        loadUserInfo: function(){
            var self = this;

            $.getJSON( "bo_main_v3_api.php?CTL=getUserInfo", function() {
                alog( "loadUserInfo()......................success" );
            })
            .done(function(data) {
                alog( "loadUserInfo.done()......................success" );
                alog(data);
                for(i=0;i<data.intro.length;i++){
                  self.addTab(data.intro[i].PGMID,data.intro[i].MNU_NM,data.intro[i].URL);
                }

                self.usr_navi_msg = data.UID + "님 환영합니다.";
                self.msg_cnt = data.msg_cnt;
            })
            .fail(function() {
                alert( "error" );
            });

        },        
        changeTabs: function(tHref){
            alog("changeTabs().........................start");
            alog("  tHref = " + tHref);
            alog("  this.active_tab = " + this.active_tab);

            
            //alert(tmp);
        },          
        addTab: function(tId,tNm,tUrl2){
            alog("addTab().........................start");
            if(tUrl2 == null || tUrl2 == "")return;
            var tUrl = this.CFG_RD_URL_MNU_ROOT + tUrl2;

            tJson = {id:tId,name:tNm,link:tUrl,isdisplay:""};

            //이미 추가된 메뉴이면 활성화 시키기
            findIndex = _.findIndex(this.mytab, ['id', tId]);
            //alog("  findIndex = " + findIndex);
            if(findIndex >= 0){
              //선택탭 활성화만 하고 리턴
              this.mytab[findIndex].isdisplay = "";
              this.active_tab = findIndex;
            }else{
              
              this.mytab[this.mytab.length] = tJson;
              //Vue.set(this.mytab, this.mytab.length, tJson);  배열에서 바로 처리하는것도 잘되므로 watch 불필요

              this.active_tab = this.mytab.length - 1;

              //html 생성하기
              var tabContentHeight = $("#tabContent").height();
              //alert(tabContentHeight);

              tmp = '<div class="divTab"  id="div-'  + tId + '"';
              tmp += ' style="overflow:hidden;position:absolute;width:100%;height:calc(100% - 48px);z-index:1;"><iframe frameborder="0" marginwidth="0" marginheight="0" ';
              tmp += '    style="border:0px;position:relative;border:none;height:100%;width:100%;border-width:0px;border-color:silver;" ';
              tmp += '    scrolling="yes" frameborder="0" id="iframe-' + tId + '" src="' + tUrl + '"> ';
              tmp += '  </iframe>';
              tmp += '</div>';

              $("#tabContent").append( $(tmp) );
              //document.getElementById("iframe-"+ tId).src = tUrl;
            }


            //alog("  active_tab = " + this.active_tab);
        }, 
        changeTab: function(tId){
            alog("changeTab().........................start");
            //alog(this);
            alog("  tId=" + tId);
            //alert(tmp);
        },
        closeTab: function(tId){
            alog("closeTab().........................start ");
            alog("  tId = " + tId);
            //alog("  active_tab = " + this.active_tab);

            var otherActive = "";
            var closeIndex ;
            for(t=0;t<this.mytab.length;t++){

                if(this.mytab[t].id == tId){
                  //this.$refs["ref-" + this.mytab[t].id][0].remove();

                  //활성화 상태
                  closeIndex = t;

                }
            }

            //배열에서 지우기
            $("#div-"+ this.mytab[closeIndex].id).remove(); //오브젝트 삭제

            // this.$delete(obj, key)
            if(this.mytab.length > 1){
              if(this.active_tab>0){
                alog("active_tab 1빼기");
                this.active_tab--;
              }else{
                alog("active_tab 동일값 세팅");
                this.active_tab = "0"; //숫자 0으로 세팅시 변화가 없기때문에 문자"0"으로 세팅하기
              }
            }
            Vue.delete(this.mytab, closeIndex);

        }
    }
});

function alog(t){
    if(console)console.log(t);
}

$( window ).resize( function() {
  alog("window.resize()......................start");

});
$( document ).ready(function() {
  alog("document.ready()......................start");

});

</script>
</body>
</html>
