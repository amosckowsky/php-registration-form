<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All members</title>
    <?php
        echo "<link rel='stylesheet' href='$baseURL" . "static/css/all_members.css'>";
    ?>
</head>
<body>
    <table>
        <tr>
            <th>Photo</th>
            <th>Full name</th>
            <th>Report subject</th>
            <th>Email</th>
        </tr>
        <?php
            foreach($users as $index => $user) {
                echo '<tr>';
                // If user hasn't photo - set default
                if ($user['photo_path'] == null) {
                    echo '<td>' . '<img class="member-image" src="' . $baseURL . 'static/img/account.svg' . '" alt="Photo">' . '</td>';
                } else {
                    echo '<td>' . '<img class="member-image" src="' . $baseURL . $user['photo_path'] . '" alt="Photo">' . '</td>';
                }
                echo '<td>' . htmlspecialchars($user['first_name'], ENT_QUOTES) . ' ' . htmlspecialchars($user['last_name'], ENT_QUOTES) . '</td>';
                echo '<td>' . htmlspecialchars($user['report_subject'], ENT_QUOTES) . '</td>';
                echo '<td><a href="mailto:' . htmlspecialchars($user['email'], ENT_QUOTES) . '">' . htmlspecialchars($user['email'], ENT_QUOTES) .'</a>' . '</td>';
                echo '</tr>';
            }
        ?>
    </table>
</body>
</html>