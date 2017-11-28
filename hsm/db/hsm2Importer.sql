USE epigenome;

LOAD DATA LOCAL INFILE 'DatabaseTablesData/LD_Block.txt' INTO TABLE LD_Block
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
/*IGNORE 1 LINES*/
(chr,start,stop,Ref_SNP);

LOAD DATA LOCAL INFILE 'DatabaseTablesData/RefSNPpairs.txt' INTO TABLE RefSNPpairs
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
/*IGNORE 1 LINES*/
(SNP,Ref_SNP);

LOAD DATA LOCAL INFILE 'DatabaseTablesData/SNP.txt' INTO TABLE SNP
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
/*IGNORE 1 LINES*/
(chr,start,stop,SNP);

LOAD DATA LOCAL INFILE 'DatabaseTablesData/files.txt' INTO TABLE files
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
/*IGNORE 1 LINES*/
(SNP,1DISC_dataFile, 1DISC_graph_png, 1DISC_graph_pdf, 2FOLL_dataFile, 2FOLL_graph_png, 2FOLL_graph_pdf, 3REPL_dataFile, 3REPL_graph_png, 3REPL_graph_pdf, vALL_dataFile, vALL_graph_png, vALL_graph_pdf);

LOAD DATA LOCAL INFILE 'DatabaseTablesData/annotationIDpairs.txt' INTO TABLE annotationIDpairs
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
/*IGNORE 1 LINES*/
(SNP,annotation);

LOAD DATA LOCAL INFILE 'DatabaseTablesData/geneIDpairs.txt' INTO TABLE geneIDpairs
FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\n'
/*IGNORE 1 LINES*/
(SNP,gene);

ALTER TABLE LD_Block ADD INDEX(chr);
ALTER TABLE SNP ADD INDEX(chr);
ALTER TABLE annotationIDpairs ADD INDEX(annotation);
ALTER TABLE geneIDpairs ADD INDEX(gene);
