<?php

namespace Zack\ApiDocGenerator\Attributes;


use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ApiDocumentationRoot
{
    public function __construct(
        public string $title,
        public string $description,
    ) {}
}
