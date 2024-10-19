# Todo List

Este é um projeto de lista de tarefas (todo-list) que utiliza uma arquitetura de microsserviços com Docker Compose.

## Como Rodar

Para rodar o projeto, siga os passos abaixo:

1. Certifique-se de que as portas `40000`, `40001` e `3000` estão liberadas no seu sistema.
2. Execute o comando abaixo para iniciar os serviços:

    ```sh
    docker-compose up -d
    ```

3. Após os serviços serem iniciados, acesse `http://localhost:3000` no seu navegador.

## Login Padrão

- **Usuário:** admin
- **Senha:** 123456

## Estrutura do Projeto

- **backend-express:** Backend em Node.js com Express.
- **frontend-react:** Frontend em React.
- **sistema-legado-php:** Sistema legado em PHP.

## Serviços

- **todo-php:** Serviço PHP rodando na porta `40000`.
- **todo-express:** Serviço Express rodando na porta `40001`.
- **todo-react:** Serviço React rodando na porta `3000`.

## Docker Compose

O arquivo `docker-compose.yml` define os serviços e suas configurações. Certifique-se de que o Docker e o Docker Compose estão instalados no seu sistema antes de rodar o comando.

---

Para mais informações, consulte a documentação de cada serviço nos respectivos diretórios.