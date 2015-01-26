<?php
namespace Project\DB;


class Database
{
	/**
	 * @var string
	 */
	private $host = 'localhost';

	private $user = 'root';

	private $password = 'password';

	private $dbName = 'test';

	private $db = 'mysql';

	/**
	 * @var null|\PDO
	 */
	private $dbh = NULL;

	public function __construct()
	{
		try {
			$this->dbh = new \PDO($this->db . ':host=' . $this->host . ';dbname' . $this->dbName,
				$this->user, $this->password);
		} catch (\PDOException $exception) {
			echo __LINE__ . $exception->getMessage();
		}

	}

	public function closeConnection()
	{
		$this->dbh = NULL;
	}

	public function runQuery($sql) {
		$smtm = $this->dbh->prepare($sql);
		$smtm->execute($sql);
		return $smtm->fetchAll();

	}
}