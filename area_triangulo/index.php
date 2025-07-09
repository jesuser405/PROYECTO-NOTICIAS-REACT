<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $cateto1 = 5; // Cateto 1
    $cateto2 = 12; // Cateto 2

    $area = ($cateto1 * $cateto2) / 2; // Fórmula del área de un triángulo

    $hipotenusa = sqrt(num:pow($cateto1, 2) + pow($cateto2, 2)); // Fórmula de la hipotenusa usando el teorema de Pitágoras
    // $hipotenusa = sqrt(pow($cateto1, 2) + pow($cateto2, 2)); // Fórmula de la hipotenusa usando el teorema de Pitágoras
?>

    <h1>Área de un triángulo</h1>
    <p style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
        El área de un triángulo con catetos <?php echo $cateto1; ?> y <?php echo $cateto2; ?> es: <strong><?php echo $area; ?></strong><br>
        La hipotenusa es: <strong> <?php echo $hipotenusa; ?></strong>
    </p>
    <h1>Hola Mundo HTML</h1>
</body>
</html>