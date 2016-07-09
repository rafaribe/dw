drop table XML_TAB;
create table XML_TAB of xmltype
xmlschema "XML_SCHEMA1"
Element "xml";

create or replace PROCEDURE insert_xml_proc (
dish_name IN VARCHAR,
dish_type IN VARCHAR,
dish_image IN VARCHAR ) AS
BEGIN
INSERT INTO DISHES VALUES (DISHES_SEQ.NEXTVAL,dish_name,dish_type,dish_image);

INSERT INTO XML_TAB values (
xmlelement("xml", 
   xmlelement("item", 
      xmlelement("DISH_ID", XML_TAB_SEQ.nextVAL),
      xmlelement("DISH_NAME", dish_name),
      xmlelement("DISH_TYPE", dish_type),
      xmlelement("DISH_IMAGE", dish_image)
   )
)
);
End;
