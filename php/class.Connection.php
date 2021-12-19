<?php


class Connection
{
    private $url;
    private $client;

    public function __construct($url)
    {
        $this->url = $url;
        $this->client = new GuzzleHttp\Client();
    }

    public function getBodyWithPage($page)
    {
        $res = $this->client->request('GET', $this->url . $page);
        return (string)$res->getBody();
    }

    public function getBodyWithoutPage()
    {
        try {
            $res = $this->client->request('GET', $this->url);
            return (string)$res->getBody();
        } catch (Exception $exception) {
            return null;
        }
    }

    public function getBodyExternalUrl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents = curl_exec($ch);

        return $contents;
    }


    public
    function ifNotFolderCreateFolder($path)
    {
        if (!is_dir($path)) {
            mkdir($path);
        }
    }

}