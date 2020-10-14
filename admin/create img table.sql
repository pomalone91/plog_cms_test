SELECT views FROM static_views WHERE description LIKE 'home';
CREATE TABLE static_views (
    id int PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(255),
    views INT DEFAULT 0 NOT NULL
);

INSERT INTO static_views (description) VALUE ('home');
INSERT INTO static_views (description) VALUE ('about');
INSERT INTO static_views (description) VALUE('projects');

UPDATE blog.articles SET views = $views WHERE id = $id

ALTER TABLE articles 
ADD views INT NOT NULL 
DEFAULT 0

CREATE TABLE images (
    imageID int PRIMARY KEY AUTO_INCREMENT,
    articleID int,
    filename varchar(255) NOT NULL,
    createdAt datetime NOT NULL,
    deleteDate datetime
);

CREATE TABLE img_table_map (
    imageID int PRIMARY KEY,
    articleID int PRIMARY KEY,
    deleteDate datetime
)
SELECT id, title, filename, pubDate, lastPublished FROM blog.articles WHERE deleteDate IS NULL AND id = 1

INSERT INTO blog.images (articleID, filename, createdAt) VALUE (?, ?, CURRENT_DATE())
INSERT INTO blog.images (articleID, filename) VALUE (?, ?)

INSERT INTO blog.articles (pubDate, title, summary, filename) VALUE (CURRENT_DATE(), ?, ?, ?)

ALTER TABLE blog.images AUTO_INCREMENT;