
function addEvent(element, eventName, fn) {
    if (element.addEventListener)
        element.addEventListener(eventName, fn, false);
    else if (element.attachEvent)
        element.attachEvent('on' + eventName, fn);
}

/* extracted from ez-consent.js */
const consentCookies = (() => {
    const consentCookieName = "nau-cookie-consent";
    const getCookie = () => {
        const value = "; " + document.cookie;
        const parts = value.split("; " + consentCookieName + "=");
        if (parts.length === 2) {
            return parts.pop().split(";").shift();
        }
    }
    const setCookie = () => {
        const cookieParts = [];
        cookieParts.push(consentCookieName + "=accepted");
        const date = new Date();
        date.setFullYear(date.getFullYear() + 10);
        cookieParts.push("expires=" + date.toUTCString());
        cookieParts.push("path=/");
        cookieParts.push("domain=" + location.hostname.replace(/^www\./i, ""));
        const cookie = cookieParts.join('; ') + ';';
        document.cookie = cookie;
    }
    return { 
        getCookie: getCookie,
        setCookie: setCookie
    }
})();

start_cookie_bar = function() {     

    if (window.jQuery) {  

        updateCookieInformation = function() {

            const ele = document.getElementById("cookie-notification");
            
            const cookieInfo = consentCookies.getCookie();

            const styleDisplay = cookieInfo === undefined ? "block" : "none";

            if (ele !== undefined) {
                ele.style.display = styleDisplay;
            }
        }

        acknoledgeNauNotificationCookie = function() {
            consentCookies.setCookie();
        }
    
        closeCookie = function() {
            acknoledgeNauNotificationCookie();
            updateCookieInformation();
        }
    
        updateCookieInformation();        
        
        closeCookie_btn = document.getElementById ("closeCookie");
        if (closeCookie_btn)
            closeCookie_btn.addEventListener ("click", closeCookie, false);

        
   } else { 
        setTimeout(start_cookie_bar, 1000);
    }
};

addEvent(window, 'load', start_cookie_bar);
