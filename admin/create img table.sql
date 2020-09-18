CREATE TABLE images (
    imageID int PRIMARY KEY,
    filename varchar(255) NOT NULL
)

CREATE TABLE img_table_map (
    imageID int PRIMARY KEY,
    articleID int PRIMARY KEY,
    deleteDate datetime
)
SELECT id, title, filename, pubDate, lastPublished FROM blog.articles WHERE deleteDate IS NULL AND id = 1