import { randomNumber } from "../functions";

class InstagramIcon {

    centreCircles = [];
    outerCircles = [];
    canvas = document.getElementById( "instagram-icon" );

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

        const { context, width, height } = this;

        this.context.clearRect( 0, 0, width, height);

        let centerX = width / 2;
        let centerY = height / 2;

        context.lineWidth = 2;

        this.centreCircles.forEach( (circle) => {

            context.beginPath();
            context.arc( circle.x, circle.y, circle.r, 0, 2 * Math.PI );
            context.closePath();
            context.stroke();

            circle.x += circle.ax;
            circle.y += circle.ay;

            if( circle.x > circle.refX + circle.bondaries || circle.x < circle.refX - circle.bondaries ) {
                circle.ax = -circle.ax;
            }

            if( circle.y > circle.refY + circle.bondaries || circle.y < circle.refY - circle.bondaries ) {
                circle.ay = -circle.ay;
            }

        });

        const { outerContext, outerHeight, outerWidth } = this;

        outerContext.clearRect( 0, 0, outerWidth, outerHeight);


        this.outerCircles.forEach( (circle) => {

            // console.log( circle.x );

            outerContext.beginPath();
            outerContext.arc( circle.x, circle.y, circle.r, 0, 2 * Math.PI );
            outerContext.closePath();
            outerContext.stroke();

            circle.x += circle.ax;
            circle.y += circle.ay;

            if( circle.x > circle.refX + circle.bondariesX || circle.x < circle.refX - circle.bondariesX ) {
                circle.ax = -circle.ax;
            }

            if( circle.y > circle.refY + circle.bondariesY || circle.y < circle.refY - circle.bondariesY ) {
                circle.ay = -circle.ay;
            }

        });


        requestAnimationFrame( () => this.animate() );

    }

    draw() {

        const { context, width, height } = this;

        const middleCircleMaxRaduis = width * 0.258;
        const middleCircleMinRaduis = width * 0.166;

        context.strokeStyle = "#dddddd";
        context.lineWidth = 2;


        for( let i = 0; i < 25; i++ ) {


            let randomCircleRaduis = randomNumber( middleCircleMinRaduis, middleCircleMaxRaduis );
            let howMuchIcanMove = Math.min( randomCircleRaduis - middleCircleMinRaduis, middleCircleMaxRaduis - randomCircleRaduis )

            let XMove = randomNumber( -howMuchIcanMove, howMuchIcanMove );
            let YMove = randomNumber( -howMuchIcanMove, howMuchIcanMove );

            this.centreCircles.push({

                refX: width / 2,
                refY: height / 2,
                x: width / 2 + XMove,
                y: height / 2 + YMove,
                r: randomCircleRaduis,
                ax: ( Math.random() > 0.5 ? 0.1 : -0.1 ),
                ay: ( Math.random() > 0.5 ? 0.1 : -0.1 ),
                bondaries: howMuchIcanMove,

            });



        }

        for( let i = 0; i < 25; i++ ) {


            let randomCircleRaduis = randomNumber( 0, height * 0.062 );
            let howMuchIcanMove = height * 0.062 - randomCircleRaduis;

            let XMove = randomNumber( -howMuchIcanMove, howMuchIcanMove );
            let YMove = randomNumber( -howMuchIcanMove, howMuchIcanMove );

            this.centreCircles.push({

                refX: width * (1 - 0.232),
                refY: height * 0.232,
                x: width * (1 - 0.232) + XMove,
                y: height * 0.232 + YMove,
                r: randomCircleRaduis,
                ax: ( Math.random() > 0.5 ? 0.1 : -0.1 ),
                ay: ( Math.random() > 0.5 ? 0.1 : -0.1 ),
                bondaries: howMuchIcanMove,

            });



        }

        const { outerWidth, outerHeight, outerContext } = this;

        outerContext.strokeStyle = "#dddddd";
        outerContext.lineWidth = 2;


        for( let i = 0; i < 250; i++ ) {


            let side = parseInt( i / ( 250 / 4 ) );
            let refX = 0.152;
            let refY = 0.5;
            
           
            
            let randomCircleRaduis = randomNumber( 0, outerWidth * 0.152 );


            switch( side ) {

                case 0:

                    refX = 0.152;
                    refY = 0.5;
    
                break;
                
                case 1:

                    refX = 0.5;
                    refY = 0.152;
    
                break;

                
                case 2:

                    refX = ( 1 - 0.152 );
                    refY = 0.5;
    
                break;

                case 3:
                
                    refX = 0.5;
                    refY = ( 1 - 0.152 );

                break;


            }


            let howMuchIcanMoveX = ( refX == 0.5 ? refX : 0.5 * 0.152 ) * outerWidth - randomCircleRaduis;
            let howMuchIcanMoveY = ( refY == 0.5 ? refY : 0.5 * 0.152 ) * outerHeight - randomCircleRaduis;

            let XMove = randomNumber( -howMuchIcanMoveX, howMuchIcanMoveX );
            let YMove = randomNumber( -howMuchIcanMoveY, howMuchIcanMoveY );

            refX *= outerWidth;
            refY *= outerHeight;

            this.outerCircles.push({

                refX: refX,
                refY: refY,
                x: refX + XMove,
                y: refY + YMove,
                r: randomCircleRaduis,
                ax: ( Math.random() > 0.5 ? 0.25 : -0.25 ),
                ay: ( Math.random() > 0.5 ? 0.25 : -0.25 ),
                bondariesX: howMuchIcanMoveX,
                bondariesY: howMuchIcanMoveY,

            });



        }



       // requestAnimationFrame( () => this.animate() );

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