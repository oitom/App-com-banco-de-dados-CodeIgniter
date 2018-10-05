1    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
2
3    class Home extends CI_Controller
4    {
5        public function index()
6        {
7            $this->load->database();
8
9            // INSERT CLIENTE
10            $this->load->model("cliente_model", "Cliente1");
11            $this->Cliente1->nome = $this->input->post("nome");
12            $this->Cliente1->telefone = $this->input->post("telefone");
13            $this->Cliente1->cpf = $this->input->post("cpf");
14            $this->Cliente1->insert();
15
16            // INSERT CLIENTE ENDEREÇO
17            $this->load->model("cliente_model", "Cliente2");
18            $this->Cliente2->nome = $this->input->post("nome");
19            $this->Cliente2->telefone = $this->input->post("telefone");
20            $this->Cliente2->cpf = $this->input->post("cpf");
21            $this->Cliente2->insert();
22
23            $this->load->model("endereco_model", "Endereco");
24            $this->Endereco->codigo_cliente = $this->Cliente2->lastId();
25            $this->Endereco->logradouro = $this->input->post("logradouro");
26            $this->Endereco->numero = $this->input->post("numero");
27            $this->Endereco->cep = $this->input->post("cep");
28            $this->Endereco->estado = $this->input->post("estado");
29            $this->Endereco->cidade = $this->input->post("cidade");
30            $this->Endereco->bairro= $this->input->post("bairro");
31            $this->Endereco->insert();
32
33            // UPDATE CLIENTE
34            $this->load->model("cliente_model", "ClienteEditar");
35            $this->ClienteEditar->codigo_cliente = $this->input->post("codigo");
36            $this->ClienteEditar->nome = $this->input->post("nome");
37            $this->ClienteEditar->telefone = $this->input->post("telefone");
38            $this->ClienteEditar->cpf = $this->input->post("cpf");
39            $this->ClienteEditar->update();
40
41            // DELETE ENDEREÇO
42            $this->load->model("endereco_model", "EnderecoDeletar");
43            $this->EnderecoDeletar->codigo_endereco = $this->input->post("codigo");
44            $this->EnderecoDeletar->delete();
45
46            // DELETE CLIENTE
47            $this->load->model("cliente_model", "ClienteDeletar");
48            $this->ClienteDeletar->codigo_cliente = $this->input->post("codigo");
49            $this->ClienteDeletar->delete();
50
51            // SELECT CLIENTE
52            $this->load->model("cliente_model", "ClienteSelect");
53            $this->ClienteSelect->codigo_cliente = $this->input->post("codigo");
54            $cliente = $this->ClienteSelect->get();
55
56            // SELECT CLIENTE ENDEREÇO
57            $this->load->model("cliente_model", "ClienteSelectJoin");
58            $this->ClienteSelectJoin->codigo_cliente = $this->input->post("codigo");
59            $cliente = $this->ClienteSelectJoin->getJoin(array('endereco' => true));
60        }
61    }