//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_SEARCHALL = "usermngController?CTLGRP=C1&CTLFNC=SEARCHALL";//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_SAVE = "usermngController?CTLGRP=C1&CTLFNC=SAVE";//버틀 그룹쪽에서 컨틀롤러 호출
var url_C1_RESET = "usermngController?CTLGRP=C1&CTLFNC=RESET";//조건1 변수 선언	
var obj_C1_EMAIL_valid = jQuery.parseJSON( '{ "C1_EMAIL": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":20,  "DATATYPE":"STRING"} }' );  //이메일  밸리데이션
var obj_C1_EMAIL; // 이메일 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G2_USERDEF = "usermngController?CTLGRP=G2&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G2_SEARCH = "usermngController?CTLGRP=G2&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G2_SAVE = "usermngController?CTLGRP=G2&CTLFNC=SAVE";
//컨트롤러 경로
var url_G2_ROWDELETE = "usermngController?CTLGRP=G2&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G2_ROWADD = "usermngController?CTLGRP=G2&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G2_RELOAD = "usermngController?CTLGRP=G2&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G2_HIDDENCOL = "usermngController?CTLGRP=G2&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G2_EXCEL = "usermngController?CTLGRP=G2&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G2_CHKSAVE = "usermngController?CTLGRP=G2&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG2,isToggleHiddenColG2,lastinputG2,lastinputG2json,lastrowidG2;
var lastselectG2json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_USERDEF = "usermngController?CTLGRP=G3&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G3_SEARCH = "usermngController?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "usermngController?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "usermngController?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "usermngController?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "usermngController?CTLGRP=G3&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G3_HIDDENCOL = "usermngController?CTLGRP=G3&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G3_EXCEL = "usermngController?CTLGRP=G3&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G3_CHKSAVE = "usermngController?CTLGRP=G3&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G4_USERDEF = "usermngController?CTLGRP=G4&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G4_SEARCH = "usermngController?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_SAVE = "usermngController?CTLGRP=G4&CTLFNC=SAVE";
//컨트롤러 경로
var url_G4_ROWDELETE = "usermngController?CTLGRP=G4&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G4_ROWADD = "usermngController?CTLGRP=G4&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G4_RELOAD = "usermngController?CTLGRP=G4&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G4_HIDDENCOL = "usermngController?CTLGRP=G4&CTLFNC=HIDDENCOL";
//컨트롤러 경로
var url_G4_EXCEL = "usermngController?CTLGRP=G4&CTLFNC=EXCEL";
//컨트롤러 경로
var url_G4_CHKSAVE = "usermngController?CTLGRP=G4&CTLFNC=CHKSAVE";
//그리드 객체
var mygridG4,isToggleHiddenColG4,lastinputG4,lastinputG4json,lastrowidG4;
var lastselectG4json;//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	C1_INIT();	
		G2_INIT();	
		G3_INIT();	
		G4_INIT();	
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
function C1_INIT(){
  alog("C1_INIT()-------------------------start	");

	//각 폼 오브젝트들 초기화
	//EMAIL, 이메일 초기화	
  alog("C1_INIT()-------------------------end");
}

	//사용자1 그리드 초기화
function G2_INIT(){
  alog("G2_INIT()-------------------------start");

        //그리드 초기화
        mygridG2 = new dhtmlXGridObject('gridG2');
        mygridG2.setDateFormat("%Y%m%d");
        mygridG2.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG2.setUserData("","gridTitle","G2 : 사용자1"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG2.setHeader("USERSEQ,이메일,img:[../img/crypt_lock.png]PASSWD,이메일인증,비번변경일,로그인실패횟수,잠금유무,잠금대기시간,잠긴시간,SERVERSEQ,ADDDT,수정일");
		mygridG2.setColumnIds("USERSEQ,EMAIL,PASSWD,EMAILVALIDYN,LASTPWCHGDT,PWFAILCNT,LOCKYN,FREEZEDT,LOCKDT,SERVERSEQ,ADDDT,MODDT");
		mygridG2.setInitWidths("60,60,120,60,60,60,60,60,60,60,40,40");
		mygridG2.setColTypes("ro,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
		mygridG2.setColAlign("left,left,left,left,left,left,left,right,left,left,left,left");
		mygridG2.setColSorting("int,str,str,str,str,int,str,str,str,int,str,str");		//렌더링	
		mygridG2.enableSmartRendering(false);
		mygridG2.enableMultiselect(true);
		//mygridG2.setColValidators("G2_USERSEQ,G2_EMAIL,G2_PASSWD,G2_EMAILVALIDYN,G2_LASTPWCHGDT,G2_PWFAILCNT,G2_LOCKYN,G2_FREEZEDT,G2_LOCKDT,G2_SERVERSEQ,G2_ADDDT,G2_MODDT");
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
		 // IO : USERSEQ초기화	
		 // IO : 이메일초기화	
		 // IO : PASSWD초기화	
		 // IO : 이메일인증초기화	
		 // IO : 비번변경일초기화	
		 // IO : 로그인실패횟수초기화	
		 // IO : 잠금유무초기화	
		 // IO : 잠금대기시간초기화	
		 // IO : 잠긴시간초기화	
		 // IO : SERVERSEQ초기화	
		 // IO : ADDDT초기화	
		 // IO : 수정일초기화	
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
			//GRIDRowSelect30(rowID,celInd);
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
			//', "USERSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USERSEQ")).getValue()) + '"' +
			//', "EMAIL" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("EMAIL")).getValue()) + '"' +
			//', "PASSWD" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PASSWD")).getValue()) + '"' +
			//', "EMAILVALIDYN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("EMAILVALIDYN")).getValue()) + '"' +
			//', "LASTPWCHGDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LASTPWCHGDT")).getValue()) + '"' +
			//', "PWFAILCNT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("PWFAILCNT")).getValue()) + '"' +
			//', "LOCKYN" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LOCKYN")).getValue()) + '"' +
			//', "FREEZEDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("FREEZEDT")).getValue()) + '"' +
			//', "LOCKDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("LOCKDT")).getValue()) + '"' +
			//', "SERVERSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("SERVERSEQ")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
				', "G2-USERSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USERSEQ")).getValue()) + '"' +
			'}');
		lastinputG3 = new FormData(); // 프로젝트2
		lastinputG3.append("G2-USERSEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("USERSEQ")).getValue().replace(/&amp;/g, "&")); // 
			lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
				', "G2-USERSEQ" : "' + q(mygridG2.cells(rowID,mygridG2.getColIndexById("USERSEQ")).getValue()) + '"' +
			'}');
		lastinputG4 = new FormData(); // 서버4
		lastinputG4.append("G2-USERSEQ", mygridG2.cells(rowID,mygridG2.getColIndexById("USERSEQ")).getValue().replace(/&amp;/g, "&")); // 
		G3_SEARCH(lastinputG3,uuidv4()); //자식그룹 호출 : 프로젝트2
		G4_SEARCH(lastinputG4,uuidv4()); //자식그룹 호출 : 서버4
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
		mygridG2.setColumnHidden(mygridG2.getColIndexById("USERSEQ"),true); //USERSEQ
        alog("G2_INIT()-------------------------end");
     }
	//프로젝트2 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : 프로젝트2"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("USERSEQ,SEQ,ADDDT,수정일");
		mygridG3.setColumnIds("USERSEQ,PJTSEQ,ADDDT,MODDT");
		mygridG3.setInitWidths("60,60,40,40");
		mygridG3.setColTypes("ro,ed,ed,ed");
	//가로 정렬	
		mygridG3.setColAlign("left,left,left,left");
		mygridG3.setColSorting("int,int,str,str");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_USERSEQ,G3_PJTSEQ,G3_ADDDT,G3_MODDT");
		mygridG3.splitAt(0);//'freezes' 0 columns 
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
		 // IO : USERSEQ초기화	
		 // IO : SEQ초기화	
		 // IO : ADDDT초기화	
		 // IO : 수정일초기화	
	//onCheck
		mygridG3.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
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
			//GRIDRowSelect40(rowID,celInd);
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
			//', "USERSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("USERSEQ")).getValue()) + '"' +
			//', "PJTSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
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
        alog("G3_INIT()-------------------------end");
     }
	//서버4 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setDateFormat("%Y%m%d");
        mygridG4.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG4.setUserData("","gridTitle","G4 : 서버4"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG4.setHeader("SERVERSEQ,SVRID,SVRNM,PJTSEQ,USERSEQ,DBHOST,DBPORT,DBNAME,DBUSERID,img:[../img/crypt_shield.png]DBUSERPW,사용유무,ADDDT,수정일");
		mygridG4.setColumnIds("SVRSEQ,SVRID,SVRNM,PJTSEQ,USERSEQ,DBHOST,DBPORT,DBNAME,DBUSRID,DBUSRPW,USEYN,ADDDT,MODDT");
		mygridG4.setInitWidths("60,60,60,30,60,60,60,60,60,120,50,40,40");
		mygridG4.setColTypes("ro,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
		mygridG4.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG4.setColSorting("int,str,str,int,int,str,str,str,str,str,str,str,str");		//렌더링	
		mygridG4.enableSmartRendering(false);
		mygridG4.enableMultiselect(true);
		//mygridG4.setColValidators("G4_SVRSEQ,G4_SVRID,G4_SVRNM,G4_PJTSEQ,G4_USERSEQ,G4_DBHOST,G4_DBPORT,G4_DBNAME,G4_DBUSRID,G4_DBUSRPW,G4_USEYN,G4_ADDDT,G4_MODDT");
		mygridG4.splitAt(0);//'freezes' 0 columns 
		mygridG4.init();
		//블럭선택 및 복사
		mygridG4.enableBlockSelection(true);
		mygridG4.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG4.editor){
				mygridG4.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG4.copyBlockToClipboard();

					var top_row_idx = mygridG4.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG4.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG4.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG4.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG4.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG4.getRowId(j);
						RowEditStatus = mygridG4.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG4.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG4.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : SERVERSEQ초기화	
		 // IO : SVRID초기화	
		 // IO : SVRNM초기화	
		 // IO : PJTSEQ초기화	
		 // IO : USERSEQ초기화	
		 // IO : DBHOST초기화	
		 // IO : DBPORT초기화	
		 // IO : DBNAME초기화	
		 // IO : DBUSERID초기화	
		 // IO : DBUSERPW초기화	
		 // IO : 사용유무초기화	
		 // IO : ADDDT초기화	
		 // IO : 수정일초기화	
	//onCheck
		mygridG4.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG4.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG4.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG4.setRowTextBold(rowId);
					mygridG4.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG4.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG4.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect50(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG4json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG4json && popG4json.CD){
				goOpenerReturn(popG4json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
			//', "SVRSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("SVRSEQ")).getValue()) + '"' +
			//', "SVRID" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("SVRID")).getValue()) + '"' +
			//', "SVRNM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("SVRNM")).getValue()) + '"' +
			//', "PJTSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "USERSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("USERSEQ")).getValue()) + '"' +
			//', "DBHOST" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("DBHOST")).getValue()) + '"' +
			//', "DBPORT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("DBPORT")).getValue()) + '"' +
			//', "DBNAME" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("DBNAME")).getValue()) + '"' +
			//', "DBUSRID" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("DBUSRID")).getValue()) + '"' +
			//', "DBUSRPW" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("DBUSRPW")).getValue()) + '"' +
			//', "USEYN" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("USEYN")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG4.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG4  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG4.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG4.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG4.setRowTextBold(rId);
                }
                mygridG4.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G4_INIT()-------------------------end");
     }
//D146 그룹별 기능 함수 출력		
//검색조건 초기화
function C1_RESET(){
	alog("C1_RESET--------------------------start");
	$('#condition')[0].reset();
}
// CONDITIONSearch	
function C1_SEARCHALL(token){
	alog("C1_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG2 = new FormData(); //사용자1
	//json : C1
            lastinputG2json = jQuery.parseJSON('{ "__NAME":"lastinputG2json"' +'}');
	//  호출
	G2_SEARCH(lastinputG2,token);
	alog("C1_SEARCHALL--------------------------end");
}
//조건1, 저장	
function C1_SAVE(){
 alog("C1_SAVE-------------------start");
	//FormData parameter에 담아줌	
	var formData = new FormData();	//C1 getparams	
//var params = { CTL : "C1_SAVE"};
	$.ajax({	
		type : "POST",
		url : url_C1_SAVE  ,
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
			msgError("[C1] Ajax http 500 error ( " + error + " )");
			alog("[C1] Ajax http 500 error ( " + error + " )");
		}
	});
	alog("C1_SAVE-------------------end");	
}
    function G2_ROWDELETE(){	
        alog("G2_ROWDELETE()------------start");
        delRow(mygridG2);
        alog("G2_ROWDELETE()------------start");
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
	function G2_USERDEF(token){
	alog("G2_USERDEF()------------start");
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
		url : url_G2_USERDEF + "&TOKEN=" + token,
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
	
	alog("G2_USERDEF()------------end");
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
	$("#DATA_HEADERS").val("USERSEQ,EMAIL,PASSWD,EMAILVALIDYN,LASTPWCHGDT,PWFAILCNT,LOCKYN,FREEZEDT,LOCKDT,SERVERSEQ,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("60,60,120,60,60,60,60,60,60,60,40,40");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//행추가3 (사용자1)	
//그리드 행추가 : 사용자1
	function G2_ROWADD(){
		if( !(lastinputG2)){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","","","",""];//초기값
			addRow(mygridG2,tCols);
		}
	}	function G2_SAVE(token){
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
    function G2_HIDDENCOL(){
		alog("G2_HIDDENCOL()..................start");
        if(isToggleHiddenColG2){
            isToggleHiddenColG2 = false;            mygridG2.setColumnHidden(mygridG2.getColIndexById("USERSEQ"),true); //USERSEQ
     }else{
            isToggleHiddenColG2 = true;
            mygridG2.setColumnHidden(mygridG2.getColIndexById("USERSEQ"),false); //USERSEQ
        }
		alog("G2_HIDDENCOL()..................end");
    }








    //그리드 조회(사용자1)	
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
					msgNotice("[사용자1] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[사용자1] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[사용자1] Ajax http 500 error ( " + error + " )",3);
                alog("[사용자1] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G2_SEARCH()------------end");
    }

//새로고침	
function G2_RELOAD(token){
  alog("G2_RELOAD-----------------start");
  G2_SEARCH(lastinputG2,token);
}








    //그리드 조회(프로젝트2)	
    function G3_SEARCH(tinput,token){
        alog("G3_SEARCH()------------start");

		var tGrid = mygridG3;

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
					msgNotice("[프로젝트2] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[프로젝트2] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[프로젝트2] Ajax http 500 error ( " + error + " )",3);
                alog("[프로젝트2] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G3_SEARCH()------------end");
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
	$("#DATA_HEADERS").val("USERSEQ,PJTSEQ,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("60,60,40,40");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//행추가3 (프로젝트2)	
//그리드 행추가 : 프로젝트2
	function G3_ROWADD(){
		if( !(lastinputG3)|| lastinputG3.get("G3-USERSEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = [lastinputG3.get("G2-USERSEQ"),"","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}	function G3_SAVE(token){
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
    function G3_HIDDENCOL(){
		alog("G3_HIDDENCOL()..................start");
        if(isToggleHiddenColG3){
            isToggleHiddenColG3 = false;     }else{
            isToggleHiddenColG3 = true;
        }
		alog("G3_HIDDENCOL()..................end");
    }
    function G4_HIDDENCOL(){
		alog("G4_HIDDENCOL()..................start");
        if(isToggleHiddenColG4){
            isToggleHiddenColG4 = false;     }else{
            isToggleHiddenColG4 = true;
        }
		alog("G4_HIDDENCOL()..................end");
    }








    //그리드 조회(서버4)	
    function G4_SEARCH(tinput,token){
        alog("G4_SEARCH()------------start");

		var tGrid = mygridG4;

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
            url : url_G4_SEARCH+"&TOKEN=" + token + " &G4_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG4 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG4Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[서버4] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[서버4] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[서버4] Ajax http 500 error ( " + error + " )",3);
                alog("[서버4] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G4_SEARCH()------------end");
    }

//새로고침	
function G4_RELOAD(token){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4,token);
}
    function G4_ROWDELETE(){	
        alog("G4_ROWDELETE()------------start");
        delRow(mygridG4);
        alog("G4_ROWDELETE()------------start");
    }
function G4_CHKSAVE(){
	alog("G4_CHKSAVE()------------start");
	tgrid = mygridG4;

	//체크된 ROW의 ID 배열로 불러오기
	var arrRows =  tgrid.getCheckedRows(0); //0번째 CHK 컬럼
	//alert(arrRows.length);

        //전송용 post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG4.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}	//CHK 배열 합치기
	sendFormData.append("G4-CHK",arrRows);
	$.ajax({
		type : "POST",
		url : url_G4_CHKSAVE + "&" + lastinputG4 ,
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
	
	alog("G4_CHKSAVE()------------end");
}
//엑셀다운		
function G4_EXCEL(){	
	alog("G4_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG4.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG4.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("SVRSEQ,SVRID,SVRNM,PJTSEQ,USERSEQ,DBHOST,DBPORT,DBNAME,DBUSRID,DBUSRPW,USEYN,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("60,60,60,30,60,60,60,60,60,120,50,40,40");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//행추가3 (서버4)	
//그리드 행추가 : 서버4
	function G4_ROWADD(){
		if( !(lastinputG4)|| lastinputG4.get("G4-USERSEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","",lastinputG4.get("G2-USERSEQ"),"","","","","","","",""];//초기값
			addRow(mygridG4,tCols);
		}
	}	function G4_SAVE(token){
	alog("G4_SAVE()------------start");
	tgrid = mygridG4;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG4.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
	sendFormData.append("G4-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G4_SAVE + "&TOKEN=" + token,
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
	
	alog("G4_SAVE()------------end");
}
