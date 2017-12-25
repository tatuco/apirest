<?php

namespace Infrastructure\Optimus\Architect\src\ModeResolver;

interface ModeResolverInterface
{
    public function resolve($property, &$object, &$root, $fullPropertyPath);
}
