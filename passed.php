<?php
error_reporting(1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>password generating</title>
    <style>
        <?php include "style.css" ?>
    </style>

</head>
<?php
$_alphaSmall = 'abcdefghijklmnopqrstuvwxyz';            // small letters
$_alphaCaps  = strtoupper($_alphaSmall);                // CAPITAL LETTERS
$_numerics   = '1234567890';                            // numerics
$_specialChars = '`~!@#$%^&*()-_=+]}[{;:,<.>/?\'"\|';   //special characters

//trial 1 starts

$sml =  substr(str_shuffle($_alphaSmall), 0, 2);
$bg =  substr(str_shuffle($_alphaCaps), 0, 2);
$nm =  substr(str_shuffle($_numerics), 0, 2);
$chr =  substr(str_shuffle($_specialChars), 0, 2);
$pass = $sml . $bg . $nm . $chr;


$container = "$_alphaSmall$_alphaCaps$_numerics$_specialChars";
$new_pass = '';
if (isset($_POST["submit"])) {
    $range = $_POST['range'];
    $new_pass = Generatepass($range - 8) . $pass; //obtaining a minimum of two characters from each variable
    $new_pass = str_shuffle($new_pass); //rearranging characters

}

function Generatepass($_len)
{
    $password = '';
    global $container;
    for ($i = 0; $i < $_len; $i++) {                                 // Loop till the length mentioned
        $_rand = rand(0, strlen($container) - 1);                  // Get Randomized Length
        $password .= substr($container, $_rand, 1);                // returns part of the string [ high tensile strength ;) ] 
    }

    return $password;       // Returns the generated Pass

}


//to arrays
$alphaSmall = str_split($_alphaSmall);
$alphaCaps =  str_split($_alphaCaps);
$numerics =  str_split($_numerics);
$specialChars =  str_split($_specialChars);

// beginning counting characters
$alpha_cap = 0;  //will contain counts
$alpha_smal = 0;
$number = 0;
$special_chars = 0;

//counting small letters
for ($i = 0; $i < strlen($new_pass); $i++) {
    if (in_array($new_pass[$i], $alphaSmall)) {
        $alpha_smal++;
    }
}
// function countDigits($new_pass){    
//     return preg_match_all( "/[0-9]/",$new_pass);
//  }

// counting capital letters
for ($i = 0; $i < strlen($new_pass); $i++) {
    if (in_array($new_pass[$i], $alphaCaps)) {
        $alpha_cap++;
    }
}

//counting numbers
for ($i = 0; $i < strlen($new_pass); $i++) {
    if (in_array($new_pass[$i], $numerics)) {
        $number++;
    }
}

//counting special characters
for ($i = 0; $i < strlen($new_pass); $i++) {
    if (in_array($new_pass[$i], $specialChars)) {
        $special_chars++;
    }
}

?>
<script>
    function myFunction() {
        var copyPass = document.getElementById("myInput");
        copyPass.select();
        copyPass.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyPass.value);
    }

    function character(event) {
        let count = event.target.value;
        document.getElementById("password-length").innerText = count;
    }
</script>

<body>
    <div class="mx-wd auto">
        <div class="center">
            <div class="pd">
                <h2>Password Generator</h2>

                <form action="" method="post">
                    <div class="range">
                        <div class="block">
                            <div>
                                <span class="fn-sz">Password Length:</span>
                            </div>
                            <div class="flex">
                                <input type="range" oninput="character(event);" name="range" id="vol" min="15" max="36" value="<?php echo (@$range); ?>">
                                <span id="password-length"><?php echo (@$range); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="btn relative">
                        <input type="text" id="myInput" checked name="results" value="<?php echo (htmlspecialchars($new_pass)); ?>">
                        <button type="button" onclick="myFunction()">Copy</button>
                    </div>
                    <div class="all_char">
                        <div>
                            <div class="flex-icon">
                                <?php require "./svgs/check.svg" ?>
                            </div>
                            <span class="len-wd"><?php echo ($alpha_smal); ?></span> <span>small letters</span>
                        </div>
                        <div>
                            <div class="flex-icon">
                                <?php require "./svgs/check.svg" ?>
                            </div>
                            <span class="len-wd"><?php echo ($alpha_cap); ?></span> <span>capital letters</span> <br>
                        </div>
                        <div>
                            <div class="flex-icon">
                                <?php require "./svgs/check.svg" ?>
                            </div>
                            <span class="len-wd"><?php echo ($number); ?></span><span>numbers</span>
                        </div>
                        <div>
                            <div class="flex-icon">
                                <?php require "./svgs/check.svg" ?>
                            </div>
                            <span class="len-wd"><?php echo ($special_chars); ?></span> <span>special characters</span>
                        </div>
                    </div>
                    <input type="submit" value="Generate" name="submit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>