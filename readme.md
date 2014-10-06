## Pinoy Cubers

1. **Unofficial Records** - Compare your record time with other cubers in the Philippines. We will verify your record time and post it on the unofficial Philippine records list
2. **Learning Resources** - Share algorithms and checkout the algorithm database. Watch/Read puzzle solving tutorials
3. **Events** - Check upcoming official competitions and see results online. View the calendar for cubemeets near you
4. **Group Discussions** - Participate in online group discussions about your favorite puzzles
5. **User Profiles** - Contribute to the community and earn badges. Post your personal bests and tell something about yourself
6. **Online Competitions** - Compete online with your friend on your favorite puzzles in real time. Host and join a competition using the web interface

## Installation Instructions

### (Using Vagrant)

Instructions for **Windows**. Sorry, I am a .NET dev as well. Can't get away with windows.

1. Install [Cygwin](http://www.cygwin.com/) and setup system path.

		e.g. C:\cygwin64\bin
	
	Don't forget to choose the following packages :
	
	- **chere**: Cygwin Prompt Here context menus
	- **make**: The GNU version of 'make' utility
	- **openssh**: The OpenSSH server and client programs


2. Install [Vagrant](http://www.vagrantup.com/downloads.html) and [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
3. Clone repository
 
		git clone git@github.com:geocine/pinoycubers.git

4. Right click the `pinoycubers` folder and click `Bash Prompt Here`
5. While on the cygwin terminal. Type this:

		vagrant up

6. Add pinoycubers.dev to host file. *(Use the exact IP address)*
		
		10.0.0.100 pinoycubers.dev

#### Configuring Laravel

1. Enter *Vagrant's* ssh

		vagrant ssh	

2. Migrate the database
		
		cd /vagrant
		php artisan migrate
 
#### Connecting to MySQL on *Vagrant*
	
	host 	- 127.0.0.1
	username - root
	password - root
	port	 - 3308


## Contribution Guidelines

**Live Site** : http://pinoycubers.org/

 - Send me a message on Facebook if you want to help me with the app, I would add you as tester on Facebook.
 - When planning a pull-request to add new functionality, it may be wise to [submit a proposal](https://github.com/geocine/pinoycubers/issues/new) to ensure compatibility with the project's goals.
 - I suggest using *Vagrant* for development environment configuration

### Tool Suggestion

1. You may use [Crunchapp](http:http://crunchapp.net/) or [Prepros](http://alphapixels.com/prepros/) for compiling less files. We only need to compile `bootstrap.less` and `site.less`
2. I prefer [PHPStorm](http://www.jetbrains.com/phpstorm/) for an IDE. [Sublime Text 3](http://www.sublimetext.com/3) for an editor.

### Commit Message Rules

1. **Why is this change necessary?**

	This question tells what to expect in the commit, to easily identify and point out unrelated changes.

2. **How does it address the issue?**

	Describe, at a high level, what was done to affect change. Here are some good examples:
		Introduce a red/black tree to increase search speed 
		Remove <X>, which was causing <specific description of issue introduced by X>
	If your change is obvious, you may be able to omit addressing this question.

3. The body should provide a meaningful commit message, which **uses the imperative, present tense** "change", not "changed" or "changes". See example in #2


## Maintainers

This code is maintained by Aivan Monceller of [Pinoy Cubers Association](https://www.facebook.com/groups/PINOYCUBERS/)

## Contributors

[Omar Lozada](https://github.com/lozadaOmr) - Windows Azure Webhost. Thanks!


### License

New BSD License

Copyright (c) 2014, Aivan Reigh Monceller 

All rights reserved. 

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met: 

- Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
- Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
- Neither the name of Pinoy Cubers Association nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.