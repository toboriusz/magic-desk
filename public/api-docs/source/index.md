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
[Get Postman Collection](http://magic-desk.test/api-docs/collection.json)

<!-- END_INFO -->

#Authentication

Application authentication
<!-- START_a925a8d22b3615f12fca79456d286859 -->
## Login

technician login and get token

> Example request:

```bash
curl -X POST "http://magic-desk.test/api/auth/login" \
    -H "Content-Type: application/json" \
    -d '{"email":"zcI5OlorjCL2QN0S","password":"KPyAK9v1AHMdyWdF","remember_me":false}'

```

```javascript
const url = new URL("http://magic-desk.test/api/auth/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "zcI5OlorjCL2QN0S",
    "password": "KPyAK9v1AHMdyWdF",
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

Register new technician account

> Example request:

```bash
curl -X POST "http://magic-desk.test/api/auth/register" \
    -H "Content-Type: application/json" \
    -d '{"name":"i9hayHVZQl4iDIcj","email":"W34PhJV58iY6KDrX","password":"kgIdp82A2QgN7lYE","password_confirmation":"j62DEy3NnrdfmnIa"}'

```

```javascript
const url = new URL("http://magic-desk.test/api/auth/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "i9hayHVZQl4iDIcj",
    "email": "W34PhJV58iY6KDrX",
    "password": "kgIdp82A2QgN7lYE",
    "password_confirmation": "j62DEy3NnrdfmnIa"
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
    name | string |  required  | Technician Name
    email | email |  required  | Email address
    password | string |  required  | Password
    password_confirmation | string |  required  | Password confirmation

<!-- END_2e1c96dcffcfe7e0eb58d6408f1d619e -->

<!-- START_10e1364dfe0421ea840f637dcd936361 -->
## Verify

Verify technician email

> Example request:

```bash
curl -X POST "http://magic-desk.test/api/auth/verify-email" \
    -H "Content-Type: application/json" \
    -d '{"token":"sNKsMo02tVdhy341"}'

```

```javascript
const url = new URL("http://magic-desk.test/api/auth/verify-email");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "token": "sNKsMo02tVdhy341"
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
curl -X POST "http://magic-desk.test/api/auth/password-reset/send" \
    -H "Content-Type: application/json" \
    -d '{"email":"6WFqZCyYL5o1zVN2"}'

```

```javascript
const url = new URL("http://magic-desk.test/api/auth/password-reset/send");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "6WFqZCyYL5o1zVN2"
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

Update technician password

> Example request:

```bash
curl -X POST "http://magic-desk.test/api/auth/password-reset/update" \
    -H "Content-Type: application/json" \
    -d '{"token":"hnJUQABv7qDBmlUz","password":"TDYy1cagqs1Z7pn1"}'

```

```javascript
const url = new URL("http://magic-desk.test/api/auth/password-reset/update");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "token": "hnJUQABv7qDBmlUz",
    "password": "TDYy1cagqs1Z7pn1"
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
technician logout and revoke token

> Example request:

```bash
curl -X POST "http://magic-desk.test/api/auth/logout" 
```

```javascript
const url = new URL("http://magic-desk.test/api/auth/logout");

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
## Technician

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Get current logged in technician

> Example request:

```bash
curl -X GET -G "http://magic-desk.test/api/auth/user" 
```

```javascript
const url = new URL("http://magic-desk.test/api/auth/user");

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
Refresh token for current logged in technician

> Example request:

```bash
curl -X POST "http://magic-desk.test/api/auth/refresh-token" \
    -H "Content-Type: application/json" \
    -d '{"remember_me":true}'

```

```javascript
const url = new URL("http://magic-desk.test/api/auth/refresh-token");

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

#general
<!-- START_4b94bd9de767d708f579234b4b4bc7de -->
## List

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Get list of all sites

> Example request:

```bash
curl -X GET -G "http://magic-desk.test/api/sites" 
```

```javascript
const url = new URL("http://magic-desk.test/api/sites");

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
[]
```

### HTTP Request
`GET api/sites`


<!-- END_4b94bd9de767d708f579234b4b4bc7de -->

<!-- START_0ebc8c1e23f5fffe2bde49996df7e6a8 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://magic-desk.test/api/sites" 
```

```javascript
const url = new URL("http://magic-desk.test/api/sites");

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
`POST api/sites`


<!-- END_0ebc8c1e23f5fffe2bde49996df7e6a8 -->

<!-- START_d18f5abe5948407c418c73a9712e0429 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET -G "http://magic-desk.test/api/sites/{site}" 
```

```javascript
const url = new URL("http://magic-desk.test/api/sites/{site}");

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
    "success": false,
    "message": "You are not authorized to do this action",
    "data": {
        "exception_data": {
            "message": "Unauthenticated.",
            "exception": "Illuminate\\Auth\\AuthenticationException",
            "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Auth\/Middleware\/Authenticate.php",
            "line": 67,
            "trace": [
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Auth\/Middleware\/Authenticate.php",
                    "line": 41,
                    "function": "authenticate",
                    "class": "Illuminate\\Auth\\Middleware\\Authenticate",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Illuminate\\Auth\\Middleware\\Authenticate",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
                    "line": 41,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
                    "line": 58,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 104,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
                    "line": 684,
                    "function": "then",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
                    "line": 659,
                    "function": "runRouteWithinStack",
                    "class": "Illuminate\\Routing\\Router",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
                    "line": 625,
                    "function": "runRoute",
                    "class": "Illuminate\\Routing\\Router",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
                    "line": 614,
                    "function": "dispatchToRoute",
                    "class": "Illuminate\\Routing\\Router",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
                    "line": 176,
                    "function": "dispatch",
                    "class": "Illuminate\\Routing\\Router",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 30,
                    "function": "Illuminate\\Foundation\\Http\\{closure}",
                    "class": "Illuminate\\Foundation\\Http\\Kernel",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
                    "line": 57,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Fideloper\\Proxy\\TrustProxies",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
                    "line": 31,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
                    "line": 31,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
                    "line": 27,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php",
                    "line": 62,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/barryvdh\/laravel-cors\/src\/HandlePreflight.php",
                    "line": 29,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 163,
                    "function": "handle",
                    "class": "Barryvdh\\Cors\\HandlePreflight",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
                    "line": 53,
                    "function": "Illuminate\\Pipeline\\{closure}",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
                    "line": 104,
                    "function": "Illuminate\\Routing\\{closure}",
                    "class": "Illuminate\\Routing\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
                    "line": 151,
                    "function": "then",
                    "class": "Illuminate\\Pipeline\\Pipeline",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
                    "line": 116,
                    "function": "sendRequestThroughRouter",
                    "class": "Illuminate\\Foundation\\Http\\Kernel",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseStrategies\/ResponseCallStrategy.php",
                    "line": 275,
                    "function": "handle",
                    "class": "Illuminate\\Foundation\\Http\\Kernel",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseStrategies\/ResponseCallStrategy.php",
                    "line": 259,
                    "function": "callLaravelRoute",
                    "class": "Mpociot\\ApiDoc\\Tools\\ResponseStrategies\\ResponseCallStrategy",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseStrategies\/ResponseCallStrategy.php",
                    "line": 36,
                    "function": "makeApiCall",
                    "class": "Mpociot\\ApiDoc\\Tools\\ResponseStrategies\\ResponseCallStrategy",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseResolver.php",
                    "line": 49,
                    "function": "__invoke",
                    "class": "Mpociot\\ApiDoc\\Tools\\ResponseStrategies\\ResponseCallStrategy",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/ResponseResolver.php",
                    "line": 68,
                    "function": "resolve",
                    "class": "Mpociot\\ApiDoc\\Tools\\ResponseResolver",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Tools\/Generator.php",
                    "line": 57,
                    "function": "getResponse",
                    "class": "Mpociot\\ApiDoc\\Tools\\ResponseResolver",
                    "type": "::"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Commands\/GenerateDocumentation.php",
                    "line": 201,
                    "function": "processRoute",
                    "class": "Mpociot\\ApiDoc\\Tools\\Generator",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Commands\/GenerateDocumentation.php",
                    "line": 59,
                    "function": "processRoutes",
                    "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
                    "type": "->"
                },
                {
                    "function": "handle",
                    "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
                    "line": 29,
                    "function": "call_user_func_array"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
                    "line": 87,
                    "function": "Illuminate\\Container\\{closure}",
                    "class": "Illuminate\\Container\\BoundMethod",
                    "type": "::"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
                    "line": 31,
                    "function": "callBoundMethod",
                    "class": "Illuminate\\Container\\BoundMethod",
                    "type": "::"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
                    "line": 572,
                    "function": "call",
                    "class": "Illuminate\\Container\\BoundMethod",
                    "type": "::"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
                    "line": 183,
                    "function": "call",
                    "class": "Illuminate\\Container\\Container",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/symfony\/console\/Command\/Command.php",
                    "line": 255,
                    "function": "execute",
                    "class": "Illuminate\\Console\\Command",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
                    "line": 170,
                    "function": "run",
                    "class": "Symfony\\Component\\Console\\Command\\Command",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/symfony\/console\/Application.php",
                    "line": 901,
                    "function": "run",
                    "class": "Illuminate\\Console\\Command",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/symfony\/console\/Application.php",
                    "line": 262,
                    "function": "doRunCommand",
                    "class": "Symfony\\Component\\Console\\Application",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/symfony\/console\/Application.php",
                    "line": 145,
                    "function": "doRun",
                    "class": "Symfony\\Component\\Console\\Application",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
                    "line": 89,
                    "function": "run",
                    "class": "Symfony\\Component\\Console\\Application",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
                    "line": 122,
                    "function": "run",
                    "class": "Illuminate\\Console\\Application",
                    "type": "->"
                },
                {
                    "file": "\/mnt\/c\/projects\/magic-desk\/artisan",
                    "line": 37,
                    "function": "handle",
                    "class": "Illuminate\\Foundation\\Console\\Kernel",
                    "type": "->"
                }
            ]
        }
    }
}
```

### HTTP Request
`GET api/sites/{site}`


<!-- END_d18f5abe5948407c418c73a9712e0429 -->

<!-- START_773c9bdb2e712908dcb18a7159ba29ec -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://magic-desk.test/api/sites/{site}" 
```

```javascript
const url = new URL("http://magic-desk.test/api/sites/{site}");

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
`PUT api/sites/{site}`

`PATCH api/sites/{site}`


<!-- END_773c9bdb2e712908dcb18a7159ba29ec -->

<!-- START_5d642e3a724d019171d9753fe202f9b6 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://magic-desk.test/api/sites/{site}" 
```

```javascript
const url = new URL("http://magic-desk.test/api/sites/{site}");

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
`DELETE api/sites/{site}`


<!-- END_5d642e3a724d019171d9753fe202f9b6 -->


