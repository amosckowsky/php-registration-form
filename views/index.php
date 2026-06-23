<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        echo "<link rel='stylesheet' href='$baseURL" . "static/css/index.css'>";
        echo "<script defer src='$baseURL" . "static/js/index.js'></script>";
    ?>
    <title>Index</title>
</head>
<body>
    <?php
        require 'views/google_map.php';
    ?>
    
    <form id="registration-form" method="post" enctype="multipart/form-data">
        <div class="errors">
        </div>
        <div class="form-step">
            <p><label for="first_name">First name:</label><input type="text" min='3' max='15' name='first_name' required></p>
            <p><label for="las_name">Last name:</label><input type="text" min='3' max='20' name='last_name' required></p>
            <p><label for="birthdate">Birthdate:</label><input type="date" name='birthdate' required></p>
            <p><label for="report_subject">Report subject:</label><input type="text" name='report_subject' required></p>
            <p><label for="country_id">Country:</label><select name='country_id' required>
                <?php
                    foreach($countries as $index => $country) {
                        echo "<option value='" . $country['id'] . "'>" . $country['country_name'] . "</option>";
                    }
                ?>
            </select></p>
            <p><label for="phone">Phone:</label><input type="tel" pattern="[0-9]{12}" name='phone' required></p>
            <p><label for="email">Email:</label><input type="email" name='email' max='100' required></p>
        </div>
        <div class="form-step hidden">
            <p><label for="company">Company:</label><input type="text" name="company"></p>
            <p><label for="position">Position:</label><input type="text" name="position"></p>
            <p><label for="about_me">About me:</label><textarea name="about_me"></textarea></p>
            <p><label for="photo">Photo:</label><input type="file" name="photo" accept="image/*"></p>
        </div>
        <div class="links hidden">
            <?php
                echo "<a target='_blank' rel='noopener noreferrer' href='https://twitter.com/intent/tweet?url=" . rawurlencode($tw_url) . "&text=" . rawurlencode($tw_text) . "'><img class='share-image' src='static/img/twitter.svg' alt='Twitter'></a>";
                echo "<a target='_blank' rel='noopener noreferrer' href='https://www.facebook.com/sharer/sharer.php?u=" . rawurlencode($tw_url) . "'><img class='share-image' src='static/img/facebook.svg' alt='Twitter'></a>";
            ?>
        </div>
        <div class="buttons">
            <button id="prev-button" class="hidden" type="button">Prev</button>
            <button id="next-button" type="button">Next</button>
            <button id="submit-button" class="hidden" type="submit">Submit</button>
        </div>
        <?php
            echo "<a href='$baseURL" . "all_members/'>All members($members_count)</a>"
        ?>
    </form>

</body>
</html>