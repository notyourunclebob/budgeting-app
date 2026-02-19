## Localy Development
- For local dev this app makes use of Sail and composer. To start the app enter the following commands

```bash
# if composer deps not already installed
composer install

./vendor/bin/sail up

./vendor/bin/sail artisan migrate

./vendor/bin/sail npm i

./vendor/bin/sail npm run dev
```

- if you have issues with migrations you may have to delete the docker volume and start the app again

```bash
./vendor/bin/sail down -v
```

## start.sh script
the `start.sh` script will perform the steps above but must be given execute persmissions

```bash
chmod +x start.sh
```
- then just run the script

```bash
./start.sh
```
