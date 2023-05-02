// color scheme provided by the system
const 
    prefersDarkScheme   = window.matchMedia("(prefers-color-scheme: dark)"),
    prefersLightScheme  = window.matchMedia("(prefers-color-scheme: light)");

class ColorScheme {

    /** I used the class name instead of "this" because it may 
     * lead to a conflict when invoking static methods
     */

    static  eventType   =   'evycolorschemechanged';
    static  storageKey  =   'evyColorScheme';
    static  light       =   'light';
    static  dark        =   'dark';
    static  schemeSave       =   ColorScheme.dark;

    // a set of elements to trigger the eventType when the color scheme changes
    static  onChange    =   new Set();

    static get scheme() {

        // if the user overrided the system we'll return the saved scheme
        //  else if the system is running on dark mode
        //  else light

        const { storageKey, light, dark }  =   ColorScheme;

        return ColorScheme.schemeSave || ( prefersDarkScheme.matches ? dark : light ) ; 

    }

    static set scheme( value = ColorScheme.light ) {

        const { storageKey, triggerAll } = ColorScheme
        
        ColorScheme.schemeSave = value;

        triggerAll();

    }

    static toggle() {

        const { scheme, light, dark }    =   ColorScheme;
        
        let altScheme       =   ( scheme === light ? dark : light );
        ColorScheme.scheme  =   altScheme;
    
    }

    static toDark() {

        ColorScheme.scheme  =   ColorScheme.dark;

    }
    static toLight() {

        ColorScheme.scheme  =   ColorScheme.light;

    }

    static systemColorSchemeChanged() {

        const { triggerAll, storageKey }    =   ColorScheme;
        
        // if the system color scheme changed unset the saved value in order to use the defined system scheme 
        
        triggerAll();

    }

    static addElementToTrigger( element ) {

        if( !( element instanceof HTMLElement ) ) { return; }
        
        ColorScheme.onChange.add( element );

    }

    static triggerAll() {

        
        const { onChange, eventType }  =   ColorScheme;

        for( const element of onChange ) {

            element.dispatchEvent( new Event( eventType ) );
 
        }

    }

}


prefersDarkScheme.addEventListener( "change", ColorScheme.systemColorSchemeChanged );
prefersLightScheme.addEventListener( "change", ColorScheme.systemColorSchemeChanged );

export default ColorScheme;