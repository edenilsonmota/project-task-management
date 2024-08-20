<?php
namespace app\router;

use app\helper\Request;
use app\helper\Uri;
use Exception;


/**
 * Rotas com class e metodos de cada um
 */
class Router
{
    public static function routes()
    {
        //chama as rotas usando arrow functions
        return [
            'get' => [            //class   //method //param
                "/tasks" => fn() => self::load('TaskController', 'getAll'),
                "/task" => fn() => self::load('TaskController', 'getById')
            ],
            'post' => [
                "/task" => fn() => self::load('TaskController', 'create')
            ],
            'put' => [
                "/task" => fn() => self::load('TaskController', 'update')
            ],
            'delete' => [
                "/task" => fn() => self::load('TaskController', 'delete')
            ]
        ];
    }

    const CONTROLLER_NAMESPACE = "app\\controller";
    
    /**
     * responsavel por verificar se as classes e metodos existem e executa-los
     *
     * @param [type] $class
     * @param [type] $method
     */
    public static function load($class, $method)
    {
        try{
            //recebendo a class do parametro
            $controllerNamespace = self::CONTROLLER_NAMESPACE . "\\" . $class;

            //senao existe class, lança excessão
            if(!class_exists($controllerNamespace)){
                throw new Exception("A class controller $class não existe");
            }

            //se existe, instanciar classe
            $classInstance = new $controllerNamespace();

            //senao existe metodo, lança excessão
            if(!method_exists($classInstance, $method)){
                throw new Exception("O metodo $method não existe na classe controller $class\n");
            }

            //se existe chamar metodo 
            echo $classInstance->$method();

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
    
    
    public static function execute()
    {
        try{
            $routes = self::routes(); //rotas disponiveis
            $request = Request::get(); //requisição
            $uri = Uri::get('path'); //caminho

            //verificar senão existe rota para essa requisição
            if(!isset($routes[$request])){ //router['get']
                throw new Exception("Não esse tipo requisição na rota da API!");
            }
            
            //verificar senão tem esse caminho dentro da requisição da rota
            if(!array_key_exists($uri, $routes[$request])){ //!router['get']['path']
                throw new Exception("Não existe esse path na API!!!");    
            }

            //Se a requisição e caminho existirem, chamar rota pela arrow function
            $router = $routes[$request][$uri];

            $router();


        } catch (Exception $e){
            echo $e->getMessage();
        }
        
        
    }
}