-- database: ../test.sqlite
-- Note: Do not delete the line above! It is helpful for testing your init.sql file.
--
-- TODO: entries, tags, and entry_tags table schemas
-- TODO: seed data

CREATE TABLE art (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  title TEXT NOT NULL,
  descr TEXT NOT NULL,
  yr INTEGER NOT NULL,
  file_path TEXT NOT NULL
);

-- SEED DATA INTO ART
-- Digital Art Source: (original work) Nicole Lin, Shihan Gao
INSERT INTO art (title, descr, yr, file_path) VALUES ('Vines', 'Painting of a woman wrapped in vines', 2019, '1.png');

INSERT INTO art (title, descr, yr, file_path) VALUES('Rainy', 'Painting of two figures hiding from the rain', 2024, '2.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Girls', 'Painting of two angels', 2019, '3.jpg');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Dogs', 'Painting of two robot dogs', 2020, '4.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Desert', 'Landscape of two foxes in a desert', 2022, '5.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Loss', 'Painting of a broken relationship between a man and his wife', 2023, '6.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Wolf', 'Painting of little red riding hood and the wolf', 2022, '7.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Mouse', 'Painting of a brave mouse', 2021, '8.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Deer', 'Portrait of a deer person', 2021, '9.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Kingdom', 'Landscape of two kingdoms', 2021, '10.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('King and Rabbit', 'Digital artwork of king and his rabbit, BonBon', 2020, '11.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Just Some Guy', 'Drawing of a video game guy', 2020, '12.jpg');

INSERT INTO art (title, descr, yr, file_path) VALUES('Flower Sword', 'Painting of a graceful swordsman with a flower sword', 2020, '13.png');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Brave Griffindor', 'Drawing of the Griffindor Lion wearing their house scarf', 2020, '14.jpg');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Wise Ravenclaw', 'Drawing of the Wise Ravenclaw wearing their house scarf', 2020, '15.jpg');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Sleepy Slytherin', 'Drawing of the Sleepy Slytherin wearing their house scarf', 2020, '16.jpg');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Kind Hufflepuffs', 'Drawing of the Kind Hufflepuff wearing their house scarf', 2020, '17.jpg');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Eclipse Lake', 'Sketch of a battle between a golden knight and a golden child', 2020, '18.jpg');

INSERT INTO art (title, descr, yr, file_path) VALUES('Prove Your Worth', 'Sketch of the Golden Guard', 2020, '19.jpg');

INSERT INTO art (title, descr, yr, file_path) VALUES ('Percy Jackson', 'Sketch of a popular book character', 2020, '20.jpg');

CREATE TABLE tags (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
);

INSERT INTO tags(name) VALUES
('Landscape');
INSERT INTO tags(name) VALUES
('Portrait');
INSERT INTO tags(name) VALUES
('Nonhuman');
INSERT INTO tags(name) VALUES
('Human');
INSERT INTO tags(name) VALUES
('Painting');
INSERT INTO tags(name) VALUES
('Digital');
INSERT INTO tags(name) VALUES
('Traditional');
INSERT INTO tags(name) VALUES
('Sketch');
INSERT INTO tags(name) VALUES
('Rendered');
INSERT INTO tags(name) VALUES
('Fanart');

CREATE TABLE art_tags (
  id INTEGER NOT NULL UNIQUE,
  art_id INTEGER NOT NULL,
  tags_id INTEGER NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT),
  FOREIGN KEY(art_id) REFERENCES art(id),
  FOREIGN KEY(tags_id) REFERENCES tags(id)
);

INSERT INTO art_tags (art_id, tags_id) VALUES (1, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (1, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (1, 6);

INSERT INTO art_tags (art_id, tags_id) VALUES (2, 1);
INSERT INTO art_tags (art_id, tags_id) VALUES (2, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (2, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (2, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (2, 9);
INSERT INTO art_tags (art_id, tags_id) VALUES (2, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (3, 1);
INSERT INTO art_tags (art_id, tags_id) VALUES (3, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (3, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (3, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (3, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (4, 1);
INSERT INTO art_tags (art_id, tags_id) VALUES (4, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (4, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (4, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (4, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (5, 1);
INSERT INTO art_tags (art_id, tags_id) VALUES (5, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (5, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (5, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (5, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (6, 1);
INSERT INTO art_tags (art_id, tags_id) VALUES (6, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (6, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (6, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (6, 9);
INSERT INTO art_tags (art_id, tags_id) VALUES (6, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (7, 1);
INSERT INTO art_tags (art_id, tags_id) VALUES (7, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (7, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (8, 1);
INSERT INTO art_tags (art_id, tags_id) VALUES (8, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (8, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (8, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (8, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (8, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (9, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (9, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (9, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (9, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (9, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (9, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (10, 1);
INSERT INTO art_tags (art_id, tags_id) VALUES (10, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (10, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (10, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (10, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (11, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (11, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (11, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (11, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (11, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (12, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (12, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (12, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (12, 9);
INSERT INTO art_tags (art_id, tags_id) VALUES (12, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (13, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (13, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (13, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (13, 5);
INSERT INTO art_tags (art_id, tags_id) VALUES (13, 9);

INSERT INTO art_tags (art_id, tags_id) VALUES (14, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (14, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (14, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (14, 9);
INSERT INTO art_tags (art_id, tags_id) VALUES (14, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (15, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (15, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (15, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (15, 9);
INSERT INTO art_tags (art_id, tags_id) VALUES (15, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (16, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (16, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (16, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (16, 9);
INSERT INTO art_tags (art_id, tags_id) VALUES (16, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (17, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (17, 3);
INSERT INTO art_tags (art_id, tags_id) VALUES (17, 6);
INSERT INTO art_tags (art_id, tags_id) VALUES (17, 9);
INSERT INTO art_tags (art_id, tags_id) VALUES (17, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (18, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (18, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (18, 7);
INSERT INTO art_tags (art_id, tags_id) VALUES (18, 8);
INSERT INTO art_tags (art_id, tags_id) VALUES (18, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (19, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (19, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (19, 7);
INSERT INTO art_tags (art_id, tags_id) VALUES (19, 8);
INSERT INTO art_tags (art_id, tags_id) VALUES (19, 10);

INSERT INTO art_tags (art_id, tags_id) VALUES (20, 2);
INSERT INTO art_tags (art_id, tags_id) VALUES (20, 4);
INSERT INTO art_tags (art_id, tags_id) VALUES (20, 7);
INSERT INTO art_tags (art_id, tags_id) VALUES (20, 8);
INSERT INTO art_tags (art_id, tags_id) VALUES (20, 10);


CREATE TABLE users (
  id INTEGER NOT NULL UNIQUE,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO
  users (id, username, password)
VALUES
  (
    1,
    'admin',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'
  );

CREATE TABLE sessions (
  id INTEGER NOT NULL UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY(user_id) REFERENCES users(id)
);
