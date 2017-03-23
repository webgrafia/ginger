/**
 * Created by matteobarale on 09/07/15.
 */
function gingeranalytics(code) {
    console.log(code);
    console.log(getCookie('ginger-cookie'));

    if(getCookie('ginger-cookie') == 'Y'){
        var gacode = "ga('create', '" + code + "', 'auto'); ga('send', 'pageview');";
    }else{
        var gacode =  "ga('create', '" + code + "', 'auto'); ga('set', 'anonymizeIP', true); ga('send', 'pageview');";
    }

    var scriptanalytics = document.createElement('script');
    scriptanalytics.type = 'text/javascript';
    scriptanalytics.innerHTML = '(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){'
    +'(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),'
    +'m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)'
    +'})(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');' + gacode;
    console.log(scriptanalytics);
    document.getElementsByTagName('head')[0].appendChild(scriptanalytics);
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}