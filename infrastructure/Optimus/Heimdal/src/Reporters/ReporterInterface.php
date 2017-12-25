<?php

namespace Ifrastructure\Optimus\Heimdal\src\Reporters;

use Exception;

interface ReporterInterface
{
    public function report(Exception $e);
}
