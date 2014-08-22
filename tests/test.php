<?php

  /**
   * This is to demonstrate the use of JSON.minify in PHP
   * ---
   * The minify function has been namespaced in order to prevent conflicts with
   * other libraries or frameworks in your sourcecode that would break the PHP runtime.
   *
   * Call the JSON.minify function by using the JSON\ namespace followed by the function call:
   * ex: JSON\minify('{valid JSON source content should go here}')
   */

  require "../minify.json.php";

  $start  = microtime(true);

  $tests = [
      'test1.json'
    , 'test2.json'
    , 'test3.json'
    , 'test4.json'
    ];


  foreach ($tests as $index => $testFile) {
    $index    += 1;
    $message  = "Test $index: ";
    $json     = JSON\Minify(file_get_contents(__DIR__ . '/' . $testFile));

    if (!json_decode($json)) {
      $message .= 'Failed';
    } else {
      $message .= 'Passed';
    }

    echo
      $message . PHP_EOL
    . $json . PHP_EOL
    ;

  }


  echo microtime(true) - $start . PHP_EOL;
