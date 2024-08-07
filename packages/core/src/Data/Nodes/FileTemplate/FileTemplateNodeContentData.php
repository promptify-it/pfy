<?php

namespace Pfy\Core\Data\Nodes\FileTemplate;

use Pfy\Core\Castables\ArrayToString;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class FileTemplateNodeContentData extends Data
{
    public function __construct(
        #[WithCast(ArrayToString::class)]
        public string $template,
        public string $output,
        public bool $generateInputForMissingKeys = false,
    ) {
        //
    }
}
