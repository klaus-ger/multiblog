#
# Table structure for table "backend_layout"
#
DROP TABLE IF EXISTS backend_layout;

CREATE TABLE backend_layout (
  uid int(11) NOT NULL AUTO_INCREMENT,
  pid int(11) NOT NULL DEFAULT '0',
  t3ver_oid int(11) NOT NULL DEFAULT '0',
  t3ver_id int(11) NOT NULL DEFAULT '0',
  t3ver_wsid int(11) NOT NULL DEFAULT '0',
  t3ver_label varchar(255) NOT NULL DEFAULT '',
  t3ver_state tinyint(4) NOT NULL DEFAULT '0',
  t3ver_stage int(11) NOT NULL DEFAULT '0',
  t3ver_count int(11) NOT NULL DEFAULT '0',
  t3ver_tstamp int(11) NOT NULL DEFAULT '0',
  t3ver_move_id int(11) NOT NULL DEFAULT '0',
  t3_origuid int(11) NOT NULL DEFAULT '0',
  tstamp int(11) unsigned NOT NULL DEFAULT '0',
  crdate int(11) unsigned NOT NULL DEFAULT '0',
  cruser_id int(11) unsigned NOT NULL DEFAULT '0',
  hidden tinyint(4) unsigned NOT NULL DEFAULT '0',
  deleted tinyint(4) NOT NULL DEFAULT '0',
  sorting int(11) unsigned NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL DEFAULT '',
  description text NOT NULL,
  config text NOT NULL,
  icon text NOT NULL,
  PRIMARY KEY (uid),
  KEY parent (pid),
  KEY t3ver_oid (t3ver_oid,t3ver_wsid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;



INSERT INTO backend_layout (uid, pid, t3ver_oid, t3ver_id, t3ver_wsid, t3ver_label, t3ver_state, t3ver_stage, t3ver_count, t3ver_tstamp, t3ver_move_id, t3_origuid, tstamp, crdate, cruser_id, hidden, deleted, sorting, title, description, config, icon) VALUES
(1, 346, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 1364678171, 1354016519, 1, 0, 0, 256, 'Two Cols + Header 66% | 33%', '', 'backend_layout {\r\n	colCount = 2\r\n	rowCount = 2\r\n	rows {\r\n		1 {\r\n			columns {\r\n				1 {\r\n					name = SLIDER\r\n					colspan = 2\r\n					colPos = 0\r\n				}\r\n			}\r\n		}\r\n		2 {\r\n			columns {\r\n				1 {\r\n					name = Content\r\n					colPos = 1\r\n				}\r\n				2 {\r\n					name = Sidebar\r\n					colPos = 2\r\n				}\r\n                }\r\n    }\r\n}\r\n}\r\n', 'bglayout_2cols.png'),
(2, 346, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 1364680362, 1364680362, 5, 0, 0, 128, 'One Col + Header', '', 'backend_layout {\r\n	colCount = 1\r\n	rowCount = 2\r\n	rows {\r\n		1 {\r\n			columns {\r\n				1 {\r\n					name = SLIDER\r\n					colPos = 0\r\n				}\r\n			}\r\n		}\r\n		2 {\r\n			columns {\r\n				1 {\r\n					name = CONTENT_NORMAL\r\n					colPos = 1\r\n				}\r\n			}\r\n		}\r\n	}\r\n}\r\n', 'bglayout_1col.png'),
(3, 346, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 1365003006, 1364680562, 5, 0, 0, 64, 'Three Cols + Header', '', 'backend_layout {\r\n	colCount = 3\r\n	rowCount = 2\r\n	rows {\r\n		1 {\r\n			columns {\r\n				1 {\r\n					name = SLIDER\r\n					colspan = 3\r\n					colPos = 0\r\n				}\r\n			}\r\n		}\r\n		2 {\r\n			columns {\r\n				1 {\r\n					name = Links	\r\n					colPos = 1\r\n				}\r\n                               2 {\r\n                                      name = Mitte\r\n                                      colPos = 2\r\n                              }\r\n                              3 {\r\n                                     name = Rechts\r\n                                     colPos = 3\r\n                               }\r\n                       }\r\n                }\r\n		\r\n		\r\n       }\r\n}', 'bglayout_3cols.png');
