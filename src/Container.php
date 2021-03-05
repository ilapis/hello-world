<?php declare(strict_types = 1);

namespace App;

class Container
{
    /**
     * @var array
     */
    protected array $instances = [];

    /**
     * @param string $abstract
     */
    public function set(string $abstract, /*$concrete = null*/): void
    {
        $this->instances[$abstract] = $abstract;
    }

    /**
     * @param $abstract
     * @param array $parameters
     * @return object
     * @throws \ReflectionException
     */
    public function get(string $abstract, $parameters = []): ?object
    {
        // if we don't have it, just register it
        if (!isset($this->instances[$abstract])) {
            $this->set($abstract);
        }

        //return $this->resolve($this->instances[$abstract], $parameters);
        return $this->resolve($abstract, $parameters);
    }

    /**
     * @param $concrete
     * @param $parameters
     * @return object
     * @throws \ReflectionException
     */
    public function resolve(string|\Closure $concrete, array $parameters): object
    {
        if ( $concrete instanceof \Closure) {
            return $concrete($this, $parameters);
        }

        if( !class_exists($concrete, true) ) {
            exit(0);
        }

        try {
                $reflector = new \ReflectionClass($concrete);
        } catch (\ReflectionException $e) {
            echo $e->getFile() . " " . $e->getLine() . ": " .$e->getMessage();
            exit(0);
        }
        // check if class is instantiable
        if (!$reflector->isInstantiable()) {
            throw new \Exception("Class {$concrete} is not instantiable");
        }
        // get class constructor
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            // get new instance from class
            return $reflector->newInstance();
        }
        // get constructor params
        $parameters   = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);
        // get new instance with dependencies resolved
        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * @param $parameters
     * @return array
     * @throws \ReflectionException
     */
    public function getDependencies(array $parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            // get the type hinted class
            $dependency = $parameter->getType() && !$parameter->getType()->isBuiltin() ? new \ReflectionClass($parameter->getType()->getName()) : null;
            if ($dependency === null) {
                // check if default value for a parameter is available
                if ($parameter->isDefaultValueAvailable()) {
                    // get default value of parameter
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Can not resolve class dependency {$parameter->name}");
                }
            } else {
                // get dependency resolved
                $dependencies[] = $this->get($dependency->name);
            }
        }
        return $dependencies;
    }

    public function executeMethod(string $namespace): void
    {
        $exploded = explode("::", $namespace);
        $class = $this->get($exploded[0]);
        $method = $exploded[1];

        $parameters = [];
        if ( $class !== null) {
            $reflection = new \ReflectionMethod($class, $method);

            foreach ($reflection->getParameters() as $parameter) {
                $parameters[] = $this->get((string)$parameter->getType());
            }
        }
        
        $func = array($class, $method);
        $func(... $parameters);
    }
}
