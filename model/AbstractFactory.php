<?php

/*
 * Classe utilizada em aulas práticas da disciplinas de Programação para a Web da
 * Faculdade de Computação da Universidade Federal de Mato Grosso do Sul (FACOM / UFMS).
 *
 *
 * Classe abstrata que define o padrão para todas as fábricas.
 *
 * @author Profa. Jane Eleutério
 * @author Rodrigo Lopes - Acadêmico CC (Otimização do método queryRowsToListOfObjects)
 * @author Thiago Rodrigues - Acadêmico EC (Otimização do construtor e dos demais metodos da classe)
 * @version 2.2 - 23/Nov/2017
 */
abstract class AbstractFactory {

    protected $db;

    public function AbstractFactory() {

        try{
            $this->db = new PDO('mysql:host=localhost;dbname=books', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    protected function queryRowsToListOfObjects(PDOStatement $result, $nameObject) {
        $list = array();
        $result = $result->fetchAll(PDO::FETCH_NUM);
        foreach ($result as $row) {
            //unset($row[0]);
            $ref = new ReflectionClass($nameObject);

            $list[] = $ref->newInstanceArgs($row);
        }
        return $list;
    }
}

?>
