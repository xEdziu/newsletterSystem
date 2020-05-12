CREATE TABLE `news_messeages` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(2000) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `news_messeages`
  ADD PRIMARY KEY (`id`);
COMMIT;

