// https://developers.google.com/youtube/iframe_api_reference#Getting_Started
// https://www.ibenic.com/use-youtube-api-create-wordpress-video-modal/
// https://stackoverflow.com/questions/27573017/failed-to-execute-postmessage-on-domwindow-https-www-youtube-com-http

// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var youtubeApiLoaded = false;
var player;

function onYouTubeIframeAPIReady() {
  youtubeApiLoaded = true;
}
  
/**
 * Function that is called upon clicking the button
 * @param  {object} e Button object
 * @return {void}   
 */
function openYoutubeVideoIFrame( e ) {

  // Getting the attributes from the button
  var attributes = e.attributes;
  var varsValue = null;
  var idValue = null; 

  // Looking for our attribute 'data-vars'
  for( var i=0; i < attributes.length; i++ ) {
    var att = attributes[ i ];
        
    // Getting the value from that attribute
    if( att.name == 'data-vars' ) {
      varsValue = att.nodeValue;
      break;
    }
  }
    
  // Creating an object 
  var varsObject = JSON.parse(varsValue);

  // Getting the ID
  idValue = varsObject.id;

  createPlayer( idValue, varsObject );
}

/**
 * Creating the YouTube player
 * @param  {string} id   YouTube Video ID
 * @param  {object} vars Object with YouTube Player variables
 * @return {void}      
 */
function createPlayer( id, vars ){

  /**
   * Don't create the player if the YouTube API is not loaded
   * @param  {boolean} youtubeApiLoaded False if not Loaded  
   */
  if( ! youtubeApiLoaded ) {
      return;
  }

  /**
   * Don't create the player if there is no ID
   * @param  {string} id 	YouTube Video ID    
   */
  if( typeof id == 'undefined'){
      return;
  }

  /**
   * If there is no vars, we create an empty object
   */
  if( typeof vars == 'undefined' ) {
      vars = {};
  }

  vars['origin'] = window.location.origin;
  vars['autoplay'] = 1;
  vars['controls'] = 0;
  vars['autohide'] = 1;
  vars['wmode'] = 'opaque';

  /**
   * Creating the player
   */
  player = new YT.Player('videoPlayer', {
    width: '100%',
    host: 'https://www.youtube.com',
    playerVars: vars,
    videoId: id,
    events: {
      'onReady': onPlayerReady,
      'onError': onPlayerError,
      'onStateChange': onPlayerStateChange
    }
  });
}

/**
 * Alerting the Error if any when YouTube player has been created
 * @param  {object} error 
 * @return {void}    
 */
function onPlayerError(error) {
  if( error.data == 2 ) {
      alert( "Check the Video ID" );
  }

  if( error.data == 5 ) {
      alert( "Check your Browser Version. HTML5 player does not work.");
  }

  if( error.data == 100 ) {
      alert( "Video not found.");
  }

  if( error.data == 101 || error.data == 105 ) {
      alert( "Video not allowed to play on other sites.");
  }
}

/**
 * Starting the player when it is ready
 * @param  {object} event
 */
function onPlayerReady(event) {
  event.target.playVideo();
  document.getElementsByTagName("html")[0].className += " modal-open";
}

/**
 * When the Video ends, destroy the player and close the modal
 * @param  {object} event 
 */
function onPlayerStateChange(event) {
  if( event.data == YT.PlayerState.ENDED ) {
    closeVideo();
  }
}

/**
 * Closing the video by destroying the player (iframe) and remove the modal
 */
function closeVideo() {
  player.destroy();
   var body = document.getElementsByTagName("html")[0];

  if( body.classList.contains("modal-open") ) {
      body.classList.remove("modal-open");
  }
}


window.onload = function() {

    var jssor_1_SlideoTransitions = [
      [{b:-1,d:1,ls:0.5},{b:0,d:1000,y:5,e:{y:6}}],
      [{b:-1,d:1,ls:0.5},{b:200,d:1000,y:25,e:{y:6}}],
      [{b:-1,d:1,ls:0.5},{b:400,d:1000,y:45,e:{y:6}}],
      [{b:-1,d:1,ls:0.5},{b:600,d:1000,y:65,e:{y:6}}],
      [{b:-1,d:1,ls:0.5},{b:800,d:1000,y:85,e:{y:6}}],
      [{b:-1,d:1,ls:0.5},{b:500,d:1000,y:195,e:{y:6}}],
      [{b:0,d:2000,y:30,e:{y:3}}],
      [{b:-1,d:1,rY:-15,tZ:100},{b:0,d:1500,y:30,o:1,e:{y:3}}],
      [{b:-1,d:1,rY:-15,tZ:-100},{b:0,d:1500,y:100,o:0.8,e:{y:3}}],
      [{b:500,d:1500,o:1}],
      [{b:0,d:1000,y:380,e:{y:6}}],
      [{b:300,d:1000,x:80,e:{x:6}}],
      [{b:300,d:1000,x:330,e:{x:6}}],
      [{b:-1,d:1,r:-110,sX:5,sY:5},{b:0,d:2000,o:1,r:-20,sX:1,sY:1,e:{o:6,r:6,sX:6,sY:6}}],
      [{b:0,d:600,x:150,o:0.5,e:{x:6}}],
      [{b:0,d:600,x:1140,o:0.6,e:{x:6}}],
      [{b:-1,d:1,sX:5,sY:5},{b:600,d:600,o:1,sX:1,sY:1,e:{sX:3,sY:3}}]
    ];

    // https://www.jssor.com/development/api-options.html

    var jssor_1_options = {
      $PauseOnHover: 3,
      $FillMode: 2,
      $AutoPlay: 1,
      $Idle: 5000, // Time between slides!
      $LazyLoading: 1,
      $CaptionSliderOptions: {
        $Class: $JssorCaptionSlideo$,
        $Transitions: jssor_1_SlideoTransitions
      },
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$
      },
      $BulletNavigatorOptions: {
        $Class: $JssorBulletNavigator$,
        $SpacingX: 20,
        $SpacingY: 20
      }
    };

    var jssor_1_slider = new $JssorSlider$("jssor-banner", jssor_1_options);

    /*#region responsive code begin*/

    var MAX_WIDTH = 1600;

    function ScaleSlider() {
        var containerElement = jssor_1_slider.$Elmt.parentNode;
        var containerWidth = containerElement.clientWidth;

        if (containerWidth) {

            var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

            jssor_1_slider.$ScaleWidth(expectedWidth);
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