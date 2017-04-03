LOAD DATA LOCAL INFILE 'hsmData.txt' INTO TABLE LD_Block
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
/*IGNORE 1 LINES*/
(id,chr,start,stop,boxplotFilename,dataFilename,pValFilename);
