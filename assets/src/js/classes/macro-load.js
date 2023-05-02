

class MacroLoading {

    static images   =   new Set();

    static preloadClass =   'image--ready';
    static loadingClass =   'image--loading';
    static loadedClass  =   'image--loaded';


    static init() {


        const { updateNodes, addScroller, loadImagesInViewPort, loadAll } =   MacroLoading;
        
        updateNodes();
        addScroller( window );

        loadImagesInViewPort();

        window.addEventListener( 'load', loadAll );
        
        const { images, preloadClass, loadingClass, loadedClass } =   MacroLoading;


        // initializing images with the macro src

        images.forEach( image => {

            const { classList } =   image;

            if( classList.contains( loadingClass ) ) { return; }
            if( classList.contains( loadedClass ) ) { return; }

            // init the images with the macro image
            if( image.hasAttribute( 'data-image-macro' ) ) {

                image.setAttribute( 'src', image.getAttribute( 'data-image-macro' ) );
                classList.add( preloadClass );

            }

            if( image.hasAttribute( 'data-background-macro' ) ) {

                image.style.backgroundImage =   `url(${image.getAttribute( 'data-background-macro' )})` ;
                classList.add( preloadClass );

            } 


        });

    }


    static updateNodes() {

        const { loadedClass }   =   MacroLoading;

        // setting all the images
        MacroLoading.images   =   new Set( document.querySelectorAll( `[data-loading-method='macro']:not(.${ loadedClass })` ) );


    }

    static refresh() {

        MacroLoading.updateNodes();
        MacroLoading.loadAll();

    }
 
    static addScroller( element ) {

        if( !( element instanceof HTMLElement || element instanceof Window ) ) { return; };
        
        element.addEventListener( 'scroll', MacroLoading.loadImagesInViewPort );

    }


    static isInViewport(element) {

        const   
            rect                            =   element.getBoundingClientRect(),
            
            { top, right, bottom, left }    =   rect,
            
            { 
                innerWidth: windowWidth,
                innerHeight: windowHeight
            }   =   window;


        return (

            ( ( top >= 0 && top < windowHeight ) || ( bottom >= 0 && bottom < windowHeight ) || ( top < 0 && bottom > windowHeight ) ) && 
            
            ( ( left >= 0 && left < windowWidth ) || ( right >= 0 && right < windowWidth ) || ( left < 0 && right > windowWidth ) )

        );

    }

    static imageLoaded( { target } ) {

        const { loadedClass, imageLoaded }    =   MacroLoading;

        target.classList.add( loadedClass );
        target.removeEventListener( 'load', imageLoaded );

    }

    static loadImagesInViewPort() {

        const { images, isInViewport, loadingClass, loadedClass, preloadClass, imageLoaded }    =   MacroLoading;

        images.forEach( ( image ) => {

            const { classList }  =   image;

            if( !isInViewport( image ) ) {  return; }

            if( classList.contains( loadedClass ) )  { return; }
            
            if( classList.contains( loadingClass ) ) { return; }

            if( !( image.hasAttribute( 'data-background' ) || image.hasAttribute( 'data-image' ) ) ) { return; }
                
            classList.add( loadingClass );

            let url     =   image.getAttribute( image.hasAttribute( 'data-background' ) ? 'data-background' : 'data-image' );

            fetch( url ).then( ( response ) => response.blob() ).then( ( blob ) => {


                let objectURL = URL.createObjectURL( blob );

                setTimeout(() => {

                    images.forEach( ( image ) => {

                        const { classList }  =   image;
    
                        if( image.getAttribute( 'data-image' ) == url )  {
                            
                            image.setAttribute( 'src', objectURL );
                            image.addEventListener( 'load', imageLoaded );
                        
                        } else if( image.getAttribute( 'data-background' ) == url ) {
                        
                            image.style.backgroundImage =   `url(${objectURL})`;
                            classList.add( loadedClass );
                        
                        } 
                        
                        else {
                            return;
                        }
    
                        classList.remove( loadingClass );
                        classList.remove( preloadClass );
    
                        images.delete( image );
    
                    });
    
                    
                }, 2000);



            });
                
    
        });

    }

    static loadAll() {


        const { images, isInViewport, loadingClass, loadedClass, preloadClass, imageLoaded }    =   MacroLoading;

        images.forEach( ( image ) => {

            const { classList }  =   image;
            
            if( classList.contains( loadedClass ) )  { return; }

            if( classList.contains( loadingClass ) ) { return; }

            if( !( image.hasAttribute( 'data-background' ) || image.hasAttribute( 'data-image' ) ) ) { return; }
                
            classList.add( loadingClass );

            let url     =   image.getAttribute( image.hasAttribute( 'data-background' ) ? 'data-background' : 'data-image' );

            fetch( url ).then( ( response ) => response.blob() ).then( ( blob ) => {

                let objectURL = URL.createObjectURL( blob );

                images.forEach( ( image ) => {

                    const { classList }  =   image;

                    if( image.getAttribute( 'data-image' ) == url )  {
                        
                        image.setAttribute( 'src', objectURL );
                        image.addEventListener( 'load', imageLoaded );
                    
                    } else if( image.getAttribute( 'data-background' ) == url ) {
                    
                        image.style.backgroundImage =   `url(${objectURL})`;
                        classList.add( loadedClass );
                    
                    } 
                    
                    else {
                        return;
                    }

                    classList.remove( loadingClass );
                    classList.remove( preloadClass );

                    images.delete( image );

                });
                    
            });
    
        });
    }
    
}

export default MacroLoading;