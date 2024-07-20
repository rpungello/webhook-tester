#!/usr/bin/env bash

docker buildx build --platform=linux/amd64,linux/arm64/v8 --tag rpungello/webhook-tester:stable --push .
