//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SEARCHALL = "usrmngController?CTLGRP=G1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_SAVE = "usrmngController?CTLGRP=G1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_G1_RESET = "usrmngController?CTLGRP=G1&CTLFNC=RESET";//조회조건 변수 선언	
var obj_G1_USR_SEQ_valid = jQuery.parseJSON( '{ "G1_USR_SEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"NUMBER"} }' );  //USR_SEQ  밸리데이션
var obj_G1_USR_ID_valid = jQuery.parseJSON( '{ "G1_USR_ID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );  //USR_ID  밸리데이션
var obj_G1_USR_NM_valid = jQuery.parseJSON( '{ "G1_USR_NM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );  //USR_NM  밸리데이션
var obj_G1_PHONE_valid = jQuery.parseJSON( '{ "G1_PHONE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );  //PHONE  밸리데이션
var obj_G1_USR_SEQ; // USR_SEQ 변수선언var obj_G1_USR_ID; // USR_ID 변수선언var obj_G1_USR_NM; // USR_NM 변수선언var obj_G1_PHONE; // PHONE 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_SEARCH = "usrmngController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "usrmngController?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "usrmngController?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWADD = "usrmngController?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "usrmngController?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "usrmngController?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_EXCEL = "usrmngController?CTLGRP=G2&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G2_CHKSAVE = "usrmngController?CTLGRP=G2&CTLFNC=CHKSAVE";
//컨트롤러 경로
var url_G2_SAVEPWD = "usrmngController?CTLGRP=G2&CTLFNC=SAVEPWD";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//디테일 변수 초기화	

var obj_G3_USR_SEQ_valid = jQuery.parseJSON( '{ "G3_USR_SEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"NUMBER"} }' );   // USR_SEQ 밸리데이션 선언
var obj_G3_USR_ID_valid = jQuery.parseJSON( '{ "G3_USR_ID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );   // USR_ID 밸리데이션 선언
var obj_G3_USR_NM_valid = jQuery.parseJSON( '{ "G3_USR_NM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );   // USR_NM 밸리데이션 선언
var obj_G3_USR_PWD_valid = jQuery.parseJSON( '{ "G3_USR_PWD": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );   // USR_PWD 밸리데이션 선언
var obj_G3_PHONE_valid = jQuery.parseJSON( '{ "G3_PHONE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );   // PHONE 밸리데이션 선언
var obj_G3_PW_ERR_CNT_valid = jQuery.parseJSON( '{ "G3_PW_ERR_CNT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":2,  "DATATYPE":"NUMBER"} }' );   // PW_ERR_CNT 밸리데이션 선언
var obj_G3_LAST_STATUS_valid = jQuery.parseJSON( '{ "G3_LAST_STATUS": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":40,  "DATATYPE":"STRING"} }' );   // LAST_STATUS 밸리데이션 선언
var obj_G3_ADD_DT_valid = jQuery.parseJSON( '{ "G3_ADD_DT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );   // ADD 밸리데이션 선언
var obj_G3_MOD_DT_valid = jQuery.parseJSON( '{ "G3_MOD_DT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // MOD 밸리데이션 선언
//폼뷰 컨트롤러 경로
var url_G3_SEARCH = "usrmngController?CTLGRP=G3&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_G3_SAVE = "usrmngController?CTLGRP=G3&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_G3_RELOAD = "usrmngController?CTLGRP=G3&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_G3_NEW = "usrmngController?CTLGRP=G3&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_G3_MODIFY = "usrmngController?CTLGRP=G3&CTLFNC=MODIFY";
//폼뷰 컨트롤러 경로
var url_G3_DELETE = "usrmngController?CTLGRP=G3&CTLFNC=DELETE";
var obj_G3_USR_SEQ;   // USR_SEQ 글로벌 변수 선언
var obj_G3_USR_ID;   // USR_ID 글로벌 변수 선언
var obj_G3_USR_NM;   // USR_NM 글로벌 변수 선언
var obj_G3_USR_PWD;   // USR_PWD 글로벌 변수 선언
var obj_G3_PHONE;   // PHONE 글로벌 변수 선언
var obj_G3_PW_ERR_CNT;   // PW_ERR_CNT 글로벌 변수 선언
var obj_G3_LAST_STATUS;   // LAST_STATUS 글로벌 변수 선언
var obj_G3_ADD_DT;   // ADD 글로벌 변수 선언
var obj_G3_MOD_DT;   // MOD 글로벌 변수 선언
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G1_INIT();	
		G2_INIT();	
		G3_INIT();	
		alog("initBody()-----------------------end");
} //initBody()	
//팝업띄우기		
	//팝업창 오픈요청
function goGridPopOpen(tGrpId,tRowId,tColIndex,tValue,tText){
	alog("goGridPopOpen()............. tGrpId = " + tGrpId + ", tRowId = " + tRowId + ", tColIndex = " + tColIndex + ", tValue = " + tValue + ", tText = " + tText);
	
	tColId = mygridG2.getColumnId(tColIndex);
	
	//PGMGRP ,  	
}
function goFormPopOpen(tGrpId, tColId, tColId_Nm){
	alog("goFormviewPopOpen()............. tGrpId = " + tGrpId + ", tColId = " + tColId + ", tColId_Nm = " +tColId_Nm );
	
	tColId_Val = $("#" + tColId).val();
	tColId_Nm_Text = $("#" + tColId_Nm).text();
	//PGMGRP ,  	
}// goFormviewPopOpen
//부모창 리턴용//팝업창에서 받을 내용
function popReturn(tGrpId,tRowId,tColId,tBtnNm,tJsonObj){
	//alert("popReturn");
		//, 

}//popReturn
//그룹별 초기화 함수	
// CONDITIONInit	//컨디션 초기화
function G1_INIT(){
  alog("G1_INIT()-------------------------start	");




	//각 폼 오브젝트들 초기화
	//USR_ID, USR_ID 초기화	
	//USR_NM, USR_NM 초기화	
	//PHONE, PHONE 초기화	
  alog("G1_INIT()-------------------------end");
}

	//회원목록 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 회원목록"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("USR_SEQ,USR_ID,USR_NM,img:[../img/crypt_lock.png]USR_PWD,PW_CHG_DT,PHONE,PW_ERR_CNT,LAST_STATUS,USE_YN,ADD,MOD");
		mygridG2.setColumnIds("USR_SEQ,USR_ID,USR_NM,USR_PWD,PW_CHG_DT,PHONE,PW_ERR_CNT,LAST_STATUS,USE_YN,ADD_DT,MOD_DT");
		mygridG2.setInitWidths("60,60,60,90,60,60,60,60,60,60,60");
		mygridG2.setColTypes("ro,ed,ed,ed,ro,ed,ed,ed,ro,ro,ro");
	//가로 정렬	
		mygridG2.setColAlign("left,left,left,left,left,left,left,left,left,left,left");
		mygridG2.setColSorting("int,str,str,str,str,str,int,str,str,str,str");		//렌더링	
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);
		//mygridG2.setColValidators("G2_USR_SEQ,G2_USR_ID,G2_USR_NM,G2_USR_PWD,G2_PW_CHG_DT,G2_PHONE,G2_PW_ERR_CNT,G2_LAST_STATUS,G2_USE_YN,G2_ADD_DT,G2_MOD_DT");
		mygridG2.splitAt(0);//'freezes' 0 columns 
		mygridG2.init();
		//블럭선택 및 복사
		mygridG2.enableBlockSelection(true);
		mygridG2.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG2.editor){
				mygridG2.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG2.copyBlockToClipboard();

					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG2.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG2.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG2.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG2.getRowId(j);
						RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG2.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG2.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : USR_SEQ초기화	
		 // IO : USR_ID초기화	
		 // IO : USR_NM초기화	
		 // IO : USR_PWD초기화	
		 // IO : PW_CHG_DT초기화	
		 // IO : PHONE초기화	
		 // IO : PW_ERR_CNT초기화	
		 // IO : LAST_STATUS초기화	
		 // IO : USE_YN초기화	
		 // IO : ADD초기화	
		 // IO : MOD초기화	
	//onCheck
		mygridG2.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG2.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG2.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG2.setRowTextBold(rowId);
					mygridG2.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG2.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG2.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect20(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG2json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG2json && popG2json.CD){
				goOpenerReturn(popG2json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +
			//', "USR_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USR_SEQ")).getValue()) + '"' +
			//', "USR_ID" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USR_ID")).getValue()) + '"' +
			//', "USR_NM" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USR_NM")).getValue()) + '"' +
			//', "USR_PWD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USR_PWD")).getValue()) + '"' +
			//', "PW_CHG_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PW_CHG_DT")).getValue()) + '"' +
			//', "PHONE" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PHONE")).getValue()) + '"' +
			//', "PW_ERR_CNT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PW_ERR_CNT")).getValue()) + '"' +
			//', "LAST_STATUS" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LAST_STATUS")).getValue()) + '"' +
			//', "USE_YN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USE_YN")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "MOD_DT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MOD_DT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
				', "G2-USR_SEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USR_SEQ")).getValue()) + '"' +
			'}');
		lastinputG3 = new FormData(); // 회원상세
		lastinputG3.append("G2-USR_SEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("USR_SEQ")).getValue().replace(/&amp;/g, "&")); // 
		G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 회원상세
		});
		mygridG2.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG2  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG2.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG2.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG2.setRowTextBold(rId);
                }
                mygridG2.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
		mygridG2.setColumnHidden(mygridG2.getColIndexById("USR_SEQ"),true); //USR_SEQ
        alog("G2_INIT()-------------------------end");
     }
//디테일 초기화	
//회원상세 폼뷰 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");









	//컬럼 초기화
	//USR_ID, USR_ID 초기화	
	//USR_NM, USR_NM 초기화	
	//USR_PWD, USR_PWD 초기화	
	//PHONE, PHONE 초기화	
	//PW_ERR_CNT, PW_ERR_CNT 초기화	
	//LAST_STATUS, LAST_STATUS 초기화	
  alog("G3_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
// CONDITIONSearch	
function G1_SEARCHALL(token){
	alog("G1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG2 = new FormData(); //회원목록
	//json : G1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2,token);
	alog("G1_SEARCHALL--------------------------end");
}
//조회조건, 저장	
function G1_SAVE(){
 alog("G1_SAVE-------------------start");
	//FormData parameter에 담아줌	
	var formData = new FormData();	//G1 getparams	
//var params = { CTL : "G1_SAVE"};
	$.ajax({	
		type : "POST",
		url : url_G1_SAVE  ,
		data : formData,
		processData: false,
		contentType: false,
		async: false,
		success: function(tdata){
			alog("   json return----------------------");
			alog("   json data : " + tdata);
			data = jQuery.parseJSON(tdata);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("[G1] Ajax http 500 error ( " + error + " )");
			alog("[G1] Ajax http 500 error ( " + error + " )");
		}
	});
	alog("G1_SAVE-------------------end");	
}
//검색조건 초기화
function G1_RESET(){
	alog("G1_RESET--------------------------start");
	$('#condition')[0].reset();
}
function G2_CHKSAVE(){
	alog("G2_CHKSAVE()------------start");
	tgrid = mygridG2;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG2.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}	//CHK 배열 합치기
	sendFormData.append("G2-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G2_CHKSAVE + "&" + lastinputG2 ,
		data : sendFormData,
		processData: false,
		contentType: false,
		dataType: "json",
		async: false,
		success: function(data){
			alog("   json return----------------------");
			alog("   json data : " + data);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	
	alog("G2_CHKSAVE()------------end");
}
    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;            mygridG2.setColumnHidden(mygridG2.getColIndexById("USR_SEQ"),true); //USR_SEQ
     }else{
            isToggleHiddenColG2 = true;
            mygridG2.setColumnHidden(mygridG2.getColIndexById("USR_SEQ"),false); //USR_SEQ
        }
		alog("G2_HIDDENCOL()..................end");
    }
//행추가3 (회원목록)	
//그리드 행추가 : 회원목록
	function G2_ROWADD(){
		if( !(lastinputG2)){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}







    //그리드 조회(회원목록)	
    function G2_SEARCH(tinput,token){
        alog("G2_SEARCH()------------start");

		var tGrid = mygridG2;

        //그리드 초기화
        tGrid.clearAll();        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		if(typeof tinput != "undefined"){
			for(var pair of tinput.entries()) {
				sendFormData.append(pair[0],pair[1]);
				//console.log(pair[0]+ ', '+ pair[1]); 
			}
		}

        //불러오기
        $.ajax({
            type : "POST",
            url : url_G2_SEARCH+"&TOKEN=" + token + " &G2_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG2 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG2Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[회원목록] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[회원목록] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[회원목록] Ajax http 500 error ( " + error + " )",3);
                alog("[회원목록] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

	function G2_SAVE(token){
	alog("G2_SAVE()------------start");
	tgrid = mygridG2;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG2.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
	sendFormData.append("G2-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G2_SAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		dataType: "json",
		async: false,
		success: function(data){
			alog("   json return----------------------");
			alog("   json data : " + data);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	
	alog("G2_SAVE()------------end");
}
	function G2_SAVEPWD(token){
	alog("G2_SAVEPWD()------------start");
	tgrid = mygridG2;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG2.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
	sendFormData.append("G2-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G2_SAVEPWD + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		dataType: "json",
		async: false,
		success: function(data){
			alog("   json return----------------------");
			alog("   json data : " + data);
			alog("   json RTN_CD : " + data.RTN_CD);
			alog("   json ERR_CD : " + data.ERR_CD);
			//alog("   json RTN_MSG length : " + data.RTN_MSG.length);

			//그리드에 데이터 반영
			saveToGroup(data);

		},
		error: function(error){
			msgError("Ajax http 500 error ( " + error + " )");
			alog("Ajax http 500 error ( " + error + " )");
		}
	});
	
	alog("G2_SAVEPWD()------------end");
}
//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}
    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
    }
//엑셀다운		
function G2_EXCEL(){	
	alog("G2_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG2.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG2.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("USR_SEQ,USR_ID,USR_NM,USR_PWD,PW_CHG_DT,PHONE,PW_ERR_CNT,LAST_STATUS,USE_YN,ADD_DT,MOD_DT");
	$("#DATA_WIDTHS").val("60,60,60,90,60,60,60,60,60,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function G3_RELOAD(){
	alog("G3_RELOAD-----------------start");
	G3_SEARCH(lastinputG3json,token);
}//G3_SAVE
//IO_FILE_YN = N	
function G3_SAVE(token){	
	alog("G3_SAVE---------------start");

	if( !( $("#G3-CTLCUD").val() == "C" || $("#G3-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송 데이터 객체 만들기
	var sendFormData = new FormData($("#formviewG3")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
	for(var pair of conditionData.entries()) {
		sendFormData.append(pair[0],pair[1]);
		//console.log(pair[0]+ ', '+ pair[1]); 
	}

	$.ajax({
		type : "POST",
		url : url_G3_SAVE + "&TOKEN=" + token,
		data : sendFormData,
		processData: false,
		contentType: false,
		success: function(tdata){
			alog(tdata);
			data = jQuery.parseJSON(tdata);
			//alert(data);
			if(data && data.RTN_CD == "200"){
				msgNotice("정상적으로 저장되었습니다.",1);
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
			}
		},
		error: function(error){
			alog("Error:");
			alog(error);
		}
	});
}
//FORMVIEW DELETE
function G3_DELETE(){	
	alog("G3_DELETE---------------start");

	//조회했는지 확인하기
	if( $("#G3-CTLCUD").val() != "R" ){
		alert("조회된 것만 삭제 가능합니다.");
		return;
	}
	//확인
	if(!confirm("정말로 삭제하시겠습니까?")){
		return;
	}
	
	//삭제처리 명령어
	$("#G3-CTLCUD").val("D");

	//폼객체를 불러와서
	var form1 = $("#formviewG3")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_G3_DELETE,
		data : formData,
		processData: false,
		contentType: false,
		success: function(tdata){
			alog(tdata);
			data = jQuery.parseJSON(tdata);
			//alert(data);
			if(data && data.RTN_CD == "200"){
				msgNotice("정상적으로 삭제되었습니다.",1);
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
			}
		},
		error: function(error){
			alog("Error:");
			alog(error);
		}
	});
}
function G3_MODIFY(){
       alog("[FromView] G3_MODIFY---------------start");
	if( $("#G3-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#G3-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#G3-CTLCUD").val("U");
       alog("[FromView] G3_MODIFY---------------end");
}
//디테일 검색	
function G3_SEARCH(tinput,token){
       alog("(FORMVIEW) G3_SEARCH---------------start");

	//post 만들기
	sendFormData = new FormData($("#condition")[0]);
	for(var pair of tinput.entries()) {
		sendFormData.append(pair[0],pair[1]);
		//console.log(pair[0]+ ', '+ pair[1]); 
	}

    $.ajax({
        type : "POST",
        url : url_G3_SEARCH+"&TOKEN=" + token + "&G3_CRUD_MODE=SEARCH" ,
        data : sendFormData,
		processData: false,
		contentType: false,
        dataType: "json",
        success: function(data){
            alog(data);

			if(data && data.RTN_CD == "200"){
				if(data.RTN_DATA){
					msgNotice("정상적으로 조회되었습니다.",1);
				}else{
					msgNotice("정상적으로 조회되었으나 데이터가 없습니다.",2);
					return;
				}
			}else{
				msgError("오류가 발생했습니다("+ data.ERR_CD + ")." + data.RTN_MSG,3);
				return;
			}

            //모드 변경하기
            $("#G3-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
			$("#G3-USR_ID").val(data.RTN_DATA.USR_ID);//USR_ID 변수세팅
			$("#G3-USR_NM").val(data.RTN_DATA.USR_NM);//USR_NM 변수세팅
			$("#G3-USR_PWD").val(data.RTN_DATA.USR_PWD);//USR_PWD 변수세팅
			$("#G3-PHONE").val(data.RTN_DATA.PHONE);//PHONE 변수세팅
			$("#G3-PW_ERR_CNT").val(data.RTN_DATA.PW_ERR_CNT);//PW_ERR_CNT 변수세팅
			$("#G3-LAST_STATUS").val(data.RTN_DATA.LAST_STATUS);//LAST_STATUS 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });    alog("(FORMVIEW) G3_SEARCH---------------end");

}
//	
function G3_NEW(){
       alog("[FromView] G3_NEW---------------start");
	$("#G3-CTLCUD").val("C");
	//PMGIO 로직
	$("#G3-USR_ID").val("");//USR_ID 신규초기화	
	$("#G3-USR_NM").val("");//USR_NM 신규초기화	
	$("#G3-USR_PWD").val("");//USR_PWD 신규초기화	
	$("#G3-PHONE").val("");//PHONE 신규초기화	
	$("#G3-PW_ERR_CNT").val("");//PW_ERR_CNT 신규초기화	
	$("#G3-LAST_STATUS").val("");//LAST_STATUS 신규초기화	
       alog("DETAILNew30---------------end");
}
