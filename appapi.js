//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C2_SEARCHALL = "appapiController?CTLGRP=C2&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_C2_SAVE = "appapiController?CTLGRP=C2&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_C2_RESET = "appapiController?CTLGRP=C2&CTLFNC=RESET";//컨디션1 변수 선언	
var obj_C2_API_SEQ_valid = jQuery.parseJSON( '{ "C2_API_SEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );  //SEQ  밸리데이션
var obj_C2_API_NM_valid = jQuery.parseJSON( '{ "C2_API_NM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );  //NM  밸리데이션
var obj_C2_PGM_ID_valid = jQuery.parseJSON( '{ "C2_PGM_ID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );  //ID  밸리데이션
var obj_C2_URL_valid = jQuery.parseJSON( '{ "C2_URL": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );  //URL  밸리데이션
var obj_C2_API_SEQ; // SEQ 변수선언var obj_C2_API_NM; // NM 변수선언var obj_C2_PGM_ID; // ID 변수선언var obj_C2_URL; // URL 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "appapiController?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_CHKSAVE = "appapiController?CTLGRP=G3&CTLFNC=CHKSAVE";
//컨트롤러 경로
var url_G3_SAVE = "appapiController?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_RELOAD = "appapiController?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_EXCEL = "appapiController?CTLGRP=G3&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G3_HIDDENCOL = "appapiController?CTLGRP=G3&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G3_ROWDELETE = "appapiController?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "appapiController?CTLGRP=G3&CTLFNC=ROWADD";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//디테일 변수 초기화	

var obj_F4_API_SEQ_valid = jQuery.parseJSON( '{ "F4_API_SEQ": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":10,  "DATATYPE":"STRING"} }' );   // SEQ 밸리데이션 선언
var obj_F4_API_NM_valid = jQuery.parseJSON( '{ "F4_API_NM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // NM 밸리데이션 선언
var obj_F4_PGM_ID_valid = jQuery.parseJSON( '{ "F4_PGM_ID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // ID 밸리데이션 선언
var obj_F4_URL_valid = jQuery.parseJSON( '{ "F4_URL": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // URL 밸리데이션 선언
var obj_F4_REQ_ENCTYPE_valid = jQuery.parseJSON( '{ "F4_REQ_ENCTYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":55,  "DATATYPE":"STRING"} }' );   // REQENCTYPE 밸리데이션 선언
var obj_F4_REQ_DATATYPE_valid = jQuery.parseJSON( '{ "F4_REQ_DATATYPE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // REQDATATYPE 밸리데이션 선언
var obj_F4_REQ_BODY_valid = jQuery.parseJSON( '{ "F4_REQ_BODY": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // REQBODY 밸리데이션 선언
var obj_F4_RES_BODY_valid = jQuery.parseJSON( '{ "F4_RES_BODY": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // RESBODY 밸리데이션 선언
var obj_F4_MYFILESVRNM_valid = jQuery.parseJSON( '{ "F4_MYFILESVRNM": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":40,  "DATATYPE":"STRING"} }' );   // MYFILESVRNM 밸리데이션 선언
var obj_F4_MYFILE_valid = jQuery.parseJSON( '{ "F4_MYFILE": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":40,  "DATATYPE":"STRING"} }' );   // MYFILE 밸리데이션 선언
var obj_F4_MYFILE_VIEWER_valid = jQuery.parseJSON( '{ "F4_MYFILE_VIEWER": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":100,  "DATATYPE":"STRING"} }' );   // 이미지뷰어 밸리데이션 선언
var obj_F4_ADD_DT_valid = jQuery.parseJSON( '{ "F4_ADD_DT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );   // ADD 밸리데이션 선언
var obj_F4_MOD_DT_valid = jQuery.parseJSON( '{ "F4_MOD_DT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":50,  "DATATYPE":"STRING"} }' );   // MOD 밸리데이션 선언
//폼뷰 컨트롤러 경로
var url_F4_SEARCH = "appapiController?CTLGRP=F4&CTLFNC=SEARCH";
//폼뷰 컨트롤러 경로
var url_F4_SAVE = "appapiController?CTLGRP=F4&CTLFNC=SAVE";
//폼뷰 컨트롤러 경로
var url_F4_RELOAD = "appapiController?CTLGRP=F4&CTLFNC=RELOAD";
//폼뷰 컨트롤러 경로
var url_F4_NEW = "appapiController?CTLGRP=F4&CTLFNC=NEW";
//폼뷰 컨트롤러 경로
var url_F4_DELETE = "appapiController?CTLGRP=F4&CTLFNC=DELETE";
//폼뷰 컨트롤러 경로
var url_F4_MOD = "appapiController?CTLGRP=F4&CTLFNC=MOD";
var obj_F4_API_SEQ;   // SEQ 글로벌 변수 선언
var obj_F4_API_NM;   // NM 글로벌 변수 선언
var obj_F4_PGM_ID;   // ID 글로벌 변수 선언
var obj_F4_URL;   // URL 글로벌 변수 선언
var obj_F4_REQ_ENCTYPE;   // REQENCTYPE 글로벌 변수 선언
var obj_F4_REQ_DATATYPE;   // REQDATATYPE 글로벌 변수 선언
var obj_F4_REQ_BODY;   // REQBODY 글로벌 변수 선언
var obj_F4_RES_BODY;   // RESBODY 글로벌 변수 선언
var obj_F4_MYFILESVRNM;   // MYFILESVRNM 글로벌 변수 선언
var obj_F4_MYFILE;   // MYFILE 글로벌 변수 선언
var obj_F4_MYFILE_VIEWER;   // 이미지뷰어 글로벌 변수 선언
var obj_F4_ADD_DT;   // ADD 글로벌 변수 선언
var obj_F4_MOD_DT;   // MOD 글로벌 변수 선언
//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	C2_INIT();	
		G3_INIT();	
		F4_INIT();	
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
function C2_INIT(){
  alog("C2_INIT()-------------------------start	");




	//각 폼 오브젝트들 초기화
	//API_SEQ, SEQ 초기화	
	//API_NM, NM 초기화	
	//PGM_ID, ID 초기화	
	//URL, URL 초기화	
  alog("C2_INIT()-------------------------end");
}

	//그리드1 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 그리드1"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("#master_checkbox,SEQ,NM,ID,URL,REQENCTYPE,REQDATATYPE,img:[../img/crypt_shield.png]REQBODY,img:[../img/crypt_shield.png]RESBODY,MYFILE,MYFILESVRNM,ADD,MOD,CHK");
		mygridG3.setColumnIds("ROWCHK,API_SEQ,API_NM,PGM_ID,URL,REQ_ENCTYPE,REQ_DATATYPE,REQ_BODY,RES_BODY,MYFILE,MYFILESVRNM,ADD_DT,MOD_DT,CHK");
		mygridG3.setInitWidths("40,60,60,60,60,120px,60,100,100,120px,60px,60,60px,50");
		mygridG3.setColTypes("ch,ed,ed,ed,ed,co,co,txttxt,txttxt,ed,ed,ro,ro,ch");
	//가로 정렬	
		mygridG3.setColAlign("center,left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG3.setColSorting("int,str,str,str,str,str,str,str,str,str,str,str,str,int");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_ROWCHK,G3_API_SEQ,G3_API_NM,G3_PGM_ID,G3_URL,G3_REQ_ENCTYPE,G3_REQ_DATATYPE,G3_REQ_BODY,G3_RES_BODY,G3_MYFILE,G3_MYFILESVRNM,G3_ADD_DT,G3_MOD_DT,G3_CHK");
		mygridG3.splitAt(3);//'freezes' 3 columns 
		mygridG3.init();
		//블럭선택 및 복사
		mygridG3.enableBlockSelection(true);
		mygridG3.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG3.editor){
				mygridG3.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG3.copyBlockToClipboard();

					var top_row_idx = mygridG3.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG3.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG3.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG3.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG3.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG3.getRowId(j);
						RowEditStatus = mygridG3.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG3.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG3.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : ROWCHK초기화	
		 // IO : SEQ초기화	
		 // IO : NM초기화	
		 // IO : ID초기화	
		 // IO : URL초기화	
		setCodeCombo("GRID",mygridG3.getCombo(mygridG3.getColIndexById("REQ_ENCTYPE")),"FORMENCTYPE"); // IO : REQENCTYPE초기화	
		setCodeCombo("GRID",mygridG3.getCombo(mygridG3.getColIndexById("REQ_DATATYPE")),"REQDATATYPE"); // IO : REQDATATYPE초기화	
		 // IO : REQBODY초기화	
		 // IO : RESBODY초기화	
		 // IO : MYFILE초기화	
		 // IO : MYFILESVRNM초기화	
		 // IO : ADD초기화	
		 // IO : MOD초기화	
		 // IO : CHK초기화	
	//onCheck
		mygridG3.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//ROW 마스터 체크 박스는 변경이면 실제 row 안함
			if(  mygridG3.getColumnId(cellInd) == "ROWCHK" ){
					mygridG3.cells(rowId,cellInd).cell.wasChanged = false;	
			}	
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
			|| mygridG3.getColumnId(cellInd) == "CHK"
				){
				RowEditStatus = mygridG3.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG3.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG3.setRowTextBold(rowId);
					mygridG3.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG3.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG3.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect20(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG3json && popG3json.CD){
				goOpenerReturn(popG3json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			//', "ROWCHK" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ROWCHK")).getValue()) + '"' +
			//', "API_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("API_SEQ")).getValue()) + '"' +
			//', "API_NM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("API_NM")).getValue()) + '"' +
			//', "PGM_ID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PGM_ID")).getValue()) + '"' +
			//', "URL" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("URL")).getValue()) + '"' +
			//', "REQ_ENCTYPE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("REQ_ENCTYPE")).getValue()) + '"' +
			//', "REQ_DATATYPE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("REQ_DATATYPE")).getValue()) + '"' +
			//', "REQ_BODY" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("REQ_BODY")).getValue()) + '"' +
			//', "RES_BODY" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("RES_BODY")).getValue()) + '"' +
			//', "MYFILE" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MYFILE")).getValue()) + '"' +
			//', "MYFILESVRNM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MYFILESVRNM")).getValue()) + '"' +
			//', "ADD_DT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADD_DT")).getValue()) + '"' +
			//', "MOD_DT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MOD_DT")).getValue()) + '"' +
			//', "CHK" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("CHK")).getValue()) + '"' +
			//'}');
		//A124
			lastinputF4json = jQuery.parseJSON('{ "__NAME":"lastinputF4json"' +
				', "G3-API_SEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("API_SEQ")).getValue()) + '"' +
			'}');
		lastinputF4 = new FormData(); // 폼뷰1
		lastinputF4.append("G3-API_SEQ", mygridG3.cells(rowID,mygridG3.getColIndexById("API_SEQ")).getValue().replace(/&amp;/g, "&")); // 
		F4_SEARCH(lastinputF4,uuidv4()); //자식그룹 호출 : 폼뷰1
		});
		mygridG3.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG3  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG3.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG3.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG3.setRowTextBold(rId);
                }
                mygridG3.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
		mygridG3.setColumnHidden(mygridG3.getColIndexById("API_SEQ"),true); //SEQ
        alog("G3_INIT()-------------------------end");
     }
//디테일 초기화	
//폼뷰1 폼뷰 초기화
function F4_INIT(){
  alog("F4_INIT()-------------------------start");




setCodeCombo("FORMVIEW",$("#F4-REQ_ENCTYPE"),"FORMENCTYPE");
setCodeCombo("FORMVIEW",$("#F4-REQ_DATATYPE"),"REQDATATYPE");







	//컬럼 초기화
	//API_SEQ, SEQ 초기화	
	//API_NM, NM 초기화	
	//PGM_ID, ID 초기화	
	//URL, URL 초기화	
	//MYFILESVRNM, MYFILESVRNM 초기화	
	$("#F4-MYFILESVRNM").attr("readonly",true);
	//MYFILE, MYFILE 초기화		//MYFILE_VIEWER, 이미지뷰어 초기화	
	//ADD_DT, ADD 초기화		//MOD_DT, MOD 초기화	  alog("F4_INIT()-------------------------end");
}
//D146 그룹별 기능 함수 출력		
// CONDITIONSearch	
function C2_SEARCHALL(token){
	alog("C2_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG3 = new FormData(); //그리드1
	//json : C2
            lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +'}');
	//  호출
	G3_SEARCH(lastinputG3,token);
	alog("C2_SEARCHALL--------------------------end");
}
//컨디션1, 저장	
function C2_SAVE(){
 alog("C2_SAVE-------------------start");
	//FormData parameter에 담아줌	
	var formData = new FormData();	//C2 getparams	
	//그리드G3 가져오기	
    mygridG3.setSerializationLevel(true,false,false,false,true,false);
    var paramsG3 = mygridG3.serialize();
	formData.append("G3-XML",paramsG3);
//폼뷰 F4는 params 객체에 직접 입력	
	var formview_data = $("#formviewF4").serializeArray();
    $.each(formview_data,function(i,nmval){
        formData.append(nmval.name,nmval.value);
	});
	if($("#F4_MYFILE").val() != ""){
		formData.append("F4-MYFILE",$("input[name=F4-MYFILE]")[0].files[0]);
	}
//var params = { CTL : "C2_SAVE", G3_XML : paramsG3		, F4-API_SEQ : , F4-API_NM : , F4-PGM_ID : , F4-URL : , F4-REQ_ENCTYPE : , F4-REQ_DATATYPE : , F4-REQ_BODY : , F4-RES_BODY : , F4-MYFILESVRNM : , F4-MYFILE : , F4-MYFILE_VIEWER : , F4-ADD_DT : , F4-MOD_DT : };
	$.ajax({	
		type : "POST",
		url : url_C2_SAVE  ,
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
			msgError("[C2] Ajax http 500 error ( " + error + " )");
			alog("[C2] Ajax http 500 error ( " + error + " )");
		}
	});
	alog("C2_SAVE-------------------end");	
}
//검색조건 초기화
function C2_RESET(){
	alog("C2_RESET--------------------------start");
	$('#condition')[0].reset();
}
function G3_CHKSAVE(){
	alog("G3_CHKSAVE()------------start");
	tgrid = mygridG3;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG3.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}	//CHK 배열 합치기
	sendFormData.append("G3-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G3_CHKSAVE + "&" + lastinputG3 ,
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
	
	alog("G3_CHKSAVE()------------end");
}
    function G3_HIDDENCOL(){
		alog("G3_HIDDENCOL()..................start");
        if(isToggleHiddenColG3){
            isToggleHiddenColG3 = false;            mygridG3.setColumnHidden(mygridG3.getColIndexById("API_SEQ"),true); //SEQ
     }else{
            isToggleHiddenColG3 = true;
            mygridG3.setColumnHidden(mygridG3.getColIndexById("API_SEQ"),false); //SEQ
        }
		alog("G3_HIDDENCOL()..................end");
    }
//행추가3 (그리드1)	
//그리드 행추가 : 그리드1
	function G3_ROWADD(){
		if( !(lastinputG3)){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","","","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}







    //그리드 조회(그리드1)	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

		var tGrid = mygridG3;

        //그리드 초기화
        tGrid.clearAll();        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of tinput.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
        //불러오기
        $.ajax({
            type : "POST",
            url : url_G3_SEARCH+"&TOKEN=" + token + " &G3_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG3 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG3Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[그리드1] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[그리드1] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[그리드1] Ajax http 500 error ( " + error + " )",3);
                alog("[그리드1] Ajax http 500 error ( " + error + " )");
            }
        });
        alog("G3_SEARCH()------------end");
    }

	function G3_SAVE(token){
	alog("G3_SAVE()------------start");
	tgrid = mygridG3;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG3.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
	sendFormData.append("G3-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G3_SAVE + "&TOKEN=" + token,
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
	
	alog("G3_SAVE()------------end");
}
//새로고침	
function G3_RELOAD(token){
  alog("G3_RELOAD-----------------start");
  G3_SEARCH(lastinputG3,token);
}
    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
    }
//엑셀다운		
function G3_EXCEL(){	
	alog("G3_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG3.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG3.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("ROWCHK,API_SEQ,API_NM,PGM_ID,URL,REQ_ENCTYPE,REQ_DATATYPE,REQ_BODY,RES_BODY,MYFILE,MYFILESVRNM,ADD_DT,MOD_DT,CHK");
	$("#DATA_WIDTHS").val("40,60,60,60,60,120px,60,100,100,120px,60px,60,60px,50");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//새로고침	
function F4_RELOAD(){
	alog("F4_RELOAD-----------------start");
	F4_SEARCH(lastinputF4json,token);
}//F4_SAVE
//IO_FILE_YN = Y	
function F4_SAVE(token){	
	alog("F4_SAVE---------------start");

	if( !( $("#F4-CTLCUD").val() == "C" || $("#F4-CTLCUD").val() == "U") ){
		alert("신규 또는 수정 모드 진입 후 저장할 수 있습니다.")
		return;
	}

	//전송용 데이터 생성하기
	var sendFormData = new FormData($("#formviewF4")[0]);

	//컨디션 데이터 추가하기
	conditionData = new FormData($("#condition")[0]);
	for(var pair of conditionData.entries()) {
		sendFormData.append(pair[0],pair[1]);
		//console.log(pair[0]+ ', '+ pair[1]); 
	}


	$.ajax({
		type : "POST",
		url : url_F4_SAVE + "&TOKEN=" + token,
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
function F4_DELETE(){	
	alog("F4_DELETE---------------start");

	//조회했는지 확인하기
	if( $("#F4-CTLCUD").val() != "R" ){
		alert("조회된 것만 삭제 가능합니다.");
		return;
	}
	//확인
	if(!confirm("정말로 삭제하시겠습니까?")){
		return;
	}
	
	//삭제처리 명령어
	$("#F4-CTLCUD").val("D");

	//폼객체를 불러와서
	var form1 = $("#formviewF4")[0];

	//FormData parameter에 담아줌
	var formData = new FormData(form1);

	$.ajax({
		type : "POST",
		url : url_F4_DELETE,
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
//디테일 검색	
function F4_SEARCH(tinput,token){
       alog("(FORMVIEW) F4_SEARCH---------------start");

	//post 만들기
	sendFormData = new FormData($("#condition")[0]);
	for(var pair of tinput.entries()) {
		sendFormData.append(pair[0],pair[1]);
		//console.log(pair[0]+ ', '+ pair[1]); 
	}

    $.ajax({
        type : "POST",
        url : url_F4_SEARCH+"&TOKEN=" + token + "&F4_CRUD_MODE=SEARCH" ,
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
            $("#F4-CTLCUD").val("R");
			//SETVAL  가져와서 세팅
			$("#F4-API_SEQ").val(data.RTN_DATA.API_SEQ);//SEQ 변수세팅
			$("#F4-API_NM").val(data.RTN_DATA.API_NM);//NM 변수세팅
			$("#F4-PGM_ID").val(data.RTN_DATA.PGM_ID);//ID 변수세팅
			$("#F4-URL").val(data.RTN_DATA.URL);//URL 변수세팅
			$("#F4-REQ_ENCTYPE").val(data.RTN_DATA.REQ_ENCTYPE);//REQENCTYPE 변수세팅
			$("#F4-REQ_DATATYPE").val(data.RTN_DATA.REQ_DATATYPE);//REQDATATYPE 변수세팅
		$("#F4-REQ_BODY").val(data.RTN_DATA.REQ_BODY);//REQBODY 오브젝트 값세팅
		$("#F4-RES_BODY").val(data.RTN_DATA.RES_BODY);//RESBODY 오브젝트 값세팅
			$("#F4-MYFILESVRNM").val(data.RTN_DATA.MYFILESVRNM);//MYFILESVRNM 변수세팅
			//$("#F4-MYFILE").val(data.RTN_DATA.MYFILE);//MYFILE, JS오류남
			$("#F4-MYFILE_link").attr("href",data.RTN_DATA.MYFILE_link);//MYFILE 변수세팅
			$("#F4-MYFILE_name").text(data.RTN_DATA.MYFILE);//MYFILE 변수세팅
			//IMAGE VIEWER ( format : thumb_url:real_url,thumb_url:real_url )
			$("#F4-MYFILE_VIEWER").html("");
			if(data.RTN_DATA.MYFILE_VIEWER){
				var tArray1 = data.RTN_DATA.MYFILE_VIEWER.split(",");
				if(data.RTN_DATA.MYFILE_VIEWER && tArray1.length > 0){
					for(var t=0;t<tArray1.length;t++){
						var tArray2 = tArray1[t].split(":");//0 thumb, 1 real
						$("#F4-MYFILE_VIEWER").append("<span><a href='" + tArray2[0] + "' target='_blank'><img src='" + tArray2[1] + "' height='80' border=0></a></span>"); 						
					}
				}
			}
			$("#F4-ADD_DT").text(data.RTN_DATA.ADD_DT);//ADD 변수세팅
			$("#F4-MOD_DT").text(data.RTN_DATA.MOD_DT);//MOD 변수세팅
        },
        error: function(error){
            alog("Error:");
            alog(error);
        }
    });    alog("(FORMVIEW) F4_SEARCH---------------end");

}
function F4_MOD(){
       alog("[FromView] F4_MOD---------------start");
	if( $("#F4-CTLCUD").val() == "C" ){
		alert("조회 후 수정 가능합니다. 신규 모드에서는 수정할 수 없습니다.")
		return;
	}
	if( $("#F4-CTLCUD").val() == "D" ){
		alert("조회 후 수정 가능합니다. 삭제 모드에서는 수정할 수 없습니다.")
		return;
	}

	$("#F4-CTLCUD").val("U");
       alog("[FromView] F4_MOD---------------end");
}
//	
function F4_NEW(){
       alog("[FromView] F4_NEW---------------start");
	$("#F4-CTLCUD").val("C");
	//PMGIO 로직
	$("#F4-API_SEQ").val("");//SEQ 신규초기화	
	$("#F4-API_NM").val("");//NM 신규초기화	
	$("#F4-PGM_ID").val("");//ID 신규초기화	
	$("#F4-URL").val("");//URL 신규초기화	
	$("#F4-REQ_BODY").val("");//REQBODY 신규초기화
	$("#F4-RES_BODY").val("");//RESBODY 신규초기화
	$("#F4-MYFILESVRNM").val("");//MYFILESVRNM 신규초기화	
	$("#F4-MYFILE").val("");//MYFILE 신규초기화	
	$("#F4-MYFILE_VIEWER").html("");
	$("#F4-ADD_DT").text("");//ADD 신규초기화		$("#F4-MOD_DT").text("");//MOD 신규초기화	       alog("DETAILNew30---------------end");
}
