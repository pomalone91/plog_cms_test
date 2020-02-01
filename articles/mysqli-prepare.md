## Using prepare statements
TESTPassing a hardcoded string can be useful, but what's even more useful is passing a string that can have different variables in it. We could concatenate strings using the php concatenate operator ( `.` ). `mysqli` provides a better way though. The `prepare` function can be called on a `mysqli` object to create a so-called "prepared" a `mysqli\_stmt` object. For a peek under the hood of that class, check out the documentation [here][stmt]. Here's an example using the `prepare` function.

    $statement = $con->prepare("INSERT INTO blog.articles (pubDate, title, summary, filename) VALUE (CURRENT\_DATE(), ?, ?, ?)");

The usage of the `prepare` function seems pretty straightforward at first glance. It just takes a string representing a MySQL statement as its sole argument. But what's the deal with those question marks at the end? Well, there's one more function we need to know about in order to create a MySQL statement in this manner: `bind\_param`. This method is called from the newly prepared statement to (you guessed it) bind parameters to the statement. That's where the question marks above come in. They act as placeholders where you want to insert a parameter into the statement. Think of them like format specifiers in `printf()`. Here's `bind\_param` in action. 

    $statement = $con->prepare("INSERT INTO blog.articles (pubDate, title, summary, filename) VALUE (CURRENT\_DATE(), ?, ?, ?)");
    $statement->bind\_param("sss", $title, $summary, $filename);



### SQL Injection
However, to easily guard ourselves against the likes of [Bobby Tables][bt], we can use the `prepare` function to create a `mysqli\_prepare` object.
