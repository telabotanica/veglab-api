<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class Celv2Controller
{
    public function welcome()
    {

        return new Response(
            'test'
        );
    }
}

