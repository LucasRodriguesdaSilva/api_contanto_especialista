# Fale com um Especialista - API

Esta API permite que usuários enviem solicitações de contato para especialistas com base em serviços específicos. A API recebe informações via formulário e, com base no serviço solicitado, envia um e-mail para o especialista correspondente e uma confirmação para o usuário.

## Instalação

1. Clone este repositório:
   ```bash
   git clone https://github.com/seu-usuario/api_contanto_especialista.git
   cd api_contanto_especialista
   ```

2. Instale as dependências do projeto:
   ```bash
   composer install
   ```

3. Crie o arquivo `.env`:
   ```bash
   cp .env.example .env
   ```

4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

## Configuração

### Banco de Dados

1. Configure o banco de dados no arquivo `.env`:
   ```dotenv
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

2. Configure o banco de dados de testes para usar SQLite:
   ```dotenv
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database_test.sqlite
   ```

3. Execute as migrations:
   ```bash
   php artisan migrate --seed

   php artisan migrate --seed --env=testing
   ```

### E-mail

1. Configure as credenciais de e-mail no arquivo `.env`:
   ```dotenv
    MAIL_MAILER=log
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"
   ```

## Contribuição

Sinta-se à vontade para contribuir com este projeto através de pull requests. Toda contribuição é bem-vinda!

## Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.