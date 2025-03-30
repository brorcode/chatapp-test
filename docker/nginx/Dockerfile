FROM nginx:alpine

# Copy custom Nginx configuration file into the container's configuration directory.
COPY default.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
