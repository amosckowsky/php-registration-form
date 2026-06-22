<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/index.css">
    <title>Document</title>
</head>
<body>
    <?php
        require 'views/google_map.php';
    ?>
    
    <form method="post">
        <div>
            <p><label for="first_name">First name:</label><input type="text" min='3' max='15' name='first_name' required></p>
            <p><label for="las_name">Last name:</label><input type="text" min='3' max='20' name='last_name' required></p>
            <p><label for="birthdate">Birthdate:</label><input type="date" name='birthdate' required></p>
            <p><label for="report_subject">Report subject:</label><input type="text" name='report_subject' required></p>
            <p><label for="country_id">Country:</label><select name='country_id' required>
                <?php
                    foreach($countries as $index => $country)
                    echo "<option value='" . $country['id'] . "'>" . $country['country_name'] . "</option>"
                ?>
            </select></p>
            <p><label for="phone">Phone:</label><input type="tel" name='phone' required></p>
            <p><label for="email">Email:</label><input type="email" name='email' max='100' required></p>
            
        </div>
        <button type="submit">Submit</button>
    </form>

</body>
</html>