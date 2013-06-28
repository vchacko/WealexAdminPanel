Wealex Admin Panel
====================================
Copy Right (c) 2013 wealex.com.
Developed by: vctheguru@gmail.com

This file is part of Wealex Admin Panel.

Wealex Admin Panel is a Code Igniter - based back-end admin panel that could be configured to manage any database structure.

Wealex Admin Panel is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Since 2005, I had the opportunity to program multiple websites starting from website with no database involved at all to one with HUGE database. For the huge ones, we created its on backend & content management system. For the small ones with one or two tables, the CMS we built was too big. Then we looked for any ready-made CMS including WordPress - the obvious option, Drupal, Joomla, not to mention, almost every CMS available in the market. Then basic idea I conceived after looking into many CMS and creating our own, I learned that for all web based CMS we do only 4 basic operations on a database, namely INSERT, SELECT, UPDATE and DELETE. All CMS does these four operations and present the data to have a great user experience. So what is the point? All CMS including the one I built required a set of database tables; most of them require more than 15 tables. What if the only data I want to store is users registered for occasional emails, I need at least the minimum required number of tables for the database. Then what if we decided to add a new field to the database table, say the country from which user registers? In most CMS, it’s possible, but difficult.

Another case is when a techie good at database systems want to build a website, he will always have a design in mind and realises that none of the CMS will take his database design. Or a designer good at designing realises that for his simple website, he need to spend hours or even days to change his favourite design to Wordpress template or Drupal template or any template that CMS can render. Another case I had is a client who liked a Magento theme and wanted her website exactly as the theme and then needed features offered by Oscommerce and so on.

It was the idea of Mr. Preston & Mr. Dopler at CyberSurfers Inc to separate the admin panel from front-end so that we have a great CMS and the front-end could be custom designed. Whatever features the front-end required is supported by the backend. 

But again, the CMS required many tables and configurations that front-end doesn’t need. After many trial and errors, I came up with an idea that fits to ANY database. Its built around CodeIgniter which makes my code more simple. I do agree that the admin panel need to be protected and hence I created a login page and its table. The current version requires a PHP programmer to configure. I am releasing it under GNU/GPL requesting someone to create:
	
1. Import & Export data in CSV, XML & XLS formats
2. Full HTML5 support fot Backend
3. Dynamic Menu on top (Not sure, but have some Ideas)
4. More field validations
5. An install Script
6. A script that lets non-techie or non-PHP programmer to configure for himself

Only request I have is, ALL work should be under GPL and keep the idea to avoid all configuration tables.

I include code thats is part of this package other than default CodeIgniter files and folders. This was developed and tested with CodeIgniter 2.1.3 and any reproduction of their code must be according to their licence and the concept and code of this project must be under GNU GPL.

This is an admin panel for managing Advertisements to be posted on a website. The code for displaying ad is NOT included.
Default user/pass for this illustration is superadmin/superadmin

You can see a demo of business directory at <http://directory.wealex.com/admin/> and login with user/pass as admin/admin

The folder CSS and JS contains required styles & scripts for the UI and the included third party libraries must be distributed under their respective licences.

db.sql contains database structure and first admin user for the package.


Wealex Admin Panel is distributed in the hope that it will be useful but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with Wealex Admin Panel.  If not, see  
<http://www.gnu.org/licenses/>.