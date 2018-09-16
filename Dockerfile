FROM nginx:alpine
COPY ./etc/nginx/conf.d/default.conf /etc/nginx/conf.d
COPY . /usr/share/nginx/html
