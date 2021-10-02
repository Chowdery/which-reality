<html>
<head>
  <title>Oh geez... What reality am I in?</title>
</head>

<body>
<h1> Server Information</h1>
<meta http-equiv="Content-Security-Policy"
    content="default-src 'self'; img-src https://*; child-src 'none';">
<?php 

function command_exist($cmd) {
    $return = shell_exec(sprintf("which %s", escapeshellarg($cmd)));
    return !empty($return);
}

if (command_exist("uname")) {
    $OS_NAME = exec("uname -r");
    $OS_VER = "";
}

if (command_exist("apache2")) {
    $WEBPROG = exec("apache2 -V | grep ^Server\ version");
    if ($WEBPROG == "") {
        $WEBPROG = "Web Server: Apache (Undetermined version)";
    }
} elseif (command_exist("httpd")) {
    $WEBPROG = exec("httpd -V | grep ^Server\ version");
    if ($WEBPROG == "") {
        $WEBPROG = "Web Server: Apache (Undetermined version)";
    }
} elseif (command_exist("nginx")) {
    $WEBPROG = exec("nginx -V | grep ^nginx\ version");
    if ($WEBPROG == "") {
        $WEBPROG = "Web Server: NGINX (Undetermined version)";
    }
}
?>

<h1> Running Processes </h1>
<?php
exec("ps -ef", $output);
foreach($output as $i) {
    echo $i . "<br/>";
}
?>
</body>
</html>
