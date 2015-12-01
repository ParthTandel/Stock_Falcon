# Stock_Falcon
Software engineering project a stock prediction website
Note : prediction done for indexes only in NSE
Need to tweek the code in order to make it work for other stocks
Instructions for deploying the application

assuming that you have an experience in php and phpMyadmin

Firstly create a new user in database with the name project and password : tcejorp now you can use any of your username and password but you have to change it in all files.
The host set default is localhost.
Give the use global previlages
Then import the stockfalcon.sql file to you database.

now using cron tabs schedule the code ann_window/ubuntu.jar or u can use the source files in folder ANN_copy 
now for crontabs 
ubuntu view this https://help.ubuntu.com/community/CronHowto
windows view this http://windows.microsoft.com/en-us/windows/schedule-task#1TC=windows-7

now as the stock market is opened from monday to friday from 9:00 am to 4:30 am
set the time of running this code just after the market close this will predict the price for next day and automatically store the price in database
Now also set the time for running of file mail_send_watchlist.php just after the above code ends use trial and catch to get the exact time.

then run the file clear poll.py at every night at around 11:58pm so that it clear the log of poll for that day from the database


Now run the file final_card.py directly using python forever on the server.

After that Copy the content from folder project to your htdocs/your_project_name folder.




