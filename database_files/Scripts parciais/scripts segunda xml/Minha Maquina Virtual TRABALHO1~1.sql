create or replace directory XMLDIR as '/home/oracle/xmldir';
/
DECLARE
BEGIN
  DBMS_XMLSCHEMA.registerSchema(
  SCHEMAURL => 'https://raw.githubusercontent.com/Nagashitw/dw/master/database_files/xml/dishes.xml',
  SCHEMADOC => bfilename ('XMLDIR','dishes.xml'),
  CSID => nls_charset_id('AL32UTF8'));
END;
/

select * from user_xml_schamas;
