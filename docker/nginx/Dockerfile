FROM nginx:alpine

# Expose User ID
ARG UID
EXPOSE $UID

# Create user
RUN adduser -u ${UID} --disabled-password --gecos "" appuser

# Copy nginx config file
COPY default.conf /etc/nginx/conf.d/
