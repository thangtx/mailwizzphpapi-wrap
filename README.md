# mailwizzphpapi-wrap
This project is a little web/rest application using Slim Framework 2, acting like a proxy between MailWizz api and whatever other application that calls it.
# How to use

    git clone https://github.com/thangtx/mailwizzphpapi-wrap.git
    cd mailwizzphpapi-wrap
    php -S localhost:8080

#  Test
1. Change ApiUrl to your MailWizz API url (file Middleware.php line 54)
2. Using postman or your http client to test

# Calling from others language
1. Python

```python

    def subscribe(self, email='', fname='', lname='', list=''):
        params = {'email': email, 'fname': fname, 'lname': lname, 'list': list}
        self._post('/subscribers/user/add', params)

    def list(self):
        params = {}
        data = self._get('/lists/show', params)
        return data

    def _post(self, path, params):
        url = settings.MAIL_API_URL + path
        _params = {'boolean': 'true'}
        _params.update(params)
        _headers = {'public-key': settings.MAIL_API_PUBLIC_KEY, 'private-key': settings.MAIL_API_PRIVATE_KEY}
        try:
            response = requests.post(url, data=_params, headers=_headers)
            return response.json()
        except requests.exceptions.RequestException as e:
            raise HttpRequestException(e.message)
        if response.status_code != 200:
            raise HttpRequestException(response.status_code)

    def _get(self, path, params):
        url = settings.MAIL_API_URL + path
        _params = {'boolean': 'true'}
        _params.update(params)
        _headers = {'public-key': settings.MAIL_API_PUBLIC_KEY, 'private-key': settings.MAIL_API_PRIVATE_KEY}
        try:
            response = requests.get(url, data=_params, headers=_headers)
            return response.json()

        except requests.exceptions.RequestException as e:
            raise HttpRequestException(e.message)

        if response.status_code != 200:
            raise HttpRequestException(response.status_code)
            
```

2. DotNet using RestSharp

```csharp

    var client = new RestClient("http://localhost");

    var request = new RestRequest("/subscribers/user/add", Method.POST);
    request.AddParameter("email", "noob@localhost.com"); // adds to POST or URL querystring based on Method
    request.AddParameter(fname", "FName");
    request.AddParameter("lname", "LName");

    // easily add HTTP Headers
    request.AddHeader("public-key", "public-key");
    request.AddHeader("private-key", "private-key");

    // execute the request
    IRestResponse response = client.Execute(request);
    var content = response.Content; // raw content as string

```
