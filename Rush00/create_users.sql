INSERT INTO clients (prenom, nom, login, password, email, date_naissance, adresse, ville, code_postal, pays) 
VALUE ('Audrey', 'Lamy', 'alamy', 'audrey', 'alamy@student.42.fr', '1991-06-30', '26 rue de la paix', 'colombes', '92700', 'france');


INSERT INTO produits (id_produit, nom, description, prix, id_categorie, img_produit) VALUE 
(1, 'Harry potter', 'Apprenti sorcier', '5', '0', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg'),
(2, 'Le Petit Prince', 'Apprenti prince', '5', '0', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg'),
(3, 'Tintin', 'Apprenti aventurier', '8', '0', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg'),
(4, 'Naruto', 'Ninja', '5', '1', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg'),
(5, 'Dragon ball', 'Guerrier', '5', '1', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg'),
(6, 'One piece', 'Pirate', '5', '1', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg'),
(7, 'Candide', 'Candide la petite', '4', '2', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg'),
(8, 'Antigone', 'Antigone le polygone', '3', '2', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg'),
(9, 'Sans famille', 'Pas de famille', '2', '2', 'https://images-na.ssl-images-amazon.com/images/I/71cismcCmGL.jpg');

INSERT INTO categories (id_categorie, nom) VALUE
(1, 'Enfant'),
(2, 'Manga'),
(3, 'Classique');