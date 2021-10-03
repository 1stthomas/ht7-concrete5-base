/**
 * Proting of the php html_entites().
 *
 * Maybe it would be performant with str.replace calls,
 * see: https://css-tricks.com/snippets/javascript/htmlentities-for-javascript/
 */
String.prototype.htmlEntities = function() {
    const p = document.createElement('p');
    p.textContent = this;

    return p.innerHTML;
};
