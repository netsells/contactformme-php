<?php

namespace Netsells\ContactFormMe;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Postman
{
    protected $postUrl;
    protected $client;
    protected $formIdentifier;

    public function __construct($postUrl, $formIdentifier = 'contact_form')
    {
        $this->postUrl = $postUrl;
        $this->client = new Client();
        $this->formIdentifier = $formIdentifier;
    }

    public function deliver($data = [])
    {
        try {
            $response = $this->client->post($this->postUrl(), [
                'form_params' => $this->formatFormData($data),
            ]);
        } catch (ClientException $e) {
            throw new PostmanException((string) $e->getResponse()->getBody());
        }
    }

    private function postUrl()
    {
        if (!filter_var($this->postUrl, FILTER_VALIDATE_URL)) {
            return "https://contactform.me/post/{$this->postUrl}";
        }

        return $this->postUrl;
    }

    private function formatFormData($data = [])
    {
        return array_merge($data, ['cf_form_identifier' => $this->formIdentifier]);
    }
}
