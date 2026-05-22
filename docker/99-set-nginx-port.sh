#!/bin/sh
if [ -n "$PORT" ]; then
    echo "Dynamic PORT environment variable detected: $PORT"
    # Target only specific configuration files containing the listen port to be extremely safe
    for file in /etc/nginx/nginx.conf /etc/nginx/site-opts.d/http.conf /etc/nginx/site-opts.d/http.conf.template; do
        if [ -f "$file" ]; then
            echo "Updating Nginx port in $file..."
            sed -i "s/8080/$PORT/g" "$file"
        fi
    done
else
    echo "No PORT environment variable defined, defaulting Nginx to port 8080"
fi
