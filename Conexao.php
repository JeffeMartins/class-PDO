<?php
declare(strict_types=1);

/** Select a named, explicitly supplied connection; never interpolate a database name into SQL. */
final class Conexao
{
    public readonly PDO $_bd;

    /** @param array<string, array{dsn:string, username?:string, password?:string}> $connections */
    public function __construct(string $namebd, array $connections = [])
    {
        if ($connections === []) {
            $dsn = getenv('DB_DSN');
            if ($dsn === false || $dsn === '') {
                throw new InvalidArgumentException('Configure DB_DSN or pass a named connection map.');
            }
            $connections = ['default' => ['dsn' => $dsn, 'username' => getenv('DB_USER') ?: '', 'password' => getenv('DB_PASSWORD') ?: '']];
        }
        if (!isset($connections[$namebd])) {
            throw new InvalidArgumentException('Unknown connection alias.');
        }
        $config = $connections[$namebd];
        if (!preg_match('/^(mysql|pgsql|sqlite):/', $config['dsn'])) {
            throw new InvalidArgumentException('Supported drivers: mysql, pgsql and sqlite.');
        }
        $this->_bd = new PDO($config['dsn'], $config['username'] ?? '', $config['password'] ?? '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    public function connection(): PDO { return $this->_bd; }
}
