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