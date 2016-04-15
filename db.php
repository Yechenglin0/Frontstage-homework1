<?php
  class db {
		protected $dsn;
		protected $password;
		protected $username;										
		protected $dbh;

		public function __construct($dsn,$password,$username) {
			
			$this->dsn = $dsn;
			$this->password = $password;
			$this->username = $username;
			$this->connect();
			if($this->dbh) {
					return $this->dbh;
			} else {
					exit("ERROR! DATABASE CREATE FAILS ");
			}
			
		}
		public function connect(){
			
			$this->dbh = new PDO($this->dsn,$this->username,$this->password);
			$this->dbh->setAttribute(PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION);
			$this->dbh-> exec('set names utf8');
			
			}
		public function arrRes($res){
		
			$res->setFetchMode(PDO::FETCH_ASSOC);
			while($row=$res->fetch()){
			    $rows[]=$row;
				}
		return $rows;
		
		}
		public function showAll(){	 
			
			$selectAll = "SELECT * FROM page";
			$res = $this->dbh->query($selectAll);
			return $this->arrRes($res);
			
		}
		public function select($content = "*", $tableName , $where ){

			$select = "SELECT $content FROM $tableName WHERE $where";
			echo $select;
			$res = $this->dbh->query($select);
			return $this->arrRes($res);
		
		}
		public function delete($tableName , $where ){

			$delete = "DELETE FROM $tableName WHERE $where";
			$this->dbh->query($delete);
	
		}		
		public function insert($tableName , $queue , $values ){

			$insert = "INSERT INTO $tableName ($queue) VALUES ($values)";
			$this->dbh->query($insert);

		}
		public function update($tableName, $queue1, $values1, $queue2, $values2) {

			$update = "UPDATE $tableName SET $queue1 = '$values1' WHERE $queue2 = '$values2'";
			//echo $update;
			$this->dbh->query($update);

		}
		public function clearAll($tableName) {

			$clearAll = "DELETE * FROM $tableName";
			$this->dbh->query($clearAll);

		}
		public function countLines($tableName){

			$countLines = "SELECT COUNT(*) FROM $tableName";
			$res = $this->dbh->query($countLines);
			$count = $this->arrRes($res) ;
			return $count[0]['COUNT(*)'];
		}
		public function custom($custom) {
			
			$res = $this->dbh->qurey($custom);
			return $this->arrRes($res);

		}
	}
	
	$dsn = "mysql:host=localhost;dbname=page";
	$password = '';
	$username = 'root';
	$my = new db($dsn,$password,$username);
	
	// $content = "*";
	// $tableName = "page";
	// $where = "content = 'heha'";
	// $res = $my->select($content,$tableName,$where);
	// var_dump($res);

	// $tableName = "page";
	// $where = "content = 'heha'";
	// $my->delete($tableName,$where);
// for ($i=0; $i <50 ; $i++) { 
// 	# code...
// 	$tableName = 'page';
// 	$queue = 'page,content';
// 	$values = '3,"dsgd"';
// 	$my->insert($tableName,$queue,$values);
// }
	
	

	// $tableName = 'page';
	// $queue1 = 'page';
	// $values1 = 1;
	// $queue2 = 'content';
	// $values2 = 'shabi';
	// $my->update($tableName,$queue1,$values1,$queue2,$values2);
	
	// $countLines = 'page';
	// $my->countLines($countLines);

	// $res = $my->showAll();
	// var_dump($res);