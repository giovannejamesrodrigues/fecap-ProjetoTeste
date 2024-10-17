<?php declare(strict_types=1);
namespace Controller;

class Controller {

    public function __construct() {
        $reflectionClass = new \ReflectionClass($this);

        foreach([
            'userModel' => \Model\User::class,
            'taskModel' => \Model\Task::class,
        ] as $property => $class) {
            if($reflectionClass->hasProperty($property)) {
                $reflectionProperty = $reflectionClass->getProperty($property);
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($this, new $class());
            }
        }

        if($reflectionClass->hasMethod($method = 'middleware')) {
            $reflectionMethod = $reflectionClass->getMethod($method);
            $reflectionMethod->invoke($this);
        }
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
                        if($uri === $pathInfo && $attribute->getMethod() == $_SERVER['REQUEST_METHOD']) {
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
                                $output = $controllerInstance->{$reflectionMethod->getName()}($data);
                                if(isset($output)) {
                                    if(\is_object($output)) {
                                        $output = (array)$output;
                                    }
                                    if(\is_array($output)) {
                                        \header('Content-Type: application/json');
                                        echo \json_encode([
                                            'status' => 200,
                                            'data' => $output
                                        ]);
                                        return;
                                    }
                                    if(\is_string($output)) {
                                        echo $output;
                                        return;
                                    }
                                }
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
            \header('Content-Type: application/json');
            echo $e;
        }
    }
}