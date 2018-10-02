<?php

use GuzzleHttp\Client;

// handles message events
function handleMessage($sender, $message, $pat){
  $response = "";
  $message = $message['text'];
  if(isset($message)){
    $response ="{'text': 'You sent: $message, Now send me an image!'}";
  }
  callSendAPI($sender,$response, $pat);
}
// response messages via send API
function callSendAPI($sender, $response, $pat){

  $body = "{'recipient': {'id': $sender}, 'message': $response}";
  // echo $body;
  $client = new Client([]);
  $url = "https://graph.facebook.com/v2.6/me/messages?access_token=$pat";
  $resp = $client->post($url, ['Content-type' => 'application/json'], $body)->send();
  $data = $resp->getBody()->getContents();
  return $data;
}

// handle messaging_postbacks
function handlePostback($sender, $message, $pat){
  $response = "";
}
