<?php
namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public static string $BASE_URL;
    public static string $CLIENT_ID;
    public static string $CLIENT_SECRET;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $database;
    public static Application $app;

    public function __construct($rootPath,array $config,$base_url,$clint_id,$client_secret)
    {
        self::$BASE_URL=$base_url;
        self::$CLIENT_ID=$clint_id;
        self::$CLIENT_SECRET=$client_secret;
        self::$app=$this;
        self::$ROOT_DIR = $rootPath;
        $this->request=new Request();
        $this->response=new Response();
        $this->router=new Router($this->request,$this->response);
        $this->database=new Database($config['db']);
    }

    public function run(){
       echo $this->router->resolve();
    }

}


