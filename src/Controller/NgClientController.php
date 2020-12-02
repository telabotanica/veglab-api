<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class NgClientController
{
    public function welcome()
    {

        return new Response(
            'test'
        );
    }
}

