RMS-Cache
=========

This project scrapes and caches **predicted** travel times on Sydney's M2 motorway, then serves the most recent three hours as CSV. It uses Roads and Maritime Services data posted at http://livetraffic.rta.nsw.gov.au/traffic/travel_time/m2.json.

Results can be seen at http://experiments.electronsoup.net/rms_times/ (smashed into charted.co graphs).

Pull requests happily entertained as the initial commits are about as far as I can easily get on my current skill level. Front-end contributions welcomed too.

Eventual goal is to release this data as a training set for machine learning if appropriate.

##Instructions

1. Create the database (rms-cache.sql)
2. Call scrapeM2.php whenever you want to update (I use a per-minute cron as data is sometimes updated at sub-minute level)
3. Produce east/westbound CSV with the respective csv.php file.

contact: flashman@gmail.com / [@flashman](http://www.twitter.com/flashman)

