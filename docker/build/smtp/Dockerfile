FROM alpine:3.11

RUN apk --no-cache update && \
    apk --no-cache upgrade && \
    apk --no-cache add \
    postfix \
    vim

RUN sed -i -r 's/#inet_interfaces = all/'"inet_interfaces = all"'/g' /etc/postfix/main.cf \
    && echo "mynetworks = 127.0.0.0/8 172.16.0.0/12 192.168.0.0/16" >> /etc/postfix/main.cf \
    && echo "maillog_file = /dev/stdout" >> /etc/postfix/main.cf \
    && echo "smtpd_recipient_restrictions = permit_mynetworks,permit_sasl_authenticated,reject_unauth_destination" >> /etc/postfix/main.cf

EXPOSE 25

CMD ["postfix", "start-fg"]
