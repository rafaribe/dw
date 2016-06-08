
INSERT INTO Comments (comment_id,user_id, COMMENT_CREATION_DATE, comment_text)
values(
'1',
'1',
sysdate,
' Este restaurante recomenda-se, pois tem um optimo funcionamento e a qualidade e muito boa'
);

INSERT INTO Comments_Dish
values(
'1',
'1',
sysdate,
' Este restaurante recomenda-se, pois tem um optimo funcionamento e a qualidade e muito boa',
'15',
'3,5'
);
INSERT INTO Comments_restaurant
values(
'1',
'1',
sysdate, 
' Este restaurante recomenda-se, pois tem um optimo funcionamento e a qualidade e muito boa',
'15',
'3,5',
'familia'
);