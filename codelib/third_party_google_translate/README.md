### Third party: Using Google Translate to translate text

This example shows how to auto-translate from any language to English using Google's Cloud Translation - Basic (v2).

Note: There is a limit on the amount of text that can be translated for free using its API.
So you may have to pay Google if planning to translate a large amount of text.

☛ Add this JavaScript Code to your form’s Custom Code field or in the (Setup ->) Header.

❓ [How to add Custom Code](/codelib//common/form_add_custom_code_javascript.gif)

```javascript
/**
* Translate text of an object and output it in another object
*
* @param  {string}  objIDSource      - object ID of the 
* @param  {string}  objIDTarget      - object ID
* @param  {boolean} [sourceLang] 	 - auto or the ISO 639-1 code for the language
* @param  {boolean} [targetLang] 	 - auto or the ISO 639-1 code for the language
*/
 
function googleTranslate(objIDSource, objIDTarget, sourceLang = 'auto', targetLang = 'en') {

     var txtSource = encodeURI($("#" + objIDSource).val());
     var url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=" +
         sourceLang + "&tl=" + targetLang + "&dt=t&ie=UTF-8&q=" + txtSource;
     
	 $.ajax({
         method: "GET"
         ,url: url
         ,success: function (result) {
             var translation = '';
             for (var i = 0; i < result[0].length; i++) {
                 translation += result[0][i][0];
             }
             $("#" + objIDTarget).val(translation);
         }
     })

 };
```

✪ Example

The text in the "txt_message" textarea will be translated into English and output in the textarea "txt_message_translated" 
when the form is loaded.

```javascript
if (nuFormType() == 'edit') {
	googleTranslate('txt_message','txt_message_translated');
}   
```

#### Useful links: 

* [Cloud Translation Documentation](https://cloud.google.com/translate/docs/basic/translating-text#translate_translate_text-drest)

* [Quotas & Limits](https://cloud.google.com/translate/quotas)


