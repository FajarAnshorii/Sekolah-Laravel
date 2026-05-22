#!/bin/sh
if [ -n "$PORT" ]; then
    echo "Dynamic PORT environment variable detected: $PORT"
    echo "Updating Nginx configuration files to listen on port $PORT..."
    
    # Safely find configuration and template files under /etc/nginx to avoid binary file corruption
    find /etc/nginx -type f \( -name "*.conf" -o -name "*.template" -o -name "nginx.conf" \) | while read -r file; do
        if grep -q "8080" "$file"; then
            echo "Replacing port 8080 with $PORT in $file"
            sed -i "s/8080/$PORT/g" "$file"
        fi
    done
    
    echo "Nginx port updates complete."
else
    echo "No PORT environment variable defined, defaulting Nginx to port 8080"
fi
