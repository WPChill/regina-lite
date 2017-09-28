( function( $ ) {// jscs:ignore validateLineBreaks

    /* Multi-level panels in customizer */

    var api = wp.customize;

    // Sections & Panels for section highlight
    var secitonsHighlighted = [ 'regina_lite_hero_panel', 'regina_lite_speak_general', 'regina_lite_news_general' ];
    var panelsHighlighted = [ 'regina_lite_features_panel', 'regina_lite_ourteam_panel', 'regina_lite_testimonials_panel' ];

    // Extend Panel
    var _panelEmbed = wp.customize.Panel.prototype.embed;
    var _panelIsContextuallyActive = wp.customize.Panel.prototype.isContextuallyActive;
    var _panelAttachEvents = wp.customize.Panel.prototype.attachEvents;

    api.bind( 'pane-contents-reflowed', function() {

        // Reflow panels
        var panels = {};

        api.panel.each( function( panel ) {

            if ( 'regina_panel' !== panel.params.type || 'undefined' === typeof panel.params.panel ) {
                return;
            }

            if ( undefined === panels[ panel.params.panel ] ) {
                panels[ panel.params.panel ] = [];
            }

            panels[ panel.params.panel ].push( panel );

        });

        

        $.each( panels, function( parentID, children ) {
            var sections = api.panel( parentID ).sections(),
                newElements;

            if ( sections.length > 0 ) {
                newElements = children.concat( sections );
            }else{
                newElements = children;
            }

            newElements.sort( api.utils.prioritySort ).reverse();
            $.each( newElements, function( i, panel ) {

                var parentContainer = $( '#sub-accordion-panel-' + panel.params.panel );
                parentContainer.children( '.panel-meta' ).after( panel.headContainer );

            });

        });

    });

    wp.customize.Panel = wp.customize.Panel.extend({
        attachEvents: function() {
            var panel = this;
            if (
                'regina_panel' !== this.params.type ||
                'undefined' === typeof this.params.panel
            ) {

                _panelAttachEvents.call( this );

                return;

            }

            _panelAttachEvents.call( this );

            panel.expanded.bind( function( expanded ) {

                var parent = api.panel( panel.params.panel );

                if ( expanded ) {

                    parent.contentContainer.addClass( 'current-panel-parent' );

                } else {

                    parent.contentContainer.removeClass( 'current-panel-parent' );

                }

            });

            panel.container.find( '.customize-panel-back' )
                .off( 'click keydown' )
                .on( 'click keydown', function( event ) {

                    if ( api.utils.isKeydownButNotEnterEvent( event ) ) {

                        return;

                    }

                    event.preventDefault(); // Keep this AFTER the key filter above

                    if ( panel.expanded() ) {

                        api.panel( panel.params.panel ).expand();

                    }

                });

        },
        embed: function() {
            var panel = this;
            var parentContainer = $( '#sub-accordion-panel-' + this.params.panel );

            if (
                'regina_panel' !== this.params.type ||
                'undefined' === typeof this.params.panel
            ) {

                _panelEmbed.call( this );

                return;

            }

            _panelEmbed.call( this );

            parentContainer.append( panel.headContainer );

        },
        isContextuallyActive: function() {
            var panel = this;
            var children = this._children( 'panel', 'section' );
            var activeCount = 0;

            if (
                'regina_panel' !== this.params.type
            ) {

                return _panelIsContextuallyActive.call( this );

            }

            api.panel.each( function( child ) {

                if ( ! child.params.panel ) {

                    return;

                }

                if ( child.params.panel !== panel.id ) {

                    return;

                }

                children.push( child );

            });

            children.sort( api.utils.prioritySort );

            _( children ).each( function( child ) {

                if ( child.active() && child.isContextuallyActive() ) {

                    activeCount += 1;

                }

            });

            return ( 0 !== activeCount );

        }

    });

    // Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
    $.each( secitonsHighlighted, function ( index, section ){
        api.section( section, function( section ) {
            section.expanded.bind( function( isExpanding ) {

                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                api.previewer.send( 'section-highlight', { expanded: isExpanding, section: section.id });
            } );
        } );
    });

    $.each( panelsHighlighted, function ( index, panel ){
        api.panel( panel, function( panel ) {
            panel.expanded.bind( function( isExpanding ) {

                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                api.previewer.send( 'section-highlight', { expanded: isExpanding, section: panel.id });
            } );
        } );
    });

    // Redirect previewer to single post
    api.section( 'regina_lite_single_post_section', function( section ) {
        section.expanded.bind( function( isExpanding ) {
            var newURL = ReginaCustomizer.postURL;
            if ( isExpanding ) {
                if ( ! $.inArray( newURL, api.previewer.allowedUrls ) ) {
                    api.previewer.allowedUrls.push( newURL );
                }
                wp.customize.previewer.previewUrl.set( newURL );
            }else{
                wp.customize.previewer.previewUrl.set( ReginaCustomizer.siteURL );
            }

        } );
    } );

    /**
    * Regina Section Upsell Constructor
    */
    wp.customize.sectionConstructor[ 'regina-section-upsell' ] = wp.customize.Section.extend( {
        attachEvents: function() {},
        isContextuallyActive: function() {
            return true;
        },
        ready: function() {
            var section = this;
            section.container.on( 'click', '.epsilon-upsell-label', function( e ) {
                e.preventDefault();
                jQuery( this ).toggleClass( 'opened' ).find('i').toggleClass('dashicons-arrow-down-alt2 dashicons-arrow-up-alt2');
                section.container.find( '.epsilon-upsell-container' ).slideToggle( 200 );
            } );
        }
    } );

})( jQuery );
