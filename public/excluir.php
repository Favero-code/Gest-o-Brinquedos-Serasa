<?php
require_once "../config/conexao.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}
