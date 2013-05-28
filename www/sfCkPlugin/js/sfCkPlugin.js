window.onload = function()
{
  var textareas = document.getElementsByTagName("textarea");

  for(i=0; i < textareas.length; i++)
  {
    if(textareas.item(i).getAttribute('class') !== "no-editor")
    {
      var editorDescription = CKEDITOR.replace( textareas.item(i).getAttribute('name') );
		CKFinder.setupCKEditor( editorDescription, '/js/ckfinder/');
    }
  }
}