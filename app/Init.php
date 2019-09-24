<?php
/**
 * (Singleton) Interceptador que direcionará requisições para os controladores
 * adequados de acordo com as rotas definidas.
 */
class Init {
    
    private static $init;
    private $rotas;
    
    private function __construct($rotas) {
        $this->rotas = $rotas;        
        $this->processarRota($this->getSegmentos());
        
    }
    
    public static function getInstancia($rotas) {
        if (!isset(self::$init)) {
            self::$init = new Init($rotas);
        }
        return self::$init;
    }
    
    private function processarRota($url) {
        $controllerExiste = false;
        
        foreach ($this->rotas as $rota) {
            if ("/$url" == $rota["rota"]) {
                $pathClass = PATH_APP."/controllers/".$rota["controller"].".php";
                $nameClass = $rota["controller"];
                
                if (file_exists($pathClass)) {
                    require_once $pathClass;
                    
                    $controller = new $nameClass;
                    
                    if (method_exists($controller, $rota["acao"])) {
                        $acao = $rota["acao"];
                        $controller->$acao();
                        
                        $controllerExiste = true;
                        break;
                    }
                }
            }
        }
        if (!$controllerExiste) {
            $this->lancar404();
        }
    }
    
    private function getSegmentos() {
        $urlTratada = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $segmentos = explode("/", $urlTratada);
        
        array_shift($segmentos);// Remove o primeiro índice atual do array.
        array_shift($segmentos);// Remove o primeiro índice atual do array.
        
        // desconsiderar as posições vazias do array quando a url informada tiver uma barra no final.
        foreach ($segmentos as $key => $s) {
            if ($s == "") {
                unset($segmentos[$key]);
            }
        }

        return implode("/", $segmentos);
    }
    
    private function lancar404() {
        require_once PATH_APP."/controllers/Paginas.php";
        (new Paginas())->erro404();
    }
    
    public function getRotas() {
        return $this->rotas;
    }
}