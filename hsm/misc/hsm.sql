/*
hsm
*/
DROP DATABASE IF EXISTS hsm;
CREATE DATABASE hsm;
USE hsm;

CREATE TABLE LD_Block
(
id				VARCHAR(50)		NOT NULL,
chr				VARCHAR(6)		NOT NULL,
start			INT				NOT NULL,
stop			INT				NOT NULL,
boxplotFilename	VARCHAR(500)	NOT NULL,
dataFilename	VARCHAR(500)	NOT NULL,
pValFilename	VARCHAR(500)	NOT NULL,
PRIMARY KEY (id)
)ENGINE = INNODB;

/*
ON UPDATE CASCADE;
ON DELETE CASCADE;
/*