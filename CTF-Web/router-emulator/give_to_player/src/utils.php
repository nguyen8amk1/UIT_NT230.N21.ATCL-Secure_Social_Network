<?php

$key = time(); // Change this to your secret key for AES encryption

function generate_md5_hash($password)
{
    return md5($password);
}

function encrypt_password($password, $hashed_passwd, $key)
{
    $encrypted_password = shell_exec(sprintf("echo %s %s | openssl enc -aes-256-cbc -a -k %s", $password, $hashed_passwd, $key));
    return trim($encrypted_password);
}

function write_password_to_file($encrypted_password, $file_path)
{
    $write_success = file_put_contents($file_path, $encrypted_password);
    return $write_success !== false;
}
