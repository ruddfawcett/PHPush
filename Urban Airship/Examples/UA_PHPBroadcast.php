<?php
	// Require the UA_iOS.php file...
	require('UA_iOS.php');
	
	// Declare your variables...
	$appKey = "";
	$masterSecret = "";
	$message = "";
	
	// These variables below are not necessary, and can be left null (If they are null,
	// the will result to default, meaning the sound will be the default sound, and the
	// badge number will increment)...

	$sound = "";
	$badge = "";
	
	// Then, send your notification using the broadcast function...

	broadcast($appKey, $masterSecret, $message, $sound, $badge);
	
	// Note, you should still include $sound and $badge even if you do not use them...
?>