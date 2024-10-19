FROM node:18.15.0

WORKDIR /app
COPY package.json /app
COPY package-lock.json /app
COPY src /app/src

RUN npm i

EXPOSE 3000
CMD ["npm", "start"]