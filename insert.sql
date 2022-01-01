INSERT INTO blog.articles (pubDate, title, summary, filename, deleteDate)
VALUES (CURRENT_DATE(), 'Test Article 3', 'Test Article Summary 3', 'articles/carthage-tutorial.md', NULL);

-- Get top 5 articles for home page.
SELECT title, summary, pubDate
FROM blog.articles
ORDER BY pubDate DESC LIMIT 5;

-- Delete an article
UPDATE blog.articles
SET deleteDate = CURRENT_DATE()
WHERE id IN (2)

-- Update filename
UPDATE blog.articles
SET filename = "articles/skaven-schemes.md"
WHERE id IN (9)

-- Reset passwords
UPDATE user SET authentication_string = PASSWORD('plog90'), password_last_changed = NULL
WHERE user.Host = 'localhost' AND user.User = 'root';

INSERT INTO blog.users (username, password, addedAt) VALUES ('admin', '5810027b75b1281dbdea90b4e4ff60fa', CURRENT_DATE());

-- Create view table
CREATE TABLE blog.views (
    viewId              INT AUTO_INCREMENT
    ,articleId          INT
    ,viewedAt           DATETIME
    ,view_year          INT
    ,view_month         INT
    ,view_day           INT
    ,view_quarter       VARCHAR(2)
    ,view_time          TIME
    ,PRIMARY KEY (viewId)
    ,FOREIGN KEY (articleId) REFERENCES articles(id)
);
