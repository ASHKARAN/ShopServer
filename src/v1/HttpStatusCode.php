<?php


namespace SPTA;
//1xx Informational
define("SWITCHING_PROTOCOLS", 101);
//2xx Success
define("OK", 200);
define("CREATED", 201);
define("ACCEPTED", 202);
define("NONAUTHORITATIVE_INFORMATION", 203);
define("NO_CONTENT", 204);
define("RESET_CONTENT", 205);
define("PARTIAL_CONTENT", 206);
//3xx Redirection
define("MULTIPLE_CHOICES", 300);
define("MOVED_PERMANENTLY", 301);
define("MOVED_TEMPORARILY", 302);
define("SEE_OTHER", 303);
define("NOT_MODIFIED", 304);
define("USE_PROXY", 305);
//4xx Client Error
define("BAD_REQUEST", 400);
define("UNAUTHORIZED", 401);
define("PAYMENT_REQUIRED", 402);
define("FORBIDDEN", 403);
define("NOT_FOUND", 404);
define("METHOD_NOT_ALLOWED", 405);
define("NOT_ACCEPTABLE", 406);
define("PROXY_AUTHENTICATION_REQUIRED", 407);
define("REQUEST_TIMEOUT", 408);
define("CONFLICT", 408);
define("GONE", 410);
define("LENGTH_REQUIRED", 411);
define("PRECONDITION_FAILED", 412);
define("REQUEST_ENTITY_TOO_LARGE", 413);
define("REQUESTURI_TOO_LARGE", 414);
define("UNSUPPORTED_MEDIA_TYPE", 415);
define("REQUESTED_RANGE_NOT_SATISFIABLE", 416);
define("EXPECTATION_FAILED", 417);
define("IM_A_TEAPOT", 418);
//5xx Server Error
define("INTERNAL_SERVER_ERROR", 500);
define("NOT_IMPLEMENTED", 501);
define("BAD_GATEWAY", 502);
define("SERVICE_UNAVAILABLE", 503);
define("GATEWAY_TIMEOUT", 504);
define("HTTP_VERSION_NOT_SUPPORTED", 505);