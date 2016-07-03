CREATE OR REPLACE DIRECTORY bfile_dir AS '/usr/bin/bfile_dir';


BEGIN
DBMS_XMLSCHEMA.registerSchema(
SCHEMAURL => 'https://cdn.rawgit.com/Nagashitw/dw/master/database_files/xml_schema.xsd',
SCHEMADOC => bfilename('BFILE_DIR','xml_schema.xsd'),
CSID => nls_charset_id('AL32UTF8'));
END;