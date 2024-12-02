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
    <title>Formulario de Registro</title>
</head>
<body>

    <h2>Formulario de Registro</h2>
    <form method="post" action="procesar.php">

        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        <span style="color: red;">* <?php echo $nameErr; ?></span><br><br>

        <label for="age">Edad:</label><br>
        <input type="text" id="age" name="age" value="<?php echo $age; ?>">
        <span style="color: red;">* <?php echo $ageErr; ?></span><br><br>

        <label for="email">Correo Electrónico:</label><br>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span style="color: red;">* <?php echo $emailErr; ?></span><br><br>

        <label for="address">Dirección:</label><br>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>">
        <span style="color: red;">* <?php echo $addressErr; ?></span><br><br>

        <label for="phone">Teléfono (10 dígitos):</label><br>
        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
        <span style="color: red;">* <?php echo $phoneErr; ?></span><br><br>

        <label for="birthdate">Fecha de Nacimiento:</label><br>
        <input type="date" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>">
        <span style="color: red;">* <?php echo $birthdateErr; ?></span><br><br>

        <label for="course">Curso (Tiempo libre):</label><br>
        <select id="course" name="course">
            <option value="">Selecciona un curso</option>
            <option value="Fotografía" <?php if ($course == "Fotografía") echo "selected"; ?>>Fotografía</option>
            <option value="Buceo" <?php if ($course == "Buceo") echo "selected"; ?>>Buceo</option>
            <option value="Baile" <?php if ($course == "Baile") echo "selected"; ?>>Baile</option>
        </select>
        <span style="color: red;">* <?php echo $courseErr; ?></span><br><br>

        <label>Género al nacer:</label><br>
        <input type="radio" id="femenino" name="gender" value="Femenino" <?php if ($gender == "Femenino") echo "checked"; ?>>
        <label for="femenino">Femenino</label><br>
        <input type="radio" id="masculino" name="gender" value="Masculino" <?php if ($gender == "Masculino") echo "checked"; ?>>
        <label for="masculino">Masculino</label><br>
        <span style="color: red;">* <?php echo $genderErr; ?></span><br><br>

        <label>Áreas de interés:</label><br>
        <input type="checkbox" id="cine" name="interests[]" value="Cine" <?php if (in_array("Cine", $interests)) echo "checked"; ?>>
        <label for="cine">Cine</label><br>
        <input type="checkbox" id="personajes" name="interests[]" value="Personajes Destacados" <?php if (in_array("Personajes Destacados", $interests)) echo "checked"; ?>>
        <label for="personajes">Personajes Destacados</label><br>
        <input type="checkbox" id="arquitectura" name="interests[]" value="Arquitectura Religiosa" <?php if (in_array("Arquitectura Religiosa", $interests)) echo "checked"; ?>>
        <label for="arquitectura">Arquitectura Religiosa</label><br>
        <input type="checkbox" id="paisajes" name="interests[]" value="Paisajes Naturales" <?php if (in_array("Paisajes Naturales", $interests)) echo "checked"; ?>>
        <label for="paisajes">Paisajes Naturales</label><br>
        <input type="checkbox" id="tendencias" name="interests[]" value="Tendencias culturales" <?php if (in_array("Tendencias culturales", $interests)) echo "checked"; ?>>
        <label for="tendencias">Tendencias culturales</label><br>
        <span style="color: red;">* <?php echo $interestsErr; ?></span><br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php
    // Mostrar los datos si el formulario ha sido enviado y es válido
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $nameErr == "" && $ageErr == "" && $emailErr == "" && $addressErr == "" && $phoneErr == "" && $birthdateErr == "" && $courseErr == "" && $genderErr == "" && $interestsErr == "") {
        echo "<h3>Información recibida:</h3>";
        echo "Nombre: " . $name . "<br>";
        echo "Edad: " . $age . "<br>";
        echo "Correo electrónico: " . $email . "<br>";
        echo "Dirección: " . $address . "<br>";
        echo "Teléfono: " . $phone . "<br>";
        echo "Fecha de nacimiento: " . $birthdate . "<br>";
        echo "Curso seleccionado: " . $course . "<br>";
        echo "Género al nacer: " . $gender . "<br>";
        echo "Áreas de interés: " . implode(", ", $interests) . "<br>";
    }
    ?>

</body>
</html>
