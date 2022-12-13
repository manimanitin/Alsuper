<?php
/* */
class Base
{
    private $server = DB_SERVER;
    private $tipo = DB_TIPO;
    private $user = DB_USER;
    private $pwd = DB_PWD;
    private $base = DB_BASE;
    private $dbh;
    private $stmt;


    public function __construct()
    {
        $dsn = $this->tipo . ':host=' . $this->server . ';dbname=' . $this->base . ";charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => pdo::ERRMODE_EXCEPTION,
            pdo::ATTR_PERSISTENT => true
        ];
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pwd);
        } catch (\Throwable $th) {
            echo 'ha ocurrido un error' . $th->getMessage();
        }
    }

    /** metodo query realizar preparacion, evitar SQLinjection */
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);;
    }
    //antes de ejecutar hay que vincular crear pares var-val

    public function bind($par, $valor, $tipo = null)
    {
        //valoracion de tipo
        switch (is_null($tipo)) {
            case is_int($valor):
                $tipo = PDO::PARAM_INT;
                break;

            case is_bool($valor):
                $tipo = PDO::PARAM_BOOL;
                break;
            case is_null($valor):
                $tipo = PDO::PARAM_NULL;
                break;
            default:
                $tipo = PDO::PARAM_STR;
                break;
        }
        $this->stmt->bindValue($par, $valor, $tipo);
    }
    //ejecutar sentencia sql preparada
    public function execute()
    {
        $this->stmt->execute();
    }
    //metocos especiales
    public function unico()
    {
        $this->execute(); //
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    public function multiple()
    {
        $this->execute(); //
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function conteoReg()
    {
        return $this->stmt->rowCount();
    }
    public function multiple2()
    {
        $this->execute(); //
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
