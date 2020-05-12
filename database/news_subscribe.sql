
CREATE TABLE `news_subscribe` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `news_subscribe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`email`);
COMMIT;

