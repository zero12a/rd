//글로벌 변수 선언	
//버틀 그룹쪽에서 컨틀롤러 호출
var url_G2_SEARCHALL = "pgmmngController?CTLGRP=G2&CTLFNC=SEARCHALL";//2 변수 선언	
var obj_G2_PJTID_valid = jQuery.parseJSON( '{ "G2_PJTID": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":30,  "DATATYPE":"STRING"} }' );  //프로젝트ID  밸리데이션
var obj_G2_ADDDT_valid = jQuery.parseJSON( '{ "G2_ADDDT": {"REQUARED":"",  "MIN":"",  "MAX":"",  "DATASIZE":14,  "DATATYPE":"STRING"} }' );  //생성일  밸리데이션
var obj_G2_PJTID; // 프로젝트ID 변수선언var obj_G2_ADDDT; // 생성일 변수선언//그리드 변수 초기화	
//컨트롤러 경로
var url_G3_SEARCH = "pgmmngController?CTLGRP=G3&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G3_SAVE = "pgmmngController?CTLGRP=G3&CTLFNC=SAVE";
//컨트롤러 경로
var url_G3_ROWDELETE = "pgmmngController?CTLGRP=G3&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G3_ROWADD = "pgmmngController?CTLGRP=G3&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G3_RELOAD = "pgmmngController?CTLGRP=G3&CTLFNC=RELOAD";
//그리드 객체
var mygridG3,isToggleHiddenColG3,lastinputG3,lastinputG3json,lastrowidG3;
var lastselectG3json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G4_SEARCH = "pgmmngController?CTLGRP=G4&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G4_SAVE = "pgmmngController?CTLGRP=G4&CTLFNC=SAVE";
//컨트롤러 경로
var url_G4_ROWDELETE = "pgmmngController?CTLGRP=G4&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G4_ROWADD = "pgmmngController?CTLGRP=G4&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G4_RELOAD = "pgmmngController?CTLGRP=G4&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G4_EXCEL = "pgmmngController?CTLGRP=G4&CTLFNC=EXCEL";
//그리드 객체
var mygridG4,isToggleHiddenColG4,lastinputG4,lastinputG4json,lastrowidG4;
var lastselectG4json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G5_SEARCH = "pgmmngController?CTLGRP=G5&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G5_SAVE = "pgmmngController?CTLGRP=G5&CTLFNC=SAVE";
//컨트롤러 경로
var url_G5_ROWDELETE = "pgmmngController?CTLGRP=G5&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G5_ROWADD = "pgmmngController?CTLGRP=G5&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G5_RELOAD = "pgmmngController?CTLGRP=G5&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G5_EXCEL = "pgmmngController?CTLGRP=G5&CTLFNC=EXCEL";
//그리드 객체
var mygridG5,isToggleHiddenColG5,lastinputG5,lastinputG5json,lastrowidG5;
var lastselectG5json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G6_USERDEF = "pgmmngController?CTLGRP=G6&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G6_SEARCH = "pgmmngController?CTLGRP=G6&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G6_SAVE = "pgmmngController?CTLGRP=G6&CTLFNC=SAVE";
//컨트롤러 경로
var url_G6_ROWDELETE = "pgmmngController?CTLGRP=G6&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G6_ROWADD = "pgmmngController?CTLGRP=G6&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G6_RELOAD = "pgmmngController?CTLGRP=G6&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G6_EXCEL = "pgmmngController?CTLGRP=G6&CTLFNC=EXCEL";
//그리드 객체
var mygridG6,isToggleHiddenColG6,lastinputG6,lastinputG6json,lastrowidG6;
var lastselectG6json;//그리드 변수 초기화	
//컨트롤러 경로
var url_G7_USERDEF = "pgmmngController?CTLGRP=G7&CTLFNC=USERDEF";
//컨트롤러 경로
var url_G7_SEARCH = "pgmmngController?CTLGRP=G7&CTLFNC=SEARCH";
//컨트롤러 경로
var url_G7_SAVE = "pgmmngController?CTLGRP=G7&CTLFNC=SAVE";
//컨트롤러 경로
var url_G7_ROWDELETE = "pgmmngController?CTLGRP=G7&CTLFNC=ROWDELETE";
//컨트롤러 경로
var url_G7_ROWADD = "pgmmngController?CTLGRP=G7&CTLFNC=ROWADD";
//컨트롤러 경로
var url_G7_RELOAD = "pgmmngController?CTLGRP=G7&CTLFNC=RELOAD";
//컨트롤러 경로
var url_G7_EXCEL = "pgmmngController?CTLGRP=G7&CTLFNC=EXCEL";
//그리드 객체
var mygridG7,isToggleHiddenColG7,lastinputG7,lastinputG7json,lastrowidG7;
var lastselectG7json;//화면 초기화	
function initBody(){
     alog("initBody()-----------------------start");
	
   //dhtmlx 메시지 박스 초기화
   dhtmlx.message.position="bottom";
	G2_INIT();	
		G3_INIT();	
		G4_INIT();	
		G5_INIT();	
		G6_INIT();	
		G7_INIT();	
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
function G2_INIT(){
  alog("G2_INIT()-------------------------start	");


	//각 폼 오브젝트들 초기화
	//PJTID, 프로젝트ID 초기화	
	$("#G2-PJTID").attr("readonly",true);
	//달력 ADDDT, 생성일
	$( "#G2-ADDDT" ).datepicker(dateFormatJson);
  alog("G2_INIT()-------------------------end");
}

	//PJT 그리드 초기화
function G3_INIT(){
  alog("G3_INIT()-------------------------start");

        //그리드 초기화
        mygridG3 = new dhtmlXGridObject('gridG3');
        mygridG3.setDateFormat("%Y%m%d");
        mygridG3.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG3.setUserData("","gridTitle","G3 : PJT"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG3.setHeader("SEQ,프로젝트ID,프로젝트명,파일 CHARSET,UITOOL,서버언어,DEPLOYKEY,패키지ROOT,시작일,종료일,삭제YN,ADDDT,수정일");
		mygridG3.setColumnIds("PJTSEQ,PJTID,PJTNM,FILECHARSET,UITOOL,SVRLANG,DEPLOYKEY,PKGROOT,STARTDT,ENDDT,DELYN,ADDDT,MODDT");
		mygridG3.setInitWidths("60,60,60,60,60,40,50,60,40,40,40,40,40");
		mygridG3.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,dhxCalendar,dhxCalendar,ed,ed,ed");
	//가로 정렬	
		mygridG3.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG3.setColSorting("int,str,str,str,str,str,str,str,str,str,str,str,str");		//렌더링	
		mygridG3.enableSmartRendering(false);
		mygridG3.enableMultiselect(true);
		//mygridG3.setColValidators("G3_PJTSEQ,G3_PJTID,G3_PJTNM,G3_FILECHARSET,G3_UITOOL,G3_SVRLANG,G3_DEPLOYKEY,G3_PKGROOT,G3_STARTDT,G3_ENDDT,G3_DELYN,G3_ADDDT,G3_MODDT");
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
		 // IO : SEQ초기화	
		 // IO : 프로젝트ID초기화	
		 // IO : 프로젝트명초기화	
		 // IO : 파일 CHARSET초기화	
		 // IO : UITOOL초기화	
		 // IO : 서버언어초기화	
		 // IO : DEPLOYKEY초기화	
		 // IO : 패키지ROOT초기화	
		 // IO : 시작일초기화	
		 // IO : 종료일초기화	
		 // IO : 삭제YN초기화	
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
			//GRIDRowSelect30(rowID,celInd);
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
			//', "PJTSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "PJTID" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTID")).getValue()) + '"' +
			//', "PJTNM" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTNM")).getValue()) + '"' +
			//', "FILECHARSET" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("FILECHARSET")).getValue()) + '"' +
			//', "UITOOL" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("UITOOL")).getValue()) + '"' +
			//', "SVRLANG" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("SVRLANG")).getValue()) + '"' +
			//', "DEPLOYKEY" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("DEPLOYKEY")).getValue()) + '"' +
			//', "PKGROOT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PKGROOT")).getValue()) + '"' +
			//', "STARTDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("STARTDT")).getValue()) + '"' +
			//', "ENDDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ENDDT")).getValue()) + '"' +
			//', "DELYN" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("DELYN")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
			lastinputG4json = jQuery.parseJSON('{ "__NAME":"lastinputG4json"' +
				', "G3-PJTSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue()) + '"' +
			'}');
		lastinputG4 = new FormData(); // PGM
		lastinputG4.append("G3-PJTSEQ", mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue().replace(/&amp;/g, "&")); // 
			lastinputG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +
				', "G3-PJTSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue()) + '"' +
			'}');
		lastinputG5 = new FormData(); // DD
		lastinputG5.append("G3-PJTSEQ", mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue().replace(/&amp;/g, "&")); // 
			lastinputG6json = jQuery.parseJSON('{ "__NAME":"lastinputG6json"' +
				', "G3-PJTSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue()) + '"' +
			'}');
		lastinputG6 = new FormData(); // CONFIG
		lastinputG6.append("G3-PJTSEQ", mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue().replace(/&amp;/g, "&")); // 
			lastinputG7json = jQuery.parseJSON('{ "__NAME":"lastinputG7json"' +
				', "G3-PJTSEQ" : "' + q(mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue()) + '"' +
			'}');
		lastinputG7 = new FormData(); // FILE
		lastinputG7.append("G3-PJTSEQ", mygridG3.cells(rowID,mygridG3.getColIndexById("PJTSEQ")).getValue().replace(/&amp;/g, "&")); // 
		G4_SEARCH(lastinputG4,uuidv4()); //자식그룹 호출 : PGM
		G5_SEARCH(lastinputG5,uuidv4()); //자식그룹 호출 : DD
		G6_SEARCH(lastinputG6,uuidv4()); //자식그룹 호출 : CONFIG
		G7_SEARCH(lastinputG7,uuidv4()); //자식그룹 호출 : FILE
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
	//PGM 그리드 초기화
function G4_INIT(){
  alog("G4_INIT()-------------------------start");

        //그리드 초기화
        mygridG4 = new dhtmlXGridObject('gridG4');
        mygridG4.setDateFormat("%Y%m%d");
        mygridG4.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG4.setUserData("","gridTitle","G4 : PGM"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG4.setHeader("PJTSEQ,SEQ,프로그램ID,프로그램이름,VIEWURL,PGMTYPE,POPWIDTH,POPHEIGHT,SECTYPE,PKGGRP,로그인필요,ADDDT,MODDT");
		mygridG4.setColumnIds("PJTSEQ,PGMSEQ,PGMID,PGMNM,VIEWURL,PGMTYPE,POPWIDTH,POPHEIGHT,SECTYPE,PKGGRP,LOGINYN,ADDDT,MODDT");
		mygridG4.setInitWidths("40,50,100,100,100,60,60,60,60,40,70,60,60");
		mygridG4.setColTypes("ed,ed,ed,ed,ed,co,ed,ed,co,ed,ed,ed,ed");
	//가로 정렬	
		mygridG4.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG4.setColSorting("int,int,str,str,str,str,str,str,str,str,str,str,str");		//렌더링	
		mygridG4.enableSmartRendering(false);
		mygridG4.enableMultiselect(true);
		//mygridG4.setColValidators("G4_PJTSEQ,G4_PGMSEQ,G4_PGMID,G4_PGMNM,G4_VIEWURL,G4_PGMTYPE,G4_POPWIDTH,G4_POPHEIGHT,G4_SECTYPE,G4_PKGGRP,G4_LOGINYN,G4_ADDDT,G4_MODDT");
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
		 // IO : PJTSEQ초기화	
		 // IO : SEQ초기화	
		 // IO : 프로그램ID초기화	
		 // IO : 프로그램이름초기화	
		 // IO : VIEWURL초기화	
		setCodeCombo("GRID",mygridG4.getCombo(mygridG4.getColIndexById("PGMTYPE")),"PGMTYPE"); // IO : PGMTYPE초기화	
		 // IO : POPWIDTH초기화	
		 // IO : POPHEIGHT초기화	
		setCodeCombo("GRID",mygridG4.getCombo(mygridG4.getColIndexById("SECTYPE")),"SECTYPE"); // IO : SECTYPE초기화	
		 // IO : PKGGRP초기화	
		 // IO : 로그인필요초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
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
			//GRIDRowSelect40(rowID,celInd);
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
			//', "PJTSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "PGMSEQ" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PGMSEQ")).getValue()) + '"' +
			//', "PGMID" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PGMID")).getValue()) + '"' +
			//', "PGMNM" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PGMNM")).getValue()) + '"' +
			//', "VIEWURL" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("VIEWURL")).getValue()) + '"' +
			//', "PGMTYPE" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PGMTYPE")).getValue()) + '"' +
			//', "POPWIDTH" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("POPWIDTH")).getValue()) + '"' +
			//', "POPHEIGHT" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("POPHEIGHT")).getValue()) + '"' +
			//', "SECTYPE" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("SECTYPE")).getValue()) + '"' +
			//', "PKGGRP" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("PKGGRP")).getValue()) + '"' +
			//', "LOGINYN" : "' + q(mygridG4.cells(rowID,mygridG4.getColIndexById("LOGINYN")).getValue()) + '"' +
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
	//DD 그리드 초기화
function G5_INIT(){
  alog("G5_INIT()-------------------------start");

        //그리드 초기화
        mygridG5 = new dhtmlXGridObject('gridG5');
        mygridG5.setDateFormat("%Y%m%d");
        mygridG5.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG5.setUserData("","gridTitle","G5 : DD"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG5.setHeader("PJTSEQ,DDSEQ,컬럼ID,컬럼명,단축명,데이터타입,데이터사이즈,오브젝트타입,OBJ폼뷰,OBJ그리드,라벨가로,가벨세로,LBLALIGN,오브젝트가로,오브젝트세로,가로정렬,CRYPTCD,VALIDSEQ,PIYN,등록일,수정일");
		mygridG5.setColumnIds("PJTSEQ,DDSEQ,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,OBJTYPE_FORMVIEW,OBJTYPE_GRID,LBLWIDTH,LBLHEIGHT,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,CRYPTCD,VALIDSEQ,PIYN,ADDDT,MODDT");
		mygridG5.setInitWidths("30,30,100,100,100,100,100,100,60,60,100,100,100,100,100,100,40,60,40,100,100");
		mygridG5.setColTypes("ro,ro,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
		mygridG5.setColAlign("left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left,left");
		mygridG5.setColSorting("int,int,str,str,str,str,int,str,str,str,str,str,str,str,str,str,str,int,str,str,str");		//렌더링	
		mygridG5.enableSmartRendering(false);
		mygridG5.enableMultiselect(true);
		//mygridG5.setColValidators("G5_PJTSEQ,G5_DDSEQ,G5_COLID,G5_COLNM,G5_COLSNM,G5_DATATYPE,G5_DATASIZE,G5_OBJTYPE,G5_OBJTYPE_FORMVIEW,G5_OBJTYPE_GRID,G5_LBLWIDTH,G5_LBLHEIGHT,G5_LBLALIGN,G5_OBJWIDTH,G5_OBJHEIGHT,G5_OBJALIGN,G5_CRYPTCD,G5_VALIDSEQ,G5_PIYN,G5_ADDDT,G5_MODDT");
		mygridG5.splitAt(3);//'freezes' 3 columns 
		mygridG5.init();
		//블럭선택 및 복사
		mygridG5.enableBlockSelection(true);
		mygridG5.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG5.editor){
				mygridG5.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG5.copyBlockToClipboard();

					var top_row_idx = mygridG5.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG5.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG5.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG5.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG5.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG5.getRowId(j);
						RowEditStatus = mygridG5.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG5.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG5.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : PJTSEQ초기화	
		 // IO : DDSEQ초기화	
		 // IO : 컬럼ID초기화	
		 // IO : 컬럼명초기화	
		 // IO : 단축명초기화	
		 // IO : 데이터타입초기화	
		 // IO : 데이터사이즈초기화	
		 // IO : 오브젝트타입초기화	
		 // IO : OBJ폼뷰초기화	
		 // IO : OBJ그리드초기화	
		 // IO : 라벨가로초기화	
		 // IO : 가벨세로초기화	
		 // IO : LBLALIGN초기화	
		 // IO : 오브젝트가로초기화	
		 // IO : 오브젝트세로초기화	
		 // IO : 가로정렬초기화	
		 // IO : CRYPTCD초기화	
		 // IO : VALIDSEQ초기화	
		 // IO : PIYN초기화	
		 // IO : 등록일초기화	
		 // IO : 수정일초기화	
	//onCheck
		mygridG5.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG5.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG5.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG5.setRowTextBold(rowId);
					mygridG5.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG5.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG5.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect50(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG5json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG5json && popG5json.CD){
				goOpenerReturn(popG5json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG5json = jQuery.parseJSON('{ "__NAME":"lastinputG5json"' +
			//', "PJTSEQ" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "DDSEQ" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("DDSEQ")).getValue()) + '"' +
			//', "COLID" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("COLID")).getValue()) + '"' +
			//', "COLNM" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("COLNM")).getValue()) + '"' +
			//', "COLSNM" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("COLSNM")).getValue()) + '"' +
			//', "DATATYPE" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("DATATYPE")).getValue()) + '"' +
			//', "DATASIZE" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("DATASIZE")).getValue()) + '"' +
			//', "OBJTYPE" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJTYPE")).getValue()) + '"' +
			//', "OBJTYPE_FORMVIEW" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJTYPE_FORMVIEW")).getValue()) + '"' +
			//', "OBJTYPE_GRID" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJTYPE_GRID")).getValue()) + '"' +
			//', "LBLWIDTH" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("LBLWIDTH")).getValue()) + '"' +
			//', "LBLHEIGHT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("LBLHEIGHT")).getValue()) + '"' +
			//', "LBLALIGN" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("LBLALIGN")).getValue()) + '"' +
			//', "OBJWIDTH" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJWIDTH")).getValue()) + '"' +
			//', "OBJHEIGHT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJHEIGHT")).getValue()) + '"' +
			//', "OBJALIGN" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("OBJALIGN")).getValue()) + '"' +
			//', "CRYPTCD" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("CRYPTCD")).getValue()) + '"' +
			//', "VALIDSEQ" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("VALIDSEQ")).getValue()) + '"' +
			//', "PIYN" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("PIYN")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG5.cells(rowID,mygridG5.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG5.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG5  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG5.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG5.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG5.setRowTextBold(rId);
                }
                mygridG5.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G5_INIT()-------------------------end");
     }
	//CONFIG 그리드 초기화
function G6_INIT(){
  alog("G6_INIT()-------------------------start");

        //그리드 초기화
        mygridG6 = new dhtmlXGridObject('gridG6');
        mygridG6.setDateFormat("%Y%m%d");
        mygridG6.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG6.setUserData("","gridTitle","G6 : CONFIG"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG6.setHeader("PJTSEQ,SEQ,사용,CFGID,CFGNM,MVCGBN,PATH,ORD,ADDDT,MODDT");
		mygridG6.setColumnIds("PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT");
		mygridG6.setInitWidths("30,50,50,60,120,60,300,30,80,80");
		mygridG6.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
		mygridG6.setColAlign("left,left,left,left,left,left,left,left,left,left");
		mygridG6.setColSorting("int,int,str,str,str,str,str,int,str,str");		//렌더링	
		mygridG6.enableSmartRendering(false);
		mygridG6.enableMultiselect(true);
		//mygridG6.setColValidators("G6_PJTSEQ,G6_CFGSEQ,G6_USEYN,G6_CFGID,G6_CFGNM,G6_MVCGBN,G6_PATH,G6_CFGORD,G6_ADDDT,G6_MODDT");
		mygridG6.splitAt(0);//'freezes' 0 columns 
		mygridG6.init();
		//블럭선택 및 복사
		mygridG6.enableBlockSelection(true);
		mygridG6.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG6.editor){
				mygridG6.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG6.copyBlockToClipboard();

					var top_row_idx = mygridG6.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG6.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG6.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG6.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG6.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG6.getRowId(j);
						RowEditStatus = mygridG6.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG6.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG6.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : PJTSEQ초기화	
		 // IO : SEQ초기화	
		 // IO : 사용초기화	
		 // IO : CFGID초기화	
		 // IO : CFGNM초기화	
		 // IO : MVCGBN초기화	
		 // IO : PATH초기화	
		 // IO : ORD초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
	//onCheck
		mygridG6.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG6.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG6.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG6.setRowTextBold(rowId);
					mygridG6.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG6.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG6.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect60(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG6json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG6json && popG6json.CD){
				goOpenerReturn(popG6json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG6json = jQuery.parseJSON('{ "__NAME":"lastinputG6json"' +
			//', "PJTSEQ" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "CFGSEQ" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("CFGSEQ")).getValue()) + '"' +
			//', "USEYN" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("USEYN")).getValue()) + '"' +
			//', "CFGID" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("CFGID")).getValue()) + '"' +
			//', "CFGNM" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("CFGNM")).getValue()) + '"' +
			//', "MVCGBN" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("MVCGBN")).getValue()) + '"' +
			//', "PATH" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("PATH")).getValue()) + '"' +
			//', "CFGORD" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("CFGORD")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG6.cells(rowID,mygridG6.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG6.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG6  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG6.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG6.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG6.setRowTextBold(rId);
                }
                mygridG6.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G6_INIT()-------------------------end");
     }
	//FILE 그리드 초기화
function G7_INIT(){
  alog("G7_INIT()-------------------------start");

        //그리드 초기화
        mygridG7 = new dhtmlXGridObject('gridG7');
        mygridG7.setDateFormat("%Y%m%d");
        mygridG7.setImagePath("../lib/dhtmlxSuite/codebase/imgs/"); //DHTMLX IMG
		mygridG7.setUserData("","gridTitle","G7 : FILE"); //글로별 변수에 그리드 타이블 넣기
		//헤더초기화
        mygridG7.setHeader("PJTSEQ,SEQ,파일타입,타입명,포멧,확장자,템플릿,순번,사용,ADDDT,MODDT");
		mygridG7.setColumnIds("PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT");
		mygridG7.setInitWidths("20,50,50,50,50,50,50,50,50,50,50");
		mygridG7.setColTypes("ed,ed,ed,ed,ed,ed,ed,ed,ed,ed,ed");
	//가로 정렬	
		mygridG7.setColAlign("left,left,left,left,left,left,left,left,left,left,left");
		mygridG7.setColSorting("int,str,str,str,str,str,str,str,str,str,str");		//렌더링	
		mygridG7.enableSmartRendering(false);
		mygridG7.enableMultiselect(true);
		//mygridG7.setColValidators("G7_PJTSEQ,G7_FILESEQ,G7_MKFILETYPE,G7_MKFILETYPENM,G7_MKFILEFORMAT,G7_MKFILEEXT,G7_TEMPLATE,G7_FILEORD,G7_USEYN,G7_ADDDT,G7_MODDT");
		mygridG7.splitAt(0);//'freezes' 0 columns 
		mygridG7.init();
		//블럭선택 및 복사
		mygridG7.enableBlockSelection(true);
		mygridG7.attachEvent("onKeyPress",function(code,ctrl,shift){
			alog("onKeyPress.......code=" + code + ", ctrl=" + ctrl + ", shift=" + shift);

			//셀편집모드 아닐때만 블록처리
			if(!mygridG7.editor){
				mygridG7.setCSVDelimiter("	");
				if(code==67&&ctrl){
					mygridG7.copyBlockToClipboard();

					var top_row_idx = mygridG7.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG7.getSelectedBlock().RightBottomRow;
					var copyRowCnt = bottom_row_idx-top_row_idx+1;
					msgNotice( copyRowCnt + "개의 행이 클립보드에 복사되었습니다.",2);

				}
				if(code==86&&ctrl){
					mygridG7.pasteBlockFromClipboard();

					//row상태 변경
					var top_row_idx = mygridG7.getSelectedBlock().LeftTopRow;
					var bottom_row_idx = mygridG7.getSelectedBlock().RightBottomRow;
					for(j=top_row_idx;j<=bottom_row_idx;j++){
						var rowID = mygridG7.getRowId(j);
						RowEditStatus = mygridG7.getUserData(rowID,"!nativeeditor_status");
						if(RowEditStatus == ""){
							mygridG7.setUserData(rowID,"!nativeeditor_status","updated");
							mygridG7.setRowTextBold(rowID);
						}
					}
				}
				return true;
			}else{
				return false;
			}
		});
		 // IO : PJTSEQ초기화	
		 // IO : SEQ초기화	
		 // IO : 파일타입초기화	
		 // IO : 타입명초기화	
		 // IO : 포멧초기화	
		 // IO : 확장자초기화	
		 // IO : 템플릿초기화	
		 // IO : 순번초기화	
		 // IO : 사용초기화	
		 // IO : ADDDT초기화	
		 // IO : MODDT초기화	
	//onCheck
		mygridG7.attachEvent("onCheck",function(rowId, cellInd, state){
			//onCheck is void return event
			alog(rowId + " is onCheck.");
			//일반 체크 박스는 변경이면 실제 row 변경
			if( 1 == 2 
				){
				RowEditStatus = mygridG7.getUserData(rowId,"!nativeeditor_status");
				if(RowEditStatus == ""){
					mygridG7.setUserData(rowId,"!nativeeditor_status","updated");
					mygridG7.setRowTextBold(rowId);
					mygridG7.cells(rowId,cellInd).cell.wasChanged = true;	
				}
			}
						
		});	
		// ROW선택 이벤트
		mygridG7.attachEvent("onRowSelect",function(rowID,celInd){
			RowEditStatus = mygridG7.getUserData(rowID,"!nativeeditor_status");
			if(RowEditStatus == "inserted"){return false;}
			//GRIDRowSelect70(rowID,celInd);
			//팝업오프너 호출
			//CD[필수], NM 정보가 있는 경우 팝업 오프너에게 값 전달
			popG7json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +
			'}');

			if(popG7json && popG7json.CD){
				goOpenerReturn(popG7json);
				return;
			}
			//LAST SELECT ROW
			//lastselectG7json = jQuery.parseJSON('{ "__NAME":"lastinputG7json"' +
			//', "PJTSEQ" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("PJTSEQ")).getValue()) + '"' +
			//', "FILESEQ" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("FILESEQ")).getValue()) + '"' +
			//', "MKFILETYPE" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MKFILETYPE")).getValue()) + '"' +
			//', "MKFILETYPENM" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MKFILETYPENM")).getValue()) + '"' +
			//', "MKFILEFORMAT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MKFILEFORMAT")).getValue()) + '"' +
			//', "MKFILEEXT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MKFILEEXT")).getValue()) + '"' +
			//', "TEMPLATE" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("TEMPLATE")).getValue()) + '"' +
			//', "FILEORD" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("FILEORD")).getValue()) + '"' +
			//', "USEYN" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("USEYN")).getValue()) + '"' +
			//', "ADDDT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("ADDDT")).getValue()) + '"' +
			//', "MODDT" : "' + q(mygridG7.cells(rowID,mygridG7.getColIndexById("MODDT")).getValue()) + '"' +
			//'}');
		//A124
		});
		mygridG7.attachEvent("onEditCell", function(stage,rId,cInd,nValue,oValue){

            alog("mygridG7  onEditCell ------------------start");
            alog("       stage : " + stage);
            alog("       rId : " + rId);
            alog("       cInd : " + cInd);
            alog("       nValue : " + nValue);
            alog("       oValue : " + oValue);

            RowEditStatus = mygridG7.getUserData(rId,"!nativeeditor_status");
            if(stage == 2
                && RowEditStatus != "inserted"
                && RowEditStatus != "deleted"
                && nValue != oValue
                ){
                if(RowEditStatus == "") {
                    mygridG7.setUserData(rId,"!nativeeditor_status","updated");
                    mygridG7.setRowTextBold(rId);
                }
                mygridG7.cells(rId,cInd).cell.wasChanged = true;
            }
            return true;

		});
        alog("G7_INIT()-------------------------end");
     }
//D146 그룹별 기능 함수 출력		
// CONDITIONSearch	
function G2_SEARCHALL(token){
	alog("G2_SEARCHALL--------------------------start");
	//입력값검증
	//폼의 모든값 구하기
	var ConAllData = $( "#condition" ).serialize();
	alog("ConAllData:" + ConAllData);
	lastinputG3 = new FormData(); //PJT
	//json : G2
            lastinputG3json = jQuery.parseJSON('{ "__NAME":"lastinputG3json"' +'}');
	//  호출
	G3_SEARCH(lastinputG3,token);
	alog("G2_SEARCHALL--------------------------end");
}
    function G3_ROWDELETE(){	
        alog("G3_ROWDELETE()------------start");
        delRow(mygridG3);
        alog("G3_ROWDELETE()------------start");
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








    //그리드 조회(PJT)	
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
					msgNotice("[PJT] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PJT] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PJT] Ajax http 500 error ( " + error + " )",3);
                alog("[PJT] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G3_SEARCH()------------end");
    }

//행추가3 (PJT)	
//그리드 행추가 : PJT
	function G3_ROWADD(){
		if( !(lastinputG3)){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = ["","","","","","","","","","","","",""];//초기값
			addRow(mygridG3,tCols);
		}
	}    function G4_ROWDELETE(){	
        alog("G4_ROWDELETE()------------start");
        delRow(mygridG4);
        alog("G4_ROWDELETE()------------start");
    }
	function G4_SAVE(token){
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
//새로고침	
function G4_RELOAD(token){
  alog("G4_RELOAD-----------------start");
  G4_SEARCH(lastinputG4,token);
}








    //그리드 조회(PGM)	
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
					msgNotice("[PGM] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[PGM] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[PGM] Ajax http 500 error ( " + error + " )",3);
                alog("[PGM] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G4_SEARCH()------------end");
    }

//행추가3 (PGM)	
//그리드 행추가 : PGM
	function G4_ROWADD(){
		if( !(lastinputG4)|| lastinputG4.get("G4-PJTSEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = [lastinputG4.get("G3-PJTSEQ"),"","","","","","","","","","","",""];//초기값
			addRow(mygridG4,tCols);
		}
	}//엑셀다운		
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
	$("#DATA_HEADERS").val("PJTSEQ,PGMSEQ,PGMID,PGMNM,VIEWURL,PGMTYPE,POPWIDTH,POPHEIGHT,SECTYPE,PKGGRP,LOGINYN,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("40,50,100,100,100,60,60,60,60,40,70,60,60");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
//엑셀다운		
function G5_EXCEL(){	
	alog("G5_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG5.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG5.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("PJTSEQ,DDSEQ,COLID,COLNM,COLSNM,DATATYPE,DATASIZE,OBJTYPE,OBJTYPE_FORMVIEW,OBJTYPE_GRID,LBLWIDTH,LBLHEIGHT,LBLALIGN,OBJWIDTH,OBJHEIGHT,OBJALIGN,CRYPTCD,VALIDSEQ,PIYN,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("30,30,100,100,100,100,100,100,60,60,100,100,100,100,100,100,40,60,40,100,100");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
    function G5_ROWDELETE(){	
        alog("G5_ROWDELETE()------------start");
        delRow(mygridG5);
        alog("G5_ROWDELETE()------------start");
    }
	function G5_SAVE(token){
	alog("G5_SAVE()------------start");
	tgrid = mygridG5;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG5.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
	sendFormData.append("G5-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G5_SAVE + "&TOKEN=" + token,
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
	
	alog("G5_SAVE()------------end");
}
//새로고침	
function G5_RELOAD(token){
  alog("G5_RELOAD-----------------start");
  G5_SEARCH(lastinputG5,token);
}








    //그리드 조회(DD)	
    function G5_SEARCH(tinput,token){
        alog("G5_SEARCH()------------start");

		var tGrid = mygridG5;

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
            url : url_G5_SEARCH+"&TOKEN=" + token + " &G5_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG5 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG5Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[DD] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[DD] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[DD] Ajax http 500 error ( " + error + " )",3);
                alog("[DD] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G5_SEARCH()------------end");
    }

//행추가3 (DD)	
//그리드 행추가 : DD
	function G5_ROWADD(){
		if( !(lastinputG5)|| lastinputG5.get("G5-PJTSEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = [lastinputG5.get("G3-PJTSEQ"),"","","","","","","","","","","","","","","","","","","",""];//초기값
			addRow(mygridG5,tCols);
		}
	}//엑셀다운		
function G6_EXCEL(){	
	alog("G6_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG6.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG6.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("PJTSEQ,CFGSEQ,USEYN,CFGID,CFGNM,MVCGBN,PATH,CFGORD,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("30,50,50,60,120,60,300,30,80,80");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
    function G6_ROWDELETE(){	
        alog("G6_ROWDELETE()------------start");
        delRow(mygridG6);
        alog("G6_ROWDELETE()------------start");
    }
	function G6_SAVE(token){
	alog("G6_SAVE()------------start");
	tgrid = mygridG6;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG6.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
	sendFormData.append("G6-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G6_SAVE + "&TOKEN=" + token,
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
	
	alog("G6_SAVE()------------end");
}
//새로고침	
function G6_RELOAD(token){
  alog("G6_RELOAD-----------------start");
  G6_SEARCH(lastinputG6,token);
}








    //그리드 조회(CONFIG)	
    function G6_SEARCH(tinput,token){
        alog("G6_SEARCH()------------start");

		var tGrid = mygridG6;

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
            url : url_G6_SEARCH+"&TOKEN=" + token + " &G6_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG6 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG6Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[CONFIG] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[CONFIG] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[CONFIG] Ajax http 500 error ( " + error + " )",3);
                alog("[CONFIG] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G6_SEARCH()------------end");
    }

//행추가3 (CONFIG)	
//그리드 행추가 : CONFIG
	function G6_ROWADD(){
		if( !(lastinputG6)|| lastinputG6.get("G6-PJTSEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = [lastinputG6.get("G3-PJTSEQ"),"","","","","","","","",""];//초기값
			addRow(mygridG6,tCols);
		}
	}//행추가3 (FILE)	
//그리드 행추가 : FILE
	function G7_ROWADD(){
		if( !(lastinputG7)|| lastinputG7.get("G7-PJTSEQ") == ""){
			msgError("조회 후에 행추가 가능합니다. 또는 상속값이 없습니다.",3);
		}else{
			var tCols = [lastinputG7.get("G3-PJTSEQ"),"","","","","","","","","",""];//초기값
			addRow(mygridG7,tCols);
		}
	}//엑셀다운		
function G7_EXCEL(){	
	alog("G7_EXCEL-----------------start");
	var myForm = document.excelDownForm;
	var url = "/c.g/cg_phpexcel.php";
	window.open("" ,"popForm",
		  "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");
	myForm.action =url;
	myForm.method="post";
	myForm.target="popForm";

	mygridG7.setSerializationLevel(true,false,false,false,false,false);
	var myXmlString = mygridG7.serialize();        //컨디션 데이터 모두 말기
	$("#DATA_HEADERS").val("PJTSEQ,FILESEQ,MKFILETYPE,MKFILETYPENM,MKFILEFORMAT,MKFILEEXT,TEMPLATE,FILEORD,USEYN,ADDDT,MODDT");
	$("#DATA_WIDTHS").val("20,50,50,50,50,50,50,50,50,50,50");
	$("#DATA_ROWS").val(myXmlString);
	myForm.submit();
}
    function G7_ROWDELETE(){	
        alog("G7_ROWDELETE()------------start");
        delRow(mygridG7);
        alog("G7_ROWDELETE()------------start");
    }
//새로고침	
function G7_RELOAD(token){
  alog("G7_RELOAD-----------------start");
  G7_SEARCH(lastinputG7,token);
}
	function G7_SAVE(token){
	alog("G7_SAVE()------------start");
	tgrid = mygridG7;

	tgrid.setSerializationLevel(true,false,false,false,true,false);
	var myXmlString = tgrid.serialize();
        //post 만들기
		sendFormData = new FormData($("#condition")[0]);
		for(var pair of lastinputG7.entries()) {
			sendFormData.append(pair[0],pair[1]);
   			//console.log(pair[0]+ ', '+ pair[1]); 
		}
	sendFormData.append("G7-XML" , myXmlString);
	$.ajax({
		type : "POST",
		url : url_G7_SAVE + "&TOKEN=" + token,
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
	
	alog("G7_SAVE()------------end");
}








    //그리드 조회(FILE)	
    function G7_SEARCH(tinput,token){
        alog("G7_SEARCH()------------start");

		var tGrid = mygridG7;

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
            url : url_G7_SEARCH+"&TOKEN=" + token + " &G7_CRUD_MODE=read" ,
            data : sendFormData,
			processData: false,
			contentType: false,
            dataType: "json",
            async: true,
            success: function(data){
                alog("   gridG7 json return----------------------");
                alog("   json data : " + data);
                alog("   json RTN_CD : " + data.RTN_CD);
                alog("   json ERR_CD : " + data.ERR_CD);
                //alog("   json RTN_MSG length : " + data.RTN_MSG.length);

                //그리드에 데이터 반영
                if(data.RTN_CD == "200"){
					var row_cnt = 0;
					if(data.RTN_DATA){
						row_cnt = data.RTN_DATA.rows.length;
						$("#spanG7Cnt").text(row_cnt);						tGrid.parse(data.RTN_DATA,function(){
							//푸터 합계 처리	

						},"json");
						
					}
					msgNotice("[FILE] 조회 성공했습니다. ("+row_cnt+"건)",1);

                }else{
                    msgError("[FILE] 서버 조회중 에러가 발생했습니다.RTN_CD : " + data.RTN_CD + "ERR_CD : " + data.ERR_CD + "RTN_MSG :" + data.RTN_MSG,3);
                }
            },
            error: function(error){
				msgError("[FILE] Ajax http 500 error ( " + error + " )",3);
                alog("[FILE] Ajax http 500 error ( " + data.RTN_MSG + " )");
            }
        });
        alog("G7_SEARCH()------------end");
    }

