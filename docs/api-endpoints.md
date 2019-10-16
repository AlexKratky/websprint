# API Endpoint

You can create API endpoint on API route's version, e.g. on `v1` or `v2`. As second parameter, you need to use handler class reference (e.g. `new API()`). That means, if the user will request /api/v1/display, the request will be handled by the registered handler. The Route engine will call request() function of that registered handler, which will return true of false. If returns true, the execution of script will continue and will include all files as normal, but if it returns false, the Route engine will call error() function of registered handler. You can see example handler class - [API Class](https://panx.eu/docs/api).