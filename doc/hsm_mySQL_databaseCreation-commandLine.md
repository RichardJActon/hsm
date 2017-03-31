# hsm mySQL database creation - command line

- Create database
  - `mysql --user="root" --password="" < hsm.sql`
- Populate database
  - `mysql hsm --user="root" --password="" < hsmImporter.sql --local-infile`


- Granting read only priveledge on al tables to 'webuser'
  - `GRANT SELECT ON hsm.* TO 'webuser'@'localhost';`


## queries

```
SELECT SNP.SNP, SNP.chr, SNP.start, SNP.stop,LD_Block.chr, LD_Block.start, LD_Block.stop
FROM SNP,RefSNPpairs, LD_Block
WHERE RefSNPpairs.SNP = "rs6025" 
AND RefSNPpairs.Ref_SNP = LD_Block.Ref_SNP
AND RefSNPpairs.SNP = SNP.SNP;
```

```
select SNP.SNP,SNP.chr as 'SNP.chr',SNP.start as 'SNP.start',SNP.stop as 'SNP.stop',LD_Block.chr as 'ld.chr',LD_Block.start as 'ld.start',LD_Block.stop as 'ld.stop' from SNP,RefSNPpairs,LD_Block where RefSNPpairs.SNP = "rs6025" and RefSNPpairs.Ref_SNP=LD_Block.Ref_SNP and RefSNPpairs.SNP = SNP.SNP;

```


```
SELECT files.dataFilename, files.pValFilename, SNP.SNP,SNP.chr AS 'SNP.chr',SNP.start AS 'SNP.start',SNP.stop AS 'SNP.stop',LD_Block.chr AS 'ld.chr',LD_Block.start AS 'ld.start',LD_Block.stop AS 'ld.stop' 
FROM SNP,RefSNPpairs,LD_Block,files 
WHERE RefSNPpairs.SNP = "rs6025" 
AND RefSNPpairs.Ref_SNP=LD_Block.Ref_SNP 
AND RefSNPpairs.SNP = SNP.SNP 
AND files.SNP=SNP.SNP;
```


prototype for below - manage multiple and/or/where clasues

```
SELECT hsm2.SNP.SNP,hsm2.geneIDpairs.gene FROM hsm2.geneIDpairs,hsm2.SNP WHERE hsm2.geneIDpairs.gene LIKE "%eg%" AND hsm2.SNP.SNP=hsm2.geneIDpairs.SNP;
```

gene and rs id

```
SELECT hsm2.SNP.SNP FROM hsm2.geneIDpairs,hsm2.SNP WHERE (hsm2.geneIDpairs.gene LIKE "%eg%" OR hsm2.SNP.SNP LIKE "%eg%") AND hsm2.SNP.SNP=hsm2.geneIDpairs.SNP;

```


NB not yet working

```
SELECT hsm2.SNP.SNP FROM hsm2.geneIDpairs,hsm2.annotationIDpairs,hsm2.SNP WHERE (hsm2.geneIDpairs.gene LIKE "%eg%" OR hsm2.annotationIDpairs.annotation LIKE "%eg%" OR hsm2.SNP.SNP LIKE "%eg%") AND hsm2.SNP.SNP=hsm2.geneIDpairs.SNP AND hsm2.SNP.SNP=hsm2.annotationIDpairs.SNP;

```


```
SELECT hsm2.geneIDpairs.gene, hsm2.annotationIDpairs.annotation, SNP.SNP,SNP.chr AS 'SNP.chr',SNP.start AS 'SNP.start',SNP.stop AS 'SNP.stop',LD_Block.chr AS 'ld.chr',LD_Block.start AS 'ld.start',LD_Block.stop AS 'ld.stop' 
FROM SNP,RefSNPpairs,LD_Block,hsm2.annotationIDpairs,hsm2.geneIDpairs
WHERE RefSNPpairs.SNP = "rs6025" 
AND RefSNPpairs.Ref_SNP=LD_Block.Ref_SNP 
AND RefSNPpairs.SNP = SNP.SNP 
AND geneIDpairs.SNP=SNP.SNP
AND annotationIDpairs.SNP=SNP.SNP;
```

## hits on interest query

```
SELECT SNP.SNP,SNP.chr AS 'SNP.chr',SNP.start AS 'SNP.start',SNP.stop AS 'SNP.stop',LD_Block.chr AS 'ld.chr',LD_Block.start AS 'ld.start',LD_Block.stop AS 'ld.stop' 
FROM SNP,RefSNPpairs,LD_Block
WHERE RefSNPpairs.SNP IN('rs7531118','rs1516725','rs180242','rs2388896','rs6469804','rs4147929','rs10499194','rs3129934','rs2248359','rs17356907','rs2823093','rs3802842','rs45430','rs4775302','')
AND RefSNPpairs.Ref_SNP=LD_Block.Ref_SNP 
AND RefSNPpairs.SNP = SNP.SNP;
```