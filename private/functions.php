<?php
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function root_url($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
      $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
  }

function hCheck($string=""){
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function error_404(){
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
    // Statt exit kann auch hier eine individuelle HTLM Page geladen werden
}

function redirect($string=""){
    header("Location: " . $string);
    exit();
}

?>
