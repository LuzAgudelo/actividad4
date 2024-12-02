<?php
// Definir variables y establecer valores vacíos
$name = $age = $email = $address = $phone = $birthdate = $course = $gender = "";
$interests = [];
$nameErr = $ageErr = $emailErr = $addressErr = $phoneErr = $birthdateErr = $courseErr = $genderErr = $interestsErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    if (empty($_POST["name"])) {
        $nameErr = "El nombre es obligatorio";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validar edad
    if (empty($_POST["age"])) {
        $ageErr = "La edad es obligatoria";
    } else {
        $age = test_input($_POST["age"]);
    }

    // Validar correo electrónico
    if (empty($_POST["email"])) {
        $emailErr = "El correo electrónico es obligatorio";
    } else {
        $email = test_input($_POST["email"]);
        // Verificar formato de correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de correo electrónico inválido";
        }
    }

    // Validar dirección
    if (empty($_POST["address"])) {
        $addressErr = "La dirección es obligatoria";
    } else {
        $address = test_input($_POST["address"]);
    }

    // Validar teléfono
    if (empty($_POST["phone"])) {
        $phoneErr = "El teléfono es obligatorio";
    } else {
        $phone = test_input($_POST["phone"]);
        // Verificar si el teléfono es válido (solo números)
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "El teléfono debe ser un número de 10 dígitos";
        }
    }

    // Validar fecha de nacimiento
    if (empty($_POST["birthdate"])) {
        $birthdateErr = "La fecha de nacimiento es obligatoria";
    } else {
        $birthdate = test_input($_POST["birthdate"]);
    }

    // Validar curso seleccionado
    if (empty($_POST["course"])) {
        $courseErr = "Debes seleccionar un curso";
    } else {
        $course = test_input($_POST["course"]);
    }

    // Validar género
    if (empty($_POST["gender"])) {
        $genderErr = "Debes seleccionar un género";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Validar áreas de interés
    if (empty($_POST["interests"])) {
        $interestsErr = "Debes seleccionar al menos un área de interés";
    } else {
        $interests = $_POST["interests"];
    }

    // Mostrar los datos si no hay errores
    if (empty($nameErr) && empty($ageErr) && empty($emailErr) && empty($addressErr) && empty($phoneErr) && empty($birthdateErr) && empty($courseErr) && empty($genderErr) && empty($interestsErr)) {
        echo "<h2>Datos recibidos:</h2>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Campo</th><th>Valor</th></tr>";
        echo "<tr><td><strong>Nombre:</strong></td><td>" . $name . "</td></tr>";
        echo "<tr><td><strong>Edad:</strong></td><td>" . $age . "</td></tr>";
        echo "<tr><td><strong>Correo electrónico:</strong></td><td>" . $email . "</td></tr>";
        echo "<tr><td><strong>Dirección:</strong></td><td>" . $address . "</td></tr>";
        echo "<tr><td><strong>Teléfono:</strong></td><td>" . $phone . "</td></tr>";
        echo "<tr><td><strong>Fecha de nacimiento:</strong></td><td>" . $birthdate . "</td></tr>";
        echo "<tr><td><strong>Curso seleccionado:</strong></td><td>" . $course . "</td></tr>";
        echo "<tr><td><strong>Género al nacer:</strong></td><td>" . $gender . "</td></tr>";
        echo "<tr><td><strong>Áreas de interés:</strong></td><td>" . implode(", ", $interests) . "</td></tr>";
        echo "</table>";
    } else {
        // Si hay errores, mostrar los mensajes de error
        echo "<h2>Errores en los datos:</h2>";
        echo "<ul>";
        if ($nameErr) echo "<li>" . $nameErr . "</li>";
        if ($ageErr) echo "<li>" . $ageErr . "</li>";
        if ($emailErr) echo "<li>" . $emailErr . "</li>";
        if ($addressErr) echo "<li>" . $addressErr . "</li>";
        if ($phoneErr) echo "<li>" . $phoneErr . "</li>";
        if ($birthdateErr) echo "<li>" . $birthdateErr . "</li>";
        if ($courseErr) echo "<li>" . $courseErr . "</li>";
        if ($genderErr) echo "<li>" . $genderErr . "</li>";
        if ($interestsErr) echo "<li>" . $interestsErr . "</li>";
        echo "</ul>";
    }
}

// Función para limpiar los datos recibidos
function test_input($data) {
    $data = trim($data);  // Elimina espacios extra al principio y final
    $data = stripslashes($data);  // Elimina barras invertidas
    $data = htmlspecialchars($data);  // Convierte caracteres especiales en entidades HTML
    return $data;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Formulario</title>
</head>
<body>

    <h1>Resultado del Formulario</h1>

    <p><a href="index.php">Volver al formulario</a></p>

</body>
</html>
