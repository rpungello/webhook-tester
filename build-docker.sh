#!/usr/bin/env bash

set -e

# Read the current version from composer.json
CURRENT_VERSION=$(git describe --tags --abbrev=0)

# Build the Docker image
echo "Building Webhook Tester v$CURRENT_VERSION"
docker buildx build \
       --pull \
       --no-cache \
       --build-arg VERSION="$CURRENT_VERSION" \
       --tag "rpungello/webhook-tester:latest" \
       --load .
