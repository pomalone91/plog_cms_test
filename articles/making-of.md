## The Making of the Plog CMS
The Plog CMS is coming along nicely. It is at a point where it is performing the most basic functionality that I wanted it to, so this seems like a good time to have a breather and explain how it works and document some of the problems I overcame to get it to work. 

First I want to lay out the framework for how the Plog CMS works. What better way to do so than a shitty UML diagram!

![Shitty UML diagram](images/shit-uml.png)

As you can see there are a few components that make up the Plog CMS and the end points it interacts with...

1. Local articles folder
2. Article upload script (arld)
3. Mac client
4. Get-service
5. Post-service
6. Remote articles database

The list above is roughly the order that I flow through things during the process of creating and posting a new blog entry. Plan on seeing more detailed breakdowns of each component, but here's a rundown of how the whole system works right now.

### Local Articles Folder and arld
I write the article in Markdown in either [Ulysses][ul] or [Coteditor][ct]. I save the Markdown file in a local mirror of the `articles` directory on the server. I then run `arld` from the Terminal on my Mac. This is just a batch script that invokes the built in `sftp` command to push every article to the remote `articles` folder. I plan on re-writing this in Swift so it can pinpoint articles and images to upload instead of re-uploading all of them and overwriting everything on the server. For the time being though, this will have to work.

### Mac Client
The Mac client of the Plog CMS is in charge of two things.

1. Displaying all remote and local articles.
2. Allowing you to upload new local articles to the server.

Now that I have the other aspects of the CMS more locked down, the Mac client will be where I focus most of my attention. I plan on integrating the `arld` in some incarnation so that the Mac client can be my one stop shop for managing all of the articles in the Plog. I'd also like it to show me the local and remote versions of articles side-by-side with the difs for them so I can compare what changes have been uploaded and what haven't. 

Here is the Mac client in action. You may notice the only way to distinguish between local and remote files is that articles that haven't been uploaded yet won't have a value in the ID field. I'd eventually like to have colors indicating what is and isn't uploaded.
![Mac client](images/mac-client.png)

### Get and Post Services
These are the real meat and potatoes of the whole CMS. The Get-Service allows the Mac client (and anyone else who wants to really) to get article meta-data from the articles database. The Swift protocol I wrote to handle this has a default implementation that simply gets the raw data from the [get-service page][gs] as JSON and then passes that to another protocol function that parses it for use in the SplitView of the Mac client. 

Get-Service was _really_ easy to write. The post service was much more complicated, since it needs to allow for the insertion of new article meta-data into the articles database. Post-Service is set up to accept JSON, so the Article struct conforms to the Swift protocol `Codable`. This makes it dead simple to encode a struct or class in Swift to JSON. The actual act of posting the article to Post-Service is handled via a URLRequest and URLSessions. This was probably the biggest pain to debug since there are three possible points of failure: bugs in the Swift networking code, bugs in the PHP receiving the post request and bugs in the SQL used to insert the new data. There will absolutely be an in-depth article on this process, if not one for each of the three aspects of it.

### The Database
The end result of the CMS is a Markdown file in the remote articles directory, and a new entry in the articles table in the SQL database on the server. A lot of things plug into this database:

1. home.php and archive.php use this database to determine what articles to show.
2. article.php uses metadata from this database to populate the title (and eventually the publication and updated date).
3. get-service.php uses it to get JSON of undeleted articles in the database.
4. post-service.php uses it to insert new articles to be rendered by home.php, archive.php and article.php.

## Maiden Voyage
I've written this run-down immediately after finishing up the Post-Service, so this article will be the first I ever upload using just `arld` and the Mac client. Stay tuned for some simple Swift and PHP guides based on the obstacles I encountered making this. 

[ul]: https://ulysses.app
[ct]: https://coteditor.com
[gs]: https://paulmalone.blog/get-service.php