# Named PDO connections

Pequena biblioteca PHP 8.2+ para selecionar uma conexão PDO por alias. Refatoração de um exercício de 2019: configuração explícita, exceções, prepared statements reais e ausência de credenciais no código. Drivers aceitos: MySQL, PostgreSQL e SQLite.

```php
require 'Conexao.php';
$connection = new Conexao('default'); // DB_DSN, DB_USER e DB_PASSWORD no ambiente
$statement = $connection->connection()->prepare('SELECT name FROM people WHERE id = :id');
$statement->execute(['id' => 1]);
$person = $statement->fetch();
```

Alternativamente, passe um mapa de configurações como segundo argumento. `$_bd` permanece disponível para leitura. A classe agora usa composição em vez de herdar de PDO sem inicializar sua classe pai. Os setters de credenciais/banco foram removidos: mudar configuração exige uma nova conexão, evitando `USE` construído com entrada livre. Essa é uma mudança intencional da API antiga.

Teste reproduzível sem banco externo:

```sh
docker run --rm -v "$PWD:/app" -w /app php:8.4-cli php tests/run.php
```

Com PHP local: `php tests/run.php`. SQLite/PDO precisa estar habilitado. Para MySQL/PostgreSQL instale `pdo_mysql`/`pdo_pgsql` na sua imagem. As exceções devem ser tratadas na borda da aplicação; não envie DSNs ou stack traces para o cliente. Não há gerenciador de migrations, pool ou ORM: a proposta é demonstrar uso seguro e pequeno de PDO.
