CREATE TABLE `Student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `stdd` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `Student` (`id`, `name`, `age`, `stdd`) VALUES
(1, 'Abhinav Patel', 19,12),
(2, 'Mohit Patel', 18,12),
(3, 'Shashank Patel', 19,12),
(4, 'Abhinav Patel', 15,8),
(5, 'Rohit Singh', 19,12),
(6, 'Isha Singh', 19,12);
