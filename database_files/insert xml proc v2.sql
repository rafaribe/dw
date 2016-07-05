with sample_data as (select 'a' dish_name, 'b' dish_type, 'c' dish_image from dual)
select xmlelement("xml", xmlelement("item",
                                    xmlforest(XML_TAB_SEQ.nextval as dish_id,
                                              dish_name,
                                              dish_type,
                                              dish_image))) xmldata
from  sample_data;

CREATE OR REPLACE PROCEDURE insert_xml_v2_proc (
dish_name IN VARCHAR2,
dish_type IN VARCHAR2,
dish_image IN VARCHAR2 ) AS
BEGIN
insert into xml_tab (xml_data) select xmlelement("xml", xmlelement("item",
                                    xmlforest(XML_TAB_SEQ.nextval as dish_id,
                                              dish_name,
                                              dish_type,
                                              dish_image))) xmldata from dual ;
--INSERT INTO DISHES VALUES(DISHES_SEQ.NEXTVAL,dish_name,dish_type,dish_image);
END;
/
