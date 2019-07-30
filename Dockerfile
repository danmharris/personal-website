FROM ubuntu
RUN apt-get update && apt-get install hugo
COPY ./src/ /usr/src
WORKDIR /usr/src
RUN hugo

FROM nginx:alpine
COPY ./etc/nginx/conf.d/default.conf /etc/nginx/conf.d
COPY --from=0 /usr/src/public /usr/share/nginx/html
