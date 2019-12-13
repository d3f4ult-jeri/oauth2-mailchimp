<?php

class CurlHelper
{
    const LOG_FILENAME = 'general_curl';

    public static function request(
        $full_path,
        $request = HTTP_GET,
        $postData = array(),
        array $http_headers = array()
    )
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // set headers
        // if post, put and delete request
        // then manage post data request
        curl_setopt($ch, CURLOPT_URL, $full_path);

        $able_to_post = $postData && ($request != HTTP_GET);
        if ($able_to_post)
        {
            if (is_array($postData))
            {
                // set payload
                $dataString = json_encode($postData);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                $http_headers[] = 'Content-Type: application/json;charset=utf-8;';
                $http_headers[] = 'Content-Length: ' . strlen($dataString);
                \Log::info(sprintf("payload: %s\r\n", var_export($postData, true)), null, static::LOG_FILENAME);
            }
            else
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                $http_headers[] = 'Content-Type: application/x-www-form-urlencoded';
            }
        }

        \Log::info(sprintf("path: [%s] %s\r\n", $request, $full_path), null, static::LOG_FILENAME);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $http_headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        // enable curl verbose output to STDERR for debugging
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);

        $info = curl_getinfo($ch);;
        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($result === false)
        {
            return false;
        }

        $result = json_decode($result, true);

        return [
            $status_code,
            $result
        ];

    }

}