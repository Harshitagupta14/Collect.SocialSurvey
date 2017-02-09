/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */


// Define changes to default configuration here. For example:
// config.language = 'fr';
// config.uiColor = '#AADC6E';


CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For the complete reference:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for two toolbar rows.
//	config.toolbarGroups = [
//		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
//		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
//		{ name: 'links' },
//		{ name: 'insert' },
//		{ name: 'forms' },
//		{ name: 'tools' },
//		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
//		{ name: 'others' },
//		'/',
//		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
//		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
//		{ name: 'styles' },
//		{ name: 'colors' },
//		{ name: 'about' }
//	];

    config.protectedSource.push(/<i[^>]*><\/i>/g);
    
    config.allowedContent = true;
    config.extraAllowedContent='section article header nav center';
    config.filebrowserBrowseUrl = baseurl + 'assets/ckeditor/ckfinder/ckfinder.html';

    config.filebrowserImageBrowseUrl = baseurl + 'assets/ckeditor/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = baseurl + 'assets/ckeditor/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = baseurl + 'assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = baseurl + 'assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = baseurl + 'assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
config.skin = 'bootstrapck';
    // Remove some buttons, provided by the standard plugins, which we don't
    // need to have in the Standard(s) toolbar.


};
CKEDITOR.dtd.$removeEmpty['span'] = false;