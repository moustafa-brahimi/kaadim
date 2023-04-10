import anime from 'animejs';
import { isTouchDevice } from '../functions';



class CompactSlider {

    static slider   =   document.querySelector( '.js-slider-compact' );
    static timeout  =   10000;
    static sensivity=   50;
    static intervalId;
    static items;
    static highlightedItem;

    static categoryPermalinkLocaion;
    static categoryNameLocaion;
    static categoryAnimationTimeline;
    
    static permalinkLocaion;
    
    static titleLocaion;
    static titleAnimationTimeline;
    
    static authorPermalinkLocation;
    static authorAvatarLocation;
    static authorNameLocation;
    
    static dateLocation;
    
    static footerLocation;
    static footerAnimationTimeline;

    

    static init() {

        const { slider, setAutoPlay, clearAutoPlay, highlightAnItem }    =   CompactSlider;

        if( !slider ) { return; }

        CompactSlider.items                  =   slider.querySelectorAll( '.js-slider-item' );
        CompactSlider.container              =   slider.querySelector( '.js-slider-compact-container' );

        CompactSlider.categoryPermalinkLocaion=  slider.querySelectorAll( '.js-slider-category-permalink' );
        CompactSlider.categoryNameLocaion    =   slider.querySelectorAll( '.js-slider-category-name' );

        

        CompactSlider.permalinkLocaion       =   slider.querySelectorAll( '.js-slider-permalink' );
        CompactSlider.titleLocaion           =   slider.querySelectorAll( '.js-slider-title' );
        CompactSlider.titleBackgroundLocaion =   slider.querySelectorAll( '.js-slider-title-background' );

        CompactSlider.authorPermalinkLocation=   slider.querySelectorAll( '.js-slider-author-permalink' );
        CompactSlider.authorAvatarLocation   =   slider.querySelectorAll( '.js-slider-author-avatar' );
        CompactSlider.authorNameLocation     =   slider.querySelectorAll( '.js-slider-author-name' );

        CompactSlider.dateLocation           =   slider.querySelectorAll( '.js-slider-date' );

        CompactSlider.footerLocation         =   slider.querySelectorAll( '.js-slider-footer' );
        

        const { items, container, sensivity }    =   CompactSlider;

        if( !isTouchDevice() ) {

            items.forEach( item => {

                let index   =   Array.from( items ).indexOf( item );

                item.addEventListener( 'mouseenter', () => {

                    clearAutoPlay();

                    CompactSlider.highlightAnItem( index );

                });
                
            });

        }

        ( container ? container.addEventListener( 'mouseleave', setAutoPlay ) : '' );
        
        setAutoPlay();
        highlightAnItem(0);

        // touch swipe 

        container.addEventListener( 'touchstart', ( { changedTouches } ) => {

            if( changedTouches && changedTouches.length && changedTouches[0] && changedTouches[0].pageX ) {

                CompactSlider.touchPosition    =   changedTouches[0].pageX;
                
            } else {
                
                CompactSlider.touchPosition    =   0;

            }
            
        });


        container.addEventListener( 'touchend', ( { changedTouches } ) => {

            if( !( changedTouches && changedTouches.length && changedTouches[0] && changedTouches[0].pageX ) ) { return; }

            const { highlightedItem, touchPosition, items }   =   CompactSlider;

            let diffrence   =   changedTouches[0].pageX - touchPosition;


            if( diffrence < -sensivity ) {
                highlightAnItem( ( highlightedItem + 1 ) % items.length );

            } else if( diffrence > sensivity ) {
                ( highlightedItem > 0 ? highlightAnItem( ( highlightedItem - 1 ) % items.length ) : '' );
            
            }
            
        });

        // footer hover animation

        const separator =   slider.querySelectorAll( '.js-separator' );

        CompactSlider.footerLocation.forEach( location => location.addEventListener( 'mouseenter', () => {

            anime({

                targets : separator,
                d       : ( element ) => { return element.getAttribute( 'alt-d' ); },
                easing: 'easeOutQuad',
                duration: 600,

            });

        }));

        CompactSlider.footerLocation.forEach( location => location.addEventListener( 'mouseleave', () => {

            anime({

                targets : separator,
                d       : ( element ) => { return element.getAttribute( 'main-d' ); },
                easing: 'easeOutQuad',
                duration: 600,

            });

        }));

    }

    static setAutoPlay() {

        const { timeout, items, intervalId, highlightAnItem,  }    =   CompactSlider;
        
        if( intervalId !== undefined ) { return; }
        
        CompactSlider.intervalId    =   setInterval( () => {
            
            const { highlightedItem, highlightAnItem }    =   CompactSlider;
            
            let nextItem    =   ( highlightedItem !== undefined ? ( highlightedItem + 1 ) % items.length : 0 );
            
            highlightAnItem( nextItem );
            
        }, timeout );

    }

    static clearAutoPlay() {

        const { intervalId }    =   CompactSlider;
        
        if( intervalId ) {

            clearInterval( intervalId );
            CompactSlider.intervalId    =   undefined;

        }


    }

    static highlightAnItem( itemIndex = 0 ) {

        const { slider, items, highlightedItem, setTitle, setPermalink, setCategoryName, setCategoryPermalink, setFooter, setAuthorPermalink }    =   CompactSlider;

        if( !( items ) ) { return; }
        
        let item    =   items[ itemIndex ];
        
        if( !( item ) ) { return; }

        if( itemIndex === highlightedItem ) { return; }

        CompactSlider.highlightedItem   =   itemIndex;

        let 
        
        categoryPermalink   =   item.querySelector( '.js-post-category-link' ),
        categoryName        =   item.querySelector( '.js-post-category' ),

        title       =   item.querySelector( '.js-post-title' ),
        permalink   =   item.querySelector( '.js-post-permalink' ),

        authorPermalink     =   item.querySelector( '.js-author-link' ),
        authorAvatar        =   item.querySelector( '.js-author-avatar' ),
        authorName          =   item.querySelector( '.js-author-name' ),
        
        date                =   item.querySelector( '.js-post-date' );

        setCategoryPermalink( ( categoryPermalink ? categoryPermalink.getAttribute( 'href' ) : '' ) );
        setCategoryName( ( categoryName ? categoryName.textContent : '' ) );

        setTitle( ( title ? title.textContent : '' ) );
        setPermalink( ( permalink ? permalink.getAttribute( 'href' ) : '#' ) );


        setFooter( 

            ( authorName ? authorName.textContent : '' ),
            ( authorAvatar ? authorAvatar.getAttribute( 'src' ) : '' ),
            ( date ? date.textContent : '' ),
            ( date ? date.getAttribute( 'title' ) : '' ),
            ( date ? date.getAttribute( ( 'datetime' ) ) : '' ),
        
        )

        setAuthorPermalink( ( authorPermalink ? authorPermalink.getAttribute( 'href' ) : '' ) );

        slider.setAttribute( 'highlighted', itemIndex );


    }

    static setTitle( title = '' ) {

        const 
        
        { titleLocaion, titleAnimationTimeline }    =   CompactSlider,
        titleLineHeight     =   getComputedStyle( document.body).getPropertyValue('--evy-slider-compact-title-line-height'),
        titleLineHeightPlus =   `${ parseFloat( titleLineHeight ) + 0.5}em`;

        let sameItem    =   [ ...titleLocaion ].every( location => location.textContent === title );

        if( titleAnimationTimeline ) {
            
            titleAnimationTimeline.pause();

            if( sameItem ) {

                const { currentTime }   =   titleAnimationTimeline;

                CompactSlider.titleAnimationTimeline    =   anime.timeline({
                    duration:   currentTime,
                });


                CompactSlider.titleAnimationTimeline.add({
            
                    targets     :   titleLocaion,
                    easing      :   'easeOutQuint',
                    translateY  :   "0%",
                    rotate      :   "0",
                    scaleY      :   '1',
                    lineHeight  :   titleLineHeight,
                    delay       :   anime.stagger( 50 ),

                    
                });

                return;
            }


        }

        
        CompactSlider.titleAnimationTimeline    =   anime.timeline({
            
            duration:   1000,
            
        });
        
        CompactSlider.titleAnimationTimeline.add({
            
            targets     :   titleLocaion,
            easing      :   'easeInQuint',
            translateY  :   "-125%",
            rotate      :   "4deg",
            scaleY      :   '1.4',
            lineHeight  :   [ titleLineHeight, titleLineHeightPlus ],
            delay       :   anime.stagger( 50 ),
            
            complete: function() {
                
                titleLocaion.forEach( ( location ) => {
                    
                    location.textContent = title;
                    
                });
                 
            }
            
        }).add({
            
            targets     :   titleLocaion,
            easing      :   'easeOutQuint',
            translateY  :   [ '100%', '0%' ],
            rotate      :   '0deg',
            scaleY      :   '1',
            scale       :   [ 0.9, 1 ],
            delay       :   200,


            lineHeight  :   {
                
                delay   :   300,
                value   :   [ titleLineHeightPlus, titleLineHeight ],
            
            },

            complete: () => {  CompactSlider.titleAnimationTimeline = null }

        });
        

    }
    

    static setCategoryName( name = '' ) {

        const 
        { categoryNameLocaion, categoryPermalinkLocaion, categoryAnimationTimeline : previousTimeline }    =   CompactSlider,
        sameItem    =   [ ...categoryNameLocaion ].every( location => location.textContent === name );

        if( previousTimeline ) {
            previousTimeline.pause();

            if( sameItem ) {

                const { currentTime }   =   previousTimeline;

                CompactSlider.categoryAnimationTimeline =   anime.timeline({ duration: currentTime });

                CompactSlider.categoryAnimationTimeline.add({
                
                    targets     :   categoryPermalinkLocaion,
                    easing      :   'easeOutQuint',
                    translateY  :   '0%',
                    complete    :   () => {  CompactSlider.categoryAnimationTimeline = null }
    
                });

                return;

            }

        }

        CompactSlider.categoryAnimationTimeline =   anime.timeline({ duration: 800 });
        
        CompactSlider.categoryAnimationTimeline.add({
            
            targets     :   categoryPermalinkLocaion,
            easing      :   'easeInQuint',
            translateY  :   "-100%",

            
            complete: function() {
                
                categoryNameLocaion.forEach( ( location ) => {
                    
                    location.textContent = name;
                    
                });
                
            }
            
        });

        if( name && name.length > 0 ) {
        
            CompactSlider.categoryAnimationTimeline.add({
                
                delay       :   1200,
                targets     :   categoryPermalinkLocaion,
                easing      :   'easeOutQuint',
                translateY  :   [ '100%', '0%' ],
                complete    :   () => {  CompactSlider.categoryAnimationTimeline = null }


            });

        }



    }

    static setFooter( name = '', avatar = '', date = '', dateTitle = '', dateTime = '' ) {

        const 
        
        { authorAvatarLocation, authorNameLocation, dateLocation, footerLocation, footerAnimationTimeline: previousTimeline, slider }    =   CompactSlider,
        separator   =   slider.querySelectorAll( '.js-separator' );

        if( previousTimeline ) {

            let 
            sameAuthorName  =   [ ...authorNameLocation ].every( location => location.textContent === name ),
            sameAuthorAvatar=   [ ...authorAvatarLocation ].every( location => location.getAttribute( 'src' ) === avatar ),
            sameDate        =   [ ...dateLocation ].every( location => location.textContent === date ),
            sameDateTitle   =   [ ...dateLocation ].every( location => location.getAttribute( 'title' ) === dateTitle ),
            sameDateTime    =   [ ...dateLocation ].every( location => location.getAttribute( 'datetime' ) === dateTime ),
            sameItem        =   ( sameAuthorName && sameAuthorAvatar && sameDate && sameDateTitle && sameDateTime );

            previousTimeline.pause();

            if( sameItem ) {

                const { currentTime : duration }        =   previousTimeline;
                CompactSlider.footerAnimationTimeline   =   anime.timeline({ duration });
                
                CompactSlider.footerAnimationTimeline.add({

                    targets     :   footerLocation,
                    easing      :   'easeOutQuint',
                    translateY  :   '0%',
                    complete: () => {  CompactSlider.footerAnimationTimeline = null }

                });

                return;

            }

        }

        CompactSlider.footerAnimationTimeline    =   anime.timeline({ duration: 800 });


        CompactSlider.footerAnimationTimeline.add({

            targets : separator,
            d       : ( element ) => { return element.getAttribute( 'alt-d' ); },
            easing: 'easeOutQuad',
            direction: 'alternate',
            duration: 600,
            
        }).add({
            
            targets     :   footerLocation,
            easing      :   'easeInQuint',
            translateY  :   "-100%",

            complete: function() {
                
                authorNameLocation.forEach( ( location ) => {
                    
                    location.textContent = name;
                    
                });
                
                authorAvatarLocation.forEach( ( location ) => {
                    
                    location.setAttribute( 'src', avatar );
                    location.setAttribute( 'title', name );
                    
                });

                dateLocation.forEach( ( location ) => {
                    
                    location.textContent = date;
                    location.setAttribute( 'title', dateTitle );
                    location.setAttribute( 'datetime', dateTime );
                    
                });

            }


        }, '-=600' ).add({
            
            targets     :   footerLocation,
            delay       :   800,
            easing      :   'easeOutQuint',
            translateY  :   [ '100%', '0%' ],

            complete: () => {  CompactSlider.footerAnimationTimeline = null }

        }).add({


            targets : separator,
            d       : ( element ) => { return element.getAttribute( 'main-d' ); },
            easing: 'easeOutQuad',
            direction: 'alternate',
            duration: 600,
            

        });


    }

    static setPermalink( url = '#' ) {

        const { permalinkLocaion }  =   CompactSlider;

        permalinkLocaion.forEach( ( location ) => {

            location.setAttribute( 'href', url );

        });

    }

    static setAuthorPermalink( url = '#' ) {

        const { authorPermalinkLocation }  =   CompactSlider;

        authorPermalinkLocation.forEach( ( location ) => {

            location.setAttribute( 'href', url );

        });

    }
    
    static setCategoryPermalink( url = '#' ) {

        const { categoryPermalinkLocaion }  =   CompactSlider;

        categoryPermalinkLocaion.forEach( ( location ) => {

            location.setAttribute( 'href', url );

        });

    }

}

CompactSlider.init();