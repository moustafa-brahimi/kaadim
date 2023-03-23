let getClosest = function ( elem, selector ) {

	// Element.matches() polyfill
	if (!Element.prototype.matches) {
		Element.prototype.matches =
			Element.prototype.matchesSelector ||
			Element.prototype.mozMatchesSelector ||
			Element.prototype.msMatchesSelector ||
			Element.prototype.oMatchesSelector ||
			Element.prototype.webkitMatchesSelector ||
			function(s) {
				var matches = (this.document || this.ownerDocument).querySelectorAll(s),
					i = matches.length;
				while (--i >= 0 && matches.item(i) !== this) {}
				return i > -1;
			};
	}

	// Get closest match
	for ( ; elem && elem !== document; elem = elem.parentNode ) {
		if ( elem.matches( selector ) ) return elem;
	}

	return null;

};


function getParents (elem, callback) {

	// Setup variables
	let parents = [];
	let parent = elem.parentNode;
	let index = 0;

	// Make sure callback is valid
	if (typeof callback !== 'function') {
		callback = null;
	}

	// Get matching parent elements
	while (parent && parent !== document) {

		// If using a selector, add matching parents to array
		// Otherwise, add all parents
		if (callback) {
			if (callback(parent, index, elem)) {
				parents.push(parent);
			}
		} else {
			parents.push(parent);
		}

		// Jump to the next parent node
		index++;
		parent = parent.parentNode;

	}

	return parents;

}


let isInViewPort    =   (element) => {

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

let isTouchDevice	=	_ =>  {
    return (('ontouchstart' in window) ||
       (navigator.maxTouchPoints > 0) ||
       (navigator.msMaxTouchPoints > 0));
}

let getRelativeOffset	=	( parent, child ) => {

	if( !( parent && child ) ) { return; }

	if( !( parent instanceof HTMLElement && child instanceof HTMLElement ) ) { return; }

	if( !( parent.getBoundingClientRect && child.getBoundingClientRect ) ) { return; }	

	const 
		{ top: childTop, left: childLeft }		=	child.getBoundingClientRect(),
		{ top: parentTop, left: parentLeft }	=	parent.getBoundingClientRect();

	return {
		top	:	childTop - parentTop,
		left:	childLeft - parentLeft
	}


}

let support = (function () {
	if (!window.DOMParser) return false;
	var parser = new DOMParser();
	try {
		parser.parseFromString('x', 'text/html');
	} catch(err) {
		return false;
	}
	return true;
})();

/**
 * Convert a template string into HTML DOM nodes
 * @param  {String} str The template string
 * @return {Node}       The template HTML
 */
let stringToHTML = (str) => {

	// If DOMParser is supported, use it
	if (support) {
		let parser = new DOMParser();
		let doc = parser.parseFromString(str, 'text/html');
		console.log( doc ); 
		return doc.body;
	}

	// Otherwise, fallback to old-school method
	let dom = document.createElement('div');
	dom.innerHTML = str;
	return dom;

};

export { getClosest, getParents, isInViewPort, isTouchDevice, getRelativeOffset, stringToHTML }