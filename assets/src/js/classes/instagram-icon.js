import { randomNumber } from "../functions";

class InstagramIcon {

    outerCircles = [];
    canvas = document.getElementById( "instagram-icon" );
    size = 500;
    
    
    
    middleRingleCircles = [];
    middleRingRelativeX = 0.5;
    middleRingRelativeY = 0.5;
    middleRingMinRelativeRadius = 0.166;
    middleRingMaxRelativeRadius = 0.258;
    middleRingAccelerationX = 0.1;
    middleRingAccelerationY = 0.1;
    middleRingCirclesCount = 25;
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
    upRightCircleCirclesCount = 25;
    upRightCircleCanvasProperties = {
        strokeStyle: "#dddddd",
        lineWidth: 2,
    };


    borderMinRelativeRadius = 0;
    borderMaxRelativeRadius = 0.09;
    borderRelativeDistance = 0.5;
    borderRelativeSecondaryDistance = 0.152;
    borderCirclesCount = 320;
    borderAccelerationX = 0.25;
    borderAccelerationY = 0.25;
    borderContextProperties = {
        strokeStyle: "#ea7",
        lineWidth: 2,
    };


    constructor( canvas = false ) {

        if( canvas ) {

            this.canvas = canvas;
        }

        this.outerCanvas = this.canvas.cloneNode(); 

        this.outerCanvas.classList.add( "instagram-icon__outer" );

        this?.canvas?.parentNode?.appendChild( this.outerCanvas );


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
            context,
            size,
            middleRingContextProperties,
        } = this;

        this.context.clearRect( 0, 0, size, size);
        Object.assign( context, middleRingContextProperties );
        this.middleRingleCircles.forEach( (circle) => drawArrayOfCircles( circle, context ) );



        const { 
            outerContext,
            outerHeight,
            outerWidth,
            borderContextProperties,
        
        } = this;

        outerContext.clearRect( 0, 0, outerWidth, outerHeight);
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

            this.middleRingleCircles.push({

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

    get context() {

        return this.canvas.getContext( "2d" );

    }

    get width() {

        return this.canvas.clientWidth;

    }
    
    get height() {

        return this.canvas.clientHeight;

    }


    
    get outerContext() {

        return this.outerCanvas.getContext( "2d" );

    }

    get outerWidth() {

        return this.outerCanvas.clientWidth;

    }
    
    get outerHeight() {

        return this.outerCanvas.clientHeight;

    }

}

export default InstagramIcon;