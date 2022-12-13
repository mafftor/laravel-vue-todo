### How to
* clone the repo
* install composer dependencies `composer install`
* build vue front `npm install & npm run build`
* run `./vendor/bin/sail up -d`
* apply migration `./vendor/bin/sail artisan migrate`
* finally run queue worker `./vendor/bin/sail artisan queue:work`
