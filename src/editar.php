<?php
require 'conexion.php';

$mensaje = '';
$registro = null;

// Buscar el registro a editar
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM registros WHERE id = ?");
    $stmt->execute([$id]);
    $registro = $stmt->fetch();
}

// Guardar los cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = (int) $_POST['id'];
    $nombre  = htmlspecialchars(trim($_POST['nombre']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $msg     = htmlspecialchars(trim($_POST['mensaje']));

    $stmt = $pdo->prepare("UPDATE registros SET nombre=?, email=?, mensaje=? WHERE id=?");
    $stmt->execute([$nombre, $email, $msg, $id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <style>
        body { font-family: sans-serif; max-width: 700px; margin: 40px auto; padding: 0 20px; }
        input, textarea { width: 100%; padding: 8px; margin: 6px 0 14px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #3B8BD4; color: white; border: none; padding: 10px 24px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #2a70bb; }
        a { color: #3B8BD4; }
    </style>
</head>
<body>
    <h1>Editar Registro</h1>
    <?php if ($registro): ?>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $registro['id'] ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $registro['nombre'] ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?= $registro['email'] ?>" required>
        <label>Mensaje:</label>
        <textarea name="mensaje" rows="4"><?= $registro['mensaje'] ?></textarea>
        <button type="submit">Guardar Cambios</button>
    </form>
    <?php else: ?>
        <p>Registro no encontrado. <a href="index.php">Volver</a></p>
    <?php endif; ?>
</body>
</html>