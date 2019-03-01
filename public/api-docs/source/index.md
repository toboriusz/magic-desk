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
    -d '{"email":"SbXb4PeCQBn2nZg2","password":"TNb2XY7UYm0cAmhu","remember_me":true}'

```

```javascript
const url = new URL("http://localhost/api/auth/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "SbXb4PeCQBn2nZg2",
    "password": "TNb2XY7UYm0cAmhu",
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
{}
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
    -d '{"name":"cMDqnOkRI3EIk13Y","email":"vaegjW8jV85DgNJM","password":"fopmO9LyqdEG8RyF","password_confirmation":"NQF14w0nFWo7Lh1X"}'

```

```javascript
const url = new URL("http://localhost/api/auth/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "cMDqnOkRI3EIk13Y",
    "email": "vaegjW8jV85DgNJM",
    "password": "fopmO9LyqdEG8RyF",
    "password_confirmation": "NQF14w0nFWo7Lh1X"
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

<!-- START_10e1364dfe0421ea840f637dcd936361 -->
## Verify

Verify user email

> Example request:

```bash
curl -X POST "http://localhost/api/auth/verify-email" \
    -H "Content-Type: application/json" \
    -d '{"token":"bwNK2QosLjcA8uH8"}'

```

```javascript
const url = new URL("http://localhost/api/auth/verify-email");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "token": "bwNK2QosLjcA8uH8"
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
`POST api/auth/verify-email`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    token | string |  required  | Verify email token

<!-- END_10e1364dfe0421ea840f637dcd936361 -->

<!-- START_9a96b21e8d3bfa4fa5e60ba08c4e63b3 -->
## Password reset send

Send password reset email

> Example request:

```bash
curl -X POST "http://localhost/api/auth/password-reset/send" \
    -H "Content-Type: application/json" \
    -d '{"email":"IDeSNwOaB7PYRew6"}'

```

```javascript
const url = new URL("http://localhost/api/auth/password-reset/send");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "IDeSNwOaB7PYRew6"
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
    -d '{"token":"8jQkkdj2qcqkGHzN","password":"szCKSqFnVVqTxHGk"}'

```

```javascript
const url = new URL("http://localhost/api/auth/password-reset/update");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "token": "8jQkkdj2qcqkGHzN",
    "password": "szCKSqFnVVqTxHGk"
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

<!-- START_19ff1b6f8ce19d3c444e9b518e8f7160 -->
## Logout

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
user logout and revoke token

> Example request:

```bash
curl -X POST "http://localhost/api/auth/logout" 
```

```javascript
const url = new URL("http://localhost/api/auth/logout");

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

> Example response (200):

```json
{}
```

### HTTP Request
`POST api/auth/logout`


<!-- END_19ff1b6f8ce19d3c444e9b518e8f7160 -->

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
{}
```

### HTTP Request
`POST api/auth/refresh-token`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    remember_me | boolean |  optional  | optional Remember me option

<!-- END_0fb19b1537622281d045b3d0d4f606f0 -->


