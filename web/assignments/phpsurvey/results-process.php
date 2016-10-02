<?php
if (!isset($_SESSION)) session_start();

/**
 * Process the form request and return the data. Create a session variable if it
 *  hasn't already been set.
 * @param  string $request the name of the request
 * @return string          the value of the request or empty string
 */
function get_form_request($request)
{
    if (isset($_POST[$request])) {
        // set the session variable if it hasn't already been set.
        if (!isset($_SESSION[$request]) ||
            // set the session variable if the incoming request is different
            //  from the existing session variable.
            $_SESSION[$request] !== $_POST[$request]
        ) {
            $_SESSION[$request] = $_POST[$request];
        }
        return $_POST[$request];
    } else if (isset($_SESSION[$request])) {
        return $_SESSION[$request];
    }
    return "";
}

function get_full_form_request()
{
    if (isset($_POST) && count($_POST) > 0) {
        return $_POST;
    } else if (isset($_SESSION)) {
        return $_SESSION;
    }
    return false;
}

function get_results_from_file($filename)
{
    $current_results = array();
    $handle = fopen($filename, "r");
    if ($handle) {

        while (($line = fgets($handle)) !== false) {
            $pieces = explode(":", $line);
            if (count($pieces) > 0) {
                $current_results[$pieces[0]][$pieces[1]] = $pieces[2];
            }
        }

        fclose($handle);
    }
    return $current_results;
}

function add_new_results(&$current_results, $request)
{
    if (!isset($_SESSION["posted"]))
    {
        $_SESSION["posted"] = true;
    }
    else
    {
        $_SESSION["posted"] = true;
    }

    foreach ($request as $key => $value) {
        if (isset($current_results[$key][$value])) {
            $current_results[$key][$value] += 1;
        } else {
            $current_results[$key][$value] = 1;
        }
    }
}

function save_results($filename, $results)
{
    $file_string = "";
    foreach ($results as $question => $answers) {
        foreach ($answers as $answer => $value) {
            $file_string .= "$question:$answer:$value\n";
        }
    }
    file_put_contents($filename, $file_string);
}
$filename = 'results.txt';
$current_results = get_results_from_file($filename);
if (isset($_POST)) {
    add_new_results($current_results, $_POST);
    save_results($filename, $current_results);
}