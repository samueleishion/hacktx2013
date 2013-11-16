#!/bin/bash
library(rjson); 

# You need the previous two lines 
# 	the first one ensures your code will run with mine, 
# 	the second one imports a library to read the posts in their native form 
# 
# In order to test your code, you can use R or terminal: 
# 	You can open your file in the R windowed app as usual, or
# 	you can open terminal, navigate to the directory of your file, 
# 	and type: 
# 		r --slave -f <you-file-name>.r 
#
# 	for example, to run this file, you would type: 
# 		r --slave -f process.r 


# This is an example of how to read json formatted strings. 
t1 = '{"media":"tweet","data":{"coords":{"long":34.5,"lat":72.3}}}'; 
t2 = '{"media":"tweet","data":{"coords":{"long":33.2,"lat":71.8}}}'; 
json1 = fromJSON(t1); 
json2 = fromJSON(t2); 

cat(json1$data$coords$lat) 
cat("\n")
cat(json1$data$coords$long)
cat("\n")
cat(json2$data$coords$lat)
cat("\n")
cat(json2$data$coords$long)
cat("\n")
cat("\n")


# This is an example of how to concatenate (glue together) strings 
json1latlong = paste(json1$data$coords$lat,json1$data$coords$long,sep=", ")
json2latlong = paste(json2$data$coords$lat,json2$data$coords$long,sep=", ")
cat(json1latlong)
cat("\n")
cat(json2latlong)
cat("\n")
cat("\n")


# This is an example of how to read the first tweet on the file tweets.out 
tweet = '{"metadata":{"result_type":"recent","iso_language_code":"en"},"created_at":"Fri Oct 04 07:00:16 +0000 2013","id":3.86022945917e+17,"id_str":"386022945916612608","text":"Nothing but Iriscar bombsand star fuckers #sixthstreet","source":"Twitter for Android","truncated":false,"in_reply_to_status_id":null,"in_reply_to_status_id_str":null,"in_reply_to_user_id":null,"in_reply_to_user_id_str":null,"in_reply_to_screen_name":null,"user":{"id":246997989,"id_str":"246997989","name":"clinton kyle cowan ","screen_name":"kyle_cowan15","location":"San Marcos, TX","description":"TXST, Astros, and gaming... yep that sums it up","url":null,"entities":{"description":{"urls":[]}},"protected":false,"followers_count":145,"friends_count":491,"listed_count":0,"created_at":"Thu Feb 03 21:58:07 +0000 2011","favourites_count":295,"utc_offset":null,"time_zone":null,"geo_enabled":true,"verified":false,"statuses_count":6511,"lang":"en","contributors_enabled":false,"is_translator":false,"profile_background_color":"C0DEED","profile_background_image_url":"http://abs.twimg.com/images/themes/theme1/bg.png","profile_background_image_url_https":"https://abs.twimg.com/images/themes/theme1/bg.png","profile_background_tile":false,"profile_image_url":"http://a0.twimg.com/profile_images/378800000485863990/f331b239173571797981672e6a9b0c3c_normal.jpeg","profile_image_url_https":"https://si0.twimg.com/profile_images/378800000485863990/f331b239173571797981672e6a9b0c3c_normal.jpeg","profile_banner_url":"https://pbs.twimg.com/profile_banners/246997989/1373001987","profile_link_color":"0084B4","profile_sidebar_border_color":"C0DEED","profile_sidebar_fill_color":"DDEEF6","profile_text_color":"333333","profile_use_background_image":true,"default_profile":true,"default_profile_image":false,"following":false,"follow_request_sent":false,"notifications":false},"geo":{"type":"Point","coordinates":[30.2671638,-97.7380259]},"coordinates":{"type":"Point","coordinates":[-97.7380259,30.2671638]},"place":{"id":"c3f37afa9efcf94b","url":"https://api.twitter.com/1.1/geo/id/c3f37afa9efcf94b.json","place_type":"city","name":"Austin","full_name":"Austin, TX","country_code":"US","country":"United States","bounding_box":{"type":"Polygon","coordinates":[[[-97.938383,30.098659],[-97.56842,30.098659],[-97.56842,30.49685],[-97.938383,30.49685]]]},"attributes":{}},"contributors":null,"retweet_count":0,"favorite_count":0,"entities":{"hashtags":[{"text":"sixthstreet","indices":[42,54]}],"symbols":[],"urls":[],"user_mentions":[]},"favorited":false,"retweeted":false,"lang":"en"}'
tweetJson = fromJSON(tweet); 

cat(tweetJson$text)
cat("\n")

coords = tweetJson$geo$coordinates
cat(coords[1])
cat("\n")
cat(coords[2])
cat("\n")
cat("\n")