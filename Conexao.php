<?php

class Conexao extends PDO {
    
    private $_tipobd;
    private $_host;
    private $_banco;
    private $_usuario;
    private $_senha;
    public $_bd;
    private $_cmd;

 
    public function __construct($namebd) {

        switch($namebd) {

            /*case 'casa':
                
                $this->_host = "127.0.0.1";
                $this->_banco = "";
                $this->_usuario ="root";
                $this->_senha = "";
                $this->_bd = new PDO("mysql:dbname={$this->getBanco()};host={$this->getHost()}", "{$this->getUsuario()}", "{$this->getSenha()}");
                                
                break; */

            case 'bdesocial':
                
                $this->_host = "127.0.0.1";
                $this->_banco = "";
                $this->_usuario ="root";
                $this->_senha = "sigma@2017";
                $this->_bd = new PDO("mysql:dbname={$this->getBanco()};host={$this->getHost()}", "{$this->getUsuario()}", "{$this->getSenha()}");
                                
                break;
            
            case 'bdimageview':

                $this->_host = "127.0.0.1";
                $this->_banco = "imageview";
                $this->_usuario ="postgres";
                $this->_senha = "";
                $this->_bd = new PDO("pgsql:dbname={$this->getBanco()};host={$this->getHost()}", "{$this->getUsuario()}", "{$this->getSenha()}");

                break;

            case 'bdavisos':

                $this->_host = "127.0.0.1";
                $this->_banco = "bdavisos";
                $this->_usuario ="postgres";
                $this->_senha = "";
                $this->_bd = new PDO("pgsql:dbname={$this->getBanco()};host={$this->getHost()}", "{$this->getUsuario()}", "{$this->getSenha()}");
                
                break;

            case 'bdintranet':

                $this->_host = "127.0.0.1";
                $this->_banco = "crase";
                $this->_usuario ="postgres";
                $this->_senha = "";
                $this->_bd = new PDO("pgsql:dbname={$this->getBanco()};host={$this->getHost()}", "{$this->getUsuario()}", "{$this->getSenha()}");
                
                break;

        }
     
        
    } // Fim da function construct

    public function getHost() {

        return $this->_host;

    }

    public function getUsuario(){

        return $this->_usuario;

    }

    public function getSenha() {

        return $this->_senha;

    }

    public function getBanco() {

        return $this->_banco;

    }

    public function setHost($h) {
        
        $this->_host = $h;

    }

    public function setUsuario($u) {

        $this->_usuario = $u;

    }

    public function setSenha($se) {

        $this->_senha = $se;

    }

    public function setBanco ($bb) {
        
        $this->_banco = $bb;
        
        $this->_cmd = "use $this->_banco";

        $this->_bd->exec($this->_cmd);

    }

  
 
    
}

?>
