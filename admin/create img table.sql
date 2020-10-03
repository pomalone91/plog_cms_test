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