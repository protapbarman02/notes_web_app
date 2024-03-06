CREATE TABLE `user` (
    `id` INT(4) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` TEXT NOT NULL,
    `fname` VARCHAR(255) NOT NULL,
    `age` TINYINT(4) NOT NULL,
    `address` TEXT NOT NULL
);


CREATE TABLE `notes` (
    `nid` INT(4) NOT NULL,
    `uid` INT(4) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `note` TEXT NOT NULL
);

ALTER TABLE `user` ADD PRIMARY KEY(`id`);


ALTER TABLE `notes` ADD PRIMARY KEY(`nid`);


ALTER TABLE `user` CHANGE `id` `id` INT(4) NOT NULL AUTO_INCREMENT;


ALTER TABLE `notes` CHANGE `nid` `nid` INT(4) NOT NULL AUTO_INCREMENT;


INSERT INTO `user` (`id`,`email`,`password`,`fname`,`age`,`address`) VALUES (NULL,'test@test.com','test','TEST','23','testtest');
INSERT INTO `user` (`id`,`email`,`password`,`fname`,`age`,`address`) VALUES (NULL,'test2@test2.com','test','TEST2','11','test2test2');
INSERT INTO `user` (`id`,`email`,`password`,`fname`,`age`,`address`) VALUES (NULL,'protap@gmail.com','1234','Protap Barman','23','sitalkuchi');
INSERT INTO `user` (`id`,`email`,`password`,`fname`,`age`,`address`) VALUES (NULL,'bipasha@gmail.com','1234','bipasha bagchi','20','cooch behar, West Bengal, 736101');


INSERT INTO `notes` (`nid`,`uid`,`title`,`note`) VALUES (NULL,'1','book','read book');
INSERT INTO `notes` (`nid`,`uid`,`title`,`note`) VALUES (NULL,'1','algorithm','solve algorithm');
INSERT INTO `notes` (`nid`,`uid`,`title`,`note`) VALUES (NULL,'2','statistics','revise book');
INSERT INTO `notes` (`nid`,`uid`,`title`,`note`) VALUES (NULL,'2','java','programming practice');
INSERT INTO `notes` (`nid`,`uid`,`title`,`note`) VALUES (NULL,'2','php','complete notes project');