FROM nginx:1

COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./core.conf /etc/nginx/sites-available/core.conf

RUN rm -f /etc/nginx/conf.d/default.conf && \
    mkdir /etc/nginx/sites-enabled && \
    ln -s /etc/nginx/sites-available/core.conf /etc/nginx/sites-enabled/core.conf
