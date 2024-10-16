<?php declare(strict_types=1);

namespace Attributes;

#[\Attribute]
class Request {
    public function __construct(
        private string $uri,
        private string $method = 'GET'
    ) {
    }

    public function getUri(): string {
        return $this->uri;
    }

    public function getMethod(): string {
        return $this->method;
    }
}