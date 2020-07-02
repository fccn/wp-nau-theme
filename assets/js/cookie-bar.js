
function addEvent(element, eventName, fn) {
    if (element.addEventListener)
        element.addEventListener(eventName, fn, false);
    else if (element.attachEvent)
        element.attachEvent('on' + eventName, fn);
}


start_cookie_bar = function(){     

    var nau_cookie_notification = {};

    if (window.jQuery) {  

        console.log("JQuery loaded!");

        updateMessage = function() {
            console.log("Updating up nau_cookie_date_set!");
            nau_cookie_date_set_span = document.getElementById("nau_cookie_date_set");
            if (nau_cookie_date_set_span) {
                console.log("Found nau_cookie_date_set_span!");
                date_html = nau_cookie_notification.date.toLocaleString();
                console.log(date_html);
                if (nau_cookie_notification.status != "show") 
                    nau_cookie_date_set_span.innerHTML = date_html;
                else
                    nau_cookie_date_set_span.innerHTML = "nunca";
            } else {
                console.log("Not found nau_cookie_date_set! Thats ok!");
            }
        }


        updateCookieInformation = function() {
            
            if (localstorage_status = localStorage.getItem('NAUCookieNotification.status')) {
                console.log("LocalStorage.status" + localstorage_status);
            } else {
                console.log("LocalStorage.status not found! " + localstorage_status);
            }
            
            if (localstorage_date = localStorage.getItem('NAUCookieNotification.date')) {
                console.log("LocalStorage.date " + localstorage_date.toLocaleString());
            } else {
                console.log("LocalStorage.date not found! " + localstorage_date);
            }
            
            nau_cookie_notification = {
                "date": new Date(localStorage.getItem('NAUCookieNotification.date')),
                "status": localStorage.getItem('NAUCookieNotification.status')
            }

            now = new Date()
            total_days_since_accept = (nau_cookie_notification.date.getTime() - now.getTime()) / (1000 * 60 * 60 * 24);

            if ((nau_cookie_notification.status == 'show') || (total_days_since_accept > 7)) {
                console.log("SHOW Cookie Bar! " + (nau_cookie_notification.status == 'show') + "|" + (total_days_since_accept > 7));
                document.getElementById("cookie-notification").style.display = "block";
                // document.getElementById("cookie-notification").style.bottom = null;
            } else {
                console.log("HIDE Cookie Bar! " + (nau_cookie_notification.status == 'show') + "|" + (total_days_since_accept > 7));
                document.getElementById("cookie-notification").style.display = "none";
                // document.getElementById("cookie-notification").style.bottom = '-500px';                
            }
            
            updateMessage();
        }

        resetNauNotificationCookie = function() {
            nau_cookie_notification = { "date" : new Date(), "status": "show" };
            localStorage.setItem('NAUCookieNotification.date', nau_cookie_notification.date);
            localStorage.setItem('NAUCookieNotification.status', nau_cookie_notification.status);
            return nau_cookie_notification;
        }

        acknoledgeNauNotificationCookie = function() {
            nau_cookie_notification = { "date" : new Date(), "status": "acknowledged" };
            localStorage.setItem('NAUCookieNotification.date', nau_cookie_notification.date);
            localStorage.setItem('NAUCookieNotification.status', nau_cookie_notification.status);
            return nau_cookie_notification;
        }


        clearCookie = function() {
            console.log("Clear Cookie Bar!");
            resetNauNotificationCookie();
            updateCookieInformation();
        }
    
        closeCookie = function() {
            console.log("Close Cookie Bar!");
            acknoledgeNauNotificationCookie();
            updateCookieInformation();
        }
        
        console.log("Functions ok!!");
    
        // Bind the buttons
        
        clearCookie_btn = document.getElementById ("clearCookie");
        if (clearCookie_btn)
            clearCookie_btn.addEventListener ("click", clearCookie, false);
        
        closeCookie_btn = document.getElementById ("closeCookie");
        if (closeCookie_btn)
            closeCookie_btn.addEventListener ("click", closeCookie, false);
        
        console.log("EventListner ok!");

        updateCookieInformation();        
        
   } else {
        console.log("JQuery not loaded!");
        setTimeout(start_cookie_bar, 1000);
    }
};


addEvent(window, 'load', start_cookie_bar);
