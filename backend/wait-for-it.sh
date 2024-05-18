#!/usr/bin/env bash
# wait-for-it.sh -- zeitbasiertes Dienstverfügbarkeitsprüfungsskript

set -e

host="$1"
shift

cmd="$@"

echo "Waiting for $host to be available..."

while ! nc -z ${host%:*} ${host#*:}; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 1
done

>&2 echo "MySQL is up - executing command"
exec $cmd
