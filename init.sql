CREATE TABLE "user"(
"id"               SERIAL   PRIMARY KEY,
"login"            TEXT     NOT NULL UNIQUE,
"password"         TEXT     NOT NULL,
"role"             SMALLINT NOT NULL CHECK ("role" IN (1, 2, 3))
);

CREATE TABLE "client"(
"id"               INTEGER PRIMARY KEY REFERENCES "user" (id)       ON UPDATE RESTRICT ON DELETE CASCADE,     
"name"             TEXT    NOT NULL
);

CREATE TABLE "manager"(
"id"               INTEGER PRIMARY KEY REFERENCES "user" (id)      ON UPDATE RESTRICT ON DELETE CASCADE,          
"name"             TEXT NOT NULL
);

CREATE TABLE "phone"(
"id"               SERIAL PRIMARY KEY,
"number"           TEXT NOT NULL,
"client_id"        INTEGER NOT NULL REFERENCES "client" (id)  ON UPDATE RESTRICT ON DELETE CASCADE
);

CREATE TABLE "adress"(
"id"               SERIAL PRIMARY KEY,
"adress"           TEXT NOT NULL,
"client_id"         INTEGER NOT NULL REFERENCES "client" (id)  ON UPDATE RESTRICT ON DELETE CASCADE
);

CREATE TABLE "category"(
"id"               SERIAL PRIMARY KEY,
"name"             TEXT NOT NULL
);

CREATE TABLE "product"(
"id"               SERIAL PRIMARY KEY,
"name"             TEXT NOT NULL,
"category_id"      INTEGER NOT NULL REFERENCES "category" (id) ON UPDATE RESTRICT ON DELETE CASCADE,
"cost"             FLOAT NOT NULL,
"description"      TEXT
);

CREATE TABLE "orderr"(
"id"               SERIAL PRIMARY KEY,
"client_id"        INTEGER NOT NULL REFERENCES "client" (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
"manager_id"       INTEGER NOT NULL REFERENCES "manager" (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
"order_cost"       FLOAT NOT NULL,
"adress_id"        INTEGER NOT NULL REFERENCES "adress" (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
"date"             DATE NOT NULL,
"status"           TEXT NOT NULL CHECK ("status" IN ('new','confirmed by the manager', 'paid', 'transferred to the courier', 'deliverd'))
);

CREATE TABLE "order_element"(
"id"               SERIAL PRIMARY KEY,
"order_id"         INTEGER NOT NULL REFERENCES "orderr" (id) ON UPDATE RESTRICT ON DELETE CASCADE,
"product_id"       INTEGER NOT NULL REFERENCES "product" (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
"number"           INTEGER NOT NULL
);


INSERT INTO "user"
("id", "login"  , "password", "role") VALUES
(  1 , 'root'   , 'root'    ,    1  ),
(  2 , 'manager1'  , 'manager'    ,    2  ),
(  3 , 'manager2'  , 'manager'    ,    2  ),
(  4 , 'client1'  , '12345'    ,    3  ),
(  5 , 'client2', '12345'   ,    3  ),
(  6 , 'client3', '12345'   ,    3  ),
(  7 , 'client4', '12345'   ,    3  ),
(  8 , 'client5', '12345'   ,    3  );
SELECT setval('user_id_seq', 8);

INSERT INTO "manager"
("id", "name") VALUES
(1, 'John Week'),
(2, 'Peter Parker'),
(3, 'Brus Wane');

INSERT INTO "client"
("id", "name") VALUES
(4, 'Василий Пупкин'),
(5, 'Антонина Каштанова'),
(6, 'Екатерина Лучезарная'),
(7, 'Владимир Великий'),
(8, 'Ирман Мухматов');
SELECT setval('user_id_seq', 8);

INSERT INTO "phone"
("id", "number", "client_id") VALUES
(1, '+375 (29) 123-45-67', 4),
(2, '+375 (33) 890-12-34', 4),
(3, '+375 (25) 567-89-01', 5),
(4, '+375 (29) 234-56-78', 7),
(5, '+375 (29) 123-55-99', 8);
SELECT setval('phone_id_seq', 5);

INSERT INTO "adress"
("id", "adress", "client_id") VALUES
(1, 'Витебск, пр-т Московский, 16, кв.22',                    4),
(2, 'Минск, ул. Максима Танка, 22/2, кв. 54',                 5),
(3, 'Минская обл., а-г Нарочь, ул. Центральная, 3',           5),
(4, 'Витебская обл., г. Орша, ул. Советская, 18, кв.22', 	  6),
(5, 'Могилевская обл., г. Бобруйск, ул. Замковая, 21, кв.101',6),
(6, 'Витебск, ул. Воинов Интернацианалистов, 44, кв. 1', 	  7),
(7, 'Казахстан, г. Нур-Султан, ул. Желтоксан, 55, кв. 33',	  8),
(8, 'Витебск, ул. Правды, 17, кв.2', 4),
(9, 'Витебск, ул. Смоленская, 22, кв.3б', 4),
(10, 'Витебск, ул. Актеров Еременко, 41, кв.61,', 7);
SELECT setval('adress_id_seq', 10);

INSERT INTO "category"
("id", "name") VALUES
(1, 'Бытовая химия'),
(2, 'Косметика'),
(3, 'Электроника'),
(4, 'Игрушки'),
(5, 'Одежда');
SELECT setval('category_id_seq', 5);

INSERT INTO "product"
("id", "name", "category_id", "cost", "description") VALUES
(1, 	'Средство для мытья посуды "Капля"', 	1, 1.59,	 	'Лучшее средство для мытья посуды'),
(2, 	'Порошок стиральный "Tide"', 			1, 3.00, 		NULL),
(3, 	'Мыло хозяйственное', 					1, 0.39, 		'Универсальное моющее средство, проверенное годами'),
(4, 	'Тушь',								    2, 2.57, 		'Просто тушь'),
(5, 	'Духи "Шальная Императрица"', 			2, 128.99, 		'Лучше один раз понюхать'),
(6, 	'Мицелярная вода "Nivea"',				2, 3.19, 		NULL),
(7, 	'Кампьютер', 							3, 200.00, 		'Безумно полезная вещь'),
(8, 	'Наушники "AirPods"', 					3, 449, 		'Почувствуй себя мажером'),
(9, 	'Смартфон "Samsung Galaxy S10"', 		3, 779.00, 		NULL),
(10, 	'Плюшевый Смурфик', 					4, 17.56, 		'ровный поц'),
(11, 	'Спиннер', 								4, 7.11, 		NULL),
(12, 	'Lego Mindstorm', 						4, 1347.50, 	'Не рекомендовано детям младше 25'),
(13, 	'Брюки Мужские зауженные', 				5, 40.00, 		'Девушкам это нравится'),
(14, 	'Свитер с оленями', 					5, 55.99, 		'Ручная работа бабушки '),
(15, 	'Перчатки', 							5, 3.01, 		'Завод шерстяных изделий "Бабушкины спицы"');
SELECT setval('product_id_seq', 15);

INSERT INTO "orderr"
("id", "client_id", "manager_id", "order_cost", "adress_id", "date", "status") VALUES
(1, 4, 2, 20, 		1, '20200302', 'new'),
(2, 4, 1, 41.22, 	1, '20200222', 'confirmed by the manager'),
(3, 5, 1, 30.99, 	2, '20200113','paid'),
(4, 6, 2, 22.11,	4, '20191212', 'transferred to the courier'),
(5, 7, 1, 49.56,   	5, '20200305', 'deliverd'),
(6, 4, 3, 32.11, 1, '20200312', 'paid'),
(7, 5, 1, 10, 2, '20190302', 'deliverd'),
(8, 5, 2, 11.01, 3, '20200202', 'new'),
(9, 5, 1, 15, 2, '20190122', 'deliverd'),
(10, 5, 1, 102.99, 3, '20201103', 'paid'),
(11, 5, 2, 22.90, 2, '20180930', 'new'),
(12, 5, 3, 9.31, 3, '20190228', 'confirmed by the manager'),
(13, 5, 2, 51, 2, '20200101', 'confirmed by the manager'),
(14, 5, 2, 62.03, 2, '20200206', 'deliverd'),
(15, 5, 2, 33.33, 3, '20200131', 'transferred to the courier'),
(16, 5, 1, 23, 2, '20190726', 'transferred to the courier'),
(17, 5, 2, 22.90, 2, '20180930', 'new'),
(18, 5, 3, 9.31, 3, '20190228', 'confirmed by the manager'),
(19, 5, 2, 51, 2, '20200101', 'confirmed by the manager'),
(20, 5, 2, 62.03, 2, '20200206', 'deliverd'),
(21, 5, 2, 33.33, 3, '20200131', 'transferred to the courier'),
(22, 5, 1, 23, 2, '20190726', 'transferred to the courier');
SELECT setval('orderr_id_seq', 22);


INSERT INTO "order_element"
 ("id", "order_id", "product_id", "number")VALUES
(1, 	1, 	1, 	2),
(2, 	1, 	4, 	2),
(3, 	1, 	7, 	1),
(4, 	2, 	2, 	1),
(5, 	2, 	10, 1),
(6, 	2, 	15, 1),
(7, 	3, 	3, 	10),
(8, 	3, 	14, 1),
(9, 	3, 	5, 	2),
(10, 	4, 	12, 1),
(11, 	4, 	13, 1),
(12, 	4, 	10, 2),
(13, 	5, 	7, 	1),
(14, 	5, 	8, 	1),
(15, 	5, 	3, 	2);
SELECT setval('order_element_id_seq', 15);