DROP TABLE #__banners;

CREATE TABLE #__banners (
id int(10) auto_increment,
name varchar(50) NOT NULL DEFAULT '',
imp int(1) NOT NULL DEFAULT '0',
imphits int(20) NOT NULL DEFAULT '0',
hits int(20) NOT NULL DEFAULT '0',
imageurl varchar(255) NOT NULL DEFAULT '',
clickurl varchar(255) NOT NULL DEFAULT '',
published int(1) NOT NULL DEFAULT '0',
bannercode text,
PRIMARY KEY (id) 
);

DROP TABLE #__categories;

CREATE TABLE #__categories (
id int(10) auto_increment,
parent_id int(11) NOT NULL DEFAULT '0',
title varchar(50) NOT NULL DEFAULT '',
name varchar(255) NOT NULL DEFAULT '',
image varchar(100) NOT NULL DEFAULT '',
image_position varchar(10) NOT NULL DEFAULT '',
section varchar(20) NOT NULL DEFAULT '',
description text,
published int(1) NOT NULL DEFAULT '0',
ordering int(10) NOT NULL DEFAULT '0',
access int(3) NOT NULL DEFAULT '0',
count int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (1,0,'topmenu','Limbo CMS','','','com_menu','Limbo CMS',0,0,1,0);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (3,0,'mainmenu','','','','com_menu','',0,1,0,0);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (4,0,'General Content','General Content','blank.png','left','1','',1,2,0,9);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (8,0,'General','General News','topiceditorial.gif','left','2','Other General news related to the website',1,1,0,3);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (24,0,'usermenu','','','','com_menu','',0,0,0,0);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (22,0,'Limbo Sites','Limbo Sites','blank.png','left','com_weblinks','These are some sites which are devoted to limbo . They are a great source for all your limbo needs .',1,1,0,4);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (7,0,'Limbo','Limbo News','mambo.gif','left','2','Limbo - Lite Mambo related News',1,2,0,6);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (25,0,'cool test','cool test','','left','3','',1,1,0,2);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (26,0,'This Limbo install was ...','Install','','','com_polls','',1,1,0,6);

INSERT INTO #__categories (id,parent_id,title,name,image,image_position,section,description,published,ordering,access,count) 
VALUES (28,0,'check1','checl2','','','com_forms','kjkj;hjhkj hoi;hlkh4',0,0,0,0);

DROP TABLE #__components;

CREATE TABLE #__components (
id int(10) auto_increment,
name varchar(50) NOT NULL DEFAULT '',
link varchar(255) NOT NULL DEFAULT '',
menuid int(11) NOT NULL DEFAULT '0',
parent int(11) NOT NULL DEFAULT '0',
admin_menu_link varchar(255) NOT NULL DEFAULT '',
admin_menu_alt varchar(255) NOT NULL DEFAULT '',
option_link varchar(255) NOT NULL DEFAULT '',
ordering int(11) NOT NULL DEFAULT '0',
iscore tinyint(4) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (1,'Newsflash','',0,0,'com_option=newsflash','Manage the Newsflashes','com_newsflash',0,1);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (3,'Weblinks','option=weblinks',0,0,'','Manage the Weblinks','com_weblinks',0,0);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (4,'Items','',0,3,'com_option=weblinks&option=items','Add and Remove links','com_weblinks',0,0);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (5,'Categories','',0,3,'com_option=weblinks&option=categories','Add and Remove link categories','com_weblinks',0,0);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (9,'Polls','option=polls',0,0,'com_option=polls','Manage the polls','com_polls',0,0);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (10,'Search','option=search',0,0,'','','',0,1);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (11,'Contact','option=contact',0,0,'','','',0,1);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (12,'Login','option=login',0,0,'','','',0,1);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (14,'Banners','',0,0,'com_option=banners','Manage the Banners','com_banners',0,1);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (20,'User','option=user',0,0,'','','',0,1);

INSERT INTO #__components (id,name,link,menuid,parent,admin_menu_link,admin_menu_alt,option_link,ordering,iscore) 
VALUES (18,'Frontpage','option=frontpage',0,0,'','','',0,1);

DROP TABLE #__content;

CREATE TABLE #__content (
id int(10) auto_increment,
title varchar(100) NOT NULL DEFAULT '',
title_alias varchar(100) NOT NULL DEFAULT '',
introtext text,
bodytext text,
sectionid int(11) NOT NULL DEFAULT '0',
mask int(11) NOT NULL DEFAULT '0',
catid int(11) NOT NULL DEFAULT '0',
created varchar(20) NOT NULL DEFAULT '',
modified varchar(20) NOT NULL DEFAULT '',
created_by int(11) NOT NULL DEFAULT '0',
created_by_alias varchar(100) NOT NULL DEFAULT '',
published int(1) NOT NULL DEFAULT '0',
frontpage int(1) NOT NULL DEFAULT '0',
ordering int(11),
metakey text,
metadesc text,
access int(11) NOT NULL DEFAULT '0',
hits int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__content (id,title,title_alias,introtext,bodytext,sectionid,mask,catid,created,modified,created_by,created_by_alias,published,frontpage,ordering,metakey,metadesc,access,hits) 
VALUES (13,'Limbo CMS','Limbo','<img border=[ES][DQ]0[ES][DQ] align=[ES][DQ]left[ES][DQ] src=[ES][DQ]images/common/limbo.gif[ES][DQ] alt=[ES][DQ]Limbo[ES][DQ] />Limbo[CR][NL]is a Content Management System, which allows you to build and mange[CR][NL]small dynamic PHP websites very easily. Limbo was inspired from Mambo[CR][NL]and offers same overall functionality and usage. Main aim of limbo was[CR][NL]to be small, secure, fast and be capable of running off simple text[CR][NL]files. BTW limbo is the most powerful text CMS out there.','<p><img border=[ES][DQ]0[ES][DQ] align=[ES][DQ]left[ES][DQ] src=[ES][DQ]images/common/limbo.gif[ES][DQ] alt=[ES][DQ]Limbo[ES][DQ] />Limbo[CR][NL]is a Content Management System, which allows you to build and mange[CR][NL]small dynamic PHP websites very easily. Limbo was inspired from Mambo[CR][NL]and offers same overall functionality and usage. Main aim of limbo was[CR][NL]to be small, secure, fast and be capable of running off simple text[CR][NL]files. BTW limbo is the most powerful text CMS out there. </p>[CR][NL][CR][NL]<p><br />[CR][NL]Limbo Features -</p>[CR][NL]<p>WYSIWYG: Limbo supports full WYSIWYG editing so not HTML required.<br />[CR][NL]Blazingly Fast: Though capable of running from text files limbo is[CR][NL]really fast ( .09sec / page in text db and .07 sec /page for MySQL )<br />[CR][NL] Multiple Database: Limbo it truly database independent offering MySQL and text database as choices. <br />[CR][NL] Small footprint: Limbo is quite small and optimized the whole limbo package is smaller than 250 kb (zipped).<br />[CR][NL] Powerful Administration: Limbo offers a very power full administration interface to let you manage content easily.<br />[CR][NL] Multilingual: As limbo is already mambo compatible it can use its language packs.<br />[CR][NL]Loads of themes: You have thousands of mambo templates at your disposal[CR][NL]( 4.5 + ).Easy content publishing: Limbo allows you to easily publish[CR][NL]content and news without knowing any HTML. </p>[CR][NL]<p>Core Components - </p>[CR][NL]<p>Link manager: Allows you to put on display links on your site and track them.<br />[CR][NL] News and content publishing: News and content publishing was never so easy.<br />[CR][NL] Polls: Simple Poll where you can take surveys.<br />[CR][NL] File manager: Mange files easily using this module.<br />[CR][NL] Banners: Allows you to put banners &quot; earn some money &quot;.<br />[CR][NL] Newsflash: Show important news items.<br />[CR][NL] Database manger: One click backup and restore of your website.<br />[CR][NL] Contact: users can easily get in touch with you.<br />[CR][NL] Member Ship: Allows you to register members or provide content to specific users only.<br />[CR][NL] Stats: Basic Stats about your website[CR][NL]</p>',2,0,7,'1102361760','1121963195',0,'Administrator',1,1,16,'','',0,5);

INSERT INTO #__content (id,title,title_alias,introtext,bodytext,sectionid,mask,catid,created,modified,created_by,created_by_alias,published,frontpage,ordering,metakey,metadesc,access,hits) 
VALUES (17,'Cool Item 1','Cool Item 1 Name','the ltteers in a wrod are, the olny iprmoetnt tihng is taht frist and lsat [CR][NL]ltteer is at the rghit pclae. The rset can be a toatl mses and you can sitll [CR][NL]raed it wouthit','the ltteers in a wrod are, the olny iprmoetnt tihng is taht frist and lsat [CR][NL]ltteer is at the rghit pclae. The rset can be a toatl mses and you can sitll [CR][NL]raed it wouthit the ltteers in a wrod are, the olny iprmoetnt tihng is taht frist and lsat [CR][NL]ltteer is at the rghit pclae. The rset can be a toatl mses and you can sitll [CR][NL]raed it wouthit the ltteers in a wrod are, the olny iprmoetnt tihng is taht frist and lsat [CR][NL]ltteer is at the rghit pclae. The rset can be a toatl mses and you can sitll [CR][NL]raed it wouthit the ltteers in a wrod are, the olny iprmoetnt tihng is taht frist and lsat [CR][NL]ltteer is at the rghit pclae. The rset can be a toatl mses and you can sitll [CR][NL]raed it wouthit',3,0,25,'1112209069','1112209069',0,'Administrator',0,1,2,'','',0,0);

INSERT INTO #__content (id,title,title_alias,introtext,bodytext,sectionid,mask,catid,created,modified,created_by,created_by_alias,published,frontpage,ordering,metakey,metadesc,access,hits) 
VALUES (18,'Sed ut perspiciatis','Sed ut perspiciatis','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantiumdolor-[CR][NL]emque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis[CR][NL]et quasi architecto beatae vitae dicta sunt explicabo, Nemo enim ipsam voluptatem[CR][NL] quia voluptas si aspernatur aut odit aut fugit, sed quia consequuntur magnidolores eos qui ratione voluptatem sequi nesciunt.','',2,0,8,'1113849234','1113849234',0,'Administrator',4,0,18,'','',0,0);

INSERT INTO #__content (id,title,title_alias,introtext,bodytext,sectionid,mask,catid,created,modified,created_by,created_by_alias,published,frontpage,ordering,metakey,metadesc,access,hits) 
VALUES (19,'Enim ipsam','Enim ipsam','Enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magnidolores eos qui ratione voluptatem sequi nesciunt. Lorem ipsum[CR][NL]dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. [CR][NL]','Enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magnidolores eos qui ratione voluptatem sequi nesciunt. Lorem ipsum[CR][NL]dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. [CR][NL][CR][NL] Enean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi.Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat[CR][NL] malesuada odio.[CR][NL][CR][NL] Corbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maece- [CR][NL] nas sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci.Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.[CR][NL] Sed laoreet aliquam leo.Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.',2,0,8,'1113849276','1113849276',0,'Administrator',4,0,19,'','',0,0);

INSERT INTO #__content (id,title,title_alias,introtext,bodytext,sectionid,mask,catid,created,modified,created_by,created_by_alias,published,frontpage,ordering,metakey,metadesc,access,hits) 
VALUES (20,'Limbo v1.0.4 ','Limbo v1.0.4','Welcome to the Limbo v1.0.4 Stable release . This release comes with[CR][NL]simplification of a lot of features and some major bug fixes and some[CR][NL]help . Hope you like it and please get back if you find any bugs . <br />','',2,0,7,'1117387234','1117387526',0,'Administrator',1,1,20,'','',0,0);

DROP TABLE #__content_frontpage;

CREATE TABLE #__content_frontpage (
id int(10) auto_increment,
content_id int(11) NOT NULL DEFAULT '0',
ordering int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__content_frontpage (id,content_id,ordering) 
VALUES (13,0,4);

INSERT INTO #__content_frontpage (id,content_id,ordering) 
VALUES (17,0,5);

INSERT INTO #__content_frontpage (id,content_id,ordering) 
VALUES (20,0,6);

DROP TABLE #__downloads;

CREATE TABLE #__downloads (
id int(10) auto_increment,
catid int(11) NOT NULL DEFAULT '0',
title varchar(50) NOT NULL DEFAULT '',
url varchar(255) NOT NULL DEFAULT '',
website varchar(255) NOT NULL DEFAULT '',
description text,
filesize varchar(20) NOT NULL DEFAULT '',
date varchar(20) NOT NULL DEFAULT '',
hits int(11) NOT NULL DEFAULT '0',
published int(1) NOT NULL DEFAULT '0',
ordering int(11) NOT NULL DEFAULT '0',
approved int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

DROP TABLE #__gallery;

CREATE TABLE #__gallery (
id int(10) auto_increment,
catid int(11) NOT NULL DEFAULT '0',
title varchar(50) NOT NULL DEFAULT '',
description text,
url varchar(255) NOT NULL DEFAULT '',
date varchar(20) NOT NULL DEFAULT '',
hits int(11) NOT NULL DEFAULT '0',
published int(1) NOT NULL DEFAULT '0',
ordering int(11) NOT NULL DEFAULT '0',
approved int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

DROP TABLE #__menu;

CREATE TABLE #__menu (
id int(10) auto_increment,
menutype varchar(25) NOT NULL DEFAULT '',
name varchar(100) NOT NULL DEFAULT '',
link text,
link_type varchar(50) NOT NULL DEFAULT '',
published int(1) NOT NULL DEFAULT '0',
parent int(11) NOT NULL DEFAULT '0',
componentid int(11) NOT NULL DEFAULT '0',
sublevel int(11) NOT NULL DEFAULT '0',
ordering int(11) NOT NULL DEFAULT '0',
browsernav int(4) NOT NULL DEFAULT '0',
access int(3) NOT NULL DEFAULT '0',
params text,
PRIMARY KEY (id) 
);

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (2,'mainmenu','Weblinks','index.php?option=weblinks','component',1,0,3,0,13,0,0,'show_count=10[NL]');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (3,'mainmenu','Contact','index.php?option=contact','component',1,0,11,0,16,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (22,'mainmenu','Home','index.php?option=frontpage','component',1,0,18,0,2,0,0,'show_count=10[NL]icons=1[NL]');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (37,'usermenu','Your Details','index.php?option=user','component',1,0,20,0,1,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (35,'mainmenu','Administrator','admin.php','url',1,0,0,0,20,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (36,'mainmenu','Search','index.php?option=search','component',1,0,10,0,17,0,0,'show_count=10[NL]');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (33,'mainmenu','Limbo Home','http://www.limbo-cms.com','url',1,0,0,0,18,1,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (34,'mainmenu','Limbo Forums','http://www.limbo-cms.com/forum/','url',1,0,0,0,19,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (42,'topmenu','News','index.php?option=content&amp;task=section&amp;id=2','cs',1,0,2,0,3,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (43,'topmenu','Contact Us','index.php?option=contact','component',1,0,11,0,2,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (44,'topmenu','Links','index.php?option=weblinks','component',1,0,3,0,1,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (45,'topmenu','Home','22','cl',1,0,0,0,4,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (10,'mainmenu','News','index.php?option=content&amp;task=section&amp;id=2','cs',1,0,2,0,3,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (40,'usermenu','Logout','index.php?option=login&amp;task=logout','url',1,0,0,0,4,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (39,'usermenu','Submit Weblink','index.php?option=weblinks&amp;task=new','url',1,0,0,0,3,0,0,'');

INSERT INTO #__menu (id,menutype,name,link,link_type,published,parent,componentid,sublevel,ordering,browsernav,access,params) 
VALUES (38,'usermenu','Submit News','index.php?option=content&amp;task=new','url',1,0,0,0,2,0,0,'');

DROP TABLE #__messages;

CREATE TABLE #__messages (
id int(10) auto_increment,
name varchar(50) NOT NULL DEFAULT '',
email varchar(50) NOT NULL DEFAULT '',
message_subject text,
message_text text,
date varchar(20) NOT NULL DEFAULT '',
status int(3) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

DROP TABLE #__modules;

CREATE TABLE #__modules (
id int(10) auto_increment,
title text,
message text,
ordering int(4) NOT NULL DEFAULT '0',
position varchar(10) NOT NULL DEFAULT '',
published int(1) NOT NULL DEFAULT '0',
module varchar(50) NOT NULL DEFAULT '',
numnews int(11) NOT NULL DEFAULT '0',
access int(3) NOT NULL DEFAULT '0',
showtitle int(3) NOT NULL DEFAULT '1',
showon text,
params text,
iscore int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (1,'Main menu','',1,'left',1,'mod_menu',0,0,1,'_0_','',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (2,'Newsflash','',5,'top',1,'mod_newsflash',0,0,1,'_0_','moduleclass_sfx=[NL]',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (21,'Banner','',13,'banner',0,'mod_banner',0,0,0,'_0_','xxx',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (22,'Archive','',16,'right',1,'mod_archive',0,0,1,'_22_','count=10[NL]moduleclass_sfx=[NL]',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (11,'Stats','',15,'left',0,'mod_simple_stats',0,0,1,'_0_','',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (3,'Polls','',7,'right',1,'mod_poll',0,0,1,'_22_','moduleclass_sfx=[NL]',1);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (4,'Content','',9,'user1',0,'content',0,0,1,'_22_','moduleclass_sfx=[NL]',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (5,'Search','',8,'user4',1,'mod_search',0,0,0,'_0_','',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (7,'Select Template','',10,'left',0,'mod_template',0,0,1,'','',1);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (8,'Login','',2,'left',1,'mod_login',0,0,1,'','',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (9,'Top menu','',12,'user3',1,'mod_menu',0,0,0,'_0_','menutype=topmenu[NL]menu_style=flat_list[NL]class_sfx=-nav[NL]moduleclass_sfx=[NL]',2);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (10,'Syndicate','',18,'left',1,'mod_rss',0,0,0,'_0_','',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (13,'NewsFeed','',19,'left',0,'mod_newsfeed',0,0,0,'_0_','',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (12,'Latest News','',14,'user1',1,'mod_latest_news',0,0,1,'_0_','desc=0[NL]count=3[NL]catid=[NL]secid=2[NL]moduleclass_sfx=[NL]',0);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (25,'User Menu','',3,'left',1,'mod_menu',0,1,1,'_0_','menutype=usermenu[NL]menu_style=vertical[NL]class_sfx=[NL]moduleclass_sfx=[NL]',2);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (14,'Whos Online','',17,'right',1,'mod_whosonline',0,0,1,'_22_','moduleclass_sfx=[NL]',2);

INSERT INTO #__modules (id,title,message,ordering,position,published,module,numnews,access,showtitle,showon,params,iscore) 
VALUES (17,'Popular','',4,'user2',1,'mod_popular',0,0,1,'_0_','desc=0[NL]count=5[NL]catid=[NL]secid=[NL]moduleclass_sfx=[NL]',0);

DROP TABLE #__newsflash;

CREATE TABLE #__newsflash (
id int(10) auto_increment,
title varchar(50) NOT NULL DEFAULT '',
news text,
published int(1) NOT NULL DEFAULT '0',
access int(3) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__newsflash (id,title,news,published,access) 
VALUES (1,'New NEw','Yesterday all servers in the U.S. went out on strike in a bid to get more RAM and better CPUs. A spokes person said that the need for better RAM was due to some fool increasing the front-side bus speed. In future, busses will be told to slow down in residential motherboards.',1,0);

INSERT INTO #__newsflash (id,title,news,published,access) 
VALUES (2,'ac','Aoccdrnig to a rscheearch at an Elingsh uinervtisy, it deosn[ES][SQ]t mttaer in waht oredr the ltteers in a wrod are, the olny iprmoetnt tihng is taht frist and lsat ltteer is at the rghit pclae. The rset can be a toatl mses and you can sitll raed it wouthit porbelm. Tihs is bcuseae we do not raed ervey lteter by itslef but the wrod as a wlohe.',1,0);

DROP TABLE #__polls_data;

CREATE TABLE #__polls_data (
id int(10) auto_increment,
pollid int(11) NOT NULL DEFAULT '0',
polloption varchar(255) NOT NULL DEFAULT '',
hits int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__polls_data (id,pollid,polloption,hits) 
VALUES (1,26,'Absolutely simple',0);

INSERT INTO #__polls_data (id,pollid,polloption,hits) 
VALUES (2,26,'Reasonably easy',0);

INSERT INTO #__polls_data (id,pollid,polloption,hits) 
VALUES (3,26,'Not straight-forward but I worked it out',0);

INSERT INTO #__polls_data (id,pollid,polloption,hits) 
VALUES (4,26,'I had to install extra server stuff',0);

INSERT INTO #__polls_data (id,pollid,polloption,hits) 
VALUES (5,26,'I had no idea and got my friend to do it',0);

INSERT INTO #__polls_data (id,pollid,polloption,hits) 
VALUES (6,26,'My dog ran away with the README ...',0);

DROP TABLE #__polls_votes;

CREATE TABLE #__polls_votes (
id int(10) auto_increment,
ip int(16) NOT NULL DEFAULT '0',
pollid int(11) NOT NULL DEFAULT '0',
date varchar(20) NOT NULL DEFAULT '',
PRIMARY KEY (id) 
);

DROP TABLE #__sections;

CREATE TABLE #__sections (
id int(10) auto_increment,
title varchar(50) NOT NULL DEFAULT '',
name varchar(255) NOT NULL DEFAULT '',
image varchar(100) NOT NULL DEFAULT '',
image_position varchar(10) NOT NULL DEFAULT '',
description text,
published int(1) NOT NULL DEFAULT '0',
ordering int(10) NOT NULL DEFAULT '0',
access int(3) NOT NULL DEFAULT '0',
count int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__sections (id,title,name,image,image_position,description,published,ordering,access,count) 
VALUES (2,'News','News','topicgeneral.gif','left','This is the main news sectio with the various news categories given below',1,5,0,2);

INSERT INTO #__sections (id,title,name,image,image_position,description,published,ordering,access,count) 
VALUES (1,'Content','General Content','','left','',1,2,0,1);

DROP TABLE #__simple_stats;

CREATE TABLE #__simple_stats (
id int(10) auto_increment,
ip varchar(16) NOT NULL DEFAULT '',
date varchar(20) NOT NULL DEFAULT '',
count int(10) NOT NULL DEFAULT '0',
uid int(2) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__simple_stats (id,ip,date,count,uid) 
VALUES (1,'','1122143407',0,0);


DROP TABLE #__users;

CREATE TABLE #__users (
id int(10) auto_increment,
name varchar(50) NOT NULL DEFAULT '',
username varchar(25) NOT NULL DEFAULT '',
email varchar(100) NOT NULL DEFAULT '',
password varchar(100) NOT NULL DEFAULT '',
usertype varchar(25) NOT NULL DEFAULT '',
published int(1) NOT NULL DEFAULT '1',
gid int(3) NOT NULL DEFAULT '1',
registerDate varchar(20) NOT NULL DEFAULT '',
lastvisitDate varchar(20) NOT NULL DEFAULT '',
PRIMARY KEY (id) 
);

DROP TABLE #__weblinks;

CREATE TABLE #__weblinks (
id int(10) auto_increment,
catid int(11) NOT NULL DEFAULT '0',
title varchar(50) NOT NULL DEFAULT '',
url varchar(255) NOT NULL DEFAULT '',
description text,
date varchar(20) NOT NULL DEFAULT '',
hits int(11) NOT NULL DEFAULT '0',
published int(1) NOT NULL DEFAULT '0',
ordering int(11) NOT NULL DEFAULT '0',
approved int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (id) 
);

INSERT INTO #__weblinks (id,catid,title,url,description,date,hits,published,ordering,approved) 
VALUES (1,22,'Limbo CMS','http://www.limbo-cms.com','This is the official Limbo website for all your news and support . SO for everything related to limbo come here .','1103316178',3,1,2,0);

INSERT INTO #__weblinks (id,catid,title,url,description,date,hits,published,ordering,approved) 
VALUES (2,22,'Limbo CMS ( German )','http://www.limbo-cms.de','This site is the german portal for the limbo CMS .','1103316113',4,1,3,0);

INSERT INTO #__weblinks (id,catid,title,url,description,date,hits,published,ordering,approved) 
VALUES (3,22,'Limbo Freak','http://www.limbofreak.com/','Very active limbo website with tutorials, modules , components and other addons .','1103314347',4,1,0,0);

INSERT INTO #__weblinks (id,catid,title,url,description,date,hits,published,ordering,approved) 
VALUES (4,22,'Limbo Portal','http://www.limboportal.com','Another website offering news and downloads for limbo .','1103314347',2,1,4,0);

DROP TABLE #__limbots;

CREATE TABLE #__limbots (
id int(10) auto_increment,
name varchar(100) NOT NULL DEFAULT '',
type varchar(30) NOT NULL DEFAULT '',
element varchar(100) NOT NULL DEFAULT '',
showon varchar(255) NOT NULL DEFAULT '',
access int(3) NOT NULL DEFAULT '0',
ordering int(11) NOT NULL DEFAULT '0',
published tinyint(3) NOT NULL DEFAULT '0',
iscore tinyint(3) NOT NULL DEFAULT '0',
params text,
PRIMARY KEY (id) 
);

INSERT INTO #__limbots (id,name,type,element,showon,access,ordering,published,iscore,params) 
VALUES (1,'limvote','content','limvote','_2_',0,1,1,1,'');

INSERT INTO #__limbots (id,name,type,element,showon,access,ordering,published,iscore,params) 
VALUES (2,'searchlinks','search','searchlinks','',0,2,1,1,'');

DROP TABLE #__content_rating;

CREATE TABLE #__content_rating (
id int(10) auto_increment,
rating_sum int(11) NOT NULL DEFAULT '0',
rating_count int(11) NOT NULL DEFAULT '0',
lastip varchar(50) NOT NULL DEFAULT '',
PRIMARY KEY (id) 
);