<?php
//SVC
 
//include_once('DeploypgmInterface.php');
include_once('deploypgmDao.php');
//class DeploypgmService implements DeploypgmInterface
class deploypgmService 
{
	private $DAO;
	private $DB;
	//생성자
	function __construct(){
		alog("DeploypgmService-__construct");

		$this->DAO = new deploypgmDao();
	    //$this->DB = db_s_open();
		$this->DB["DATING"] = db_obj_open(getDbSvrInfo("DATING"));
	}
	//파괴자
	function __destruct(){
		alog("DeploypgmService-__destruct");

		unset($this->DAO);
		if($this->DB["DATING"])$this->DB["DATING"]->close();
		unset($this->DB);
	}
	function __toString(){
		alog("DeploypgmService-__toString");
	}
	//, 조회(전체)
	public function goG1Searchall(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG1Searchall________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG1Searchall________________________end");
	}
	//, 저장
	public function goG1Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG1Save________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG1Save________________________end");
	}
	//파일, 조회
	public function goG2Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME,$CFG_DEPLOY_KEY;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG2Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 3; // KEY 컬럼, FILESEQ

		//001 원격에서 PGM목록 가져오기
		$url = sprintf(
			"http://172.17.0.1:8080/c.g/deploy_remote.php?PJTSEQ=3&FILE_LIST_YN=Y&DEPLOY_KEY=%s"
			,$CFG_DEPLOY_KEY
		);

		alog("DEPLOY GET URL = " . $url);
		$body = getHttpBody($url);
		//alog($body);
		$bodyJson = json_decode($body,true);
		if($bodyJson["RTN_CD"] != "200")JsonMsg($bodyJson["RTN_CD"],$bodyJson["ERR_CD"],$bodyJson["RTN_MSG"]);

		$deployArr = array();
		alog("sizeof  bodyJson = " . count($bodyJson["FILE_LIST"]));
		for($i=0; $i<count($bodyJson["FILE_LIST"]); $i++){
			$tPgmMap = $bodyJson["FILE_LIST"][$i];

			//FILE 정보가 R.D에 있는지 검사하기
			$sql = sprintf("
			select ifnull(count(DEPLOY_SEQ),0) as CNT 
			from CMN_DEPLOY_FILE 
			where PGMID = '%s' and FILENM = '%s' and FILEHASH = '%s'"
				, addSqlSlashes($tPgmMap["PGMID"])
				, addSqlSlashes($tPgmMap["FILENM"])
				, addSqlSlashes($tPgmMap["FILEHASH"])
			);
			//alog("sql = " . $sql);
			$result = $this->DB["DATING"]->query($sql) or JsonMsg("500","300", "FILE_LIST_YN [" . $this->DB["DATING"]->errno . "] " . $this->DB["DATING"]->error) ;

			//$line2 = null;
			$arr = fetch_all($result,MYSQLI_ASSOC);
			if(intval($arr[0]["CNT"]) == 0){
				//alog("신규파일 : " . $i . " -> " . $tPgmMap["PGMID"]);
				array_push($deployArr,$tPgmMap);
			}else{
				//alog("신규파일 아님 : " . $i . " -> " . $tPgmMap["PGMID"]);
			}
			$result->close();
		}

		alog("sizeof(deployArr) = ". sizeof($deployArr));
		//exit;

		//리턴 배열 만들기
		$rtnVal->RTN_DATA = new stdClass();
		for($j=0;$j<count($deployArr);$j++){
			alog("j = " . $j . " -> " . $tPgmMap["FILESEQ"]);
			$tPgmMap = $deployArr[$j];

			$rtnVal->RTN_DATA->rows[$j]['id']=$tPgmMap["FILESEQ"];
			$one_row = array(); //첫번째 컬럼 chk
			foreach($tPgmMap as $k=>$v){
				//alog(" add value = " . $v);
				array_push($one_row,$v);
			}
			$rtnVal->RTN_DATA->rows[$j]['data']=$one_row;
		}

		/*

		//조회
		//V_GRPNM : 파일
		$GRID["SQL"]["R"] = $this->DAO->sFileG($REQ); //SEARCH, 조회,FILE
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G2]",microtime(true)));
		//GRID_SEARCH____________________________end
		*/

		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG2Search________________________end");
	}
	//파일, 선택파일 복제
	public function goG2Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME,$CFG_DEPLOY_DIR,$CFG_DEPLOY_KEY;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG2Save________________________start");


		//루프 돌면서 땡여오고 db에 넣기
		$map["XML"] = $REQ["G2-XML"];
		$map["COLORD"] = "CHK,PGMSEQ,VERSEQ,FILESEQ,PGMID,PGMNM,FILETYPE,FILENM,FILEHASH,FILESIZE,ADDDT,MODDT";

		$colord_array = explode(",",$map["COLORD"]);

		if(is_assoc($map["XML"]["row"]) == 1) {
			alog(" Y " );
			$xml_array_last[0] = $map["XML"]["row"];
		}else{
			alog(" N " );

			$xml_array_last = $map["XML"]["row"];
		}
		//var_dump($xml_array_last);

		$RtnVal = null;
		$RtnCnt = 0;
		alog("xml sizeof : " . sizeof($xml_array_last));
		for($i=0;$i<sizeof($xml_array_last);$i++){

			$row = $xml_array_last[$i];
			alog("        i : " . $i);
			alog("        @attributes : " . $row["@attributes"]["id"]);
			alog("        userdata : " . $row["userdata"]);

			//현재 그리드 line을 bind 배열에 담기
			$to_row = null;
			$to_coltype = null;
			$sql = null;
			for($j=0;$j<sizeof($row["cell"]);$j++){
				$col = $row["cell"][$j];
				$to_row[trim($colord_array[$j])] = $col;

			}

			//이미 배포된 적이 있는지 확인하기
			$sql = " select DEPLOY_SEQ from CMN_DEPLOY_FILE where PGMID = #{PGMID} and FILENM = #{FILENM} ";
			$to_coltype = str_replace(" ","","ss");
			$stmt = makeStmt($this->DB["DATING"],$sql, $to_coltype, $to_row);
			if(!$stmt) JsonMsg("500","200","(makeGridSaveJson) stmt 생성 실패 " . $stmt->errno . " -> " . $stmt->error);
		
			if(!$stmt->execute()) JsonMsg("500","210","(makeGridSaveJson) stmt 실행 실패 " . $stmt->error);
			$result = $stmt->get_result();
			if ($row = $result->fetch_array(MYSQLI_ASSOC)){
				alog("기존 배포된 파일에서 찾음 = " . $row["DEPLOY_SEQ"]);
				$to_row["DEPLOY_SEQ"] = $row["DEPLOY_SEQ"];
			}
			$result->close();
			$stmt->close();

			//배포 이력이 없으면 추가하기
			if(!is_numeric($to_row["DEPLOY_SEQ"])){
				$sql = "
					insert into CMN_DEPLOY_FILE ( 
						PGMSEQ, PGMID, FILESEQ, FILENM, FILETYPE
						, FILEHASH, FILESIZE
						, ADD_DT, ADD_ID
					) values (
						#{PGMSEQ}, #{PGMID}, #{FILESEQ}, #{FILENM}, #{FILETYPE}
						, #{FILEHASH}, #{FILESIZE}
						, date_format(sysdate(),'%Y%m%d%H%i%s'), #{USER.SEQ}
					)
				";
				$to_coltype = str_replace(" ","","isiss si i");
				$stmt = makeStmt($this->DB["DATING"],$sql, $to_coltype, array_merge($REQ,$to_row));
				if(!$stmt) JsonMsg("500","200","(makeGridSaveJson) stmt 생성 실패 " . $stmt->errno . " -> " . $stmt->error);
			
				if(!$stmt->execute())JsonMsg("500","210","(makeGridSaveJson) stmt 실행 실패 " . $stmt->error);
				$to_row["DEPLOY_SEQ"] = $this->DB["DATING"]->insert_id;	
			}


			//파일가져오기
			$url = sprintf(
				"http://172.17.0.1:8080/c.g/deploy_remote.php?PJTSEQ=3&PGMSEQ=%d&FILESEQ=%d&FILE_LIST_YN=Y&FILEHASH=%s&DEPLOY_KEY=%s"
				,addSqlSlashes($to_row["PGMSEQ"])
				,addSqlSlashes($to_row["FILESEQ"])
				,addSqlSlashes($to_row["FILEHASH"])
				,$CFG_DEPLOY_KEY
			);

			$body = getHttpBody($url);
			alog($body);
			$bodyJson = json_decode($body,true);
			if($bodyJson["RTN_CD"] != "200")JsonMsg($bodyJson["RTN_CD"],$bodyJson["ERR_CD"],$bodyJson["RTN_MSG"]);
			

			//파일 해쉬 검사.
			alog("REQ HASH : " . $to_row["FILEHASH"]);
			alog("RES HASH : " . md5($bodyJson["FILE_SRC"]));
			
			if(md5($bodyJson["FILE_SRC"]) != $to_row["FILEHASH"])JsonMsg("500","100","파일 해쉬값이 일치하지 않습니다.");

			//서버 저장
			$filename = $CFG_DEPLOY_DIR . $to_row["FILENM"];
			$fp = fopen($filename, 'w');
			fwrite($fp, $bodyJson["FILE_SRC"]);
			fclose($fp);
			$RtnCnt++; //배포 파일 증가

			//파일권한 변경
			chmod($filename,0755);

			//배포 완료 처리 하기
			$sql = "
				update CMN_DEPLOY_FILE set
					FILEHASH = #{FILEHASH}, FILESIZE = #{FILESIZE}, DEPLOY_DT = date_format(sysdate(),'%Y%m%d%H%i%s'), DEPLOY_ID = #{USER.SEQ}
					, MOD_DT = date_format(sysdate(),'%Y%m%d%H%i%s'), MOD_ID = #{USER.SEQ}
				where DEPLOY_SEQ = #{DEPLOY_SEQ}
				";
			$to_coltype = str_replace(" ","","sii ii");
			$stmt = makeStmt($this->DB["DATING"],$sql, $to_coltype, array_merge($REQ,$to_row));
			if(!$stmt) JsonMsg("500","200","(makeGridSaveJson) stmt 생성 실패 " . $stmt->errno . " -> " . $stmt->error);
			if(!$stmt->execute())JsonMsg("500","210","(makeGridSaveJson) stmt 실행 실패 " . $stmt->error);
			$stmt->close();


		}		




		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		$rtnVal->RTN_MSG = $RtnCnt . "개의 파일이 정상 배포되었습니다.";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG2Save________________________end");
	}
	//파일, 엑셀다운로드
	public function goG2Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG2Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG2Excel________________________end");
	}
	//파일, 선택저장
	public function goG2Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG2Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG2Chksave________________________end");
	}
	//SQL PGM, 조회
	public function goG3Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME,$CFG_DEPLOY_KEY;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG3Search________________________start");
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, PGMSEQ

		//001 원격에서 PGM목록 가져오기
		$url = sprintf(
			"http://172.17.0.1:8080/c.g/deploy_remote.php?PJTSEQ=3&PGM_LIST_YN=Y&DEPLOY_KEY=%s"
			,$CFG_DEPLOY_KEY
		);

		$body = getHttpBody($url);
		//alog($body);
		$bodyJson = json_decode($body,true);
		if($bodyJson["RTN_CD"] != "200")JsonMsg($bodyJson["RTN_CD"],$bodyJson["ERR_CD"],$bodyJson["RTN_MSG"]);

		$deployArr = array();
		alog("sizeof  bodyJson = " . count($bodyJson["PGM_LIST"]));
		for($i=0; $i<count($bodyJson["PGM_LIST"]); $i++){
			$tPgmMap = $bodyJson["PGM_LIST"][$i];

			//PGM정보가 R.D에 있는지 검사하기
			$sql = sprintf("select ifnull(count(PGMID),0) as CNT from DATING.CMN_MNU where PGMID = '%s' "
				, addSqlSlashes($tPgmMap["PGMID"])
			);
			//alog("sql = " . $sql);
			$result = $this->DB["DATING"]->query($sql) or JsonMsg("500","300", "PGM_LIST_YN [" . $this->DB["DATING"]->errno . "] " . $this->DB["DATING"]->error) ;

			//$line2 = null;
			$arr = fetch_all($result,MYSQLI_ASSOC);
			if(intval($arr[0]["CNT"]) == 0){
				//alog("신규파일 : " . $i . " -> " . $tPgmMap["PGMID"]);
				array_push($deployArr,$tPgmMap);
			}else{
				//alog("신규파일 아님 : " . $i . " -> " . $tPgmMap["PGMID"]);
			}
			$result->close();
		}

		alog("sizeof(deployArr) = ". sizeof($deployArr));
		//exit;

		//리턴 배열 만들기
		$rtnVal->RTN_DATA = new stdClass();
		for($j=0;$j<count($deployArr);$j++){
			alog("j = " . $j . " -> " . $tPgmMap["PGMSEQ"]);
			$tPgmMap = $deployArr[$j];

			$rtnVal->RTN_DATA->rows[$j]['id']=$tPgmMap["PGMSEQ"];
			$one_row = array(); //첫번째 컬럼 chk
			foreach($tPgmMap as $k=>$v){
				//alog(" add value = " . $v);
				array_push($one_row,$v);
			}
			$rtnVal->RTN_DATA->rows[$j]['data']=$one_row;
		}

		/*
		//조회
		//V_GRPNM : SQL PGM
		$GRID["SQL"]["R"] = $this->DAO->sPgmG($REQ); //SEARCH, 조회,PGM
		
		//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		*/


		array_push($_RTIME,array("[TIME 50.DB_TIME G3]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG3Search________________________end");
	}
	//SQL PGM, 저장
	public function goG3Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG3Save________________________start");


		alog("PGMMNGService-goG4Save________________________start");
		//GRID_SAVE____________________________start
		$grpId="G3";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "CHK,PGMSEQ,PGMID,PGMNM,PKGGRP,VIEWURL,MNU_ORD,FOLDER_SEQ,PGMTYPE,SECTYPE,ADDDT,MODDT"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["COLCRYPT"] = array();	//암호화컬럼
		$GRID["KEYCOLID"] = "PGMSEQ";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "Y";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["U"] = $this->DAO->insMnuG($REQ); // SAVE, 저장, PGM
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);
		//GRID_SAVE____________________________end


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG3Save________________________end");
	}
	//SQL PGM, 엑셀다운로드
	public function goG3Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG3Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG3Excel________________________end");
	}
	//SQL PGM, 선택저장
	public function goG3Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG3Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG3Chksave________________________end");
	}
	//SQL AUTH, 조회
	public function goG4Search(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME,$CFG_DEPLOY_KEY;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG4Search________________________start");


		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, PGMSEQ

		//001 원격에서 PGM목록 가져오기
		$url = sprintf(
			"http://172.17.0.1:8080/c.g/deploy_remote.php?PJTSEQ=3&AUTH_LIST_YN=Y&DEPLOY_KEY=%s"
			,$CFG_DEPLOY_KEY
		);


		$body = getHttpBody($url);
		alog($body);
		$bodyJson = json_decode($body,true);

		$deployArr = array();
		alog("sizeof  bodyJson = " . count($bodyJson["AUTH_LIST"]));
		for($i=0; $i<count($bodyJson["AUTH_LIST"]); $i++){
			$tPgmMap = $bodyJson["AUTH_LIST"][$i];

			//PGM정보가 R.D에 있는지 검사하기
			$sql = sprintf("select ifnull(count(AUTH_ID),0) as CNT from CMN_AUTH where PGMID = '%s' and AUTH_ID = '%s' "
				, addSqlSlashes($tPgmMap["PGMID"])
				, addSqlSlashes($tPgmMap["AUTH_ID"])
			);
			//alog("sql = " . $sql);
			$result = $this->DB["DATING"]->query($sql) or JsonMsg("500","300", "AUTH_LIST [" . $this->DB["DATING"]->errno . "] " . $this->DB["DATING"]->error) ;

			//$line2 = null;
			$arr = fetch_all($result,MYSQLI_ASSOC);
			if(intval($arr[0]["CNT"]) == 0){
				//alog("신규파일 : " . $i . " -> " . $tPgmMap["PGMID"]);
				array_push($deployArr,$tPgmMap);
			}else{
				//alog("신규파일 아님 : " . $i . " -> " . $tPgmMap["PGMID"]);
			}
			$result->close();
		}

		alog("sizeof(deployArr) = ". sizeof($deployArr));
		//exit;

		//리턴 배열 만들기
		$rtnVal->RTN_DATA = new stdClass();
		for($j=0;$j<count($deployArr);$j++){
			alog("j = " . $j . " -> " . $tPgmMap["PGMID"]);
			$tPgmMap = $deployArr[$j];

			$rtnVal->RTN_DATA->rows[$j]['id'] = $tPgmMap["PGMID"] . "-" . $tPgmMap["AUTH_ID"];
			$one_row = array(); //첫번째 컬럼 chk
			foreach($tPgmMap as $k=>$v){
				//alog(" add value = " . $v);
				array_push($one_row,$v);
			}
			$rtnVal->RTN_DATA->rows[$j]['data']=$one_row;
		}

		
		/*
		//그리드 서버 조회 
		//GRID_SEARCH____________________________start
		$GRID["KEYCOLIDX"] = 1; // KEY 컬럼, ROWID

		//조회
		//V_GRPNM : SQL AUTH
		$GRID["SQL"]["R"] = $this->DAO->sAuthG($REQ); //SEARCH, 조회,AUTH
	//암호화컬럼
		$GRID["COLCRYPT"] = array();
		$rtnVal = makeGridSearchJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));
		//GRID_SEARCH____________________________end
		//처리 결과 리턴

		*/

		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG4Search________________________end");
	}
	//SQL AUTH, 저장
	public function goG4Save(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG4Save________________________start");

		//GRID_SAVE____________________________start
		$grpId="G4";
		$GRID["XML"]=$REQ[$grpId."-XML"];
		$GRID["COLORD"] = "CHK,ROWID,PGMID,AUTH_ID,AUTH_NM"; //그리드 컬럼순서(Hidden컬럼포함)
		$GRID["COLCRYPT"] = array();	//암호화컬럼
		$GRID["KEYCOLID"] = "ROWID";  //KEY컬럼 COLID, 1
		$GRID["SEQYN"] = "N";  //시퀀스 컬럼 유무
		//저장
		$GRID["SQL"]["U"] = $this->DAO->insAuthG($REQ); // SAVE, 저장, PGM
		$tmpVal = makeGridSaveJson($GRID,$this->DB);
		array_push($_RTIME,array("[TIME 50.DB_TIME G4]",microtime(true)));

		$tmpVal->GRPID = $grpId;
		array_push($rtnVal->GRP_DATA, $tmpVal);


		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG4Save________________________end");
	}
	//SQL AUTH, 엑셀다운로드
	public function goG4Excel(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG4Excel________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG4Excel________________________end");
	}
	//SQL AUTH, 선택저장
	public function goG4Chksave(){
		global $REQ,$CFG_UPLOAD_DIR,$_RTIME;
		$rtnVal = null;
		$tmpVal = null;
		$grpId = null;
		$rtnVal->GRP_DATA = array();

		alog("DEPLOYPGMService-goG4Chksave________________________start");
		//처리 결과 리턴
		$rtnVal->RTN_CD = "200";
		$rtnVal->ERR_CD = "200";
		echo json_encode($rtnVal);
		alog("DEPLOYPGMService-goG4Chksave________________________end");
	}
}
                                                             
?>
