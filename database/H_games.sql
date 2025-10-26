DROP DATABASE IF EXISTS H_Games; 
CREATE DATABASE H_Games; 
USE H_Games;

CREATE TABLE Usuarios(
id_user INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
nombre_user VARCHAR(30) NOT NULL, 
email_user VARCHAR(100) NOT NULL UNIQUE, 
pass_user VARCHAR(255) NOT NULL, 
admin_user BOOLEAN DEFAULT FALSE
);

CREATE TABLE Games(
id_game INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
nombre_game VARCHAR (100) NOT NULL UNIQUE, 
img_game_url TEXT, 
precio_game DECIMAL (10,2) NOT NULL
);

INSERT INTO Games(nombre_game, img_game_url, precio_game) VALUES ('Halo', 'https://media.vandal.net/i/1280x720/10-2023/17/20231017163114_4.jpg.webp', '500');
INSERT INTO Games(nombre_game, img_game_url, precio_game) VALUES ('Hades 2', 'https://media.vandal.net/m/131658/hades-ii-2022129237726_7.jpg', '500');
INSERT INTO Games(nombre_game, img_game_url, precio_game) VALUES ('Pragmata', 'https://vandal.elespanol.com/juegos/ps5/pragmata/86449#imagen1', '500');



CREATE TABLE User_Games(
id_user_fk INT UNSIGNED NOT NULL, 
id_game_fk INT UNSIGNED NOT NULL,
PRIMARY KEY(id_user_fk, id_game_fk),
FOREIGN KEY (id_user_fk) REFERENCES Usuarios(id_user),
FOREIGN KEY (id_game_fk) REFERENCES Games(id_game) 
);

USE H_Games;
SELECT * FROM Usuarios;
SELECT * FROM Games; 
SELECT * FROM User_Games;

DELETE FROM Usuarios WHERE id_user= 5; 