<?php

namespace App\Builders;

use App\Models\AdressModel;
use App\Models\ClientModel;
use App\Builders\ClientBuilderInterface;

class ClientBuilder implements ClientBuilderInterface
{
    protected ClientModel $client;
    public function __construct(array $data)
    {
        $this->client = new ClientModel($data);
    }
    public function addAddress(array $data): void
    {
        $this->client->addOneToMany('address', new AdressModel($data));
    }
    public function addPhones(array $data): void
    {
    }
    public function newClient(array $data): void
    {
        // $this->client  = new ClientModel();
    }
    public function get()
    {
        return $this->client;
    }
}
