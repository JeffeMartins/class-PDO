<?php
declare(strict_types=1);
require __DIR__ . '/../Conexao.php';
function check(bool $condition): void { if (!$condition) { throw new RuntimeException('Check failed'); } }
$db = (new Conexao('test', ['test' => ['dsn' => 'sqlite::memory:']]))->connection();
$db->exec('CREATE TABLE people (name TEXT NOT NULL)');
$statement = $db->prepare('INSERT INTO people (name) VALUES (:name)');
$statement->execute(['name' => "Alice'); DROP TABLE people;--"]);
check((int)$db->query('SELECT COUNT(*) FROM people')->fetchColumn() === 1);
try { new Conexao('missing', ['test' => ['dsn' => 'sqlite::memory:']]); throw new RuntimeException('Expected invalid alias'); }
catch (InvalidArgumentException) {}
try { $db->query('SELECT * FROM missing_table'); throw new RuntimeException('Expected PDO exception'); }
catch (PDOException) {}
echo "Connection, parameter binding, invalid alias and SQL error tests passed.\n";
