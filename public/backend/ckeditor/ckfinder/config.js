/*
 Copyright (c) 2007-2019, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or https://ckeditor.com/sales/license/ckfinder
 */

var config = {};

// Set your configuration options below.

// Examples:
// config.language = 'pl';
// config.skin = 'jquery-mobile';
$config['authentication'] = function () {
    return true;
};

$config['accessControl'][] = Array(
 'role' => '*',
 'resourceType' => 'Images',
 'folder' => '/public/uploads',

 'FOLDER_VIEW'        => true,
 'FOLDER_CREATE'      => true,
 'FOLDER_RENAME'      => true,
 'FOLDER_DELETE'      => true,

 'FILE_VIEW'          => true,
 'FILE_CREATE'        => false,
 'FILE_RENAME'        => false,
 'FILE_DELETE'        => false,

 'IMAGE_RESIZE'        => true,
 'IMAGE_RESIZE_CUSTOM' => true
);
