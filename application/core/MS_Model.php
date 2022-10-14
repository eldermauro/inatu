<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MS_Model extends CI_Model
{

    public $tabela = "";
    public $view = "";
    public $tipo = "";
    public $database = "";

    public $chaves;
    public $campos;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $obj = &get_instance();
        $obj->load->library('session'); 
    }
    
    public function remove_special($value)
    { 
        $return = strtr(
            $value,
            array(
                'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
                'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
                'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
                'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
                'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', '?' => 'R',
                'Þ' => 's', 'ß' => 'B', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
                'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
                'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
                'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
                'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y',
                'þ' => 'b', 'ÿ' => 'y', '?' => 'r', ';' => ' ', '��' => 'o', ' ' => '-',
            )
        );
        return strtolower($return);
    }
    
    
    
    // FUNCAO PARA LISTAR
    // TODOS OS REGISTROS COM CLAUSULAS 'or'
    // DA TABELA
    // RETORNA UM OBJETO/ARRAY
    public function listar_or($param = null)
    {

        if (is_array($param) == null) {
            return null;
        }
        foreach ($param as $p) {
            if ($p['valor'] != '') {
                $this->database->or_where($p['campo'], $p['valor']);
            } else {
                $this->database->or_where($p['campo']);
            }
        }
        $result = $this->database->get($this->view)->result_object();

        return $result;
    }

    // FUNCAO PARA LISTAR
    // TODOS OS REGISTROS
    // DA TABELA COM LIMITES
    // RETORNA UM OBJETO/ARRAY
    public function limite($param = null, $limite = null)
    {

        if (!is_array($param) == null) {
            $this->database->order_by($param['campo'], $param['ordem']);
        }
        $this->database->limit($limite['inicio'], $limite['fim']);
        $result = $this->database->get($this->view);
        return $result;
    }

    // FUNÇÃO PARA IR FILTRANDO
    // ATRASVÉS DOS CAMPOS DA TABELA
    // RETORNA UM OBJETO/ARRAY
     public function filtrar_like($param = null, $like, $ordem = null)
    {

        if (is_array($param)) {
            foreach ($param as $p) {
                if ($p['valor'] != '') {
                    $this->database->where($p['campo'], $p['valor']);
                } else {
                    $this->database->where($p['campo']);
                }
            }
        }

        if (!is_array($like) == null) {
            foreach ($like as $l) {
                $this->database->like( $l['campo'], $l['valor']);
            }
        }

        if (!is_array($ordem) == null) {
            $this->database->order_by($ordem['campo'], $ordem['ordem']);
        }
        $result = $this->database->get($this->view);
        // echo $this->database->last_query();
        return ($result);
    }

    // FUNÇÃO PARA IR FILTRANDO
    // ATRASVÉS DOS CAMPOS DA TABELA
    // RETORNA UM OBJETO/ARRAY
    public function filtrar($param = null, $ordem = null)
    {

        if (!is_array($param) == null) {
            foreach ($param as $p) {
                if ($p['valor'] != '') {
                    $this->database->where($p['campo'], $p['valor']);
                } else {
                    $this->database->where($p['campo']);
                }
            }
        } 

        if (!is_array($ordem) == null) {
            $this->database->order_by($ordem['campo'], $ordem['ordem']);
        }
        
        $result = $this->database->get($this->view); 
        // echo $this->database->last_query();
        //$errom = $this->db->_error_message();
        return $result;
        
    }
            
     // FUNÇÃO PARA IR FILTRANDO
    // ATRASVÉS DOS CAMPOS DA TABELA
    // RETORNA UM OBJETO/ARRAY
    public function filtrar_buscar($param, $like = null, $ordem = null)
    {

        if (is_array($param)) {
            foreach ($param as $p) {
                if ($p['valor'] != '') {
                    $this->database->where($p['campo'], $p['valor']);
                } else {
                    $this->database->where($p['campo']);
                }
            }
        }

        if (!is_array($like) == null) {
            foreach ($like as $l) {
                if ($l['valor'] != '') {
                    $this->database->like( $l['campo'], $l['valor']);
                }
            }
        }

        if (!is_array($ordem) == null) {
            $this->database->order_by($ordem['campo'], $ordem['ordem']);
        }
        $result = $this->database->get($this->view);
        // echo $this->database->last_query();
        return ($result);
        
    }
    
    // FUNÇÃO PARA IR FILTRANDO
    // ATRASVÉS DOS CAMPOS DA TABELA
    // RETORNA UM OBJETO/ARRAY
    public function filtrar_distinct($param = null, $ordem = null, $coluna = '')
    {
        $this->database->distinct();
        
        if(strlen($coluna) > 0)
            $this->database->select($coluna);

        if (!is_array($param) == null) {
            foreach ($param as $p) {
                if ($p['valor'] != '') {
                    $this->database->where($p['campo'], $p['valor']);
                } else {
                    $this->database->where($p['campo']);
                }
            }
        }

        if (!is_array($ordem) == null) {
            $this->database->order_by($ordem['campo'], $ordem['ordem']);
        }

        $result = $this->database->get($this->view);
        // echo $this->db->last_query();
        return $result;
    }
    
    // FUNÇÃO PARA IR FILTRANDO
    // ATRASVÉS DOS CAMPOS DA TABELA
    // RETORNA UM OBJETO/ARRAY
    public function filtrar_campo($param = null, $ordem = null, $coluna = '')
    {
        
        if(strlen($coluna) > 0)
            $this->database->select($coluna);

        if (!is_array($param) == null) {
            foreach ($param as $p) {
                if ($p['valor'] != '') {
                    $this->database->where($p['campo'], $p['valor']);
                } else {
                    $this->database->where($p['campo']);
                }
            }
        }

        if (!is_array($ordem) == null) {
            $this->database->order_by($ordem['campo'], $ordem['ordem']);
        }

        $result = $this->database->get($this->view);
        // echo $this->db->last_query();
        return $result;
    }

    // FUNÇÃO PARA PEGAR ATRIBUTOS DA TABELA
    public function atributo()
    { 
        $table = explode('.', $this->table);
        $this->database->select(' column_name as coluna, data_type as tipo ');
        $this->database->where('table_schema', $table[0]);
        $this->database->where('table_name', $table[1]); 
        $result = $this->database->get('information_schema.columns')->result_object(); 
        // echo $this->database->last_query();
        return $result;
    }
    
    public function atrbtype($value, $type)
    {
        $return = $value;
        switch ($type) {
            case 'varchar':
                $return = (($value == '') ? null : $value);
            break;
            case 'character varying':
                $return = (($value == '') ? null : $value);
            break;
            case 'decimal':
                $return = (($value == '') ? 0 : str_replace(',', '.', $value));
            break;
            case 'numeric':
                $return = (($value == '') ? 0 : str_replace(',', '.', $value));
            break;
            case 'double':
                $return = (($value == '') ? 0 : str_replace(',', '.', $value));
            break;
            case 'integer':
                $cnpj = '';
                $cnpj = str_replace('.', '', $value);
                $cnpj = str_replace('-', '', $cnpj);
                $cnpj = str_replace('/', '', $cnpj);
                $cnpj = str_replace('(', '', $cnpj);
                $cnpj = str_replace(')', '', $cnpj);
                $cnpj = str_replace(' ', '', $cnpj);
                $return = (($cnpj == '') ? NULL : intval($cnpj));
            break;
            case 'bigint':
                $bigint = '';
                $bigint = str_replace('.', '', $value);
                $bigint = str_replace('-', '', $bigint);
                $bigint = str_replace('/', '', $bigint);
                $bigint = str_replace('(', '', $bigint);
                $bigint = str_replace(')', '', $bigint);
                $bigint = str_replace(' ', '', $bigint);
                $return = (($bigint == '') ? NULL : intval($bigint));
            break;
            case 'cpf':
                $bigint = '';
                $bigint = str_replace('.', '', $value);
                $bigint = str_replace('-', '', $bigint);
                $bigint = str_replace('/', '', $bigint);
                $bigint = str_replace('(', '', $bigint);
                $bigint = str_replace(')', '', $bigint);
                $bigint = str_replace(' ', '', $bigint);
                $return = $bigint;
            break;
            case 'character':
                $return = (($value == '') ? 'S' : $value);
            break;
            case 'data':
                $return = (($value == '') ? null : date('Y-m-d', strtotime(implode("-", array_reverse(explode("/", $value))))));
            break;
        }
        return $return;
    }
    
    // FUNCAO PARA INSERIR
    public function insert_batch($data)
    {
        try {
            
            $res = $this->database->insert_batch($this->table, $data);
            $erro = $res->error_message;
            if(strlen($erro[2]) == 0){
                $retorno = array(
                    'retorno' => 'success',
                    'heading' => 'Sucesso',
                    'text'    => 'Cadastro atualizado com sucesso!',
                    'icon'    => 'success',
                    'msg'     => $this->database->last_query(),
                    'id'      => $this->db->insert_id(),
                );
                $this->logs($this->database->last_query(),'SUCCESS');
                return $retorno;
            }else{
                //$log = new Dblog_lib();
                $part = explode('DETAIL:',$erro[2]);
                //$log->log = $part[0];
                //$conversao = $log->retorno();
                throw new Exception($part[0]);
            }
        } catch (Exception $e) {
            $retorno = array(
                'retorno' => 'error',
                'heading' => 'Error',
                'text' => $e->getMessage(),
                'icon' => 'danger',
                'msg'   => $this->database->last_query()
            );
            $this->logs($this->database->last_query(),'ERRO');
            return ($retorno);
        }
    }

    // FUNCAO PARA INSERIR
    public function inserir($data)
    {
        try {
            
            $res = $this->database->insert($this->table, $data);
            if(strlen($res->message) == 0)
            {
                $retorno = array(
                    'retorno' => 'success',
                    'heading' => 'Sucesso',
                    'text' => 'Cadastro atualizado com sucesso!',
                    'icon' => 'success',
                    'icon-mdi' => 'check-all',
                    'msg'   => $this->database->last_query()
                ); 
                return $retorno;
            }
            else
            {
                throw new Exception($res->message);
            }
        } catch (Exception $e) {
            $retorno = array(
                'retorno' => 'error',
                'heading' => 'Error',
                'text' => $e->getMessage(),
                'icon' => 'danger',
                'icon-mdi' => 'block-helper',
                'msg'   => $this->database->last_query()
            );  
            return ($retorno);
        }
    }

    // FUNCAO PARA EDITAR
    public function editar($key, $param)
    {

        try {
            
            if (is_array($key) == null || is_array($param) == null) {
                $retorno = array(
                    'retorno'  => 'error',
                    'heading'  => 'Error',
                    'text'     => 'Informe todos os campos obrigatórios.',
                    'icon'     => 'danger',
                    'icon-mdi' => 'check-all',
                    'msg'      => $this->database->last_query()
                );
                return ($retorno);
            } 

            // PEGA OS VALOR A SEREM ATUALIZADOS
            foreach ($param as $p) {
                if ($p['valor'] != 'null') {
                    $this->database->set($p['campo'], $p['valor']);
                }elseif ($p['valor'] == null) {
                    $this->database->set($p['campo'], null);
                }else {
                    $this->database->set($p['campo']);
                }
            }

            // PEGA A CHAVE DA TABELA
            foreach ($key as $k) {
                $this->database->where($k['campo'], $k['valor']);
            }
            
            $res = $this->database->update($this->table);
            
            if(strlen($res->message) == 0)
            {
                $retorno = array(
                    'retorno' => 'success',
                    'heading' => 'Sucesso',
                    'text' => 'Registro salvo com sucesso!',
                    'icon' => 'warning',
                    'icon-mdi' => 'check-all',
                    'msg'   => $this->database->last_query()
                );
                return $retorno;
            }
            else
            {  
                throw new Exception($res->message);
            }
        } catch (Exception $e) {
            $retorno = array(
                'retorno' => 'error',
                'heading' => 'Error',
                'text' => $e->getMessage(),
                'icon' => 'danger',
                'icon-mdi' => 'block-helper',
                'msg'   => $this->database->last_query()
            ); 
            return ($retorno);
        }
        
        

    }

    // FUNCAO PARA DELETAR
    public function deletar($param)
    {
        try {
            if (is_array($param) == null) {
                return null;
            }
            foreach ($param as $p) {
                $this->database->where($p['campo'], $p['valor']);
            }
            $res = $this->database->delete($this->table);
            
            if(strlen($res->message) == 0)
            {
                $retorno = array(
                    'retorno' => 'success',
                    'heading' => 'Sucesso',
                    'text' => 'Registro excluído com sucesso!',
                    'icon' => 'success',
                    'icon-mdi' => 'check-all',
                    'msg'   => $this->database->last_query()
                ); 
                return $retorno;
            }
            else
            { 
                throw new Exception($res->message);
            }
        } catch (Exception $e) {
            $retorno = array(
                'retorno' => 'error',
                'heading' => 'Error',
                'text' => $e->getMessage(),
                'icon' => 'danger',
                'icon-mdi' => 'block-helper',
                'msg'   => $this->database->last_query()
            );
            return ($retorno);
        }
        
    }

    // FUNCAO PARA SELECT COM FUNCTION
    public function procedure($funcao, $param)
    {

        $fields = '';
        foreach ($param as $p) {
            $fields .= $p . ',';
        }
        $fields = substr($fields, 0, -1);
        
        
        try {
            
            $res = $this->database->query("CALL " . $funcao . "(" . $fields . ")"); 
            
            if(strlen($res->message) == 0)
            {
                $retorno = array(
                    'retorno' => 'success',
                    'heading' => 'Sucesso',
                    'text' => 'Cadastro atualizado com sucesso!',
                    'icon' => 'success',
                    'msg'   => $this->database->last_query()
                ); 
                return $retorno;
            }
            else
            { 
                throw new Exception($res->message);
            }
        } catch (Exception $e) {
            $retorno = array(
                'retorno' => 'error',
                'heading' => 'Error',
                'text' => $e->getMessage(),
                'icon' => 'danger',
                'msg'   => $this->database->last_query()
            );
            return ($retorno);
        }  

    }

    public function rquery($param, $ordem = null)
    {

        if (is_array($param)) {
            foreach ($param as $p) {
                if ($p['valor'] != '') {
                    $this->database->where($p['campo'], $p['valor']);
                }
            }
        }

        if (!is_array($ordem) == null) {
            $this->database->order_by($ordem['campo'], $ordem['ordem']);
        }

        $result = $this->database->get($this->view);
        //echo $this->database->last_query();
        return $result;
    }
    
    public function views($view, $param, $ordem = null)
    {

        if (is_array($param)) {
            foreach ($param as $p) {
                if ($p['valor'] != '') {
                    $this->database->where($p['campo'], $p['valor']);
                }else{
                    $this->database->where($p['campo']);
                }
            }
        }

        if (!is_array($ordem) == null) {
            $this->database->order_by($ordem['campo'], $ordem['ordem']);
        }

        $result = $this->database->get($view);
        //print_r($result);
        // echo $this->database->last_query(); 
        return $result;
    }
    
    public function sqlquery($query)
    {
            
        $result = $this->database->query($query);
        //echo $this->db->last_query();
        return $result;
    } 

}
