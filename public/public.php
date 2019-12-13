<?php
/**
 * /fuel/app/classes/controller/base
 * Part of Leading Edge Creative CMS.
 *
 * @package    LEC CMS
 * @version    2.0
 * @author     CMS Development Team
 */


class Controller_Base_Public extends Controller_Base_Template
{


    public function action_testoauth2_connect(){
        $client_id = "699627406974";
        $client_secret = "54b06ac94b7cb25d1321f47d47adfa6fc72a46d7528f5c79c0";
        $redirect_url = "http://flexcatering.local.com/testoauth2_complete";

        \Response::redirect('https://login.mailchimp.com/oauth2/authorize?response_type=code&client_id='.urlencode($client_id).'&redirect_uri='.urlencode($redirect_url));
    }

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
}
