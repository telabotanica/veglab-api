<?php

namespace App\Serializer;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use stdClass;

class GeoJsonOccurrenceEncoder implements EncoderInterface, DecoderInterface
{
    public function encode($data, $format, array $context = array())
    {
        // Let's wrap rhe features in an envelope:
        $envelopedData = new stdClass();
        $envelopedData->type = "FeatureCollection";
        $envelopedData->features = $data;
        return json_encode($envelopedData);
    }

    public function supportsEncoding($format)
    {
        return 'geojson' === $format;
    }

    public function decode($data, $format, array $context = array())
    {
        return json_decode($data);
    }

    public function supportsDecoding($format)
    {
        return 'geojson' === $format;
    }
}


