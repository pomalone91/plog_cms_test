## SFTP From the Command Line
This is a follow up to [this](https://paulmalone.blog/article.php?id=42) post about the making of the content management system (CMS) for Plog. I'll be addressing the components of Plog in roughly the order they were introduced in the Making Of article. Here they are again.

1. Local articles folder
2. Article upload script (arld)
3. Mac client
4. Get-service
5. Post-service
6. Remote articles database

This post will address the items 1 and 2, and how the `sftp` is used to handle the upload of local files to the server.

### The Set Up
First of all, for anyone who might not know, FTP stands for _File Transfer Protocol_. If you tack an 'S' on there, it stands for _Secure File Transfer Protocol_ (or _SSH File Transfer Protocol_). In this case, we're using SFTP because we're using SSH to connect to the server. 

The name pretty much says it all; FTP is a way to transfer files from one computer to another, and that's exactly what I'm using it for. There are plenty of different ways to use SFTP. I was first introduced to it through a front-end web development class that recommended we use [FileZilla][fz]. I ended using the trial version of [BBEdit][bb], which allows you to continue using their built in FTP client after your trial expires. I eventually ended up using BBEdit _only_ as an FTP client, which seemed like a waste so I searched around for a pure FTP client that didn't have a whole text-editor tacked onto it. I tried [Transmit][tm] which was good, but I didn't really want to spend money on it. I didn't want to use FileZilla because it just seemed kind of icky and I've heard bad things about it. I eventually settled on [Cyberduck][cd], which is open source so that was nice. It is a pretty straightforward FTP GUI and that's exactly what I wanted. 

Before I settled Cyberduck though, I kept thinking to myself "there has to be a way to do this from the command line". I tried messing around with [CURL][cu] and looked at Swift networking libraries like [Alamofire][af] that I could potentially use to script the upload of my articles and images to the server. I tried just typing `ftp` into the terminal, but that command is [no longer in MacOS][ftp]. It took me an embarrassingly long about of time before I realized you can just type `sftp` in Terminal to get a full SFTP capabilities. 

### Using `sftp` From the Command Line
The simplest way to connect to a server via SFTP is to just type `sftp` followed by the user you want to log in as, then an `@`, then the address of the server. So you might type something like...

`sftp admin@somewebsite.com`

Assuming you've got the right SSH credentials, you will create an SFTP connection to the server. Your command prompt will look something like this...

![sftp prompt](images/sftp-prompt.png)

Once you are connected, you can `cd`, `pwd` and `ls` your way around the file system of your server, as if you had connected via ssh. If this new found power is overwhelming, just type `exit` and the connection will be closed and you will see the familiar dollar-sign waiting for your commands. 

You can also go straight to the directory you want to work with on the server by putting the path at the end of the server address.

`sftp admin@somewebsite.com/path/here`

If you don't put a file path at the end, it will just start you in the home directory of whatever user you put before the `@` sign.

### Putting Stuff on the Server
Now that you have connected to the server and found the directory you want to work with, it's time to actually put some files on there!

1. Make a test.txt file on your Desktop.
2. Using Terminal, connect to your server via `sftp`.
3. At the prompt type: `put /home/admin /Users/your user name/Desktop/file.txt`

A couple notes about the path in your put command:
- The first path entered is the remote path that you want to place the file in. If you omit this, it will assume you want to use your current working directory.
- The second path you enter is the path to the item you want to upload on your **local** machine.
- `sftp` doesn't play nice if you use ~/ as shorthand for the home directory of the current user. You'll have to spell out your home directory like `/Users/your user name/`  
- By default, if an item with the exact same file name as the one you are putting onto the server already exists, it will be overwritten by the new one. **Be mindful of what files you are putting in what directories**.

### Getting Stuff from the Server
Getting a file from the server follows a pretty similar format to putting it on the server. `cd` your way to the directory you put your test file in earlier and type something similar to what is below.

`get /home/admin/test.txt /Users/your username/Desktop`

`get` tells sftp you want to get a file from the server. The file name should include the path to the file unless it is located in your current working directory. The last part is the local directory you want to save the file to. Similar to `put`, by default `get` will overwrite whatever file already exists in destination directory, so be sure not to overwrite anything by mistake. 

### Conclusion
So those are the basics of `sftp`. It may still be nice to use a GUI client for one-off file transfers, but having the ability to write a simple bash script to automate some `sftp` use cases is really nice. Since this was a pretty basic tutorial, I encourage you to check out the `man` pages for `sftp` and take a look at some of the other options. This guide was written entirely with interactive mode in mind, but many will be interested in the non-interactive mode for scripting.

[fz]: https://filezilla-project.org
[bb]: https://www.barebones.com/products/bbedit/index.html
[tm]: https://www.panic.com/transmit/
[cd]: https://cyberduck.io
[cu]: https://curl.haxx.se
[af]: https://github.com/Alamofire/Alamofire
[ftp]: http://osxdaily.com/2018/08/07/get-install-ftp-mac-os/























