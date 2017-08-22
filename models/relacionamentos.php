<?php
class Relacionamentos extends model{

    public function addFriend($id1, $id2){
        $sql = "Insert into relacionamentos set usuario_de = '$id1', usuario_para = '$id2', status = '0'";
        $this->db->query($sql);
        print_r($this->db->errorInfo());
    }

    /**
     * @param $id_de    Quem enviou a solicitação
     * @param $id_para  Quem receberá a solicitação de amizade.
     */
    public function aceitarFriend($id_de, $id_para){
        $sql = "
            Update relacionamentos set status = '1' 
             where usuario_de = '$id_para' and usuario_para = '$id_de'";
        $this->db->query($sql);
        print_r($this->db->errorInfo());
    }

    public function getRequisicoes(){
        $array = array();
        $sql = "
            Select
                usuarios.id,
                usuarios.nome
            from relacionamentos left join usuarios on usuarios.id = relacionamentos.usuario_de
            where 
              relacionamentos.usuario_para = '".($_SESSION['lgsocial'])."' AND 
              relacionamentos.status = '0'                
            ";

        $sql = $this->db->query($sql);

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotalAmigos($id){
        $sql = "Select count(*) as c from relacionamentos 
                  where 
                    (usuario_para = '$id' or 
                    usuario_de = '$id') and status = '1'";

        $sql = $this->db->query($sql);
        $sql = $sql->fetch();

        return $sql['c'];
    }
}