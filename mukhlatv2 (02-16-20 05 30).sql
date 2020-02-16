--
-- Table structure for table tbl_topics
--

CREATE TABLE tbl_topics (
  topic_id int(11) NOT NULL,
  creator_id int(11) NOT NULL,
  topic_name varchar(35) NOT NULL,
  topic_description varchar(256) NOT NULL,
  theme varchar(256) DEFAULT NULL,
  nameframe varchar(256) DEFAULT NULL,
  board varchar(256) DEFAULT NULL,
  bulletin varchar(256) DEFAULT NULL,
  shoutout varchar(256) DEFAULT NULL,
  media varchar(256) DEFAULT NULL,
  chatbox varchar(256) DEFAULT NULL,
  date_created datetime DEFAULT NULL,
  is_cancelled int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table tbl_topics
--

INSERT INTO tbl_topics (topic_id, creator_id, topic_name, topic_description, theme, nameframe, board, bulletin, shoutout, media, chatbox, date_created, is_cancelled) VALUES
(1, 10, 'Terence\'s Room', '', '10', '1', '1', '1', '1', '1', '1', '2017-06-28 12:01:15', 0),
(2, 11, 'Iris\' Room', '', '6', '1', '1', '1', '1', '1', '1', '2017-07-20 07:44:27', 0),
(3, 12, 'James\' Room', '', '7', '1', '1', '1', '1', '1', '1', '2017-07-11 18:10:48', 0),
(4, 13, 'Michael\'s Room', '', '1', '0', '0', '0', '0', '0', '0', '2017-07-11 19:10:48', 0),
(5, 14, 'Arlan\'s Room', '', '7', '0', '0', '0', '0', '0', '0', '2017-07-11 20:10:48', 0),
(6, 15, 'Karl\'s Room', '', '8', '0', '0', '0', '0', '0', '0', '2017-07-14 04:01:46', 0),
(7, 16, 'Khobert\'s Room', '', '17', '0', '0', '0', '0', '0', '0', '2017-07-19 13:57:14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table tbl_topics
--
ALTER TABLE tbl_topics
  ADD PRIMARY KEY (topic_id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table tbl_topics
--
ALTER TABLE tbl_topics
  MODIFY topic_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;