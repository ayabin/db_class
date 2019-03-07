<?php
/* ----------------------------------------------------------------
DB.CLASS.PHP 1.0
	@author ayabin
	@version 1.0
			2019/1/30
-----------------------------------------------------------------*/
class db{
	
	private $dsn;
	private $dbh;
	private $tableName;
	
	function __construct(string $tableName){
		$this->dsn="mysql:host=".HOST_SERVER.";dbname=".DB_NAME.";charset=utf8";
		$this->dbh=new PDO(
			$this->dsn,
			DB_USER,
			DB_PASSWORD,
			array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_EMULATE_PREPARES => false,
			)
		);
		$this->tableName=$tableName;
	}
	
	/* ----------------------------------------------------------------
	(ARRAY) ALL
	PARAM1st [OFFSET PAGE(OPTION)]
	PARAM2nd [COLUMN(OPTION)]
	-----------------------------------------------------------------*/
	public function all(int $offsetPage=1,$column="*"){
		try{
			$return=array();
			$offset=($offsetPage-1)*PAGING;
			$sql="SELECT $column FROM ".$this->tableName." ORDER BY id DESC LIMIT ".PAGING." OFFSET $offset";
			$stmt=$this->dbh->prepare($sql);
			$stmt->execute();
			while($row=$stmt->fetch(PDO::FETCH_ASSOC)){array_push($return,$row);}
			return $return;
		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}
	
	/* ----------------------------------------------------------------
	(BOOLEAN) POST
	PARAM1st [ARRAY]
	-----------------------------------------------------------------*/
	public function post(array $datas){
		try{
			$params=array();
			$columnString="";
			$valueString="";
			$dataCount=count($datas);
			$i=1;
			foreach($datas as $key=>$value){
				$params[$key]=$value;
				if($i!=$dataCount){
					$columnString.="$key,";
					$valueString.=":$key,";
				}else{
					$columnString.=$key;
					$valueString.=":$key";
				}				
				$i++;
			}
			
			$sql="INSERT INTO ".$this->tableName." ($columnString) VALUES ($valueString)";
			$stmt=$this->dbh->prepare($sql);
			$stmt->execute($params);
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}
	
	/* ----------------------------------------------------------------
	(BOOLEAN) UPDATE
	PARAM1st [ARRAY]
	-----------------------------------------------------------------*/
	public function update(array $datas){
		try{
			$params=array();
			$columnString="";
			$dataCount=count($datas);
			$i=1;
			foreach($datas as $key=>$value){
				$params[$key]=$value;
				if($key!="id"){
					if($i!=$dataCount){
						$columnString.="$key=:$key,";
					}else{
						$columnString.="$key=:$key";
					}
				}
				$i++;
			}
			$sql="UPDATE ".$this->tableName." SET $columnString WHERE id=:id";
			$stmt=$this->dbh->prepare($sql);
			$stmt->execute($params);
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}
	
	/* ----------------------------------------------------------------
	(ARRAY) FIND
	PARAM1st [ID]
	PARAM2nd [COLUMN](OPTION)
	-----------------------------------------------------------------*/
	public function find(int $id,$column="*"){
		try{
			$sql="SELECT $column FROM ".$this->tableName." WHERE id=:id";
			$params=array(':id'=>$id);
			$stmt=$this->dbh->prepare($sql);
			$stmt->execute($params);
			$result=$stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}
	
	/* ----------------------------------------------------------------
	(BOOLEAN) REMOVE
	PARAM1st [ID]
	-----------------------------------------------------------------*/
	public function remove(int $id){
		try{
			$sql="DELETE FROM ".$this->tableName." WHERE id=:id";
			$params=array(':id'=>$id);
			$stmt=$this->dbh->prepare($sql);
			$stmt->execute($params);
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}
	
	/* ----------------------------------------------------------------
	(ARRAY) SEARCH
	PARAM1st [KEYWORDS]
	-----------------------------------------------------------------*/
	public function search(string $keywords){
		$returnData=array();
		try{
			$sql="SELECT * FROM $this->tableName WHERE concat(title,content) LIKE :keywords";
			$stmt=$this->dbh->prepare($sql);
			$stmt->bindValue("keywords","%".$keywords."%");
			$stmt->execute();
			while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
				array_push($returnData,$result);
			}
			return $returnData;
		}catch(PDFOException $r){
			echo $e->getMessage();
			exit;
		}
	}
	
	
	/* ----------------------------------------------------------------
	(INT) COUNT
	-----------------------------------------------------------------*/
	function count(){
		try{
			$return=0;
			$sql="SELECT count(*) FROM ".$this->tableName;
			$stmt=$this->dbh->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$return=$row['count(*)'];
			return $return;
		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}
}

?>