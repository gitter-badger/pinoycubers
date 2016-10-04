## Pinoy Cubers

1. **Unofficial Records** - Compare your record time with other cubers in the Philippines. We will verify your record time and post it on the unofficial Philippine records list
2. **Learning Resources** - Share algorithms and checkout the algorithm database. Watch/Read puzzle solving tutorials
3. **Events** - Check upcoming official competitions and see results online. View the calendar for cubemeets near you
4. **Group Discussions** - Participate in online group discussions about your favorite puzzles
5. **User Profiles** - Contribute to the community and earn badges. Post your personal bests and tell something about yourself
6. **Online Competitions** - Compete online with your friend on your favorite puzzles in real time. Host and join a competition using the web interface
7.  **Cube Meets** - Set and join meetups. View upcoming and past cube meets.

## Installation Instructions

1. Clone this repository

		git clone git@github.com:geocine/pinoycubers.git

2. Run `composer install` to install all project dependencies. Make sure you have [composer](https://getcomposer.org/download/) installed.

		composer install

3. Copy the `.env.example` file to `.env` then update the database connection configuration
4. Create database on MySQL named `pinoycubers` or use the name you have set on no. 3
5. Run the data migrations and seeders. This will create tables on your database and populate it with data

		php artisan migrate --seed

6. Run the application and navigate to [http://localhost:8000](http://localhost:8000)

		php artisan serve

## Contribution Guidelines

 - When planning a pull-request to add new functionality, it may be wise to [submit a proposal](https://github.com/geocine/pinoycubers/issues/new) to ensure compatibility with the project's goals.
 - I suggest using *Vagrant* for development environment configuration

### Commit Message Rules

1. **Why is this change necessary?**

	This question tells what to expect in the commit, to easily identify and point out unrelated changes.

2. **How does it address the issue?**

	Describe, at a high level, what was done to affect change. Here are some good examples:
	
		Introduce a red/black tree to increase search speed 
		Remove <X>, which was causing <specific description of issue introduced by X>
		
	If your change is obvious, you may be able to omit addressing this question.

3. The body should provide a meaningful commit message, which **uses the imperative, present tense** "change", not "changed" or "changes". See example in #2


## Developers

This code is maintained by [Philippine Cubers Association](https://facebook.com/PhilippineCubersAssociation/)

- [Aivan Monceller](https://github.com/geocine)
- [Omar Lozada](https://github.com/lozadaOmr)
- [Dhan-Rheb Belza](https://github.com/drfb)
