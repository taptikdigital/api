<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel Taptik API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://taptik-local-api/";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.1.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.1.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticate" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticate">
                    <a href="#authenticate">Authenticate</a>
                </li>
                                    <ul id="tocify-subheader-authenticate" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authenticate-POSTapi-v1-login">
                                <a href="#authenticate-POSTapi-v1-login">login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authenticate-POSTapi-v1-refresh">
                                <a href="#authenticate-POSTapi-v1-refresh">refresh</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authenticate-POSTapi-v1-logout">
                                <a href="#authenticate-POSTapi-v1-logout">logout</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-dashboard" class="tocify-header">
                <li class="tocify-item level-1" data-unique="dashboard">
                    <a href="#dashboard">Dashboard</a>
                </li>
                                    <ul id="tocify-subheader-dashboard" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="dashboard-POSTapi-v1-get-project">
                                <a href="#dashboard-POSTapi-v1-get-project">getProject</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="dashboard-POSTapi-v1-get-dashboard">
                                <a href="#dashboard-POSTapi-v1-get-dashboard">getDashboard</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="dashboard-POSTapi-v1-get-dashboard-report">
                                <a href="#dashboard-POSTapi-v1-get-dashboard-report">getDashboardReport</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-user-profile-related" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-profile-related">
                    <a href="#user-profile-related">User Profile Related</a>
                </li>
                                    <ul id="tocify-subheader-user-profile-related" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="user-profile-related-POSTapi-v1-get-user-profile">
                                <a href="#user-profile-related-POSTapi-v1-get-user-profile">getUserProfile</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: June 14, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://taptik-local-api/</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="authenticate">Authenticate</h1>

    <p>APIs for managing all user's authentication related like login, refresh &amp; logout</p>

                                <h2 id="authenticate-POSTapi-v1-login">login</h2>

<p>
</p>

<p>If everything is okay, you'll get a <code>200</code> OK response with data.</p>
<p>Otherwise, the request will fail with a <code>422</code> error.</p>
<aside class="notice">basepath/api/v1/login</aside>

<span id="example-requests-POSTapi-v1-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://taptik-local-api/api/v1/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"+-0pBNvYgxwmi\\/#iw\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://taptik-local-api/api/v1/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "password": "+-0pBNvYgxwmi\/#iw"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;token_created_at&quot;: &quot;11-04-2025 22:26:56&quot;,
    &quot;access_token&quot;: &quot;eyJ0ekrjkgkdgjdfg9g.....&quot;,
    &quot;token_type&quot;: &quot;bearer&quot;,
    &quot;expires_in&quot;: 3600,
    &quot;refresh_expires_in&quot;: 1209600,
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Test User&quot;,
        &quot;email&quot;: &quot;test@taptik.in&quot;,
        &quot;mobile&quot;: &quot;9876543212&quot;,
        &quot;parentId&quot;: null,
        &quot;email_verify_at&quot;: null,
        &quot;mobile_verify_at&quot;: null,
        &quot;subscription_id&quot;: 2,
        &quot;free_plan_expire_at&quot;: &quot;2025-03-15&quot;,
        &quot;subscription&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Basic&quot;,
            &quot;slug&quot;: &quot;basic&quot;
        },
        &quot;user_active_subscription&quot;: null
    },
    &quot;subscription&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Basic&quot;,
        &quot;slug&quot;: &quot;basic&quot;
    },
    &quot;activePlan&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;token_created_at&quot;: &quot;11-04-2025 22:28:25&quot;,
    &quot;access_token&quot;: &quot;eyJyrtutyuPU......&quot;,
    &quot;token_type&quot;: &quot;bearer&quot;,
    &quot;expires_in&quot;: 3600,
    &quot;refresh_expires_in&quot;: 1209600,
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Test User&quot;,
        &quot;email&quot;: &quot;test@taptik.in&quot;,
        &quot;mobile&quot;: &quot;9876543212&quot;,
        &quot;parentId&quot;: null,
        &quot;email_verify_at&quot;: null,
        &quot;mobile_verify_at&quot;: null,
        &quot;subscription_id&quot;: 2,
        &quot;free_plan_expire_at&quot;: &quot;2025-03-15&quot;,
        &quot;subscription&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Basic&quot;,
            &quot;slug&quot;: &quot;basic&quot;
        },
        &quot;user_active_subscription&quot;: {
            &quot;id&quot;: 5,
            &quot;subscription_status&quot;: &quot;active&quot;,
            &quot;next_payment_date&quot;: null,
            &quot;created_at&quot;: &quot;16-Mar-2025 06:45:11 AM&quot;
        }
    },
    &quot;subscription&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Basic&quot;,
        &quot;slug&quot;: &quot;basic&quot;
    },
    &quot;activePlan&quot;: {
        &quot;id&quot;: 5,
        &quot;subscription_status&quot;: &quot;active&quot;,
        &quot;next_payment_date&quot;: null,
        &quot;created_at&quot;: &quot;16-Mar-2025 06:45:11 AM&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;email&quot;: [
        &quot;The email field is required.&quot;
    ],
    &quot;password&quot;: [
        &quot;The password field is required.&quot;
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-login" data-method="POST"
      data-path="api/v1/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-login"
                    onclick="tryItOut('POSTapi-v1-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-login"
                    onclick="cancelTryOut('POSTapi-v1-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-login"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-login"
               value="+-0pBNvYgxwmi/#iw"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>+-0pBNvYgxwmi/#iw</code></p>
        </div>
        </form>

                    <h2 id="authenticate-POSTapi-v1-refresh">refresh</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>If everything is okay, you'll get a <code>200</code> OK response with data.</p>
<p>Otherwise, the request will fail with a <code>422</code> and <code>500</code> error.</p>
<aside class="notice">basepath/api/v1/refresh</aside>

<span id="example-requests-POSTapi-v1-refresh">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://taptik-local-api/api/v1/refresh" \
    --header "Authorization: Bearer _token required" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://taptik-local-api/api/v1/refresh"
);

const headers = {
    "Authorization": "Bearer _token required",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-refresh">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;token_created_at&quot;: &quot;11-04-2025 22:28:25&quot;,
    &quot;access_token&quot;: &quot;eyJyrtutyuPU......&quot;,
    &quot;token_type&quot;: &quot;bearer&quot;,
    &quot;expires_in&quot;: 3600,
    &quot;refresh_expires_in&quot;: 1209600,
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Test User&quot;,
        &quot;email&quot;: &quot;test@taptik.in&quot;,
        &quot;mobile&quot;: &quot;9876543212&quot;,
        &quot;parentId&quot;: null,
        &quot;email_verify_at&quot;: null,
        &quot;mobile_verify_at&quot;: null,
        &quot;subscription_id&quot;: 2,
        &quot;free_plan_expire_at&quot;: &quot;2025-03-15&quot;,
        &quot;subscription&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Basic&quot;,
            &quot;slug&quot;: &quot;basic&quot;
        },
        &quot;user_active_subscription&quot;: {
            &quot;id&quot;: 5,
            &quot;subscription_status&quot;: &quot;active&quot;,
            &quot;next_payment_date&quot;: null,
            &quot;created_at&quot;: &quot;16-Mar-2025 06:45:11 AM&quot;
        }
    },
    &quot;subscription&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Basic&quot;,
        &quot;slug&quot;: &quot;basic&quot;
    },
    &quot;activePlan&quot;: {
        &quot;id&quot;: 5,
        &quot;subscription_status&quot;: &quot;active&quot;,
        &quot;next_payment_date&quot;: null,
        &quot;created_at&quot;: &quot;16-Mar-2025 06:45:11 AM&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;error&quot;: &quot;Token not provided&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
&quot;message&quot;: &quot;Could not decode token: Error while decoding from Base64Url, invalid base64 characters detected&quot;,
&quot;exception&quot;: &quot;PHPOpenSourceSaver\\JWTAuth\\Exceptions\\TokenInvalidException&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-refresh" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-refresh"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-refresh"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-refresh" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-refresh">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-refresh" data-method="POST"
      data-path="api/v1/refresh"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-refresh', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-refresh"
                    onclick="tryItOut('POSTapi-v1-refresh');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-refresh"
                    onclick="cancelTryOut('POSTapi-v1-refresh');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-refresh"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/refresh</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-refresh"
               value="Bearer _token required"
               data-component="header">
    <br>
<p>Example: <code>Bearer _token required</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-refresh"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-refresh"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authenticate-POSTapi-v1-logout">logout</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>If everything is okay, you'll get a <code>200</code> OK response with data.</p>
<p>Otherwise, the request will fail with a <code>401</code> and <code>500</code> error,</p>
<aside class="notice">basepath/api/v1/logout</aside>

<span id="example-requests-POSTapi-v1-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://taptik-local-api/api/v1/logout" \
    --header "Authorization: Bearer _token required" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://taptik-local-api/api/v1/logout"
);

const headers = {
    "Authorization": "Bearer _token required",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User successfully signed out&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;status_code&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated...&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
&quot;message&quot;: &quot;Could not decode token: Error while decoding from Base64Url, invalid base64 characters detected&quot;,
&quot;exception&quot;: &quot;PHPOpenSourceSaver\\JWTAuth\\Exceptions\\TokenInvalidException&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-logout" data-method="POST"
      data-path="api/v1/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-logout"
                    onclick="tryItOut('POSTapi-v1-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-logout"
                    onclick="cancelTryOut('POSTapi-v1-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-logout"
               value="Bearer _token required"
               data-component="header">
    <br>
<p>Example: <code>Bearer _token required</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="dashboard">Dashboard</h1>

    <p>APIs for managing all dashboard related</p>

                                <h2 id="dashboard-POSTapi-v1-get-project">getProject</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>If everything is okay, you'll get a <code>200</code> OK response with data.</p>
<p>Otherwise, the request will fail with a <code>404</code> error, and Profile not found and token related response...</p>
<aside class="notice">basepath/api/v1/get-project</aside>

<span id="example-requests-POSTapi-v1-get-project">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://taptik-local-api/api/v1/get-project" \
    --header "Authorization: Bearer _token required" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://taptik-local-api/api/v1/get-project"
);

const headers = {
    "Authorization": "Bearer _token required",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-get-project">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;status_code&quot;: 200,
    &quot;message&quot;: &quot;Successfully list get...&quot;,
    &quot;data&quot;: {
        &quot;total_count&quot;: 1,
        &quot;collection&quot;: {
            &quot;current_page&quot;: 1,
            &quot;data&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;user_id&quot;: 1,
                    &quot;industry_id&quot;: 1,
                    &quot;name&quot;: &quot;AdsProject&quot;,
                    &quot;slug&quot;: &quot;adsproject&quot;,
                    &quot;whatsapp_number&quot;: &quot;9876543212&quot;,
                    &quot;current_status&quot;: &quot;created&quot;,
                    &quot;created_at&quot;: &quot;19-Nov-2024 06:48:10 AM&quot;,
                    &quot;industry&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;Advertisement&quot;,
                        &quot;slug&quot;: &quot;advertisement&quot;
                    }
                }
            ],
            &quot;first_page_url&quot;: &quot;BASE_URL/api/v1/get-project?page=1&quot;,
            &quot;from&quot;: 1,
            &quot;next_page_url&quot;: null,
            &quot;path&quot;: &quot;BASE_URL/api/v1/get-project&quot;,
            &quot;per_page&quot;: 3,
            &quot;prev_page_url&quot;: null,
            &quot;to&quot;: 1
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 401,
    &quot;message&quot;: &quot;Invalid or expired token&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;status_code&quot;: 404,
    &quot;message&quot;: &quot;Data not found...&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 422,
    &quot;message&quot;: &quot;Token not provided&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-get-project" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-get-project"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-get-project"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-get-project" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-get-project">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-get-project" data-method="POST"
      data-path="api/v1/get-project"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-get-project', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-get-project"
                    onclick="tryItOut('POSTapi-v1-get-project');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-get-project"
                    onclick="cancelTryOut('POSTapi-v1-get-project');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-get-project"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/get-project</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-get-project"
               value="Bearer _token required"
               data-component="header">
    <br>
<p>Example: <code>Bearer _token required</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-get-project"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-get-project"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="dashboard-POSTapi-v1-get-dashboard">getDashboard</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>If everything is okay, you'll get a <code>200</code> OK response with data.</p>
<p>Otherwise, the request will fail with a <code>404</code> error, and Profile not found and token related response...</p>
<p>EX
{
&quot;project_id&quot;:1
}</p>
<aside class="notice">basepath/api/v1/get-dashboard</aside>

<span id="example-requests-POSTapi-v1-get-dashboard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://taptik-local-api/api/v1/get-dashboard" \
    --header "Authorization: Bearer _token required" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"*project_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://taptik-local-api/api/v1/get-dashboard"
);

const headers = {
    "Authorization": "Bearer _token required",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "*project_id": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-get-dashboard">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;status_code&quot;: 200,
    &quot;message&quot;: &quot;Successfully data get...&quot;,
    &quot;data&quot;: {
        &quot;active_plan&quot;: {
            &quot;id&quot;: 5,
            &quot;subscription_status&quot;: &quot;active&quot;,
            &quot;next_payment_date&quot;: null
        },
        &quot;profile&quot;: {
            &quot;id&quot;: 2,
            &quot;profile_picture&quot;: &quot;PATH/profiles/468136505_2121024421690080_4247705420565344900_n.jpg&quot;,
            &quot;description&quot;: &quot;All types of medical related information&quot;,
            &quot;address&quot;: &quot;Rahat Road karim chak&quot;,
            &quot;email&quot;: &quot;hello@medlifeinfinity.com&quot;,
            &quot;vertical&quot;: &quot;HEALTH&quot;,
            &quot;full_vertical&quot;: &quot;Medical and Health&quot;,
            &quot;about&quot;: &quot;#medical #chemist&quot;,
            &quot;websites&quot;: &quot;https://www.medlifeinfinity.com/&quot;
        },
        &quot;configuration&quot;: {
            &quot;id&quot;: 2,
            &quot;whatsapp_business_account_id&quot;: &quot;509467322246054&quot;,
            &quot;phone_number_id&quot;: &quot;520516084470925&quot;,
            &quot;display_phone_number&quot;: &quot;918544547427&quot;,
            &quot;business_id&quot;: &quot;1800111597189501&quot;,
            &quot;permanent_access_token&quot;: &quot;EAAPAzbngQ3EBO6IRNdq....Ac54q8I4b1m&quot;,
            &quot;phone_no_pin&quot;: &quot;n/a&quot;,
            &quot;phone_number_status&quot;: &quot;n/a&quot;,
            &quot;wba_status&quot;: &quot;connected&quot;,
            &quot;verified_name&quot;: &quot;MedLife&quot;,
            &quot;quality_rating&quot;: &quot;High&quot;,
            &quot;messaging_limit&quot;: &quot;250&quot;,
            &quot;current_limit_tier&quot;: &quot;TIER_250&quot;,
            &quot;max_daily_conversation_per_phone&quot;: null,
            &quot;max_phone_numbers_per_business&quot;: null,
            &quot;code_verification_status&quot;: null,
            &quot;profile_updated&quot;: &quot;no&quot;,
            &quot;health_status&quot;: &quot;LIMITED&quot;,
            &quot;meta_payment_configuration&quot;: &quot;no&quot;,
            &quot;meta_gst_added&quot;: &quot;no&quot;,
            &quot;current_status&quot;: &quot;pending&quot;,
            &quot;configuration_health_status_entities&quot;: [
                {
                    &quot;id&quot;: 5,
                    &quot;configuration_id&quot;: 2,
                    &quot;entity_id&quot;: &quot;520516084470925&quot;,
                    &quot;entity_type&quot;: &quot;PHONE_NUMBER&quot;,
                    &quot;entity_status&quot;: &quot;LIMITED&quot;,
                    &quot;additional_info&quot;: &quot;[\&quot;Your display name has not been approved yet. Your message limit will increase after the display name is approved.\&quot;]&quot;,
                    &quot;errors&quot;: null
                },
                {
                    &quot;id&quot;: 6,
                    &quot;configuration_id&quot;: 2,
                    &quot;entity_id&quot;: &quot;509467322246054&quot;,
                    &quot;entity_type&quot;: &quot;WABA&quot;,
                    &quot;entity_status&quot;: &quot;AVAILABLE&quot;,
                    &quot;additional_info&quot;: null,
                    &quot;errors&quot;: null
                },
                {
                    &quot;id&quot;: 7,
                    &quot;configuration_id&quot;: 2,
                    &quot;entity_id&quot;: &quot;1800111597189501&quot;,
                    &quot;entity_type&quot;: &quot;BUSINESS&quot;,
                    &quot;entity_status&quot;: &quot;LIMITED&quot;,
                    &quot;additional_info&quot;: null,
                    &quot;errors&quot;: &quot;[{\&quot;error_code\&quot;: 141010, \&quot;error_description\&quot;: \&quot;The Business has not passed business verification.\&quot;, \&quot;possible_solution\&quot;: \&quot;Visit business settings and start or resolve the business verification request.\&quot;}]&quot;
                }
            ]
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;status_code&quot;: 200,
    &quot;message&quot;: &quot;Successfully data get...&quot;,
    &quot;data&quot;: {
        &quot;active_plan&quot;: [],
        &quot;profile&quot;: {
            &quot;id&quot;: 2,
            &quot;profile_picture&quot;: &quot;profiles/468136505_2121024421690080_4247705420565344900_n.jpg&quot;,
            &quot;description&quot;: &quot;All types of medical related information&quot;,
            &quot;address&quot;: &quot;Rahat Road karim chak&quot;,
            &quot;email&quot;: &quot;hello@medlifeinfinity.com&quot;,
            &quot;vertical&quot;: &quot;HEALTH&quot;,
            &quot;full_vertical&quot;: &quot;Medical and Health&quot;,
            &quot;about&quot;: &quot;#medical #chemist&quot;,
            &quot;websites&quot;: &quot;https://www.medlifeinfinity.com/&quot;
        },
        &quot;configuration&quot;: {
            &quot;id&quot;: 2,
            &quot;whatsapp_business_account_id&quot;: &quot;509467322246054&quot;,
            &quot;phone_number_id&quot;: &quot;520516084470925&quot;,
            &quot;display_phone_number&quot;: &quot;918544547427&quot;,
            &quot;business_id&quot;: &quot;1800111597189501&quot;,
            &quot;permanent_access_token&quot;: &quot;EAAPAzbngQ3EBO6IRNdqlIOGCN7DyKcweTzSiXTbiartnSFBIM7ZBUNeEo7seLYLeafKpnlnJ1kZAgT4ar9LiMZAEcJ6EJ6UISRC4NrHMZAgetzrvWO1PPsgSMeJwOVJNdm5LExVAusNRIOHEHBgdesyS7fynl8smoQ6SLXE99sLslkp9Q3Ysj6IGtmMM4B9vrv55rxOXGIDGlbEQMDAZAXtbYOb0o3ZC3a4IZCIXZCDMdRbpZCCr8QZAc54q8I4b1m&quot;,
            &quot;phone_no_pin&quot;: &quot;n/a&quot;,
            &quot;phone_number_status&quot;: &quot;n/a&quot;,
            &quot;wba_status&quot;: &quot;connected&quot;,
            &quot;verified_name&quot;: &quot;MedLife&quot;,
            &quot;quality_rating&quot;: &quot;High&quot;,
            &quot;messaging_limit&quot;: &quot;250&quot;,
            &quot;current_limit_tier&quot;: &quot;TIER_250&quot;,
            &quot;max_daily_conversation_per_phone&quot;: null,
            &quot;max_phone_numbers_per_business&quot;: null,
            &quot;code_verification_status&quot;: null,
            &quot;profile_updated&quot;: &quot;no&quot;,
            &quot;health_status&quot;: &quot;LIMITED&quot;,
            &quot;meta_payment_configuration&quot;: &quot;no&quot;,
            &quot;meta_gst_added&quot;: &quot;no&quot;,
            &quot;current_status&quot;: &quot;pending&quot;,
            &quot;configuration_health_status_entities&quot;: [
                {
                    &quot;id&quot;: 5,
                    &quot;configuration_id&quot;: 2,
                    &quot;entity_id&quot;: &quot;520516084470925&quot;,
                    &quot;entity_type&quot;: &quot;PHONE_NUMBER&quot;,
                    &quot;entity_status&quot;: &quot;LIMITED&quot;,
                    &quot;additional_info&quot;: &quot;[\&quot;Your display name has not been approved yet. Your message limit will increase after the display name is approved.\&quot;]&quot;,
                    &quot;errors&quot;: null
                },
                {
                    &quot;id&quot;: 6,
                    &quot;configuration_id&quot;: 2,
                    &quot;entity_id&quot;: &quot;509467322246054&quot;,
                    &quot;entity_type&quot;: &quot;WABA&quot;,
                    &quot;entity_status&quot;: &quot;AVAILABLE&quot;,
                    &quot;additional_info&quot;: null,
                    &quot;errors&quot;: null
                },
                {
                    &quot;id&quot;: 7,
                    &quot;configuration_id&quot;: 2,
                    &quot;entity_id&quot;: &quot;1800111597189501&quot;,
                    &quot;entity_type&quot;: &quot;BUSINESS&quot;,
                    &quot;entity_status&quot;: &quot;LIMITED&quot;,
                    &quot;additional_info&quot;: null,
                    &quot;errors&quot;: &quot;[{\&quot;error_code\&quot;: 141010, \&quot;error_description\&quot;: \&quot;The Business has not passed business verification.\&quot;, \&quot;possible_solution\&quot;: \&quot;Visit business settings and start or resolve the business verification request.\&quot;}]&quot;
                }
            ]
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 401,
    &quot;message&quot;: &quot;Invalid or expired token&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;status_code&quot;: 404,
    &quot;message&quot;: &quot;Data not found...&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 422,
    &quot;message&quot;: &quot;Token not provided&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-get-dashboard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-get-dashboard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-get-dashboard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-get-dashboard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-get-dashboard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-get-dashboard" data-method="POST"
      data-path="api/v1/get-dashboard"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-get-dashboard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-get-dashboard"
                    onclick="tryItOut('POSTapi-v1-get-dashboard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-get-dashboard"
                    onclick="cancelTryOut('POSTapi-v1-get-dashboard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-get-dashboard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/get-dashboard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-get-dashboard"
               value="Bearer _token required"
               data-component="header">
    <br>
<p>Example: <code>Bearer _token required</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-get-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-get-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>*project_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="*project_id"                data-endpoint="POSTapi-v1-get-dashboard"
               value="1"
               data-component="body">
    <br>
<p>Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="dashboard-POSTapi-v1-get-dashboard-report">getDashboardReport</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>If everything is okay, you'll get a <code>200</code> OK response with data.</p>
<p>Otherwise, the request will fail with a <code>404</code> error, and Profile not found and token related response...</p>
<p>EX
{
&quot;project_id&quot;:1
}</p>
<aside class="notice">basepath/api/v1/get-dashboard-report</aside>

<span id="example-requests-POSTapi-v1-get-dashboard-report">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://taptik-local-api/api/v1/get-dashboard-report" \
    --header "Authorization: Bearer _token required" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"*project_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://taptik-local-api/api/v1/get-dashboard-report"
);

const headers = {
    "Authorization": "Bearer _token required",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "*project_id": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-get-dashboard-report">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;status_code&quot;: 200,
    &quot;message&quot;: &quot;Successfully data get...&quot;,
    &quot;data&quot;: {
        &quot;deliveredCount&quot;: 18,
        &quot;sentCount&quot;: 18,
        &quot;readCount&quot;: 15,
        &quot;failedCount&quot;: 4,
        &quot;sentDate&quot;: [
            {
                &quot;date&quot;: &quot;14 Mar&quot;,
                &quot;count&quot;: 9
            },
            {
                &quot;date&quot;: &quot;15 Feb&quot;,
                &quot;count&quot;: 4
            },
            {
                &quot;date&quot;: &quot;16 Feb&quot;,
                &quot;count&quot;: 1
            },
            {
                &quot;date&quot;: &quot;17 Feb&quot;,
                &quot;count&quot;: 1
            },
            {
                &quot;date&quot;: &quot;24 Mar&quot;,
                &quot;count&quot;: 3
            }
        ],
        &quot;deliveredDate&quot;: [
            {
                &quot;date&quot;: &quot;14 Mar&quot;,
                &quot;count&quot;: 9
            },
            {
                &quot;date&quot;: &quot;15 Feb&quot;,
                &quot;count&quot;: 4
            },
            {
                &quot;date&quot;: &quot;16 Feb&quot;,
                &quot;count&quot;: 1
            },
            {
                &quot;date&quot;: &quot;17 Feb&quot;,
                &quot;count&quot;: 1
            },
            {
                &quot;date&quot;: &quot;24 Mar&quot;,
                &quot;count&quot;: 3
            }
        ],
        &quot;readDate&quot;: [
            {
                &quot;date&quot;: &quot;14 Mar&quot;,
                &quot;count&quot;: 8
            },
            {
                &quot;date&quot;: &quot;15 Feb&quot;,
                &quot;count&quot;: 3
            },
            {
                &quot;date&quot;: &quot;16 Feb&quot;,
                &quot;count&quot;: 1
            },
            {
                &quot;date&quot;: &quot;17 Feb&quot;,
                &quot;count&quot;: 1
            },
            {
                &quot;date&quot;: &quot;24 Mar&quot;,
                &quot;count&quot;: 2
            }
        ],
        &quot;failedDate&quot;: [
            {
                &quot;date&quot;: &quot;14 Mar&quot;,
                &quot;count&quot;: 1
            },
            {
                &quot;date&quot;: &quot;15 Feb&quot;,
                &quot;count&quot;: 3
            },
            {
                &quot;date&quot;: &quot;16 Feb&quot;,
                &quot;count&quot;: 0
            },
            {
                &quot;date&quot;: &quot;17 Feb&quot;,
                &quot;count&quot;: 0
            },
            {
                &quot;date&quot;: &quot;24 Mar&quot;,
                &quot;count&quot;: 0
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;status_code&quot;: 200,
    &quot;message&quot;: &quot;Successfully data get...&quot;,
    &quot;data&quot;: {
        &quot;deliveredCount&quot;: 0,
        &quot;sentCount&quot;: 0,
        &quot;readCount&quot;: 0,
        &quot;failedCount&quot;: 0,
        &quot;sentDate&quot;: [],
        &quot;deliveredDate&quot;: [],
        &quot;readDate&quot;: [],
        &quot;failedDate&quot;: []
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 401,
    &quot;message&quot;: &quot;Invalid or expired token&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;status_code&quot;: 404,
    &quot;message&quot;: &quot;Data not found...&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;status_code&quot;: 422,
    &quot;message&quot;: &quot;Token not provided&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-get-dashboard-report" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-get-dashboard-report"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-get-dashboard-report"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-get-dashboard-report" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-get-dashboard-report">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-get-dashboard-report" data-method="POST"
      data-path="api/v1/get-dashboard-report"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-get-dashboard-report', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-get-dashboard-report"
                    onclick="tryItOut('POSTapi-v1-get-dashboard-report');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-get-dashboard-report"
                    onclick="cancelTryOut('POSTapi-v1-get-dashboard-report');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-get-dashboard-report"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/get-dashboard-report</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-get-dashboard-report"
               value="Bearer _token required"
               data-component="header">
    <br>
<p>Example: <code>Bearer _token required</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-get-dashboard-report"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-get-dashboard-report"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>*project_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="*project_id"                data-endpoint="POSTapi-v1-get-dashboard-report"
               value="1"
               data-component="body">
    <br>
<p>Example: <code>1</code></p>
        </div>
        </form>

                <h1 id="user-profile-related">User Profile Related</h1>

    <p>APIs for managing all user's profile related</p>

                                <h2 id="user-profile-related-POSTapi-v1-get-user-profile">getUserProfile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>If everything is okay, you'll get a <code>200</code> OK response with data.</p>
<p>Otherwise, the request will fail with a <code>404</code> error, and Profile not found and token related response...</p>
<p>EX
{
&quot;user_id&quot;:1
}</p>
<aside class="notice">basepath/api/v1/get-user-profile</aside>

<span id="example-requests-POSTapi-v1-get-user-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://taptik-local-api/api/v1/get-user-profile" \
    --header "Authorization: Bearer _token required" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"*user_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://taptik-local-api/api/v1/get-user-profile"
);

const headers = {
    "Authorization": "Bearer _token required",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "*user_id": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-get-user-profile">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;status_code&quot;: 200,
    &quot;message&quot;: &quot;Successfully Profile Get...&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Abc&quot;,
        &quot;email&quot;: &quot;you@domain.com&quot;,
        &quot;mobile&quot;: &quot;852****245&quot;,
        &quot;is_email_verify&quot;: 0,
        &quot;is_mobile_verify&quot;: 0,
        &quot;is_whatsapp_true&quot;: 1
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Token is Invalid&quot;,
    &quot;status_code&quot;: 401,
    &quot;status&quot;: false
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Authorised Token Not Found&quot;,
    &quot;status_code&quot;: 401,
    &quot;status&quot;: false
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;status_code&quot;: 404,
    &quot;message&quot;: &quot;Profile not found...&quot;,
    &quot;data&quot;: []
}</code>
 </pre>
            <blockquote>
            <p>Example response (419):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Token is Expired&quot;,
    &quot;status_code&quot;: 401,
    &quot;status&quot;: false
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-get-user-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-get-user-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-get-user-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-get-user-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-get-user-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-get-user-profile" data-method="POST"
      data-path="api/v1/get-user-profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-get-user-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-get-user-profile"
                    onclick="tryItOut('POSTapi-v1-get-user-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-get-user-profile"
                    onclick="cancelTryOut('POSTapi-v1-get-user-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-get-user-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/get-user-profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-get-user-profile"
               value="Bearer _token required"
               data-component="header">
    <br>
<p>Example: <code>Bearer _token required</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-get-user-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-get-user-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>*user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="*user_id"                data-endpoint="POSTapi-v1-get-user-profile"
               value="1"
               data-component="body">
    <br>
<p>Example: <code>1</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
