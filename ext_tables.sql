
CREATE TABLE tx_multiblog_domain_model_blog (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
    crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
    deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
    hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
	blogtitel varchar(255) DEFAULT '' NOT NULL,
	blogwriter int(11) DEFAULT '0' NOT NULL,
	blogwritermail varchar(255) DEFAULT '' NOT NULL,
        blogdescription text,
	blogcss INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	blogbild varchar(255) DEFAULT '' NOT NULL,
	lastentry INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        sticky_post int(11) DEFAULT '0' NOT NULL,
        widget_about_blog int(11) DEFAULT '1' NOT NULL,
        widget_recent_post int(11) DEFAULT '1' NOT NULL,
        widget_category int(11) DEFAULT '1' NOT NULL,
        widget_comments int(11) DEFAULT '1' NOT NULL,
        widget_all_posts int(11) DEFAULT '1' NOT NULL,
        blogstyle int(11) DEFAULT '1' NOT NULL,
        blogstyle_teaserimages int(11) DEFAULT '0' NOT NULL,


	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_multiblog_domain_model_entry (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
        hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
	blogid INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	entrytitel varchar(255) DEFAULT '' NOT NULL,
 	entryanleser text,
 	entrypicture varchar(255) DEFAULT '' NOT NULL,
 	entrypictureposition int(11) DEFAULT '0' NOT NULL,
 	entrytext text,
 	entrykategorie1 int(11) DEFAULT '1' NOT NULL,
 	entrykategorie2 int(11) DEFAULT '1' NOT NULL,
 	entrykategorie3 int(11) DEFAULT '1' NOT NULL,
 	entrykategorie4 int(11) DEFAULT '1' NOT NULL,
 	entrydate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
	entrystatus INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        entrysticky INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        entrycommentoption INT(3) UNSIGNED DEFAULT '1' NOT NULL,  


	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_multiblog_domain_model_comment (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
    crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
    deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
    hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
	entryid int(11) DEFAULT '0' NOT NULL,
	blogid int(11) DEFAULT '0' NOT NULL,
	commentdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
	commentname varchar(255) DEFAULT '' NOT NULL,
	commentmail varchar(255) DEFAULT '' NOT NULL,
	commenttitel varchar(255) DEFAULT '' NOT NULL,
	commenttext text,
	commentproved int(11) DEFAULT '0' NOT NULL,
	commentreply text,
	captcha varchar(255) DEFAULT '' NOT NULL, 
	
	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_multiblog_domain_model_kategorie (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
    crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
    deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
    hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
	blogid INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	kategorie varchar(255) DEFAULT '' NOT NULL,
	topkategorie INT(11) UNSIGNED DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(30) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3_origuid int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);
