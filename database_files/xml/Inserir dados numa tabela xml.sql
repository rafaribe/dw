CREATE TABLE mytable1 (key_column VARCHAR2(10) PRIMARY KEY, xml_column XMLType);
/
CREATE TABLE mytable2 OF XMLType;
/
create or replace directory XMLDIR as '/home/oracle/xmldir';
/
INSERT INTO mytable2 VALUES (XMLType(bfilename('XMLDIR', 'dishes.xml'),
                                     nls_charset_id('AL32UTF8')));
/
--CREATE DIRECTORY xmldir AS '/home/oracle/xmldir';
CREATE OR REPLACE PROCEDURE loadXML(filename VARCHAR2, file_csid NUMBER) IS
   xbfile  BFILE;
   RET     BOOLEAN;
BEGIN
   xbfile := bfilename('XMLDIR', filename);
   ret := DBMS_XDB.createResource('/dishes.xml', 
                                  xbfile,
                                  file_csid);
END;

BEGIN
  DBMS_XMLSCHEMA.registerSchema(
    'https://raw.githubusercontent.com/Nagashitw/dw/master/database_files/xml/dishes.xml',
    XDBURIType('/source/schemas/poSource/xsd/purchaseOrder.xsd').getCLOB(),
    TRUE,
    TRUE,
    FALSE,
    TRUE);
END;
/

CREATE TABLE xml_tab (
  id       NUMBER,
  xml_data XMLTYPE
);
/

DECLARE
  l_xmltype XMLTYPE;
BEGIN
  SELECT XMLELEMENT("xml",
           XMLAGG(
             XMLELEMENT("item",
               XMLFOREST(
                 e.DISH_ID AS "DISH_ID",
                 e.DISH_NAME AS "DISH_NAME",
                e.DISH_TYPE AS "DISH_TYPE",
                e.DISH_IMAGE AS "DISH_IMAGE"
               )
             )
           ) 
         )
  INTO   l_xmltype
  FROM   dishes e;

  INSERT INTO xml_tab VALUES (1, l_xmltype);
  COMMIT;
END;
/
SET LONG 5000
SELECT x.xml_data.getClobVal()
FROM   xml_tab x;

X.XML_DATA.GETCLOBVAL();
/
-- QUERY que vai buscar dados xml à tabela e coloca em colunas
SELECT xt.*
FROM   xml_tab x,
       XMLTABLE('/xml/item'
         PASSING x.xml_data
         COLUMNS 
           "DISH_ID"    INT  PATH 'DISH_ID',
           "DISH_NAME"    VARCHAR2(200) PATH 'DISH_NAME',
           "DISH_TYPE"    VARCHAR2(200) PATH 'DISH_TYPE',
           "DISH_IMAGE" VARCHAR2(4000) PATH 'DISH_IMAGE'
         ) xt;
/
        
-- View com o select acima

Create or replace view xml_view AS
SELECT xt.*
FROM   xml_tab x,
       XMLTABLE('/xml/item'
         PASSING x.xml_data
         COLUMNS 
           "DISH_ID"    INT  PATH 'DISH_ID',
           "DISH_NAME"    VARCHAR2(200) PATH 'DISH_NAME',
           "DISH_TYPE"    VARCHAR2(200) PATH 'DISH_TYPE',
           "DISH_IMAGE" VARCHAR2(4000) PATH 'DISH_IMAGE'
         ) xt; 
/

  select MAX(DISH_ID) from xml_view;
select * from xml_tab;

create sequence XML_TAB_SEQ START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;
 
 ALTER TABLE XML_TAB
 MODIFY (ID DEFAULT XML_TAB_SEQ.NEXTVAL );


insert into xml_tab (XML_DATA) values (
xmltype(
'<xml>
<item>
        <DISH_ID>1</DISH_ID>
        <DISH_NAME>Bacalhau a Bras</DISH_NAME>
        <DISH_TYPE>Peixe</DISH_TYPE>
        <DISH_IMAGE>bacalhau_bras.jpg</DISH_IMAGE>
</item></xml>' ));

insert into xml_tab (XML_DATA) values (
xmltype(
'<xml>
<item>
        <DISH_ID>1</DISH_ID>
        <DISH_NAME>Bacalhau a Bras</DISH_NAME>
        <DISH_TYPE>Peixe</DISH_TYPE>
        <DISH_IMAGE>bacalhau_bras.jpg</DISH_IMAGE>
</item></xml>' ));




