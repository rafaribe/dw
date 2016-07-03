SELECT t1.RESTAURANT_ID, t2.column_value AS RESTAURANT_OPEN_HOURS
FROM RESTAURANTS t1, TABLE(t1.RESTAURANT_OPEN_HOURS) t2
where RESTAURANT_ID = 20;

select * from restaurants;

alter table comments_restaurant
delete constraint PK_COMMENTS_RESTAURANTS;
INSERT INTO COMMENTS_RESTAURANT VALUES (comments_restaurant_seq.nextval, '2', sysdate, 'ola', '1', '5' )