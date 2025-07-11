# Laravel Marketplace

## The Assignment

This repository is my submission for the "Laravel Marktplaats" assignment.

## Design decisions 


### Inspiration
I decided to design the website like a mixture between [Marktplaats](marktplaats.nl) and [eBay](ebay.nl).
Taking inspiration from what I like about each website's design. 

### Categories
I opted for a hierarchical category system, because I personally believe it to be the better system to finding a 
specific product when as noted in the `Marktplaats /MAR-6740` ticket,
we only allow filtering on one category at a time. Generic multi categories would make finding a specific product too difficult
for the end user if they are only allowed to filter for one of them.

### Messages
I decided I wanted to challenge myself a bit with the messaging system.
Even though ticket `Marktplaats /MAR-6743` hints at the implementation of an inbox like messaging system.
I felt it would be more interesting, and that I would learn more from implementing a live chat. 
Once again inspired by [marktplaats](marktplaats.nl).

I felt like this was the right decision since it would teach me about handling WebSockets in Laravel utilizing the 
[Broadcasting API](https://laravel.com/docs/12.x/broadcasting), and teach me a bit more about [The Event API.](https://laravel.com/docs/12.x/events#main-content)
I also ended up using [HTMX](https://htmx.org/), for the live chat feature, because I just like the project,
and it helped make the live AJAX DOM insertions a bit more manageable.

### Search
For the `Marktplaats / MAR-6742` which requires full text search I decided to use the [Laravel Scout Library](https://laravel.com/docs/12.x/scout#main-content). First I implemented it using the [Meili](https://www.meilisearch.com/) driver, to learn a bit more about utilizing third party drivers in scout. Then in the end decided on the database driver for the sake of keeping the architecture
of the project as simple as possible. Which luckily was compatible with my database of choice: [Postgres](https://www.postgresql.org/).
I think it is utilizing Postgres's [Full Text Search](https://www.postgresql.org/docs/current/textsearch.html), but I can't be sure unless I read into the source code of Scout. I assume that this fulfills the requirement. 

## Deploying

### Requirements
To deploy the project you'll need to following things:
- A Postgres or MySQL database (I usually use docker with a local postgres container in development).
- Laravel and PHP >= v8.0

And that should be it!

### Environment

You should just be able to copy the `.env.example` file and fill in the following parameters:
- All the Database(DB_) parameters
- REVERB_APP_ID
- REVERB_APP_KEY
- REVERB_APP_SECRET

Then run `php artisan key:generate` to generate the app key.

### Running the project in development

#### Setup

To set up the project you need to follow the following steps:

- Install dependencies
    - Run `npm install`
    - Then run `composer install`

- Migrations
    - Run `php artisan migrate --seed`

#### Running the project

To run the project in development run the following commands:
- `php artisan serve`
- `npm run dev`
- `php artisan reverb:start --debug`

The project should now be accessible on port 8000
