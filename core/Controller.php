<?php

namespace app\core;

class Controller
{

    public function renders($view, $params=[] ){

        return Application::$app->router->renderView($view,$params);

    }

}