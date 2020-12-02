<?php

namespace App\Serializer;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;


class JsonPatchOccurrenceEncoder implements EncoderInterface, DecoderInterface
{
    public function encode($data, $format, array $context = array())
    {
        return json_encode($data);
    }

    public function supportsEncoding($format)
    {
        return 'jsonpatch' === $format;
    }

    public function decode($data, $format, array $context = array())
    {
        return json_decode($data);
    }

    public function supportsDecoding($format)
    {
        return 'jsonpatch' === $format;
    }
}
