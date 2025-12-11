<?php
include("conexion.php");


if (!isset($conn) || $conn->connect_errno) {
    die("<h3 style='color:red;'> No hay conexión activa con la base de datos.</h3>");
}

$numero_ticket = $_POST['numero_ticket'] ?? '';
$nombre_usuario = $_POST['nombre_usuario'] ?? '';
$correo = $_POST['correo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$foto = '';


if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = basename($_FILES['foto']['name']);
    $rutaTemporal = $_FILES['foto']['tmp_name'];
    $rutaDestino = __DIR__ . '/../uploads/' . $foto;

    if (!is_dir(__DIR__ . '/../uploads')) {
        mkdir(__DIR__ . '/../uploads', 0777, true);
    }

    if (!move_uploaded_file($rutaTemporal, $rutaDestino)) {
        echo "<h3 style='color:red;'> Error al mover la foto. Revisa permisos o ruta.</h3>";
        exit;
    }
} else {
    echo "<h3 style='color:red;'> No se cargó ninguna imagen o hubo un error al subirla.</h3>";
    exit;
}

if ($conn->ping()) {
    $stmt = $conn->prepare("INSERT INTO tickets (numero_ticket, nombre_usuario, correo, descripcion, foto)
                            VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("<h3 style='color:red;'> Error en prepare(): " . $conn->error . "</h3>");
    }

    $stmt->bind_param("sssss", $numero_ticket, $nombre_usuario, $correo, $descripcion, $foto);

    if ($stmt->execute()) {
        echo "
        <div style='
            font-family: Arial, sans-serif;
            background-color: #e6f4ff;
            padding: 30px;
            margin: 40px auto;
            border-radius: 15px;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        '>
            <h2 style='color: #007bff;'> Ticket guardado correctamente</h2>
            <p><strong>Número de ticket:</strong> $numero_ticket</p>
            <p><strong>Usuario:</strong> $nombre_usuario</p>
            <p><strong>Correo:</strong> $correo</p>
            <p><strong>Descripción:</strong> $descripcion</p>
            <p><strong>Foto cargada:</strong> $foto</p>

            <a href='../index.html' style='
                display: inline-block;
                margin-top: 20px;
                background-color: #007bff;
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: bold;
                transition: background 0.3s ease;
            ' onmouseover=\"this.style.backgroundColor='#0056b3'\" onmouseout=\"this.style.backgroundColor='#007bff'\">
                🔙 Volver al inicio
            </a>
        </div>
        ";
    } else {
        echo "<h3 style='color:red;'> Error al guardar el ticket: " . $stmt->error . "</h3>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h3 style='color:red;'> Conexión perdida con la base de datos antes de ejecutar el INSERT.</h3>";
}
?>
