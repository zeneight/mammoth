<?php
class Model {
	protected $_dbHandle;
	protected $_table;

/* membuat koneksi */
	public function connect() {
		/*$this->_dbHandle = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);*/
		try {
			$opt  = array(
	            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	            PDO::ERRMODE_WARNING,
	            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	            PDO::ATTR_EMULATE_PREPARES   => TRUE,
	            PDO::ATTR_PERSISTENT         => TRUE,
	        );
	        $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHAR;
	        $this->_dbHandle = new PDO($dsn, DB_USER, DB_PASS, $opt);
		} catch (PDOException $e) {
			echo "Gagal untuk menyambungkan ke Database: ".$e->getMessage();
		}
	}

/* Method - Method CORE Memproses Query */
	public function query($query, $args = array()) {
		/*return mysqli_query($this->_dbHandle, $query);*/
		$stmt = $this->_dbHandle->prepare($query);
        $stmt->execute($args);
        return $stmt;
	}

	public function getResult($mysqliQuery) {
		$data = array();
		while ($record = $mysqliQuery->fetch()) {
			array_push($data, $record);
		}

		return $data;
	}

	public function getRows($mysqliQuery) {
		return $mysqliQuery->rowCount();
	}

	public function getError() {
		/*return mysqli_error($this->_dbHandle);*/
		return $this->_dbHandle->errorInfo();
	}

	public function getId($column="id") {
		/*return mysqli_insert_id($this->_dbHandle);*/
		/*$stmt 	= $this->_dbHandle->query("SELECT max($column) FROM $this->_table");
		return $stmt->fetch();*/
		
		$stmt = $this->_dbHandle->prepare("SELECT MAX($column) AS max_id FROM $this->_table");
		$stmt->execute();
		$invNum = $stmt->fetch();
		return $invNum['max_id'];
	}


/* Method - Method Menampilkan Data */
	public function selectAll($orderBy='', $order='ASC', $limit='') {
		$query = "SELECT * FROM ".$this->_table;

		if ($orderBy!='') $query 	.= " ORDER BY $orderBy $order";
		if ($limit!='') $query 		.= " LIMIT $limit";

		return $this->query($query);
	}

	public function selectWhere($condition=array(), $orderBy='', $order='ASC', $limit='') {
		$query = "SELECT * FROM ".$this->_table;

		$valuenya = array();

		if (is_array($condition)) {
			$query .= " WHERE";
			foreach ($condition as $key => $val) {
				$query .= " $key=? AND";
				array_push($valuenya , $val);
			}
		}

		$query = substr($query, 0, -3);

		if ($orderBy!='') $query 	.= " ORDER BY $orderBy $order";
		if ($limit!='') $query 		.= " LIMIT $limit";

		return $this->query($query, $valuenya);
	}

	public function selectLike($condition='', $orderBy='', $order='ASC', $limit='') {
		$query = "SELECT * FROM ".$this->_table;

		if (is_array($condition)) {
			$query .= " WHERE";
			foreach ($condition as $key => $val) {
				$query .= " $key LIKE '$val' OR";
			}
			$query = substr($query, 0, -2);
		}

		if ($orderBy!='') $query 	.= " ORDER BY $orderBy $order";
		if ($limit!='') $query 		.= " LIMIT $limit";
	}

	public function selectJoin($table, $join="JOIN", $param, $condition='', $orderBy='', $order='ASC', $limit='') {
		$query = "SELECT * FROM ".$this->_table;

		if (is_array($table)) {
			foreach ($table as $tb) {
				$query .= " $join $tb";
			}
		} else $query .= " $join $table";

		foreach ($param as $key => $val) {
			$query .= " ON $key=$val AND";
		}

		$query = substr($query, 0, -3);

		if (is_array($condition)) {
			$query .= " WHERE";
			foreach ($condition as $key => $val) {
				$query .= " $key='$val' AND";
			}
			$query = substr($query, 0, -3);
		}

		if ($orderBy!='') $query 	.= " ORDER BY $orderBy $order";
		if ($limit!='') $query 		.= " LIMIT $limit";

		// echo $query;
		// exit();

		return $this->query($query);
	}

	public function delete($condition) {
		$query = "DELETE FROM ".$this->_table;

		if (is_array($condition)) {
			$query .= " WHERE";
			foreach ($condition as $key => $val) {
				$query .= " $key='$val' AND";
			}

			$query = substr($query, 0, -3);
		} else {
			echo("Maaf, Silahkan untuk cek lagi id data yang ingin dihapus! \r\n Dilarang untuk menghapus data sekaligus!");
			exit();
		}

		return $this->query($query);
	}

	public function insert($data) {
		$query = "INSERT INTO ".$this->_table." SET";

		$valueField = array();

		foreach ($data as $key => $val) {
			$query .= " $key=?,";
			array_push($valueField, $val);
		}
		$query = substr($query, 0, -1);

		return $this->query($query, $valueField);
	}

	public function update($data, $condition) {
		$query = "UPDATE ".$this->_table." SET";

		$valueField = array();
		foreach ($data as $key => $val) {
			$query .= " $key=?,";
			array_push($valueField, $val);
		}

		$query = substr($query, 0, -1);

		if (is_array($condition)) {
			$query .= " WHERE";
			foreach ($condition as $key => $val) {
				$query .= " $key=? AND";
				array_push($valueField , $val);
			}
			$query = substr($query, 0, -3);
		} else {
			echo("Maaf, Silahkan untuk cek lagi id data yang ingin diedit! \r\n Dilarang untuk mengedit data sekaligus!");
			exit();
		}

		return $this->query($query, $valueField);
	}

}
?>