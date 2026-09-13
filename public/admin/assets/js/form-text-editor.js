$(function () {
	"use strict";


	tinymce.init({
		selector: '#mytextarea',
		plugins: [ 'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview' ],
		toolbar: 'bullist',
  		advlist_bullet_styles: 'square',
	});
	tinymce.init({
		selector: '#mytextareaTwo',
		plugins: [ 'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview' ],
		toolbar: 'bullist',
  		advlist_bullet_styles: 'square',
		  height: 200
	});


});