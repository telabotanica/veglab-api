<?php

namespace App\Serializer;

use App\Serializer\OccurrencePdfGenerator;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Encodes/returns a PDF file representation of a set of Occurence instances.
 */
class PdfOccurrenceEncoder implements EncoderInterface, DecoderInterface {

    /**
     * @inheritdoc
     */
    public function encode($data, $format, array $context = array()) {
        $pdfGenerator = new OccurrencePdfGenerator();
        $pdf = $pdfGenerator->export($data);
        $now = date_format(new \DateTime('now'), 'd_m_Y_H_i_s');
        $filename = getenv('TMP_FOLDER') . '/' . $now . '.pdf';
        $pdfGenerator->pdf->Output($filename,'F');

        return file_get_contents($filename);
    }

    /**
     * @inheritdoc
     */
    public function supportsEncoding($format) {
        return 'pdf' === $format;
    }

    /**
     * @inheritdoc
     */
    public function decode($data, $format, array $context = array()) {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function supportsDecoding($format) {
        // No Web service consumes/decodes PDF files. Some only produce some.
        return false;
    }

}
