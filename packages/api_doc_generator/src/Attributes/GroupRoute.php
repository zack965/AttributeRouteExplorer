<?php

namespace Zack\ApiDocGenerator\Attributes;


use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class GroupRoute
{
    public function __construct(
        public string $groupName,
        public string $description,
    ) {}
}
