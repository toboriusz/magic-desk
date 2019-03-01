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
[Get Postman Collection](http://localhost/docs/collection.json)

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
    -d '{"email":"eR8CBjxovqDZRvmG","password":"cRqrzzgRMz0px9HI","remember_me":false}'

```

```javascript
const url = new URL("http://localhost/api/auth/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "eR8CBjxovqDZRvmG",
    "password": "cRqrzzgRMz0px9HI",
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
    -d '{"first_name":"s0skBbLxAZc7MRW9","last_name":"KK0ceJMHs2GQ96KT","email":"YeL6617B47ZFy0td","password":"Zolv58L4UnCxNstY","password_confirmation":"xHQ6xN850BXe6ZSQ"}'

```

```javascript
const url = new URL("http://localhost/api/auth/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "first_name": "s0skBbLxAZc7MRW9",
    "last_name": "KK0ceJMHs2GQ96KT",
    "email": "YeL6617B47ZFy0td",
    "password": "Zolv58L4UnCxNstY",
    "password_confirmation": "xHQ6xN850BXe6ZSQ"
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
    first_name | string |  required  | First name
    last_name | string |  required  | Last name
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
    -d '{"token":"Cz7E9Bm06lzBpCVs"}'

```

```javascript
const url = new URL("http://localhost/api/auth/verify");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "token": "Cz7E9Bm06lzBpCVs"
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
    -d '{"email":"Vl6dQvRnZES2dxuD"}'

```

```javascript
const url = new URL("http://localhost/api/auth/password-reset/send");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "Vl6dQvRnZES2dxuD"
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
    -d '{"token":"xZwDl1uhkZ77d1PQ","password":"tRh2w2bt6osrnxos"}'

```

```javascript
const url = new URL("http://localhost/api/auth/password-reset/update");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "token": "xZwDl1uhkZ77d1PQ",
    "password": "tRh2w2bt6osrnxos"
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

#general
<!-- START_0c068b4037fb2e47e71bd44bd36e3e2a -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X GET -G "http://localhost/oauth/authorize" 
```

```javascript
const url = new URL("http://localhost/oauth/authorize");

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

> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/authorize`


<!-- END_0c068b4037fb2e47e71bd44bd36e3e2a -->

<!-- START_e48cc6a0b45dd21b7076ab2c03908687 -->
## Approve the authorization request.

> Example request:

```bash
curl -X POST "http://localhost/oauth/authorize" 
```

```javascript
const url = new URL("http://localhost/oauth/authorize");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST oauth/authorize`


<!-- END_e48cc6a0b45dd21b7076ab2c03908687 -->

<!-- START_de5d7581ef1275fce2a229b6b6eaad9c -->
## Deny the authorization request.

> Example request:

```bash
curl -X DELETE "http://localhost/oauth/authorize" 
```

```javascript
const url = new URL("http://localhost/oauth/authorize");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE oauth/authorize`


<!-- END_de5d7581ef1275fce2a229b6b6eaad9c -->

<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X POST "http://localhost/oauth/token" 
```

```javascript
const url = new URL("http://localhost/oauth/token");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST oauth/token`


<!-- END_a09d20357336aa979ecd8e3972ac9168 -->

<!-- START_d6a56149547e03307199e39e03e12d1c -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```bash
curl -X GET -G "http://localhost/oauth/tokens" 
```

```javascript
const url = new URL("http://localhost/oauth/tokens");

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

> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/tokens`


<!-- END_d6a56149547e03307199e39e03e12d1c -->

<!-- START_a9a802c25737cca5324125e5f60b72a5 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE "http://localhost/oauth/tokens/{token_id}" 
```

```javascript
const url = new URL("http://localhost/oauth/tokens/{token_id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE oauth/tokens/{token_id}`


<!-- END_a9a802c25737cca5324125e5f60b72a5 -->

<!-- START_abe905e69f5d002aa7d26f433676d623 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```bash
curl -X POST "http://localhost/oauth/token/refresh" 
```

```javascript
const url = new URL("http://localhost/oauth/token/refresh");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST oauth/token/refresh`


<!-- END_abe905e69f5d002aa7d26f433676d623 -->

<!-- START_babcfe12d87b8708f5985e9d39ba8f2c -->
## Get all of the clients for the authenticated user.

> Example request:

```bash
curl -X GET -G "http://localhost/oauth/clients" 
```

```javascript
const url = new URL("http://localhost/oauth/clients");

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

> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/clients`


<!-- END_babcfe12d87b8708f5985e9d39ba8f2c -->

<!-- START_9eabf8d6e4ab449c24c503fcb42fba82 -->
## Store a new client.

> Example request:

```bash
curl -X POST "http://localhost/oauth/clients" 
```

```javascript
const url = new URL("http://localhost/oauth/clients");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST oauth/clients`


<!-- END_9eabf8d6e4ab449c24c503fcb42fba82 -->

<!-- START_784aec390a455073fc7464335c1defa1 -->
## Update the given client.

> Example request:

```bash
curl -X PUT "http://localhost/oauth/clients/{client_id}" 
```

```javascript
const url = new URL("http://localhost/oauth/clients/{client_id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`PUT oauth/clients/{client_id}`


<!-- END_784aec390a455073fc7464335c1defa1 -->

<!-- START_1f65a511dd86ba0541d7ba13ca57e364 -->
## Delete the given client.

> Example request:

```bash
curl -X DELETE "http://localhost/oauth/clients/{client_id}" 
```

```javascript
const url = new URL("http://localhost/oauth/clients/{client_id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE oauth/clients/{client_id}`


<!-- END_1f65a511dd86ba0541d7ba13ca57e364 -->

<!-- START_9e281bd3a1eb1d9eb63190c8effb607c -->
## Get all of the available scopes for the application.

> Example request:

```bash
curl -X GET -G "http://localhost/oauth/scopes" 
```

```javascript
const url = new URL("http://localhost/oauth/scopes");

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

> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/scopes`


<!-- END_9e281bd3a1eb1d9eb63190c8effb607c -->

<!-- START_9b2a7699ce6214a79e0fd8107f8b1c9e -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```bash
curl -X GET -G "http://localhost/oauth/personal-access-tokens" 
```

```javascript
const url = new URL("http://localhost/oauth/personal-access-tokens");

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

> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/personal-access-tokens`


<!-- END_9b2a7699ce6214a79e0fd8107f8b1c9e -->

<!-- START_a8dd9c0a5583742e671711f9bb3ee406 -->
## Create a new personal access token for the user.

> Example request:

```bash
curl -X POST "http://localhost/oauth/personal-access-tokens" 
```

```javascript
const url = new URL("http://localhost/oauth/personal-access-tokens");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`POST oauth/personal-access-tokens`


<!-- END_a8dd9c0a5583742e671711f9bb3ee406 -->

<!-- START_bae65df80fd9d72a01439241a9ea20d0 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE "http://localhost/oauth/personal-access-tokens/{token_id}" 
```

```javascript
const url = new URL("http://localhost/oauth/personal-access-tokens/{token_id}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE oauth/personal-access-tokens/{token_id}`


<!-- END_bae65df80fd9d72a01439241a9ea20d0 -->

<!-- START_ea4d1494980ef274bdceaad073a2d7b3 -->
## {all}
> Example request:

```bash
curl -X GET -G "http://localhost/{all}" 
```

```javascript
const url = new URL("http://localhost/{all}");

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
null
```

### HTTP Request
`GET {all}`


<!-- END_ea4d1494980ef274bdceaad073a2d7b3 -->


