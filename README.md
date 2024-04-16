# Avrillo tech test

## Tech Stack

- [Nuxt 3](https://v3.nuxtjs.org/)
- [Vue 3](https://v3.vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [TypeScript](https://www.typescriptlang.org/)
- [Laravel 11](https://laravel.com/)
- [Docker](https://www.docker.com/)

This project requires you to have node and docker installed

To get set up from root run:
```bash
# Bring up frontend
cd fe && npm run purge-dev

# Bring up backend 
cd ../be && ./vendor/bin/sail up -d

# run migrations
./vendor/bin/sail artisan migrate

# run tests
./vendor/bin/sail artisan test
```

I sadly ran out of time on this and didn't implement the register on the FE, but you should be able to just make a POST request in postman to localhost/api/register and pass body params as form-data (name, email, and password)

Once you have done this though, you should be able to login on the frontend, and just be presented with a list of 5 quotes

If you logout and log back in, or refresh the page, the quotes should remain the same as the api response is cached for 1 minute, however if you click the refresh button above the quotes, you should be able to get new ones.

