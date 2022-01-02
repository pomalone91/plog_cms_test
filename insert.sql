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

-- Insert into views table
INSERT INTO blog.views (articleId, viewedAt, view_year, view_month, view_day, view_quarter, view_time)
VALUES 
    (NULL, '2022-01-01 10:56:36', 2022, 01, 01, 1, '10:56:36')
    ,(1, '2022-01-01 10:56:36', 2022, 01, 01, 1, '10:56:36');
    
-- Insert new "articles" for static pages so I can track their views easier.
-- home 18, 105
-- about 19, 106
-- projects 20, 107
-- resume 21, 108
INSERT INTO blog.articles (pubDate, title, summary, filename, deleteDate)
VALUES 
    (CURRENT_DATE(), 'Home', '', '', NULL)
    ,(CURRENT_DATE(), 'About', '', 'main/about.md', NULL)
    ,(CURRENT_DATE(), 'Projects', '', 'main/projects.md', NULL)
    ,(CURRENT_DATE(), 'Resume', '', 'main/resume.md', NULL)
    
-- How many site visits do I get each year?
-- Site visits defined here as visits to the home page
SELECT 
    v.view_year
    ,COUNT(*) - 1 AS 'count'
FROM blog.articles a
    LEFT JOIN blog.views v ON a.id = v.articleId
WHERE a.title = "Home"
GROUP BY v.view_year
ORDER BY v.view_year DESC;

    
-- Query to get article views by ranks
SELECT 
    a.title
    ,COUNT(*) - 1 AS 'count'
    ,a.pubDate AS 'published'
    ,a.lastPublished AS 'revised'
FROM blog.articles a
    LEFT JOIN blog.views v ON a.id = v.articleId
WHERE a.deleteDate IS NULL
GROUP BY a.title, a.pubDate, a.lastPublished
ORDER BY COUNT(*) DESC, a.pubDate DESC;
