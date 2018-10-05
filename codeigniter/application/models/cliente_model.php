1    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
2
3    class Cliente_Model extends CI_Model
4    {
5        var $codigo_cliente;
6        var $nome;
7        var $telefone;
8        var $cpf;
9
10        public function get()
11        {
12            $where = array('codigo_cliente' => $this->codigo_cliente);
13            $query = $this->db->get_where('clientes', $where);
14
15            return $query->result();
16        }
17
18        public function getJoin($tabela = array())
19        {
20            $cliente = $this->get();
21
22            if(isset($tabela["endereco"])) {
23                $this->load->model("endereco_model", "EnderecoJoin");
24                $this->EnderecoJoin->codigo_cliente = $this->codigo_cliente;
25                $cliente["endereco"] = $this->EnderecoJoin->get();
26            }
27            return $cliente;
28        }
29
30        public function insert()
31        {
32            $data = array(
33                'nome'  => $this->nome,
34                'telefone'  => $this->telefone,
35                'cpf'  => $this->cpf
36            );
37            $this->db->insert('clientes', $data);
38        }
39
40        public function update()
41        {
42            $where = array();
43            if ($this->codigo_cliente)
44                $where['codigo_cliente'] = $this->codigo_cliente;
45            if ($this->nome)
46                $where['nome'] = $this->nome;
47            if ($this->telefone)
48                $where['telefone'] = $this->telefone;
49            if ($this->cpf)
50                $where['cpf'] = $this->cpf;
51
52            $this->db->where('codigo_cliente', $this->codigo_cliente);
53            $this->db->update('clientes', $where);
54        }
55
56        public function delete()
57        {
58            $this->load->model("endereco_model", "EnderecoDeletar");
59
60            $where = array();
61            if ($this->codigo_cliente)
62                $where['codigo_cliente'] = $this->codigo_cliente;
63
64            $this->EnderecoDeletar->codigo_cliente = $this->codigo_cliente;
65
66            if(!empty($this->EnderecoDeletar->get()))
67                $this->EnderecoDeletar->delete();
68
69            $this->db->delete('clientes', $where);
70        }
71
72        public function lastId()
73        {
74            return $this->db->insert_id();
75        }
76    }