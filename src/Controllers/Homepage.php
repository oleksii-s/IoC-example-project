<?php
namespace Project\Controllers;

use Http\Response;
use Http\Request;
use Project\Model\Test;

/**
 * Class Homepage
 *
 * @package Project\Controllers
 */
class Homepage
{
	/**
	 * @var Response;
	 */
	private $response;

	/**
	 * @var Request
	 */
	private $request;

	/**
	 * @var \Project\Model\Test
	 */
	private $model;

	public function __construct(Request $request, Response $response, Test $model)
	{
		$this->response = $response;
		$this->request = $request;
		$this->model = $model;
	}

	public function show()
	{
		$item = $this->request->getParameter('another', 'where is my car');
		$result = ['success' => true, 'dude' => $item];
		$result['items'] = $this->model->find();
		$this->response->setContent(json_encode($result));
	}
}