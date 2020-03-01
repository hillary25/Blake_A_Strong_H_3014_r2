<?php
class Database
{
    // Note: specify your own database credentials
    private $host = "localhost";

    private $db_name = "db_login";

    private $username = "root";

    private $password = "root"; // Need root here for Mac connection

    private static $instance = null;

    public $conn;

    private function __construct(){
        $db_dsn = array(
            'host'    => $this->host,
            'dbname'  => $this->db_name,
            'charset' => 'utf8',
        );

        if (getenv('IDP_ENVIRONMENT') === 'docker') {
            $db_dsn['host'] = 'mysql';
            $this->username = 'docker_u';
            $this->password = 'docker_p';
        }

        try {
            $dsn        = 'mysql:' . http_build_query($db_dsn, '', ';');
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo json_encode(
                array(
                    'error'   => 'Database connection failed',
                    'message' => $exception->getMessage(),
                )
            );
            exit;
        }
    }

    // Get the database connection
    public function getConnection()
    {
        return $this->conn;
    }

    // Called a design patent --> advanced programming
    // This makes sure the code is structured properly, therefore running the most efficiently
    // This specifically is called a singleton pattern (this is avoiding writing the same database connection over and over, and re-uses this one when detected)
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Database();
        }
        
        return self::$instance;
    }
}