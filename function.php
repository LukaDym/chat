<?php
function IsConnected()
{
    if (!empty($_SESSION["email"])) {
        return true;
    } else {
        return false;
    };
};

function getID()
{
    if (IsConnected()) {
        return $_SESSION["user_id"];
    }
};
function getPseudo()
{
    if (IsConnected()) {
        return $_SESSION["username"];
    }
};
function getEmail()
{
    if (IsConnected()) {
        return $_SESSION["email"];
    }
};

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . strval($output) . "' );</script>";
}
