<?php

include_once('json-formatting.php');
use GuzzleHttp\Client;

// handles message events
function handleMessage($sender, $message, $pat){
  if(isset($message['text'])){
    $response = 'You sent: '.$message['text'];
    $type = 'text';
  }else if($message['attachments']){
    $attachUrl = $message['attachments'][0]['payload']['url'];
    $response = jsonFormat($attachUrl);
    $type = 'image';
  }
  callSendAPI($sender,$response,$pat,$type);
}

// response messages via send API
function callSendAPI($sender, $response, $pat, $type){
  if($type == 'text'){
    $body = ["messaging_type" => "RESPONSE", 'recipient' => ['id' => $sender], 'message' => ['text' => $response]];
  } else if($type == 'image'){
    $body = ["messaging_type" => "RESPONSE", 'recipient' => ['id' => $sender], 'message' => $response];
  }
  // guzzle post client
  $client = new Client(['timeout' => 2.0, 'base_uri' => 'https://graph.facebook.com/']);
  $resp = $client->request('POST',"v2.6/me/messages?access_token=$pat",['json' => $body]);
  $data = $resp->getBody()->getContents();
  return $data;
}

// handle messaging_postbacks
function handlePostback($sender, $message, $pat){
  $payload = $message['payload'];
  $type = 'image';
  if($payload === 'yes'){
    $response = '{"text": "Thanks!"}';
   } else if($payload === 'no') {
    $response = '{"text" : "Oops, try sending another image"}';
  }
  callSendAPI($sender, $response, $pat, $type);
}
