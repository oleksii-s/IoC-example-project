<?php
namespace Project\Model;


class Test
{
	/**
	 * @var \PDO
	 */
	private $pdo;

	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function find()
	{
		$stmt = $this->pdo->prepare('SELECT * FROM test');
		$stmt->execute();
		$res = [];
		while($row = $stmt->fetch()) {
			$res[] = $row;
		}

		return $res;
	}
}