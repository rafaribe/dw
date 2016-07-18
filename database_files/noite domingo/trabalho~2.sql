UPDATE DISHES_XML po SET po.OBJECT_VALUE =
updateXML(po.OBJECT_VALUE,
'/xml/item/DISH_NAME/text()', 'Bacalhau com natas a moda do rafa')
WHERE XMLExists('$po2/xml/item[DISH_ID="50"]'PASSING
OBJECT_VALUE AS "po2");

UPDATE DISHES_XML SET OBJECT_VALUE =
updateXML(OBJECT_VALUE, '/xml/item/DISH_NAME/text()',
'Priority Overnight')
WHERE XMLCast(XMLQuery('$p/xml/item/DISH_ID' PASSING OBJECT_VALUE
AS "p" RETURNING CONTENT)AS INTEGER)
= '50';
UPDATE DISHES_XML SET OBJECT_VALUE = updateXML(OBJECT_VALUE, '/xml/item/DISH_NAME/text()', 'Bitoquinho') WHERE XMLCast(XMLQuery('$p/xml/item/DISH_ID' PASSING OBJECT_VALUE AS "p" RETURNING CONTENT)AS INTEGER) = '5';
delete from dishes_xml where XMLCast(XMLQuery('$p/xml/item/DISH_ID' PASSING OBJECT_VALUE AS "p" RETURNING CONTENT)AS INTEGER) = '2';

select * from dishes_xml_view;