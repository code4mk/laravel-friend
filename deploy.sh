#! /bin/bash

docker build \
  --platform=linux/amd64 \
  --file=docker/dockerfiles/app.Dockerfile \
  --tag="laravel_friend:dev" .