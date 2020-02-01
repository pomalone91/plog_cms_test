## Using MySQL with PHP
Here is the most bare-bones way to use data returned by a MySQL query in a PHP script. Knowing how to do this is fundamental to web-development, and there's a lot more to it than this guide will cover, but hopefully this will get you started. 

### Database Connection file
The DatabaseConnection.php will do two things:

1. Act as a configuration file for anything related to the database, housing passwords, addresses and other meta data needed to connect and interact with the database.
2. Create a connection to that database that can be used in other PHP scripts. 

Below is the code for the connection file. I'll walk through it in finer detail below.

    $host = "127.0.0.1";
    $user = "your mysql username here";
    $password = "";
    $dbname = "The name of the database you want to connect to";
    $passphrase = "any other metadata you might need to make the connection";
    
    $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
    	or die ('Could not connect to the database server' . mysqli\_connect\_error($con));
    if($con->connect\_error == false) {
        echo "<h2>We Connected</h2>";
    } else {
        echo $con->connect\_error;
    }

### Configuration attributes
The first set of variables declared are all information needed to make the connection to the MySQL server.

- **$host:** If the MySQL server is on the same machine as this script (which in my case they are since they're running on the same Linode server) the host name is 127.0.0.1 by default. 
- **$user:** The MySQL user whose name the connection will invoke to execute queries. Could be "root", or any other MySQL user you have set up. 
- **$password:** The MySQL password for that user. This is the same password you use to log into MySQL using `mysql -u username -p`. 
- **dbname:** If you want to go straight to a specific database, you'll want to have the name of that database handy. 
- **$passphrase:** This just represents other miscellaneous meta data that isn't required to make the connection, but may be useful for your purposes. For example, you might only allow insert, update or delete statements if the post request provides the passphrase that matches what is in this configuration file. 

### Making the Connection
To actually connect to a MySQL database, use the `mysqli` PHP extension to handle creating a connection object. You will then call methods of that connection object to actually execute queries.

    $con = new mysqli($host, $user, $password, $dbname, $port, $socket);

The constructor for a mysqli object takes the host (IP address or domain name), the MySQL user, the password for that user, an optional database name, the port MySQL server uses and the socket. You only need to specify the port and the socket if you aren't using the defaults (3306 is the default port for MySQL server).

### Using the MySQLI Connection Object
Now that you have a mysqli object you can use it to query a database on your MySQL server. The first thing you need to do is create the query though, there are a couple of ways to do this.

#### Passing a String
The straightforward and intuitive way to make a query is to pass a string to the `query()` function of your `mysqli` object. 

    $statement = "SELECT id, title, summary, pubDate, filename FROM blog.articles WHERE deleteDate is NULL ORDER BY pubDate DESC";
    $results = $con->query($statement);

`query()` returns a `mysqli\_result` object if the query was successful and `false` if it was not. If you look at the [documentation][rslt] for `mysqli\_result` you will see  several functions that will return the actual data from the results. You can fetch rows from the results as associative or numeric arrays, and then access the data within those arrays using the key or index. If you're using an associative array, the key you would use is the name of the column in the table. You could use code similar to below to traverse across the result and pick out choice data you want.

    while ($row = $results->fetch_assoc()) {
        echo $row['title'];
    }

To illustrate things, if you executed that code on the data below you would get something that looked like "article 1article 2article 3article 4article 5article 6 "

    [{"id":"43","title":"article 1","pubDate":"2019-04-05 00:00:00"}
    ,{"id":"42","title":"article 2","pubDate":"2019-03-30 00:00:00"}
    ,{"id":"10","title":"article 3","pubDate":"2019-03-21 00:00:00"}
    ,{"id":"9","title":"article 4","pubDate":"2019-03-09 00:00:00"}
    ,{"id":"8","title":"article 5","pubDate":"2019-03-04 00:00:00"}
    ,{"id":"3","title":"article 6","pubDate":"2019-02-08 00:00:00"}]