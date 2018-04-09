SELECT UCASE(user_card.last_name) AS 'NAME', `first_name`, subscription.price 
FROM `member` 
INNER JOIN `user_card` ON member.id_user_card = user_card.id_user 
INNER JOIN `subscription` ON member.id_sub = subscription.id_sub
WHERE `price` > 42 
ORDER BY `last_name`, `first_name` ASC;