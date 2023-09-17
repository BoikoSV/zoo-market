FROM node:14.21.3-alpine AS base
WORKDIR /usr/src
COPY package.* ./
RUN npm install
COPY . .

FROM base AS build
RUN npm run build

FROM nginx:1.25.1-alpine AS prod
COPY --from=build /usr/src/dist /usr/share/nginx/html
COPY nginx.conf /etc/nginx/nginx.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
