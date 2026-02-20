<?php
$db = new SQLite3(__DIR__ . '/tickets.db');

$db->exec("
CREATE TABLE IF NOT EXISTS tickets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT,
    email TEXT,
    problema TEXT,
    estado TEXT
)");
