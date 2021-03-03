/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
//���������� ��������� �����������
   config.filebrowserImageBrowseUrl = 'PLUGIN/ckeditor4/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = 'PLUGIN/ckeditor4/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = 'PLUGIN/ckeditor4/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = 'PLUGIN/ckeditor4/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = 'PLUGIN/ckeditor4/kcfinder/upload.php?opener=ckeditor&type=flash'; '/uploader/upload.php';




	
//���� ���������
config.skin = 'kama';


//��������� ��� ���������
config.removePlugins = 'elementspath';
config.resize_enabled = false;


//������ ������������ ���� ����
config.extraPlugins = 'autogrow';



//������ ����� enter ��� �� ����� p � ������ br
config.enterMode = CKEDITOR.ENTER_BR;
config.shiftEnterMode = CKEDITOR.ENTER_P;

//���������� ������
config.extraPlugins = 'SimpleLink';


//��� ���������� ������
config.extraPlugins = 'ulmenu_one,autogrow,SimpleLink,imageuploader';

config.allowedContent = true;


//��������� ����������� �������
//config.entities = false;

//������ ������� ������ h3
config.format_tags = 'h3';


//����������� ����� ������
config.contentsCss = 'stylesheets/ckeditor/ckeditor_ulmenu.css';

//������������ � ������� �����
config.justifyClasses = [ 'left_p', 'center_p', 'right_p', 'justify_p' ];
 
//��������� ������ ������ ��������������
config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Save,NewPage,Preview,Print,Templates,Copy,Cut,Paste,Replace,Find,SelectAll,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,NumberedList,BulletedList,Outdent,Indent,CreateDiv,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Anchor,Unlink,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Font,FontSize,TextColor,BGColor,About';

	



};


