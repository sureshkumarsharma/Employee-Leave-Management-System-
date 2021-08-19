<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '540549180738-3qvrd6m6iv7kqb97ngil2h30o4bd420l.apps.googleusercontent.com';
$config['google']['client_secret']    = 'EiIPxkqzSX4GDcV-SGfBm9Kg';
$config['google']['redirect_uri']     = base_url('admin/dashbord');
$config['google']['application_name'] = 'Login to HR Manager';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();