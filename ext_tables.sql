CREATE TABLE tx_multiblog_domain_model_blog (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        cruser_id INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
        hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
	blogtitel varchar(255) DEFAULT '' NOT NULL,
	blogowner int(11) DEFAULT '0' NOT NULL,
	blogwritermail varchar(255) DEFAULT '' NOT NULL,
        blogdescription text,
	blogcss INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	blogpicture varchar(255) DEFAULT '' NOT NULL,
	lastentry INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        sticky_post int(11) DEFAULT '0' NOT NULL,
        widget_about_blog TINYINT(4) UNSIGNED DEFAULT '1' NOT NULL, 
        widget_recent_post TINYINT(4) UNSIGNED DEFAULT '1' NOT NULL, 
        widget_category TINYINT(4) UNSIGNED DEFAULT '1' NOT NULL, 
        widget_comments TINYINT(4) UNSIGNED DEFAULT '1' NOT NULL, ,
        widget_all_posts TINYINT(4) UNSIGNED DEFAULT '1' NOT NULL, 
        widget_meta TINYINT(4) UNSIGNED DEFAULT '1' NOT NULL, 
        blogstyle int(11) DEFAULT '0' NOT NULL,
        blogstyle_teaserimages int(11) DEFAULT '0' NOT NULL,
        blogseotitle varchar(255) DEFAULT '' NOT NULL,
        blogseodescription varchar(255) DEFAULT '' NOT NULL,

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
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_multiblog_domain_model_post (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        cruser_id INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
        hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
	blogid INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	posttitel varchar(255) DEFAULT '' NOT NULL,
 	postintro text,
 	postpicture varchar(255) DEFAULT '' NOT NULL,
 	
 	postdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
	poststatus INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        poststicky INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        postcommentoption INT(3) UNSIGNED DEFAULT '1' NOT NULL,
        postshowteaser TINYINT(4) UNSIGNED DEFAULT '1' NOT NULL,  
        category text,
        postcontent text,
        image varchar(255) DEFAULT '' NOT NULL,
        files varchar(255) DEFAULT '' NOT NULL,
         
        postseodescription varchar(255) DEFAULT '' NOT NULL,
        postlink varchar(255) DEFAULT '' NOT NULL,

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
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);


CREATE TABLE tx_multiblog_domain_model_content (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
        hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
	postid INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	postcontent text,
 	postpicture varchar(255) DEFAULT '' NOT NULL,
 	imageposition TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL,

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
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_multiblog_domain_model_comment (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        cruser_id INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
        hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
	postid INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        blogid INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	commenttext text,
 	commentname varchar(255) DEFAULT '' NOT NULL,
        commentdate INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        commentmail varchar(255) DEFAULT '' NOT NULL,
 	commentapprove tinyint(4) DEFAULT '0' NOT NULL,

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
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_multiblog_domain_model_category (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
        hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
        blogid INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	kategory varchar(255) DEFAULT '' NOT NULL,
	topkategory INT(11) UNSIGNED DEFAULT '0' NOT NULL,  

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
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_multiblog_post_category_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);


CREATE TABLE tx_multiblog_domain_model_postcategory (
	uid int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	tstamp INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        cruser_id INT(11) UNSIGNED DEFAULT '0' NOT NULL, 
        deleted TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
        hidden TINYINT(4) UNSIGNED DEFAULT '0' NOT NULL, 
	
        post INT(11) UNSIGNED DEFAULT '0' NOT NULL,
        category INT(11) UNSIGNED DEFAULT '0' NOT NULL,

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
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);
