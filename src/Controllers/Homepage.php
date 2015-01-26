<?php
namespace Project\Controllers;

use Http\Response;
use Http\Request;

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

	public function __construct(Request $request, Response $response)
	{
		$this->response = $response;
		$this->request = $request;
	}

	public function show()
	{
		//just an example json
		$item = $this->request->getParameter('another', 'where is my car');
		$result = ['success' => true, 'dude' => $item];
		$this->response->setContent(json_encode($result));
	}
}