<?php

class ControladorCore {
    
    private $dadosView = array();
    private $limiteOciosidade = 10; // Em segundos.
    
    public function __construct() {
        $this->verificarOciosidade();
    }

    protected function carregarModelo($nomeModelo) {
        require_once PATH_APP."/models/Dados/$nomeModelo.php";
    }
    
    protected function carregarDAO($nomeDao) {
        require_once PATH_APP."/models/DAO/$nomeDao.php";
    }
    
    protected function carregarView($nomeView) {
        $dados = $this->dadosView;
        require_once PATH_APP."/views/v_header.php";
        require_once PATH_APP."/views/$nomeView.php";
        require_once PATH_APP."/views/v_footer.php";
        
    }
    
    protected function addDadosPagina($nomeVariavel, $valor) {
        $this->dadosView[$nomeVariavel] = $valor;
    }
    
    protected function addTituloPagina($valor) {
        $this->dadosView['tituloPagina'] = $valor;
    }
    
    protected function estaLogado() {
        return isset($_SESSION['usuario-sistema']) ? true : false;
    }
    
    protected function logaUsuario($usuario) {
        session_regenerate_id();
        $_SESSION['usuario-sistema'] = serialize($usuario);
        $_SESSION['ultimo-acesso'] = time();
    }
    
    protected function deslogaUsuario() {
        unset($_SESSION['usuario-sistema']);
        unset($_SESSION['ultimo-acesso']);
        session_destroy();
    }
    
    private function verificarOciosidade() {
        if (isset($_SESSION['ultimo-acesso'])) {
            $tempoOcioso = time() - $_SESSION['ultimo-acesso'];
            
            if ($tempoOcioso > $this->limiteOciosidade) {
                $this->deslogaUsuario();
                $_SESSION['erro'] = "Sessão expirada";
                header("Location:".BASE_URL);
            } else {
                $_SESSION['ultimo-acesso'] = time();
            }
        }
    }
}
