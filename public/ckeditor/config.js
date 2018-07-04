/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.toolbar = [
		{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo',] },
	    { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },
	    { name: 'basicstyles', items: [ 'Bold', 'Italic' ] },
	    { name: 'editing', items: [ 'Scayt' ] },
	    { name: 'insert', items: [ 'Image', 'Table', 'HorizonalRule', 'SpecialChar' ] },
	    { name: 'tools', items: [ 'Maximize' ] },
	    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'RemoveFormat' ] },
	    { name: 'styles', items: [ 'Styles', 'Format' ] },
	];

};
