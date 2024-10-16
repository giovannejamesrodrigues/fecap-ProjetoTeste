<p float="left">
  <img src="https://github.com/user-attachments/assets/9bd3241b-89a8-48cf-98f4-6454f5856bf9" width="150" align="left"/>
  <img loading="lazy" src="https://img.shields.io/badge/Processo_Seletivo-2024-24?style=for-the-badge&color=GREEN" align="right"/>
</p>
<br/>
<p>
  <h1 align="center">Teste para Analista Desenvolvedor</h1>
</p>
<p>
  Prezado candidato, este teste foi elaborado em 2 etapas, teórica e pratica.<br/><br/>
  É permitido consulta a internet, documentação e foruns livremente, pedimos apenas que não faça uso de IA para construção do     código e das respostas teóricas.
</p>
<p>
  Este teste tem pontuação máxima de 100 pontos, distribuidos da seguinte forma:
</p>
<ul>
  <li>15 pontos para a parte teórica.</li>
  <li>15 pontos para critérios avaliativos.</li>
  <li>60 pontos para a parte prática.</li>
  <li>5 pontos para entrega e documentação.</li>
  <li>5 pontos para o bonus.</li>
</ul>
<p>
  Você deve clonar esse repositório e responder a parte teórica de multipla escolha e discursiva dentro do arquivo readme no seu repositório que tiver também os códigos da parte prática.
</p>
<p>
  As entidades de banco não precisam ser criadas a partir do código, porém é interessante que tabelas criadas no banco tenham seu script de criação enviados dentro do projeto em um arquivo sql.
</p>
<p>
  :arrow_right: O código deve ser entregue em um repositório Git (GitHub, GitLab, ou Bitbucket)<br/>
  :arrow_right: Inclua um README.md com instruções claras para configurar e executar o projeto<br/>
  :arrow_right: <b>Prazo de entrega:</b> 7 dias a partir do recebimento do teste
</p>
<p><b>:gem: Dica! Não consuma tempo com estilização das paginas do teste pratico, foque na funcionalidade.</b></p>

<h3> 1. Parte Teórica</h3>
<h4> 1.1 Questões de Múltipla Escolha </h4>
<p> :clipboard: Qual das seguintes afirmações sobre o PHP é correta?<br/><br/>
- [ ]<b>a)</b>  PHP é uma linguagem compilada<br/>
- [ ]<b>b)</b>  PHP não suporta programação orientada a objetos<br/>
- [x]<b>c)</b>  PHP pode ser embutido em HTML<br/>
- [ ]<b>d)</b>  PHP não pode ser usado para desenvolvimento de aplicações CLI<br/>
</p>

<p>:clipboard: No contexto do Node.js, o que é o Event Loop?<br/><br/>
- [ ]<b>a)</b>  Uma biblioteca para manipulação de eventos do DOM<br/>
- [x]<b>b)</b>  Um mecanismo que permite I/O não bloqueante<br/>
- [ ]<b>c)</b>  Um framework para criação de interfaces gráficas<br/>
- [ ]<b>d)</b>  Um tipo especial de array para armazenar eventos<br/>
</p>

<p>:clipboard: Qual dos seguintes não é um hook do React?<br/><br/>
- [ ]<b>a)</b>  useState<br/>
- [ ]<b>b)</b>  useEffect<br/>
- [ ]<b>c)</b>  useContext<br/>
- [x]<b>d)</b>  useServer<br/>
</p>

<p>:clipboard: Em Oracle SQL, qual cláusula é usada para combinar linhas de duas ou mais tabelas com base em uma condição relacionada?<br/><br/>
- [ ] <b>a)</b>  MERGE<br/>
- [x] <b>b)</b>  JOIN<br/>
- [ ] <b>c)</b>  UNION<br/>
- [ ] <b>d)</b>  CONNECT<br/>
</p>

<p>:clipboard: Qual é a principal diferença entre let e var em JavaScript?<br/><br/>
- [x]<b>a)</b>  let tem escopo de bloco, enquanto var tem escopo de função<br/>
- [ ]<b>b)</b>  var pode ser redeclarado no mesmo escopo, let não<br/>
- [ ]<b>c)</b>  let é usado apenas em loops, var em qualquer lugar<br/>
- [ ]<b>d)</b>  Não há diferença, são sinônimos<br/>
</p>

<h4>1.2 Questões Discursivas </h4>

<p>:page_with_curl: Explique o conceito de "Injeção de Dependência" e como ele contribui para um código mais modular e testável. Forneça um exemplo prático de sua implementação em PHP ou JavaScript.</p>

> R: A Injeção de Dependência permite que um objeto receba suas dependências externamente, tornando o código mais modular e fácil de testar.
>
>
```php
// Interface do repositório
interface UserRepositoryInterface {
    public function find($id);
}

// Repositório de usuários
class UserRepository implements UserRepositoryInterface {
    public function find($id) {
        return "User with ID: $id";
    }
}

// Serviço de usuários
class UserService {
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getUser($id) {
        return $this->userRepository->find($id);
    }
}

// Uso
$userRepository = new UserRepository();
$userService = new UserService($userRepository);
echo $userService->getUser(1); // Saída: User with ID: 1


class MockUserRepository implements UserRepositoryInterface {
    public function find($id) {
        return "Mocked user with ID: $id";
    }
}

// Teste
$mockUserRepository = new MockUserRepository();
$mockUserService = new UserService($mockUserRepository);
echo $mockUserService->getUser(1); // Saída: Mocked user with ID: 1
```

<p>:page_with_curl: Descreva o padrão de arquitetura MVC (Model-View-Controller) e como você o aplicaria em um projeto que utiliza React no frontend e Node.js no backend. Quais são os benefícios e possíveis desafios dessa abordagem? </p>

> R : O padrão MVC organiza aplicações em três componentes: 
> - Model: que gerencia a lógica de negócios e dados
> - View : que representa a interface do usuário
> - Controller: que atua como intermediário entre Model e View.
>
> Em um projeto com React no frontend e um backend com Node.js, o estado dos componentes do React representa o Model, os componentes em si são a View, e as funções que manipulam eventos atuam como Controller. O backend processa as requisições, interage com o Model e retorna dados em JSON.
>
> Os benefícios incluem uma melhor organização do código e facilidade de manutenção, enquanto os desafios podem ser a complexidade inicial e o gerenciamento de estados em aplicações maiores.

<h3> 2. Parte Prática </h3>
<p>Desenvolva um mini-projeto de gerenciamento de tarefas (To-Do List) que integre as seguintes tecnologias:</p>
<p>
<b>a)</b> Sistema legado em PHP que lê e escreve dados em um banco de dados.<br/>
<b>b)</b> API RESTful em Node.js que se comunica com o sistema PHP.<br/>
<b>c)</b> Interface em React que consome a API Node.js e exibe os dados.<br/>
</p>
<h4>2.1 Requisitos Funcionais</h4>
<ul>
  <li>Listagem de tarefas</li>
  <li>Criação de novas tarefas </li>
  <li>Atualização de tarefas existentes </li>
  <li>Exclusão de tarefas </li>
</ul>
<h4>2.2 Requisitos Técnicos</h4>

<h5>Sistema Legado PHP:</h5>
<p>
  Crie uma classe TaskManager que interaja com o banco de dados 
  Implemente métodos para CRUD (Create, Read, Update, Delete) de tarefas
</p>
<h5>API RESTful Node.js:</h5>
<ul>
  <li> Crie endpoints para cada operação CRUD</li>
  <li> Utilize Express.js para criar a API</li>
  <li> Implemente a comunicação com o sistema PHP legado</li>
</ul>

<h5>Interface React:</h5>
<ul>
  <li> Crie componentes para listar, adicionar, editar e excluir tarefas</li>
  <li> Implemente gerenciamento de estado (por exemplo, usando Context API ou Redux)</li>
  <li> Utilize hooks do React para gerenciar o ciclo de vida dos componentes</li>
</ul>

<p>Bônus (opcional) Implemente uma ou mais das seguintes funcionalidades extras:</p>
<ul>
  <li>Autenticação de usuários com JWT</li>
  <li>Testes unitários para o backend (Node.js) e frontend (React)</li>
  <li>Implementação de um sistema de tags para as tarefas</li>
  <li>Funcionalidade de busca e filtragem de tarefas</li>
</ul>


<h2>Critérios avaliativos deste teste</h2>
<ul>
  <li> Correção funcional do código</li>
  <li> Estrutura e organização do código</li>
  <li> Uso adequado de padrões</li>
  <li> Tratamento de erros e exceções</li>
  <li> Documentação e comentários</li>
  <li> Performance e otimização</li>
</ul>

<h3>Boa Sorte!!</h3>




