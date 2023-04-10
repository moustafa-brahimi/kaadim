// import "../css/style.css";
import "./icons.js";
import "./classes/slider-compact.js";
// import InstagramIcon from "./classes/instagram-icon";
import MacroLoading from "./classes/macro-load";
import ColorScheme from "./classes/color-scheme";
import loadMore from "./classes/load-more-posts.js";
import { stringToHTML, getParents } from "./functions.js";
import octo from "./octo/dist/octo.js";
 

document.addEventListener( 'DOMContentLoaded', () => {

  // macro loading images

  MacroLoading.init();

  
  // color scheme

  const        
    body        =   document.body,
    schemeBtns  =   document.querySelectorAll( ".js-btn-scheme" );

  let timeout;

  if( body !== null ) {

    ColorScheme.addElementToTrigger( body );
        
    body.addEventListener( ColorScheme.eventType, function() {

      this.setAttribute( "color-scheme", ColorScheme.scheme );
          
      clearTimeout( timeout ); // clear time out to make sure that the class will be removed after 1s exactly

      this.classList.add( "kadim--transitioning" );

      // remove the "kadim--transitioning" after the transition ended
  
      timeout =   setTimeout( () => this.classList.remove( 'kadim--transitioning' ), 1000 );

    });

  }

  schemeBtns.forEach( ( button ) => {
    button.addEventListener( 'click', ColorScheme.toggle );
  });


    body.addEventListener( ColorScheme.eventType, function() {

      schemeBtns.forEach( ( button ) => {

          const { classList }             =   button;
          const { scheme, dark, light }   =   ColorScheme;
          classList.remove( 'btn-scheme--to-light', 'btn-scheme--to-dark' );
          classList.add( `btn-scheme--to-${ scheme === dark ? light : dark }` );

      });

    });

    ColorScheme.triggerAll();



  const notice = document.getElementById( "notice" );

  if( notice ) {

    document.querySelectorAll( '.btn-close-notice' ).forEach( (item) => {

      const date = new Date();

      date.setTime(date.getTime() + 24*60*60*1000);
      

      item.addEventListener( 'click', () => { 

        notice.classList.add( "notice--collapsed" );
        // document.cookie = `collapsed=true; ${ date }; path=/;`;

      });

    });

  }

  // Searchform Btn

  const searchformModal = document.getElementById( "modal-searchform" );

  if( searchformModal ) {

    document.querySelectorAll( '.js-btn-expand-searchform' ).forEach(button => {
      
      button.addEventListener( 'click', () => { 

        searchformModal.querySelector( ".search-form__field" ).focus();
        searchformModal.classList.remove( "modal-searchform--collapsed" );
        searchformModal.classList.add( "modal-searchform--expanded" );

      });

    });


    document.querySelectorAll( '.js-btn-collapse-searchform' ).forEach(button => {
      
      button.addEventListener( 'click', () => { 

        searchformModal.classList.remove( "modal-searchform--expanded" )
        searchformModal.classList.add( "modal-searchform--collapsed" )

      });

    });

  }

  const sidebar = document.getElementById( "sidebar" );

  if( sidebar ) {

    
    document.querySelectorAll( '.js-btn-expand-sidebar' ).forEach(button => {
      
      button.addEventListener( 'click', () => { 

        sidebar.classList.remove( "sidebar--collapsed" );
        sidebar.classList.add( "sidebar--expanded" );

      });

    });

    document.querySelectorAll( '.js-btn-collapse-sidebar' ).forEach(button => {
      
      button.addEventListener( 'click', () => { 

        sidebar.classList.add( "sidebar--collapsed" );
        sidebar.classList.remove( "sidebar--expanded" );

      });

    });


  }

  // side naviation menu   
  

  // side navigation functions
    
  const

      sideMenu            =   document.getElementById( 'sidemenu-list' ),
      itemsWithChilds     =   ( sideMenu ? sideMenu.querySelectorAll( '.sidemenu__item--has-children' ) : null );


  if( itemsWithChilds ) {

      sideMenu.addEventListener( 'click', function ( event ) {
          

          const { target }    =   event;
          let 
          link    =   target.closest( 'a' ),
          item    =   ( link ? link.parentNode : null );

          if( !item ) { return; }
          
          if( !item.classList.contains( 'sidemenu__item--has-children' ) ) { return; }

          event.preventDefault();

          if( item.getAttribute( 'expanded' ) == 'true' ) {

              item.setAttribute( 'expanded', false );
              return;
          }


          item.setAttribute( 'expanded', true );


          itemsWithChilds.forEach( ( otherItem ) => { 

              if( otherItem.querySelector( '[expanded=true]' ) || otherItem === item ) {
              
                  otherItem.setAttribute( 'expanded', true );    
                  return; 
              }

              otherItem.setAttribute( 'expanded', false );

          });

      }, false );


  }

  const 

    loadMoreButtons = document.querySelectorAll( ".js-btn-loadmore" ),
    postsContainer = document.getElementById( "kadim-posts" );

  /** load more posts button */

  let paged = 1,
      requestGoing = false;

  const { ajaxUrl, loadMorePostsNonce } = globals;

    loadMoreButtons.forEach(( button ) => {

      let  [ loadingModifier ] = button.classList;
      
      loadingModifier = `${ loadingModifier }--loading`;
      
      button.addEventListener( "click", (event) => {

        event.preventDefault();

        if( requestGoing ) { return; }

        paged += 1;

        button.classList.add( loadingModifier );

        const data = new FormData();

        data.append( "action", "loadmore_posts" );
        data.append( "paged", paged );
        data.append( "nonce", loadMorePostsNonce );
        
        requestGoing = true;

        console.log( requestGoing );

        fetch( ajaxUrl, {

          method: "POST",
          credentials: 'same-origin',

          body: data,

        })

        .then( ( response ) => response.text() )

        .then( (html) => {

          let posts = stringToHTML( html );

          posts = posts?.querySelectorAll( "article" ); 

          posts.forEach( post => postsContainer.append( post ) );

          MacroLoading.refresh();

          button.classList.remove( loadingModifier );

        }).finally( () => {

          requestGoing = false;

        });

        

      });  


    });
  
  /** instagram footer videos toggle sound  */

  const volumeControls = document.querySelectorAll( ".js-video-volume" ); 
  const videos = document.querySelectorAll( '.js-instagram-videos' );
  let initiallyMuted;

  volumeControls.forEach( (control) =>  {

    let [ firstClass = false ] = control.classList;

    control.addEventListener( "click", (event) => {

      event.preventDefault();

      const associatedVideo = control?.parentNode?.querySelector( "video" );

      if( !associatedVideo ) { return; }

      /** saving initial state */
      initiallyMuted = associatedVideo.muted;


      /** muting all videos */
      videos.forEach( (video) => video.muted = true );

      /** changing all controls to mute */
      volumeControls.forEach( (control) => {

        let [ firstClass = false ] = control.classList;

        firstClass && control.classList.remove( `${firstClass}--unmuted`);

      });

      /** toggle video sound */
      associatedVideo.muted = !initiallyMuted;

      
        firstClass &&
        ( initiallyMuted ? control.classList.add( `${firstClass}--unmuted`) : control.classList.remove( `${firstClass}--unmuted`) );

    });

  });

  /** instagram footer videos toggle play */

  const playStateControls = document.querySelectorAll( ".js-video-play" ); 
  let initiallyPaused;

  playStateControls.forEach((control) =>{

    let [ firstClass = false ] = control.classList;

    control.addEventListener( "click", (event) => {

      event.preventDefault();

      const associatedVideo = control?.parentNode?.querySelector( "video" );
      
      if( !associatedVideo ) { return; }

      initiallyPaused = associatedVideo.paused;

      ( initiallyPaused ? associatedVideo.play() : associatedVideo.pause() );

      if( !firstClass ) { return; }

      ( initiallyPaused ? control.classList.remove( `${firstClass}--paused` ) : control.classList.add( `${firstClass}--paused` ) );

    
    });

  });

  /** instagram Icon colorize */

  const footerInstagramIcons = document.querySelectorAll( ".js-footer-instagram-icon" );
  const secondaryClassRegex = /.*__secondary/i;
  const whiteColor = "rgba(255,255,255, .7)";
  const { accentColor } = globals;

  footerInstagramIcons.forEach( (icon) => { 
    
    let instance = octo.InstagramIcon.getInstance( icon );

    if( !instance ) { return; }
    
    let isSecondary = [ ...icon.classList ].some( ( cssClass ) => cssClass.match( secondaryClassRegex ) );

    let properties = {
      middleRingCirclesCount: 8,
      middleRingAccelerationX: 0.15,
      middleRingAccelerationY: 0.15,
      middleRingContextProperties: {
        strokeStyle: ( isSecondary ? whiteColor : accentColor )
      },

      upRightCircleAccelerationX: 0.1,
      upRightCircleAccelerationY: 0.1,
      upRightCircleCirclesCount: 8,
      upRightCircleContextProperties : {
        strokeStyle: whiteColor
      },

      borderCirclesCount: 200,
      borderAccelerationX: 0.15,
      borderAccelerationY: 0.15,
      borderContextProperties: {
        strokeStyle: ( isSecondary ? accentColor : whiteColor )
      },

    }

    Object.assign( instance, properties );

    instance.draw();

  });

});


/** Hiding menu when overflows */

let dynmaicMenuDisplay = () =>  {

  const 
    menuItem = document.querySelector( '.menu__item' ), 
    menu  = document.querySelector( '.menu' );

    if( menuItem?.offsetHeight != menu?.offsetHeight ){
      menu?.classList?.add( 'hidden' );
    } else {
      menu?.classList?.remove( 'hidden' );

    }

}

window.addEventListener( "load", dynmaicMenuDisplay );
window.addEventListener( "resize", dynmaicMenuDisplay );


  /** Load footer Instagram videos  */

window.addEventListener( "load", () => {

  const videos = document.querySelectorAll( '.js-instagram-videos' );

  videos.forEach( (video) => {

    const [ firstClass = false ] = video.classList;

    video.removeAttribute( "preload" );
    video.setAttribute( "autoplay", true );

    if( firstClass ) {

      video.classList.add( `${firstClass}--loaded` );

    }

  });

});