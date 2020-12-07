<?php 
/**
 * Materia: Computacion en el servidor web
 * Actividad: Desarrollo web avanzado
 * Profesor: Octavio Aguirre Lozano
 * Alumno: Victor Isaac Rodriguez Saenz
 * 
 * Archivo index.php
 * 
 * Referencias: https://www.w3schools.com/php/default.asp
 */

    //Creamos un objeto para iniciar la pagina
    $controller = new Controller();

    /**
     * Clase que fungira como controlador de nuestra logica segun la arquitectura
     * Modelo-Vista-Controlador
     */
    class Controller {

        //Variable en la que guardaremos informacion 'dummy' para simular informacion real
        private $fakeData;

        //Propiedad para guardar el path que el usuario quiera ver, ejemplos: 'index', 'login'
        private $uri;

        /**
         * Constructor de nuestro controlador. 
         * Llama a init para establecer el estado inicial de un objeto nuevo y de la pagina
         */
        public function __construct() {
            $this->init();
        }

        /**
         * Init llama a un par de funciones 
         */
        public function init() {
            $this->uri = ''; //En un futuro esto tomara pararemetros q vengan de GET
            session_start();
            //$this->generateFakeData();
            $this->validatePost();
            $this->requireView(); 
        }

        /**
         * Validar que no se haya hecho un post 
         * En caso de que si, manejar la informacion que esperamos
         */
        private  function validatePost() {
            if( isset($_POST['body']) && isset($_POST['title']) ) {
                $message = '';
                $body = trim($_POST['body']);
                $body = strtolower($body);
                $title = trim($_POST['title']);
                $title = strtoupper($title);

                if( $body != '' && $title != ''  ) {
                    $message = 'Completado con exito';

                    if( isset($_POST['repeat']) ) {

                        $i = 0 ;
                        while( $i < $_POST['repeat'] ) {
                            $_SESSION['blogs'][] = [
                                'title' => $title,
                                'body' => $body
                            ];
                            $i++;
                        }

                    }else {
                        $_SESSION['blogs'][] = [
                            'title' => $title,
                            'body' => $body
                        ];
                    }
                } else {
                    $message = 'Error, completa los campos';
                }
                echo $message;
            }
            
        }

     
        /**
         * Metodo para llamar un archivo con codigo HTML, puede tomar un parametro
         * para especificar la ruta de la pagina.
         */
        private function requireView() {
            /**
             * Lista blanca de rutas de URL
             */
            switch ($this->uri) {
                case '':
                case 'index':
                    require_once 'index.view.php';
                    break;

                default: 
                    //Pagina de error
                    require_once 'not_found.view.php';
                    break;
            }
        }

        /**
         * Funcion para llenar de informacion "dummy" a Session
         */
        private function generateFakeData() {

            if( !isset($_SESSION['blogs']) ) { //Para no sobreescribi cada vez q refresquen la pagina
               
                for( $i = 1; $i <= 3; $i++  ) {
                    $_SESSION['blogs'] = array(
                        [
                            'title' => 'Tutorial de PHP ' . $i, 
                            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim id sint repudiandae sit assumenda ullam doloremque quisquam? Omnis quaerat, animi commodi officia alias eos, obcaecati impedit est voluptatem distinctio illum!'
                        ],
                    );
                }
            }         
        }
    }    
?>