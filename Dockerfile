FROM php:8-apache
ENV TZ=Asia/Tokyo
#ENV http_proxy=http://aj740821:ts4027@proxy.intra.oki.co.jp:8080
#ENV https_proxy=http://aj740821:ts4027@proxy.intra.oki.co.jp:8080
#RUN curl http://www-jyoki.oii.oki.co.jp/infra/proxy/download/SSL_PROXY.cer > /usr/local/share/ca-certificates/OKI_SSL_PROXY.crt
ENV http_proxy=http://wpc5004.cs.oki.co.jp:8888
ENV https_proxy=http://wpc5004.cs.oki.co.jp:8888
COPY mitmproxy-ca-cert.pem /usr/local/share/ca-certificates/mitmproxy.crt
RUN update-ca-certificates
RUN apt-get update && apt-get install -y libyaml-dev vim curl git tzdata
COPY  --from=composer /usr/bin/composer /usr/bin/composer
COPY src /var/www/html
RUN composer install
