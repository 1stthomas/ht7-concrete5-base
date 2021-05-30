// Proting of the php html_entites().
String.prototype.htmlEntities = function() {
    return document.createElement('p').textContent.innerHTML;

//    var p = document.createElement('p');
//    p.textContent = this;
//    return p.innerHTML;
};
