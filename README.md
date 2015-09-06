# tt-pds
A tiny tiny photo distribution server.

## Description

This small php-project allowes the distribution of files (initially photo archives) to friends. Access is provided via url and keys tokens. 
 
Supported languages:
 * english (en)
 * german (de)
 
## Installation & Setup

Customize settings using the following files:
 * config.php: global settings
 * data/data.php: access to photo/data directories
 
#### Examples

Example URLs for index.php (with example data in data/)
 * admin view: ?admin=getallaccesscodes&mkey=somerandombutcomplexmasterkey
 * user view (files in exampledir1): ?acc=complexsamplekey
 * user view (files in exampledir1 and exampledir2): ?acc=anotherkeycomplexsamplekey

## ToDo

 * specify custom links in data file

## Changelog

 * v0.02 (2015-09-06)
   * htaccess blocks all files from external, except index.php, error.php and (css|js|png) files
   * new config.php file
   * fix for sending text files
   * fixed handling of paths: project can be placed in subdirectory
   * custom error page
   * new example files
 * v0.01 (2015-09-04) first release
