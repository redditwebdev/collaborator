# Collaborator

A website to find collaborators for your github projects

## Developing

This website is made using Angular.js v1 and Laravel 5, using SCSS for css

1. Fork this repo
2. Clone your copy
3. `npm install`
4. `composer install`
5. `cp .env.example .env`
6. `php artisan key:generate`
7. Ask for the github api key (must be with organization) or supply your own
8. Add the client id + secret + callback to the .env
9. Add your DB credentials to the .env file
10. run `php artisan migrate`
11. run `gulp build` to bundle all of the assets (bundled assets are not included in SC)
11. Make your changes and submit a detailed PR

## Javascript

All javascript needs to go in the resources/assets/js folder.

Inside that folder are different angular modules separated by folders.

Inside each module folder should have a `<modulename>.module.js` file

Each controller/factory/directive follows a similar naming scheme of `className.<controller|factory|directive>.js`

## SCSS

All SCSS goes in `resources/assets/scss`

Write your component specific scss in the `components/` folder, prefix the filename with an underscore, and then import it in `resources/assets/scss/app.scss`

## Builds

Run `gulp watch` to watch + compile scss + js

Compiles out to `/public/dist/`
