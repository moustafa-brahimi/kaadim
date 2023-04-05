import "./instagram-icon.css";

import { randomNumber, isDOM, stringToHTML } from "../functions";

class InstagramIcon {

    static allIcons = new Set();

    outerCircles = [];
    icon = document.getElementById( "instagram-icon" );
    size = 500;

    
    middleRingleCircles = [];
    middleRingRelativeX = 0.5;
    middleRingRelativeY = 0.5;
    middleRingMinRelativeRadius = 0.166;
    middleRingMaxRelativeRadius = 0.258;
    middleRingAccelerationX = 0.1;
    middleRingAccelerationY = 0.1;
    middleRingCirclesCount = 8;
    middleRingContextProperties = {
        strokeStyle: "#dddddd",
        lineWidth: 2,
    };


    upRightCircleCircles = [];
    upRightCircleMinRelativeRadius = 0;
    upRightCircleMaxRelativeRadius = 0.062;
    upRightCircleRelativeX = 1 - 0.232;
    upRightCircleRelativeY = 0.232;
    upRightCircleAccelerationX = 0.1;
    upRightCircleAccelerationY = 0.1;
    upRightCircleCirclesCount = 8;
    upRightCircleContextProperties = {
        strokeStyle: "#ea7",
        lineWidth: 2,
    };


    borderMinRelativeRadius = 0;
    borderMaxRelativeRadius = 0.09;
    borderRelativeDistance = 0.5;
    borderRelativeSecondaryDistance = 0.152;
    borderCirclesCount = 100;
    borderAccelerationX = 0.25;
    borderAccelerationY = 0.25;
    borderContextProperties = {
        strokeStyle: "#ea7",
        lineWidth: 2,
    };
    static borderSvgMask = `<svg xmlns="http://www.w3.org/2000/svg" width="500" height="499.888" viewBox="0 0 500 499.888">

        <clipPath id="instagram-border-mask">
        <path d="M498.168,178.7c-1.9-40.045-11.043-75.516-40.379-104.741-29.225-29.225-64.7-38.371-104.741-40.379-41.272-2.342-164.975-2.342-206.247,0-39.933,1.9-75.4,11.043-104.741,40.268S3.69,138.546,1.682,178.59c-2.342,41.272-2.342,164.975,0,206.247,1.9,40.045,11.043,75.516,40.379,104.741s64.7,38.371,104.741,40.379c41.272,2.342,164.975,2.342,206.247,0,40.045-1.9,75.516-11.043,104.741-40.379,29.225-29.225,38.371-64.7,40.379-104.741,2.342-41.272,2.342-164.863,0-206.135ZM444.85,429.12a84.359,84.359,0,0,1-47.518,47.518c-32.906,13.051-110.987,10.039-147.351,10.039s-114.557,2.9-147.351-10.039A84.359,84.359,0,0,1,55.112,429.12C42.061,396.214,45.073,318.133,45.073,281.769s-2.9-114.557,10.039-147.351A84.359,84.359,0,0,1,102.63,86.9C135.536,73.85,213.617,76.861,249.981,76.861s114.557-2.9,147.351,10.039a84.359,84.359,0,0,1,47.518,47.518c13.051,32.906,10.039,110.987,10.039,147.351S457.9,396.326,444.85,429.12Z" transform="translate(0.075 -31.825)"/>
        </clipPath>
    
    </svg>`;


    constructor( htmlIcon = false ) {

        if( htmlIcon && isDOM( htmlIcon ) ) {
            this.icon = htmlIcon
        }


        const { icon } = this

        
        /** Checking if the Icon Isn't already Animatable */

        if( InstagramIcon.allIcons.has( icon ) ) { 
            return null;
        }
        InstagramIcon.allIcons.add( icon );


        /** Setting Size */

        let htmlIconSize = icon.getAttribute( "size" );
        
        if( htmlIcon !== null && ( htmlIconSize = Math.trunc( htmlIconSize ) ) != NaN && htmlIconSize > 0 ) {
            this.size = htmlIconSize;
        } 
        
    
    
        /** Generating Necessary Html Elements */
    
        const { size } = this;

        let innerCanvas = document.createElement( 'canvas' );

        innerCanvas.classList.add( "instagram-icon__inner" );

        innerCanvas.setAttribute( "height", size );
        innerCanvas.setAttribute( "width", size );

        this.innerCanvas = innerCanvas;

        icon.appendChild( this.innerCanvas );


        let outerCanvas = document.createElement( 'canvas' );

        outerCanvas.classList.add( "instagram-icon__outer" );

        outerCanvas.setAttribute( "height", size );
        outerCanvas.setAttribute( "width", size );

        this.outerCanvas = outerCanvas;

        icon.appendChild( this.outerCanvas );
        

        this.draw();

    }

    animate() {

        
        let drawArrayOfCircles = ( circle, context ) => {

            let boundaries;

            context.beginPath();
            context.arc( circle.x, circle.y, circle.r, 0, 2 * Math.PI );
            context.closePath();
            context.stroke();

            circle.x += circle.ax;
            circle.y += circle.ay;

            if( typeof circle.boundaries != 'object' ) {

                boundaries = {
                    x : circle.boundaries,
                    y : circle.boundaries
                }

            } else {
                boundaries = circle.boundaries;
            }

            if( circle.x > circle.refX + boundaries.x || circle.x < circle.refX - boundaries.y ) {
                circle.ax = -circle.ax;
            }

            if( circle.y > circle.refY + boundaries.y || circle.y < circle.refY - boundaries.y ) {
                circle.ay = -circle.ay;
            }


        };



        const { 
            innerContext,
            size,
            middleRingContextProperties,
            middleRingleCircles,
        } = this;

        innerContext.clearRect( 0, 0, size, size);
        Object.assign( innerContext, middleRingContextProperties );
        middleRingleCircles.forEach( (circle) => drawArrayOfCircles( circle, innerContext ) );

        
        const { 
            upRightCircleContextProperties,
            upRightCircleCircles,
        } = this;

        Object.assign( innerContext, upRightCircleContextProperties );
        upRightCircleCircles.forEach( (circle) => drawArrayOfCircles( circle, innerContext ) );
        

        const {
            outerContext,
            borderContextProperties,
        } = this;

        outerContext.clearRect( 0, 0, size, size);
        Object.assign( outerContext, borderContextProperties );
        this.outerCircles.forEach( (circle) => drawArrayOfCircles( circle, outerContext ) );


        requestAnimationFrame( () => this.animate() );

    }

    draw() {

        const { 
            size,
            middleRingRelativeX,
            middleRingRelativeY,
            middleRingMinRelativeRadius,
            middleRingMaxRelativeRadius,
            middleRingAccelerationX,
            middleRingAccelerationY,
            middleRingCirclesCount,
        } = this;

        
        /** Generating Middle Ring Circles */

        const   middleRingMaxRaduis = size * middleRingMaxRelativeRadius,
                middleRingMinRaduis = size * middleRingMinRelativeRadius,
                middleRingCenterX = size * middleRingRelativeX,
                middleRingCenterY = size * middleRingRelativeY;

        for( let i = 0; i < middleRingCirclesCount; i++ ) {


            let randomCircleRaduis = randomNumber( middleRingMinRaduis, middleRingMaxRaduis );
            let boundaries = Math.min( randomCircleRaduis - middleRingMinRaduis, middleRingMaxRaduis - randomCircleRaduis );    

            let positioningX = randomNumber( -boundaries, boundaries );
            let positioningY = randomNumber( -boundaries, boundaries );

            this.middleRingleCircles.push({

                refX: middleRingCenterX,
                refY: middleRingCenterY,
                x: middleRingCenterX + positioningX,
                y: middleRingCenterY + positioningY,
                r: randomCircleRaduis,
                ax: ( Math.random() > 0.5 ? middleRingAccelerationX : -middleRingAccelerationX ),
                ay: ( Math.random() > 0.5 ? middleRingAccelerationY : -middleRingAccelerationY ),
                boundaries,

            });



        }


        /** Generating Up right circle circles */

        const {
            upRightCircleRelativeX,
            upRightCircleRelativeY,
            upRightCircleMinRelativeRadius,
            upRightCircleMaxRelativeRadius,
            upRightCircleCirclesCount,
            upRightCircleAccelerationX,
            upRightCircleAccelerationY,
        } = this;

        const   upRightMinRadius = upRightCircleMinRelativeRadius * size,
                upRightMaxRadius = upRightCircleMaxRelativeRadius * size,
                upRightCenterX = upRightCircleRelativeX * size,
                upRightCenterY = upRightCircleRelativeY * size;


        for( let i = 0; i < upRightCircleCirclesCount; i++ ) {

            let randomCircleRaduis = randomNumber( upRightMinRadius, upRightMaxRadius );
            let boundaries = upRightMaxRadius - randomCircleRaduis;

            let positioningX = randomNumber( -boundaries, boundaries );
            let positioningY = randomNumber( -boundaries, boundaries );

            this.upRightCircleCircles.push({

                refX: upRightCenterX,
                refY: upRightCenterY,
                x: upRightCenterX + positioningX,
                y: upRightCenterY + positioningY,
                r: randomCircleRaduis,
                ax: ( Math.random() > 0.5 ? upRightCircleAccelerationX : -upRightCircleAccelerationX ),
                ay: ( Math.random() > 0.5 ? upRightCircleAccelerationY : -upRightCircleAccelerationY ),
                boundaries,

            });

        }



        /** Generating Border Circles */

        const {
            borderMinRelativeRadius,
            borderMaxRelativeRadius,
            borderRelativeDistance,
            borderRelativeSecondaryDistance,
            borderAccelerationX,
            borderAccelerationY,
        } = this;

        const   borderMinRadius = size * borderMinRelativeRadius ,
                borderMaxRadius = size * borderMaxRelativeRadius;


        for( let i = 0; i < 250; i++ ) {


            let side = parseInt( i / ( 250 / 4 ) );
            let refX = borderRelativeSecondaryDistance;
            let refY = borderRelativeDistance;
            
           
            
            let randomCircleRaduis = randomNumber( borderMinRadius, borderMaxRadius );


            switch( side ) {

                case 0:

                    refX = borderRelativeSecondaryDistance;
                    refY = borderRelativeDistance;
    
                break;
                
                case 1:

                    refX = borderRelativeDistance;
                    refY = borderRelativeSecondaryDistance;
    
                break;

                
                case 2:

                    refX = ( 1 - borderRelativeSecondaryDistance );
                    refY = borderRelativeDistance;
    
                break;

                case 3:
                
                    refX = borderRelativeDistance;
                    refY = ( 1 - borderRelativeSecondaryDistance );

                break;


            }


            let boundariesX = ( refX == borderRelativeDistance ? refX : borderRelativeSecondaryDistance ) * size - randomCircleRaduis;
            let boundariesY = ( refY == borderRelativeDistance ? refY : borderRelativeSecondaryDistance ) * size - randomCircleRaduis;

            let positioningX = randomNumber( -boundariesX, boundariesX );
            let positioningY = randomNumber( -boundariesY, boundariesY );

            refX *= size;
            refY *= size;

            this.outerCircles.push({

                refX,
                refY,
                x: refX + positioningX,
                y: refY + positioningY,
                r: randomCircleRaduis,
                ax: randomNumber( -borderAccelerationX, borderAccelerationX ),
                ay: randomNumber( -borderAccelerationY, borderAccelerationY ),
                boundaries: {
                    x: boundariesX,
                    y: boundariesY,
                }


            });



        }


        this.animate();


    }

    get innerContext() {

        return this.innerCanvas.getContext( "2d" );

    }
    
    get outerContext() {

        return this.outerCanvas.getContext( "2d" );

    }


    static init() {
        
        if( document.readyState == "loading" ) {
            document.addEventListener( "DOMContentLoaded", InstagramIcon.init );
            return;
        }

        let svgMask = stringToHTML( InstagramIcon.borderSvgMask )?.firstChild;

        document.body.appendChild( svgMask );

    }

}


InstagramIcon.init();

export default InstagramIcon;


