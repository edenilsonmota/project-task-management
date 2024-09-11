<?php

namespace app\view;
use League\Plates\Engine;

class Home {
    protected $templates;
    private $url_base;

    function __construct(){
        //Configura caminho dos templates
        $this->templates = new Engine('app/template');
        //criando url base para scripts.js e requisições;
        $this->url_base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https://'.$_SERVER["HTTP_HOST"].'/' : 'http://'.$_SERVER["HTTP_HOST"].'/';

    }

    /** carregar template index
     * @return void
     */
    public function index() {
        echo $this->templates->render('home',
        ['url'  => $this->url_base]);
    }
}