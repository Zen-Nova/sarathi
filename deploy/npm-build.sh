#!/bin/bash
set -e

cd /home/techzenova/sarathi.techzenova.com

export RAYON_NUM_THREADS=1
export GOMAXPROCS=1
export NODE_OPTIONS="--max-old-space-size=512"
export UV_THREADPOOL_SIZE=1

if [ -f package-lock.json ]; then
  npm ci
else
  npm install
fi

rm -rf public/build
npm run build