<?php

include_once('actions.php');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

$pat = getenv('PAGE_ACCESS_TOKEN');

$app->get('/', function (Request $request, Response $response, array $args) use ($pat) {
  if($request->getQueryParam('hub_challenge') !== null){
    $challenge = $request->getQueryParam('hub_challenge');
    $token = $request->getQueryParam('hub_verify_token');
  } else {
      // for the regular user client
      return $response->getBody()->write('Hello from david-chatbot, Server running okay.');
  }
  if($token == getenv('VERIFY_TOKEN')){
    return $response->getBody()->write($challenge);
  }
});

$app->post('/', function(Request $request, Response $response, array $args) use ($pat) {
  $params = $request->getParsedBody();
  if($params['object'] == "page"){
    foreach($params['entry'] as $value){
      $event = $value['messaging'][0];
      $sender = $event['sender']['id'];
      if(isset($event['message']) && !empty($event['message'])){
        handleMessage($sender,$event['message'], getenv('PAGE_ACCESS_TOKEN'));
      }else if(isset($event['postback']) && !empty($event['postback'])){
        handlePostback($sender, $event['postback'], getenv('PAGE_ACCESS_TOKEN'));
      }
    }
  } else {
    // not a suscription page
  }
});

$app->run();
