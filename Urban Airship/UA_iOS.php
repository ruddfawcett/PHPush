<?php
	define("baseURL", "https://go.urbanairship.com/", true);
	define("appKey", $_POST['appKey'], true);
	define("masterSecret", $_POST['masterSecret'], true);
	define("message", $_POST['message'], true);	
	define("sound", $_POST['sound'], true);	
	define("badge", $_POST['badge'], true);	
	define("deviceToken", $_POST['deviceToken'], true);	
	define("appSecret", $_POST['appSecret'], true);
		
	if (array_key_exists('function', $_POST)) {
		switch ($_POST['function']) {
			case "broadcast":
				broadcast(appKey, masterSecret, message, sound, badge);
			break;
			case "deviceRegistration":
				deviceRegistration(deviceToken, appKey, appSecret);
			break;
			case "deviceInfo":
				deviceInfo(deviceToken, appKey, appSecret);
			break;
			case "deviceDeletion":
				deviceDeletion(deviceToken, appKey, appSecret);
			break;
			default:
				echo json_encode(array("error"=>"inavild function"));
			break;
		}
    }

	function broadcast ($appKey, $masterSecret, $alert, $sound, $badge) {
		$url = baseURL . "api/push/broadcast/";
    	if ($appKey == null || $masterSecret == null || $alert == null || $url == null) {
    		echo json_encode(array("error"=>"some parameters are null"));
    	}
    	else {
    		if (strlen($alert) > 235) {
    			echo json_encode(array("error"=>"alert is too long"));
    		}
    		else {
    			$postData = array();
    			$apsArray = array();
    			
    			$apsArray['alert'] = $alert;
    			if ($badge == null) {
    				$apsArray['badge'] = "auto";
    			}
    			else {
    				$apsArray['badge'] = $badge;
    			}
    			
    			if ($sound == null) {
    				$apsArray['sound'] = "default";
    			}
    			else {
    				$apsArray['sound'] = $sound;
    			}
    			
    			$postData['aps'] = $apsArray;
  	 	 		$content = json_encode($postData);
  	 	 		
 		   		$curl = curl_init($url);
    			curl_setopt($curl, CURLOPT_HEADER, false);
    			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
   			 	curl_setopt($curl, CURLOPT_USERPWD, $appKey . ":" . $masterSecret);
   			 	curl_setopt($curl, CURLOPT_POST, true);
    			curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    			curl_exec($curl);
    		
    			$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    			if ($status == 200) {
					$result = array("result"=>"true");
    			}
    			else {
    		 	  	$result = array("error"=>"unauthorized");
    			}	
        
    			echo json_encode($result);
	
    			curl_close($curl);
    		}
    	}
    }
    
    function deviceRegistration ($deviceToken, $appKey, $appSecret) {
    	$url = baseURL . "api/device_tokens/";
    	if ($deviceToken == null || $url == null || $appKey == null || $appSecret == null) {
    		echo json_encode(array("error"=>"some parameters are null"));
    	}
    	else {
        	if (strlen($deviceToken) == 64) {
        	
    			$curl = curl_init($url . $deviceToken);
    			curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
       			curl_setopt($curl, CURLOPT_USERPWD, $appKey . ":" . $appSecret);

    			$response = curl_exec($curl);
    		
    			$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    		
    			if ($status == 200) {
    				echo json_encode(array("result"=>"updated"));
    			}
    			else if ($status == 201) {
    				echo json_encode(array("result"=>"true"));
    			}
    			else {
    				echo $response;
    			}
    		
    			curl_close($curl);
    		}
    		else {
    			echo json_encode(array("error"=>"invalid device token"));
    		}
    	}
    }
    
    function deviceInfo ($deviceToken, $appKey, $appSecret) {
    	$url = baseURL . "api/device_tokens/";
    	if ($deviceToken == null || $url == null || $appKey == null || $appSecret == null) {
    		echo json_encode(array("error"=>"some parameters are null"));
    	}
    	else {
        	if (strlen($deviceToken) == 64) {
    		$curl = curl_init($url . $deviceToken);
    		curl_setopt($curl, CURLOPT_HEADER, false);
    		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    		curl_setopt($curl, CURLOPT_USERPWD, $appKey . ":" . $appSecret);
    			
    		$response = curl_exec($curl);
    		
    		echo $response;
    		
    		curl_close($curl);
    		}
    		else {
    			echo json_encode(array("error"=>"invalid device token"));
    		}
    	}
    }

    function deviceDeletion ($deviceToken, $appKey, $appSecret) {
   		$url = baseURL . "api/device_tokens/";
    	if ($deviceToken == null || $url == null || $appKey == null || $appSecret == null) {
    		echo json_encode(array("error"=>"some parameters are null"));
    	}
    	else {
        	if (strlen($deviceToken) == 64) {
    			$curl = curl_init($url . $deviceToken);
    			curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
       			curl_setopt($curl, CURLOPT_USERPWD, $appKey . ":" . $appSecret);

    			$response = curl_exec($curl);
    		
    			$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    		
    			if ($status == 204) {
    				echo json_encode(array("result"=>"true"));
    			}
    			else {
    				echo $response;
    			}
    		
    			curl_close($curl);
    		}
    		else {
    			echo json_encode(array("error"=>"invalid device token"));
    		}
    	}
    }
?>