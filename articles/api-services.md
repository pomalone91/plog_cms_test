## API Services
This post will explain some of the set up behind the [get-service]() and post-service that make up the API for the Plog CMS. The get-service is public facing, the post-service is not. I will explain their use, functionality and get into a little bit of code. But first, a little explanation on APIs.

### PHP Server APIs
You might be familiar with the term API, but if not: API stands for Application Programming Interface. In layman's terms, an API allows you to hook your code up to someone else's framework or service. APIs go hand in hand with the concept of encapsulation in object-oriented programming. The idea of a black-box function that just takes input and returns output is essentially a very granular API. More broad examples might include using someone else's framework in Swift. The public API for that framework includes the public functions that you can call to make use of it. You don't need to know how all of the public functions work, or what private helper functions might also be getting called. You just need the _interface_ of public functions to program against; the _API_. 

Similarly, having an API for a server is just a way for you to send and receive data from that server. You don't care if the server is running Ubuntu or Debian, or if it's using MySQL or SQLite. All you need to know is where to send your data, and where to receive data from the server. 

### Get-Service
Let's start with receiving data from the server. Here's the UML diagram of roughly how my server is set up.

![UML server diagram](images/shit-uml.png)

You can see at the bottom there are two objects titled "Get-Service" and "Post-Service" with inbound and outbound arrows connecting them to a database of articles and to the Plog CMS client. It is the job of Get-Service to send information from the database of articles to whoever queries it. You can use Get-Service right now. Just click [here][gs] and you'll see a nice JSON representation of the published articles on Plog. This isn't any new information, all of that data is visible in some way on the normal website, but it being in JSON format is pretty cool. Those key-value pairs in the JSON text can be decoded very easily by your JSON parser of choice and all of a sudden you have some pretty useful data.

I'm not going to give you a step-by-step guide on how to create a PHP API, but I will go through the high level concepts of how this works. 

#### The Database
It all starts with a database. The key value pairs in the JSON returned by Get-Service represent the column names and their corresponding values in a MySQL database. Here is some of that JSON below.

    [
        {"id":"43","title":"SFTP From the Command Line","summary":"This is a follow up to this mp post about the making of the content management system (CMS) for Plog. I'll be addressing the components of Plog in roughly the order they were introduced in the Making Of article. Here they are again.\n","pubDate":"2019-04-05 00:00:00","filename":"articles\/sftp-tutorial.md"},
        {"id":"42","title":"The Making of the Plog CMS","summary":"The Plog CMS is coming along nicely. It is at a point where it is performing the most basic functionality that I wanted it to, so this seems like a good time to have a breather and explain how it works and document some of the problems I overcame to get it to work.\n","pubDate":"2019-03-30 00:00:00","filename":"articles\/making-of.md"},
        {"id":"10","title":"Carthage Tutorial","summary":"How to use Carthage","pubDate":"2019-03-21 00:00:00","filename":"articles\/carthage-tutorial.md"},
        {"id":"9","title":"Skaven Schemes","summary":"Test Color Skaven Schemes","pubDate":"2019-03-09 00:00:00","filename":"articles\/skaven-schemes.md"},
        {"id":"8","title":"Delegates","summary":"The delegate pattern in Cocoa","pubDate":"2019-03-04 00:00:00","filename":"articles\/delegates.md"},
        {"id":"3","title":"Hard to Find Mac Tricks","summary":"Hard to find Mac Tricks.","pubDate":"2019-02-08 00:00:00","filename":"articles\/mactricks.md"}
    ]
    
Between each curly bracket is what is essentially a row in the SQL table. The format of JSON is that of a dictionary, a key-value pair denoted like `"key":"value"`. So the first article in the JSON has the title "SFTP From the Command Line", and we know that because of the preceding `"title":`. So how do you turn rows from a SQL table into JSON? Well, there's a function built into PHP that will do that for you!. 

[gs]: https://paulmalone.blog/get-service.php

























