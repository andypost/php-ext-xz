--TEST--
compress.xz streams and big file
--SKIPIF--
<?php if (!defined("PHP_BINARY")) die("skip old PHP version."); ?>
--FILE--
<?php
include(dirname(__FILE__) . '/data.inc');

$file1 = dirname(__FILE__) . '/data1.xz';
$file2 = dirname(__FILE__) . '/data2.xz';

echo "Compress\n";
var_dump(copy(PHP_BINARY, 'compress.xz://' . $file1));
var_dump($size0 = filesize(PHP_BINARY));
var_dump($size1 = filesize($file1));
var_dump($size1 > 1 && $size1 < $size0 / 2);

echo "Decompress\n";
var_dump(copy('compress.xz://' . $file1, $file2));
var_dump($size2 = filesize($file2));
var_dump($size2 == $size0);
var_dump(file_get_contents(PHP_BINARY) === file_get_contents($file2));

@unlink($file1);
@unlink($file2);
?>
===Done===
--EXPECTF--
Compress
bool(true)
int(%d)
int(%d)
bool(true)
Decompress
bool(true)
int(%d)
bool(true)
bool(true)
===Done===
