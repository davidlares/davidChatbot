<?php

use GuzzleHttp\Client;

// handles message events
function handleMessage($sender, $message, $pat){
  $response = "";
  $message = $message['text'];
  if(isset($message)){
    $response ="You sent: $message";
  }
  callSendAPI($sender,$response, $pat);
}
// response messages via send API
function callSendAPI($sender, $response, $pat){
  $body = ["messaging_type" => "RESPONSE", 'recipient' => ['id' => $sender], 'message' => ['text' => $response]];
  $client = new Client(['timeout' => 2.0, 'base_uri' => 'https://graph.facebook.com/']);
  $resp = $client->request('POST',"v2.6/me/messages?access_token=$pat",['json' => $body]);
  $data = $resp->getBody()->getContents();
  return $data;
}

// handle messaging_postbacks
function handlePostback($sender, $message, $pat){
  $response = "";
}
