# How to use OAuth2 | MailChimp

## Here is the list of available OAuth2 endpoints.

* authorize_uri: https://login.mailchimp.com/oauth2/authorize
* access_token_uri: https://login.mailchimp.com/oauth2/token
* redirect_uri: Client-side, made available to the browser in use.
* metadata: https://login.mailchimp.com/oauth2/metadata

## Step 1: Register your application

To register your application with Mailchimp, follow these steps.

1. In your Mailchimp account, navigate to the Account page.
2. In the drop-down menu, select Extras, and then API Keys.
3. Under the Developing an App? heading, click Register and Manage Your Apps.
4. Click Register an App.
5. In the appropriate fields, enter your application information.
6. Click Create.

After the registration is successful, an Application created message displays along with more information at the end of your form, including the Client_ID and Client Secret. Do not share the Client_ID and Client Secret.

## Step 2: Connect your Application to MailChimp

1. Create branch: e.g oauth2-authentication
2. Go to flexcatering/app/classes/controller/base/public.php
3. In **public.php**, create a function and register them into
flexcatering/fuel/app/config/**routes.php**

    `action_testoauth2_connect() || action_testoauth2_complete()`

Your application begins the authorization process by redirecting the user to the authorize_uri. This is a GET request, and response_type=code, your client_id, and the url-encoded redirect_uri are included. 
  
Below is an example authorize_uri.

  ` https://login.mailchimp.com/oauth2/authorize?
    response_type=code&client_id=635959587059&redirect_uri=http%3A%2F%2F192.168.1.8%2Foauth%2Fcomplete.php `
    
4. In testoauth2_connect, create a variable that holds the value of the **Client_ID** and **Client Secret**. And also create a response that will redirect the user to the **authorize_uri**.

 ```php
   public function action_testoauth2_connect(){
       $client_id = "699627406974";
       $client_secret = "54b06ac94b7cb25d1321f47d47adfa6fc72a46d7528f5c79c0";
       $redirect_url = "http://flexcatering.local.com/testoauth2_complete";
   
       \Response::redirect('https://login.mailchimp.com/oauth2/authorize?response_type=code&client_id='.urlencode($client_id).'&redirect_uri='.urlencode($redirect_url));
   } 
 ```
 
 5. In **testoauth2_complete**, create a response for the **CurlHelper** that request an access_token.
 
  ```php
    public function action_testoauth2_complete()
    {
        $client_id = "699627406974";
        $client_secret = "54b06ac94b7cb25d1321f47d47adfa6fc72a46d7528f5c79c0";
        $redirect_url = "http://flexcatering.local.com/testoauth2_complete";
    
        $response = CurlHelper::request(
            'https://login.mailchimp.com/oauth2/token',
            HTTP_POST,
            http_build_query([
                'grant_type' => 'authorization_code',
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'code' => $_REQUEST['code'],
                'redirect_uri' => $redirect_url
            ], '', '&')
        );
    
        echo "<pre>" . var_export($response, true) . "</pre>" ; die();
    }
    
  ```
  
6. This will return an **access_token**, which completes the official OAuth2 flow. Though we return access_token, expires, and scope, you only need to care about access_token. 


## Step 3: Getting Started with the MailChimp API

1. Read more about the documentation on how to integrate MailChimp API

* How to use Oauth2 | MailChimp:  https://mailchimp.com/developer/guides/how-to-use-oauth2/



## Ask a question?
    
If you have any query please contact at jericotilacas@gmail.com 
