<?php
namespace Project\DB;


class Database
{
	/**
	 * Database host
	 *
	 * @var string
	 */
	private $host;

	/**
	 * Database user
	 *
	 * @var string
	 */
	private $user;

	/**
	 * Db password
	 *
	 * @var string
	 */
	private $password;

	/**
	 * Database name
	 *
	 * @var string
	 */
	private $dbName;

	/**
	 * Db driver mysql by default
	 *
	 * @var string
	 */
	private $db;

	/**
	 * @var null|\PDO
	 */
	private $dbh = NULL;

	public function __construct(
		$host = 'localhost',
		$user = 'root',
		$password = 'root',
		$dbName = 'test',
		$db = 'mysql'
	) {
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->dbName = $dbName;
		$this->db = $db;

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