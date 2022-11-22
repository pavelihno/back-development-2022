function getCookie(c_name) {
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
            return unescape(y);
        }
    }
}

function setCookie(c_name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}

let langField = document.getElementById('lang');
let themeField = document.getElementById('theme');

langField.onchange = function () {
    const lang = langField.value;
    if (lang) {
        setCookie('lang', lang, 2);
        location.reload();
    }
};

themeField.onchange = function () {
    const theme = themeField.value;
    if (theme) {
        setCookie('theme', theme, 2);
        location.reload();
    }
};

console.log(getCookie('lang'));
console.log(getCookie('theme'));