import { randomNumber } from "../functions";

class InstagramIcon {

    centreCircles = [];
    canvas = document.getElementById( "instagram-icon" );

    constructor( canvas = false ) {

        if( canvas ) {

            this.canvas = canvas;
        }

        this.draw();

    }

    animate() {

        const { context, width, height } = this;

        this.context.clearRect( 0, 0, width, height);
        this.context.lineWidth = 2;

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

        context.beginPath();

        let offset1 = 0;
        let offset2 = 0.292 - offset1;
        context.lineWidth = 2;


        context.moveTo( width * offset1, height * offset2 );
        context.arcTo(0, 0, width * offset2, height * offset1, 146 );

        context.lineTo( width * (  1 - offset2 ), height * offset1 );
        context.arcTo(width, 0, width * ( 1 - offset1 ), height * offset2, 146 );

        
        context.lineTo( width * (  1 - offset1 ), height * ( 1 - offset2 ) );
        context.arcTo(width, height, width * ( 1 - offset2 ), height * ( 1 - offset1 ), 146 );

        context.lineTo( width *  offset2, height * ( 1 - offset1 ) );
        context.arcTo(0, height, width * offset1, height * ( 1 - offset2 ), 146 );

        context.closePath();
        context.stroke();

        console.log( ( offset2 - offset1 ) * width );


        requestAnimationFrame( () => this.animate() );

    }

    draw() {

        const { context, width, height } = this;

        const middleCircleMaxRaduis = width * 0.258;
        const middleCircleMinRaduis = width * 0.166;

        context.strokeStyle = "#dddddd";

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
                ax: ( Math.random() > 0.5 ? 0.05 : -0.05 ),
                ay: ( Math.random() > 0.5 ? 0.05 : -0.05 ),
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
                ax: ( Math.random() > 0.5 ? 0.05 : -0.05 ),
                ay: ( Math.random() > 0.5 ? 0.05 : -0.05 ),
                bondaries: howMuchIcanMove,

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

}

export default InstagramIcon;