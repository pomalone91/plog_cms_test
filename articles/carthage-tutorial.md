HERE'S A TEST UPDATE LOLOLZ

I'm taking a break from building the MacOS client for the Plog CMS to make notes on some of the things I've had to learn to get it working so far. Some of the things that there will be write-ups on include...

- Creating and connecting to a PHP API with just plain Swift.
- Parsing JSON with plain old Swift.
- Default protocol implementations (and protocols in general).
- Using Carthage to install third party frameworks.

This write-up is going to be about the last item: using [Carthage][cr]. Carthage is a package manager for Swift that allows you to quickly and easily build third-party frameworks for your project. This guide will explain how to install Carthage, how to create a "Cartfile", how to download the framework and how to use it in your project.

### Step 1: Installing Carthage
There are a lot of different ways to install Carthage listed on the [Github page][cri]. My prefered way to do it is via [Homebrew][hb]. If you don't have Homebrew installed already, you can view instructions for installing homebrew at [brew.sh][hb].

Once you have that installed you can use it to install Carthage.

1. Open a Terminal window.
2. Type `brew update` to get Homebrew up to date.
3. Type `brew install carthage` to install Carthage.

### Step 2: Creating A Cartfile
A cartfile is what you use to tell Carthage what frameworks you need to include in your Swift project. The contents of the cartfile help Carthage locate that framework. In this case, we'll be using [Down][dn], a Markdown parsing framework for Swift. Down is available on Github, but Carthage can get frameworks from [other locations as well][crf]. Let's create a cartfile!

1. Open a terminal session in your Xcode project's directory. An easy way to do this is to just type `cd` in the terminal window and then drag that little folder icon at the top of the finder into the terminal and then press enter.
![Opening a folder in terminal with folder icon from Finder](images/terminal_folder_open.png)
2. Once you've got your terminal pointed at your Xcode project you need to create the actual cartfile. You can do this using whatever terminal based text editor your comfortable with. We'll use nano, since it's the simplest. 
3. `nano cartfile`.
4. Type `github "iwasrobbed/Down"` ("iwasrobbed" is the Github username. "Down" is the name of a repository).
5. Press ctrl + O to save and exit.
6. Make sure when nano asks you for "File Name to Write" you keep it as cartfile, then press enter.
7. Press ctrl + X to exit nano.

You can also specify versions of a framework in the cartfile. You would do so by typing something akin to `github "iwasrobbed/Down" == 0.6.2` if you needed exactly version 0.6.2 of Down. You can also specify ranges of possible version numbers.

- `==` Exactly the version number given.
- `>=` Any version equal to, or greater than the version number given.
- `~>` Any version from the number given to the next major release.

### Step 3: Using Carthage to Get a Framework
Back in terminal, type `carthage update --platform` followed by the platform you want to use the framework on. For example, if you're working on a MacOS project, you would type `carthage update --platform MacOS`. You'll see carthage doing its thing in terminal, but you will soon have a freshly baked Swift framework!
![carthage hard at work](images/carthage_at_work.png)

### Step 4: Using a Framework in your Project
Great, you've downloaded someone's opensource framework for use in your own project! So how do you actually use it? It's actually just a matter of locating the compiled framework and dragging it into Xcode, pretty simple!

1. There should now be a folder titled "Carthage" in your project directory, open that.
2. In there will be two more folders: "Build" and "Checkout". Open **"Build"**.
3. Inside "Build" will be folders for each platform you told Carthage to build the framework for. In my case, I just chose MacOS.
4. Inside the platform specific folder will be a ".framework" file. That's your framework!
![Your framework](images/framework.png)
5. In Xcode, click on the project icon at the top of the navigation pane.
![Xcode navigation pane](images/xcode-navigation.png)
6. Make sure the "General" tab is selected.
7. Drag the ".framework" file from the Finder into "Embedded Binaries" section.
![Embedded binaries](images/embedding_framework.png)

That's it! You should now be able to create instances of classes, and call functions from this framework. I hope this removes some of the resistance to try other people's frameworks that some learning programmers may face. I felt that way for a long time, so hopefully this saves you from reinventing the wheel.

[cr]: https://github.com/Carthage/Carthage
[cri]: https://github.com/Carthage/Carthage#installing-carthage
[hb]: https://brew.sh
[dn]: https://github.com/iwasrobbed/Down
[crf]: https://github.com/Carthage/Carthage/blob/master/Documentation/Artifacts.md#cartfile