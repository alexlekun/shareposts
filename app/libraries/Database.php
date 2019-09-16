<?php 
	/**
	 * 
	 */
	class Database
	{
		private $host = 'localhost';
		private $user = DB_USER;
		private $password = DB_PASS;
		private $db_name = DB_NAME;

		private $dbh;
		private $stmt;
		private $error;

		function __construct()
		{	

			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
			$options = array(
				PDO::ATTR_PERSISTENT => true, 
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			);

			try {

				$this->dbh = new PDO($dsn, $this->user, $this->password, $options);
				
			} catch (PDOException $e) {

				$this->error = $e->getMessage();
				echo $this->error;

			}
		}

		// Подготавливаем утверждение с пмощью ф-ции query
		public function query($sql){
			$this->stmt = $this->dbh->prepare($sql);
		}

		// Привязываем значения псевдопеременных
		public function bind($param, $value, $type = null){
			if(is_null($type)){
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;

					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;

					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;

					default:
						$type = PDO::PARAM_STR;
				}
			}

			$this->stmt->bindValue($param, $value, $type);
		}

		// Выполняем подготовленное утверждение

		public function execute(){
			return $this->stmt->execute();
		}

		// Получаем результаты как массив объектов
		public function resultSet(){
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function single(){
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		public function rowCount(){
			return $this->stmt->rowCount();
		}
	}