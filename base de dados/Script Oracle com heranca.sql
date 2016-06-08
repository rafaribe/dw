-- Create Types --

create or replace type address_Type as OBJECT(
country VARCHAR(50),
city VARCHAR(50),
address VARCHAR(100),
postal_code VARCHAR(8)
);

create or replace type phone_list_type as VARRAY(3) of varchar(30);
/
create or replace type Email_list_type as VARRAY(3) of varchar(30);
/
create or replace type coordinates_type as OBJECT(
latitude varchar(20),
longitude varchar(20));
/
create or replace type open_hours_type as table of VARCHAR(5);
/
create or replace type COMMENTS_TYPE AS OBJECT
(
   COMMENT_ID           INT,
   USER_ID              INTEGER,
   COMMENT_CREATION_DATE DATE,
   COMMENT_TEXT         CLOB
)NOT FINAL ;
/

create or replace type COMMENT_RESTAURANT_TYPE UNDER COMMENTS_TYPE(
   RESTAURANT_ID        INTEGER,
   RESTAURANT_RATING    INTEGER,
   RESTAURANT_REVIEW_TYPE VARCHAR2(25)
   ) NOT FINAL;
/


create or replace type COMMENT_DISH_TYPE UNDER COMMENTS_TYPE(
   DISH_ID        INTEGER,
   DISH_RATING    INTEGER
   ) NOT FINAL;
/  
-- Create Tables --

create table USERS
(
   USER_ID              INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
   USER_NAME            VARCHAR2(20)         not null,
   USER_PASSWORD        VARCHAR2(200)        not null,
   USER_CREATIONDATE    DATE                 default sysdate,
   USER_EMAIL           Email_list_type,
   USER_PHONE           phone_list_type,
   constraint PK_USERS primary key (USER_ID)
);
create table RESTAURANTS
(
   RESTAURANT_ID        INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
   RESTAURANT_NAME      VARCHAR2(200)        not null,
   RESTAURANT_ADDRESS   VARCHAR2(200),
   RESTAURANT_COORDS   coordinates_type,
   RESTAURANT_OPEN_HOURS open_hours_type,
   RESTAURANT_RESERVATIONS smallint,
   RESTAURANT_WIFI      smallint,
   RESTAURANT_DELIVERY  smallint,
   RESTAURANT_MULTIBANCO smallint,
   RESTAURANT_OUTDOOR_SEATING smallint,
   RESTAURANT_POINTS    FLOAT default '3',
   RESTAURANT_IMAGE NVARCHAR2(200) default 'placeholder.jpg',
   constraint PK_RESTAURANT primary key (RESTAURANT_ID))
   NESTED TABLE RESTAURANT_OPEN_HOURS STORE AS OPEN_HOURS_NESTED;

create table COMMENTS OF COMMENTS_TYPE;

create table MENUS
(
   MENU_ID              INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
   RESTAURANT_ID        INTEGER              not null,
   MENU_NAME            VARCHAR2(200),
   constraint PK_MENUS primary key (MENU_ID),
   constraint FK_RESTAURANT_MENUS foreign key (RESTAURANT_ID) REFERENCES RESTAURANTS(RESTAURANT_ID)
);

create table PRICES
(
   PRICE_ID             INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
   PRICE_VALUE          NUMBER(8,2)          not null,
   constraint PK_PRICES primary key (PRICE_ID)
);

create table DISHES
(
   DISH_ID              INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
   DISH_NAME            VARCHAR2(200)        not null,
   DISH_TYPE            VARCHAR2(200)        not null,
   DISH_IMAGE NVARCHAR2(200),
   constraint PK_DISHES primary key (DISH_ID)
);

create table DISHES_MENUS
(
   DISH_ID              INTEGER              not null,
   MENU_ID              INTEGER              not null,
   constraint PK_DISHES_MENUS primary key (DISH_ID, MENU_ID),
   constraint FK_DISHES_MENUS_DISHES foreign key (DISH_ID) REFERENCES DISHES(DISH_ID),
   constraint FK_DISHES_MENUS_MENUS foreign key (MENU_ID) REFERENCES MENUS(MENU_ID)
);

CREATE TABLE COMMENTS_RESTAURANT OF COMMENT_RESTAURANT_TYPE (COMMENT_ID SCOPE is COMMENTS);

CREATE TABLE COMMENTS_DISH OF COMMENT_DISH_TYPE (COMMENT_ID SCOPE is COMMENTS);

create table DISHES_PRICES
(
   DISH_ID              INTEGER              not null,
   PRICE_ID             INTEGER              not null,
   constraint PK_DISHES_PRICES primary key (DISH_ID, PRICE_ID),
   constraint FK_DISHES_DISH foreign key (DISH_ID) REFERENCES DISHES(DISH_ID),
   constraint FK_DISHES_PRICE foreign key (PRICE_ID) REFERENCES PRICES(PRICE_ID)
);
create table COORDS
(
   COORDS_ID              INT GENERATED BY DEFAULT ON NULL AS IDENTITY,
   RESTAURANT_ID        INTEGER              not null,
   LATITUDE            VARCHAR2(200),
   LONGITUDE           VARCHAR2(200),
   constraint PK_COORDS primary key (COORDS_ID),
   constraint FK_COORDS_RESTAURANT foreign key (RESTAURANT_ID) REFERENCES RESTAURANTS(RESTAURANT_ID)
);


DROP TABLE DISHES_PRICES;
DROP TABLE COMMENTS_DISH;
DROP TABLE COMMENTS_RESTAURANT;
DROP TABLE DISHES_MENUS;
DROP TABLE DISHES;
DROP TABLE PRICES;
DROP TABLE MENUS;
DROP TABLE COORDS;
DROP TABLE RESTAURANTS;
DROP TABLE COMMENTS;
DROP TABLE USERS;
