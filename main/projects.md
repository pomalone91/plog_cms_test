## Projects
Things that I work on intermittently. 

### CRoll
I rewrote Termiroll in C (because I wanted to hurt myself). CRoll fixes some bugs that Termiroll had, but also provides some new functionality.

#### Roll Multiple dice at once
You can now roll multiple dice at once when you use `roll` from the command line. Simply list each roll with a space after it. For example input `roll 1d6 2d1+2 1d20` could produce output that looked like `2 4 5`. The roll for each dice is displayed individually and not summed together.
![Multiple rolls on the same line using CRoll](images/croll-sameline.png)

#### Batch files!
Before if you wanted to use Termiroll to roll initiative for a group of characters all at once you would have probably needed to write a shell script to repeatedly call `roll` for each character. Now you can put all of your rolls into one file and pass `roll` a path to that file as an argument. The syntax for doing this looks like `roll -b rollfile.txt`. As long as the file is in a plaintext format, and each roll is on its own line, CRoll should be able to read it. You can even label your rolls and CRoll will put those labels in the output so you can keep track of who rolled what. 

![Batch file with multiple labeled rolls in it](images/batchfile.png)
![Batch file output](images/batchoutput.png)


### Diceroller
![Diceroller iOS application](images/diceroller.png)

My only real foray into iOS development. You can see the code at [github][ghd].

### This website
I'm steadily building and upgrading the CMS (content management system) for this website. Plog is hosted on [Linode][li]. The content for this website is written using Markdown. I use [John Gruber's][df] markdown perl script to generate the HTML from the Markdown.

### Termiroll
![termiroll interactive mode](images/termiroll_interactive.png)

If your Macbook also doubles as a GM screen, then Termiroll is for you! Rapidly roll any kind of dice with any modifier in the familiar 1d6+1 format right in your terminal! You can run it once straight from the command line using `roll 1d6+2`. Or you can simply use `roll` and then repeatedly make as many rolls as you like in interactive mode.

#### Installation
You can use [Homebrew][hb] to install Termiroll.

`brew install pomalone91/termiroll/termiroll`

You can visit the project page here on [Github][gh].

[hb]: https://brew.sh
[gh]: https://github.com/pomalone91/termiroll
[li]: https://www.linode.com
[df]: https://daringfireball.net/projects/markdown/
[ghd]: https://github.com/pomalone91/DiceRoller