<?php declare(strict_types=1);
namespace Controller;

class Controller {

    public function __construct() {

    }

    public static function _entry($pathInfo): void {
        try {
            $controllers = [
                TaskController::class,
                UserController::class
            ];

            foreach($controllers as $controller) {
                $reflectionClass = new \ReflectionClass($controller);
                foreach($reflectionClass->getMethods() as $reflectionMethod) {
                    foreach($reflectionMethod->getAttributes(\Attributes\Request::class) as $reflectionAttribute) {
                        $attribute = $reflectionAttribute->newInstance();
                        $uri = $attribute->getUri();
                        if($uri === $pathInfo) {
                            $data = [];
                            if($attribute->getMethod() === 'POST') {
                                $data = $_POST;
                            } else if($attribute->getMethod() === 'GET') {
                                $data = $_GET;
                            } else {
                                $data = $_REQUEST;
                            }
                            try {
                                $controllerInstance = new $controller($data);
                                $controllerInstance->{$reflectionMethod->getName()}($data);
                                return;
                            } catch(\Exceptions\JsonException $e) {
                                throw $e;
                            } catch(\Exception $e) {
                                throw new \Exceptions\JsonException($e->getMessage(), 500);
                            }
                        }
                    }
                }
            }
            throw new \Exceptions\JsonException('Endpoint não encontrado', 404);
        } catch(\Exceptions\JsonException $e) {
            \http_response_code($e->getHttpStatusCode());
            echo $e;
        }
    }
}