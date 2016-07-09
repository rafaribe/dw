select * from dishes_xml_view;

INSERT INTO DISHES_XML VALUES ( XMLTYPE (' <xml><item>
        <DISH_ID>99</DISH_ID>
        <DISH_NAME>Camaroleta</DISH_NAME>
        <DISH_TYPE>Saida</DISH_TYPE>
        <DISH_IMAGE>camaroleta.jpg</DISH_IMAGE>
</item></xml>'));

UPDATE DISHES_XML po SET po.OBJECT_VALUE =
updateXML(po.OBJECT_VALUE,
'/xml/item/DISH_NAME/text()', 'Cebolinha')
WHERE XMLExists('$po2/xml/item[DISH_ID="1"]'PASSING
OBJECT_VALUE AS "po2");

