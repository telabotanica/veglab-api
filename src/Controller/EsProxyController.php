<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EsProxyController extends AbstractController
{
    private const SUPPORTED_API = [
        '_count',
        '_search',
        '_mget',
    ];

    /**
     * This hack aimed to replace VL client's direct calls to ElasticSearch server
     *
     * @Route("/es-proxy/{index}/{action}", name="es_proxy", requirements={"action"="_\w+"})
     */
    public function index(
        Request $request,
        HttpClientInterface $client,
        array $esConfig,
        string $index,
        string $action
    ) {
        if (!in_array($action, self::SUPPORTED_API)) {
            throw new \InvalidArgumentException('Unsupported API');
        }

        $url = 'http://'.$esConfig['host'].':'.$esConfig['port'].''.'/'.$index.'/'.$action;

        switch ($request->getMethod()) {
            case 'GET':
                $response = $client->request(
                    'GET',
                    $url
                );
                break;
            case 'POST':
                $response = $client->request(
                    'POST',
                    $url,
                    $request->request->all()
                );
                break;
        }

        return new Response(json_encode($response->toArray() ?? 'error in ES Proxy'));
    }
}
