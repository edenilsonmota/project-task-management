CREATE TABLE `task` (
                        `idTask` int NOT NULL AUTO_INCREMENT,
                        `title` varchar(255) NOT NULL,
                        `description` text,
                        `status` int NOT NULL,
                        `type` int NOT NULL,
                        `dateTimeCreate` datetime NOT NULL,
                        PRIMARY KEY (`idTask`)
)