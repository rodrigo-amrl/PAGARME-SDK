<?php

namespace App;

use App\Builders\ClientBuilder;
use App\Models\AdressModel;
use App\Models\CardModel;
use App\Models\ClientModel;
use App\Request\Request;

class PagarmeLib
{

    protected array $options = [
        'headers' => [
            'content-type' => 'application/json',
            'Accept'     => 'application/json'
        ]
    ];
    public function __construct(protected String $token,  array $options)
    {
        $this->options = array_merge($options, $this->options);
    }
    public function newOrder(array $data)
    {
        $campos = $this->mount($data);

        $request = new Request(['auth' => [$this->token, '']]);

        return  $request->post('orders', $campos);
    }
    public function newOrderTest(array $data)
    {

        $cliente_builder = new ClientBuilder($data['customer']);
        $cliente_builder->addAddress($data['customer']['address']);
    }
    private function mount($order)
    {

        $campos = [];
        $cliente = new ClientModel($order['customer']);
        $campos['customer'] = $cliente->toArray();

        if (!empty($order['customer']['address'])) {
            $address = new AdressModel($order['customer']['address']);
            $campos['customer']['address'] = $address->toArray();
        }


        $campos['items'][] = [
            'amount' => $order['amount'],
            'description' => "Atendimento MeuApppoio",
            'quantity' => 1
        ];
        if ($order['payment']['type'] == 'credit_card') {
            $card = new CardModel($order['payment']['card']);
            $payment['payment_method'] = $order['payment']['type'];
            $payment['credit_card']['card'] =  $card->toArray();
            $payment['credit_card']['card']['billing_address'] =  $campos['customer']['address'];
        } else {

            $payment['Pix'] = [];
            $payment['Pix']['expires_in'] = 900;
            $payment['payment_method'] = 'pix';
            //     'expires_in' => "900",
            //     "additional_information" => [
            //         "name" => "Atendimento MeuApppoio",
            //         "value" => $order['amount']

            //     ]
            // ];
        }
        $campos['payments'][] = $payment;


        return $campos;
    }
}
