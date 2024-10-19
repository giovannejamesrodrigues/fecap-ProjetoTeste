FROM node:18.15.0

WORKDIR /app

COPY public /app/public
COPY src /app/src
COPY package.json /app/package.json
COPY yarn.lock /app/yarn.lock

RUN yarn install --frozen-lockfile

EXPOSE 3000
CMD ["yarn", "start"]
