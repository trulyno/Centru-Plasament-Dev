# Use the official nginx image as base
FROM nginx:alpine

# Copy site files from the local 'site' folder to nginx html directory
COPY site/ /usr/share/nginx/html/

# Expose port 80
EXPOSE 80

# Start nginx (this is the default command, but including for clarity)
CMD ["nginx", "-g", "daemon off;"]
