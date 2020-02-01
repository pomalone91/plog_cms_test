# Calling shell scripts from Swift code
I ran into an issue trying to upload files to my server using _just_ Swift. Every guide I could find about uploading files required using multipart/form data in the HTTP header. Well, I couldn't figure out how to get it to work. The server is setup to accept upload MPF Data requests, and my Swift code seemed to be making them, but something was lost in translation. 

After banging my head against the wall trying to figure it out, I conceded defeat and went to plan B. I decided it would probably be easier to just write a shell script that makes an SFTP request to the server and call that from Swift. I knew how to write the script, but I wasn't entirely sure how to launch a shell script from Swift code. Here is how to do that...

## Process()
`Process` is a class in Foundation that [represents a subprocess of the current process][ap]. `Process` allows you to run another program as a subprocess, which is perfect for my current situation. After reading the documentation, the plan was to have a `Process` object call my `arld` script with the article's file name as its sole argument. Below is the function I wrote to handle this.

    private func uploadWithArld(filename: String) {
            let process = Process()
            process.launchPath = "/usr/local/bin/arld"
            process.arguments = [filename]
            process.launch()
        }

Let's go through this line by line.

1. `let process = Process()`: Instantiate an object of type `Process`
2. `process.launchPath = "/usr/local/bin/arld"`: Set that object's `launchPath`. This is the path at which the executable actually exists.
![Script location in file system](images/arld_script-location.png)
3. `process.arguments = [filename]`: The sole parameter for the function `uploadWithArld` is a String labeled `filename`. The `arguments` property of `process` is set to be `filename`. This means that when `process` actually launches the script it's pointed at, it will pass whatever is in its `arguments` array to the script it is calling. 
4. `process.launch()`: Tells `process` to launch the script at its `launchPath` and pass whatever is in its `arguments` array.

Now I have a function that I can call when the user clicks "Upload" in Plog 2.0 that will just call `arld`, which calls `sftp` to upload files to my server. The actual `arld` script cds to the correct directory which is hardcoded into the script, so all I need to do is pass the file name. 

## Wrap Up
There's a quick exampe of how to call another program from your Swift code. The two main things you need to do so are...

1. The launch path to the program.
2. Any arguments you might need to pass to the program.

Hopefully that was helpful!

[ap]: https://developer.apple.com/documentation/foundation/process