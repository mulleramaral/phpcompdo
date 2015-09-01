<?php

require_once './Conexao.php';
require_once './IEntidade.php';

class ServiceDb {

    private $conexao;
    private $entidade;

    public function __construct(IEntidade $entidade) {
        $this->conexao = Conexao::getInstancia();
        $this->entidade = $entidade;
    }

    function listar($order = "") {
        $query = "SELECT * FROM {$this->entidade->getTable()} " . $order;
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function listarPor($pesquisa) {
        $query = "SELECT * FROM {$this->entidade->getTable()} WHERE " . $pesquisa['filtro'];
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $pesquisa['valor']);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    function Get($id) {
        $query = "SELECT * FROM {$this->entidade->getTable()} WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function Inserir() {
        $query = "INSERT INTO {$this->entidade->getTable()}({$this->getCampos()}) values({$this->getParametros()})";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute(array_values(get_object_vars($this->entidade)));
    }

    function Alterar() {
        $query = "update {$this->entidade->getTable()} set ";
        $campos = array_keys(get_object_vars($this->entidade));

//Acerta query
        for ($i = 0; $i < count($campos); $i++) {
            $query .= $campos[$i] . "=:{$campos[$i]},";
        }

//Retira ultima virgula
        $query = substr($query, 0, -1);

//Complementa com id
        $query .= " WHERE id = :id";

//Prepara statement
        $stmt = $this->conexao->prepare($query);

//Efetua bind
        $bind = get_object_vars($this->entidade);

        foreach ($bind as $coluna => $valor) {
            $stmt->bindValue(":{$coluna}", $valor);
        }

        $stmt->bindValue(':id', $this->entidade->getId());
//Executa
        $stmt->execute();
    }

    function Remover($id) {
        $query = "DELETE FROM {$this->entidade->getTable()} WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    function validaUsuario($usuario, $senha) {
        if (get_class($this->entidade) != 'Usuario') {
            return false;
        }

        $query = "SELECT * FROM usuarios WHERE usuario= :usuario AND senha = :senha";
        try {
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':senha', $senha);
            $stmt->execute();
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($resultado) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            return false;
        }
    }

    private function getCampos() {
        $campos = implode(',', array_keys(get_object_vars($this->entidade)));
        return $campos;
    }

    private function getParametros() {
        $parametros = substr(str_repeat('?,', count(array_keys(get_object_vars($this->entidade)))), 0, -1);
        return $parametros;
    }
}
