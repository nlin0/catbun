<?php

const ROUTES = array(
  "/" => "pages/home.php",
  "/admin" => "pages/admin.php",
  "/admin/edit" => "pages/admin-edit.php",
  "/admin/upload" => "pages/admin-upload.php",
  "/view-art" => "pages/view-art.php",
  "/sign-in" => "pages/sign-in.php"
);

// return 500 server error for unhandled exceptions
set_exception_handler(function ($ex) {
  // try to purge content sent so far
  ob_end_clean();

  // return 500 server error for unhandled exceptions
  http_response_code(500);
  echo "<!DOCTYPE html>
        <html>
        <head>
          <title>500 Internal Server Error</title>
        </head>
        <body>
          <h1>500 Internal Server Error</h1>
          <p>Sorry, something went wrong on the server.</p>
        </body>
        </html>";

  throw $ex;
});

function match_static($uri)
{
  // Match route as is; match "/public"
  if (preg_match("/^\/public\//", $uri) && file_exists("." . $uri)) {
    return $uri;
  }

  // Look for static resource in public folder;
  // match /favicon.ico, etc.
  $public_path = "./public" . $uri;
  if (file_exists($public_path)) {
    return $public_path;
  }
  return NULL;
}

function match_routes($uri, $routes)
{
  // If the URI ends with /, remove it
  if (preg_match("/^\/.+\/$/", $uri)) {
    $uri = preg_replace("/\/$/", "", $uri);
  }

  if (array_key_exists($uri, $routes)) {
    return $routes[$uri];
  } else {
    return NULL;
  }
}

function mime_type($filename)
{
  // PHP: libmagic cannot accurately determine the MIME type of a file for common web files.
  // Use the file extension for common web files.
  $mime_types = array(
    "txt" => "text/plain",
    "html" => "text/html",
    "css" => "text/css",
    "js" => "application/javascript",
    "json" => "application/json",
  );

  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  if (array_key_exists($ext, $mime_types)) {
    return $mime_types[$ext];
  } else {
    $finfo = finfo_open(FILEINFO_MIME);
    $mimetype = finfo_file($finfo, $filename);
    finfo_close($finfo);
    return $mimetype;
  }
}

// Grabs the URI and separates it from query string parameters
error_log("");
error_log("HTTP Request: " . $_SERVER["REQUEST_URI"]);
$request_uri = explode("?", $_SERVER["REQUEST_URI"], 2)[0];

if ($php_file = match_routes($request_uri, ROUTES)) {
  // Include PHP file from route look-up
  require_once "includes/init.php";
  require $php_file;
} else if ($file_path = match_static($request_uri)) {
  if ($file_path == $request_uri) {
    // let the web server respond for static resources
    return False;
  } else {
    // Serve up file from public folder
    header("Content-Type: " . mime_type($file_path));
    readfile($file_path);
  }
} else {
  error_log("  404 Not Found: " . $request_uri);
  http_response_code(404);
  require "includes/init.php";
  require "pages/not-found.php";
}
