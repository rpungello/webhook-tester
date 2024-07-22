# Webhook Tester

Simple, Laravel-based webhook tester for inspecting webhook calls from third-party services.

## Installation
Download the latest docker-compose.yml file

```bash 
wget https://raw.githubusercontent.com/rpungello/webhook-tester/main/docker-compose.yml
```

Download sample .env file.

```bash
wget -O .env https://raw.githubusercontent.com/rpungello/webhook-tester/main/.env.example
```

Configure the .env file to suit your needs.
In particular, for WebSockets to work properly, the following needs to be set properly:
- `VITE_REVERB_HOST`: public-facing hostname of the app (e.g. `webhook-tester.example.com`)
- `VITE_REVERB_PORT`: public-facing port of the app (usually 80 or 443)
- `VITE_REVERB_SCHEME`: http or https
This will enable the use of WebSockets to facilitate realtime display of new webhook requests.

Start Docker stack in production mode.

```bash
docker compose --profile prod up -d
```

If you want to host the database or redis instance internally,
append `--profile db` and/or `--profile cache` to the above command.

Generate an app key.
Note that if your Docker container name is anything other than `webhook-tester-app-1`,
you'll need to download the script and edit accordingly.

```bash
curl https://raw.githubusercontent.com/rpungello/webhook-tester/main/docker/key.sh | sh
```

Restart the Docker stack to apply the updated `.env` file

```bash
docker compose --profile prod down
docker compose --profile prod up -d
```

Run migrations (replace `webhook-tester-app-1` with the name of the app container)

```bash
docker exec webhook-tester-app-1 php artisan migrate --force
```
