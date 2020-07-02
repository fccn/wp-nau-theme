// https://developers.google.com/youtube/iframe_api_reference#Getting_Started
// https://www.ibenic.com/use-youtube-api-create-wordpress-video-modal/
// https://stackoverflow.com/questions/27573017/failed-to-execute-postmessage-on-domwindow-https-www-youtube-com-http
// https://stackoverflow.com/questions/26523334/jssorobject-is-not-defined


window.onload = function() {


    // https://www.jssor.com/development/api-options.html
    
    var jssor_options_nau = {
      $AutoPlay: 1,
      $PauseOnHover: 3,
      $SlideDuration: 750,
      $DragOrientation: 1,
      $AutoPlayInterval: 5000,
      $PlayOrientation: 1, 
      $FillMode: 2,
      $AutoPlay: true,
      $Idle: 5000, // Time between slides! 
      $LazyLoading: 1,
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$
      },
      $BulletNavigatorOptions: {
        $Class: $JssorBulletNavigator$,
        $SpacingX: 16,
        $SpacingY: 16
      }
    }

    var jssor_slider = new $JssorSlider$("jssor-banner", jssor_options_nau);

    /*#region responsive code begin*/

    var MAX_WIDTH = 1600;

    function ScaleSlider() {
        var containerElement = jssor_slider.$Elmt.parentNode;
        var containerWidth = containerElement.clientWidth;

        if (containerWidth) {

            var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

            jssor_slider.$ScaleWidth(expectedWidth);
        }
        else {
            window.setTimeout(ScaleSlider, 30);
        }
    }

    ScaleSlider();

    $Jssor$.$AddEvent(window, "load", ScaleSlider);
    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
    
    /*#endregion responsive code end*/
};