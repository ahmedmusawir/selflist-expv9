<?php
require_once __DIR__ . '/inc/class-person-object.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php 
        $person = new Person('Moose');
        echo $person->get_name();
    ?>
</body>

</html>