/*
PIE: CSS3 rendering for IE
Version 1.0beta3
http://css3pie.com
Dual-licensed for use under the Apache License Version 2.0 or the General Public License (GPL) Version 2.
*/
(function(){
var doc = document;var PIE = window['PIE'];

if( !PIE ) {
    PIE = window['PIE'] = {
        CSS_PREFIX: '-pie-',
        STYLE_PREFIX: 'Pie',
        CLASS_PREFIX: 'pie_',
        tableCellTags: {
            'TD': 1,
            'TH': 1
        }
    };

    // Force the background cache to be used. No reason it shouldn't be.
    try {
        doc.execCommand( 'BackgroundImageCache', false, true );
    } catch(e) {}

    /*
     * IE version detection approach by James Padolsey, with modifications -- from
     * http://james.padolsey.com/javascript/detect-ie-in-js-using-conditional-comments/
     */
    PIE.ieVersion = function(){
        var v = 4,
            div = doc.createElement('div'),
            all = div.getElementsByTagName('i');

        while (
            div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
            all[0]
        ) {}

        return v;
    }();

    // Detect IE6
    if( PIE.ieVersion === 6 ) {
        // IE6 can't access properties with leading dash, but can without it.
        PIE.CSS_PREFIX = PIE.CSS_PREFIX.replace( /^-/, '' );
    }

    // Detect IE8
    PIE.ie8DocMode = PIE.ieVersion === 8 && doc.documentMode;
/**
 * Utility functions
 */
PIE.Util = {

    /**
     * To create a VML element, it must be created by a Document which has the VML
     * namespace set. Unfortunately, if you try to add the namespace programatically
     * into the main document, you will get an "Unspecified error" when trying to
     * access document.namespaces before the document is finished loading. To get
     * around this, we create a DocumentFragment, which in IE land is apparently a
     * full-fledged Document. It allows adding namespaces immediately, so we add the
     * namespace there and then have it create the VML element.
     * @param {string} tag The tag name for the VML element
     * @return {Element} The new VML element
     */
    createVmlElement: function( tag ) {
        var vmlPrefix = 'css3vml',
            vmlDoc = PIE._vmlCreatorDoc;
        if( !vmlDoc ) {
            vmlDoc = PIE._vmlCreatorDoc = doc.createDocumentFragment();
            vmlDoc.namespaces.add( vmlPrefix, 'urn:schemas-microsoft-com:vml' );
        }
        return vmlDoc.createElement( vmlPrefix + ':' + tag );
    },


    /**
     * Generate and return a unique ID for a given object. The generated ID is stored
     * as a property of the object for future reuse.
     * @param {Object} obj
     */
    getUID: function( obj ) {
        return obj && obj[ '_pieId' ] || ( obj[ '_pieId' ] = +new Date() + Math.random() );
    },


    /**
     * Simple utility for merging objects
     * @param {Object} obj1 The main object into which all others will be merged
     * @param {...Object} var_args Other objects which will be merged into the first, in order
     */
    merge: function( obj1 ) {
        var i, len, p, objN, args = arguments;
        for( i = 1, len = args.length; i < len; i++ ) {
            objN = args[i];
            for( p in objN ) {
                if( objN.hasOwnProperty( p ) ) {
                    obj1[ p ] = objN[ p ];
                }
            }
        }
        return obj1;
    },


    /**
     * Execute a callback function, passing it the dimensions of a given image once
     * they are known.
     * @param {string} src The source URL of the image
     * @param {function({w:number, h:number})} func The callback function to be called once the image dimensions are known
     * @param {Object} ctx A context object which will be used as the 'this' value within the executed callback function
     */
    withImageSize: function( src, func, ctx ) {
        var sizes = PIE._imgSizes || ( PIE._imgSizes = {} ),
            size = sizes[ src ], img;
        if( size ) {
            func.call( ctx, size );
        } else {
            img = new Image();
            img.onload = function() {
                size = sizes[ src ] = { w: img.width, h: img.height };
                func.call( ctx, size );
                img.onload = null;
            };
            img.src = src;
        }
    }
};/**
 * 
 */
PIE.Observable = function() {
    /**
     * List of registered observer functions
     */
    this.observers = [];

    /**
     * Hash of function ids to their position in the observers list, for fast lookup
     */
    this.indexes = {};
};
PIE.Observable.prototype = {

    observe: function( fn ) {
        var id = PIE.Util.getUID( fn ),
            indexes = this.indexes,
            observers = this.observers;
        if( !( id in indexes ) ) {
            indexes[ id ] = observers.length;
            observers.push( fn );
        }
    },

    unobserve: function( fn ) {
        var id = PIE.Util.getUID( fn ),
            indexes = this.indexes;
        if( id && id in indexes ) {
            delete this.observers[ indexes[ id ] ];
            delete indexes[ id ];
        }
    },

    fire: function() {
        var o = this.observers,
            i = o.length;
        while( i-- ) {
            o[ i ] && o[ i ]();
        }
    }

};/*
 * Set up polling for IE8 - this is a brute-force workaround for syncing issues caused by IE8 not
 * always firing the onmove and onresize events when elements are moved or resized. We check a few
 * times every second to make sure the elements have the correct position and size.
 */

if( PIE.ie8DocMode === 8 ) {
    PIE.Heartbeat = new PIE.Observable();
    setInterval( function() { PIE.Heartbeat.fire() }, 250 );
}
/**
 * Create an observable listener for the onbeforeunload event
 */
PIE.OnBeforeUnload = new PIE.Observable();
window.attachEvent( 'onbeforeunload', function() { PIE.OnBeforeUnload.fire(); } );

/**
 * Attach an event which automatically gets detached onbeforeunload
 */
PIE.OnBeforeUnload.attachManagedEvent = function( target, name, handler ) {
    target.attachEvent( name, handler );
    this.observe( function() {
        target.detachEvent( name, handler );
    } );
};/**
 * Create a single observable listener for window resize events.
 */
(function() {
    PIE.OnResize = new PIE.Observable();

    function resized() {
        PIE.OnResize.fire();
    }

    PIE.OnBeforeUnload.attachManagedEvent( window, 'onresize', resized );
})();
/**
 * Create a single observable listener for scroll events. Used for lazy loading based
 * on the viewport, and for fixed position backgrounds.
 */
(function() {
    PIE.OnScroll = new PIE.Observable();

    function scrolled() {
        PIE.OnScroll.fire();
    }

    PIE.OnBeforeUnload.attachManagedEvent( window, 'onscroll', scrolled );

    PIE.OnResize.observe( scrolled );
})();
/**
 * Listen for printing events, destroy all active PIE instances when printing, and
 * restore them afterward.
 */
(function() {

    var elements;

    function beforePrint() {
        elements = PIE.Element.destroyAll();
    }

    function afterPrint() {
        if( elements ) {
            for( var i = 0, len = elements.length; i < len; i++ ) {
                PIE[ 'attach' ]( elements[i] );
            }
            elements = 0;
        }
    }

    PIE.OnBeforeUnload.attachManagedEvent( window, 'onbeforeprint', beforePrint );
    PIE.OnBeforeUnload.attachManagedEvent( window, 'onafterprint', afterPrint );

})();/**
 * Wrapper for length and percentage style values
 * @constructor
 * @param {string} val The CSS string representing the length. It is assumed that this will already have
 *                 been validated as a valid length or percentage syntax.
 */
PIE.Length = (function() {

    var lengthCalcEl = doc.createElement( 'length-calc' ),
        s = lengthCalcEl.style,
        numCache = {},
        unitCache = {};
    s.position = 'absolute';
    s.top = s.left = -9999;


    function Length( val ) {
        this.val = val;
    }

    Length.prototype = {
        /**
         * Regular expression for matching the length unit
         * @private
         */
        unitRE: /(px|em|ex|mm|cm|in|pt|pc|%)$/,

        /**
         * Get the numeric value of the length
         * @return {number} The value
         */
        getNumber: function() {
            var num = numCache[ this.val ],
                UNDEF;
            if( num === UNDEF ) {
                num = numCache[ this.val ] = parseFloat( this.val );
            }
            return num;
        },

        /**
         * Get the unit of the length
         * @return {string} The unit
         */
        getUnit: function() {
            var unit = unitCache[ this.val ], m;
            if( !unit ) {
                m = this.val.match( this.unitRE );
                unit = unitCache[ this.val ] = ( m && m[0] ) || 'px';
            }
            return unit;
        },

        /**
         * Determine whether this is a percentage length value
         * @return {boolean}
         */
        isPercentage: function() {
            return this.getUnit() === '%';
        },

        /**
         * Resolve this length into a number of pixels.
         * @param {Element} el - the context element, used to resolve font-relative values
         * @param {(function():number|number)=} pct100 - the number of pixels that equal a 100% percentage. This can be either a number or a
         *                  function which will be called to return the number.
         */
        pixels: function( el, pct100 ) {
            var num = this.getNumber(),
                unit = this.getUnit();
            switch( unit ) {
                case "px":
                    return num;
                case "%":
                    return num * ( typeof pct100 === 'function' ? pct100() : pct100 ) / 100;
                case "em":
                    return num * this.getEmPixels( el );
                case "ex":
                    return num * this.getEmPixels( el ) / 2;
                default:
                    return num * Length.conversions[ unit ];
            }
        },

        /**
         * The em and ex units are relative to the font-size of the current element,
         * however if the font-size is set using non-pixel units then we get that value
         * rather than a pixel conversion. To get around this, we keep a floating element
         * with width:1em which we insert into the target element and then read its offsetWidth.
         * But if the font-size *is* specified in pixels, then we use that directly to avoid
         * the expensive DOM manipulation.
         * @param el
         */
        getEmPixels: function( el ) {
            var fs = el.currentStyle.fontSize,
                px;

            if( fs.indexOf( 'px' ) > 0 ) {
                return parseFloat( fs );
            } else {
                lengthCalcEl.style.width = '1em';
                el.appendChild( lengthCalcEl );
                px = lengthCalcEl.offsetWidth;
                if( lengthCalcEl.parentNode !== el ) { //not sure how this happens but it does
                    el.removeChild( lengthCalcEl );
                }
                return px;
            }
        }
    };

    Length.conversions = (function() {
        var units = [ 'mm', 'cm', 'in', 'pt', 'pc' ],
            vals = {},
            parent = doc.documentElement,
            i = units.length, unit;

        parent.appendChild( lengthCalcEl );
        while( i-- ) {
            unit = units[i];
            lengthCalcEl.style.width = '100' + unit;
            vals[ unit ] = lengthCalcEl.offsetWidth / 100;
        }
        parent.removeChild( lengthCalcEl );
        return vals;
    })();

    Length.ZERO = new Length( '0' );

    return Length;
})();
/**
 * Wrapper for a CSS3 bg-position value. Takes up to 2 position keywords and 2 lengths/percentages.
 * @constructor
 * @param {Array.<PIE.Tokenizer.Token>} tokens The tokens making up the background position value.
 */
PIE.BgPosition = (function() {

    var length_fifty = new PIE.Length( '50%' ),
        vert_idents = { 'top': 1, 'center': 1, 'bottom': 1 },
        horiz_idents = { 'left': 1, 'center': 1, 'right': 1 };


    function BgPosition( tokens ) {
        this.tokens = tokens;
    }
    BgPosition.prototype = {
        /**
         * Normalize the values into the form:
         * [ xOffsetSide, xOffsetLength, yOffsetSide, yOffsetLength ]
         * where: xOffsetSide is either 'left' or 'right',
         *        yOffsetSide is either 'top' or 'bottom',
         *        and x/yOffsetLength are both PIE.Length objects.
         * @return {Array}
         */
        getValues: function() {
            if( !this._values ) {
                var tokens = this.tokens,
                    len = tokens.length,
                    identType = PIE.Tokenizer.Type,
                    length_zero = PIE.Length.ZERO,
                    type_ident = identType.IDENT,
                    type_length = identType.LENGTH,
                    type_percent = identType.PERCENT,
                    type, value,
                    vals = [ 'left', length_zero, 'top', length_zero ];

                // If only one value, the second is assumed to be 'center'
                if( len === 1 ) {
                    tokens.push( { type: type_ident, value: 'center' } );
                    len++;
                }

                // Two values - CSS2
                if( len === 2 ) {
                    // If both idents, they can appear in either order, so switch them if needed
                    if( type_ident & ( tokens[0].type | tokens[1].type ) &&
                        tokens[0].value in vert_idents && tokens[1].value in horiz_idents ) {
                        tokens.push( tokens.shift() );
                    }
                    if( tokens[0].type & type_ident ) {
                        if( tokens[0].value === 'center' ) {
                            vals[1] = length_fifty;
                        } else {
                            vals[0] = tokens[0].value;
                        }
                    }
                    else if( tokens[0].isLengthOrPercent() ) {
                        vals[1] = new PIE.Length( tokens[0].value );
                    }
                    if( tokens[1].type & type_ident ) {
                        if( tokens[1].value === 'center' ) {
                            vals[3] = length_fifty;
                        } else {
                            vals[2] = tokens[1].value;
                        }
                    }
                    else if( tokens[1].isLengthOrPercent() ) {
                        vals[3] = new PIE.Length( tokens[1].value );
                    }
                }

                // Three or four values - CSS3
                else {
                    // TODO
                }

                this._values = vals;
            }
            return this._values;
        },

        /**
         * Find the coordinates of the background image from the upper-left corner of the background area.
         * Note that these coordinate values are not rounded.
         * @param {Element} el
         * @param {number} width - the width for percentages (background area width minus image width)
         * @param {number} height - the height for percentages (background area height minus image height)
         * @return {Object} { x: Number, y: Number }
         */
        coords: function( el, width, height ) {
            var vals = this.getValues(),
                pxX = vals[1].pixels( el, width ),
                pxY = vals[3].pixels( el, height );

            return {
                x: vals[0] === 'right' ? width - pxX : pxX,
                y: vals[2] === 'bottom' ? height - pxY : pxY
            };
        }
    };

    return BgPosition;
})();
/**
 * Wrapper for angle values; handles conversion to degrees from all allowed angle units
 * @constructor
 * @param {string} val The raw CSS value for the angle. It is assumed it has been pre-validated.
 */
PIE.Angle = (function() {
    function Angle( val ) {
        this.val = val;
    }
    Angle.prototype = {
        unitRE: /[a-z]+$/i,

        /**
         * @return {string} The unit of the angle value
         */
        getUnit: function() {
            return this._unit || ( this._unit = this.val.match( this.unitRE )[0].toLowerCase() );
        },

        /**
         * Get the numeric value of the angle in degrees.
         * @return {number} The degrees value
         */
        degrees: function() {
            var deg = this._deg, u, n;
            if( deg === undefined ) {
                u = this.getUnit();
                n = parseFloat( this.val, 10 );
                deg = this._deg = ( u === 'deg' ? n : u === 'rad' ? n / Math.PI * 180 : u === 'grad' ? n / 400 * 360 : u === 'turn' ? n * 360 : 0 );
            }
            return deg;
        }
    };

    return Angle;
})();/**
 * Abstraction for colors values. Allows detection of rgba values.
 * @constructor
 * @param {string} val The raw CSS string value for the color
 */
PIE.Color = (function() {
    function Color( val ) {
        this.val = val;
    }

    /**
     * Regular expression for matching rgba colors and extracting their components
     * @type {RegExp}
     */
    Color.rgbaRE = /\s*rgba\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d+|\d*\.\d+)\s*\)\s*/;

    Color.prototype = {
        /**
         * @private
         */
        parse: function() {
            if( !this._color ) {
                var v = this.val,
                    m = v.match( Color.rgbaRE );
                if( m ) {
                    this._color = 'rgb(' + m[1] + ',' + m[2] + ',' + m[3] + ')';
                    this._alpha = parseFloat( m[4] );
                } else {
                    this._color = v;
                    this._alpha = ( v === 'transparent' ? 0 : 1 );
                }
            }
        },

        /**
         * Retrieve the value of the color in a format usable by IE natively. This will be the same as
         * the raw input value, except for rgba values which will be converted to an rgb value.
         * @param {Element} el The context element, used to get 'currentColor' keyword value.
         * @return {string} Color value
         */
        value: function( el ) {
            this.parse();
            return this._color === 'currentColor' ? el.currentStyle.color : this._color;
        },

        /**
         * Retrieve the alpha value of the color. Will be 1 for all values except for rgba values
         * with an alpha component.
         * @return {number} The alpha value, from 0 to 1.
         */
        alpha: function() {
            this.parse();
            return this._alpha;
        }
    };

    return Color;
})();/**
 * A tokenizer for CSS value strings.
 * @constructor
 * @param {string} css The CSS value string
 */
PIE.Tokenizer = (function() {
    function Tokenizer( css ) {
        this.css = css;
        this.ch = 0;
        this.tokens = [];
        this.tokenIndex = 0;
    }

    /**
     * Enumeration of token type constants.
     * @enum {number}
     */
    var Type = Tokenizer.Type = {
        ANGLE: 1,
        CHARACTER: 2,
        COLOR: 4,
        DIMEN: 8,
        FUNCTION: 16,
        IDENT: 32,
        LENGTH: 64,
        NUMBER: 128,
        OPERATOR: 256,
        PERCENT: 512,
        STRING: 1024,
        URL: 2048
    };

    /**
     * A single token
     * @constructor
     * @param {number} type The type of the token - see PIE.Tokenizer.Type
     * @param {string} value The value of the token
     */
    Tokenizer.Token = function( type, value ) {
        this.type = type;
        this.value = value;
    };
    Tokenizer.Token.prototype = {
        isLength: function() {
            return this.type & Type.LENGTH || ( this.type & Type.NUMBER && this.value === '0' );
        },
        isLengthOrPercent: function() {
            return this.isLength() || this.type & Type.PERCENT;
        }
    };

    Tokenizer.prototype = {
        whitespace: /\s/,
        number: /^[\+\-]?(\d*\.)?\d+/,
        url: /^url\(\s*("([^"]*)"|'([^']*)'|([!#$%&*-~]*))\s*\)/i,
        ident: /^\-?[_a-z][\w-]*/i,
        string: /^("([^"]*)"|'([^']*)')/,
        operator: /^[\/,]/,
        hash: /^#[\w]+/,
        hashColor: /^#([\da-f]{6}|[\da-f]{3})/i,

        unitTypes: {
            'px': Type.LENGTH, 'em': Type.LENGTH, 'ex': Type.LENGTH,
            'mm': Type.LENGTH, 'cm': Type.LENGTH, 'in': Type.LENGTH,
            'pt': Type.LENGTH, 'pc': Type.LENGTH,
            'deg': Type.ANGLE, 'rad': Type.ANGLE, 'grad': Type.ANGLE
        },

        colorNames: {
            'aqua':1, 'black':1, 'blue':1, 'fuchsia':1, 'gray':1, 'green':1, 'lime':1, 'maroon':1,
            'navy':1, 'olive':1, 'purple':1, 'red':1, 'silver':1, 'teal':1, 'white':1, 'yellow': 1,
            'currentColor': 1
        },

        colorFunctions: {
            'rgb': 1, 'rgba': 1, 'hsl': 1, 'hsla': 1
        },


        /**
         * Advance to and return the next token in the CSS string. If the end of the CSS string has
         * been reached, null will be returned.
         * @param {boolean} forget - if true, the token will not be stored for the purposes of backtracking with prev().
         * @return {PIE.Tokenizer.Token}
         */
        next: function( forget ) {
            var css, ch, firstChar, match, type, val,
                me = this;

            function newToken( type, value ) {
                var tok = new Tokenizer.Token( type, value );
                if( !forget ) {
                    me.tokens.push( tok );
                    me.tokenIndex++;
                }
                return tok;
            }
            function failure() {
                me.tokenIndex++;
                return null;
            }

            // In case we previously backed up, return the stored token in the next slot
            if( this.tokenIndex < this.tokens.length ) {
                return this.tokens[ this.tokenIndex++ ];
            }

            // Move past leading whitespace characters
            while( this.whitespace.test( this.css.charAt( this.ch ) ) ) {
                this.ch++;
            }
            if( this.ch >= this.css.length ) {
                return failure();
            }

            ch = this.ch;
            css = this.css.substring( this.ch );
            firstChar = css.charAt( 0 );
            switch( firstChar ) {
                case '#':
                    if( match = css.match( this.hashColor ) ) {
                        this.ch += match[0].length;
                        return newToken( Type.COLOR, match[0] );
                    }
                    break;

                case '"':
                case "'":
                    if( match = css.match( this.string ) ) {
                        this.ch += match[0].length;
                        return newToken( Type.STRING, match[2] || match[3] || '' );
                    }
                    break;

                case "../default.htm":
                case ",":
                    this.ch++;
                    return newToken( Type.OPERATOR, firstChar );

                case 'u':
                    if( match = css.match( this.url ) ) {
                        this.ch += match[0].length;
                        return newToken( Type.URL, match[2] || match[3] || match[4] || '' );
                    }
            }

            // Numbers and values starting with numbers
            if( match = css.match( this.number ) ) {
                val = match[0];
                this.ch += val.length;

                // Check if it is followed by a unit
                if( css.charAt( val.length ) === '%' ) {
                    this.ch++;
                    return newToken( Type.PERCENT, val + '%' );
                }
                if( match = css.substring( val.length ).match( this.ident ) ) {
                    val += match[0];
                    this.ch += match[0].length;
                    return newToken( this.unitTypes[ match[0].toLowerCase() ] || Type.DIMEN, val );
                }

                // Plain ol' number
                return newToken( Type.NUMBER, val );
            }

            // Identifiers
            if( match = css.match( this.ident ) ) {
                val = match[0];
                this.ch += val.length;

                // Named colors
                if( val.toLowerCase() in this.colorNames ) {
                    return newToken( Type.COLOR, val );
                }

                // Functions
                if( css.charAt( val.length ) === '(' ) {
                    this.ch++;

                    // Color values in function format: rgb, rgba, hsl, hsla
                    if( val.toLowerCase() in this.colorFunctions ) {
                        function isNum( tok ) {
                            return tok && tok.type & Type.NUMBER;
                        }
                        function isNumOrPct( tok ) {
                            return tok && ( tok.type & ( Type.NUMBER | Type.PERCENT ) );
                        }
                        function isValue( tok, val ) {
                            return tok && tok.value === val;
                        }
                        function next() {
                            return me.next( 1 );
                        }

                        if( ( val.charAt(0) === 'r' ? isNumOrPct( next() ) : isNum( next() ) ) &&
                            isValue( next(), ',' ) &&
                            isNumOrPct( next() ) &&
                            isValue( next(), ',' ) &&
                            isNumOrPct( next() ) &&
                            ( val === 'rgb' || val === 'hsa' || (
                                isValue( next(), ',' ) &&
                                isNum( next() )
                            ) ) &&
                            isValue( next(), ')' ) ) {
                            return newToken( Type.COLOR, this.css.substring( ch, this.ch ) );
                        }
                        return failure();
                    }

                    return newToken( Type.FUNCTION, val + '(' );
                }

                // Other identifier
                return newToken( Type.IDENT, val );
            }

            // Standalone character
            this.ch++;
            return newToken( Type.CHARACTER, firstChar );
        },

        /**
         * Determine whether there is another token
         * @return {boolean}
         */
        hasNext: function() {
            var next = this.next();
            this.prev();
            return !!next;
        },

        /**
         * Back up and return the previous token
         * @return {PIE.Tokenizer.Token}
         */
        prev: function() {
            return this.tokens[ this.tokenIndex-- - 2 ];
        },

        /**
         * Retrieve all the tokens in the CSS string
         * @return {Array.<PIE.Tokenizer.Token>}
         */
        all: function() {
            while( this.next() ) {}
            return this.tokens;
        },

        /**
         * Return a list of tokens from the current position until the given function returns
         * true. The final token will not be included in the list.
         * @param {function():boolean} func - test function
         * @param {boolean} require - if true, then if the end of the CSS string is reached
         *        before the test function returns true, null will be returned instead of the
         *        tokens that have been found so far.
         * @return {Array.<PIE.Tokenizer.Token>}
         */
        until: function( func, require ) {
            var list = [], t, hit;
            while( t = this.next() ) {
                if( func( t ) ) {
                    hit = true;
                    this.prev();
                    break;
                }
                list.push( t );
            }
            return require && !hit ? null : list;
        }
    };

    return Tokenizer;
})();/**
 * Handles calculating, caching, and detecting changes to size and position of the element.
 * @constructor
 * @param {Element} el the target element
 */
PIE.BoundsInfo = function( el ) {
    this.targetElement = el;
};
PIE.BoundsInfo.prototype = {

    _locked: 0,

    positionChanged: function() {
        var last = this._lastBounds,
            bounds;
        return !last || ( ( bounds = this.getBounds() ) && ( last.x !== bounds.x || last.y !== bounds.y ) );
    },

    sizeChanged: function() {
        var last = this._lastBounds,
            bounds;
        return !last || ( ( bounds = this.getBounds() ) && ( last.w !== bounds.w || last.h !== bounds.h ) );
    },

    getLiveBounds: function() {
        var rect = this.targetElement.getBoundingClientRect();
        return {
            x: rect.left,
            y: rect.top,
            w: rect.right - rect.left,
            h: rect.bottom - rect.top
        };
    },

    getBounds: function() {
        return this._locked ? 
                ( this._lockedBounds || ( this._lockedBounds = this.getLiveBounds() ) ) :
                this.getLiveBounds();
    },

    hasBeenQueried: function() {
        return !!this._lastBounds;
    },

    lock: function() {
        ++this._locked;
    },

    unlock: function() {
        if( !--this._locked ) {
            if( this._lockedBounds ) this._lastBounds = this._lockedBounds;
            this._lockedBounds = null;
        }
    }

};
(function() {

function cacheWhenLocked( fn ) {
    var uid = PIE.Util.getUID( fn );
    return function() {
        if( this._locked ) {
            var cache = this._lockedValues || ( this._lockedValues = {} );
            return ( uid in cache ) ? cache[ uid ] : ( cache[ uid ] = fn.call( this ) );
        } else {
            return fn.call( this );
        }
    }
}


PIE.StyleInfoBase = {

    _locked: 0,

    /**
     * Create a new StyleInfo class, with the standard constructor, and augmented by
     * the StyleInfoBase's members.
     * @param proto
     */
    newStyleInfo: function( proto ) {
        function StyleInfo( el ) {
            this.targetElement = el;
        }
        PIE.Util.merge( StyleInfo.prototype, PIE.StyleInfoBase, proto );
        StyleInfo._propsCache = {};
        return StyleInfo;
    },

    /**
     * Get an object representation of the target CSS style, caching it for each unique
     * CSS value string.
     * @return {Object}
     */
    getProps: function() {
        var css = this.getCss(),
            cache = this.constructor._propsCache;
        return css ? ( css in cache ? cache[ css ] : ( cache[ css ] = this.parseCss( css ) ) ) : null;
    },

    /**
     * Get the raw CSS value for the target style
     * @return {string}
     */
    getCss: cacheWhenLocked( function() {
        var el = this.targetElement,
            ctor = this.constructor,
            s = el.style,
            cs = el.currentStyle,
            cssProp = this.cssProperty,
            styleProp = this.styleProperty,
            prefixedCssProp = ctor._prefixedCssProp || ( ctor._prefixedCssProp = PIE.CSS_PREFIX + cssProp ),
            prefixedStyleProp = ctor._prefixedStyleProp || ( ctor._prefixedStyleProp = PIE.STYLE_PREFIX + styleProp.charAt(0).toUpperCase() + styleProp.substring(1) );
        return s[ prefixedStyleProp ] || cs.getAttribute( prefixedCssProp ) || s[ styleProp ] || cs.getAttribute( cssProp );
    } ),

    /**
     * Determine whether the target CSS style is active.
     * @return {boolean}
     */
    isActive: cacheWhenLocked( function() {
        return !!this.getProps();
    } ),

    /**
     * Determine whether the target CSS style has changed since the last time it was used.
     * @return {boolean}
     */
    changed: cacheWhenLocked( function() {
        var currentCss = this.getCss(),
            changed = currentCss !== this._lastCss;
        this._lastCss = currentCss;
        return changed;
    } ),

    cacheWhenLocked: cacheWhenLocked,

    lock: function() {
        ++this._locked;
    },

    unlock: function() {
        if( !--this._locked ) {
            delete this._lockedValues;
        }
    }
};

})();/**
 * Handles parsing, caching, and detecting changes to background (and -pie-background) CSS
 * @constructor
 * @param {Element} el the target element
 */
PIE.BackgroundStyleInfo = PIE.StyleInfoBase.newStyleInfo( {

    cssProperty: PIE.CSS_PREFIX + 'background',
    styleProperty: PIE.STYLE_PREFIX + 'Background',

    attachIdents: { 'scroll':1, 'fixed':1, 'local':1 },
    repeatIdents: { 'repeat-x':1, 'repeat-y':1, 'repeat':1, 'no-repeat':1 },
    originIdents: { 'padding-box':1, 'border-box':1, 'content-box':1 },
    clipIdents: { 'padding-box':1, 'border-box':1 },
    positionIdents: { 'top':1, 'right':1, 'bottom':1, 'left':1, 'center':1 },
    sizeIdents: { 'contain':1, 'cover':1 },

    /**
     * For background styles, we support the -pie-background property but fall back to the standard
     * backround* properties.  The reason we have to use the prefixed version is that IE natively
     * parses the standard properties and if it sees something it doesn't know how to parse, for example
     * multiple values or gradient definitions, it will throw that away and not make it available through
     * currentStyle.
     *
     * Format of return object:
     * {
     *     color: <PIE.Color>,
     *     images: [
     *         {
     *             type: 'image',
     *             url: 'image.png',
     *             repeat: <'no-repeat' | 'repeat-x' | 'repeat-y' | 'repeat'>,
     *             position: <PIE.BgPosition>,
     *             attachment: <'scroll' | 'fixed' | 'local'>,
     *             origin: <'border-box' | 'padding-box' | 'content-box'>,
     *             clip: <'border-box' | 'padding-box'>,
     *             size: <'contain' | 'cover' | { w: <'auto' | PIE.Length>, h: <'auto' | PIE.Length> }>
     *         },
     *         {
     *             type: 'linear-gradient',
     *             gradientStart: <PIE.BgPosition>,
     *             angle: <PIE.Angle>,
     *             stops: [
     *                 { color:%20_5f3cpie.color>, offset: <PIE.Length> },
     *                 { color:%20_5f3cpie.color>, offset: <PIE.Length> }, ...
     *             ]
     *         }
     *     ]
     * }
     * @param {String} css
     * @override
     */
    parseCss: function( css ) {
        var el = this.targetElement,
            cs = el.currentStyle,
            tokenizer, token, image,
            tok_type = PIE.Tokenizer.Type,
            type_operator = tok_type.OPERATOR,
            type_ident = tok_type.IDENT,
            type_color = tok_type.COLOR,
            tokType, tokVal,
            positionIdents = this.positionIdents,
            gradient, stop,
            props = null;

        function isBgPosToken( token ) {
            return token.isLengthOrPercent() || ( token.type & type_ident && token.value in positionIdents );
        }

        function sizeToken( token ) {
            return ( token.isLengthOrPercent() && new PIE.Length( token.value ) ) || ( token.value === 'auto' && 'auto' );
        }

        // If the CSS3-specific -pie-background property is present, parse it
        if( this.getCss3() ) {
            tokenizer = new PIE.Tokenizer( css );
            props = { images: [] };
            image = {};

            while( token = tokenizer.next() ) {
                tokType = token.type;
                tokVal = token.value;

                if( !image.type && tokType & tok_type.FUNCTION && tokVal === 'linear-gradient(' ) {
                    gradient = { stops: [], type: 'linear-gradient' };
                    stop = {};
                    while( token = tokenizer.next() ) {
                        tokType = token.type;
                        tokVal = token.value;

                        // If we reached the end of the function and had at least 2 stops, flush the info
                        if( tokType & tok_type.CHARACTER && tokVal === ')' ) {
                            if( stop.color ) {
                                gradient.stops.push( stop );
                            }
                            if( gradient.stops.length > 1 ) {
                                PIE.Util.merge( image, gradient );
                            }
                            break;
                        }

                        // Color stop - must start with color
                        if( tokType & type_color ) {
                            // if we already have an angle/position, make sure that the previous token was a comma
                            if( gradient.angle || gradient.gradientStart ) {
                                token = tokenizer.prev();
                                if( token.type !== type_operator ) {
                                    break; //fail
                                }
                                tokenizer.next();
                            }

                            stop = {
                                color: new PIE.Color( tokVal )
                            };
                            // check for offset following color
                            token = tokenizer.next();
                            if( token.isLengthOrPercent() ) {
                                stop.offset = new PIE.Length( token.value );
                            } else {
                                tokenizer.prev();
                            }
                        }
                        // Angle - can only appear in first spot
                        else if( tokType & tok_type.ANGLE && !gradient.angle && !stop.color && !gradient.stops.length ) {
                            gradient.angle = new PIE.Angle( token.value );
                        }
                        else if( isBgPosToken( token ) && !gradient.gradientStart && !stop.color && !gradient.stops.length ) {
                            tokenizer.prev();
                            gradient.gradientStart = new PIE.BgPosition(
                                tokenizer.until( function( t ) {
                                    return !isBgPosToken( t );
                                }, false )
                            );
                        }
                        else if( tokType & type_operator && tokVal === ',' ) {
                            if( stop.color ) {
                                gradient.stops.push( stop );
                                stop = {};
                            }
                        }
                        else {
                            // Found something we didn't recognize; fail without adding image
                            break;
                        }
                    }
                }
                else if( !image.type && tokType & tok_type.URL ) {
                    image.url = tokVal;
                    image.type = 'image';
                }
                else if( isBgPosToken( token ) && !image.size ) {
                    tokenizer.prev();
                    image.position = new PIE.BgPosition(
                        tokenizer.until( function( t ) {
                            return !isBgPosToken( t );
                        }, false )
                    );
                }
                else if( tokType & type_ident ) {
                    if( tokVal in this.repeatIdents ) {
                        image.repeat = tokVal;
                    }
                    else if( tokVal in this.originIdents ) {
                        image.origin = tokVal;
                        if( tokVal in this.clipIdents ) {
                            image.clip = tokVal;
                        }
                    }
                    else if( tokVal in this.attachIdents ) {
                        image.attachment = tokVal;
                    }
                }
                else if( tokType & type_color && !props.color ) {
                    props.color = new PIE.Color( tokVal );
                }
                else if( tokType & type_operator ) {
                    // background size
                    if( tokVal === '../default.htm' ) {
                        token = tokenizer.next();
                        tokType = token.type;
                        tokVal = token.value;
                        if( tokType & type_ident && tokVal in this.sizeIdents ) {
                            image.size = tokVal;
                        }
                        else if( tokVal = sizeToken( token ) ) {
                            image.size = {
                                w: tokVal,
                                h: sizeToken( tokenizer.next() ) || ( tokenizer.prev() && tokVal )
                            };
                        }
                    }
                    // new layer
                    else if( tokVal === ',' && image.type ) {
                        props.images.push( image );
                        image = {};
                    }
                }
                else {
                    // Found something unrecognized; chuck everything
                    return null;
                }
            }

            // leftovers
            if( image.type ) {
                props.images.push( image );
            }
        }

        // Otherwise, use the standard background properties; let IE give us the values rather than parsing them
        else {
            this.withActualBg( function() {
                var posX = cs.backgroundPositionX,
                    posY = cs.backgroundPositionY,
                    img = cs.backgroundImage,
                    color = cs.backgroundColor;

                props = {};
                if( color !== 'transparent' ) {
                    props.color = new PIE.Color( color )
                }
                if( img !== 'none' ) {
                    props.images = [ {
                        type: 'image',
                        url: new PIE.Tokenizer( img ).next().value,
                        repeat: cs.backgroundRepeat,
                        position: new PIE.BgPosition( new PIE.Tokenizer( posX + ' ' + posY ).all() )
                    } ];
                }
            } );
        }

        return ( props && ( props.color || ( props.images && props.images[0] ) ) ) ? props : null;
    },

    /**
     * Execute a function with the actual background styles (not overridden with runtimeStyle
     * properties set by the renderers) available via currentStyle.
     * @param fn
     */
    withActualBg: function( fn ) {
        var rs = this.targetElement.runtimeStyle,
            rsImage = rs.backgroundImage,
            rsColor = rs.backgroundColor,
            ret;

        if( rsImage ) rs.backgroundImage = '';
        if( rsColor ) rs.backgroundColor = '';

        ret = fn.call( this );

        if( rsImage ) rs.backgroundImage = rsImage;
        if( rsColor ) rs.backgroundColor = rsColor;

        return ret;
    },

    getCss: PIE.StyleInfoBase.cacheWhenLocked( function() {
        return this.getCss3() ||
               this.withActualBg( function() {
                   var cs = this.targetElement.currentStyle;
                   return cs.backgroundColor + ' ' + cs.backgroundImage + ' ' + cs.backgroundRepeat + ' ' +
                   cs.backgroundPositionX + ' ' + cs.backgroundPositionY;
               } );
    } ),

    getCss3: PIE.StyleInfoBase.cacheWhenLocked( function() {
        var el = this.targetElement;
        return el.style[ this.styleProperty ] || el.currentStyle.getAttribute( this.cssProperty );
    } ),

    /**
     * Tests if style.PiePngFix or the -pie-png-fix property is set to true in IE6.
     */
    isPngFix: function() {
        var val = 0, el;
        if( PIE.ieVersion < 7 ) {
            el = this.targetElement;
            val = ( '' + ( el.style[ PIE.STYLE_PREFIX + 'PngFix' ] || el.currentStyle.getAttribute( PIE.CSS_PREFIX + 'png-fix' ) ) === 'true' );
        }
        return val;
    },
    
    /**
     * The isActive logic is slightly different, because getProps() always returns an object
     * even if it is just falling back to the native background properties.  But we only want
     * to report is as being "active" if either the -pie-background override property is present
     * and parses successfully or '-pie-png-fix' is set to true in IE6.
     */
    isActive: PIE.StyleInfoBase.cacheWhenLocked( function() {
        return (this.getCss3() || this.isPngFix()) && !!this.getProps();
    } )

} );/**
 * Handles parsing, caching, and detecting changes to border CSS
 * @constructor
 * @param {Element} el the target element
 */
PIE.BorderStyleInfo = PIE.StyleInfoBase.newStyleInfo( {

    sides: [ 'Top', 'Right', 'Bottom', 'Left' ],
    namedWidths: {
        thin: '1px',
        medium: '3px',
        thick: '5px'
    },

    parseCss: function( css ) {
        var w = {},
            s = {},
            c = {},
            active = false,
            colorsSame = true,
            stylesSame = true,
            widthsSame = true;

        this.withActualBorder( function() {
            var el = this.targetElement,
                cs = el.currentStyle,
                i = 0,
                style, color, width, lastStyle, lastColor, lastWidth, side, ltr;
            for( ; i < 4; i++ ) {
                side = this.sides[ i ];

                ltr = side.charAt(0).toLowerCase();
                style = s[ ltr ] = cs[ 'border' + side + 'Style' ];
                color = cs[ 'border' + side + 'Color' ];
                width = cs[ 'border' + side + 'Width' ];

                if( i > 0 ) {
                    if( style !== lastStyle ) { stylesSame = false; }
                    if( color !== lastColor ) { colorsSame = false; }
                    if( width !== lastWidth ) { widthsSame = false; }
                }
                lastStyle = style;
                lastColor = color;
                lastWidth = width;

                c[ ltr ] = new PIE.Color( color );

                width = w[ ltr ] = new PIE.Length( s[ ltr ] === 'none' ? '0' : ( this.namedWidths[ width ] || width ) );
                if( width.pixels( this.targetElement ) > 0 ) {
                    active = true;
                }
            }
        } );

        return active ? {
            widths: w,
            styles: s,
            colors: c,
            widthsSame: widthsSame,
            colorsSame: colorsSame,
            stylesSame: stylesSame
        } : null;
    },

    getCss: PIE.StyleInfoBase.cacheWhenLocked( function() {
        var el = this.targetElement,
            cs = el.currentStyle,
            css;

        // Don't redraw or hide borders for cells in border-collapse:collapse tables
        if( !( el.tagName in PIE.tableCellTags && el.offsetParent.currentStyle.borderCollapse === 'collapse' ) ) {
            this.withActualBorder( function() {
                css = cs.borderWidth + '|' + cs.borderStyle + '|' + cs.borderColor;
            } );
        }
        return css;
    } ),

    /**
     * Execute a function with the actual border styles (not overridden with runtimeStyle
     * properties set by the renderers) available via currentStyle.
     * @param fn
     */
    withActualBorder: function( fn ) {
        var rs = this.targetElement.runtimeStyle,
            rsWidth = rs.borderWidth,
            rsColor = rs.borderColor,
            ret;

        if( rsWidth ) rs.borderWidth = '';
        if( rsColor ) rs.borderColor = '';

        ret = fn.call( this );

        if( rsWidth ) rs.borderWidth = rsWidth;
        if( rsColor ) rs.borderColor = rsColor;

        return ret;
    }

} );
/**
 * Handles parsing, caching, and detecting changes to border-radius CSS
 * @constructor
 * @param {Element} el the target element
 */
(function() {

PIE.BorderRadiusStyleInfo = PIE.StyleInfoBase.newStyleInfo( {

    cssProperty: 'border-radius',
    styleProperty: 'borderRadius',

    parseCss: function( css ) {
        var p = null, x, y,
            tokenizer, token, length,
            hasNonZero = false;

        function newLength( v ) {
            return new PIE.Length( v );
        }

        if( css ) {
            tokenizer = new PIE.Tokenizer( css );

            function collectLengths() {
                var arr = [], num;
                while( ( token = tokenizer.next() ) && token.isLengthOrPercent() ) {
                    length = newLength( token.value );
                    num = length.getNumber();
                    if( num < 0 ) {
                        return null;
                    }
                    if( num > 0 ) {
                        hasNonZero = true;
                    }
                    arr.push( length );
                }
                return arr.length > 0 && arr.length < 5 ? {
                        'tl': arr[0],
                        'tr': arr[1] || arr[0],
                        'br': arr[2] || arr[0],
                        'bl': arr[3] || arr[1] || arr[0]
                    } : null;
            }

            // Grab the initial sequence of lengths
            if( x = collectLengths() ) {
                // See if there is a slash followed by more lengths, for the y-axis radii
                if( token ) {
                    if( token.type & PIE.Tokenizer.Type.OPERATOR && token.value === '../default.htm' ) {
                        y = collectLengths();
                    }
                } else {
                    y = x;
                }

                // Treat all-zero values the same as no value
                if( hasNonZero && x && y ) {
                    p = { x: x, y : y };
                }
            }
        }

        return p;
    }
} );

var ZERO = PIE.Length.ZERO,
    zeros = { 'tl': ZERO, 'tr': ZERO, 'br': ZERO, 'bl': ZERO };
PIE.BorderRadiusStyleInfo.ALL_ZERO = { x: zeros, y: zeros };

})();/**
 * Handles parsing, caching, and detecting changes to border-image CSS
 * @constructor
 * @param {Element} el the target element
 */
PIE.BorderImageStyleInfo = PIE.StyleInfoBase.newStyleInfo( {

    cssProperty: 'border-image',
    styleProperty: 'borderImage',

    repeatIdents: { 'stretch':1, 'round':1, 'repeat':1, 'space':1 },

    parseCss: function( css ) {
        var p = null, tokenizer, token, type, value,
            slices, widths, outsets,
            slashCount = 0, cs,
            Type = PIE.Tokenizer.Type,
            IDENT = Type.IDENT,
            NUMBER = Type.NUMBER,
            LENGTH = Type.LENGTH,
            PERCENT = Type.PERCENT;

        if( css ) {
            tokenizer = new PIE.Tokenizer( css );
            p = {};

            function isSlash( token ) {
                return token && ( token.type & Type.OPERATOR ) && ( token.value === '../default.htm' );
            }

            function isFillIdent( token ) {
                return token && ( token.type & IDENT ) && ( token.value === 'fill' );
            }

            function collectSlicesEtc() {
                slices = tokenizer.until( function( tok ) {
                    return !( tok.type & ( NUMBER | PERCENT ) );
                } );

                if( isFillIdent( tokenizer.next() ) && !p.fill ) {
                    p.fill = true;
                } else {
                    tokenizer.prev();
                }

                if( isSlash( tokenizer.next() ) ) {
                    slashCount++;
                    widths = tokenizer.until( function( tok ) {
                        return !( token.type & ( NUMBER | PERCENT | LENGTH ) ) && !( ( token.type & IDENT ) && token.value === 'auto' );
                    } );

                    if( isSlash( tokenizer.next() ) ) {
                        slashCount++;
                        outsets = tokenizer.until( function( tok ) {
                            return !( token.type & ( NUMBER | LENGTH ) );
                        } );
                    }
                } else {
                    tokenizer.prev();
                }
            }

            while( token = tokenizer.next() ) {
                type = token.type;
                value = token.value;

                // Numbers and/or 'fill' keyword: slice values. May be followed optionally by width values, followed optionally by outset values
                if( type & ( NUMBER | PERCENT ) && !slices ) {
                    tokenizer.prev();
                    collectSlicesEtc();
                }
                else if( isFillIdent( token ) && !p.fill ) {
                    p.fill = true;
                    collectSlicesEtc();
                }

                // Idents: one or values for 'repeat'
                else if( ( type & IDENT ) && this.repeatIdents[value] && !p.repeat ) {
                    p.repeat = { h: value };
                    if( token = tokenizer.next() ) {
                        if( ( token.type & IDENT ) && this.repeatIdents[token.value] ) {
                            p.repeat.v = token.value;
                        } else {
                            tokenizer.prev();
                        }
                    }
                }

                // URL of the image
                else if( ( type & Type.URL ) && !p.src ) {
                    p.src =  value;
                }

                // Found something unrecognized; exit.
                else {
                    return null;
                }
            }

            // Validate what we collected
            if( !p.src || !slices || slices.length < 1 || slices.length > 4 ||
                ( widths && widths.length > 4 ) || ( slashCount === 1 && widths.length < 1 ) ||
                ( outsets && outsets.length > 4 ) || ( slashCount === 2 && outsets.length < 1 ) ) {
                return null;
            }

            // Fill in missing values
            if( !p.repeat ) {
                p.repeat = { h: 'stretch' };
            }
            if( !p.repeat.v ) {
                p.repeat.v = p.repeat.h;
            }

            function distributeSides( tokens, convertFn ) {
                return {
                    t: convertFn( tokens[0] ),
                    r: convertFn( tokens[1] || tokens[0] ),
                    b: convertFn( tokens[2] || tokens[0] ),
                    l: convertFn( tokens[3] || tokens[1] || tokens[0] )
                };
            }

            p.slice = distributeSides( slices, function( tok ) {
                return new PIE.Length( ( tok.type & NUMBER ) ? tok.value + 'px' : tok.value );
            } );

            p.width = widths && widths.length > 0 ?
                    distributeSides( widths, function( tok ) {
                        return tok.type & ( LENGTH | PERCENT ) ? new PIE.Length( tok.value ) : tok.value;
                    } ) :
                    ( cs = this.targetElement.currentStyle ) && {
                        t: new PIE.Length( cs.borderTopWidth ),
                        r: new PIE.Length( cs.borderRightWidth ),
                        b: new PIE.Length( cs.borderBottomWidth ),
                        l: new PIE.Length( cs.borderLeftWidth )
                    };

            p.outset = distributeSides( outsets || [ 0 ], function( tok ) {
                return tok.type & LENGTH ? new PIE.Length( tok.value ) : tok.value;
            } );
        }

        return p;
    }
} );/**
 * Handles parsing, caching, and detecting changes to box-shadow CSS
 * @constructor
 * @param {Element} el the target element
 */
PIE.BoxShadowStyleInfo = PIE.StyleInfoBase.newStyleInfo( {

    cssProperty: 'box-shadow',
    styleProperty: 'boxShadow',

    parseCss: function( css ) {
        var props,
            Length = PIE.Length,
            Type = PIE.Tokenizer.Type,
            tokenizer;

        if( css ) {
            tokenizer = new PIE.Tokenizer( css );
            props = { outset: [], inset: [] };

            function parseItem() {
                var token, type, value, color, lengths, inset, len;

                while( token = tokenizer.next() ) {
                    value = token.value;
                    type = token.type;

                    if( type & Type.OPERATOR && value === ',' ) {
                        break;
                    }
                    else if( token.isLength() && !lengths ) {
                        tokenizer.prev();
                        lengths = tokenizer.until( function( token ) {
                            return !token.isLength();
                        } );
                    }
                    else if( type & Type.COLOR && !color ) {
                        color = value;
                    }
                    else if( type & Type.IDENT && value === 'inset' && !inset ) {
                        inset = true;
                    }
                    else { //encountered an unrecognized token; fail.
                        return false;
                    }
                }

                len = lengths && lengths.length;
                if( len > 1 && len < 5 ) {
                    ( inset ? props.inset : props.outset ).push( {
                        xOffset: new Length( lengths[0].value ),
                        yOffset: new Length( lengths[1].value ),
                        blur: new Length( lengths[2] ? lengths[2].value : '0' ),
                        spread: new Length( lengths[3] ? lengths[3].value : '0' ),
                        color: new PIE.Color( color || 'currentColor' )
                    } );
                    return true;
                }
                return false;
            }

            while( parseItem() ) {}
        }

        return props && ( props.inset.length || props.outset.length ) ? props : null;
    }
} );
/**
 * Retrieves the state of the element's visibility and display
 * @constructor
 * @param {Element} el the target element
 */
PIE.VisibilityStyleInfo = PIE.StyleInfoBase.newStyleInfo( {

    getCss: PIE.StyleInfoBase.cacheWhenLocked( function() {
        var cs = this.targetElement.currentStyle;
        return cs.visibility + '|' + cs.display;
    } ),

    parseCss: function() {
        var el = this.targetElement,
            rs = el.runtimeStyle,
            cs = el.currentStyle,
            rsVis = rs.visibility,
            csVis;

        rs.visibility = '';
        csVis = cs.visibility;
        rs.visibility = rsVis;

        return {
            visible: csVis !== 'hidden',
            displayed: cs.display !== 'none'
        }
    },

    /**
     * Always return false for isActive, since this property alone will not trigger
     * a renderer to do anything.
     */
    isActive: function() {
        return false;
    }

} );
PIE.RendererBase = {

    /**
     * Create a new Renderer class, with the standard constructor, and augmented by
     * the RendererBase's members.
     * @param proto
     */
    newRenderer: function( proto ) {
        function Renderer( el, boundsInfo, styleInfos, parent ) {
            this.targetElement = el;
            this.boundsInfo = boundsInfo;
            this.styleInfos = styleInfos;
            this.parent = parent;
        }
        PIE.Util.merge( Renderer.prototype, PIE.RendererBase, proto );
        return Renderer;
    },

    /**
     * Flag indicating the element has already been positioned at least once.
     * @type {boolean}
     */
    isPositioned: false,

    /**
     * Determine if the renderer needs to be updated
     * @return {boolean}
     */
    needsUpdate: function() {
        return false;
    },

    /**
     * Tell the renderer to update based on modified properties
     */
    updateProps: function() {
        this.destroy();
        if( this.isActive() ) {
            this.draw();
        }
    },

    /**
     * Tell the renderer to update based on modified element position
     */
    updatePos: function() {
        this.isPositioned = true;
    },

    /**
     * Tell the renderer to update based on modified element dimensions
     */
    updateSize: function() {
        if( this.isActive() ) {
            this.draw();
        } else {
            this.destroy();
        }
    },


    /**
     * Add a layer element, with the given z-order index, to the renderer's main box element. We can't use
     * z-index because that breaks when the root rendering box's z-index is 'auto' in IE8+ standards mode.
     * So instead we make sure they are inserted into the DOM in the correct order.
     * @param {number} index
     * @param {Element} el
     */
    addLayer: function( index, el ) {
        this.removeLayer( index );
        for( var layers = this._layers || ( this._layers = [] ), i = index + 1, len = layers.length, layer; i < len; i++ ) {
            layer = layers[i];
            if( layer ) {
                break;
            }
        }
        layers[index] = el;
        this.getBox().insertBefore( el, layer || null );
    },

    /**
     * Retrieve a layer element by its index, or null if not present
     * @param {number} index
     * @return {Element}
     */
    getLayer: function( index ) {
        var layers = this._layers;
        return layers && layers[index] || null;
    },

    /**
     * Remove a layer element by its index
     * @param {number} index
     */
    removeLayer: function( index ) {
        var layer = this.getLayer( index ),
            box = this._box;
        if( layer && box ) {
            box.removeChild( layer );
            this._layers[index] = null;
        }
    },


    /**
     * Get a VML shape by name, creating it if necessary.
     * @param {string} name A name identifying the element
     * @param {string=} subElName If specified a subelement of the shape will be created with this tag name
     * @param {Element} parent The parent element for the shape; will be ignored if 'group' is specified
     * @param {number=} group If specified, an ordinal group for the shape. 1 or greater. Groups are rendered
     *                  using container elements in the correct order, to get correct z stacking without z-index.
     */
    getShape: function( name, subElName, parent, group ) {
        var shapes = this._shapes || ( this._shapes = {} ),
            shape = shapes[ name ],
            s;

        if( !shape ) {
            shape = shapes[ name ] = PIE.Util.createVmlElement( 'shape' );
            if( subElName ) {
                shape.appendChild( shape[ subElName ] = PIE.Util.createVmlElement( subElName ) );
            }

            if( group ) {
                parent = this.getLayer( group );
                if( !parent ) {
                    this.addLayer( group, doc.createElement( 'group' + group ) );
                    parent = this.getLayer( group );
                }
            }

            parent.appendChild( shape );

            s = shape.style;
            s.position = 'absolute';
            s.left = s.top = 0;
            s['behavior'] = 'url(#default#VML)';
        }
        return shape;
    },

    /**
     * Delete a named shape which was created by getShape(). Returns true if a shape with the
     * given name was found and deleted, or false if there was no shape of that name.
     * @param {string} name
     * @return {boolean}
     */
    deleteShape: function( name ) {
        var shapes = this._shapes,
            shape = shapes && shapes[ name ];
        if( shape ) {
            shape.parentNode.removeChild( shape );
            delete shapes[ name ];
        }
        return !!shape;
    },


    /**
     * For a given set of border radius length/percentage values, convert them to concrete pixel
     * values based on the current size of the target element.
     * @param {Object} radii
     * @return {Object}
     */
    getRadiiPixels: function( radii ) {
        var el = this.targetElement,
            bounds = this.boundsInfo.getBounds(),
            w = bounds.w,
            h = bounds.h,
            tlX, tlY, trX, trY, brX, brY, blX, blY, f;

        tlX = radii.x['tl'].pixels( el, w );
        tlY = radii.y['tl'].pixels( el, h );
        trX = radii.x['tr'].pixels( el, w );
        trY = radii.y['tr'].pixels( el, h );
        brX = radii.x['br'].pixels( el, w );
        brY = radii.y['br'].pixels( el, h );
        blX = radii.x['bl'].pixels( el, w );
        blY = radii.y['bl'].pixels( el, h );

        // If any corner ellipses overlap, reduce them all by the appropriate factor. This formula
        // is taken straight from the CSS3 Backgrounds and Borders spec.
        f = Math.min(
            w / ( tlX + trX ),
            h / ( trY + brY ),
            w / ( blX + brX ),
            h / ( tlY + blY )
        );
        if( f < 1 ) {
            tlX *= f;
            tlY *= f;
            trX *= f;
            trY *= f;
            brX *= f;
            brY *= f;
            blX *= f;
            blY *= f;
        }

        return {
            x: {
                'tl': tlX,
                'tr': trX,
                'br': brX,
                'bl': blX
            },
            y: {
                'tl': tlY,
                'tr': trY,
                'br': brY,
                'bl': blY
            }
        }
    },

    /**
     * Return the VML path string for the element's background box, with corners rounded.
     * @param {Object.<{t:number, r:number, b:number, l:number}>} shrink - if present, specifies number of
     *        pixels to shrink the box path inward from the element's four sides.
     * @param {number=} mult If specified, all coordinates will be multiplied by this number
     * @param {Object=} radii If specified, this will be used for the corner radii instead of the properties
     *        from this renderer's borderRadiusInfo object.
     * @return {string} the VML path
     */
    getBoxPath: function( shrink, mult, radii ) {
        mult = mult || 1;

        var r, str,
            bounds = this.boundsInfo.getBounds(),
            w = bounds.w * mult,
            h = bounds.h * mult,
            radInfo = this.styleInfos.borderRadiusInfo,
            floor = Math.floor, ceil = Math.ceil,
            shrinkT = shrink ? shrink.t * mult : 0,
            shrinkR = shrink ? shrink.r * mult : 0,
            shrinkB = shrink ? shrink.b * mult : 0,
            shrinkL = shrink ? shrink.l * mult : 0,
            tlX, tlY, trX, trY, brX, brY, blX, blY;

        if( radii || radInfo.isActive() ) {
            r = this.getRadiiPixels( radii || radInfo.getProps() );

            tlX = r.x['tl'] * mult;
            tlY = r.y['tl'] * mult;
            trX = r.x['tr'] * mult;
            trY = r.y['tr'] * mult;
            brX = r.x['br'] * mult;
            brY = r.y['br'] * mult;
            blX = r.x['bl'] * mult;
            blY = r.y['bl'] * mult;

            str = 'm' + floor( shrinkL ) + ',' + floor( tlY ) +
                'qy' + floor( tlX ) + ',' + floor( shrinkT ) +
                'l' + ceil( w - trX ) + ',' + floor( shrinkT ) +
                'qx' + ceil( w - shrinkR ) + ',' + floor( trY ) +
                'l' + ceil( w - shrinkR ) + ',' + ceil( h - brY ) +
                'qy' + ceil( w - brX ) + ',' + ceil( h - shrinkB ) +
                'l' + floor( blX ) + ',' + ceil( h - shrinkB ) +
                'qx' + floor( shrinkL ) + ',' + ceil( h - blY ) + ' x e';
        } else {
            // simplified path for non-rounded box
            str = 'm' + floor( shrinkL ) + ',' + floor( shrinkT ) +
                  'l' + ceil( w - shrinkR ) + ',' + floor( shrinkT ) +
                  'l' + ceil( w - shrinkR ) + ',' + ceil( h - shrinkB ) +
                  'l' + floor( shrinkL ) + ',' + ceil( h - shrinkB ) +
                  'xe';
        }
        return str;
    },


    /**
     * Get the container element for the shapes, creating it if necessary.
     */
    getBox: function() {
        var box = this.parent.getLayer( this.boxZIndex ), s;

        if( !box ) {
            box = doc.createElement( this.boxName );
            s = box.style;
            s.position = 'absolute';
            s.top = s.left = 0;
            this.parent.addLayer( this.boxZIndex, box );
        }

        return box;
    },


    /**
     * Destroy the rendered objects. This is a base implementation which handles common renderer
     * structures, but individual renderers may override as necessary.
     */
    destroy: function() {
        this.parent.removeLayer( this.boxZIndex );
        delete this._shapes;
        delete this._layers;
    }
};
/**
 * Root renderer; creates the outermost container element and handles keeping it aligned
 * with the target element's size and position.
 * @param {Element} el The target element
 * @param {Object} styleInfos The StyleInfo objects
 */
PIE.RootRenderer = PIE.RendererBase.newRenderer( {

    isActive: function() {
        var children = this.childRenderers;
        for( var i in children ) {
            if( children.hasOwnProperty( i ) && children[ i ].isActive() ) {
                return true;
            }
        }
        return false;
    },

    needsUpdate: function() {
        return this.styleInfos.visibilityInfo.changed();
    },

    updatePos: function() {
        if( this.isActive() ) {
            var el = this.getPositioningElement(),
                par = el,
                docEl,
                parRect,
                tgtCS = el.currentStyle,
                tgtPos = tgtCS.position,
                boxPos,
                s = this.getBox().style, cs,
                x = 0, y = 0,
                elBounds = this.boundsInfo.getBounds();

            if( tgtPos === 'fixed' && PIE.ieVersion > 6) {
                if (PIE.ieVersion > 7) {
                    x = elBounds.x;
                    y = elBounds.y;
                } else {
                    x = elBounds.x-2;
                    y = elBounds.y-2;
                }
                boxPos = tgtPos;
            } else {
                // Get the element's offsets from its nearest positioned ancestor. Uses
                // getBoundingClientRect for accuracy and speed.
                do {
                    par = par.offsetParent;
                } while( par && ( par.currentStyle.position === 'static' ) );
                if( par ) {
                    parRect = par.getBoundingClientRect();
                    cs = par.currentStyle;
                    x = elBounds.x - parRect.left - ( parseFloat(cs.borderLeftWidth) || 0 );
                    y = elBounds.y - parRect.top - ( parseFloat(cs.borderTopWidth) || 0 );
                } else {
                    docEl = doc.documentElement;
                    x = elBounds.x + docEl.scrollLeft - docEl.clientLeft;
                    y = elBounds.y + docEl.scrollTop - docEl.clientTop;
                }
                boxPos = 'absolute';
            }

            s.position = boxPos;
            s.left = x;
            s.top = y;
            s.zIndex = tgtPos === 'static' ? -1 : tgtCS.zIndex;
            this.isPositioned = true;
        }
    },

    updateSize: function() {
        // NO-OP
    },

    updateVisibility: function() {
        var vis = this.styleInfos.visibilityInfo.getProps();
        this.getBox().style.display = ( vis.visible && vis.displayed ) ? '' : 'none';
    },

    updateProps: function() {
        if( this.isActive() ) {
            this.updateVisibility();
        } else {
            this.destroy();
        }
    },

    getPositioningElement: function() {
        var el = this.targetElement;
        return el.tagName in PIE.tableCellTags ? el.offsetParent : el;
    },

    getBox: function() {
        var box = this._box, el;
        if( !box ) {
            el = this.getPositioningElement();
            box = this._box = doc.createElement( 'css3-container' );

            this.updateVisibility();

            el.parentNode.insertBefore( box, el );
        }
        return box;
    },

    destroy: function() {
        var box = this._box, par;
        if( box && ( par = box.parentNode ) ) {
            par.removeChild( box );
        }
        delete this._box;
        delete this._layers;
    }

} );
/**
 * Renderer for element backgrounds.
 * @constructor
 * @param {Element} el The target element
 * @param {Object} styleInfos The StyleInfo objects
 * @param {PIE.RootRenderer} parent
 */
PIE.BackgroundRenderer = PIE.RendererBase.newRenderer( {

    boxZIndex: 2,
    boxName: 'background',

    needsUpdate: function() {
        var si = this.styleInfos;
        return si.backgroundInfo.changed() || si.borderRadiusInfo.changed();
    },

    isActive: function() {
        var si = this.styleInfos;
        return si.borderImageInfo.isActive() ||
               si.borderRadiusInfo.isActive() ||
               si.backgroundInfo.isActive() ||
               ( si.boxShadowInfo.isActive() && si.boxShadowInfo.getProps().inset );
    },

    /**
     * Draw the shapes
     */
    draw: function() {
        var bounds = this.boundsInfo.getBounds();
        if( bounds.w && bounds.h ) {
            this.drawBgColor();
            this.drawBgImages();
        }
    },

    /**
     * Draw the background color shape
     */
    drawBgColor: function() {
        var props = this.styleInfos.backgroundInfo.getProps(),
            bounds = this.boundsInfo.getBounds(),
            el = this.targetElement,
            color = props && props.color,
            shape, w, h, s, alpha;

        if( color && color.alpha() > 0 ) {
            this.hideBackground();

            shape = this.getShape( 'bgColor', 'fill', this.getBox(), 1 );
            w = bounds.w;
            h = bounds.h;
            shape.stroked = false;
            shape.coordsize = w * 2 + ',' + h * 2;
            shape.coordorigin = '1,1';
            shape.path = this.getBoxPath( null, 2 );
            s = shape.style;
            s.width = w;
            s.height = h;
            shape.fill.color = color.value( el );

            alpha = color.alpha();
            if( alpha < 1 ) {
                shape.fill.opacity = alpha;
            }
        } else {
            this.deleteShape( 'bgColor' );
        }
    },

    /**
     * Draw all the background image layers
     */
    drawBgImages: function() {
        var props = this.styleInfos.backgroundInfo.getProps(),
            bounds = this.boundsInfo.getBounds(),
            images = props && props.images,
            img, shape, w, h, s, i;

        if( images ) {
            this.hideBackground();

            w = bounds.w;
            h = bounds.h;

            i = images.length;
            while( i-- ) {
                img = images[i];
                shape = this.getShape( 'bgImage' + i, 'fill', this.getBox(), 2 );

                shape.stroked = false;
                shape.fill.type = 'tile';
                shape.fillcolor = 'none';
                shape.coordsize = w * 2 + ',' + h * 2;
                shape.coordorigin = '1,1';
                shape.path = this.getBoxPath( 0, 2 );
                s = shape.style;
                s.width = w;
                s.height = h;

                if( img.type === 'linear-gradient' ) {
                    this.addLinearGradient( shape, img );
                }
                else {
                    shape.fill.src = img.url;
                    this.positionBgImage( shape, i );
                }
            }
        }

        // Delete any bgImage shapes previously created which weren't used above
        i = images ? images.length : 0;
        while( this.deleteShape( 'bgImage' + i++ ) ) {}
    },


    /**
     * Set the position and clipping of the background image for a layer
     * @param {Element} shape
     * @param {number} index
     */
    positionBgImage: function( shape, index ) {
        PIE.Util.withImageSize( shape.fill.src, function( size ) {
            var fill = shape.fill,
                el = this.targetElement,
                bounds = this.boundsInfo.getBounds(),
                elW = bounds.w,
                elH = bounds.h,
                si = this.styleInfos,
                border = si.borderInfo.getProps(),
                bw = border && border.widths,
                bwT = bw ? bw['t'].pixels( el ) : 0,
                bwR = bw ? bw['r'].pixels( el ) : 0,
                bwB = bw ? bw['b'].pixels( el ) : 0,
                bwL = bw ? bw['l'].pixels( el ) : 0,
                bg = si.backgroundInfo.getProps().images[ index ],
                bgPos = bg.position ? bg.position.coords( el, elW - size.w - bwL - bwR, elH - size.h - bwT - bwB ) : { x:0, y:0 },
                repeat = bg.repeat,
                pxX, pxY,
                clipT = 0, clipL = 0,
                clipR = elW + 1, clipB = elH + 1, //make sure the default clip region is not inside the box (by a subpixel)
                clipAdjust = PIE.ieVersion === 8 ? 0 : 1; //prior to IE8 requires 1 extra pixel in the image clip region

            // Positioning - find the pixel offset from the top/left and convert to a ratio
            // The position is shifted by half a pixel, to adjust for the half-pixel coordorigin shift which is
            // needed to fix antialiasing but makes the bg image fuzzy.
            pxX = Math.round( bgPos.x ) + bwL + 0.5;
            pxY = Math.round( bgPos.y ) + bwT + 0.5;
            fill.position = ( pxX / elW ) + ',' + ( pxY / elH );

            // Repeating - clip the image shape
            if( repeat && repeat !== 'repeat' ) {
                if( repeat === 'repeat-x' || repeat === 'no-repeat' ) {
                    clipT = pxY + 1;
                    clipB = pxY + size.h + clipAdjust;
                }
                if( repeat === 'repeat-y' || repeat === 'no-repeat' ) {
                    clipL = pxX + 1;
                    clipR = pxX + size.w + clipAdjust;
                }
                shape.style.clip = 'rect(' + clipT + 'px,' + clipR + 'px,' + clipB + 'px,' + clipL + 'px)';
            }
        }, this );
    },


    /**
     * Draw the linear gradient for a gradient layer
     * @param {Element} shape
     * @param {Object} info The object holding the information about the gradient
     */
    addLinearGradient: function( shape, info ) {
        var el = this.targetElement,
            bounds = this.boundsInfo.getBounds(),
            w = bounds.w,
            h = bounds.h,
            fill = shape.fill,
            angle = info.angle,
            startPos = info.gradientStart,
            stops = info.stops,
            stopCount = stops.length,
            PI = Math.PI,
            UNDEF,
            startX, startY,
            endX, endY,
            startCornerX, startCornerY,
            endCornerX, endCornerY,
            vmlAngle, vmlGradientLength, vmlColors,
            deltaX, deltaY, lineLength,
            stopPx, vmlOffsetPct,
            p, i, j, before, after;

        /**
         * Find the point along a given line (defined by a starting point and an angle), at which
         * that line is intersected by a perpendicular line extending through another point.
         * @param x1 - x coord of the starting point
         * @param y1 - y coord of the starting point
         * @param angle - angle of the line extending from the starting point (in degrees)
         * @param x2 - x coord of point along the perpendicular line
         * @param y2 - y coord of point along the perpendicular line
         * @return [ x, y ]
         */
        function perpendicularIntersect( x1, y1, angle, x2, y2 ) {
            // Handle straight vertical and horizontal angles, for performance and to avoid
            // divide-by-zero errors.
            if( angle === 0 || angle === 180 ) {
                return [ x2, y1 ];
            }
            else if( angle === 90 || angle === 270 ) {
                return [ x1, y2 ];
            }
            else {
                // General approach: determine the Ax+By=C formula for each line (the slope of the second
                // line is the negative inverse of the first) and then solve for where both formulas have
                // the same x/y values.
                var a1 = Math.tan( -angle * PI / 180 ),
                    c1 = a1 * x1 - y1,
                    a2 = -1 / a1,
                    c2 = a2 * x2 - y2,
                    d = a2 - a1,
                    endX = ( c2 - c1 ) / d,
                    endY = ( a1 * c2 - a2 * c1 ) / d;
                return [ endX, endY ];
            }
        }

        // Find the "start" and "end" corners; these are the corners furthest along the gradient line.
        // This is used below to find the start/end positions of the CSS3 gradient-line, and also in finding
        // the total length of the VML rendered gradient-line corner to corner.
        function findCorners() {
            startCornerX = ( angle >= 90 && angle < 270 ) ? w : 0;
            startCornerY = angle < 180 ? h : 0;
            endCornerX = w - startCornerX;
            endCornerY = h - startCornerY;
        }

        // Normalize the angle to a value between [0, 360)
        function normalizeAngle() {
            while( angle < 0 ) {
                angle += 360;
            }
            angle = angle % 360;
        }

        // Find the distance between two points
        function distance( p1, p2 ) {
            var dx = p2[0] - p1[0],
                dy = p2[1] - p1[1];
            return Math.abs(
                dx === 0 ? dy :
                dy === 0 ? dx :
                Math.sqrt( dx * dx + dy * dy )
            );
        }

        // Find the start and end points of the gradient
        if( startPos ) {
            startPos = startPos.coords( el, w, h );
            startX = startPos.x;
            startY = startPos.y;
        }
        if( angle ) {
            angle = angle.degrees();

            normalizeAngle();
            findCorners();

            // If no start position was specified, then choose a corner as the starting point.
            if( !startPos ) {
                startX = startCornerX;
                startY = startCornerY;
            }

            // Find the end position by extending a perpendicular line from the gradient-line which
            // intersects the corner opposite from the starting corner.
            p = perpendicularIntersect( startX, startY, angle, endCornerX, endCornerY );
            endX = p[0];
            endY = p[1];
        }
        else if( startPos ) {
            // Start position but no angle specified: find the end point by rotating 180deg around the center
            endX = w - startX;
            endY = h - startY;
        }
        else {
            // Neither position nor angle specified; create vertical gradient from top to bottom
            startX = startY = endX = 0;
            endY = h;
        }
        deltaX = endX - startX;
        deltaY = endY - startY;

        if( angle === UNDEF ) {
            // Get the angle based on the change in x/y from start to end point. Checks first for horizontal
            // or vertical angles so they get exact whole numbers rather than what atan2 gives.
            angle = ( !deltaX ? ( deltaY < 0 ? 90 : 270 ) :
                        ( !deltaY ? ( deltaX < 0 ? 180 : 0 ) :
                            -Math.atan2( deltaY, deltaX ) / PI * 180
                        )
                    );
            normalizeAngle();
            findCorners();
        }


        // In VML land, the angle of the rendered gradient depends on the aspect ratio of the shape's
        // bounding box; for example specifying a 45 deg angle actually results in a gradient
        // drawn diagonally from one corner to its opposite corner, which will only appear to the
        // viewer as 45 degrees if the shape is equilateral.  We adjust for this by taking the x/y deltas
        // between the start and end points, multiply one of them by the shape's aspect ratio,
        // and get their arctangent, resulting in an appropriate VML angle. If the angle is perfectly
        // horizontal or vertical then we don't need to do this conversion.
        vmlAngle = ( angle % 90 ) ? Math.atan2( deltaX * w / h, deltaY ) / PI * 180 : ( angle + 90 );

        // VML angles are 180 degrees offset from CSS angles
        vmlAngle += 180;
        vmlAngle = vmlAngle % 360;

        // Add all the stops to the VML 'colors' list, including the first and last stops.
        // For each, we find its pixel offset along the gradient-line; if the offset of a stop is less
        // than that of its predecessor we increase it to be equal. We then map that pixel offset to a
        // percentage along the VML gradient-line, which runs from shape corner to corner.
        lineLength = distance( [ startX, startY ], [ endX, endY ] );
        vmlGradientLength = distance( [ startCornerX, startCornerY ], perpendicularIntersect( startCornerX, startCornerY, angle, endCornerX, endCornerY ) );
        vmlColors = [];
        vmlOffsetPct = distance( [ startX, startY ], perpendicularIntersect( startX, startY, angle, startCornerX, startCornerY ) ) / vmlGradientLength * 100;

        // Find the pixel offsets along the CSS3 gradient-line for each stop.
        stopPx = [];
        for( i = 0; i < stopCount; i++ ) {
            stopPx.push( stops[i].offset ? stops[i].offset.pixels( el, lineLength ) :
                         i === 0 ? 0 : i === stopCount - 1 ? lineLength : null );
        }
        // Fill in gaps with evenly-spaced offsets
        for( i = 1; i < stopCount; i++ ) {
            if( stopPx[ i ] === null ) {
                before = stopPx[ i - 1 ];
                j = i;
                do {
                    after = stopPx[ ++j ];
                } while( after === null );
                stopPx[ i ] = before + ( after - before ) / ( j - i + 1 );
            }
            // Make sure each stop's offset is no less than the one before it
            stopPx[ i ] = Math.max( stopPx[ i ], stopPx[ i - 1 ] );
        }

        // Convert to percentage along the VML gradient line and add to the VML 'colors' value
        for( i = 0; i < stopCount; i++ ) {
            vmlColors.push(
                ( vmlOffsetPct + ( stopPx[ i ] / vmlGradientLength * 100 ) ) + '% ' + stops[i].color.value( el )
            );
        }

        // Now, finally, we're ready to render the gradient fill. Set the start and end colors to
        // the first and last stop colors; this just sets outer bounds for the gradient.
        fill['angle'] = vmlAngle;
        fill['type'] = 'gradient';
        fill['method'] = 'sigma';
        fill['color'] = stops[0].color.value( el );
        fill['color2'] = stops[stopCount - 1].color.value( el );
        fill['colors'].value = vmlColors.join( ',' );
    },


    /**
     * Hide the actual background image and color of the element.
     */
    hideBackground: function() {
        var rs = this.targetElement.runtimeStyle;
        rs.backgroundImage = 'url(about:blank)'; //ensures the background area reacts to mouse events
        rs.backgroundColor = 'transparent';
    },

    destroy: function() {
        PIE.RendererBase.destroy.call( this );
        var rs = this.targetElement.runtimeStyle;
        rs.backgroundImage = rs.backgroundColor = '';
    }

} );
/**
 * Renderer for element borders.
 * @constructor
 * @param {Element} el The target element
 * @param {Object} styleInfos The StyleInfo objects
 * @param {PIE.RootRenderer} parent
 */
PIE.BorderRenderer = PIE.RendererBase.newRenderer( {

    boxZIndex: 4,
    boxName: 'border',

    /**
     * Lookup table of elements which cannot take custom children.
     */
    childlessElements: {
        'TABLE':1, //can obviously have children but not custom ones
        'INPUT':1,
        'TEXTAREA':1,
        'SELECT':1,
        'OPTION':1,
        'IMG':1,
        'HR':1,
        'FIELDSET':1 //can take children but wrapping its children messes up its <legend>
    },

    /**
     * Values of the type attribute for input elements displayed as buttons
     */
    inputButtonTypes: {
        'submit':1,
        'button':1,
        'reset':1
    },

    needsUpdate: function() {
        var si = this.styleInfos;
        return si.borderInfo.changed() || si.borderRadiusInfo.changed();
    },

    isActive: function() {
        var si = this.styleInfos;
        return ( si.borderImageInfo.isActive() ||
                 si.borderRadiusInfo.isActive() ||
                 si.backgroundInfo.isActive() ) &&
               si.borderInfo.isActive(); //check BorderStyleInfo last because it's the most expensive
    },

    /**
     * Draw the border shape(s)
     */
    draw: function() {
        var el = this.targetElement,
            cs = el.currentStyle,
            props = this.styleInfos.borderInfo.getProps(),
            bounds = this.boundsInfo.getBounds(),
            w = bounds.w,
            h = bounds.h,
            side, shape, stroke, s,
            segments, seg, i, len;

        if( props ) {
            this.hideBorder();

            segments = this.getBorderSegments( 2 );
            for( i = 0, len = segments.length; i < len; i++) {
                seg = segments[i];
                shape = this.getShape( 'borderPiece' + i, seg.stroke ? 'stroke' : 'fill', this.getBox() );
                shape.coordsize = w * 2 + ',' + h * 2;
                shape.coordorigin = '1,1';
                shape.path = seg.path;
                s = shape.style;
                s.width = w;
                s.height = h;

                shape.filled = !!seg.fill;
                shape.stroked = !!seg.stroke;
                if( seg.stroke ) {
                    stroke = shape.stroke;
                    stroke['weight'] = seg.weight + 'px';
                    stroke.color = seg.color.value( el );
                    stroke['dashstyle'] = seg.stroke === 'dashed' ? '2 2' : seg.stroke === 'dotted' ? '1 1' : 'solid';
                    stroke['linestyle'] = seg.stroke === 'double' && seg.weight > 2 ? 'ThinThin' : 'Single';
                } else {
                    shape.fill.color = seg.fill.value( el );
                }
            }

            // remove any previously-created border shapes which didn't get used above
            while( this.deleteShape( 'borderPiece' + i++ ) ) {}
        }
    },

    /**
     * Hide the actual border of the element. In IE7 and up we can just set its color to transparent;
     * however IE6 does not support transparent borders so we have to get tricky with it. Also, some elements
     * like form buttons require removing the border width altogether, so for those we increase the padding
     * by the border size.
     */
    hideBorder: function() {
        var el = this.targetElement,
            cs = el.currentStyle,
            rs = el.runtimeStyle,
            tag = el.tagName,
            isIE6 = PIE.ieVersion === 6,
            sides, side, i;

        if( ( isIE6 && tag in this.childlessElements ) || tag === 'BUTTON' ||
                ( tag === 'INPUT' && el.type in this.inputButtonTypes ) ) {
            rs.borderWidth = '';
            sides = this.styleInfos.borderInfo.sides;
            for( i = sides.length; i--; ) {
                side = sides[ i ];
                rs[ 'padding' + side ] = '';
                rs[ 'padding' + side ] = ( new PIE.Length( cs[ 'padding' + side ] ) ).pixels( el ) +
                                         ( new PIE.Length( cs[ 'border' + side + 'Width' ] ) ).pixels( el ) +
                                         ( !PIE.ieVersion === 8 && i % 2 ? 1 : 0 ); //needs an extra horizontal pixel to counteract the extra "inner border" going away
            }
            rs.borderWidth = 0;
        }
        else if( isIE6 ) {
            // Wrap all the element's children in a custom element, set the element to visiblity:hidden,
            // and set the wrapper element to visiblity:visible. This hides the outer element's decorations
            // (background and border) but displays all the contents.
            // TODO find a better way to do this that doesn't mess up the DOM parent-child relationship,
            // as this can interfere with other author scripts which add/modify/delete children. Also, this
            // won't work for elements which cannot take children, e.g. input/button/textarea/img/etc. Look into
            // using a compositor filter or some other filter which masks the border.
            if( el.childNodes.length !== 1 || el.firstChild.tagName !== 'ie6-mask' ) {
                var cont = doc.createElement( 'ie6-mask' ),
                    s = cont.style, child;
                s.visibility = 'visible';
                s.zoom = 1;
                while( child = el.firstChild ) {
                    cont.appendChild( child );
                }
                el.appendChild( cont );
                rs.visibility = 'hidden';
            }
        }
        else {
            rs.borderColor = 'transparent';
        }
    },


    /**
     * Get the VML path definitions for the border segment(s).
     * @param {number=} mult If specified, all coordinates will be multiplied by this number
     * @return {Array.<string>}
     */
    getBorderSegments: function( mult ) {
        var el = this.targetElement,
            bounds, elW, elH,
            borderInfo = this.styleInfos.borderInfo,
            segments = [],
            floor, ceil, wT, wR, wB, wL,
            round = Math.round,
            borderProps, radiusInfo, radii, widths, styles, colors;

        if( borderInfo.isActive() ) {
            borderProps = borderInfo.getProps();

            widths = borderProps.widths;
            styles = borderProps.styles;
            colors = borderProps.colors;

            if( borderProps.widthsSame && borderProps.stylesSame && borderProps.colorsSame ) {
                if( colors['t'].alpha() > 0 ) {
                    // shortcut for identical border on all sides - only need 1 stroked shape
                    wT = widths['t'].pixels( el ); //thickness
                    wR = wT / 2; //shrink
                    segments.push( {
                        path: this.getBoxPath( { t: wR, r: wR, b: wR, l: wR }, mult ),
                        stroke: styles['t'],
                        color: colors['t'],
                        weight: wT
                    } );
                }
            }
            else {
                mult = mult || 1;
                bounds = this.boundsInfo.getBounds();
                elW = bounds.w;
                elH = bounds.h;

                wT = round( widths['t'].pixels( el ) );
                wR = round( widths['r'].pixels( el ) );
                wB = round( widths['b'].pixels( el ) );
                wL = round( widths['l'].pixels( el ) );
                var pxWidths = {
                    't': wT,
                    'r': wR,
                    'b': wB,
                    'l': wL
                };

                radiusInfo = this.styleInfos.borderRadiusInfo;
                if( radiusInfo.isActive() ) {
                    radii = this.getRadiiPixels( radiusInfo.getProps() );
                }

                floor = Math.floor;
                ceil = Math.ceil;

                function radius( xy, corner ) {
                    return radii ? radii[ xy ][ corner ] : 0;
                }

                function curve( corner, shrinkX, shrinkY, startAngle, ccw, doMove ) {
                    var rx = radius( 'x', corner),
                        ry = radius( 'y', corner),
                        deg = 65535,
                        isRight = corner.charAt( 1 ) === 'r',
                        isBottom = corner.charAt( 0 ) === 'b';
                    return ( rx > 0 && ry > 0 ) ?
                                ( doMove ? 'al' : 'ae' ) +
                                ( isRight ? ceil( elW - rx ) : floor( rx ) ) * mult + ',' + // center x
                                ( isBottom ? ceil( elH - ry ) : floor( ry ) ) * mult + ',' + // center y
                                ( floor( rx ) - shrinkX ) * mult + ',' + // width
                                ( floor( ry ) - shrinkY ) * mult + ',' + // height
                                ( startAngle * deg ) + ',' + // start angle
                                ( 45 * deg * ( ccw ? 1 : -1 ) // angle change
                            ) : (
                                ( doMove ? 'm' : 'l' ) +
                                ( isRight ? elW - shrinkX : shrinkX ) * mult + ',' +
                                ( isBottom ? elH - shrinkY : shrinkY ) * mult
                            );
                }

                function line( side, shrink, ccw, doMove ) {
                    var
                        start = (
                            side === 't' ?
                                floor( radius( 'x', 'tl') ) * mult + ',' + ceil( shrink ) * mult :
                            side === 'r' ?
                                ceil( elW - shrink ) * mult + ',' + floor( radius( 'y', 'tr') ) * mult :
                            side === 'b' ?
                                ceil( elW - radius( 'x', 'br') ) * mult + ',' + floor( elH - shrink ) * mult :
                            // side === 'l' ?
                                floor( shrink ) * mult + ',' + ceil( elH - radius( 'y', 'bl') ) * mult
                        ),
                        end = (
                            side === 't' ?
                                ceil( elW - radius( 'x', 'tr') ) * mult + ',' + ceil( shrink ) * mult :
                            side === 'r' ?
                                ceil( elW - shrink ) * mult + ',' + ceil( elH - radius( 'y', 'br') ) * mult :
                            side === 'b' ?
                                floor( radius( 'x', 'bl') ) * mult + ',' + floor( elH - shrink ) * mult :
                            // side === 'l' ?
                                floor( shrink ) * mult + ',' + floor( radius( 'y', 'tl') ) * mult
                        );
                    return ccw ? ( doMove ? 'm' + end : '' ) + 'l' + start :
                                 ( doMove ? 'm' + start : '' ) + 'l' + end;
                }


                function addSide( side, sideBefore, sideAfter, cornerBefore, cornerAfter, baseAngle ) {
                    var vert = side === 'l' || side === 'r',
                        sideW = pxWidths[ side ],
                        beforeX, beforeY, afterX, afterY;

                    if( sideW > 0 && styles[ side ] !== 'none' && colors[ side ].alpha() > 0 ) {
                        beforeX = pxWidths[ vert ? side : sideBefore ];
                        beforeY = pxWidths[ vert ? sideBefore : side ];
                        afterX = pxWidths[ vert ? side : sideAfter ];
                        afterY = pxWidths[ vert ? sideAfter : side ];

                        if( styles[ side ] === 'dashed' || styles[ side ] === 'dotted' ) {
                            segments.push( {
                                path: curve( cornerBefore, beforeX, beforeY, baseAngle + 45, 0, 1 ) +
                                      curve( cornerBefore, 0, 0, baseAngle, 1, 0 ),
                                fill: colors[ side ]
                            } );
                            segments.push( {
                                path: line( side, sideW / 2, 0, 1 ),
                                stroke: styles[ side ],
                                weight: sideW,
                                color: colors[ side ]
                            } );
                            segments.push( {
                                path: curve( cornerAfter, afterX, afterY, baseAngle, 0, 1 ) +
                                      curve( cornerAfter, 0, 0, baseAngle - 45, 1, 0 ),
                                fill: colors[ side ]
                            } );
                        }
                        else {
                            segments.push( {
                                path: curve( cornerBefore, beforeX, beforeY, baseAngle + 45, 0, 1 ) +
                                      line( side, sideW, 0, 0 ) +
                                      curve( cornerAfter, afterX, afterY, baseAngle, 0, 0 ) +

                                      ( styles[ side ] === 'double' && sideW > 2 ?
                                              curve( cornerAfter, afterX - floor( afterX / 3 ), afterY - floor( afterY / 3 ), baseAngle - 45, 1, 0 ) +
                                              line( side, ceil( sideW / 3 * 2 ), 1, 0 ) +
                                              curve( cornerBefore, beforeX - floor( beforeX / 3 ), beforeY - floor( beforeY / 3 ), baseAngle, 1, 0 ) +
                                              'x ' +
                                              curve( cornerBefore, floor( beforeX / 3 ), floor( beforeY / 3 ), baseAngle + 45, 0, 1 ) +
                                              line( side, floor( sideW / 3 ), 1, 0 ) +
                                              curve( cornerAfter, floor( afterX / 3 ), floor( afterY / 3 ), baseAngle, 0, 0 )
                                          : '' ) +

                                      curve( cornerAfter, 0, 0, baseAngle - 45, 1, 0 ) +
                                      line( side, 0, 1, 0 ) +
                                      curve( cornerBefore, 0, 0, baseAngle, 1, 0 ),
                                fill: colors[ side ]
                            } );
                        }
                    }
                }

                addSide( 't', 'l', 'r', 'tl', 'tr', 90 );
                addSide( 'r', 't', 'b', 'tr', 'br', 0 );
                addSide( 'b', 'r', 'l', 'br', 'bl', -90 );
                addSide( 'l', 'b', 't', 'bl', 'tl', -180 );
            }
        }

        return segments;
    },

    destroy: function() {
        PIE.RendererBase.destroy.call( this );
        this.targetElement.runtimeStyle.borderColor = '';
    }


} );
/**
 * Renderer for border-image
 * @constructor
 * @param {Element} el The target element
 * @param {Object} styleInfos The StyleInfo objects
 * @param {PIE.RootRenderer} parent
 */
PIE.BorderImageRenderer = PIE.RendererBase.newRenderer( {

    boxZIndex: 5,
    pieceNames: [ 't', 'tr', 'r', 'br', 'b', 'bl', 'l', 'tl', 'c' ],

    needsUpdate: function() {
        return this.styleInfos.borderImageInfo.changed();
    },

    isActive: function() {
        return this.styleInfos.borderImageInfo.isActive();
    },

    draw: function() {
        var props = this.styleInfos.borderImageInfo.getProps(),
            bounds = this.boundsInfo.getBounds(),
            box = this.getBox(), //make sure pieces are created
            el = this.targetElement,
            pieces = this.pieces;

        PIE.Util.withImageSize( props.src, function( imgSize ) {
            var elW = bounds.w,
                elH = bounds.h,

                widths = props.width,
                widthT = widths.t.pixels( el ),
                widthR = widths.r.pixels( el ),
                widthB = widths.b.pixels( el ),
                widthL = widths.l.pixels( el ),
                slices = props.slice,
                sliceT = slices.t.pixels( el ),
                sliceR = slices.r.pixels( el ),
                sliceB = slices.b.pixels( el ),
                sliceL = slices.l.pixels( el );

            // Piece positions and sizes
            function setSizeAndPos( piece, w, h, x, y ) {
                var s = pieces[piece].style;
                s.width = w;
                s.height = h;
                s.left = x;
                s.top = y;
            }
            setSizeAndPos( 'tl', widthL, widthT, 0, 0 );
            setSizeAndPos( 't', elW - widthL - widthR, widthT, widthL, 0 );
            setSizeAndPos( 'tr', widthR, widthT, elW - widthR, 0 );
            setSizeAndPos( 'r', widthR, elH - widthT - widthB, elW - widthR, widthT );
            setSizeAndPos( 'br', widthR, widthB, elW - widthR, elH - widthB );
            setSizeAndPos( 'b', elW - widthL - widthR, widthB, widthL, elH - widthB );
            setSizeAndPos( 'bl', widthL, widthB, 0, elH - widthB );
            setSizeAndPos( 'l', widthL, elH - widthT - widthB, 0, widthT );
            setSizeAndPos( 'c', elW - widthL - widthR, elH - widthT - widthB, widthL, widthT );


            // image croppings
            function setCrops( sides, crop, val ) {
                for( var i=0, len=sides.length; i < len; i++ ) {
                    pieces[ sides[i] ]['imagedata'][ crop ] = val;
                }
            }

            // corners
            setCrops( [ 'tl', 't', 'tr' ], 'cropBottom', ( imgSize.h - sliceT ) / imgSize.h );
            setCrops( [ 'tl', 'l', 'bl' ], 'cropRight', ( imgSize.w - sliceL ) / imgSize.w );
            setCrops( [ 'bl', 'b', 'br' ], 'cropTop', ( imgSize.h - sliceB ) / imgSize.h );
            setCrops( [ 'tr', 'r', 'br' ], 'cropLeft', ( imgSize.w - sliceR ) / imgSize.w );

            // edges and center
            if( props.repeat.v === 'stretch' ) {
                setCrops( [ 'l', 'r', 'c' ], 'cropTop', sliceT / imgSize.h );
                setCrops( [ 'l', 'r', 'c' ], 'cropBottom', sliceB / imgSize.h );
            }
            if( props.repeat.h === 'stretch' ) {
                setCrops( [ 't', 'b', 'c' ], 'cropLeft', sliceL / imgSize.w );
                setCrops( [ 't', 'b', 'c' ], 'cropRight', sliceR / imgSize.w );
            }

            // center fill
            pieces['c'].style.display = props.fill ? '' : 'none';
        }, this );
    },

    getBox: function() {
        var box = this.parent.getLayer( this.boxZIndex ),
            s, piece, i,
            pieceNames = this.pieceNames,
            len = pieceNames.length;

        if( !box ) {
            box = doc.createElement( 'border-image' );
            s = box.style;
            s.position = 'absolute';

            this.pieces = {};

            for( i = 0; i < len; i++ ) {
                piece = this.pieces[ pieceNames[i] ] = PIE.Util.createVmlElement( 'rect' );
                piece.appendChild( PIE.Util.createVmlElement( 'imagedata' ) );
                s = piece.style;
                s['behavior'] = 'url(#default#VML)';
                s.position = "absolute";
                s.top = s.left = 0;
                piece['imagedata'].src = this.styleInfos.borderImageInfo.getProps().src;
                piece.stroked = false;
                piece.filled = false;
                box.appendChild( piece );
            }

            this.parent.addLayer( this.boxZIndex, box );
        }

        return box;
    }

} );
/**
 * Renderer for outset box-shadows
 * @constructor
 * @param {Element} el The target element
 * @param {Object} styleInfos The StyleInfo objects
 * @param {PIE.RootRenderer} parent
 */
PIE.BoxShadowOutsetRenderer = PIE.RendererBase.newRenderer( {

    boxZIndex: 1,
    boxName: 'outset-box-shadow',

    needsUpdate: function() {
        var si = this.styleInfos;
        return si.boxShadowInfo.changed() || si.borderRadiusInfo.changed();
    },

    isActive: function() {
        var boxShadowInfo = this.styleInfos.boxShadowInfo;
        return boxShadowInfo.isActive() && boxShadowInfo.getProps().outset[0];
    },

    draw: function() {
        var me = this,
            el = this.targetElement,
            box = this.getBox(),
            styleInfos = this.styleInfos,
            shadowInfos = styleInfos.boxShadowInfo.getProps().outset,
            radii = styleInfos.borderRadiusInfo.getProps(),
            len = shadowInfos.length,
            i = len, j,
            bounds = this.boundsInfo.getBounds(),
            w = bounds.w,
            h = bounds.h,
            clipAdjust = PIE.ieVersion === 8 ? 1 : 0, //workaround for IE8 bug where VML leaks out top/left of clip region by 1px
            corners = [ 'tl', 'tr', 'br', 'bl' ], corner,
            shadowInfo, shape, fill, ss, xOff, yOff, spread, blur, shrink, color, alpha, path,
            totalW, totalH, focusX, focusY, isBottom, isRight;


        function getShadowShape( index, corner, xOff, yOff, color, blur, path ) {
            var shape = me.getShape( 'shadow' + index + corner, 'fill', box, len - index ),
                fill = shape.fill;

            // Position and size
            shape['coordsize'] = w * 2 + ',' + h * 2;
            shape['coordorigin'] = '1,1';

            // Color and opacity
            shape['stroked'] = false;
            shape['filled'] = true;
            fill.color = color.value( el );
            if( blur ) {
                fill['type'] = 'gradienttitle'; //makes the VML gradient follow the shape's outline - hooray for undocumented features?!?!
                fill['color2'] = fill.color;
                fill['opacity'] = 0;
            }

            // Path
            shape.path = path;

            // This needs to go last for some reason, to prevent rendering at incorrect size
            ss = shape.style;
            ss.left = xOff;
            ss.top = yOff;
            ss.width = w;
            ss.height = h;

            return shape;
        }


        while( i-- ) {
            shadowInfo = shadowInfos[ i ];
            xOff = shadowInfo.xOffset.pixels( el );
            yOff = shadowInfo.yOffset.pixels( el );
            spread = shadowInfo.spread.pixels( el ),
            blur = shadowInfo.blur.pixels( el );
            color = shadowInfo.color;
            // Shape path
            shrink = -spread - blur;
            if( !radii && blur ) {
                // If blurring, use a non-null border radius info object so that getBoxPath will
                // round the corners of the expanded shadow shape rather than squaring them off.
                radii = PIE.BorderRadiusStyleInfo.ALL_ZERO;
            }
            path = this.getBoxPath( { t: shrink, r: shrink, b: shrink, l: shrink }, 2, radii );

            if( blur ) {
                totalW = ( spread + blur ) * 2 + w;
                totalH = ( spread + blur ) * 2 + h;
                focusX = blur * 2 / totalW;
                focusY = blur * 2 / totalH;
                if( blur - spread > w / 2 || blur - spread > h / 2 ) {
                    // If the blur is larger than half the element's narrowest dimension, we cannot do
                    // this with a single shape gradient, because its focussize would have to be less than
                    // zero which results in ugly artifacts. Instead we create four shapes, each with its
                    // gradient focus past center, and then clip them so each only shows the quadrant
                    // opposite the focus.
                    for( j = 4; j--; ) {
                        corner = corners[j];
                        isBottom = corner.charAt( 0 ) === 'b';
                        isRight = corner.charAt( 1 ) === 'r';
                        shape = getShadowShape( i, corner, xOff, yOff, color, blur, path );
                        fill = shape.fill;
                        fill['focusposition'] = ( isRight ? 1 - focusX : focusX ) + ',' +
                                                ( isBottom ? 1 - focusY : focusY );
                        fill['focussize'] = '0,0';

                        // Clip to show only the appropriate quadrant. Add 1px to the top/left clip values
                        // in IE8 to prevent a bug where IE8 displays one pixel outside the clip region.
                        shape.style.clip = 'rect(' + ( ( isBottom ? totalH / 2 : 0 ) + clipAdjust ) + 'px,' +
                                                     ( isRight ? totalW : totalW / 2 ) + 'px,' +
                                                     ( isBottom ? totalH : totalH / 2 ) + 'px,' +
                                                     ( ( isRight ? totalW / 2 : 0 ) + clipAdjust ) + 'px)';
                    }
                } else {
                    // TODO delete old quadrant shapes if resizing expands past the barrier
                    shape = getShadowShape( i, '', xOff, yOff, color, blur, path );
                    fill = shape.fill;
                    fill['focusposition'] = focusX + ',' + focusY;
                    fill['focussize'] = ( 1 - focusX * 2 ) + ',' + ( 1 - focusY * 2 );
                }
            } else {
                shape = getShadowShape( i, '', xOff, yOff, color, blur, path );
                alpha = color.alpha();
                if( alpha < 1 ) {
                    // shape.style.filter = 'alpha(opacity=' + ( alpha * 100 ) + ')';
                    // ss.filter = 'progid:DXImageTransform.Microsoft.BasicImage(opacity=' + ( alpha  ) + ')';
                    shape.fill.opacity = alpha;
                }
            }
        }
    }

} );
/**
 * Renderer for re-rendering img elements using VML. Kicks in if the img has
 * a border-radius applied, or if the -pie-png-fix flag is set.
 * @constructor
 * @param {Element} el The target element
 * @param {Object} styleInfos The StyleInfo objects
 * @param {PIE.RootRenderer} parent
 */
PIE.ImgRenderer = PIE.RendererBase.newRenderer( {

    boxZIndex: 6,
    boxName: 'imgEl',

    needsUpdate: function() {
        var si = this.styleInfos;
        return this.targetElement.src !== this._lastSrc || si.borderRadiusInfo.changed();
    },

    isActive: function() {
        var si = this.styleInfos;
        return si.borderRadiusInfo.isActive() || si.backgroundInfo.isPngFix();
    },

    draw: function() {
        this.hideActualImg();

        var shape = this.getShape( 'img', 'fill', this.getBox() ),
            fill = shape.fill,
            bounds = this.boundsInfo.getBounds(),
            w = bounds.w,
            h = bounds.h,
            borderProps = this.styleInfos.borderInfo.getProps(),
            borderWidths = borderProps && borderProps.widths,
            el = this.targetElement,
            src = el.src,
            round = Math.round,
            s;

        shape.stroked = false;
        fill.type = 'frame';
        fill.src = src;
        fill.position = (0.5 / w) + ',' + (0.5 / h);
        shape.coordsize = w * 2 + ',' + h * 2;
        shape.coordorigin = '1,1';
        shape.path = this.getBoxPath( borderWidths ? {
            t: round( borderWidths['t'].pixels( el ) ),
            r: round( borderWidths['r'].pixels( el ) ),
            b: round( borderWidths['b'].pixels( el ) ),
            l: round( borderWidths['l'].pixels( el ) )
        } : 0, 2 );
        s = shape.style;
        s.width = w;
        s.height = h;

        this._lastSrc = src;
    },

    hideActualImg: function() {
        this.targetElement.runtimeStyle.filter = 'alpha(opacity=0)';
    },

    destroy: function() {
        PIE.RendererBase.destroy.call( this );
        this.targetElement.runtimeStyle.filter = '';
    }

} );

PIE.Element = (function() {

    var wrappers = {},
        lazyInitCssProp = PIE.CSS_PREFIX + 'lazy-init',
        hoverClass = ' ' + PIE.CLASS_PREFIX + 'hover',
        hoverClassRE = new RegExp( '\\b' + PIE.CLASS_PREFIX + 'hover\\b', 'g' ),
        ignorePropertyNames = { 'background':1, 'bgColor':1, 'display': 1 };


    function addListener( el, type, handler ) {
        el.attachEvent( type, handler );
    }

    function removeListener( el, type, handler ) {
        el.detachEvent( type, handler );
    }


    function Element( el ) {
        var renderers,
            boundsInfo = new PIE.BoundsInfo( el ),
            styleInfos,
            styleInfosArr,
            ancestors,
            initializing,
            initialized,
            eventsAttached,
            delayed,
            destroyed;

        /**
         * Initialize PIE for this element.
         */
        function init() {
            if( !initialized ) {
                var docEl,
                    bounds,
                    lazy = el.currentStyle.getAttribute( lazyInitCssProp ) === 'true',
                    rootRenderer;

                // Force layout so move/resize events will fire. Set this as soon as possible to avoid layout changes
                // after load, but make sure it only gets called the first time through to avoid recursive calls to init().
                if( !initializing ) {
                    initializing = 1;
                    el.runtimeStyle.zoom = 1;
                    initFirstChildPseudoClass();
                }

                boundsInfo.lock();

                // If the -pie-lazy-init:true flag is set, check if the element is outside the viewport and if so, delay initialization
                if( lazy && ( bounds = boundsInfo.getBounds() ) && ( docEl = doc.documentElement || doc.body ) &&
                        ( bounds.y > docEl.clientHeight || bounds.x > docEl.clientWidth || bounds.y + bounds.h < 0 || bounds.x + bounds.w < 0 ) ) {
                    if( !delayed ) {
                        delayed = 1;
                        PIE.OnScroll.observe( init );
                    }
                } else {
                    initialized = 1;
                    delayed = initializing = 0;
                    PIE.OnScroll.unobserve( init );

                    // Create the style infos and renderers
                    styleInfos = {
                        backgroundInfo: new PIE.BackgroundStyleInfo( el ),
                        borderInfo: new PIE.BorderStyleInfo( el ),
                        borderImageInfo: new PIE.BorderImageStyleInfo( el ),
                        borderRadiusInfo: new PIE.BorderRadiusStyleInfo( el ),
                        boxShadowInfo: new PIE.BoxShadowStyleInfo( el ),
                        visibilityInfo: new PIE.VisibilityStyleInfo( el )
                    };
                    styleInfosArr = [
                        styleInfos.backgroundInfo,
                        styleInfos.borderInfo,
                        styleInfos.borderImageInfo,
                        styleInfos.borderRadiusInfo,
                        styleInfos.boxShadowInfo,
                        styleInfos.visibilityInfo
                    ];

                    rootRenderer = new PIE.RootRenderer( el, boundsInfo, styleInfos );
                    var childRenderers = [
                        new PIE.BoxShadowOutsetRenderer( el, boundsInfo, styleInfos, rootRenderer ),
                        new PIE.BackgroundRenderer( el, boundsInfo, styleInfos, rootRenderer ),
                        //new PIE.BoxShadowInsetRenderer( el, boundsInfo, styleInfos, rootRenderer ),
                        new PIE.BorderRenderer( el, boundsInfo, styleInfos, rootRenderer ),
                        new PIE.BorderImageRenderer( el, boundsInfo, styleInfos, rootRenderer )
                    ];
                    if( el.tagName === 'IMG' ) {
                        childRenderers.push( new PIE.ImgRenderer( el, boundsInfo, styleInfos, rootRenderer ) );
                    }
                    rootRenderer.childRenderers = childRenderers; // circular reference, can't pass in constructor; TODO is there a cleaner way?
                    renderers = [ rootRenderer ].concat( childRenderers );

                    // Add property change listeners to ancestors if requested
                    initAncestorPropChangeListeners();

                    // Add to list of polled elements in IE8
                    if( PIE.ie8DocMode === 8 ) {
                        PIE.Heartbeat.observe( update );
                    }

                    // Trigger rendering
                    update( 1 );
                }

                if( !eventsAttached ) {
                    eventsAttached = 1;
                    addListener( el, 'onmove', handleMoveOrResize );
                    addListener( el, 'onresize', handleMoveOrResize );
                    addListener( el, 'onpropertychange', propChanged );
                    addListener( el, 'onmouseenter', mouseEntered );
                    addListener( el, 'onmouseleave', mouseLeft );
                    PIE.OnResize.observe( handleMoveOrResize );

                    PIE.OnBeforeUnload.observe( removeEventListeners );
                }

                boundsInfo.unlock();
            }
        }




        /**
         * Event handler for onmove and onresize events. Invokes update() only if the element's
         * bounds have previously been calculated, to prevent multiple runs during page load when
         * the element has no initial CSS3 properties.
         */
        function handleMoveOrResize() {
            if( boundsInfo && boundsInfo.hasBeenQueried() ) {
                update();
            }
        }


        /**
         * Update position and/or size as necessary. Both move and resize events call
         * this rather than the updatePos/Size functions because sometimes, particularly
         * during page load, one will fire but the other won't.
         */
        function update( force ) {
            if( !destroyed ) {
                if( initialized ) {
                    var i, len;

                    lockAll();
                    if( force || boundsInfo.positionChanged() ) {
                        /* TODO just using getBoundingClientRect (used internally by BoundsInfo) for detecting
                           position changes may not always be accurate; it's possible that
                           an element will actually move relative to its positioning parent, but its position
                           relative to the viewport will stay the same. Need to come up with a better way to
                           track movement. The most accurate would be the same logic used in RootRenderer.updatePos()
                           but that is a more expensive operation since it does some DOM walking, and we want this
                           check to be as fast as possible. */
                        for( i = 0, len = renderers.length; i < len; i++ ) {
                            renderers[i].updatePos();
                        }
                    }
                    if( force || boundsInfo.sizeChanged() ) {
                        for( i = 0, len = renderers.length; i < len; i++ ) {
                            renderers[i].updateSize();
                        }
                    }
                    unlockAll();
                }
                else if( !initializing ) {
                    init();
                }
            }
        }

        /**
         * Handle property changes to trigger update when appropriate.
         */
        function propChanged() {
            var i, len, renderer,
                e = event;

            // Some elements like <table> fire onpropertychange events for old-school background properties
            // ('background', 'bgColor') when runtimeStyle background properties are changed, which
            // results in an infinite loop; therefore we filter out those property names. Also, 'display'
            // is ignored because size calculations don't work correctly immediately when its onpropertychange
            // event fires, and because it will trigger an onresize event anyway.
            if( !destroyed && !( e && e.propertyName in ignorePropertyNames ) ) {
                if( initialized ) {
                    lockAll();
                    for( i = 0, len = renderers.length; i < len; i++ ) {
                        renderer = renderers[i];
                        // Make sure position is synced if the element hasn't already been rendered.
                        // TODO this feels sloppy - look into merging propChanged and update functions
                        if( !renderer.isPositioned ) {
                            renderer.updatePos();
                        }
                        if( renderer.needsUpdate() ) {
                            renderer.updateProps();
                        }
                    }
                    unlockAll();
                }
                else if( !initializing ) {
                    init();
                }
            }
        }


        function addHoverClass() {
            el.className += hoverClass;
        }

        function removeHoverClass() {
            el.className = el.className.replace( hoverClassRE, '' );
        }

        /**
         * Handle mouseenter events. Adds a custom class to the element to allow IE6 to add
         * hover styles to non-link elements, and to trigger a propertychange update.
         */
        function mouseEntered() {
            //must delay this because the mouseenter event fires before the :hover styles are added.
            setTimeout( addHoverClass, 0 );
        }

        /**
         * Handle mouseleave events
         */
        function mouseLeft() {
            //must delay this because the mouseleave event fires before the :hover styles are removed.
            setTimeout( removeHoverClass, 0 );
        }


        /**
         * Handle property changes on ancestors of the element; see initAncestorPropChangeListeners()
         * which adds these listeners as requested with the -pie-watch-ancestors CSS property.
         */
        function ancestorPropChanged() {
            var name = event.propertyName;
            if( name === 'className' || name === 'id' ) {
                propChanged();
            }
        }

        function lockAll() {
            boundsInfo.lock();
            for( var i = styleInfosArr.length; i--; ) {
                styleInfosArr[i].lock();
            }
        }

        function unlockAll() {
            for( var i = styleInfosArr.length; i--; ) {
                styleInfosArr[i].unlock();
            }
            boundsInfo.unlock();
        }


        /**
         * Remove all event listeners from the element and any monitoried ancestors.
         */
        function removeEventListeners() {
            if (eventsAttached) {
                if( ancestors ) {
                    for( var i = 0, len = ancestors.length, a; i < len; i++ ) {
                        a = ancestors[i];
                        removeListener( a, 'onpropertychange', ancestorPropChanged );
                        removeListener( a, 'onmouseenter', mouseEntered );
                        removeListener( a, 'onmouseleave', mouseLeft );
                    }
                }

                // Remove event listeners
                removeListener( el, 'onmove', update );
                removeListener( el, 'onresize', update );
                removeListener( el, 'onpropertychange', propChanged );
                removeListener( el, 'onmouseenter', mouseEntered );
                removeListener( el, 'onmouseleave', mouseLeft );

                PIE.OnBeforeUnload.unobserve( removeEventListeners );
                eventsAttached = 0;
            }
        }


        /**
         * Clean everything up when the behavior is removed from the element, or the element
         * is manually destroyed.
         */
        function destroy() {
            if( !destroyed ) {
                var i, len;

                removeEventListeners();

                destroyed = 1;

                // destroy any active renderers
                if( renderers ) {
                    for( i = 0, len = renderers.length; i < len; i++ ) {
                        renderers[i].destroy();
                    }
                }

                // Remove from list of polled elements in IE8
                if( PIE.ie8DocMode === 8 ) {
                    PIE.Heartbeat.unobserve( update );
                }
                // Stop onresize listening
                PIE.OnResize.unobserve( update );

                // Kill references
                renderers = boundsInfo = styleInfos = styleInfosArr = ancestors = el = null;
            }
        }


        /**
         * If requested via the custom -pie-watch-ancestors CSS property, add onpropertychange listeners
         * to ancestor(s) of the element so we can pick up style changes based on CSS rules using
         * descendant selectors.
         */
        function initAncestorPropChangeListeners() {
            var watch = el.currentStyle.getAttribute( PIE.CSS_PREFIX + 'watch-ancestors' ),
                i, a;
            if( watch ) {
                ancestors = [];
                watch = parseInt( watch, 10 );
                i = 0;
                a = el.parentNode;
                while( a && ( watch === 'NaN' || i++ < watch ) ) {
                    ancestors.push( a );
                    addListener( a, 'onpropertychange', ancestorPropChanged );
                    addListener( a, 'onmouseenter', mouseEntered );
                    addListener( a, 'onmouseleave', mouseLeft );
                    a = a.parentNode;
                }
            }
        }


        /**
         * If the target element is a first child, add a pie_first-child class to it. This allows using
         * the added class as a workaround for the fact that PIE's rendering element breaks the :first-child
         * pseudo-class selector.
         */
        function initFirstChildPseudoClass() {
            var tmpEl = el,
                isFirst = 1;
            while( tmpEl = tmpEl.previousSibling ) {
                if( tmpEl.nodeType === 1 ) {
                    isFirst = 0;
                    break;
                }
            }
            if( isFirst ) {
                el.className += ' ' + PIE.CLASS_PREFIX + 'first-child';
            }
        }


        // These methods are all already bound to this instance so there's no need to wrap them
        // in a closure to maintain the 'this' scope object when calling them.
        this.init = init;
        this.update = update;
        this.destroy = destroy;
        this.el = el;
    }

    Element.getInstance = function( el ) {
        var id = PIE.Util.getUID( el );
        return wrappers[ id ] || ( wrappers[ id ] = new Element( el ) );
    };

    Element.destroy = function( el ) {
        var id = PIE.Util.getUID( el ),
            wrapper = wrappers[ id ];
        if( wrapper ) {
            wrapper.destroy();
            delete wrappers[ id ];
        }
    };

    Element.destroyAll = function() {
        var els = [], wrapper;
        if( wrappers ) {
            for( var w in wrappers ) {
                if( wrappers.hasOwnProperty( w ) ) {
                    wrapper = wrappers[ w ];
                    els.push( wrapper.el );
                    wrapper.destroy();
                }
            }
            wrappers = {};
        }
        return els;
    };

    return Element;
})();

/*
 * This file exposes the public API for invoking PIE.
 */


/**
 * Programatically attach PIE to a single element.
 * @param {Element} el
 */
PIE[ 'attach' ] = function( el ) {
    if (PIE.ieVersion < 9) {
        PIE.Element.getInstance( el ).init();
    }
};


/**
 * Programatically detach PIE from a single element.
 * @param {Element} el
 */
PIE[ 'detach' ] = function( el ) {
    PIE.Element.destroy( el );
};


} // if( !PIE )
})();