/*=========================================================================================
    File Name: editor-summernote.js
    Description: Summernote frontend editor js
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function(window, document, $) {
  'use strict';

  // EDIT & SAVE
  var edit = function() {
    $('.summernote-edit').summernote({focus: true});
  };

  var save = function() {
    var makrup = $('.summernote-edit').summernote('code');
    $('.summernote-edit').summernote('destroy');
  };


  // Basic Summernote
  $('.summernote').summernote({
    height: 100,
     toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['view', [ 'codeview','fullscreen']]
        ]
  });

  
  
})(window, document, jQuery);