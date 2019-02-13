<?php
//SVC
 
//include_once('AppapiInterface.php');
include_once('appapiDao.php');
//class AppapiService implements AppapiInterface
class appapiService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("AppapiService-__construct");

		$this->DAO = new appapiDao();
	    //$this->DB = db_s_open();
		$this->DB["DATING"] = db_obj_open(getDbSvrInfo("DATING"));
	}
	//파괴자
	function __destruct(){
		alog("AppapiService-__destruct");

		unset($this->DAO);
		if($this->DB["DATING"])$this->DB["DATING"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("AppapiService-__toString");
	}
	//컨디션1, 저장
	public function goC2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("APPAPIService-goC2Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "ROWCHK,API_SEQ,API_NM,PGM_ID,URL,REQ_ENCTYPE,REQ_DATATYPE,REQ_BODY,RES_BODY,MYFILE,MYFILESVRNM,ADD_DT,MOD_DT,CHK"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array("REQ_BODY"=>"CRYPT","RES_BODY"=>"CRYPT");	
		$GRID["KEYCOLID"] = "API_SEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["U"] = $this->DAO->updApiG($REQ); // SAVE, 저장, G상세수정
		$GRID["SQL"]["C"] = $this->DAO->insApiG($REQ); // SAVE, 저장, 목록추가
		$GRID["SQL"]["D"] = $this->DAO->delApiG($REQ); // SAVE, 저장, 삭제
		$tmpVal = requireGridSave($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//FORMVIEW SAVE
		$grpId="F4";
		$FORMVIEW["FNCTYPE"] = $REQ[$grpId . "-CTLCUD"]; 
		$GRID["KEYCOLID"] = "API_SEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array("REQ_BODY"=>"CRYPT","RES_BODY"=>"CRYPT");	
			//파일저장
		alog("C2-MYFILE_name = " . $REQ["C2-MYFILE_name"]);
		if(strlen($REQ["C2-MYFILE_name"]) > 4  && isAllowExtension($REQ["C2-MYFILE_name"],$t_allow_extension=array("jpg", "gif", "png","peng","bmp","svg"))){
			
			$REQ["C2-MYFILE_svr_name"] = getFileSvrNm($REQ["C2-MYFILE_name"], $t_prefix="PIC_");
			$MYFILE1 = $CFG_UPLOAD_DIR . $REQ["C2-MYFILE_svr_name"];
			alog("###### MYFILE1 : " . $MYFILE1 );

			if(!move_uploaded_file($REQ["C2-MYFILE_tmp_name"], $MYFILE1)){
				//처리 결과 리턴
				$rtnVal->RTN_CD = "500";
				$rtnVal->ERR_CD = "591";
				echo json_encode($rtnVal);
				return;
			}
		}
		//CTLCUD 명령어에 따른 분개 처리
		if( $FORMVIEW["FNCTYPE"] == "C" || $FORMVIEW["FNCTYPE"] == "U"){ 
			switch($FORMVIEW["FNCTYPE"]){
				case "U":////상세수정
					//추가
					$FORMVIEW["SQL"][$FORMVIEW["FNCTYPE"]] = $this->DAO->updApi($REQ); 
					break;
				case "D":////상세삭제
					//추가
					$FORMVIEW["SQL"][$FORMVIEW["FNCTYPE"]] = $this->DAO->delApi($REQ); 
					break;
				case "C":////추가
					//추가
					$FORMVIEW["SQL"][$FORMVIEW["FNCTYPE"]] = $this->DAO->insApi($REQ); 
					break;
				default:
					//처리 결과 리턴
					$rtnVal->RTN_CD = "500";
					$rtnVal->ERR_CD = "593";
					echo json_encode($rtnVal);
					return;	
			}
			//필수 여부 검사
			$tmpVal = requireFormviewSave($FORMVIEW["SQL"],$FORMVIEW["FNCTYPE"]);
			if($tmpVal->RTN_CD == "500"){
				alog("requireFormview - fail.");
				$tmpVal->GRPID = $grpId;
				echo json_encode($tmpVal);
				exit;
			}
			$tmpVal = makeFormviewSaveJson($FORMVIEW,$this->DB);
			array_push($_RTIME,array("[TIME 50.DB_TIME F4]",microtime(true)));

			$al->GRPID = $grpId;
			array_push($rtnVal->GRP_DATA, $tmpVal);

			//$rtnVal = makeFormviewSaveJson($FORMVIEW,$this->DB);

		}//C,U 일때만 DB처리
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("APPAPIService-goC2Save________________________end");
	}
	//그리드1, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("APPAPIService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, API_SEQ

		//조회
		//V_GRPNM : 그리드1
		$GRID["SQL"]["R"] = $this->DAO->searchApiG($REQ); //SEARCH, 조회,조회
	//암호화컬럼
		$GRID["COLCRYPT"] = array("REQ_BODY"=>"CRYPT","RES_BODY"=>"CRYPT");
		//필수 여부 검사
		$tmpVal = requireGridSearch($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("APPAPIService-goG3Search________________________end");
	}
	//그리드1, 완전삭제
	public function goG3Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("APPAPIService-goG3Chksave________________________start");
		//GRID_CHK_SAVE____________________________start
		$grpId="G3";
		$GRID["CHK"]=$REQ[$grpId."-CHK"];
		$GRID["KEYCOLID"] = "API_SEQ";  //KEY컬럼 COLID, 1
		//완전삭제	
		$GRID["SQL"] = $this->DAO->delCompApiG($REQ); // CHKSAVE, 완전삭제, 완전삭제
			$tmpVal = makeGridChkJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_CHK_SAVE____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("APPAPIService-goG3Chksave________________________end");
	}
	//그리드1, S
	public function goG3Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("APPAPIService-goG3Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "ROWCHK,API_SEQ,API_NM,PGM_ID,URL,REQ_ENCTYPE,REQ_DATATYPE,REQ_BODY,RES_BODY,MYFILE,MYFILESVRNM,ADD_DT,MOD_DT,CHK"; //그리드 컬럼순서(Hidden컬럼포함)
	//암호화컬럼
		$GRID["COLCRYPT"] = array("REQ_BODY"=>"CRYPT","RES_BODY"=>"CRYPT");	
		$GRID["KEYCOLID"] = "API_SEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//S
		$GRID["SQL"]["U"] = $this->DAO->updApiG($REQ); // SAVE, S, G상세수정
		$GRID["SQL"]["C"] = $this->DAO->insApiG($REQ); // SAVE, S, 목록추가
		$GRID["SQL"]["D"] = $this->DAO->delApiG($REQ); // SAVE, S, 삭제
		$tmpVal = requireGridSave($GRID["COLORD"],$GRID["XML"],$GRID["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireGrid - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("APPAPIService-goG3Save________________________end");
	}
	//그리드1, E
	public function goG3Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("APPAPIService-goG3Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("APPAPIService-goG3Excel________________________end");
	}
	//폼뷰1, 조회
	public function goF4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("APPAPIService-goF4Search________________________start");
//FORMVIEW SEARCH
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array("REQ_BODY"=>"CRYPT","RES_BODY"=>"CRYPT");
// SQL LOOP
		// 상세
		$FORMVIEW["SQL"]["R"] = $this->DAO->detailApi($REQ); 
		//필수 여부 검사
		$tmpVal = requireFormviewSearch($FORMVIEW["SQL"]);
		if($tmpVal->RTN_CD == "500"){
			alog("requireFormview - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$rtnVal = makeFormviewSearchJson($FORMVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME F4]",microtime(true)));
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("APPAPIService-goF4Search________________________end");
	}
	//폼뷰1, 저장
	public function goF4Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("APPAPIService-goF4Save________________________start");
		//FORMVIEW SAVE
		$grpId="F4";
		$FORMVIEW["FNCTYPE"] = $REQ[$grpId . "-CTLCUD"]; 
		$GRID["KEYCOLID"] = "API_SEQ";  //KEY컬럼 COLID, 0
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
	//암호화컬럼
		$FORMVIEW["COLCRYPT"] = array("REQ_BODY"=>"CRYPT","RES_BODY"=>"CRYPT");	
			//파일저장
		alog("F4-MYFILE_name = " . $REQ["F4-MYFILE_name"]);
		if(strlen($REQ["F4-MYFILE_name"]) > 4  && isAllowExtension($REQ["F4-MYFILE_name"],$t_allow_extension=array("jpg", "gif", "png","peng","bmp","svg"))){
			
			$REQ["F4-MYFILE_svr_name"] = getFileSvrNm($REQ["F4-MYFILE_name"], $t_prefix="PIC_");
			$MYFILE1 = $CFG_UPLOAD_DIR . $REQ["F4-MYFILE_svr_name"];
			alog("###### MYFILE1 : " . $MYFILE1 );

			if(!move_uploaded_file($REQ["F4-MYFILE_tmp_name"], $MYFILE1)){
				//처리 결과 리턴
				$rtnVal->RTN_CD = "500";
				$rtnVal->ERR_CD = "591";
				echo json_encode($rtnVal);
				return;
			}
		}
		//CTLCUD 명령어에 따른 분개 처리
		if( $FORMVIEW["FNCTYPE"] == "C" || $FORMVIEW["FNCTYPE"] == "U"){ 
			switch($FORMVIEW["FNCTYPE"]){
				case "U":////상세수정
					//추가
					$FORMVIEW["SQL"][$FORMVIEW["FNCTYPE"]] = $this->DAO->updApi($REQ); 
					break;
				case "C":////추가
					//추가
					$FORMVIEW["SQL"][$FORMVIEW["FNCTYPE"]] = $this->DAO->insApi($REQ); 
					break;
				default:
					//처리 결과 리턴
					$rtnVal->RTN_CD = "500";
					$rtnVal->ERR_CD = "593";
					echo json_encode($rtnVal);
					return;	
			}
			//필수 여부 검사
			$tmpVal = requireFormviewSave($FORMVIEW["SQL"],$FORMVIEW["FNCTYPE"]);
			if($tmpVal->RTN_CD == "500"){
				alog("requireFormview - fail.");
				$tmpVal->GRPID = $grpId;
				echo json_encode($tmpVal);
				exit;
			}
			$tmpVal = makeFormviewSaveJson($FORMVIEW,$this->DB);
			array_push($_RTIME,array("[TIME 50.DB_TIME F4]",microtime(true)));

			$al->GRPID = $grpId;
			array_push($rtnVal->GRP_DATA, $tmpVal);

			//$rtnVal = makeFormviewSaveJson($FORMVIEW,$this->DB);

		}//C,U 일때만 DB처리
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("APPAPIService-goF4Save________________________end");
	}
	//폼뷰1, 삭제
	public function goF4Delete(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("APPAPIService-goF4Delete________________________start");
//FORMVIEW DELETE
		$grpId="F4";
		$FORMVIEW["FNCTYPE"] = $REQ[$grpId."-CTLCUD"]; 
		$FORMVIEW["SQL"][$FORMVIEW["FNCTYPE"]] = $this->DAO->delApi($REQ); 

		//필수 여부 검사
		$tmpVal = requireFormviewSave($FORMVIEW["SQL"],$FORMVIEW["FNCTYPE"] );
		if($tmpVal->RTN_CD == "500"){
			alog("requireFormviewSave - fail.");
			$tmpVal->GRPID = $grpId;
			echo json_encode($tmpVal);
			exit;
		}
		$tmpVal = makeFormviewSaveJson($FORMVIEW,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME F4]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("APPAPIService-goF4Delete________________________end");
	}
}
                                                             
?>
