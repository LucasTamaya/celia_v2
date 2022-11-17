var grid = document.querySelector('.grid');
var msnry = new Masonry( grid, {
  itemSelector: '.grid-item',
  columnWidth: '.grid-sizer',
  percentPosition: true
});

/*grid.addEventListener( 'click', function( event ) {
  // don't proceed if item content was not clicked on
  if ( !matchesSelector( event.target, '.grid-item-content' )  ) {
    return;
  }
  var itemContent = event.target;
  setItemContentPixelSize( itemContent );

  var itemElem = itemContent.parentNode;
  itemElem.classList.toggle('is-expanded');

  // force redraw
  var redraw = itemContent.offsetWidth;
  // renable default transition
  itemContent.style[ transitionProp ] = '';

  addTransitionListener( itemContent );
  setItemContentTransitionSize( itemContent, itemElem );

  msnry.layout();
});

var docElem = document.documentElement;
var transitionProp = typeof docElem.style.transition == 'string' ?
    'transition' : 'WebkitTransition';
var transitionEndEvent = {
  WebkitTransition: 'webkitTransitionEnd',
  transition: 'transitionend'
}[ transitionProp ];

function setItemContentPixelSize( itemContent ) {
  var previousContentSize = getSize( itemContent );
  // disable transition
  itemContent.style[ transitionProp ] = 'none';
  // set current size in pixels
  itemContent.style.width = previousContentSize.width + 'px';
  itemContent.style.height = previousContentSize.height + 'px';
}

function addTransitionListener( itemContent ) {
  // reset 100%/100% sizing after transition end
  var onTransitionEnd = function() {
    itemContent.style.width = '';
    itemContent.style.height = '';
    itemContent.removeEventListener( transitionEndEvent, onTransitionEnd, false );
  };
  itemContent.addEventListener( transitionEndEvent, onTransitionEnd, false );
}

function setItemContentTransitionSize( itemContent, itemElem ) {
  // set new size
  var size = getSize( itemElem );
  itemContent.style.width = size.width + 'px';
  itemContent.style.height = size.height + 'px';
}*/
