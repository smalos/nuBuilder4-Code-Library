## Edit Screen: Create a basic HTML Tag Editor

<p align="left">
  <img src="screenshots/html_tag_editor.gif">
</p>

1. On your form, create a Textarea Object with (e.g.) the ID *editor*.
2. Create a new object of type HTML. Any object ID can be entered.

☛  Add this code in the HTML field (HTML tab).
   
```html
<script>
function wrapText(elementID, openTag, closeTag) {
    var textArea = $('#' + elementID);
    var len = textArea.val().length;
    var start = textArea[0].selectionStart;
    var end = textArea[0].selectionEnd;
    if (start !== end) {
       var selectedText = textArea.val().substring(start, end);
       var replacement = openTag + selectedText + closeTag;
       textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, len)).change();
    }
}

function formatText(tag) {
    wrapText('editor', '<' + tag + '>', '</' + tag + '>');
}
</script>

<style>

.nuActionButton.bold {
  font-weight: bold;
}

.nuActionButton.italic {
   font-style: italic;
}

.nuActionButton.ul {
   text-decoration: underline;
}

</style>


<input type="button" class="nuActionButton bold" value="B" onclick="formatText ('b');" />
<input type="button" class="nuActionButton italic" value="I" onclick="formatText ('i');" />
<input type="button" class="nuActionButton ul" value="U" onclick="formatText ('u');" />
```
