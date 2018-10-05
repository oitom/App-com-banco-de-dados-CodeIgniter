1    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
2
3    class Endereco_Model extends CI_Model{
4
5        var $codigo_endereco;
6        var $codigo_cliente;
7        var $logradouro;
8        var $numero;
9        var $cep;
10        var $estado;
11        var $cidade;
12        var $bairro;
13
14        public function get()
15        {
16            $where = array();
17            if ($this->codigo_endereco)
18                $where['codigo_endereco'] = $this->codigo_endereco;
19            if ($this->codigo_cliente)
20                $where['codigo_cliente'] = $this->codigo_cliente;
21
22            $query = $this->db->get_where('enderecos', $where);
23
24            return $query->result();
25        }
26
27        public function insert()
28       {
29            $data = array(
30                'codigo_cliente'  => $this->codigo_cliente,
31                'logradouro'  => $this->logradouro,
32                'numero'      => $this->numero,
33                'cep'     	  => $this->cep,
34                'estado'      => $this->estado,
35                'cidade'      => $this->cidade,
36                'bairro'      => $this->bairro
37            );
38            $this->db->insert('enderecos', $data);
39        }
40
41        public function delete()
42        {
43            $where = array();
44            if ($this->codigo_endereco)
45                $where['codigo_endereco'] = $this->codigo_endereco;
46            if ($this->codigo_cliente)
47                $where['codigo_cliente'] = $this->codigo_cliente;
48
49            $this->db->delete('enderecos', $where);
50        }
51
52    }