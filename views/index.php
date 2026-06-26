<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="email_checker" content=<?php echo $baseURL . "all_members/"; ?>>
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
        <h3>To participate in the conference, <br>please fill out the form”</h3>
        <div class="errors">
        </div>
        <div class="form-step">
            <div><label for="first_name">First name:<em>*</em></label><input placeholder="Name, Length: 3-15" type="text" minlength="3" maxlength="15" name='first_name' required></div>
            <div><label for="las_name">Last name:<em>*</em></label><input placeholder="Last name, Length: 3-20" type="text" minlength="3" maxlength="20" name='last_name' required></div>
            <div><label for="birthdate">Birthdate:<em>*</em></label><input id="birthdate" type="date" name='birthdate' required></div>
            <div><label for="report_subject">Report subject:<em>*</em></label><input placeholder="Report subject" maxlength="200" type="text" name='report_subject' required></div>
            <div><label for="country_id">Country:<em>*</em></label><select name='country_id' required>
                <?php
                    foreach($countries as $index => $country) {
                        echo "<option value='" . $country['id'] . "'>" . $country['country_name'] . "</option>";
                    }
                ?>
            </select></div>
            <div><label for="phone">Phone:<em>*</em></label><input type="tel" pattern="[0-9]{12}" placeholder="380999999999" title="Format: 380991234567 (Without '+' and spaces)" name='phone' required></div>
            <div><label for="email">Email:<em>*</em></label><input placeholder="example@gmail.com" id="email" type="email" name='email' required></div>
        </div>
        <div class="form-step hidden">
            <div><label for="company">Company:</label><input placeholder="Name of your company" maxlength="200" type="text" name="company"></div>
            <div><label for="position">Position:</label><input placeholder="Your position in company" maxlength="200" type="text" name="position"></div>
            <div><label for="about_me">About me:</label><textarea maxlength="200" name="about_me"></textarea></div>
            <div>
                <label for="photo">Photo:</label>
                <p>
                    <input id="form-photo" type="file" name="photo" accept="image/*">
                    <button type="button" id="delete-photo"><img class='share-image' src='static/img/trash.svg' alt='Delete'></button>
                </p>
            </div>
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
            echo "<a href='$baseURL" . "all_members/'>All members(<span id='members-count'>$members_count</span>)</a>"
        ?>
    </form>

</body>
</html>
