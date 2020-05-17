If you've stumbled upon this you probably already know what Homebrew is, but are wondering "how the hell do I type `brew install` at the terminal to download _my_ shitty CLI tool and not just someone else's?"

Fret not! I am here to teach you how to do so in the most succinct and irresponsible way I can. The basic steps outlined are...

1. Build an artifact of your product.
2. Put that artifact in a Github release.
3. Write and push a Homebrew formula to Github with installation instructions.
4. Use Homebrew to install the binary from the artifact.

### Create a build artifact
Get the thing you actually want to run. The thing that you want other people to be able to install on their machine. The binary. The executable. That thing. Get that and put it on Github. Wait it's not quite that simple...

You need to compress it and then post it as a release on Github (or some server you own, but I'm assuming you have a Github). Use your terminal to make a tar.gz file like so... (Wait, you know how to use a terminal right? _Are you even on a Mac_).

    tar -cvzf appname-1.0.tar.gz appname
    
What's that do? You're pointing the `tar -cvzf` command at a file called `appname` and telling it to compress it into a file called `appname-1.0.tar.gz`. I added the "-1.0" because I like to have version numbers in the artifact names. You name your little fellas however you want though :) .

### Creating a Release
Now that you have a build artifact, you need to put it somewhere Homebrew can find it. We are going to use Github releases. Look at Github's guide on [creating a release][gh]. I hope that was useful. Now make it your damn self! 

jk... I'll talk to you about it. To start though, you can find releases by clicking the aptly named "Releases" button found on the main page of the repo for your project. The button has a little tag glyph right next to it. Once there you'll see a list of previous releases, if you have any, and a button at the top to "Draft a new release". Click that. Here's a screenshot of what that looks like for [crol][croll]...

![Croll Relase](images/croll-release.png)

A few things of note...

- I put "v1.1" in the tag at the very top. I think realistically you could put whatever you want there.
- Description of the release (just gonna call it roll).
- Summary I wrote explaining what's new in this release.
- At the bottom you may notice I attached a tar.gz file. That's why we started out doing that above. Make sure you attach the correct tar.gz file when you create your release.

If it isn't clear what's going on, this is where Homebrew is going to actually look to find the file to download when you use `brew install`. However, we still need to let Homebrew know where to find this, and how to install it.

### Homebrew Formula
The next thing we need to do is create a formula that Homebrew uses so it knows how to actually install the binary you're distributing. I'll lay out the steps below in brief and then explain them each afterwards.

1. Create a Github repo called "homebrew-apps"
2. Create a Ruby class for your Formula
3. Push the Ruby formula to your homebrew-apps repo

This repo will house the Ruby formula that will be used to install your binary. This will be the "tap" (to use Homebrew's contrived metaphor) that will be opened by Homebrew when the user installs the software. 

#### Creating the Ruby Formula
I don't really know Ruby, but I know enough to fill in a template for these...

    class Crol < Formula
    desc "CLI based dice roller written in C"
    homepage "https://github.com/pomalone91/c_roll"
    url "https://github.com/pomalone91/c_roll/releases/download/v1.0/roll-1.0.tar.gz"
    sha256 "722cb5769d4f6a79b82b79d28a7bc0fc472a54cd29d2f77f2c015e802cf8b66f"

    bottle :unneeded

    def install
        bin.install "roll"
    end

      test do
        system "#{bin}/roll"
      end
    end

So let's just go through this line by line.

- `class Crol < Formula` is us defining a class called Crol, which inherits from another class called [Formula][rbf]. 
- `desc` gives us a description of what the binary does.
- `homepage` The homepage for the product. In this case I just put the Github repo for the project.
- `url` is the URL to the binary that Homebrew will install. Remember when we made that release on Github? We want to use that URL.
- `sha256` the SHA key created for that binary. To create this use use something like this `shasum -a 256 roll-1.1.tar.gz`. That's calling the `shasum` command from the terminal targeting your tar.gz file you created earlier. That will output a hexidecimal number that you should copy into the formula.
- `bottle :unneeded` means there is no compilation or dependencies needed on the user side of things. I guess Homebrew uses "bottles" to represent dependencies? Like I said, it's a contrived metaphor. Check out their [documentation][hdoc] if you want to learn more.
- `def install` defines a function `install`. This function calls `bin.install` passing the name of your binary as an argument. This just means that it's going to install in `/usr/local/bin`. 
- `test do` this tests that the install was successful. In this case, it checks that there is an item called `roll` in `/usr/local/bin`.

#### Pushing to Github
Once you've got your formula down, push it to the Repo you made earlier! *NOTE*: Each time you update your project, you'll want to make sure you do the following...

1. Create a new tar.gz artifact of your binary (build your new binary of course).
2. Add a new release in Github with the new binary.
3. Get a new SHA256 of your tar.gz.
4. Update the Ruby formula with the URL to the new release and the new SHA256 value for the new tar.gz.
5. Push the updated formula to the homebrew-apps repo.

### The Moment of Truth!
You should be able to theoretically download it now! You can use the following to install something for the first time from your tap.

    brew tap pomalone91/homebrew-apps
    brew install Crol
    
If you needed to download a new version, you would want to use `brew upgrade pomalone91/apps/crol`.

### Wrap Up
That's Homebrew. It's stupid and takes forever to update if you haven't run it in a while, but it works. Mostly.


[gh]: https://help.github.com/en/github/administering-a-repository/managing-releases-in-a-repository
[croll]: http://ninecirclesofshell.com/projects.php
[rbf]: https://rubydoc.brew.sh/Formula
[hdoc]:https://docs.brew.sh/Formula-Cookbook