# Containerized ProcessWire

This fork of ProcessWire is a downstream repo which contains a Dockerfile intended to be the base for containerized ProcessWire deployments. The following files have been added:

- `Dockerfile`: used to create a lightweight Alpine + Nginx + PHP base image to which ProcessWire files are added
- `nginx.conf`: NGINX config
- `dockerstart.sh`: Docker start script
- `site/config.php`: ProcessWire site config designed to import variables from the container's environment
- `site/htaccess.txt`: Default site .htaccess file

Example site folders have been removed from this fork, as I do not intend to have this merged upstream.