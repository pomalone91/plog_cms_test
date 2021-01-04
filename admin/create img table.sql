SELECT views FROM static_views WHERE description LIKE 'home';
CREATE TABLE static_views (
    id int PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(255),
    views INT DEFAULT 0 NOT NULL
);

INSERT INTO static_views (description) VALUE ('home');
INSERT INTO static_views (description) VALUE ('about');
INSERT INTO static_views (description) VALUE('projects');
INSERT INTO static_views (description) VALUE('resume');

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


ALTER TABLE blog.images
DROP PRIMARY KEY,
CHANGE imageID imageID int(11);

ALTER TABLE blog.images
ADD PRIMARY KEY (imageID, filename);

ALTER TABLE blog.images MODIFY imageID INTEGER NOT NULL AUTO_INCREMENT;

/*Manually adding image mappings*/
INSERT INTO blog.images (articleID, filename, createdAt) VALUES 
    (75, 'arld_script-location.png', CURRENT_DATE()),
    (10, 'terminal_folder_open.png', CURRENT_DATE()),
    (10, 'carthage_at_work.png', CURRENT_DATE()),
    (10, 'framework.png', CURRENT_DATE()),
    (10, 'xcode-navigation.png', CURRENT_DATE()),
    (10, 'embedding_framework.png', CURRENT_DATE()),
    (96, 'croll-release.png', CURRENT_DATE()),
    (42, 'shit-uml.png', CURRENT_DATE()),
    (42, 'mac-client.png', CURRENT_DATE()),
    (43, 'sftp-prompt.png', CURRENT_DATE()),
    (9, 'skaven_front.jpeg', CURRENT_DATE()),
    (9, 'skaven_side.jpeg', CURRENT_DATE()),
    (9, 'skaven_rear.jpeg', CURRENT_DATE());