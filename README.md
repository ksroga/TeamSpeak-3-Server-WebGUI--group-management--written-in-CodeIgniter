Browser GUI for TeamSpeak 3 Servers (groups management).

Project was written in 2016 (CodeIgniter) and this is my one of 
the first projects in CI.

Project use Telnet Protocol to communicate with a server and MySQL to store data of online users. 
In that way php doesn't connect with a server every time, when user refresh the page, but once for 5 minutes (could be set in CRON). 
This practice is more secure and less demanding.
