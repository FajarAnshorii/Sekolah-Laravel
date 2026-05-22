#!/bin/sh
if [ -n "$PORT" ]; then
    echo "Dynamic PORT environment variable detected: $PORT"
    # Find all files in Nginx config and replace the default 8080 with the dynamic $PORT
    find /etc/nginx -type f -exec sed -i "s/8080/$PORT/g" {} +
else
    echo "No PORT environment variable defined, defaulting Nginx to port 8080"
fi
