<?php

use App\App;

/**
 *
 * Checks if user(data) already exists in DB file.
 *
 * If there is no such data(user) returns true.
 * If the data already exist in file, writes an error and returns false.
 *
 * @param string $field_input - clean input value
 * @param array $field - input array
 * @return bool
 */
function validate_user_unique(string $field_input, array &$field): bool
{
    if (App::$db->getRowWhere('users', ['email' => $field_input])) {
        $field['error'] = 'User already exists';

        return false;
    }

    return true;
}

/**
 * Checks if user exists based on entered email
 *
 * @param string $field_input
 * @param array $field
 * @return bool
 */
function validate_user_exists(string $field_input, array &$field): bool
{
    if (!App::$db->getRowWhere('users', ['email' => $field_input])) {
        $field['error'] = 'User with this email does not exist';

        return false;
    }

    return true;
}

/**
 *
 * Checks if there is such email and password in the database.
 *
 * If there is such user and password is the same as in database returns true.
 * If email or password of $filtered_input are not in the database(or not the same),
 * writes an error and returns false.
 *
 * @param array $filtered_input - clean inputs array with values
 * @param array $form - form array
 * @return bool
 */
function validate_login(array $filtered_input, array &$form): bool
{
    if (App::$db->getRowWhere('users', [
        'email' => $filtered_input['email'],
        'password' => $filtered_input['password']
    ])) {
        return true;
    }

    $form['error'] = 'Unable to login: please check your password';

    return false;
}

/**
 * Check if user is logged in
 *
 * @param array $filtered_input
 * @param array $field
 * @return bool
 */
function validate_logged_in_user(string $field_input, array &$field): bool
{
    if (!App::$session->getUser()) {
        $field['error'] = 'User is not logged in';

        return false;
    }

    return true;

}