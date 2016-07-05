--select * from xml_view;
--select count(*) from XML_TAB into :dish_id;
--select * from xml_tab;
CREATE OR REPLACE PROCEDURE insert_xml_proc (
dish_name IN VARCHAR2,
dish_type IN VARCHAR2,
dish_image IN VARCHAR2 ) AS
BEGIN
INSERT INTO XML_TAB (XML_DATA) values(
xmltype(
'<xml>
<item>
    <DISH_ID>'||XML_TAB_SEQ.NEXTVAL||'</DISH_ID>
    <DISH_NAME>'||dish_name||'</DISH_NAME>
    <DISH_TYPE>'||dish_type||'</DISH_TYPE>
    <DISH_IMAGE>'||dish_image||'</DISH_IMAGE>
</item></xml>' ));
INSERT INTO DISHES VALUES(DISHES_SEQ.NEXTVAL,dish_name,dish_type,dish_image);
END;
/
