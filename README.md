# README #

NOAH Challenge - Get Hired!

### How do I get set up? ###

- Clone repository on your LAMP environment
- Update Composer 
- Setup .env file

### What should i do? ###

- Open */app/Console/Commands/ImportDealRoomCompanies::class*

- Structure a database table using the schema proposed by the model *Company::class* (use migration)

- Read the API docs inside */docs* folder and write the code to import the data from source by using the command *php artisan dealroom:import*

- Create a basic frontend page with Bootstrap, to show a paginated list of results and a simple view of single company data (Routes are already defined)

- OPTIONAL: write a phpunit test for the Artisan Command

- Create a new branch with your name and push the code

### How much time do i have? ###

The challenge has to be completed within 2 hours. We evaluate both the quality of the code and the execution time.

Good luck!
