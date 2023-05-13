<?php

namespace App\Request;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;


class Request
{
    protected object $client;
    protected string $method = 'POST';
    protected string $endpoint;

    public function __construct(protected array $options)
    {
        $this->client = new Client([
            'base_uri' => 'https://api.pagar.me/core/v5/'
        ]);
    }
    public function get($endpoint)
    {
        $this->method = "GET";
        $this->endpoint = $endpoint;

        return $this->request();
    }
    public function post($endpoint, $params)
    {
        $this->options['body'] = json_encode($params);
        $this->endpoint = $endpoint;

        return $this->request();
    }
    private function request()
    {
        try {
            $response =  $this->client->request($this->method, $this->endpoint, $this->options);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {

            $response = $e->getResponse() ?? null;
            $responseBodyAsString = $response->getBody()->getContents()  ?? null;

            return $this->getError($responseBodyAsString, $e->getMessage());
        }
    }
    private function getError($error, $error_message)
    {

        if (empty($error)) return $error_message;

        $error_array = json_decode($error);

        if (empty($error_array->errors)) return $error_array->message ?? $error_message;

        return ['errors' => $this->errorsTranslate($error_array->errors)];
    }

    private function errorsTranslate($errors)
    {
        $errors_translated = [];
        foreach ($errors as $key => $error) {
            $explode_key = explode('.', $key);

            $file_name = $explode_key[count($explode_key) - 2] ?? end($explode_key);

            $path_file =  dirname(__FILE__) . '/../Translate/' . $file_name . '.php';
            if (file_exists($path_file))
                require($path_file);

            foreach ($error as $value) {
                $errors_translated[] = $messages[$value] ?? $value;
            }
        }
        return $errors_translated;
    }
}
