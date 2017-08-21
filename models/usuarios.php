<?php
class Usuarios extends model{

    // Retorna se o usuário se logado ou não.
    public function verificarLogin(){

        if(!isset($_SESSION['lgsocial']) || (isset($_SESSION['lgsocial']) && empty($_SESSION['lgsocial']))){
            header("Location: ". BASE. "login");
            exit;
        }
    }

    public function logar($email, $senha){
        $sql = "Select * from usuarios where email = '$email' and senha = '$senha'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            $_SESSION['lgsocial'] = $sql['id'];

            header("Location: ".BASE);
            exit;
        }else{
            return "E-mail e/ou senha errado(s).";
            exit;
        }
    }

    public function cadastrar($nome, $email, $senha, $sexo){
        $sql = "Select * from usuarios where email = '$email'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() == 0){

            $sql = "Insert into usuarios set nome= '$nome', email = '$email', senha = md5('$senha'), sexo = '$sexo'";
            $sql = $this->db->query($sql);
            $id = $this->db->lastInsertId();
            $_SESSION['lgsocial'] = $id;
            header("Location: ".BASE);
            exit;
        }else{
            return "Erro: E-mail já está já existe.";
        }
    }

    public function getNome($id){
        $sql = "Select nome from usuarios where id = '$id'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();

            return $sql['nome'];
        }else{
            return '';
        }
    }

    public function getDados($id){
        $array = array();

        $sql = "Select * from usuarios where id = '$id'";
        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }

    public function updatePerfil($array = array()){

        if(count($array) > 0){
            $sql = "Update usuarios set ";
            $campos = array();
            foreach($array as $campo => $valor){
                $campos[] = $campo . " = '". $valor . "'";
            }

            $sql .= implode(', ', $campos);
            $sql .= " where id = '". ($_SESSION['lgsocial'])."'";
            $this->db->query($sql);
        }
    }

    public function getSugestoes($limit = 5){
        $array = array();
        $meuid = $_SESSION['lgsocial'];

        $sql = "
          Select 
            usuarios.id,
            usuarios.nome 
          from usuarios 
            where usuarios.id != '$meuid' 
              order by rand()
              limit $limit
              ";

        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;


        return $array;
    }
}