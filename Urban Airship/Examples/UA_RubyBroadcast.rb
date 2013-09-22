#In Ruby, as you can see, you can send a broadcast quite easily...

require 'net/http'
require 'uri'

#Declare your variables...

appKey = "";
masterSecret = "";
message = "";

#These variables below are not necessary, and can be left null (If they are null, the will result to default, meaning the sound will be the default sound, and the badge number will increment)...

sound = "";
badge = "";

#Post the data...

postData = Net::HTTP.post_form(URI.parse('http://mydomain.com/UA_iOS.php'), 
                           {'appKey'=>appKey,'masterSecret'=>masterSecret,'message'=>message, 'sound'=>sound, 'badge'=>badge, 'function'=>'broadcast'})
                           
#Grab the result (If you would like)...

puts postData.body