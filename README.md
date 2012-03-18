# TortaPlanner ("Segnalazioni")#
Just a simple planner; in italian.

It was a 2 days work, mainly for testing purpose.
I was trying BakingPlate with cakephp 1.3, and we needed a simple app for internal use.
The goal was to have something functional fast - making use of the grat plugins and goodies for cakephp we can find on github, generating code with bake, tweaking what needed. 

Yes, I know, cake 1.3 is old. I'm just using this app as a playground; it's good for this, and -being small but with some interesnting point and features- as a comparison tool (a quick rewrite, starting from the same db, for testing another framework or, maybe, the new version of cake and bakingPlate).
So, I decided to share it.
Feel free to play with it; of course it's your ouwn call if you want to extend and use it in production ;)

## Features ##
The app was a component inside an intranet system. A simple addition used to plan/schedule communication of events through website, local radio, local newspaper.. and take note of relevant meetings, courses etc. by topic

Users may add events (with one or more dates), categorize them, see upcoming dates by (color coded) category, add dates/events to a "next issue". 


## Dependencies ##
Baking plate, branch for cakephp 1.3

## Batteries NOT included ##
I'm not including the plugins, there is no reason to make another copy.. it's just BakingPlate!
https://github.com/ProLoser/BakingPlate/tree/cake1.3

(required plugins:

*analogue 

*baking_plate

*batch

*debug_kit (optional, but warmly recommended for development)

*lazy model

*linkable

may use in future versions (if ever):

*search

*searchable

*url_cache

*users (cakeDc)

*utils

*webmaster_tools
)

Use the included schema or import the mysql dump.

## Warning ##
There is no Authentication / Authorization. In the original context it was not necessary. 
I may add a simple authentication, or the cakeDC users plugin - but for now, I'll leave it this way. 


## License ##
..is it really necessary?
You will not be making money out of it. 
Let's say MIT, form my code.
This app is just a proof of concept, showing how easy and fast cakephp programming can be - thanks to the cakephp team end the great community.
So, just pay due respect to the true geniuses behind cakepphp, backingPlate and the plugins

## ToDo.. maybe ##
-Authentication / authorization / user management

-email notifications; 

-calendar (month/week) view; 

-more ajax / ui tuninig; 

-search feature (there is only a field by field filter yet); 

-webservices (mainly iCal import / export)


See 
http://stefanomanfredini.info/2012/03/tortaplanner-segnalazioni-una-semplice-app-con-cakephp/
for info.