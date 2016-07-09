-- DROP TYPES
drop type address_type force;
/
drop type comment_restaurant_type force;
/
drop type comments_type force;
/
drop type email_list_type force;
/
drop type open_hours_type force;
/
drop type phone_list_type force;
/
drop type users_type force;
/
drop type restaurants_type force;
/
drop type menus_type force;
/
drop type prices_type force;
/
drop type dishes_type force;
/
drop type dishes_prices_type force;
/
-- DROP TABLES

DROP TABLE DISHES_XML;
/

DROP TABLE DISHES_PRICES;
/

DROP TABLE COMMENTS_RESTAURANT;
/
DROP TABLE DISHES;
/
DROP TABLE PRICES;
/
DROP TABLE MENUS;
/
DROP TABLE RESTAURANTS;
/
DROP TABLE COMMENTS;
/
DROP TABLE USERS;
/

-- DROP SEQUENCES
DROP SEQUENCE USERS_SEQ;
/
DROP SEQUENCE RESTAURANTS_SEQ;
/
DROP SEQUENCE MENUS_SEQ;
/
DROP SEQUENCE PRICES_SEQ;
/
DROP SEQUENCE DISHES_SEQ;
/
DROP SEQUENCE COMMENTS_RESTAURANT_SEQ;
/
DROP SEQUENCE DISHES_XML_SEQ;
/

-- DROP Procedures


-- Create Types --

create or replace type address_Type as OBJECT(
country VARCHAR(50),
city VARCHAR(50),
address VARCHAR(100),
postal_code VARCHAR(8)
);
/

create or replace type phone_list_type as VARRAY(3) of varchar(30);
/
create or replace type Email_list_type as VARRAY(3) of varchar(30);
/
create or replace type open_hours_type as table of VARCHAR(5);
/
create or replace type COMMENTS_TYPE AS OBJECT
(
   COMMENT_ID           INT,
   USER_ID              INTEGER,
   COMMENT_CREATION_DATE DATE,
   COMMENT_TEXT         VARCHAR(4000)
   )NOT FINAL ;
/
create or replace type COMMENT_RESTAURANT_TYPE UNDER COMMENTS_TYPE(
   RESTAURANT_ID        INTEGER,
   RESTAURANT_RATING    INTEGER
   ) NOT FINAL;
/
create or replace type users_type as object
(
   USER_ID              INT ,
   USER_NAME            VARCHAR2(20) ,
   USER_PASSWORD        VARCHAR2(200) ,
   USER_CREATIONDATE    DATE  ,
   USER_EMAIL           Email_list_type,
   USER_PHONE           phone_list_type
);
/
create or replace type restaurants_type as object (
   RESTAURANT_ID        INT,
   RESTAURANT_NAME      VARCHAR2(200),
   RESTAURANT_ADDRESS   VARCHAR2(200),
   RESTAURANT_OPEN_HOURS open_hours_type,
   RESTAURANT_RESERVATIONS smallint,
   RESTAURANT_WIFI      smallint,
   RESTAURANT_DELIVERY  smallint,
   RESTAURANT_MULTIBANCO smallint,
   RESTAURANT_OUTDOOR_SEATING smallint,
   RESTAURANT_POINTS    FLOAT,
   RESTAURANT_IMAGE NVARCHAR2(200) ,
   RESTAURANT_LATITUDE VARCHAR2(20),
   RESTAURANT_LONGITUDE VARCHAR2(20)
);
/

create or replace type MENUS_TYPE as object(
MENU_ID              INT,
RESTAURANT_ID        INTEGER,
MENU_NAME            VARCHAR2(200)
);

/
create or replace type PRICES_TYPE AS OBJECT
(
   PRICE_ID INT,
   MENU_ID INT,
   PRICE_VALUE          NUMBER(8,2)
);
/
create or replace type DISHES_TYPE as object
(
   DISH_ID              INT,
   DISH_NAME            VARCHAR2(200),
   DISH_TYPE            VARCHAR2(200),
   DISH_IMAGE NVARCHAR2(200)
);
/
create or replace type dishes_prices_type as object(
DISH_ID              INTEGER,
PRICE_ID             INTEGER
);
/
-- Create Tables --


-- USERS --
CREATE SEQUENCE users_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;

Create table users of users_type;

ALTER TABLE USERS
MODIFY (USER_ID DEFAULT USERS_SEQ.NEXTVAL );

ALTER TABLE USERS
MODIFY (USER_CREATIONDATE DEFAULT sysdate );

ALTER TABLE USERS
ADD CONSTRAINT PK_USERS PRIMARY KEY (USER_ID);

-- CREATE RESTAURANTS
CREATE SEQUENCE restaurants_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;

create table RESTAURANTS of RESTAURANTS_TYPE
    NESTED TABLE RESTAURANT_OPEN_HOURS STORE AS OPEN_HOURS;
/
ALTER TABLE RESTAURANTS
MODIFY (RESTAURANT_ID DEFAULT RESTAURANTS_SEQ.NEXTVAL);
/
ALTER TABLE RESTAURANTS
MODIFY (RESTAURANT_POINTS DEFAULT '3' );
/
ALTER TABLE RESTAURANTS
MODIFY (RESTAURANT_IMAGE DEFAULT 'placeholder.jpg' );
/
ALTER TABLE RESTAURANTS
ADD CONSTRAINT PK_RESTAURANTS PRIMARY KEY (RESTAURANT_ID);
/
create table COMMENTS OF COMMENTS_TYPE;
/

-- create menus
CREATE SEQUENCE menus_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;

create table MENUS of menus_type;

ALTER TABLE MENUS
MODIFY (MENU_ID DEFAULT MENUS_SEQ.NEXTVAL );
/
ALTER TABLE MENUS
ADD  constraint PK_MENUS primary key (MENU_ID);
/
ALTER TABLE MENUS
ADD constraint FK_RESTAURANT_MENUS foreign key (RESTAURANT_ID) REFERENCES RESTAURANTS(RESTAURANT_ID);
/

-- prices
CREATE SEQUENCE prices_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;

create table PRICES of prices_type;
/
ALTER TABLE PRICES
MODIFY (PRICE_ID DEFAULT PRICES_SEQ.NEXTVAL );
/
alter table prices
add   constraint PK_PRICES primary key (PRICE_ID);
/
alter table prices
add   constraint FK_MENUS foreign key (MENU_ID) REFERENCES MENUS(MENU_ID);
/
-- dishes

CREATE SEQUENCE dishes_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;
/
create table dishes of dishes_type;
/
ALTER TABLE DISHES
MODIFY (DISH_ID DEFAULT DISHES_SEQ.NEXTVAL );
/
alter table DISHES
add   constraint PK_DISHES primary key (DISH_ID);
/

-- comments_restaurant
CREATE SEQUENCE comments_restaurant_seq
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;
/

create table comments_restaurant of COMMENT_RESTAURANT_TYPE;
/
ALTER TABLE COMMENTS_RESTAURANT
MODIFY (COMMENT_ID DEFAULT COMMENTS_RESTAURANT_SEQ.NEXTVAL );
/
alter table COMMENTS_RESTAURANT
modify (COMMENT_CREATION_DATE default sysdate);
/
create table DISHES_PRICES OF DISHES_PRICES_TYPE;
/
ALTER TABLE DISHES_PRICES
ADD constraint PK_DISHES_PRICES primary key (DISH_ID, PRICE_ID);
/
ALTER TABLE DISHES_PRICES
ADD  constraint FK_DISHES_DISH foreign key (DISH_ID) REFERENCES DISHES(DISH_ID);
/
ALTER TABLE DISHES_PRICES
ADD constraint FK_DISHES_PRICE foreign key (PRICE_ID) REFERENCES PRICES(PRICE_ID);
/

-- INSERTS --
--INSERTS COMMENTS--

INSERT INTO Comments (comment_id,user_id, COMMENT_CREATION_DATE, comment_text)
values(
'1',
'1',
sysdate,
' Este restaurante recomenda-se, pois tem um optimo funcionamento e a qualidade e muito boa'
);
INSERT INTO Comments_restaurant
values(
'1',
'1',
sysdate,
' Este restaurante recomenda-se, pois tem um optimo funcionamento e a qualidade e muito boa',
'15',
'3,5'
);

--INSERTS RESTAURANTS--
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS, RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Tia Iva',
'Viseu',
open_hours_type('10:00','22:00'),
'1',
'1',
'0',
'1',
'1',
'5',
'tia_iva.jpg',
'40.656700',
'-7.915568'
);
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'O Tosco',
'Vila Cha de Sa',
open_hours_type('12:00','23:00'),
'1',
'0',
'0',
'1',
'1',
'3',
'tosco.jpg',
'40.6600778',
'-7.9127714'
);
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Casa Arouquesa',
'Repeses',
open_hours_type('12:00','00:00'),
'1',
'0',
'0',
'1',
'1',
'5',
'casa_arouquesa.jpg',
'40.6121032',
'-7.9511443'
);
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Maionese',
'Jugueiros',
open_hours_type('11:00','23:00'),
'1',
'0',
'0',
'0',
'1',
'4',
'maionese.jpg',
'40.6382983',
'-7.9300961');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Churrasqueira Santa Eulalia',
'Repeses',
open_hours_type('09:00','23:00'),
'0',
'0',
'1',
'0',
'1',
'3',
'churrasqueria.jpg',
'40.6462259',
'-7.920701');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Vintage',
'Rossio',
open_hours_type('09:00','23:00'),
'1',
'1',
'1',
'1',
'1',
'5',
'vintage.jpg',
'40.642002',
'-7.9268327');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'O Cortico',
'Viseu',
open_hours_type('13:00','23:00'),
'1',
'1',
'0',
'1',
'0',
'5',
'cortico.jpg',
'40.659125',
'7.9134872');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Cantinho do Tito',
'Viseu',
open_hours_type('13:00','00:00'),
'1',
'1',
'1',
'1',
'1',
'5',
'cantinho_tito.jpg',
'40.672276',
'-7.9037807');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Budega',
'Viseu',
open_hours_type('19:00','00:00'),
'1',
'1',
'1',
'0',
'0',
'4',
'budega.jpg',
'40.66217',
'-7.9115861');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'CasaBlanca',
'Viseu',
open_hours_type('12:00','22:00'),
'1',
'1',
'1',
'0',
'0',
'3',
'casablanca.jpg',
'40.656575',
'-7.9088937');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'CB House',
'Viseu',
open_hours_type('12:00','02:00'),
'0',
'1',
'1',
'0',
'0',
'3',
'cb.jpg',
'40.6977016',
'-7.91345');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Forno da Mimi',
'Viseu',
open_hours_type('12:00','00:00'),
'1',
'1',
'1',
'1',
'1',
'5',
'forno_mimi.jpg',
'40.5594641',
'-7.9529667');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'O Martelo',
'Viseu',
open_hours_type('13:00','23:00'),
'0',
'0',
'0',
'0',
'1',
'2',
'martelo.jpg',
'40.659196',
'-7.9192967');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
 'Porta da Se',
'Viseu',
open_hours_type('11:00','01:00'),
'0',
'1',
'1',
'1',
'1',
'3',
'portase.png',
'40.6977016',
'-7.91345');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Cervejaria Cacimbo',
'Viseu',
open_hours_type('10:00','22:00'),
'0',
'0',
'1',
'0',
'1',
'4',
'cacimbo.jpg',
'40.653393',
'-7.9160527');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'McDonalds',
'Viseu',
open_hours_type('9:00','3:00'),
'0',
'0',
'1',
'1',
'1',
'3',
'mac.jpg',
'40.6462727',
'-7.9194923');
INSERT INTO Restaurants (RESTAURANT_NAME,RESTAURANT_ADDRESS ,RESTAURANT_OPEN_HOURS,RESTAURANT_RESERVATIONS,RESTAURANT_WIFI,
RESTAURANT_DELIVERY,RESTAURANT_MULTIBANCO,RESTAURANT_OUTDOOR_SEATING,RESTAURANT_POINTS,RESTAURANT_IMAGE, RESTAURANT_LATITUDE, RESTAURANT_LONGITUDE)
values(
'Solar do Verde Gaio',
'Viseu',
open_hours_type('09:00','00:00'),
'1',
'0',
'1',
'1',
'1',
'5',
'verd.jpg',
'40.6463406',
'-7.9501345');

--INSERTS Menus--
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'1',
'Menu Tia Iva'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'2',
'Menu Tosco'
);

INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'3',
'Menu Arouqueza'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'4',
'Menu Maionese'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'5',
'Menu Churrasqueira'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'6',
'Menu Vintage'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'7',
'Menu Cortico'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'8',
'Menu Tito'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'9',
'Menu Budega'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'10',
'Menu Casa'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'11',
'Menu CB'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'12',
'Menu Forno'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'13',
'Menu Martelo'
);

INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'14',
'Menu Porta'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'15',
'Menu Cacimbo'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'16',
'Menu Mac'
);
INSERT INTO Menus (RESTAURANT_ID, MENU_NAME)
values(
'17',
'Menu Verde'
);
--INSERTS PRICES--
insert into Prices (menu_id,price_value)
values('1','20');
insert into Prices (menu_id,price_value)
values('2','15');
insert into Prices (menu_id,price_value)
values('3','25');
insert into Prices (menu_id,price_value)
values('4','10');
insert into Prices (menu_id,price_value)
values('5','20');
insert into Prices (menu_id,price_value)
values('6','9,50');
insert into Prices (menu_id,price_value)
values('7','30');
insert into Prices (menu_id,price_value)
values('8','15');
insert into Prices (menu_id,price_value)
values('9','20');
insert into Prices (menu_id,price_value)
values('10','35');
insert into Prices (menu_id,price_value)
values('11','6');
insert into Prices (menu_id,price_value)
values('12','35');
insert into Prices (menu_id,price_value)
values('13','15');
insert into Prices (menu_id,price_value)
values('14','8');
insert into Prices (menu_id,price_value)
values('15','15');
insert into Prices (menu_id,price_value)
values('16','7');
insert into Prices (menu_id,price_value)
values('17','40');
--insert dish
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Bacalhau a Bras',
'Peixe',
'bacalhau_bras.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Cozido a Potuguesa',
'Carne',
'cozido.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Sardinha Assada com Batata Cozida e Pimentos',
'Peixe',
'sardinha.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Creme de Legumes',
'Sopa',
'creme_legumes.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Bitoque',
'Carne',
'bitoque.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'CheeseCake',
'Sobremesa',
'chesse.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Caldo Verde',
'Sopa',
'caldo_verde.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Mousse de Chocolate',
'Sobremesa',
'mousse.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Pao e Azeitonas',
'Entrada',
'azeitonas.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Vinho Tinto',
'Bebida',
'tinto.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Tabuleiro de Queijos',
'Entrada',
'queijos.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Vinho Branco',
'Bebida',
'branco.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Agua',
'Bebida',
'agua.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Sumo de Laranja',
'Bebida',
'sumo.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Cafe',
'Bebida',
'cafe.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Morangos',
'Fruta',
'morango.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Hambuger com carne e salada',
'Fast-Food',
'fast.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Francesinha',
'Fast-Food',
'francesinha.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Grelhada Mista',
'Carne',
'mista.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Martini',
'Aperitivo',
'drink.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Banana',
'Fruta',
'banana.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Salada Mista',
'Salada',
'salada_mista.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Salada de Fruta',
'Sobremesa',
'salada_fruta.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Cafe com Maceira',
'Bebida',
'bagacu.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Salada de Alface',
'Salada',
'alface.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Salada de Cenoura',
'Salada',
'cenoura.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Salada de Tomate',
'Salada',
'tomate.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Salada de Tomate e Alface',
'Salada',
'al_to.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Salada de Pepino',
'Salada',
'pepino.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Bola de Gelado',
'Sobremesa',
'gelado.png'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Carbonara',
'Carne',
'carbonara.jpg'
);

INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Peixe com batata cozida',
'Peixe',
'ovo.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Legumes Saltiados',
'Vegetariano',
'legumes.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Legumes Cozidos',
'Vegetariano',
'leg_cozidos.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Feijoada',
'Carne',
'feijoada.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Rancho',
'Carne',
'rancho.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Bacalhau a Gomes de Sa',
'Peixe',
'bacalhau_gomes.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Bacalhau com Broa',
'Peixe',
'bacalhau_broa.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Salmao Grelhado com batata cozida',
'Peixe',
'salmao.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Maca',
'Fruta',
'maca.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Laranja',
'Fruta',
'laranja.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Vinho do Porto',
'Aperitivo',
'orto.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Favaios',
'Aperitivo',
'favaios.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Ricard',
'Aperitivo',
'ricard.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Canja',
'Sopa',
'canja.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Sopa da Pedra',
'Sopa',
'pedra.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Pate',
'Entrada',
'pate.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Camarao',
'Entrada',
'camarao.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Pizza',
'Fast-Food',
'pizza.jpg'
);
INSERT INTO Dishes (DISH_NAME,DISH_TYPE,DISH_IMAGE)
values(
'Cachorro',
'Fast-Food',
'cachorro.jpg'
);

--INSERTS DISH_PRICES--
insert into Dishes_Prices (Dish_id, price_id)
values ('1','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('1','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('1','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('1','13');
insert into Dishes_Prices (Dish_id, price_id)
values ('2','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('2','8');
insert into Dishes_Prices (Dish_id, price_id)
values ('2','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('2','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('3','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('3','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('3','15');
insert into Dishes_Prices (Dish_id, price_id)
values ('3','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('4','11');
insert into Dishes_Prices (Dish_id, price_id)
values ('4','14');
insert into Dishes_Prices (Dish_id, price_id)
values ('4','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('4','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('5','5');
insert into Dishes_Prices (Dish_id, price_id)
values ('5','8');
insert into Dishes_Prices (Dish_id, price_id)
values ('5','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('5','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('6','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('6','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('6','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('6','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('7','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('7','11');
insert into Dishes_Prices (Dish_id, price_id)
values ('7','15');
insert into Dishes_Prices (Dish_id, price_id)
values ('8','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('8','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('8','11');
insert into Dishes_Prices (Dish_id, price_id)
values ('9','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('9','5');
insert into Dishes_Prices (Dish_id,price_id)
values ('9','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('10','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('10','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('10','14');
insert into Dishes_Prices (Dish_id, price_id)
values ('10','16');
insert into Dishes_Prices (Dish_id, price_id)
values ('11','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('11','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('11','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('12','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('12','1');
insert into Dishes_Prices (Dish_id,price_id)
values ('12','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('13','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('13','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('13','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('14','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('14','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('14','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('14','8');
insert into Dishes_Prices (Dish_id, price_id)
values ('15','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('15','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('15','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('15','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('15','15');
insert into Dishes_Prices (Dish_id, price_id)
values ('16','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('16','8');
insert into Dishes_Prices (Dish_id, price_id)
values ('16','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('16','16');
insert into Dishes_Prices (Dish_id, price_id)
values ('17','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('17','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('17','5');
insert into Dishes_Prices (Dish_id, price_id)
values ('18','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('18','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('18','7');
insert into Dishes_Prices (Dish_id, price_id)
values ('18','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('19','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('19','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('19','15');
insert into Dishes_Prices (Dish_id, price_id)
values ('20','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('20','16');
insert into Dishes_Prices (Dish_id, price_id)
values ('20','15');
insert into Dishes_Prices (Dish_id, price_id)
values ('20','14');
insert into Dishes_Prices (Dish_id, price_id)
values ('21','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('21','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('22','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('22','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('22','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('22','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('23','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('23','7');
insert into Dishes_Prices (Dish_id, price_id)
values ('23','8');
insert into Dishes_Prices (Dish_id, price_id)
values ('23','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('23','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('24','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('24','11');
insert into Dishes_Prices (Dish_id, price_id)
values ('24','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('25','8');
insert into Dishes_Prices (Dish_id, price_id)
values ('25','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('25','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('25','11');
insert into Dishes_Prices (Dish_id, price_id)
values ('25','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('26','15');
insert into Dishes_Prices (Dish_id, price_id)
values ('26','16');
insert into Dishes_Prices (Dish_id, price_id)
values ('26','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('27','16');
insert into Dishes_Prices (Dish_id, price_id)
values ('27','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('28','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('28','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('28','5');
insert into Dishes_Prices (Dish_id, price_id)
values ('29','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('29','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('29','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('29','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('29','7');
insert into Dishes_Prices (Dish_id, price_id)
values ('30','8');
insert into Dishes_Prices (Dish_id, price_id)
values ('30','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('30','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('30','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('31','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('31','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('31','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('31','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('32','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('32','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('33','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('33','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('33','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('33','13');
insert into Dishes_Prices (Dish_id, price_id)
values ('34','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('34','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('34','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('35','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('35','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('35','15');
insert into Dishes_Prices (Dish_id, price_id)
values ('36','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('36','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('36','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('37','4');
insert into Dishes_Prices (Dish_id, price_id)
values ('37','5');
insert into Dishes_Prices (Dish_id, price_id)
values ('37','8');
insert into Dishes_Prices (Dish_id, price_id)
values ('37','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('38','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('38','11');
insert into Dishes_Prices (Dish_id, price_id)
values ('39','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('39','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('39','17');
insert into Dishes_Prices (Dish_id, price_id)
values ('40','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('40','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('40','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('41','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('41','2');
insert into Dishes_Prices (Dish_id, price_id)
values ('42','3');
insert into Dishes_Prices (Dish_id, price_id)
values ('42','6');
insert into Dishes_Prices (Dish_id, price_id)
values ('42','9');
insert into Dishes_Prices (Dish_id, price_id)
values ('43','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('43','11');
insert into Dishes_Prices (Dish_id, price_id)
values ('43','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('43','13');
insert into Dishes_Prices (Dish_id, price_id)
values ('44','1');
insert into Dishes_Prices (Dish_id, price_id)
values ('44','10');
insert into Dishes_Prices (Dish_id, price_id)
values ('45','12');
insert into Dishes_Prices (Dish_id, price_id)
values ('45','13');
insert into Dishes_Prices (Dish_id,price_id)
values ('46','2');

INSERT INTO USERS (USER_NAME,USER_PASSWORD,USER_CREATIONDATE,USER_EMAIL,USER_PHONE)
values(
'Filipa',
'81dc9bdb52d04dc20036dbd8313ed055',
sysdate,
Email_list_type('claudiaftrigo@hotmail.com'),
phone_list_type('935136801'));
INSERT INTO USERS (USER_NAME,USER_PASSWORD,USER_CREATIONDATE,USER_EMAIL,USER_PHONE)
values(
'Rafael',
'81dc9bdb52d04dc20036dbd8313ed055',
sysdate,
Email_list_type('rafael.ntw@gmail.com','rafael.fsk@live.com.pt'),
phone_list_type('935136300'));

-- XML

-- Tabela para receber valores XML
create table DISHES_XML
 of xmltype
xmlschema "XML_SCHEMA1"
Element "xml";
/
-- sequencia para incrementar o ID
create sequence DISHES_XML_SEQ
 START WITH     1
 INCREMENT BY   1
 NOCACHE
 NOCYCLE;
 /

-- Procedimento para inserir todos os dishes em formato XML, na tabela DISHES_XML
/*
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
END;
/*/

-- View com o  QUERY que vai buscar dados xml à tabela e coloca em colunas normais

CREATE OR REPLACE VIEW DISHES_XML_VIEW AS
  SELECT po.*
    FROM DISHES_XML pur,
         XMLTable(
           '$p/xml/item' PASSING pur.OBJECT_VALUE as "p"
           COLUMNS
          "DISH_ID"    INT  PATH 'DISH_ID',
           "DISH_NAME"    VARCHAR2(200) PATH 'DISH_NAME',
           "DISH_TYPE"    VARCHAR2(200) PATH 'DISH_TYPE',
           "DISH_IMAGE" VARCHAR2(4000) PATH 'DISH_IMAGE') po
           ORDER BY DISH_ID;
/

insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>1</DISH_ID>
        <DISH_NAME>Bacalhau a Bras</DISH_NAME>
        <DISH_TYPE>Peixe</DISH_TYPE>
        <DISH_IMAGE>bacalhau_bras.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>2</DISH_ID>
        <DISH_NAME>Cozido a Potuguesa</DISH_NAME>
        <DISH_TYPE>Carne</DISH_TYPE>
        <DISH_IMAGE>cozido.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>3</DISH_ID>
        <DISH_NAME>Sardinha Assada com Batata Cozida e Pimentos</DISH_NAME>
        <DISH_TYPE>Peixe</DISH_TYPE>
        <DISH_IMAGE>sardinha.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>4</DISH_ID>
        <DISH_NAME>Creme de Legumes</DISH_NAME>
        <DISH_TYPE>Sopa</DISH_TYPE>
        <DISH_IMAGE>creme_legumes.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>5</DISH_ID>
        <DISH_NAME>Bitoque</DISH_NAME>
        <DISH_TYPE>Carne</DISH_TYPE>
        <DISH_IMAGE>bitoque.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>6</DISH_ID>
        <DISH_NAME>CheeseCake</DISH_NAME>
        <DISH_TYPE>Sobremesa</DISH_TYPE>
        <DISH_IMAGE>chesse.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>7</DISH_ID>
        <DISH_NAME>Caldo Verde</DISH_NAME>
        <DISH_TYPE>Sopa</DISH_TYPE>
        <DISH_IMAGE>caldo_verde.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>8</DISH_ID>
        <DISH_NAME>Mousse de Chocolate</DISH_NAME>
        <DISH_TYPE>Sobremesa</DISH_TYPE>
        <DISH_IMAGE>mousse.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>9</DISH_ID>
        <DISH_NAME>Pao e Azeitonas</DISH_NAME>
        <DISH_TYPE>Entrada</DISH_TYPE>
        <DISH_IMAGE>azeitonas.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>10</DISH_ID>
        <DISH_NAME>Vinho Tinto</DISH_NAME>
        <DISH_TYPE>Bebida</DISH_TYPE>
        <DISH_IMAGE>tinto.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>11</DISH_ID>
        <DISH_NAME>Tabuleiro de Queijos</DISH_NAME>
        <DISH_TYPE>Entrada</DISH_TYPE>
        <DISH_IMAGE>queijos.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>12</DISH_ID>
        <DISH_NAME>Vinho Branco</DISH_NAME>
        <DISH_TYPE>Bebida</DISH_TYPE>
        <DISH_IMAGE>branco.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>13</DISH_ID>
        <DISH_NAME>Agua</DISH_NAME>
        <DISH_TYPE>Bebida</DISH_TYPE>
        <DISH_IMAGE>agua.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>14</DISH_ID>
        <DISH_NAME>Sumo de Laranja</DISH_NAME>
        <DISH_TYPE>Bebida</DISH_TYPE>
        <DISH_IMAGE>sumo.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>15</DISH_ID>
        <DISH_NAME>Cafe</DISH_NAME>
        <DISH_TYPE>Bebida</DISH_TYPE>
        <DISH_IMAGE>cafe.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>16</DISH_ID>
        <DISH_NAME>Morangos</DISH_NAME>
        <DISH_TYPE>Fruta</DISH_TYPE>
        <DISH_IMAGE>morango.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>17</DISH_ID>
        <DISH_NAME>Hambuger com carne e salada</DISH_NAME>
        <DISH_TYPE>Fast-Food</DISH_TYPE>
        <DISH_IMAGE>fast.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>18</DISH_ID>
        <DISH_NAME>Francesinha</DISH_NAME>
        <DISH_TYPE>Fast-Food</DISH_TYPE>
        <DISH_IMAGE>francesinha.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>19</DISH_ID>
        <DISH_NAME>Grelhada Mista</DISH_NAME>
        <DISH_TYPE>Carne</DISH_TYPE>
        <DISH_IMAGE>mista.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>20</DISH_ID>
        <DISH_NAME>Martini</DISH_NAME>
        <DISH_TYPE>Aperitivo</DISH_TYPE>
        <DISH_IMAGE>drink.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>21</DISH_ID>
        <DISH_NAME>Banana</DISH_NAME>
        <DISH_TYPE>Fruta</DISH_TYPE>
        <DISH_IMAGE>banana.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>22</DISH_ID>
        <DISH_NAME>Salada Mista</DISH_NAME>
        <DISH_TYPE>Salada</DISH_TYPE>
        <DISH_IMAGE>salada_mista.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>23</DISH_ID>
        <DISH_NAME>Salada de Fruta</DISH_NAME>
        <DISH_TYPE>Sobremesa</DISH_TYPE>
        <DISH_IMAGE>salada_fruta.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>24</DISH_ID>
        <DISH_NAME>Cafe com Maceira</DISH_NAME>
        <DISH_TYPE>Bebida</DISH_TYPE>
        <DISH_IMAGE>bagacu.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>25</DISH_ID>
        <DISH_NAME>Salada de Alface</DISH_NAME>
        <DISH_TYPE>Salada</DISH_TYPE>
        <DISH_IMAGE>alface.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>26</DISH_ID>
        <DISH_NAME>Salada de Cenoura</DISH_NAME>
        <DISH_TYPE>Salada</DISH_TYPE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>27</DISH_ID>
        <DISH_NAME>Salada de Tomate</DISH_NAME>
        <DISH_TYPE>Salada</DISH_TYPE>
        <DISH_IMAGE>tomate.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>28</DISH_ID>
        <DISH_NAME>Salada de Tomate e Alface</DISH_NAME>
        <DISH_TYPE>Salada</DISH_TYPE>
        <DISH_IMAGE>al_to.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>29</DISH_ID>
        <DISH_NAME>Salada de Pepino</DISH_NAME>
        <DISH_TYPE>Salada</DISH_TYPE>
        <DISH_IMAGE>pepino.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>30</DISH_ID>
        <DISH_NAME>Bola de Gelado</DISH_NAME>
        <DISH_TYPE>Sobremesa</DISH_TYPE>
        <DISH_IMAGE>gelado.png</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml>
<item>
        <DISH_ID>31</DISH_ID>
        <DISH_NAME>Carbonara</DISH_NAME>
        <DISH_TYPE>Carne</DISH_TYPE>
        <DISH_IMAGE>carbonara.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>32</DISH_ID>
        <DISH_NAME>Peixe com batata cozida</DISH_NAME>
        <DISH_TYPE>Peixe</DISH_TYPE>
        <DISH_IMAGE>ovo.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>33</DISH_ID>
        <DISH_NAME>Legumes Saltiados</DISH_NAME>
        <DISH_TYPE>Vegetariano</DISH_TYPE>
        <DISH_IMAGE>legumes.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>34</DISH_ID>
        <DISH_NAME>Legumes Cozidos</DISH_NAME>
        <DISH_TYPE>Vegetariano</DISH_TYPE>
        <DISH_IMAGE>leg_cozidos.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>35</DISH_ID>
        <DISH_NAME>Feijoada</DISH_NAME>
        <DISH_TYPE>Carne</DISH_TYPE>
        <DISH_IMAGE>feijoada.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>36</DISH_ID>
        <DISH_NAME>Rancho</DISH_NAME>
        <DISH_TYPE>Carne</DISH_TYPE>
        <DISH_IMAGE>rancho.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>37</DISH_ID>
        <DISH_NAME>Bacalhau a Gomes de Sa</DISH_NAME>
        <DISH_TYPE>Peixe</DISH_TYPE>
        <DISH_IMAGE>bacalhau_gomes.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>38</DISH_ID>
        <DISH_NAME>Bacalhau com Broa</DISH_NAME>
        <DISH_TYPE>Peixe</DISH_TYPE>
        <DISH_IMAGE>bacalhau_broa.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>39</DISH_ID>
        <DISH_NAME>Salmao Grelhado com batata cozida</DISH_NAME>
        <DISH_TYPE>Peixe</DISH_TYPE>
        <DISH_IMAGE>salmao.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>40</DISH_ID>
        <DISH_NAME>Maca</DISH_NAME>
        <DISH_TYPE>Fruta</DISH_TYPE>
        <DISH_IMAGE>maca.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>41</DISH_ID>
        <DISH_NAME>Laranja</DISH_NAME>
        <DISH_TYPE>Fruta</DISH_TYPE>
        <DISH_IMAGE>laranja.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>42</DISH_ID>
        <DISH_NAME>Vinho do Porto</DISH_NAME>
        <DISH_TYPE>Aperitivo</DISH_TYPE>
        <DISH_IMAGE>orto.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>43</DISH_ID>
        <DISH_NAME>Favaios</DISH_NAME>
        <DISH_TYPE>Aperitivo</DISH_TYPE>
        <DISH_IMAGE>favaios.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>44</DISH_ID>
        <DISH_NAME>Ricard</DISH_NAME>
        <DISH_TYPE>Aperitivo</DISH_TYPE>
        <DISH_IMAGE>ricard.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>45</DISH_ID>
        <DISH_NAME>Canja</DISH_NAME>
        <DISH_TYPE>Sopa</DISH_TYPE>
        <DISH_IMAGE>canja.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>46</DISH_ID>
        <DISH_NAME>Sopa da Pedra</DISH_NAME>
        <DISH_TYPE>Sopa</DISH_TYPE>
        <DISH_IMAGE>pedra.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>47</DISH_ID>
        <DISH_NAME>Pate</DISH_NAME>
        <DISH_TYPE>Entrada</DISH_TYPE>
        <DISH_IMAGE>pate.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>48</DISH_ID>
        <DISH_NAME>Camarao</DISH_NAME>
        <DISH_TYPE>Entrada</DISH_TYPE>
        <DISH_IMAGE>camarao.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>49</DISH_ID>
        <DISH_NAME>Pizza</DISH_NAME>
        <DISH_TYPE>Fast-Food</DISH_TYPE>
        <DISH_IMAGE>pizza.jpg</DISH_IMAGE>
</item></xml>' ));
insert into DISHES_XML
 values(
xmltype(
'<xml><item>
        <DISH_ID>50</DISH_ID>
        <DISH_NAME>Cachorro</DISH_NAME>
        <DISH_TYPE>Fast-Food</DISH_TYPE>
        <DISH_IMAGE>cachorro.jpg</DISH_IMAGE>
</item></xml>' ));
/
-- Procedimentos Armazenados
/* VERSAO COM CONCATENACAO
CREATE OR REPLACE PROCEDURE insert_xml_proc (
dish_name IN VARCHAR2,
dish_type IN VARCHAR2,
dish_image IN VARCHAR2 ) AS
BEGIN
INSERT INTO DISHES_XML
 (XML_DATA) values(
xmltype(
'<xml>
<item>
    <DISH_ID>'||DISHES_XML
_SEQ.NEXTVAL||'</DISH_ID>
    <DISH_NAME>'||dish_name||'</DISH_NAME>
    <DISH_TYPE>'||dish_type||'</DISH_TYPE>
    <DISH_IMAGE>'||dish_image||'</DISH_IMAGE>
</item></xml>' ));
INSERT INTO DISHES VALUES(DISHES_SEQ.NEXTVAL,dish_name,dish_type,dish_image);
END;*/

create or replace PROCEDURE insert_xml_proc (
dish_name IN VARCHAR,
dish_type IN VARCHAR,
dish_image IN VARCHAR ) AS
BEGIN
INSERT INTO DISHES_XML
 values (
xmlelement("xml",
   xmlelement("item",
      xmlelement("DISH_ID", DISHES_XML_SEQ.nextVAL),
      xmlelement("DISH_NAME", dish_name),
      xmlelement("DISH_TYPE", dish_type),
      xmlelement("DISH_IMAGE", dish_image)
   )
)
);
End;
