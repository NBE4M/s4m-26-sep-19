/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {
    config.filebrowserBrowseUrl = '../cms/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = '../cms/kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = '../cms/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = '../cms/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = '../cms/kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = '../cms/kcfinder/upload.php?opener=ckeditor&type=flash';
    config.height = '500px';
   config.allowedContent = true;
   config.font_names =  'Fira Sans;'+config.font_names;
};

CKEDITOR.on('dialogDefinition', function( ev )
{
   var dialogName = ev.data.name;  
   var dialogDefinition = ev.data.definition;
         
   switch (dialogName) {  
   case 'image': //Image Properties dialog      
   dialogDefinition.removeContents('Upload');
   break;      
   }
});