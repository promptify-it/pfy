<?php

namespace Pfy\Core\Concerns\Nodes;

use Pfy\Core\Contracts\DataPiper;

trait ProvidesReplacers
{
    public $transformerGlue = '_';

    /**
     * Provide replacers for the given key and value.
     */
    public function provideReplacersFor(string $key, string $value, DataPiper $dataPiper)
    {
        $dataPiper->set($this->composeKey($key, 'upper'), str($value)->upper()->toString());
        $dataPiper->set($this->composeKey($key, 'lower'), str($value)->lower()->toString());
        $dataPiper->set($this->composeKey($key, 'camel'), str($value)->camel()->toString());
        $dataPiper->set($this->composeKey($key, 'snake'), str($value)->snake()->toString());
        $dataPiper->set($this->composeKey($key, 'kebab'), str($value)->kebab()->toString());
        $dataPiper->set($this->composeKey($key, 'studly'), str($value)->studly()->toString());
    }

    private function composeKey(string $key, string $transformer): string
    {
        return $key.$this->transformerGlue.$transformer;
    }
}
