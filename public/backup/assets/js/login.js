var data = [
  {
    LoginPageHeader: "<span>Welcome to IoT-Shop terminal.<br/>This is a terminal you can check if you have sign up or not.<br/>2020 - University of Ruhuna.</span><br/><br/><span>Who are you?</span><br/>"  
  }
];

var allElements = document.getElementsByClassName("typeing");

if(for (var j = 0; j < allElements.length; j++) {
  var currentElementId = allElements[j].id;
  var currentElementIdContent = data[0][currentElementId];
  var element = document.getElementById(currentElementId);
  var devTypeText = currentElementIdContent;

  // type code
  var i = 0, isTag, text;
  (function type() {
    text = devTypeText.slice(0, ++i);
    if (text === devTypeText) return;
    element.innerHTML = text + `<span class='blinker'>&#32;</span>`;
    var char = text.slice(-1);
    if (char === "<") isTag = true;
    if (char === ">") isTag = false;
    if (isTag) return type();
    setTimeout(type, 60);
  })();
}){

$(function() {

  // Initialize a new terminal object
  var term = new Terminal('#input-line .cmdline', '#container output');
  term.init();
  
});
}