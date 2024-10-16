<?php
namespace Exceptions;

class JsonException extends \Exception {

    public function __construct(
        private string $jsonMessage,
        private int $statusCode = 500,
        private \Throwable|null $previous = null
    ) {
        parent::__construct($this->jsonMessage, $this->statusCode, $this->previous);
    }

    public function __toString(): string {
        return \json_encode([
            'message' => $this->jsonMessage,
            'code' => $this->code
        ]);
    }

    public function getHttpStatusCode(): int {
        return $this->statusCode;
    }

}