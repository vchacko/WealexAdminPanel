<!DOCTYPE html>
<?
/*
Copy Right (c) 2013 wealex.com.
Developed by: vctheguru@gmail.com

This file is part of Wealex Admin Panel.

Wealex Admin Panel is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

Wealex Admin Panel is distributed in the hope that it will be useful but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with Wealex Admin Panel.  If not, see  
<http://www.gnu.org/licenses/>.


I include code thats is part of this package other than default CodeIgniter files and folders. This was developed and tested with CodeIgniter 2.1.3 and any reproduction of their code must be according to their licence and the concept and code of this project must be under GNU GPL.
*/
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Wealex Ads Network Management Console</title>
<link rel="stylesheet" href="/css/style_admin.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="/css/ddsmoothmenu-v.css" />

<script type="text/javascript" src="/js/clockp.js"></script>
<script type="text/javascript" src="/js/clockh.js"></script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/ddsmoothmenu.js"></script>

</head>
<body style='padding:0px;margin:0px;'>
<div id="header">
    <div class="shell">
        <!-- Logo + Top Nav -->
        <div id="top">
    <h1>Wealex Ads Network Admin Panel</h1>
    <div id="top-navigation">
        <div id="clock_a"></div>
        Welcome <strong><?=$first_name?> <?=$last_name?></strong>
        <span>|</span>
        <a href="#">Profile Settings</a>
        <span>|</span>
        <a href="/admin/logout">Log Out</a>
     
    </div>

<script type="text/javascript">
ddsmoothmenu.init({
    mainmenuid: "smoothmenu1", //menu DIV id
    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu', //class added to menu's outer DIV
    //customtheme: ["#1c5a80", "#18374a"],
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
    mainmenuid: "smoothmenu2", //Menu DIV id
    orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
    //customtheme: ["#804000", "#482400"],
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
</script>

<br>
<div id="smoothmenu1"  class="ddsmoothmenu">
    <ul>
        <li><a href="/admin/manage/" class='active'><span>Home</span></a></li>
        <li><a href="#"><span>User</span></a>
            <ul>             
                <li><a href="/admin/users" target='_contentarea'>Administrators</a>
                    <ul>
                        <li><a href="/admin/users/add" target='_contentarea'>Add Administrator</a></li>
                    </ul>
                </li>
                <li><a href="/admin/registered_users" target='_contentarea'>Registered Users</a>
                    <ul>
                        <li><a href="/admin/registered_users/add" target='_contentarea'>Add Registered User</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><a href="#"><span>Advertisements</span></a>
            <ul>             
                <li><a href="/admin/category" target='_contentarea'><span>Ads Categories</span></a>
                    <ul>
                        <li><a href="/admin/category/add" target='_contentarea'>Add Ads Category</a></li>
                    </ul>
                </li>
                <li><a href="/admin/advertisement" target='_contentarea'><span>Advertisements</span></a>
                    <ul>
                        <li><a href="/admin/advertisement/add" target='_contentarea'>Add Advertisement</a></li>
                    </ul>
                </li>
            </ul>  
        </li>    
    </ul>
</div>
</div>
<div style="margin-top:37px;border:0px;height:600px">
<iframe name='_contentarea' style='width:100%;height:600px;border:0px;padding:0px;margin:0px;' src='/admin/welcome'></iframe>
</div>

<div id="footer">
    <div class="shell">
        <span class="left">&copy; 2013&nbsp; Wealex Group All rights reserved. <strong>{elapsed_time}</strong></span>
    </div>
</div>
</body>
</html>