> # PHPush
Allows you to POST from any project in any language and send a push notification.

[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/ruddfawcett/PHPush/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

## Urban Airship

### Current Functions (4):

- [Broadcast] (https://docs.urbanairship.com/display/DOCS/Server%3A+iOS+Push+API#ServeriOSPushAPI-Broadcast)
- [Device Registration] (https://docs.urbanairship.com/display/DOCS/Server%3A+iOS+Push+API#ServeriOSPushAPI-Registeradevicetoken)
- [Device Info] (https://docs.urbanairship.com/display/DOCS/Server%3A+iOS+Push+API#ServeriOSPushAPI-Gettheinformationassociatedwithadevicetoken)
- [Device Deletion] (https://docs.urbanairship.com/display/DOCS/Server%3A+iOS+Push+API#ServeriOSPushAPI-Markthedevicetokenasinactive)

### Future Functions (?):

- Unknown

### Examples
 
**PHP** - [Broadcast] (https://docs.urbanairship.com/display/DOCS/Server%3A+iOS+Push+API#ServeriOSPushAPI-Broadcast)
 
Require the UA_iOS.php file...

    require('PHPush/Urban Airship/UA_iOS.php');

Declare your variables...

    $appKey = "";
    $masterSecret = "";
    $message = "";

These variables below are not necessary, and can be left `null` (If they are null, the will result to default, meaning the sound will be the default sound, and the badge number will increment)...

    $sound = "";
    $badge = "";

Then, send your notification using the `broadcast` function...

    broadcast($appKey, $masterSecret, $message, $sound, $badge);
    
Note, you should still include `$sound` and `$badge` even if you do not use them...

More examples can be [found here] (https://github.com/ruddfawcett/PHPush/tree/master/Urban%20Airship/Examples).

## Parse

### Current Functions (1):

- [Push Notifications] (https://parse.com/docs/rest#push)

### Future Functions (0):

- This repository is just for notifications!

### Examples
 
**PHP** - [Send Notification] (https://www.parse.com/docs/push_guide#sending/REST)
 
Require the UA_iOS.php file...

    require('PHPush/Parse/Parse_iOS.php');

Declare your variables...

    $appID = "";
    $restKey = "";
    $message = "";
 $deviceType = "ios";

These variables below are not necessary, and can be left `null` (If they are null, they will result to default, meaning the sound will be the default sound, and the badge number will increment)...

    $sound = "";
    $badge = "";

Create a list of your channels (Using the format `channel1, channel2, channel3`)...

	$channels = "channel1, channel2, channel3";
	
Note, if you do not include channels, the default channel is `""` (Parse automatically adds this channel to each device for you, I think).

Then, send your notification using the `sendNotification` function...

    sendNotification($appID, $restKey, $message, $sound, $deviceType, $channels, $badge);
    
Note, you should still include `$sound` and `$badge` even if you do not use them...
