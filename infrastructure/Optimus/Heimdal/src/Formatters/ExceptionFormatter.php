<?php

namespace Infrastructure\Optimus\Heimdal\src\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use BaseFormatter;

class ExceptionFormatter extends BaseFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $response->setStatusCode(500);
        $data = $response->getData(true);

        if ($this->debug) {
            $data = array_merge($data, [
                'code'   => $e->getCode(),
                'message'   => $e->getMessage(),
                'exception' => (string) $e,
                'line'   => $e->getLine(),
                'file'   => $e->getFile()
            ]);
        } else {
            $data['message'] = $this->config['server_error_production'];
        }

        $response->setData($data);
    }
}
