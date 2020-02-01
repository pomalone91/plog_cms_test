## Delegates

Probably the main purpose of this blog will be to act as a repository for things that I've learned and explanations that helped a concept stick with me. This quick little explanation is going to be about the **delegate pattern** in Apple's Cocoa and Cocoa Touch Frameworks. 

If you've done any iOS or MacOS development the odds are pretty high that you've run into delegate methods before. Apple uses them extensively with things like **UITableView** or **NSGridView**. None of the explanations that I've read in numerous guides and [Apple's documenation][ap] really clicked with me or left me with a satisfying or solid understanding. Here's Apple's explanation; if this does anything for you I guess you can move right along, but otherwise stick around for my explanation that may or may not fit with how you think about things. 

> Delegation is a simple and powerful pattern in which one object in a program acts on behalf of, or in coordination with, another object. The delegating object keeps a reference to the other object—the delegate—and at the appropriate time sends a message to it. The message informs the delegate of an event that the delegating object is about to handle or has just handled.

This explanation works at a high level, but to really understand delegation in Cocoa, we need to understand [Protocols][pr]. Here's the Swift documenation on protocols...

> A protocol defines a blueprint of methods, properties, and other requirements that suit a particular task or piece of functionality.

The inevitable phrasing that comes up when talking about protocols in Swift, or similar constructs like interfaces in Java, is that a protocol is a **contract**. So by extension we could think of an object that conforms to a protocol as something that is going to fulfill a contract, perhaps a **contractor**... 

Contractors are hired in the real world to do work that an individual or company cannot or does not want to do. The government hires contractors to run prisons, service federal student loans, and many other jobs that either requires some expertise, or are more economical to contract out. The government __**delegates**__ these jobs to other entities to get them accomplished. There we are, back at the delegate model. The delegate is the entity that is delegated to. 

Let's try to bring it all together with a specific example. Mining companies like Barrick and Rio Tinto hire a lot of contractors, so they'll be the focus of this example. If Rio Tinto needs a hole drilled so maybe they can see what minerals lay beneath, or how much ground water they're going to be dealing with, it's easier for them to find a **contractor** to do it than it is to have their own team of drillers on staff all the time. In order to accomplish the task of drilling this hole, they need to find a **contractor** who conforms to the Driller **protocol**. 



[ap]: https://developer.apple.com/library/archive/documentation/General/Conceptual/DevPedia-CocoaCore/Delegation.html
[pr]: https://docs.swift.org/swift-book/LanguageGuide/Protocols.html