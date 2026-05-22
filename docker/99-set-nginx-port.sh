#!/bin/sh
if [ -n "$PORT" ]; then
    echo "Dynamic PORT environment variable detected: $PORT"
    echo "Updating Nginx configuration files to listen on port $PORT..."
    
    # Find all files under /etc/nginx that contain '8080' and replace it with $PORT
    find /etc/nginx -type f | while read -r file; do
        if grep -q "8080" "$file"; then
            echo "Replacing port 8080 with $PORT in $file"
            sed -i "s/8080/$PORT/g" "$file"
        fi
    done
    
    echo "Nginx port updates complete."
else
    echo "No PORT environment variable defined, defaulting Nginx to port 8080"
fi

