<script>
export default {
    name: "MainNavigation",
    data() {
        return {
        };
    },
    render() {
      return this.$slots.default
    },
    mounted() {
        ( function() {
          var container, button, menu, links, i, len;
          debugger;
          container = document.getElementById( 'site-navigation' );
          if ( ! container ) {
            return;
          }

          button = document.querySelector( '[data-menu]' );
          if ( 'undefined' === typeof button ) {
            return;
          }

          menu = container.getElementsByTagName( 'ul' )[0];

          // Hide menu toggle button if menu is empty and return early.
          if ( 'undefined' === typeof menu ) {
            button.style.display = 'none';
            return;
          }

          if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
            menu.className += ' nav-menu';
          }

          function toggleMenuContainer() {
            if ( -1 !== container.className.indexOf( 'toggled' ) ) {
              container.className = container.className.replace( ' toggled', '' );
              button.setAttribute( 'aria-expanded', 'false' );
              button.classList.remove('active');
            } else {
              container.className += ' toggled';
              button.setAttribute( 'aria-expanded', 'true' );
              button.classList.add('active');
            }
          }

          button.onclick = function() {
            toggleMenuContainer();
          };

          // Get all the link elements within the menu.
          links = menu.getElementsByTagName( 'a' );

          // Each time a menu link is focused or blurred, toggle focus.
          for ( i = 0, len = links.length; i < len; i++ ) {
            links[i].addEventListener( 'focus', toggleFocus, true );
            links[i].addEventListener( 'blur', toggleFocus, true );
            links[i].addEventListener('click', toggleMenuContainer, true)
          }

          /**
           * Sets or removes .focus class on an element.
           */
          function toggleFocus() {
            var self = this;

            // Move up through the ancestors of the current link until we hit .nav-menu.
            while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
              // On li elements toggle the class .focus.
              if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'focus' ) ) {
                  self.className = self.className.replace( ' focus', '' );
                } else {
                  self.className += ' focus';
                }
              }

              self = self.parentElement;
            }
          }

          /**
           * Toggles `focus` class to allow submenu access on tablets.
           */
          ( function(container) {
            var touchStartFn,
              parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

            if ( 'ontouchstart' in window ) {
              touchStartFn = function( e ) {
                var menuItem = this.parentNode;

                if ( ! menuItem.classList.contains( 'focus' ) ) {
                  e.preventDefault();
                  for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
                    if ( menuItem === menuItem.parentNode.children[i] ) {
                      continue;
                    }
                    menuItem.parentNode.children[i].classList.remove( 'focus' );
                  }
                  menuItem.classList.add( 'focus' );
                } else {
                  menuItem.classList.remove( 'focus' );
                }
              };

              for ( i = 0; i < parentLink.length; ++i ) {
                parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
              }
            }
          }( container ) );
        }() );
    }
}
</script>