create or replace PROCEDURE insert_xml_proc (
dish_name IN VARCHAR,
dish_type IN VARCHAR,
dish_image IN VARCHAR ) AS
declare
 dish_id int;
BEGIN

select COUNT(*)+1 into dish_id FROM DISHES_XML;
INSERT INTO DISHES_XML
 values (
xmlelement("xml",
   xmlelement("item",
      xmlelement("DISH_ID", dish_id),
      xmlelement("DISH_NAME", dish_name),
      xmlelement("DISH_TYPE", dish_type),
      xmlelement("DISH_IMAGE", dish_image)
   )
)
);
End;
/
select COUNT(*)+1 FROM DISHES_XML;