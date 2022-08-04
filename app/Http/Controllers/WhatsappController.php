<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    //
    public function index(){
        return view('whatsapp');
    }
    public function Send(Request $request){
        $json = [
            'token'         => 'EAAEUPJoOYwYBACLuhxW7r5W1RuBQhX664CGl1tmTddvAkCMZAjMXBCF4AF4vLo7MemxO8DpISipltXL3IqsapvIoeKDvscZAQz5QnygGZAX2PAprg8GF9AhjJwz9h4NIBvJCU4y3Q8djZCguA3zgRWIdiWZAuslxxetWAK0dsYez4zYagaW5vjC8WJMGwLbVGUVqn7767sgZDZD',
            'source'        => '',
            'destination'   => '',
            'type'          => 'text',
            'body'          => [
                'text' => 'Hello from laravel with guzzle'
            ],
        ];

        $response = new Http::withHeaders([
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer + EAAEUPJoOYwYBACLuhxW7r5W1RuBQhX664CGl1tmTddvAkCMZAjMXBCF4AF4vLo7MemxO8DpISipltXL3IqsapvIoeKDvscZAQz5QnygGZAX2PAprg8GF9AhjJwz9h4NIBvJCU4y3Q8djZCguA3zgRWIdiWZAuslxxetWAK0dsYez4zYagaW5vjC8WJMGwLbVGUVqn7767sgZDZD'
        ])->post('https://graph.facebook.com/v13.0/105302625611633/messages', [
            'json'  => $json
        ]);
    }
}
