<?php

  /**
   * Minifies JSON string data for prasing by removing inline and multiline comments
   * @author Kyle Simpson <github:getify>
   * @author Brandtley McMinn <github:bmcminn>
   * @version 0.2.0
   * @license MIT License
   * @param  string   $json   unminified JSON string data
   * @return string           the minified JSON string data with comments removed
   */

  namespace JSON;

  function Minify($json) {

    // JSON data should be a proper string
    if (!is_string($json)) {
      throw new Exception('JSON provided is not a valid string.');
    }

    // Register and document our regular expressions
    $regex = [
        'leadingSpace' =>
            '^\s+'

      , 'spaceAfterColon' =>
            '([\"\]\}]):\s+'

      , 'multilineComment' =>
            '\/\*[\s\S]+?\*\/'

      , 'inlineComment' =>
            '([",\s\{\}\[\]]?)'   // get leading character(s), ex: , " \s \{\} \[\]
          . '\/\/[\s\S]+?'        // get "// all stuff here"
          . '([",\r\n\[\]\{\}])'  // get the next bit of JSON, ex: , " \{\} \[\]

      , 'multiLineBreaks' =>
            '\n{1,}'

      , 'removeFirstLinebreak' =>
            '^\n{1,}'
    ];

    // Run regex against $json to minify it
    $json = preg_replace('/' . $regex['leadingSpace']         .'/m', '',     $json); // remove all leading spaces
    $json = preg_replace('/' . $regex['spaceAfterColon']      .'/',  '$1: ', $json); // remove spaces after colons
    $json = preg_replace('/' . $regex['multilineComment']     .'/',  '',     $json); // remove multiline comments
    $json = preg_replace('/' . $regex['inlineComment']        .'/m', "$1$2", $json); // remove inline comments
    $json = preg_replace('/' . $regex['multiLineBreaks']      .'/',  "\n",   $json); // remove multiple newlines
    $json = preg_replace('/' . $regex['removeFirstLinebreak'] .'/',  "",     $json); // remove first line break at the top of the file

    return $json;
  }
