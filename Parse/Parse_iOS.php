<?php
	define("url", "https://api.parse.com/1/push", true);
	define("channels", $_POST['channels'], true);
	define("deviceType", "ios", true);
	define("message", $_POST['alert'], true);	
	define("sound", $_POST['sound'], true);	
	define("appID", $_POST['appID'], true);	
	define("restKey", $_POST['restKey'], true);
	define("badge", $_POST['badge'], true);
	
	if (array_key_exists('function', $_POST)) {
		switch ($_POST['function']) {
			case "sendNotification":
				sendNotification(appID, restKey, message, sound, deviceType, channels, badge);
			break;
			default:
				echo json_encode(array("error"=>"inavild function"));
			break;
		}
	}
	
	function sendNotification ($appID, $restKey, $message, $sound, $deviceType, $channels, $badge) {
		if ($appID == null || $restKey == null || $message == null) {
			echo json_encode(array("error"=>"some parameters are null"));
		}		
		else {
			$appIDHeader = "X-Parse-Application-Id: " . $appID;
			$restKeyHeader = "X-Parse-REST-API-Key: " . $restKey;
			$contentType = "Content-Type: application/json";
					
			$postData = array();
			$notifData = array();
			
			$postData['type'] = $deviceType;
						
			if ($channels != null) {
				$postData['channels'] = explode(', ',$channels);
			}
			else {
				$postData['channels'] = "";
			}			
			
			$notifData['alert'] = $message;
			
			if ($sound != null) {
				$notifData['sound'] = $sound;
			}
			else {
				$notifData['sound'] = "push.caf";
			}			
			
			if ($badge != null) {
				$notifData['badge'] = $badge;
			}
			else {
				$notifData['badge'] = "Increment";
			}		
				
			$postData['data'] = $notifData;
			
			$postDataJSON = json_encode($postData);
			
			$curl = curl_init(url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postDataJSON);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array($appIDHeader, $restKeyHeader, $contentType, 'Content-Length: ' . strlen($postDataJSON)));
			curl_exec($curl);
			
			curl_close($curl);
		}		
	}	
?>