<?php

namespace Pfy\Core\Castables;

use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class ArrayToString implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): string
    {
        if (is_array($value)) {
            return $this->castLines($value);
        }

        if (! is_string($value)) {
            return '';
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $this->downloadFileText($value);
        }

        return $value;
    }

    private function castLines(array $lines): string
    {
        return implode("\n", $lines);
    }

    private function downloadFileText(string $url): string
    {
        return Http::withoutVerifying()->get($url)->body();
    }
}
