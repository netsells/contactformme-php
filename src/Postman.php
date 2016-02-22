<?php

namespace Netsells\ContactFormMe;

use GuzzleHttp\Client;

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
        $response = $this->client->post($this->postUrl, [
            'form_params' => $this->formatFormData($data),
        ]);

        if ($response->getStatusCode() < 200 or $response->getStatusCode() >= 300) {
            throw new PostmanException((string) $response->getBody());
        }

        return true;
    }

    private function formatFormData($data = [])
    {
        return array_merge($data, ['cf_form_identifier' => $this->formIdentifier]);
    }
}
