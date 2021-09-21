
# Seed project for php api-platform based microservice

## Requirements
* [docker](https://docs.docker.com/install/)
* [docker-compose](https://docs.docker.com/compose/install/)
* [plopjs](https://github.com/plopjs/plop)
* [gcloud](https://cloud.google.com/sdk/docs/downloads-apt-get)
* [kubectl](https://cloud.google.com/kubernetes-engine/docs/quickstart#choosing_a_shell)
* Access to staging cloud project (contact devop lucian.criste@russmedia.com)

## Usage

1. Download latest `tar.gz` [release](https://github.com/russmedia-romania/microservice-seed/releases/latest)

2. Unpack to your desired folder (empty or existing git repository)

3. Run `plop` from your folder and input the requested parameters

4. In your repo folder execute 
```bash
gsutil cp gs://staging-rs/beta/private.pem  api/config/jwt/
gsutil cp gs://staging-rs/beta/public.pub  api/config/jwt/
```

5. Run `docker-compose up -d`. It could take some minutes (PHP container needs to install packages)

6. You can access a scheleton service at http://localhost:[port]/[app_name]-service

Bugsfree coding! :metal:


