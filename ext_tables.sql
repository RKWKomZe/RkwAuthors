#
# Table structure for table 'tx_rkwauthors_domain_model_authors'
#
CREATE TABLE tx_rkwauthors_domain_model_authors (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	first_name varchar(255) DEFAULT '' NOT NULL,
	middle_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	title_after varchar(255) DEFAULT '' NOT NULL,
	title_before varchar(255) DEFAULT '' NOT NULL,
	street varchar(255) DEFAULT '' NOT NULL,
	company varchar(255) DEFAULT '' NOT NULL,
	number varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	function_title varchar(255) DEFAULT '' NOT NULL,
	function_title_short varchar(255) DEFAULT '' NOT NULL,
	function_description text NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	phone varchar(255) DEFAULT '' NOT NULL,
	phone2 varchar(255) DEFAULT '' NOT NULL,
	fax varchar(255) DEFAULT '' NOT NULL,
	url varchar(255) DEFAULT '' NOT NULL,
	facebook_url varchar(255) DEFAULT '' NOT NULL,
	twitter_url varchar(255) DEFAULT '' NOT NULL,
	xing_url varchar(255) DEFAULT '' NOT NULL,
	internal tinyint(1) unsigned DEFAULT '0' NOT NULL,
	show_work tinyint(1) unsigned DEFAULT '0' NOT NULL,
	department int(11) unsigned DEFAULT '0' NOT NULL,
	department_name int(11) unsigned DEFAULT '0' NOT NULL,

	image_small int(11) unsigned NOT NULL default '0',
	image_big int(11) unsigned NOT NULL default '0',
	image_boxes int(11) unsigned NOT NULL default '0',
    image_boxes_is_logo tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'pages'
#
CREATE TABLE pages (

	tx_rkwauthors_authorship int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_rkwauthors_pages_authors_mm'
#
CREATE TABLE tx_rkwauthors_pages_authors_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
