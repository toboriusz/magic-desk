---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/api-docs/collection.json)

<!-- END_INFO -->

#Authentication

Application authentication
<!-- START_a925a8d22b3615f12fca79456d286859 -->
## Login

user login and get token

> Example request:

```bash
curl -X POST "http://localhost/api/auth/login" \
    -H "Content-Type: application/json" \
    -d '{"email":"Z7g57fpTly6iTibc","password":"mTzmY0mn3yqypmvc","remember_me":false}'

```

```javascript
const url = new URL("http://localhost/api/auth/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "Z7g57fpTly6iTibc",
    "password": "mTzmY0mn3yqypmvc",
    "remember_me": false
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "success": true,
    "message": "Zalogowano pomyślnie",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImYxZjU2ZTE0YWIwYjM2MWVmY2ZkMGFiNTQ5N2Q0YTcyM2I1MDY3YjJiMzNlNTYyMTQ2NzUxZDQzNmMzOTgzZWI3ZDk0OTY1MTAwY2QzN2U1In0.eyJhdWQiOiIxIiwianRpIjoiZjFmNTZlMTRhYjBiMzYxZWZjZmQwYWI1NDk3ZDRhNzIzYjUwNjdiMmIzM2U1NjIxNDY3NTFkNDM2YzM5ODNlYjdkOTQ5NjUxMDBjZDM3ZTUiLCJpYXQiOjE1MzkzNjU4NDQsIm5iZiI6MTUzOTM2NTg0NCwiZXhwIjoxNTcwOTAxODQ0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.TX8xj0yI_y-aVTDZApBWAwZ39ehacAbAkb5mJEF5fVks8iqy8Hz08FREJT3AcmU2iWYD0KlB_XjFXMi0uAuJgDr7BLWHbuQhzZCg4q1DLD3uv8HpnyqnthbYjVIbCfWtbikrz6HxzO3fl3wTEhGjf9YWCXkB-CmJDds0NNlOKoFYIvvVrY1sbKvziPZXN-6gD8YZwLt_cylIu2ypbw6UQcZc-VTyU8lPyJGI2v0PMLSmI66yfaWjODbuNzyyQlsUncIuHSuosW4CtxxQuzk4gutovMce8GYPrLvmTboLQf0VRdvl4sECZGTVVbFIMuavCWQpuIE_okL61DfOLgne8_5e0hFY4Y8xos_IS9g4ca6lqdg8_h3agi2pSrqZ9wBYpwcDyYdtkt5n-pIjspU_V4fP9gnPeSfAU53cwBQSOKS0lnvMudjj2CPvEQIgZhkMaHLBGzhySAfscCNz09TSjvqN_Cu1T4xpYK9OKqJGGbjVcJdMbvwexy9XjcT5F-9J5fhql-268p1VoUTbiIj2tHBBH4hGl9X4QDr0OtJR9pydJ8pAQDOxuu9bx6dC5nOBQAedv2CodsknfuPefsAsBXZD8GJeR59ih1wY6VlvmwhhTB9SVjJLhPkX_3FsDjq_Tc3YRUoV-WgZp3-rXvVpNAJwzv-KBS5mG6r__lltbnA",
        "token_expires_at": "2018-10-19 17:37:24"
    }
}
```

### HTTP Request
`POST api/auth/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | Email address
    password | string |  required  | Password
    remember_me | boolean |  optional  | optional Remember me option

<!-- END_a925a8d22b3615f12fca79456d286859 -->

<!-- START_2e1c96dcffcfe7e0eb58d6408f1d619e -->
## Register

Register new user account

> Example request:

```bash
curl -X POST "http://localhost/api/auth/register" \
    -H "Content-Type: application/json" \
    -d '{"name":"KgCjDrjkbdc57gn8","email":"PIObR0VMBfLdciZN","password":"A1ysu9tCCV7pyw37","password_confirmation":"PMUVhBvK5540uFKP"}'

```

```javascript
const url = new URL("http://localhost/api/auth/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "KgCjDrjkbdc57gn8",
    "email": "PIObR0VMBfLdciZN",
    "password": "A1ysu9tCCV7pyw37",
    "password_confirmation": "PMUVhBvK5540uFKP"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{}
```

### HTTP Request
`POST api/auth/register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | User Name
    email | email |  required  | Email address
    password | string |  required  | Password
    password_confirmation | string |  required  | Password confirmation

<!-- END_2e1c96dcffcfe7e0eb58d6408f1d619e -->

<!-- START_ab3ce89a5249d02e7d0c5bcab416e798 -->
## Verify

Verify user email

> Example request:

```bash
curl -X POST "http://localhost/api/auth/verify" \
    -H "Content-Type: application/json" \
    -d '{"token":"41pZ7kGuJtiTqo49"}'

```

```javascript
const url = new URL("http://localhost/api/auth/verify");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "token": "41pZ7kGuJtiTqo49"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{}
```

### HTTP Request
`POST api/auth/verify`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    token | string |  required  | Verify email token

<!-- END_ab3ce89a5249d02e7d0c5bcab416e798 -->

<!-- START_9a96b21e8d3bfa4fa5e60ba08c4e63b3 -->
## Password reset send

Send password reset email

> Example request:

```bash
curl -X POST "http://localhost/api/auth/password-reset/send" \
    -H "Content-Type: application/json" \
    -d '{"email":"fhcN5mvTZPGCXPXb"}'

```

```javascript
const url = new URL("http://localhost/api/auth/password-reset/send");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "fhcN5mvTZPGCXPXb"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "success": true,
    "message": "Link do resetowania hasła został wysłany",
    "data": []
}
```

### HTTP Request
`POST api/auth/password-reset/send`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | Email address

<!-- END_9a96b21e8d3bfa4fa5e60ba08c4e63b3 -->

<!-- START_ee4267d878c9ec4cc5fa23a1dc434548 -->
## Password reset update

Update user password

> Example request:

```bash
curl -X POST "http://localhost/api/auth/password-reset/update" \
    -H "Content-Type: application/json" \
    -d '{"token":"p2PDMBoZnhixCxKO","password":"P0OvPMCqG5IzJhsS"}'

```

```javascript
const url = new URL("http://localhost/api/auth/password-reset/update");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "token": "p2PDMBoZnhixCxKO",
    "password": "P0OvPMCqG5IzJhsS"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{}
```

### HTTP Request
`POST api/auth/password-reset/update`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    token | string |  required  | Password reset token
    password | string |  required  | Password confirmation

<!-- END_ee4267d878c9ec4cc5fa23a1dc434548 -->

<!-- START_16928cb8fc6adf2d9bb675d62a2095c5 -->
## Logout

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
user logout and revoke token

> Example request:

```bash
curl -X GET -G "http://localhost/api/auth/logout" 
```

```javascript
const url = new URL("http://localhost/api/auth/logout");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "success": true,
    "message": "Wylogowano pomyślnie",
    "data": []
}
```

### HTTP Request
`GET api/auth/logout`


<!-- END_16928cb8fc6adf2d9bb675d62a2095c5 -->

<!-- START_ff6d656b6d81a61adda963b8702034d2 -->
## User

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Get current logged in user

> Example request:

```bash
curl -X GET -G "http://localhost/api/auth/user" 
```

```javascript
const url = new URL("http://localhost/api/auth/user");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{}
```

### HTTP Request
`GET api/auth/user`


<!-- END_ff6d656b6d81a61adda963b8702034d2 -->

<!-- START_0fb19b1537622281d045b3d0d4f606f0 -->
## Refresh token

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Refresh token for current logged in user

> Example request:

```bash
curl -X POST "http://localhost/api/auth/refresh-token" \
    -H "Content-Type: application/json" \
    -d '{"remember_me":true}'

```

```javascript
const url = new URL("http://localhost/api/auth/refresh-token");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "remember_me": true
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "success": true,
    "message": "Nowy token został wygenerowany pomyślnie",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImYxZjU2ZTE0YWIwYjM2MWVmY2ZkMGFiNTQ5N2Q0YTcyM2I1MDY3YjJiMzNlNTYyMTQ2NzUxZDQzNmMzOTgzZWI3ZDk0OTY1MTAwY2QzN2U1In0.eyJhdWQiOiIxIiwianRpIjoiZjFmNTZlMTRhYjBiMzYxZWZjZmQwYWI1NDk3ZDRhNzIzYjUwNjdiMmIzM2U1NjIxNDY3NTFkNDM2YzM5ODNlYjdkOTQ5NjUxMDBjZDM3ZTUiLCJpYXQiOjE1MzkzNjU4NDQsIm5iZiI6MTUzOTM2NTg0NCwiZXhwIjoxNTcwOTAxODQ0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.TX8xj0yI_y-aVTDZApBWAwZ39ehacAbAkb5mJEF5fVks8iqy8Hz08FREJT3AcmU2iWYD0KlB_XjFXMi0uAuJgDr7BLWHbuQhzZCg4q1DLD3uv8HpnyqnthbYjVIbCfWtbikrz6HxzO3fl3wTEhGjf9YWCXkB-CmJDds0NNlOKoFYIvvVrY1sbKvziPZXN-6gD8YZwLt_cylIu2ypbw6UQcZc-VTyU8lPyJGI2v0PMLSmI66yfaWjODbuNzyyQlsUncIuHSuosW4CtxxQuzk4gutovMce8GYPrLvmTboLQf0VRdvl4sECZGTVVbFIMuavCWQpuIE_okL61DfOLgne8_5e0hFY4Y8xos_IS9g4ca6lqdg8_h3agi2pSrqZ9wBYpwcDyYdtkt5n-pIjspU_V4fP9gnPeSfAU53cwBQSOKS0lnvMudjj2CPvEQIgZhkMaHLBGzhySAfscCNz09TSjvqN_Cu1T4xpYK9OKqJGGbjVcJdMbvwexy9XjcT5F-9J5fhql-268p1VoUTbiIj2tHBBH4hGl9X4QDr0OtJR9pydJ8pAQDOxuu9bx6dC5nOBQAedv2CodsknfuPefsAsBXZD8GJeR59ih1wY6VlvmwhhTB9SVjJLhPkX_3FsDjq_Tc3YRUoV-WgZp3-rXvVpNAJwzv-KBS5mG6r__lltbnA",
        "token_expires_at": "2018-10-19 17:37:24"
    }
}
```

### HTTP Request
`POST api/auth/refresh-token`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    remember_me | boolean |  optional  | optional Remember me option

<!-- END_0fb19b1537622281d045b3d0d4f606f0 -->


