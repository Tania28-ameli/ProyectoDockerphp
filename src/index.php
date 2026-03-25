<?php
require 'conexion.php';
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre  = htmlspecialchars(trim($_POST['nombre']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $msg     = htmlspecialchars(trim($_POST['mensaje']));
    if ($nombre && $email) {
        $stmt = $pdo->prepare("INSERT INTO registros (nombre, email, mensaje) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $msg]);
        $mensaje = "<p class='exito'>✅ Registro guardado correctamente.</p>";
    }
}
$registros = $pdo->query("SELECT * FROM registros ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proyecto Docker PHP + MySQL</title>
    <style>
        body { font-family: sans-serif; max-width: 700px; margin: 40px auto; padding: 0 20px; }
        input, textarea { width: 100%; padding: 8px; margin: 6px 0 14px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #3B8BD4; color: white; border: none; padding: 10px 24px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #2a70bb; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background: #f0f0f0; }
        .exito { color: green; }
        /* ← NUEVO: estilo para el botón editar */
        .btn-editar { color: #3B8BD4; text-decoration: none; font-weight: bold; }
        .btn-editar:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Formulario de Registros</h1>
    <?= $mensaje ?>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Mensaje:</label>
        <textarea name="mensaje" rows="4"></textarea>
        <button type="submit">Guardar Registro</button>
    </form>
    <h2>Registros Guardados</h2>
    <table>
        <!-- ← NUEVO: se agregó columna Acciones -->
        <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Mensaje</th><th>Fecha</th><th>Acciones</th></tr>
        <?php foreach ($registros as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= $r['nombre'] ?></td>
            <td><?= $r['email'] ?></td>
            <td><?= $r['mensaje'] ?></td>
            <td><?= $r['created_at'] ?></td>
            <!-- ← NUEVO: enlace a editar.php con el id del registro -->
            <td><a class="btn-editar" href="editar.php?id=<?= $r['id'] ?>">✏️ Editar</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>