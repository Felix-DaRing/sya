<?php
// parameters
$hubVerifyToken = 'Sengyunaung';
$accessToken =   "EAAWfRQIvvGsBAFqtsqI8wmJ7mqZAG4WXWNWucUwUKYdjLYeyWBUL8bXJ6YKf0UsDfqVgZA7bEpeEZAZAaQAky4XvSZB9v9vUpEjSYDyVvPqPTZAN6o5wioFK5YPnrMlPyG2HOCRghGhIeNmx0CZBTz4ZBJeozOZA4ijnbjW9yZC1M6DgZDZD";
// check token at setup
if ($_REQUEST['hub_verify_token'] === $hubVerifyToken) {
  echo $_REQUEST['hub_challenge'];
  exit;
}
// handle bot's anwser
$input = json_decode(file_get_contents('php://input'), true);
$senderId = $input['entry'][0]['messaging'][0]['sender']['id'];
$messageText = $input['entry'][0]['messaging'][0]['message']['text'];
$response = null;
//set Message


if($messageText == "hi") {
    $answer = "Welcome to SYA Dictionary";
} elseif($messageText == "hello") {
	$answer = "SYA Dictionary Kaw Na Hkap Tau La Ga Ai";     
} elseif($messageText == "a") {
	$answer = "Langai. hkum-mi. Law law kaw na langai. Amyu baw sha re ai.";
} elseif($messageText == "an") {
	$answer = "Langai. hkum-mi. Law law kaw na langai. Amyu baw sha re ai.";
} elseif($messageText == "aback") {
	$answer = "(adv) Hpang de, Shingdu de.";
} elseif($messageText == "abacus") {
	$answer = "(n)Sawnhkrang. Miwa sawnhkrang."
}


//send message to facebook bot
$response = [
    'recipient' => [ 'id' => $senderId ],
    'message' => [ 'text' => $answer ]
];
$ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token='.$accessToken);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
if(!empty($input)){
$result = curl_exec($ch);
}
curl_close($ch);

?>
