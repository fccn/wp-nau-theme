// JavaScript Document

// starts menu opening and closing button for top menu: hamburger
/*
function openNav() {
  document.getElementById("menu-container").style.cssText = "left:0px;";
  document.getElementById("open-menu-arrow").style.cssText = "display:none";
  document.getElementById("close-menu-arrow").style.cssText = "display:block !important;z-index:2;";
  document.getElementById("menu-overlay").style.cssText = "display:block;z-index:0;background: #000; opacity:0.5;";
}

function closeNav() {
  document.getElementById("menu-container").style.cssText = "left:-375px";
  document.getElementById("menu-overlay").style.cssText = "display:none !important;z-index:-1;";
  document.getElementById("open-menu-arrow").style.cssText = "display:block;";
  document.getElementById("close-menu-arrow").style.cssText = "display:none;";
}
*/
// ends menu opening and closing button for menu: hamburger

// starts language pointer events
function changePTLangColor() {
  document.getElementById("portuguese").style.cssText = "color:#ccc !important";
  document.getElementById("english").style.cssText = "color:#0857FF !important";
}
function changeENLangColor() {
  document.getElementById("english").style.cssText = "color:#CCC !important";
  document.getElementById("portuguese").style.cssText = "color:#0857FF !important";
}
// ends menu opening and closing button for menu: hamburger


// starts image carrousel
function rightArrow() {
  document.getElementsById("container-ul").style.cssText = "right:200px !important;1px solid red";
}
// ends menu opening and closing button for menu: hamburger



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

var asidePlayerElement = null;

function asideVideoPlayer(element_id) {

    function onAsidePlayerReady(event) {
        console.log("Player Ready");
    }
    function onAsidePlayerError(event) {
        console.log("Player Error");
    }
    function onAsidePlayerStateChange(event) {
        
         switch(event.data){
            // Stop the video on ending so recommended videos don't pop up
            case 0:     // ended
               player.stopVideo();
               break;
            case -1:    // unstarted
            case 1:     // playing
            case 2:     // paused
            case 3:     // buffering
            case 5:     // video cued
            default:
               break;
         }

        console.log("Player Stage Change" + event);
    }

    
    e = document.getElementById(element_id)
    asidePlayerElement = e
    
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
    var vars = JSON.parse(varsValue);

    // Getting the ID
    idValue = vars.id;

    vars['origin'] = window.location.origin;
    vars['autoplay'] = 0;
    vars['controls'] = 0;
    vars['autohide'] = 1;
    vars['wmode'] = 'opaque';
    

    // https://developers.google.com/youtube/player_parameters?hl=pt-PT
    
    player = new YT.Player(e, {    
    host: 'https://www.youtube.com',
    width: 312,
    height: 312 * 9/16,
    playerVars: vars,
    videoId: idValue,
    events: {
      'onReady': onAsidePlayerReady,
      'onError': onAsidePlayerError,
      'onStateChange': onAsidePlayerStateChange
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
