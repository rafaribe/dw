create or replace trigger Score
after insert,update or delete OF restaurant_rating on comments_restaurant
declare average number;
declare oldrating number;
begin
if(:novo.divisa='EUR' and :antigo.divisa='PTE') then
:novo.sal:=ROUND (:novo.sal/200.482,2)
ELSEIF(:novo.divisa='PTE' and :antigo.divisa='EUR') then
:novosal:=novo.sal=200.48;
End if;
oldrating = SELECT RESTAURANT_RATING FROM RESTAURANTS WHERE RESTAURANT_ID = new.RESTAURANT_ID;
average = SELECT AVG(RESTAURANT_RATING) FROM RESTAURANTS WHERE RESTAURANT_ID = new.RESTAURANT_ID;

UPDATE RESTAURANTS SET RESTAURANT_RATING = 
end;