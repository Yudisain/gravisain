/**
 * Customizer Live Preview JS
 * 
 * Handles real-time updates in the Customizer iframe.
 */
(function($, wp) {
    'use strict';

    if ( ! wp || ! wp.customize ) {
        return;
    }

    // 0. Background Colors Live Preview
    wp.customize('gravisain_site_background', function(setting) {
        setting.bind(function(val) {
            var color = val ? val : 'var(--gravisain-global-color-6)';
            $('body').each(function() {
                this.style.setProperty('background-color', color, 'important');
            });
        });
    });

    wp.customize('gravisain_content_background', function(setting) {
        setting.bind(function(val) {
            var color = val ? val : 'var(--gravisain-global-color-5)';
            document.documentElement.style.setProperty('--gravisain-content-bg', color);
        });
    });

    // 1. Show Site Title Live Preview
    wp.customize('gravisain_show_site_title', function(setting) {
        setting.bind(function(val) {
            if ( val ) {
                $('.site-title').css('display', '');
            } else {
                $('.site-title').css('display', 'none');
            }
        });
    });

    // 2. Site Title Visibility Live Preview
    wp.customize('gravisain_site_title_visibility', function(setting) {
        setting.bind(function(val) {
            var $title = $('.site-title');
            $title.removeClass('gravisain-hide-desktop gravisain-hide-tablet gravisain-hide-mobile');
            
            var devices = (typeof val === 'string' && val !== '') ? val.split(',') : (Array.isArray(val) ? val : []);
            if (devices.indexOf('desktop') === -1) {
                $title.addClass('gravisain-hide-desktop');
            }
            if (devices.indexOf('tablet') === -1) {
                $title.addClass('gravisain-hide-tablet');
            }
            if (devices.indexOf('mobile') === -1) {
                $title.addClass('gravisain-hide-mobile');
            }
        });
    });

    // 3. Show Site Tagline Live Preview
    wp.customize('gravisain_show_site_tagline', function(setting) {
        setting.bind(function(val) {
            if ( val ) {
                $('.site-description').css('display', '');
            } else {
                $('.site-description').css('display', 'none');
            }
        });
    });

    // 4. Site Tagline Visibility Live Preview
    wp.customize('gravisain_site_tagline_visibility', function(setting) {
        setting.bind(function(val) {
            var $tagline = $('.site-description');
            $tagline.removeClass('gravisain-hide-desktop gravisain-hide-tablet gravisain-hide-mobile');
            
            var devices = (typeof val === 'string' && val !== '') ? val.split(',') : (Array.isArray(val) ? val : []);
            if (devices.indexOf('desktop') === -1) {
                $tagline.addClass('gravisain-hide-desktop');
            }
            if (devices.indexOf('tablet') === -1) {
                $tagline.addClass('gravisain-hide-tablet');
            }
            if (devices.indexOf('mobile') === -1) {
                $tagline.addClass('gravisain-hide-mobile');
            }
        });
    });

    // 5. Logo Width Live Preview (Responsive)
    wp.customize('gravisain_logo_width', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-logo-width-preview-css');
            
            // Create a dedicated style tag for this setting if it doesn't exist
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-logo-width-preview-css"></style>').appendTo('head');
            }
            
            if ( val ) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.charAt(0) === '{') {
                        obj = JSON.parse(val);
                    } else if (typeof val === 'object' && val !== null) {
                        obj = val;
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }
                
                var css = '';
                if (obj.desktop) {
                    css += '.site-branding img.custom-logo { max-width: ' + obj.desktop + ' !important; width: 100%; height: auto; }\n';
                }
                if (obj.tablet) {
                    css += '@media (max-width: 1024px) { .site-branding img.custom-logo { max-width: ' + obj.tablet + ' !important; } }\n';
                }
                if (obj.mobile) {
                    css += '@media (max-width: 768px) { .site-branding img.custom-logo { max-width: ' + obj.mobile + ' !important; } }\n';
                }
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-0-0. Scroll to Top Position & Side Offset Live Preview
    var updateScrollTopPositionAndSideOffset = function() {
        var pos = wp.customize('gravisain_scroll_top_position') ? wp.customize('gravisain_scroll_top_position').get() : 'right';
        var sideVal = wp.customize('gravisain_scroll_top_side_offset') ? wp.customize('gravisain_scroll_top_side_offset').get() : '{"desktop":"2rem","tablet":"1.5rem","mobile":"1rem"}';
        
        var obj = {};
        try {
            if (typeof sideVal === 'string' && sideVal.indexOf('{') === 0) {
                obj = JSON.parse(sideVal);
            } else {
                obj = { desktop: sideVal };
            }
        } catch(e) {
            obj = { desktop: sideVal };
        }

        var css = '';
        var sideProp = (pos === 'left') ? 'left' : 'right';
        var oppositeProp = (pos === 'left') ? 'right' : 'left';

        if (obj.desktop !== undefined && obj.desktop !== '') {
            var deskVal = (!isNaN(obj.desktop) && obj.desktop.toString().trim() !== '') ? obj.desktop + 'px' : obj.desktop;
            css += '.gravisain-scroll-top { ' + sideProp + ': ' + deskVal + ' !important; ' + oppositeProp + ': auto !important; }\n';
        } else {
            css += '.gravisain-scroll-top { ' + sideProp + ': 2rem !important; ' + oppositeProp + ': auto !important; }\n';
        }
        if (obj.tablet !== undefined && obj.tablet !== '') {
            var tabVal = (!isNaN(obj.tablet) && obj.tablet.toString().trim() !== '') ? obj.tablet + 'px' : obj.tablet;
            css += '@media (max-width: 1024px) { .gravisain-scroll-top { ' + sideProp + ': ' + tabVal + ' !important; ' + oppositeProp + ': auto !important; } }\n';
        }
        if (obj.mobile !== undefined && obj.mobile !== '') {
            var mobVal = (!isNaN(obj.mobile) && obj.mobile.toString().trim() !== '') ? obj.mobile + 'px' : obj.mobile;
            css += '@media (max-width: 719px) { .gravisain-scroll-top { ' + sideProp + ': ' + mobVal + ' !important; ' + oppositeProp + ': auto !important; } }\n';
        }

        var $style = $('#gravisain-scroll-top-side-preview-css');
        if ( ! $style.length ) {
            $style = $('<style id="gravisain-scroll-top-side-preview-css"></style>').appendTo('head');
        }
        $style.html(css);
    };

    wp.customize('gravisain_scroll_top_position', function(setting) {
        setting.bind(function() {
            updateScrollTopPositionAndSideOffset();
        });
    });

    wp.customize('gravisain_scroll_top_side_offset', function(setting) {
        setting.bind(function() {
            updateScrollTopPositionAndSideOffset();
        });
    });

    // 5-0-1. Scroll to Top Bottom Offset Live Preview
    wp.customize('gravisain_scroll_top_bottom_offset', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-scroll-top-bottom-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-scroll-top-bottom-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.indexOf('{') === 0) {
                        obj = JSON.parse(val);
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }

                var css = '';
                if (obj.desktop !== undefined && obj.desktop !== '') {
                    var deskVal = (!isNaN(obj.desktop) && obj.desktop.toString().trim() !== '') ? obj.desktop + 'px' : obj.desktop;
                    css += '.gravisain-scroll-top { bottom: ' + deskVal + ' !important; }\n';
                }
                if (obj.tablet !== undefined && obj.tablet !== '') {
                    var tabVal = (!isNaN(obj.tablet) && obj.tablet.toString().trim() !== '') ? obj.tablet + 'px' : obj.tablet;
                    css += '@media (max-width: 1024px) { .gravisain-scroll-top { bottom: ' + tabVal + ' !important; } }\n';
                }
                if (obj.mobile !== undefined && obj.mobile !== '') {
                    var mobVal = (!isNaN(obj.mobile) && obj.mobile.toString().trim() !== '') ? obj.mobile + 'px' : obj.mobile;
                    css += '@media (max-width: 719px) { .gravisain-scroll-top { bottom: ' + mobVal + ' !important; } }\n';
                }
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });


    // 5-0. Scroll to Top Icon Size Live Preview (Responsive)
    wp.customize('gravisain_scroll_top_icon_size', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-scroll-top-icon-size-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-scroll-top-icon-size-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.charAt(0) === '{') {
                        obj = JSON.parse(val);
                    } else if (typeof val === 'object' && val !== null) {
                        obj = val;
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }

                var css = '';
                if (obj.desktop) {
                    var deskVal = (!isNaN(obj.desktop) && obj.desktop.toString().trim() !== '') ? obj.desktop + 'px' : obj.desktop;
                    css += '.gravisain-scroll-top { width: calc(' + deskVal + ' * 2.444) !important; height: calc(' + deskVal + ' * 2.444) !important; }\n';
                    css += '.gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon { width: ' + deskVal + ' !important; height: ' + deskVal + ' !important; font-size: ' + deskVal + ' !important; }\n';
                }
                if (obj.tablet) {
                    var tabVal = (!isNaN(obj.tablet) && obj.tablet.toString().trim() !== '') ? obj.tablet + 'px' : obj.tablet;
                    css += '@media (max-width: 1024px) { .gravisain-scroll-top { width: calc(' + tabVal + ' * 2.444) !important; height: calc(' + tabVal + ' * 2.444) !important; } .gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon { width: ' + tabVal + ' !important; height: ' + tabVal + ' !important; font-size: ' + tabVal + ' !important; } }\n';
                }
                if (obj.mobile) {
                    var mobVal = (!isNaN(obj.mobile) && obj.mobile.toString().trim() !== '') ? obj.mobile + 'px' : obj.mobile;
                    css += '@media (max-width: 719px) { .gravisain-scroll-top { width: calc(' + mobVal + ' * 2.444) !important; height: calc(' + mobVal + ' * 2.444) !important; } .gravisain-scroll-top .scroll-icon svg, .gravisain-scroll-top .scroll-icon i, .gravisain-scroll-top .scroll-icon { width: ' + mobVal + ' !important; height: ' + mobVal + ' !important; font-size: ' + mobVal + ' !important; } }\n';
                }
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-1. Site Title Typography Live Preview
    wp.customize('gravisain_site_title_typography', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-site-title-typo-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-site-title-typo-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    obj = (typeof val === 'string' && val.charAt(0) === '{') ? JSON.parse(val) : (typeof val === 'object' && val !== null ? val : {});
                } catch (e) { obj = {}; }
                
                var css = '.site-header .site-header-row .site-branding .site-title, .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn), .has-transparent-header .site-header .site-title a:not(.gravisain-btn), .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title a:not(.gravisain-btn), .site-title, .site-title a {';
                if (obj.family && obj.family !== 'inherit') {
                    var fam = obj.family;
                    if (fam === 'system-stack') {
                        fam = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
                    } else if (fam.indexOf(',') === -1 && fam.indexOf('"') === -1) {
                        fam = '"' + fam + '", sans-serif';
                    }
                    css += ' font-family: ' + fam + ' !important;';
                }
                if (obj.style) {
                    var st = obj.style;
                    if (st.indexOf('italic') !== -1) { css += ' font-style: italic !important;'; } else { css += ' font-style: normal !important;'; }
                    var numMatch = st.match(/\d+/);
                    if (numMatch) { css += ' font-weight: ' + numMatch[0] + ' !important;'; }
                    else if (st === 'bold' || st === 'bold italic') { css += ' font-weight: 700 !important;'; }
                    else { css += ' font-weight: 400 !important;'; }
                }
                if (obj.size !== undefined && obj.size !== '') {
                    var sz = !isNaN(obj.size) ? obj.size + 'px' : obj.size;
                    css += ' font-size: ' + sz + ' !important;';
                }
                if (obj.line_height !== undefined && obj.line_height !== '') {
                    css += ' line-height: ' + obj.line_height + ' !important;';
                }
                if (obj.spacing !== undefined && obj.spacing !== '') {
                    var sp = !isNaN(obj.spacing) ? obj.spacing + 'px' : obj.spacing;
                    css += ' letter-spacing: ' + sp + ' !important;';
                }
                css += ' }';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-2. Site Title Colors Live Preview
    wp.customize('gravisain_site_title_colors', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-site-title-colors-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-site-title-colors-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    obj = (typeof val === 'string' && val.charAt(0) === '{') ? JSON.parse(val) : (typeof val === 'object' && val !== null ? val : {});
                } catch (e) { obj = {}; }
                
                var css = '';
                var title_sel = '.site-header .site-header-row .site-branding .site-title, .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn), .has-transparent-header .site-header .site-title a:not(.gravisain-btn), .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title a:not(.gravisain-btn), #masthead .site-title, #masthead .site-title a';
                var hover_sel = '.site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):hover, .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):focus, .has-transparent-header .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-title a:not(.gravisain-btn):hover, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title a:not(.gravisain-btn):hover, #masthead .site-title a:hover, #masthead .site-title a:focus';
                var active_sel = '.site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):active, .has-transparent-header .site-header .site-header-row .site-branding .site-title a:not(.gravisain-btn):active, .has-transparent-header .site-header .site-title a:not(.gravisain-btn):active, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title a:not(.gravisain-btn):active, #masthead .site-title a:active';

                if (obj.initial) {
                    css += title_sel + ' { color: ' + obj.initial + ' !important; }\n';
                }
                if (obj.hover) {
                    css += hover_sel + ' { color: ' + obj.hover + ' !important; }\n';
                }
                if (obj.active) {
                    css += active_sel + ' { color: ' + obj.active + ' !important; }\n';
                }
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-3. Site Title Margin Live Preview
    wp.customize('gravisain_site_title_margin', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-site-title-margin-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-site-title-margin-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    obj = (typeof val === 'string' && val.charAt(0) === '{') ? JSON.parse(val) : (typeof val === 'object' && val !== null ? val : {});
                } catch (e) { obj = {}; }
                
                var unit = obj.unit || 'px';
                var title_box_sel = '.site-header .site-header-row .site-branding .site-title, .has-transparent-header .site-header .site-header-row .site-branding .site-title, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title, #masthead .site-title';
                var css = title_box_sel + ' {';
                if (obj.top !== undefined && obj.top !== '') { css += ' margin-top: ' + obj.top + unit + ' !important;'; }
                if (obj.right !== undefined && obj.right !== '') { css += ' margin-right: ' + obj.right + unit + ' !important;'; }
                if (obj.bottom !== undefined && obj.bottom !== '') { css += ' margin-bottom: ' + obj.bottom + unit + ' !important;'; }
                if (obj.left !== undefined && obj.left !== '') { css += ' margin-left: ' + obj.left + unit + ' !important;'; }
                css += ' }';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-4. Site Title Padding Live Preview
    wp.customize('gravisain_site_title_padding', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-site-title-padding-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-site-title-padding-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    obj = (typeof val === 'string' && val.charAt(0) === '{') ? JSON.parse(val) : (typeof val === 'object' && val !== null ? val : {});
                } catch (e) { obj = {}; }
                
                var unit = obj.unit || 'px';
                var title_box_sel = '.site-header .site-header-row .site-branding .site-title, .has-transparent-header .site-header .site-header-row .site-branding .site-title, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-title, #masthead .site-title';
                var css = title_box_sel + ' {';
                if (obj.top !== undefined && obj.top !== '') { css += ' padding-top: ' + obj.top + unit + ' !important;'; }
                if (obj.right !== undefined && obj.right !== '') { css += ' padding-right: ' + obj.right + unit + ' !important;'; }
                if (obj.bottom !== undefined && obj.bottom !== '') { css += ' padding-bottom: ' + obj.bottom + unit + ' !important;'; }
                if (obj.left !== undefined && obj.left !== '') { css += ' padding-left: ' + obj.left + unit + ' !important;'; }
                css += ' }';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-5. Site Tagline Typography Live Preview
    wp.customize('gravisain_site_tagline_typography', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-site-tagline-typo-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-site-tagline-typo-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    obj = (typeof val === 'string' && val.charAt(0) === '{') ? JSON.parse(val) : (typeof val === 'object' && val !== null ? val : {});
                } catch (e) { obj = {}; }
                
                var css = '.site-header .site-header-row .site-branding .site-description, .has-transparent-header .site-header .site-header-row .site-branding .site-description, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-description, .site-description {';
                if (obj.family && obj.family !== 'inherit') {
                    var fam = obj.family;
                    if (fam === 'system-stack') {
                        fam = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
                    } else if (fam.indexOf(',') === -1 && fam.indexOf('"') === -1) {
                        fam = '"' + fam + '", sans-serif';
                    }
                    css += ' font-family: ' + fam + ' !important;';
                }
                if (obj.style) {
                    var st = obj.style;
                    if (st.indexOf('italic') !== -1) { css += ' font-style: italic !important;'; } else { css += ' font-style: normal !important;'; }
                    var numMatch = st.match(/\d+/);
                    if (numMatch) { css += ' font-weight: ' + numMatch[0] + ' !important;'; }
                    else if (st === 'bold' || st === 'bold italic') { css += ' font-weight: 700 !important;'; }
                    else { css += ' font-weight: 400 !important;'; }
                }
                if (obj.size !== undefined && obj.size !== '') {
                    var sz = !isNaN(obj.size) ? obj.size + 'px' : obj.size;
                    css += ' font-size: ' + sz + ' !important;';
                }
                if (obj.line_height !== undefined && obj.line_height !== '') {
                    css += ' line-height: ' + obj.line_height + ' !important;';
                }
                if (obj.spacing !== undefined && obj.spacing !== '') {
                    var sp = !isNaN(obj.spacing) ? obj.spacing + 'px' : obj.spacing;
                    css += ' letter-spacing: ' + sp + ' !important;';
                }
                css += ' }';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-6. Site Tagline Colors Live Preview
    wp.customize('gravisain_site_tagline_colors', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-site-tagline-colors-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-site-tagline-colors-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    obj = (typeof val === 'string' && val.charAt(0) === '{') ? JSON.parse(val) : (typeof val === 'object' && val !== null ? val : {});
                } catch (e) { obj = {}; }
                
                var css = '';
                if (obj.initial) {
                    css += '.site-header .site-header-row .site-branding .site-description, .has-transparent-header .site-header .site-header-row .site-branding .site-description, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-description, .site-description { color: ' + obj.initial + ' !important; }\n';
                }
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-7. Site Tagline Margin Live Preview
    wp.customize('gravisain_site_tagline_margin', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-site-tagline-margin-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-site-tagline-margin-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    obj = (typeof val === 'string' && val.charAt(0) === '{') ? JSON.parse(val) : (typeof val === 'object' && val !== null ? val : {});
                } catch (e) { obj = {}; }
                
                var unit = obj.unit || 'px';
                var css = '.site-header .site-header-row .site-branding .site-description, .has-transparent-header .site-header .site-header-row .site-branding .site-description, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-description, .site-description {';
                if (obj.top !== undefined && obj.top !== '') { css += ' margin-top: ' + obj.top + unit + ' !important;'; }
                if (obj.right !== undefined && obj.right !== '') { css += ' margin-right: ' + obj.right + unit + ' !important;'; }
                if (obj.bottom !== undefined && obj.bottom !== '') { css += ' margin-bottom: ' + obj.bottom + unit + ' !important;'; }
                if (obj.left !== undefined && obj.left !== '') { css += ' margin-left: ' + obj.left + unit + ' !important;'; }
                css += ' }';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5-8. Site Tagline Padding Live Preview
    wp.customize('gravisain_site_tagline_padding', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-site-tagline-padding-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-site-tagline-padding-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    obj = (typeof val === 'string' && val.charAt(0) === '{') ? JSON.parse(val) : (typeof val === 'object' && val !== null ? val : {});
                } catch (e) { obj = {}; }
                
                var unit = obj.unit || 'px';
                var css = '.site-header .site-header-row .site-branding .site-description, .has-transparent-header .site-header .site-header-row .site-branding .site-description, .has-sticky-header .site-header.is-sticky .site-header-row .site-branding .site-description, .site-description {';
                if (obj.top !== undefined && obj.top !== '') { css += ' padding-top: ' + obj.top + unit + ' !important;'; }
                if (obj.right !== undefined && obj.right !== '') { css += ' padding-right: ' + obj.right + unit + ' !important;'; }
                if (obj.bottom !== undefined && obj.bottom !== '') { css += ' padding-bottom: ' + obj.bottom + unit + ' !important;'; }
                if (obj.left !== undefined && obj.left !== '') { css += ' padding-left: ' + obj.left + unit + ' !important;'; }
                css += ' }';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5A. Container Max Width Live Preview
    wp.customize('gravisain_content_width', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-container-width-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-container-width-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var width = !isNaN(val) ? val + 'px' : val;
                $style.html(':root { --wp--custom--layout--content-size: ' + width + ' !important; --gravisain-container-width: ' + width + ' !important; } .site-content .container:not(.container-stretched) { max-width: ' + width + ' !important; }');
            } else {
                $style.html('');
            }
        });
    });

    // 5B. Content Top and Bottom Spacing Live Preview (Responsive)
    wp.customize('gravisain_content_spacing_y', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-spacing-y-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-spacing-y-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.charAt(0) === '{') {
                        obj = JSON.parse(val);
                    } else if (typeof val === 'object' && val !== null) {
                        obj = val;
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }
                var getVal = function(v) { return !isNaN(v) && v !== '' ? v + 'px' : v; };
                var css = '';
                if (obj.desktop !== undefined && obj.desktop !== '') css += '.site-content { --gravisain-content-padding-top: ' + getVal(obj.desktop) + ' !important; --gravisain-content-padding-bottom: ' + getVal(obj.desktop) + ' !important; padding-top: ' + getVal(obj.desktop) + ' !important; padding-bottom: ' + getVal(obj.desktop) + ' !important; }\n';
                if (obj.tablet !== undefined && obj.tablet !== '')  css += '@media (max-width: 1024px) { .site-content { --gravisain-content-padding-top: ' + getVal(obj.tablet) + ' !important; --gravisain-content-padding-bottom: ' + getVal(obj.tablet) + ' !important; padding-top: ' + getVal(obj.tablet) + ' !important; padding-bottom: ' + getVal(obj.tablet) + ' !important; } }\n';
                if (obj.mobile !== undefined && obj.mobile !== '')  css += '@media (max-width: 719px) { .site-content { --gravisain-content-padding-top: ' + getVal(obj.mobile) + ' !important; --gravisain-content-padding-bottom: ' + getVal(obj.mobile) + ' !important; padding-top: ' + getVal(obj.mobile) + ' !important; padding-bottom: ' + getVal(obj.mobile) + ' !important; } }\n';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5B-2. Primary Navigation Spacing Live Preview (Responsive)
    wp.customize('gravisain_header_primary_nav_spacing', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-primary-nav-spacing-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-primary-nav-spacing-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.charAt(0) === '{') {
                        obj = JSON.parse(val);
                    } else if (typeof val === 'object' && val !== null) {
                        obj = val;
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }
                var getVal = function(v) { return !isNaN(v) && v !== '' ? v + 'px' : v; };
                var css = '';
                if (obj.desktop !== undefined && obj.desktop !== '') css += '.main-navigation ul { gap: ' + getVal(obj.desktop) + ' !important; }\n';
                if (obj.tablet !== undefined && obj.tablet !== '')  css += '@media (max-width: 1024px) { .main-navigation ul { gap: ' + getVal(obj.tablet) + ' !important; } }\n';
                if (obj.mobile !== undefined && obj.mobile !== '')  css += '@media (max-width: 719px) { .main-navigation ul { gap: ' + getVal(obj.mobile) + ' !important; } }\n';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5B-3A. Primary Navigation Stretch - Live Preview
    function applyPrimaryNavStretchPreview() {
        var stretchVal = wp.customize('gravisain_header_primary_nav_stretch') ? wp.customize('gravisain_header_primary_nav_stretch').get() : false;
        var isStretch  = (stretchVal === true || stretchVal === 'true' || stretchVal === 1 || stretchVal === '1');

        var fillVal    = wp.customize('gravisain_header_primary_nav_fill_center') ? wp.customize('gravisain_header_primary_nav_fill_center').get() : false;
        var isFillCenter = (fillVal === true || fillVal === 'true' || fillVal === 1 || fillVal === '1');

        var $style = $('#gravisain-primary-nav-stretch-preview-css');
        if ( ! $style.length ) {
            $style = $('<style id="gravisain-primary-nav-stretch-preview-css"></style>').appendTo('head');
        }
        var css = '';
        if ( isStretch ) {
            css += '.col-left:has(.main-navigation), .col-center:has(.main-navigation), .col-right:has(.main-navigation) { flex: 1 1 0% !important; }\n';
            css += '.ghb-component.main-navigation { flex: 1 1 0% !important; width: 100% !important; min-width: 0 !important; max-width: 100% !important; display: flex !important; }\n';
            css += '.main-navigation div { width: 100% !important; min-width: 0 !important; max-width: 100% !important; display: flex !important; }\n';
            css += '.main-navigation ul { width: 100% !important; min-width: 0 !important; max-width: 100% !important; flex-wrap: wrap !important; }\n';
            if ( isFillCenter ) {
                css += '.main-navigation ul { justify-content: center !important; }\n';
                css += '.main-navigation ul > li { flex: 1 1 auto !important; text-align: center !important; }\n';
                css += '.main-navigation ul > li > a { justify-content: center !important; text-align: center !important; }\n';
            } else {
                css += '.main-navigation ul { justify-content: space-between !important; }\n';
                css += '.main-navigation ul > li { flex: 0 1 auto !important; text-align: left !important; }\n';
                css += '.main-navigation ul > li > a { justify-content: flex-start !important; text-align: left !important; }\n';
            }
        } else {
            $style.html('');
            return;
        }
        $style.html(css);
    }

    wp.customize('gravisain_header_primary_nav_stretch', function(setting) {
        setting.bind(function() {
            applyPrimaryNavStretchPreview();
        });
    });

    wp.customize('gravisain_header_primary_nav_fill_center', function(setting) {
        setting.bind(function() {
            applyPrimaryNavStretchPreview();
        });
    });

// 5B-2b. Primary Navigation Design Options Live Preview (Colors, Background, Font)
    var applyPrimaryNavDesignPreview = function() {
        var $style = $('#gravisain-primary-nav-design-preview-css');
        if ( ! $style.length ) {
            $style = $('<style id="gravisain-primary-nav-design-preview-css"></style>').appendTo('head');
        }
        var css = '';

        // Colors
        var colorVal = wp.customize('gravisain_header_primary_nav_colors') ? wp.customize('gravisain_header_primary_nav_colors').get() : null;
        var colors = {};
        try { if (typeof colorVal === 'string') colors = JSON.parse(colorVal) || {}; else if (typeof colorVal === 'object') colors = colorVal || {}; } catch(e) {}
        if (colors.initial) css += '.site-header .site-header-row .main-navigation a:not(.gravisain-btn), .site-header .site-header-row .main-navigation ul li a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation ul li a:not(.gravisain-btn), .has-sticky-header .site-header.is-sticky .site-header-row .main-navigation a:not(.gravisain-btn), .main-navigation a, .main-navigation ul li a { color: ' + colors.initial + ' !important; }\n';
        if (colors.hover)   css += '.site-header .site-header-row .main-navigation a:not(.gravisain-btn):hover, .site-header .site-header-row .main-navigation ul li a:not(.gravisain-btn):hover, .site-header .site-header-row .main-navigation li:hover > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-header-row .main-navigation ul li a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-header-row .main-navigation li:hover > a:not(.gravisain-btn), .main-navigation a:hover, .main-navigation ul li a:hover, .main-navigation li:hover > a { color: ' + colors.hover + ' !important; }\n';
        if (colors.active)  css += '.site-header .site-header-row .main-navigation li.current-menu-item > a:not(.gravisain-btn), .site-header .site-header-row .main-navigation li.current-menu-ancestor > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation li.current-menu-item > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .main-navigation li.current-menu-ancestor > a:not(.gravisain-btn), .main-navigation li.current-menu-item > a, .main-navigation li.current-menu-ancestor > a { color: ' + colors.active + ' !important; }\n';

        // Background
        var bgVal = wp.customize('gravisain_header_primary_nav_background') ? wp.customize('gravisain_header_primary_nav_background').get() : null;
        var bgs = {};
        try { if (typeof bgVal === 'string') bgs = JSON.parse(bgVal) || {}; else if (typeof bgVal === 'object') bgs = bgVal || {}; } catch(e) {}
        if (bgs.initial) css += '.main-navigation a, .main-navigation ul li a { background-color: ' + bgs.initial + ' !important; padding: 8px 14px !important; border-radius: 4px !important; }\n';
        if (bgs.hover)   css += '.main-navigation a:hover, .main-navigation ul li a:hover, .main-navigation li:hover > a { background-color: ' + bgs.hover + ' !important; padding: 8px 14px !important; border-radius: 4px !important; }\n';
        if (bgs.active)  css += '.main-navigation li.current-menu-item > a, .main-navigation li.current-menu-ancestor > a { background-color: ' + bgs.active + ' !important; padding: 8px 14px !important; border-radius: 4px !important; }\n';

        // Font
        var fontVal = wp.customize('gravisain_header_primary_nav_font') ? wp.customize('gravisain_header_primary_nav_font').get() : null;
        var fonts = {};
        try { if (typeof fontVal === 'string') fonts = JSON.parse(fontVal) || {}; else if (typeof fontVal === 'object') fonts = fontVal || {}; } catch(e) {}
        if (fonts.family && fonts.family !== 'inherit') {
            var fam = fonts.family;
            if (fam === 'system-stack') {
                css += '.main-navigation a, .main-navigation ul li a { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important; }\n';
            } else {
                var pureFamily = fam.split(',')[0].replace(/['"]/g, '').trim();
                css += '.main-navigation a, .main-navigation ul li a { font-family: "' + pureFamily + '", sans-serif !important; }\n';
            }
        }
        if (fonts.style) {
            var st = fonts.style;
            if (st.indexOf('italic') !== -1) {
                css += '.main-navigation a, .main-navigation ul li a { font-style: italic !important; }\n';
            } else {
                css += '.main-navigation a, .main-navigation ul li a { font-style: normal !important; }\n';
            }
            var numMatch = st.match(/\d+/);
            if (numMatch) {
                css += '.main-navigation a, .main-navigation ul li a { font-weight: ' + numMatch[0] + ' !important; }\n';
            } else if (st === 'bold' || st === 'bold italic') {
                css += '.main-navigation a, .main-navigation ul li a { font-weight: 700 !important; }\n';
            } else {
                css += '.main-navigation a, .main-navigation ul li a { font-weight: 500 !important; }\n';
            }
        }
        if (fonts.size && !isNaN(fonts.size)) {
            css += '.main-navigation a, .main-navigation ul li a { font-size: ' + parseInt(fonts.size, 10) + 'px !important; }\n';
        }
        if (fonts.spacing !== undefined && fonts.spacing !== '') {
            css += '.main-navigation a, .main-navigation ul li a { letter-spacing: ' + parseFloat(fonts.spacing) + 'px !important; }\n';
        }

        $style.html(css);
    };

    $.each(['gravisain_header_primary_nav_colors', 'gravisain_header_primary_nav_background', 'gravisain_header_primary_nav_font'], function(i, settingId) {
        wp.customize(settingId, function(setting) {
            setting.bind(applyPrimaryNavDesignPreview);
        });
    });

    // --- SECONDARY NAVIGATION LIVE PREVIEW ---
// 5C-1. Secondary Navigation Spacing Live Preview (Responsive)

    wp.customize('gravisain_header_secondary_nav_spacing', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-secondary-nav-spacing-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-secondary-nav-spacing-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.charAt(0) === '{') {
                        obj = JSON.parse(val);
                    } else if (typeof val === 'object' && val !== null) {
                        obj = val;
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }
                var getVal = function(v) { return !isNaN(v) && v !== '' ? v + 'px' : v; };
                var css = '';
                if (obj.desktop !== undefined && obj.desktop !== '') css += '.secondary-navigation ul { gap: ' + getVal(obj.desktop) + ' !important; }\n';
                if (obj.tablet !== undefined && obj.tablet !== '')  css += '@media (max-width: 1024px) { .secondary-navigation ul { gap: ' + getVal(obj.tablet) + ' !important; } }\n';
                if (obj.mobile !== undefined && obj.mobile !== '')  css += '@media (max-width: 719px) { .secondary-navigation ul { gap: ' + getVal(obj.mobile) + ' !important; } }\n';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    
// 5C-2. Secondary Navigation Stretch - Live Preview
    function applySecondaryNavStretchPreview() {
        var stretchVal = wp.customize('gravisain_header_secondary_nav_stretch') ? wp.customize('gravisain_header_secondary_nav_stretch').get() : false;
        var isStretch  = (stretchVal === true || stretchVal === 'true' || stretchVal === 1 || stretchVal === '1');

        var fillVal    = wp.customize('gravisain_header_secondary_nav_fill_center') ? wp.customize('gravisain_header_secondary_nav_fill_center').get() : false;
        var isFillCenter = (fillVal === true || fillVal === 'true' || fillVal === 1 || fillVal === '1');

        var $style = $('#gravisain-secondary-nav-stretch-preview-css');
        if ( ! $style.length ) {
            $style = $('<style id="gravisain-secondary-nav-stretch-preview-css"></style>').appendTo('head');
        }
        var css = '';
        if ( isStretch ) {
            css += '.col-left:has(.secondary-navigation), .col-center:has(.secondary-navigation), .col-right:has(.secondary-navigation) { flex: 1 1 0% !important; }\n';
            css += '.ghb-component.secondary-navigation { flex: 1 1 0% !important; width: 100% !important; min-width: 0 !important; max-width: 100% !important; display: flex !important; }\n';
            css += '.secondary-navigation div { width: 100% !important; min-width: 0 !important; max-width: 100% !important; display: flex !important; }\n';
            css += '.secondary-navigation ul { width: 100% !important; min-width: 0 !important; max-width: 100% !important; flex-wrap: wrap !important; }\n';
            if ( isFillCenter ) {
                css += '.secondary-navigation ul { justify-content: center !important; }\n';
                css += '.secondary-navigation ul > li { flex: 1 1 auto !important; text-align: center !important; }\n';
                css += '.secondary-navigation ul > li > a { justify-content: center !important; text-align: center !important; }\n';
            } else {
                css += '.secondary-navigation ul { justify-content: space-between !important; }\n';
                css += '.secondary-navigation ul > li { flex: 0 1 auto !important; text-align: left !important; }\n';
                css += '.secondary-navigation ul > li > a { justify-content: flex-start !important; text-align: left !important; }\n';
            }
        } else {
            $style.html('');
            return;
        }
        $style.html(css);
    }

    wp.customize('gravisain_header_secondary_nav_stretch', function(setting) {
        setting.bind(function() {
            applySecondaryNavStretchPreview();
        });
    });

    wp.customize('gravisain_header_secondary_nav_fill_center', function(setting) {
        setting.bind(function() {
            applySecondaryNavStretchPreview();
        });
    });

// 5C-3. Secondary Navigation Design Options Live Preview (Colors, Background, Font)
    var applySecondaryNavDesignPreview = function() {
        var $style = $('#gravisain-secondary-nav-design-preview-css');
        if ( ! $style.length ) {
            $style = $('<style id="gravisain-secondary-nav-design-preview-css"></style>').appendTo('head');
        }
        var css = '';

        // Colors
        var colorVal = wp.customize('gravisain_header_secondary_nav_colors') ? wp.customize('gravisain_header_secondary_nav_colors').get() : null;
        var colors = {};
        try { if (typeof colorVal === 'string') colors = JSON.parse(colorVal) || {}; else if (typeof colorVal === 'object') colors = colorVal || {}; } catch(e) {}
        if (colors.initial) css += '.site-header .site-header-row .secondary-navigation a:not(.gravisain-btn), .site-header .site-header-row .secondary-navigation ul li a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation ul li a:not(.gravisain-btn), .secondary-navigation a, .secondary-navigation ul li a { color: ' + colors.initial + ' !important; }\n';
        if (colors.hover)   css += '.site-header .site-header-row .secondary-navigation a:not(.gravisain-btn):hover, .site-header .site-header-row .secondary-navigation ul li a:not(.gravisain-btn):hover, .site-header .site-header-row .secondary-navigation li:hover > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-header-row .secondary-navigation ul li a:not(.gravisain-btn):hover, .has-transparent-header .site-header .site-header-row .secondary-navigation li:hover > a:not(.gravisain-btn), .secondary-navigation a:hover, .secondary-navigation ul li a:hover, .secondary-navigation li:hover > a { color: ' + colors.hover + ' !important; }\n';
        if (colors.active)  css += '.site-header .site-header-row .secondary-navigation li.current-menu-item > a:not(.gravisain-btn), .site-header .site-header-row .secondary-navigation li.current-menu-ancestor > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation li.current-menu-item > a:not(.gravisain-btn), .has-transparent-header .site-header .site-header-row .secondary-navigation li.current-menu-ancestor > a:not(.gravisain-btn), .secondary-navigation li.current-menu-item > a, .secondary-navigation li.current-menu-ancestor > a { color: ' + colors.active + ' !important; }\n';

        // Background
        var bgVal = wp.customize('gravisain_header_secondary_nav_background') ? wp.customize('gravisain_header_secondary_nav_background').get() : null;
        var bgs = {};
        try { if (typeof bgVal === 'string') bgs = JSON.parse(bgVal) || {}; else if (typeof bgVal === 'object') bgs = bgVal || {}; } catch(e) {}
        if (bgs.initial) css += '.secondary-navigation a, .secondary-navigation ul li a { background-color: ' + bgs.initial + ' !important; padding: 8px 14px !important; border-radius: 4px !important; }\n';
        if (bgs.hover)   css += '.secondary-navigation a:hover, .secondary-navigation ul li a:hover, .secondary-navigation li:hover > a { background-color: ' + bgs.hover + ' !important; padding: 8px 14px !important; border-radius: 4px !important; }\n';
        if (bgs.active)  css += '.secondary-navigation li.current-menu-item > a, .secondary-navigation li.current-menu-ancestor > a { background-color: ' + bgs.active + ' !important; padding: 8px 14px !important; border-radius: 4px !important; }\n';

        // Font
        var fontVal = wp.customize('gravisain_header_secondary_nav_font') ? wp.customize('gravisain_header_secondary_nav_font').get() : null;
        var fonts = {};
        try { if (typeof fontVal === 'string') fonts = JSON.parse(fontVal) || {}; else if (typeof fontVal === 'object') fonts = fontVal || {}; } catch(e) {}
        if (fonts.family && fonts.family !== 'inherit') {
            var fam = fonts.family;
            if (fam === 'system-stack') {
                css += '.secondary-navigation a, .secondary-navigation ul li a { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important; }\n';
            } else {
                var pureFamily = fam.split(',')[0].replace(/['"]/g, '').trim();
                css += '.secondary-navigation a, .secondary-navigation ul li a { font-family: "' + pureFamily + '", sans-serif !important; }\n';
            }
        }
        if (fonts.style) {
            var st = fonts.style;
            if (st.indexOf('italic') !== -1) {
                css += '.secondary-navigation a, .secondary-navigation ul li a { font-style: italic !important; }\n';
            } else {
                css += '.secondary-navigation a, .secondary-navigation ul li a { font-style: normal !important; }\n';
            }
            var numMatch = st.match(/\d+/);
            if (numMatch) {
                css += '.secondary-navigation a, .secondary-navigation ul li a { font-weight: ' + numMatch[0] + ' !important; }\n';
            } else if (st === 'bold' || st === 'bold italic') {
                css += '.secondary-navigation a, .secondary-navigation ul li a { font-weight: 700 !important; }\n';
            } else {
                css += '.secondary-navigation a, .secondary-navigation ul li a { font-weight: 500 !important; }\n';
            }
        }
        if (fonts.size && !isNaN(fonts.size)) {
            css += '.secondary-navigation a, .secondary-navigation ul li a { font-size: ' + parseInt(fonts.size, 10) + 'px !important; }\n';
        }
        if (fonts.spacing !== undefined && fonts.spacing !== '') {
            css += '.secondary-navigation a, .secondary-navigation ul li a { letter-spacing: ' + parseFloat(fonts.spacing) + 'px !important; }\n';
        }

        $style.html(css);
    };

    $.each(['gravisain_header_secondary_nav_colors', 'gravisain_header_secondary_nav_background', 'gravisain_header_secondary_nav_font'], function(i, settingId) {
        wp.customize(settingId, function(setting) {
            setting.bind(applySecondaryNavDesignPreview);
        });
    });

// 5D. Off-Canvas Navigation Design Options Live Preview
    var applyOffcanvasDesignPreview = function() {
        var $style = $('#gravisain-offcanvas-design-preview-css');
        if ( ! $style.length ) {
            $style = $('<style id="gravisain-offcanvas-design-preview-css"></style>').appendTo('head');
        }
        var css = '';

        // Colors
        var colorVal = wp.customize('gravisain_header_offcanvas_colors') ? wp.customize('gravisain_header_offcanvas_colors').get() : null;
        var colors = {};
        try { if (typeof colorVal === 'string') colors = JSON.parse(colorVal) || {}; else if (typeof colorVal === 'object') colors = colorVal || {}; } catch(e) {}
        if (colors.initial) css += '.off-canvas-menu-list li a { color: ' + colors.initial + ' !important; }\n';
        if (colors.hover)   css += '.off-canvas-menu-list li a:hover { color: ' + colors.hover + ' !important; }\n';
        if (colors.active)  css += '.off-canvas-menu-list li.current-menu-item > a, .off-canvas-menu-list li.current-menu-ancestor > a { color: ' + colors.active + ' !important; }\n';

        // Background
        var bgVal = wp.customize('gravisain_header_offcanvas_background') ? wp.customize('gravisain_header_offcanvas_background').get() : null;
        var bgs = {};
        try { if (typeof bgVal === 'string') bgs = JSON.parse(bgVal) || {}; else if (typeof bgVal === 'object') bgs = bgVal || {}; } catch(e) {}
        if (bgs.initial) css += '.gravisain-off-canvas .off-canvas-container { background-color: ' + bgs.initial + ' !important; }\n';

        // Font
        var fontVal = wp.customize('gravisain_header_offcanvas_font') ? wp.customize('gravisain_header_offcanvas_font').get() : null;
        var fonts = {};
        try { if (typeof fontVal === 'string') fonts = JSON.parse(fontVal) || {}; else if (typeof fontVal === 'object') fonts = fontVal || {}; } catch(e) {}
        if (fonts.family && fonts.family !== 'inherit') {
            var fam = fonts.family;
            if (fam === 'system-stack') {
                css += '.off-canvas-menu-list li a { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important; }\n';
            } else {
                var pureFamily = fam.split(',')[0].replace(/['"]/g, '').trim();
                css += '.off-canvas-menu-list li a { font-family: "' + pureFamily + '", sans-serif !important; }\n';
            }
        }
        if (fonts.style) {
            var st = fonts.style;
            if (st.indexOf('italic') !== -1) {
                css += '.off-canvas-menu-list li a { font-style: italic !important; }\n';
            } else {
                css += '.off-canvas-menu-list li a { font-style: normal !important; }\n';
            }
            var numMatch = st.match(/\d+/);
            if (numMatch) {
                css += '.off-canvas-menu-list li a { font-weight: ' + numMatch[0] + ' !important; }\n';
            } else if (st === 'bold' || st === 'bold italic') {
                css += '.off-canvas-menu-list li a { font-weight: 700 !important; }\n';
            } else {
                css += '.off-canvas-menu-list li a { font-weight: 500 !important; }\n';
            }
        }
        if (fonts.size && !isNaN(fonts.size)) {
            css += '.off-canvas-menu-list li a { font-size: ' + parseInt(fonts.size, 10) + 'px !important; }\n';
        }
        if (fonts.spacing !== undefined && fonts.spacing !== '') {
            css += '.off-canvas-menu-list li a { letter-spacing: ' + parseFloat(fonts.spacing) + 'px !important; }\n';
        }

        $style.html(css);
    };

    $.each(['gravisain_header_offcanvas_colors', 'gravisain_header_offcanvas_background', 'gravisain_header_offcanvas_font'], function(i, settingId) {
        wp.customize(settingId, function(setting) {
            setting.bind(applyOffcanvasDesignPreview);
        });
    });

    // Off-Canvas Width Live Preview (Responsive: %, px, vw)
    wp.customize('gravisain_offcanvas_width', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-offcanvas-width-preview-css');
            if (!$style.length) {
                $style = $('<style id="gravisain-offcanvas-width-preview-css"></style>').appendTo('head');
            }
            if (val) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.charAt(0) === '{') {
                        obj = JSON.parse(val);
                    } else if (typeof val === 'object' && val !== null) {
                        obj = val;
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }

                var css = '';
                if (obj.desktop) {
                    css += ':root { --gravisain-offcanvas-width: ' + obj.desktop + ' !important; }\n';
                }
                if (obj.tablet) {
                    css += '@media (max-width: 1024px) { :root { --gravisain-offcanvas-width: ' + obj.tablet + ' !important; } }\n';
                }
                if (obj.mobile) {
                    css += '@media (max-width: 768px) { :root { --gravisain-offcanvas-width: ' + obj.mobile + ' !important; } }\n';
                }
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    
// 5B-3. Social Icons Spacing Live Preview (Responsive)
    wp.customize('gravisain_header_social_spacing', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-social-spacing-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-social-spacing-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.charAt(0) === '{') {
                        obj = JSON.parse(val);
                    } else if (typeof val === 'object' && val !== null) {
                        obj = val;
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }
                var getVal = function(v) { return !isNaN(v) && v !== '' ? v + 'px' : v; };
                var css = '';
                if (obj.desktop !== undefined && obj.desktop !== '') css += '.social-icons-list { gap: ' + getVal(obj.desktop) + ' !important; }\n';
                if (obj.tablet !== undefined && obj.tablet !== '')  css += '@media (max-width: 1024px) { .social-icons-list { gap: ' + getVal(obj.tablet) + ' !important; } }\n';
                if (obj.mobile !== undefined && obj.mobile !== '')  css += '@media (max-width: 719px) { .social-icons-list { gap: ' + getVal(obj.mobile) + ' !important; } }\n';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 5B-3. Custom HTML / Shortcode Live Preview
    wp.customize('gravisain_header_html_content', function(setting) {
        setting.bind(function(val) {
            if ( ! val ) {
                val = '<span class="ghb-placeholder-text">Custom HTML Component (Edit in Customizer)</span>';
            }
            $('.ghb-custom-html').html(val);
        });
    });

    // 5B-4. Action Button Visibility Live Preview
    wp.customize('gravisain_header_button_visibility', function(setting) {
        setting.bind(function(val) {
            var $btn = $('.ghb-action-button-wrapper');
            $btn.removeClass('gravisain-hide-desktop gravisain-hide-tablet gravisain-hide-mobile');
            
            var devices = (typeof val === 'string' && val !== '') ? val.split(',') : (Array.isArray(val) ? val : []);
            if (devices.indexOf('desktop') === -1) {
                $btn.addClass('gravisain-hide-desktop');
            }
            if (devices.indexOf('tablet') === -1) {
                $btn.addClass('gravisain-hide-tablet');
            }
            if (devices.indexOf('mobile') === -1) {
                $btn.addClass('gravisain-hide-mobile');
            }
        });
    });

    // 5C. Content Left/Right Edge Spacing Live Preview (Responsive)
    wp.customize('gravisain_content_spacing_x', function(setting) {
        setting.bind(function(val) {
            var $style = $('#gravisain-spacing-x-preview-css');
            if ( ! $style.length ) {
                $style = $('<style id="gravisain-spacing-x-preview-css"></style>').appendTo('head');
            }
            if ( val ) {
                var obj = {};
                try {
                    if (typeof val === 'string' && val.charAt(0) === '{') {
                        obj = JSON.parse(val);
                    } else if (typeof val === 'object' && val !== null) {
                        obj = val;
                    } else {
                        obj = { desktop: val };
                    }
                } catch (e) {
                    obj = { desktop: val };
                }
                var getVal = function(v) { return !isNaN(v) && v !== '' ? v + 'px' : v; };
                var css = '';
                if (obj.desktop !== undefined && obj.desktop !== '') css += '.site-content .container { --gravisain-container-padding-x: ' + getVal(obj.desktop) + ' !important; padding-left: ' + getVal(obj.desktop) + ' !important; padding-right: ' + getVal(obj.desktop) + ' !important; }\n';
                if (obj.tablet !== undefined && obj.tablet !== '')  css += '@media (max-width: 1024px) { .site-content .container { --gravisain-container-padding-x: ' + getVal(obj.tablet) + ' !important; padding-left: ' + getVal(obj.tablet) + ' !important; padding-right: ' + getVal(obj.tablet) + ' !important; } }\n';
                if (obj.mobile !== undefined && obj.mobile !== '')  css += '@media (max-width: 719px) { .site-content .container { --gravisain-container-padding-x: ' + getVal(obj.mobile) + ' !important; padding-left: ' + getVal(obj.mobile) + ' !important; padding-right: ' + getVal(obj.mobile) + ' !important; } }\n';
                $style.html(css);
            } else {
                $style.html('');
            }
        });
    });

    // 6. Unified Row Live Preview (Background Color, Text Color, Link Color, Hover Color, Border Color, Border Width, Row Height, Visibility, Layout)
    var headerRows = [
        { type: 'top', selector: '.site-header-top-row, .site-header-top', defaultBorder: 1 },
        { type: 'main', selector: '.site-header-main, .site-header-main-row', defaultBorder: 0 },
        { type: 'bottom', selector: '.site-header-bottom-row, .site-header-bottom', defaultBorder: 1 }
    ];

    $.each(headerRows, function(i, row) {
        // Background Color
        wp.customize('gravisain_header_' + row.type + '_bg_color', function(setting) {
            setting.bind(function(val) {
                $(row.selector).css('background-color', val);
            });
        });

        // Text Color
        wp.customize('gravisain_header_' + row.type + '_text_color', function(setting) {
            setting.bind(function(val) {
                $(row.selector).css('color', val);
            });
        });

        // Link Color
        wp.customize('gravisain_header_' + row.type + '_link_color', function(setting) {
            setting.bind(function(val) {
                var $style = $('#gravisain-' + row.type + '-row-link-css');
                if ( ! $style.length ) $style = $('<style id="gravisain-' + row.type + '-row-link-css"></style>').appendTo('head');
                $style.html(row.selector + ' a { color: ' + val + ' !important; }');
            });
        });

        // Link Hover Color
        wp.customize('gravisain_header_' + row.type + '_link_hover_color', function(setting) {
            setting.bind(function(val) {
                var $style = $('#gravisain-' + row.type + '-row-link-hover-css');
                if ( ! $style.length ) $style = $('<style id="gravisain-' + row.type + '-row-link-hover-css"></style>').appendTo('head');
                $style.html(row.selector + ' a:hover { color: ' + val + ' !important; }');
            });
        });

        // Border Color
        wp.customize('gravisain_header_' + row.type + '_border_color', function(setting) {
            setting.bind(function(val) {
                var widthSetting = wp.customize('gravisain_header_' + row.type + '_border_width');
                var rawWidth = widthSetting ? (widthSetting.get() || 0) : row.defaultBorder;
                var width = parseInt(rawWidth || 0, 10);
                if ( width > 0 ) {
                    $(row.selector).css('border-bottom', width + 'px solid ' + val);
                } else {
                    $(row.selector).css('border-bottom', 'none');
                }
            });
        });

        // Border Width
        wp.customize('gravisain_header_' + row.type + '_border_width', function(setting) {
            setting.bind(function(val) {
                var colorSetting = wp.customize('gravisain_header_' + row.type + '_border_color');
                var color = colorSetting ? (colorSetting.get() || '#e2e8f0') : '#e2e8f0';
                var width = parseInt(val || 0, 10);
                if ( width > 0 ) {
                    $(row.selector).css('border-bottom', width + 'px solid ' + color);
                } else {
                    $(row.selector).css('border-bottom', 'none');
                }
            });
        });

        // Row Height (Responsive)
        wp.customize('gravisain_header_' + row.type + '_height', function(setting) {
            setting.bind(function(val) {
                var $style = $('#gravisain-' + row.type + '-row-height-css');
                if ( ! $style.length ) {
                    $style = $('<style id="gravisain-' + row.type + '-row-height-css"></style>').appendTo('head');
                }
                if ( val ) {
                    var obj = {};
                    try {
                        if (typeof val === 'string' && val.charAt(0) === '{') {
                            obj = JSON.parse(val);
                        } else if (typeof val === 'object' && val !== null) {
                            obj = val;
                        } else {
                            obj = { desktop: val };
                        }
                    } catch (e) {
                        obj = { desktop: val };
                    }
                    var getPx = function(v) { return parseInt(v || 0, 10); };
                    var css = '';
                    if (obj.desktop && getPx(obj.desktop) > 0) css += row.selector + ' { min-height: ' + getPx(obj.desktop) + 'px !important; }\n';
                    if (obj.tablet && getPx(obj.tablet) > 0)  css += '@media (max-width: 1024px) { ' + row.selector + ' { min-height: ' + getPx(obj.tablet) + 'px !important; } }\n';
                    if (obj.mobile && getPx(obj.mobile) > 0)  css += '@media (max-width: 719px) { ' + row.selector + ' { min-height: ' + getPx(obj.mobile) + 'px !important; } }\n';
                    $style.html(css);
                } else {
                    $style.html('');
                }
            });
        });

        // Device Visibility
        wp.customize('gravisain_header_' + row.type + '_visibility', function(setting) {
            setting.bind(function(val) {
                var $row = $(row.selector);
                $row.removeClass('gravisain-hide-desktop gravisain-hide-tablet gravisain-hide-mobile');
                var devices = (typeof val === 'string' && val !== '') ? val.split(',') : (Array.isArray(val) ? val : []);
                if (devices.indexOf('desktop') === -1) $row.addClass('gravisain-hide-desktop');
                if (devices.indexOf('tablet') === -1)  $row.addClass('gravisain-hide-tablet');
                if (devices.indexOf('mobile') === -1)  $row.addClass('gravisain-hide-mobile');
            });
        });

        // Layout
        wp.customize('gravisain_header_' + row.type + '_layout', function(setting) {
            setting.bind(function(val) {
                $(row.selector).removeClass('layout-full-contained layout-full-width layout-contained').addClass('layout-' + val);
            });
        });
    });

    // 20. Social Icons Spacing Live Preview
    wp.customize('gravisain_header_social_spacing', function(setting) {
        setting.bind(function(val) {
            var gap = 12;
            try {
                if (val && typeof val === 'string' && val.charAt(0) === '{') {
                    var obj = JSON.parse(val);
                    gap = obj.desktop ? parseInt(obj.desktop, 10) : 12;
                } else if (!isNaN(val)) {
                    gap = parseInt(val, 10);
                }
            } catch(e) {}
            $('.social-icons-list').css('gap', gap + 'px');
        });
    });

    // 21. Social Icons Size Live Preview
    wp.customize('gravisain_header_social_icon_size', function(setting) {
        setting.bind(function(val) {
            var size = 18;
            try {
                if (val && typeof val === 'string' && val.charAt(0) === '{') {
                    var obj = JSON.parse(val);
                    var raw = obj.desktop || 18;
                    var parsed = parseInt(raw, 10);
                    if (!isNaN(parsed)) size = parsed;
                } else {
                    var parsed = parseInt(val, 10);
                    if (!isNaN(parsed)) size = parsed;
                }
            } catch(e) {}
            $('.social-icon-item a:not(.has-label), .social-icon-icon, .social-icon-icon svg, .social-icon-icon img').each(function() {
                this.style.setProperty('width', size + 'px', 'important');
                this.style.setProperty('height', size + 'px', 'important');
            });
        });
    });

    // 22. Ensure strictly ONE Row Edit Shortcut exists inside each row container and remove all duplicates
    function ensureRowEditShortcuts() {
        var validIds = [
            'gravisain_header_top_row', 'gravisain_header_main_row', 'gravisain_header_bottom_row',
            'gravisain_site_branding', 'gravisain_header_primary_menu', 'gravisain_header_secondary_menu',
            'gravisain_header_html', 'gravisain_header_action_button', 'gravisain_header_social',
            'gravisain_header_search', 'gravisain_header_menu_trigger',
            'gravisain_header_account', 'gravisain_header_divider', 'gravisain_header_contact', 'gravisain_header_cart'
        ];

        // 1. Remove rogue, empty, or redundant shortcut buttons in masthead that don't belong to our rows or logo or components
        $('#masthead .customize-partial-edit-shortcut').each(function() {
            var id = $(this).data('customize-partial-id') || $(this).attr('data-customize-partial-id') || '';
            if ($.inArray(id, validIds) === -1) {
                $(this).remove();
            }
        });

        var items = [
            { id: 'gravisain_header_top_row', selector: '.site-header-top-row', cls: 'gravisain-row-shortcut' },
            { id: 'gravisain_header_main_row', selector: '.site-header-main', cls: 'gravisain-row-shortcut' },
            { id: 'gravisain_header_bottom_row', selector: '.site-header-bottom-row', cls: 'gravisain-row-shortcut' },
            { id: 'gravisain_footer_top_row', selector: '.site-footer-top', cls: 'gravisain-row-shortcut' },
            { id: 'gravisain_footer_main_row', selector: '.site-footer-main', cls: 'gravisain-row-shortcut' },
            { id: 'gravisain_footer_bottom_row', selector: '.site-footer-bottom', cls: 'gravisain-row-shortcut' },
            { id: 'gravisain_site_branding', selector: '.site-branding', cls: 'gravisain-logo-shortcut' },
            { id: 'gravisain_header_primary_menu', selector: '.main-navigation', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_secondary_menu', selector: '.secondary-navigation', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_html', selector: '.ghb-custom-html', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_action_button', selector: '.ghb-action-button-wrapper', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_social', selector: '.site-header .ghb-social-icons', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_search', selector: '.ghb-search', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_menu_trigger', selector: '.ghb-menu-trigger', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_account', selector: '.ghb-account', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_divider', selector: '.ghb-divider', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_contact', selector: '.ghb-contact-info', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_cart', selector: '.ghb-cart', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_header_theme_switcher', selector: '.ghb-theme-switcher', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_footer_copyright_section', selector: '.gfb-copyright', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_footer_social', selector: '.gfb-social', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_footer_navigation', selector: '.gfb-footer-navigation', cls: 'gravisain-component-shortcut' },
            { id: 'gravisain_footer_html', selector: '.gfb-custom-html', cls: 'gravisain-component-shortcut' },
            { id: 'sidebar-widgets-footer-widget-1', selector: '.gfb-widget-1', cls: 'gravisain-component-shortcut' },
            { id: 'sidebar-widgets-footer-widget-2', selector: '.gfb-widget-2', cls: 'gravisain-component-shortcut' },
            { id: 'sidebar-widgets-footer-widget-3', selector: '.gfb-widget-3', cls: 'gravisain-component-shortcut' },
            { id: 'sidebar-widgets-footer-widget-4', selector: '.gfb-widget-4', cls: 'gravisain-component-shortcut' }
        ];

        var svgIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24-.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.74.07zm-1.46.68L4.85 11.64l-.61 2.89 2.89-.61 7.58-7.58-2.28-2.27z"></path></svg>';

        $.each(items, function(i, item) {
            var $container = $(item.selector);
            if ($container.length) {
                // Find ALL shortcut buttons matching this ID checking both jQuery .data() and HTML .attr()
                var $allShortcuts = $('.customize-partial-edit-shortcut').filter(function() {
                    var id = $(this).data('customize-partial-id') || $(this).attr('data-customize-partial-id') || '';
                    return id === item.id;
                });
                
                if ($allShortcuts.length > 0) {
                    // Keep strictly the first one and remove all duplicate extra circles
                    var $shortcut = $allShortcuts.first();
                    if ($allShortcuts.length > 1) {
                        $allShortcuts.slice(1).remove();
                    }
                    // Ensure it has our class and SVG icon
                    $shortcut.addClass(item.cls);
                    if ($shortcut.find('svg').length === 0) {
                        $shortcut.html(svgIcon);
                    }
                    // Move the single shortcut inside our relative-positioned container so it centers on this item
                    if (!$shortcut.parent().is($container)) {
                        $container.prepend($shortcut);
                    }
                } else {
                    // If no shortcut exists anywhere, create one inside the container
                    var $btn = $('<button aria-label="Click to edit." title="Click to edit." class="customize-partial-edit-shortcut ' + item.cls + '" data-customize-partial-id="' + item.id + '">' + svgIcon + '</button>');
                    $container.prepend($btn);
                }
            }
        });
    }

    var ensureShortcutsTimer = null;
    function scheduleEnsureRowEditShortcuts() {
        if (ensureShortcutsTimer) {
            clearTimeout(ensureShortcutsTimer);
        }
        ensureShortcutsTimer = setTimeout(ensureRowEditShortcuts, 250);
    }

    $(document).ready(function() {
        scheduleEnsureRowEditShortcuts();
        if (wp && wp.customize && wp.customize.selectiveRefresh) {
            wp.customize.selectiveRefresh.bind('partial-content-rendered', function() {
                scheduleEnsureRowEditShortcuts();
            });
        }
    });

    // 21. Notify Customizer Parent to Open Header Builder / Focus Section strictly when Edit Shortcuts are Clicked
    $(document).on('click', '.customize-partial-edit-shortcut', function() {
        if (wp && wp.customize && wp.customize.preview && wp.customize.preview.send) {
            var $shortcut = $(this);
            var partialId = $shortcut.data('customize-partial-id') || $shortcut.attr('data-customize-partial-id') || '';

            if (partialId === 'gravisain_site_branding' || partialId === 'custom_logo' || partialId === 'blogname') {
                wp.customize.preview.send('gravisain-focus-section', 'title_tagline');
                wp.customize.preview.send('focus-control-for-setting', 'blogname');
                return;
            } else if (partialId === 'gravisain_header_primary_menu') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_primary_navigation');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_primary_nav_menu');
                return;
            } else if (partialId === 'gravisain_header_secondary_navigation' || partialId === 'gravisain_header_secondary_menu') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_secondary_navigation');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_secondary_nav_menu');
                return;
            } else if (partialId === 'gravisain_header_html') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_html');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_html_content');
                return;
            } else if (partialId === 'gravisain_header_action_button') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_action_button');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_button_text');
                return;
            } else if (partialId === 'gravisain_header_social') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_social');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_social_facebook');
                return;
            } else if (partialId === 'gravisain_header_search') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_search');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_search_style');
                return;
            } else if (partialId === 'gravisain_header_menu_trigger') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_menu_trigger');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_trigger_style');
                return;
            } else if (partialId === 'gravisain_header_account') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_account');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_account_style');
                return;
            } else if (partialId === 'gravisain_header_divider') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_divider');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_divider_visibility');
                return;
            } else if (partialId === 'gravisain_header_contact') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_contact');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_contact_phone');
                return;
            } else if (partialId === 'gravisain_header_cart') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_header_cart');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_header_cart_style');
                return;
            } else if (partialId === 'gravisain_footer_copyright_section') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_footer_copyright_section');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_footer_copyright_text');
                return;
            } else if (partialId === 'gravisain_footer_social') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_footer_social');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_footer_social_items');
                return;
            } else if (partialId === 'gravisain_footer_navigation') {
                wp.customize.preview.send('gravisain-focus-section', 'gravisain_footer_navigation');
                wp.customize.preview.send('focus-control-for-setting', 'gravisain_footer_nav_menu');
                return;
            } else if (partialId.indexOf('sidebar-widgets-footer-widget-') === 0) {
                wp.customize.preview.send('gravisain-focus-section', partialId);
                return;
            }

            var sectionId = '';
            var rowType = '';
            var builderType = 'header';

            if (partialId === 'gravisain_header_top_row') {
                sectionId = 'gravisain_header_top_row';
                rowType = 'top';
            } else if (partialId === 'gravisain_header_main_row') {
                sectionId = 'gravisain_header_main_row';
                rowType = 'main';
            } else if (partialId === 'gravisain_header_bottom_row') {
                sectionId = 'gravisain_header_bottom_row';
                rowType = 'bottom';
            } else if (partialId === 'gravisain_footer_top_row') {
                sectionId = 'gravisain_footer_top_row';
                rowType = 'top';
                builderType = 'footer';
            } else if (partialId === 'gravisain_footer_main_row') {
                sectionId = 'gravisain_footer_main_row';
                rowType = 'main';
                builderType = 'footer';
            } else if (partialId === 'gravisain_footer_bottom_row') {
                sectionId = 'gravisain_footer_bottom_row';
                rowType = 'bottom';
                builderType = 'footer';
            }

            if (sectionId && rowType) {
                if (builderType === 'footer') {
                    wp.customize.preview.send('gravisain-open-footer-builder-row', { section: sectionId, row: rowType });
                } else {
                    wp.customize.preview.send('gravisain-open-header-builder-row', { section: sectionId, row: rowType });
                }
            }
        }
    });

    // 5B-5. Action Button Size Live Preview
    wp.customize('gravisain_header_button_size', function(setting) {
        setting.bind(function(val) {
            var $btn = $('.ghb-action-button-wrapper a');
            $btn.removeClass('gravisain-btn-sm gravisain-btn-md gravisain-btn-lg gravisain-btn-custom');
            if (val !== 'custom') {
                $btn.addClass('gravisain-btn-' + val);
            } else {
                $btn.addClass('gravisain-btn-custom');
            }
        });
    });

    // 5B-5B. Typography Live Preview Helper (Action Button & Navigations)
    function setupTypographyLivePreview(settingId, selector) {
        wp.customize(settingId, function(setting) {
            setting.bind(function(val) {
                var styleId = 'gravisain-custom-typography-' + settingId;
                var $style = $('#' + styleId);
                if (!$style.length) {
                    $style = $('<style id="' + styleId + '"></style>').appendTo('head');
                }
                var fontObj = {};
                try {
                    fontObj = typeof val === 'string' ? JSON.parse(val) : val;
                } catch (e) {}

                var css = '';
                if (fontObj) {
                    if (fontObj.family && fontObj.family !== 'inherit') {
                        var family = fontObj.family;
                        if (family !== 'system-stack') {
                            var pureFamily = family.split(',')[0].replace(/['"]/g, '').trim();
                            var fontId = 'gravisain-gfont-' + pureFamily.replace(/\s+/g, '-').toLowerCase();
                            var isSystem = ['arial', 'helvetica', 'times new roman', 'courier new', 'verdana', 'georgia', 'palatino', 'garamond', 'bookman', 'tahoma', 'trebuchet ms', 'impact'].indexOf(pureFamily.toLowerCase()) !== -1;
                            
                            if (!isSystem && !$('#' + fontId).length) {
                                $('<link id="' + fontId + '" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=' + encodeURIComponent(pureFamily) + ':ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap">').appendTo('head');
                            }
                            css += selector + ' { font-family: "' + pureFamily + '", sans-serif !important; } ';
                        } else {
                            css += selector + ' { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important; } ';
                        }
                    }
                    if (fontObj.style) {
                        var st = String(fontObj.style);
                        var isItalic = st.indexOf('italic') !== -1;
                        css += selector + ' { font-style: ' + (isItalic ? 'italic' : 'normal') + ' !important; } ';
                        var weightMatch = st.match(/\d+/);
                        if (weightMatch) {
                            css += selector + ' { font-weight: ' + weightMatch[0] + ' !important; } ';
                        } else if (st === 'bold' || st === 'bold italic') {
                            css += selector + ' { font-weight: 700 !important; } ';
                        } else {
                            css += selector + ' { font-weight: 400 !important; } ';
                        }
                    }
                    if (fontObj.size && fontObj.size !== '') {
                        css += selector + ' { font-size: ' + fontObj.size + (isNaN(fontObj.size) ? '' : 'px') + ' !important; } ';
                    }
                    if (fontObj.spacing && fontObj.spacing !== '') {
                        css += selector + ' { letter-spacing: ' + fontObj.spacing + (isNaN(fontObj.spacing) ? '' : 'px') + ' !important; } ';
                    }
                }
                $style.html(css);
            });
        });
    }

    setupTypographyLivePreview('gravisain_header_button_font', '.ghb-action-button-wrapper .gravisain-btn');
    setupTypographyLivePreview('gravisain_header_primary_nav_font', '.main-navigation a, .main-navigation ul li a');
    setupTypographyLivePreview('gravisain_header_secondary_nav_font', '.secondary-navigation a, .secondary-navigation ul li a');
    setupTypographyLivePreview('gravisain_header_offcanvas_font', '.offcanvas-navigation a, .offcanvas-navigation ul li a');

    // 5B-6. Action Button Custom Padding Live Preview
    wp.customize('gravisain_header_button_custom_padding', function(setting) {
        setting.bind(function(val) {
            var styleId = 'gravisain-custom-button-padding';
            var $style = $('#' + styleId);
            if (!$style.length) {
                $style = $('<style id="' + styleId + '"></style>').appendTo('head');
            }
            
            var padObj = {};
            try {
                padObj = JSON.parse(val);
            } catch (e) {}
            
            if (padObj && padObj.top !== undefined && padObj.top !== '') {
                var top = padObj.top;
                var right = padObj.right;
                var bottom = padObj.bottom;
                var left = padObj.left;
                var unit = padObj.unit || 'px';
                $style.html('.ghb-action-button-wrapper .gravisain-btn-custom { padding: ' + top + unit + ' ' + right + unit + ' ' + bottom + unit + ' ' + left + unit + ' !important; }');
            } else {
                $style.html('');
            }
        });
    });

    // 5B-7. Action Button Colors Live Preview
    function updateButtonColorsPreview(settingId, property) {
        wp.customize(settingId, function(setting) {
            setting.bind(function(val) {
                var styleId = 'gravisain-custom-button-' + property.replace('-color', '');
                var $style = $('#' + styleId);
                if (!$style.length) {
                    $style = $('<style id="' + styleId + '"></style>').appendTo('head');
                }
                var colors = {};
                try {
                    colors = JSON.parse(val);
                } catch (e) {}
                
                var css = '';
                if (colors && colors.initial) {
                    css += '.ghb-action-button-wrapper .gravisain-btn { ' + property + ': ' + colors.initial + ' !important; }';
                }
                if (colors && colors.hover) {
                    css += '.ghb-action-button-wrapper .gravisain-btn:hover { ' + property + ': ' + colors.hover + ' !important; }';
                }
                $style.html(css);
            });
        });
    }

    updateButtonColorsPreview('gravisain_header_button_font_colors', 'color');
    updateButtonColorsPreview('gravisain_header_button_bg_colors', 'background-color');
    updateButtonColorsPreview('gravisain_header_button_border_colors', 'border-color');

    // 5B-8. Action Button Border Style Live Preview
    wp.customize('gravisain_header_button_border_style', function(setting) {
        setting.bind(function(val) {
            var styleId = 'gravisain-custom-button-border-style';
            var $style = $('#' + styleId);
            if (!$style.length) {
                $style = $('<style id="' + styleId + '"></style>').appendTo('head');
            }
            var widthVal = wp.customize('gravisain_header_button_border_width') ? wp.customize('gravisain_header_button_border_width').get() : '2px';
            if (val && val !== 'none') {
                $style.html('.ghb-action-button-wrapper .gravisain-btn { border-style: ' + val + ' !important; border-width: ' + widthVal + ' !important; }');
            } else {
                $style.html('.ghb-action-button-wrapper .gravisain-btn { border-style: none !important; }');
            }
        });
    });

    // 5B-9. Action Button Border Width Live Preview
    wp.customize('gravisain_header_button_border_width', function(setting) {
        setting.bind(function(val) {
            var styleId = 'gravisain-custom-button-border-style'; // Re-use the same style tag
            var $style = $('#' + styleId);
            if (!$style.length) {
                $style = $('<style id="' + styleId + '"></style>').appendTo('head');
            }
            var styleVal = wp.customize('gravisain_header_button_border_style') ? wp.customize('gravisain_header_button_border_style').get() : 'none';
            if (styleVal && styleVal !== 'none') {
                $style.html('.ghb-action-button-wrapper .gravisain-btn { border-style: ' + styleVal + ' !important; border-width: ' + val + ' !important; }');
            } else {
                $style.html('.ghb-action-button-wrapper .gravisain-btn { border-style: none !important; }');
            }
        });
    });

    // ==========================================
    // FOOTER ROWS LIVE PREVIEW
    // ==========================================
    var footerRows = [
        { type: 'top', selector: '.site-footer-top' },
        { type: 'main', selector: '.site-footer-main' },
        { type: 'bottom', selector: '.site-footer-bottom' }
    ];

    $.each(footerRows, function(i, row) {
        // Background Color
        wp.customize('gravisain_footer_' + row.type + '_bg_color', function(setting) {
            setting.bind(function(val) {
                $(row.selector).css('background-color', val);
            });
        });

        // Text Color
        wp.customize('gravisain_footer_' + row.type + '_text_color', function(setting) {
            setting.bind(function(val) {
                $(row.selector).css('color', val);
                $(row.selector).find('a, .footer-widget-title, .gfb-copyright').css('color', val);
            });
        });

        // Device Visibility
        wp.customize('gravisain_footer_' + row.type + '_visibility', function(setting) {
            setting.bind(function(val) {
                var $row = $(row.selector);
                $row.removeClass('gravisain-hide-desktop gravisain-hide-tablet gravisain-hide-mobile');
                var devices = (typeof val === 'string' && val !== '') ? val.split(',') : (Array.isArray(val) ? val : []);
                if (devices.indexOf('desktop') === -1) $row.addClass('gravisain-hide-desktop');
                if (devices.indexOf('tablet') === -1)  $row.addClass('gravisain-hide-tablet');
                if (devices.indexOf('mobile') === -1)  $row.addClass('gravisain-hide-mobile');
            });
        });

        // Layout
        wp.customize('gravisain_footer_' + row.type + '_layout', function(setting) {
            setting.bind(function(val) {
                $(row.selector).removeClass('layout-full-contained layout-full-width layout-contained').addClass('layout-' + val);
            });
        });
    });

})(jQuery, wp);