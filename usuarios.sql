DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `phone` varchar(100) default NULL,
  `email` varchar(255) default NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO `usuarios` (`name`,`phone`,`email`)
VALUES
  ("Wendy Decker","1-466-450-1737","auctor.velit@aol.ca"),
  ("Uriah Weaver","1-414-352-5865","integer.vitae@yahoo.com"),
  ("Cade Patel","1-616-457-8745","pede.malesuada.vel@aol.ca"),
  ("Ulla Allison","(733) 414-4623","nec.ante.maecenas@outlook.ca"),
  ("Alea Ward","1-222-945-6128","nulla@icloud.couk");
