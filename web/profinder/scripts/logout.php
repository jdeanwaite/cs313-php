<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 10/22/16
 * Time: 1:18 PM
 */

session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();

header('Location: ../login.php');