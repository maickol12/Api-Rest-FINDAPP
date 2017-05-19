<?php
	function sendResponse($message,$response,$code){
		$newResponse = $response
							    ->withStatus($code)
								->withHeader('Content-type','application/json');
		$newResponse->getBody()->write($message);
		return $newResponse;
	}
?>
