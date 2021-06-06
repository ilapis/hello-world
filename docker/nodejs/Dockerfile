FROM node:14

WORKDIR /var/www/html/

RUN npm install -g ws winston express ejs uuid peer path socket.io nodemon

CMD [ "nodemon", "server.js" ]
