-- 1.1
create table ex1_purchase_order of xmltype
(constraint ex1_purchase_order_pk primary key (order_number))
xmltype store as securefile binary xml
virtual columns
(order_number as (xmlcast(xmlquery('/PurchaseOrder/OrderNumber'
passing object_value returning content) as number (5)))
,order_date as (xmlcast(xmlquery('/PurchaseOrder/OrderDate' passing
object_value returning content) as date)))
partition by range (order_date)
(partition yr_2011 values less than
(to_date('01/01/2012','mm/dd/yyyy'))
,partition yr_2012 values less than
(to_date('01/01/2013','mm/dd/yyyy')));
/
--1.2
create view ex1_po_relac_view as
select m.order_number, m.order_date, m.customer_name, m.userid,
m.special_instructions, d.*
from ex1_purchase_order po,
xmltable('/PurchaseOrder' passing po.object_value
columns
order_number number(5) path 'OrderNumber',
order_date date path 'OrderDate',
customer_name varchar2(30) path 'CustomerName',
userid varchar2(10) path 'User',
special_instructions varchar2(80) path 'SpecialInstructions',
lineitem xmltype path 'LineItems/LineItem') m,
xmltable('LineItem' passing m.lineitem
columns
itemno number(10) path '@ItemNumber',
description varchar2(25) path 'Description',
partno varchar2(14) path 'Part/@Id',
quantity number(12,2) path 'Part/@Quantity',
unitprice number(8,4) path 'Part/@UnitPrice') d;
/
-- 1.3

insert into ex1_purchase_order values
(xmltype(
'<?xml version="1.0"?>
<PurchaseOrder>
<OrderNumber>10000</OrderNumber>
<OrderDate>2012-08-20</OrderDate>
<CustomerName>Julie P. Adams</CustomerName>
<User>SCOTT</User>
<SpecialInstructions>Ground</SpecialInstructions>
<LineItems>
<LineItem ItemNumber="1">
<Description>Diabolique One</Description>
<Part Id="1234" UnitPrice="19,95" Quantity="2"/>
</LineItem>
<LineItem ItemNumber="2">
<Description>The Ruling Class</Description>
<Part Id="0374" UnitPrice="15,95" Quantity="2"/>
</LineItem>
</LineItems>
</PurchaseOrder>' ));
/
-- 1.4

select order_number ,order_date ,customer_name ,description ,partno
,quantity ,unitprice from ex1_po_relac_view
where customer_name = 'Julie P. Adams';
/
--1.5

UPDATE ex1_purchase_order po SET po.OBJECT_VALUE =
updateXML(po.OBJECT_VALUE,
'/PurchaseOrder/SpecialInstructions/text()', 'Priority Overnight')
WHERE XMLExists('$po2/PurchaseOrder[OrderNumber="10000"]'PASSING
OBJECT_VALUE AS "po2");
/
-- Uso de coluna virtual
UPDATE ex1_purchase_order SET OBJECT_VALUE =
updateXML(OBJECT_VALUE, '/PurchaseOrder/SpecialInstructions/text()',
'Priority Overnight')
WHERE Order_Number=10000;
/
--1.6
delete from ex1_purchase_order where order_number = 10000;
/
--1.7

create table ex1_po_master_table (order_number number(5) primary key
,order_date date
,customer_name varchar2(30)
,userid varchar2(10)
,special_instructions varchar2(80));
/
insert into ex1_po_master_table values('1', '2016-07-07', 'Manel', '1','Nao mexer');
/
insert into ex1_po_master_table values('2', '2016-07-07', 'Jaquim', '2','Nao comer');
/
insert into ex1_po_master_table values('3', '2016-07-07', 'Maria', '3','Nao apalpar');
/
insert into ex1_po_master_table values('4', '2016-07-07', 'Jaquina', '4','Nao olhar, fere os olhos');
/
create table ex1_lineitem_table (order_number number(5)
,foreign key (order_number)
references ex1_po_master_table (order_number) on delete cascade
,itemno number(10)
,primary key (order_number, itemno)
,description varchar2(25)
,partno varchar2(14)
,unitprice number(8,4)
,quantity number(12,2));
/

Insert into ex1_lineitem_table values ('1','1','Descricao1','1','10','2');
/
Insert into ex1_lineitem_table values ('2','2','Descricao1','1','10','2');
/
Insert into ex1_lineitem_table values ('3','3','Descricao1','1','10','2');
/
Insert into ex1_lineitem_table values ('4','4','Descricao1','1','10','2');
/
--1.8
create or replace view ex1_po_relac_to_xml_view of XMLType
with OBJECT ID (XMLCast(XMLQuery('/PurchaseOrder/OrderNumber' Passing
OBJECT_VALUE Returning Content) as BINARY_DOUBLE)) as
Select XMLElement( "PurchaseOrder"
,XMLForest(po.order_number as "OrderNumber"
,po.order_date as "OrderDate"
,po.customer_name as "CustomerName"
,po.userid as "User"
,po.special_instructions as "SpecialInstructions" )
,XMLElement( "LineItems"
,(SELECT XMLAgg(XMLElement( "LineItem"
,XMLAttributes( li.itemno as "ItemNumber")
,XMLElement( "Description", li.description)
,XMLElement( "Part"
,XMLAttributes(li.partno as "Id"
,li.unitprice as "UnitPrice"
,li.quantity as "Quantity" ))))
from ex1_lineitem_table li
where li.order_number = po.order_number))) as "POXML"
from ex1_po_master_table po;
/

-- 1.9
select OBJECT_VALUE as "Purchase Order" from ex1_po_relac_to_xml_view;

select XMLSerialize(Content OBJECT_VALUE as CLOB indent) as "Purchase
Order"
from ex1_po_relac_to_xml_view;

-- 2.1

create table purchaseorder of xmltype;

INSERT INTO purchaseorder values(
xmltype(
'<?xml version="1.0"?>
<PurchaseOrder 
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xsi:noNamespaceSchemaLocation="http://www.oracle.com/xdb/po.xsd">
  <Reference>ADAMS-20011127121040988PST</Reference>
  <Actions>
    <Action>
      <User>SCOTT</User>
      <Date xsi:nil="true"/>
    </Action>
  </Actions>
  <Reject/>
  <Requestor>Julie P. Adams</Requestor>
  <User>ADAMS</User>
  <CostCenter>R20</CostCenter>
  <ShippingInstructions>
    <name>Julie P. Adams</name>
    <address>300 Oracle Parkway, Redwood Shores, CA 94065</address>
    <telephone>650 506 7300</telephone>
  </ShippingInstructions>
  <SpecialInstructions>Ground</SpecialInstructions>
  <LineItems>
    <LineItem ItemNumber="1">
      <Description>The Ruling Class</Description>
      <Part Id="715515012423" UnitPrice="39.95" Quantity="2"/>
    </LineItem>
    <LineItem ItemNumber="2">
      <Description>Diabolique</Description>
      <Part Id="037429135020" UnitPrice="29.95" Quantity="3"/>
    </LineItem>
    <LineItem ItemNumber="3">
      <Description>8 1/2</Description>
      <Part Id="037429135624" UnitPrice="39.95" Quantity="4"/>
    </LineItem>
  </LineItems>
</PurchaseOrder>' ));
/

Create table employees (
employee_id number primary key,
email varchar2(200));
/
insert into employees values ('100','Adams');
/
--2.2

select OBJECT_VALUE as "Purchase Order" from purchaseorder;
/
-- 2.3
select XMLQUERY('/PurchaseOrder/Reference' PASSING OBJECT_VALUE RETURNING CONTENT) FROM PURCHASEORDER;
/
--2.4
select XMLQUERY('/PurchaseOrder/LineItems/LineItem[2]' PASSING OBJECT_VALUE RETURNING CONTENT) FROM PURCHASEORDER;
/
--2.5

SELECT XMLCAST(XMLQUERY('$P/PurchaseOrder/Reference'PASSING OBJECT_VALUE as P RETURNING CONTENT )AS VARCHAR2(100)) FROM PURCHASEORDER;
/
--2.6

SELECT count(*) AS "Existencia" FROM purchaseorder
WHERE XMLExists('$p/PurchaseOrder/Reference'
PASSING OBJECT_VALUE AS "p");

/

--2.7
------a)
SELECT count(*) FROM purchaseorder
WHERE XMLExists('$p/PurchaseOrder/LineItems/LineItem/Part/@Id'
PASSING OBJECT_VALUE AS "p");

-- Esta query permite verificar se existem Lineitems com <Part Id> e devolve um mal o encontre.

------ b)
SELECT XMLCast(XMLQuery('$p/PurchaseOrder/Reference' PASSING
OBJECT_VALUE AS "p"
RETURNING CONTENT)AS VARCHAR2(30))FROM purchaseorder
WHERE XMLCast(XMLQuery('$p/PurchaseOrder/User' PASSING OBJECT_VALUE
AS "p"
RETURNING CONTENT)AS VARCHAR2(30))LIKE 'A%';

-- Esta query devolve o valor do Reference, e faz um XMLCAST para Varchar2(30), se alterarmos o comprimento do varchar, ele apenas devolve o resultado com 
-- a string com o respectivo numero de caracteres. O conteúdo do Reference tem de começar por A, tendo quaisquers caracteres a seguir.

------- c)

SELECT XMLCast(XMLQuery('$p/PurchaseOrder/Reference' PASSING
OBJECT_VALUE AS "p" RETURNING CONTENT) AS VARCHAR2(30))
FROM purchaseorder p, employees e
WHERE XMLCast(XMLQuery('$p/PurchaseOrder/User' PASSING
OBJECT_VALUE AS "p"
RETURNING CONTENT)
AS VARCHAR2(30)) = e.email AND e.employee_id = 100;

-- Esta tabela faz a relação entre a tabela XML purchaseorder e a tabela relacional employees, comparando o elemento XML '$p/PurchaseOrder/User'
-- e a tabela relacional employees.

--2.8

SELECT des.COLUMN_VALUE
FROM purchaseorder p,
XMLTable('/PurchaseOrder/LineItems/LineItem/Description'
PASSING p.OBJECT_VALUE) des
WHERE XMLExists('$p/PurchaseOrder[Reference="ADAMS-20011127121040988PST"]'
PASSING OBJECT_VALUE AS "p");

-- A funcionalidade de XML Table é de mapear a 