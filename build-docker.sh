#!/usr/bin/env bash

docker buildx build --no-cache --platform=linux/amd64,linux/arm64/v8 --tag rpungello/webhook-tester:stable --push .
