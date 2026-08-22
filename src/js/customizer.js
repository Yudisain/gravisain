(function(wp, $) {
    'use strict';

    if (!wp || !wp.customize) {
        return;
    }

    $(document).ready(function() {
        // Build the HTML for the Builder UI
        var builderHTML = `
            <div id="gravisain-header-builder" class="gravisain-header-builder">
                <div class="ghb-header-bar">
                    <button type="button" class="ghb-hide-btn"><span class="dashicons dashicons-no-alt"></span> Hide</button>
                </div>
                <div class="ghb-body">
                    <!-- Top Row -->
                    <div class="ghb-row-wrapper" data-row="top">
                        <div class="ghb-row-tab" data-section="gravisain_header_top_row">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <span class="ghb-tab-title">TOP</span>
                        </div>
                        <div class="ghb-row-grid">
                            <div class="ghb-col ghb-col-left" data-col="left"></div>
                            <div class="ghb-col ghb-col-center" data-col="center"></div>
                            <div class="ghb-col ghb-col-right" data-col="right"></div>
                        </div>
                    </div>
                    
                    <!-- Main Row -->
                    <div class="ghb-row-wrapper" data-row="main">
                        <div class="ghb-row-tab" data-section="gravisain_header_main_row">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <span class="ghb-tab-title">MAIN</span>
                        </div>
                        <div class="ghb-row-grid">
                            <div class="ghb-col ghb-col-left" data-col="left"></div>
                            <div class="ghb-col ghb-col-center" data-col="center"></div>
                            <div class="ghb-col ghb-col-right" data-col="right"></div>
                        </div>
                    </div>

                    <!-- Bottom Row -->
                    <div class="ghb-row-wrapper" data-row="bottom">
                        <div class="ghb-row-tab" data-section="gravisain_header_bottom_row">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <span class="ghb-tab-title">BOTTOM</span>
                        </div>
                        <div class="ghb-row-grid">
                            <div class="ghb-col ghb-col-left" data-col="left"></div>
                            <div class="ghb-col ghb-col-center" data-col="center"></div>
                            <div class="ghb-col ghb-col-right" data-col="right"></div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="gravisain-header-builder-toggle" class="gravisain-header-builder-toggle">
                <span class="dashicons dashicons-admin-generic"></span> Header Builder
            </button>
        `;

        var pickerHTML = `
            <div id="ghb-component-picker" class="ghb-component-picker">
                <div class="ghb-picker-header">Available Components <span class="dashicons dashicons-no ghb-picker-close"></span></div>
                <div class="ghb-picker-body">
                    <div class="ghb-picker-item" data-type="logo" data-label="Logo"><span class="dashicons dashicons-menu"></span> Logo</div>
                    <div class="ghb-picker-item" data-type="primary-navigation" data-label="Primary Navigation"><span class="dashicons dashicons-menu"></span> Primary Navigation</div>
                    <div class="ghb-picker-item" data-type="secondary-navigation" data-label="Secondary Navigation"><span class="dashicons dashicons-menu"></span> Secondary Navigation</div>
                    <div class="ghb-picker-item" data-type="action-button" data-label="Action Button"><span class="dashicons dashicons-menu"></span> Action Button</div>
                    <div class="ghb-picker-item" data-type="social" data-label="Social"><span class="dashicons dashicons-share"></span> Social</div>
                    <div class="ghb-picker-item" data-type="html" data-label="HTML"><span class="dashicons dashicons-editor-code"></span> HTML</div>
                    <div class="ghb-picker-item" data-type="search" data-label="Search"><span class="dashicons dashicons-search"></span> Search</div>
                    <div class="ghb-picker-item" data-type="menu-trigger" data-label="Menu Trigger"><span class="dashicons dashicons-menu-alt"></span> Menu Trigger</div>
                    <div class="ghb-picker-item" data-type="account" data-label="Account"><span class="dashicons dashicons-admin-users"></span> Account</div>
                    <div class="ghb-picker-item" data-type="divider" data-label="Divider"><span class="dashicons dashicons-minus"></span> Divider</div>
                    <div class="ghb-picker-item" data-type="contact" data-label="Contact Info"><span class="dashicons dashicons-phone"></span> Contact Info</div>
                    <div class="ghb-picker-item" data-type="cart" data-label="Cart"><span class="dashicons dashicons-cart"></span> Cart</div>
                </div>
            </div>
        `;

        // The Customizer UI lives inside body
        var $previewContainer = $('body');
        $previewContainer.append(builderHTML);
        $previewContainer.append(pickerHTML);

        var $builder = $('#gravisain-header-builder');
        var $toggleBtn = $('#gravisain-header-builder-toggle');
        var $picker = $('#ghb-component-picker');
        
        // Append add buttons to all columns
        $builder.find('.ghb-col').append('<div class="ghb-add-item" title="Add Component"><span class="dashicons dashicons-plus"></span></div>');
        
        var uniqueComponentTypes = ['logo', 'primary-navigation', 'secondary-navigation', 'action-button', 'social', 'html', 'search', 'menu-trigger', 'account', 'divider', 'contact', 'cart'];

        function updatePickerAvailability() {
            var usedTypes = [];
            $builder.find('.ghb-dropped-item').each(function() {
                usedTypes.push($(this).data('type'));
            });

            $picker.find('.ghb-picker-item').each(function() {
                var type = $(this).data('type');
                if (uniqueComponentTypes.indexOf(type) !== -1 && usedTypes.indexOf(type) !== -1) {
                    $(this).addClass('is-disabled');
                    if (!$(this).find('.ghb-item-badge').length) {
                        $(this).append('<span class="ghb-item-badge" style="margin-left:auto; font-size:10px; background:#e2e8f0; color:#64748b; padding:1px 6px; border-radius:10px;">Used</span>');
                    }
                } else {
                    $(this).removeClass('is-disabled');
                    $(this).find('.ghb-item-badge').remove();
                }
            });
        }

        var isUpdatingHeaderBuilderState = false;

        // Function to serialize builder state and save to Customizer
        function updateHeaderBuilderState() {
            var state = {
                top: { left: [], center: [], right: [] },
                main: { left: [], center: [], right: [] },
                bottom: { left: [], center: [], right: [] }
            };

            $builder.find('.ghb-row-wrapper').each(function() {
                var row = $(this).data('row');
                if (!row) return;

                $(this).find('.ghb-col').each(function() {
                    var col = $(this).data('col');
                    if (!col) return;

                    $(this).find('.ghb-dropped-item').each(function() {
                        state[row][col].push($(this).data('type'));
                    });
                });
            });

            // Update customizer setting if available
            if (wp.customize('gravisain_header_builder_layout')) {
                var jsonStr = JSON.stringify(state);
                if (wp.customize('gravisain_header_builder_layout').get() !== jsonStr) {
                    isUpdatingHeaderBuilderState = true;
                    wp.customize('gravisain_header_builder_layout').set(jsonStr);
                    isUpdatingHeaderBuilderState = false;
                }
            }
            
            updatePickerAvailability();
        }
        
        // Initialize Sortable on columns
        $builder.find('.ghb-col').sortable({
            connectWith: '.ghb-col',
            items: '.ghb-dropped-item',
            placeholder: 'ghb-sortable-placeholder',
            forcePlaceholderSize: true,
            helper: 'clone',
            appendTo: 'body',
            zIndex: 999999,
            start: function(event, ui) {
                // Prevent iframe from stealing mouseup events by disabling pointer events during drag
                $('#customize-preview iframe').css('pointer-events', 'none');
            },
            stop: function(event, ui) {
                // Re-enable iframe pointer events
                $('#customize-preview iframe').css('pointer-events', 'auto');
                
                // Fired when sorting has completely stopped
                updateHeaderBuilderState();
            }
        });
        
        var userHidBuilder = false;

        // Helper to open Header Builder cleanly
        function openHeaderBuilder() {
            userHidBuilder = false;
            $toggleBtn.removeClass('is-visible');
            $builder.addClass('is-active');
            $('.wp-full-overlay-main').css({ 'bottom': '330px', 'height': 'calc(100% - 330px)', 'padding-bottom': '0' });
            setTimeout(function() {
                try {
                    var $iframe = $('#customize-preview iframe');
                    if ($iframe.length && $iframe[0].contentWindow) {
                        var win = $iframe[0].contentWindow;
                        if (win) {
                            win.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                    }
                } catch (e) {}
            }, 150);
        }

        // Listen to Panel Expand safely
        wp.customize.panel('gravisain_header_panel', function(panel) {
            panel.expanded.bind(function(isExpanded) {
                if (isExpanded) {
                    if (!userHidBuilder) {
                        openHeaderBuilder();
                    } else {
                        $toggleBtn.addClass('is-visible');
                    }
                } else {
                    $builder.removeClass('is-active');
                    $toggleBtn.removeClass('is-visible');
                    $('.wp-full-overlay-main').css({ 'bottom': '', 'height': '', 'padding-bottom': '' });
                }
            });
        });

        // Listen to ANY header section expanding (e.g., triggered when clicking edit shortcuts in live preview)
        var headerSections = ['gravisain_header_top_row', 'gravisain_header_main_row', 'gravisain_header_bottom_row', 'gravisain_header_options', 'title_tagline'];
        $.each(headerSections, function(i, sectionId) {
            wp.customize.section(sectionId, function(section) {
                section.expanded.bind(function(isExpanded) {
                    if (isExpanded) {
                        openHeaderBuilder();
                    }
                });
            });
        });

        // Listen to ANY footer section expanding (e.g., triggered when clicking edit shortcuts in live preview)
        var footerSections = ['gravisain_footer_top_row', 'gravisain_footer_main_row', 'gravisain_footer_bottom_row', 'gravisain_footer_copyright_section'];
        $.each(footerSections, function(i, sectionId) {
            wp.customize.section(sectionId, function(section) {
                section.expanded.bind(function(isExpanded) {
                    if (isExpanded) {
                        openFooterBuilder();
                    }
                });
            });
        });

        // Listen for direct trigger from live preview iframe when edit shortcuts are clicked
        if (wp.customize.previewer) {
            wp.customize.previewer.bind('gravisain-open-header-builder', function() {
                openHeaderBuilder();
            });
            wp.customize.previewer.bind('gravisain-open-header-builder-row', function(data) {
                openHeaderBuilder();
                if (data && data.section && wp.customize.section(data.section)) {
                    wp.customize.section(data.section).focus();
                }
            });
            wp.customize.previewer.bind('gravisain-open-footer-builder', function() {
                openFooterBuilder();
            });
            wp.customize.previewer.bind('gravisain-open-footer-builder-row', function(data) {
                openFooterBuilder();
                if (data && data.section && wp.customize.section(data.section)) {
                    wp.customize.section(data.section).focus();
                }
            });
            wp.customize.previewer.bind('gravisain-focus-section', function(sectionId) {
                if (!sectionId) return;
                if (sectionId.indexOf('sidebar-widgets-') === 0 && wp.customize.panel('widgets')) {
                    wp.customize.panel('widgets').focus();
                    setTimeout(function() {
                        if (wp.customize.section(sectionId)) {
                            wp.customize.section(sectionId).focus();
                        }
                    }, 150);
                } else if (wp.customize.section(sectionId)) {
                    wp.customize.section(sectionId).focus();
                }
            });
        }

        // Handle Row Tab Clicks to focus the section in the sidebar
        $builder.on('click', '.ghb-row-tab', function() {
            var sectionId = $(this).data('section');
            if (sectionId && wp.customize.section(sectionId)) {
                wp.customize.section(sectionId).focus();
            }
        });

        // Hide Button Logic
        $builder.on('click', '.ghb-hide-btn', function() {
            userHidBuilder = true;
            $builder.removeClass('is-active');
            $('.wp-full-overlay-main').css({ 'bottom': '', 'height': '', 'padding-bottom': '' });
            $toggleBtn.addClass('is-visible');
        });

        // Show Toggle Button Logic
        $toggleBtn.on('click', function() {
            openHeaderBuilder();
        });

        // Component Picker Logic
        var $activeCol = null;

        $builder.on('click', '.ghb-add-item', function(e) {
            e.stopPropagation();
            $activeCol = $(this).closest('.ghb-col');
            var offset = $(this).offset();
            
            updatePickerAvailability();

            $picker.css({
                top: offset.top - $picker.outerHeight() - 10,
                left: offset.left
            }).addClass('is-open');
        });

        // Close picker
        $picker.on('click', '.ghb-picker-close', function() {
            $picker.removeClass('is-open');
            $activeCol = null;
        });
        
        // Hide picker when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.ghb-component-picker, .ghb-add-item').length) {
                $picker.removeClass('is-open');
            }
        });

        // Add component to grid
        $picker.on('click', '.ghb-picker-item', function() {
            if ($(this).hasClass('is-disabled')) return;
            var type = $(this).data('type');
            var label = $(this).data('label') || $(this).text();
            var icon = $(this).find('.dashicons').attr('class');

            if ($activeCol) {
                var componentHTML = `
                    <div class="ghb-dropped-item" data-type="${type}">
                        <span class="${icon}"></span>
                        <span class="ghb-item-label">${label}</span>
                        <span class="dashicons dashicons-admin-generic ghb-item-settings" title="Settings"></span>
                        <span class="dashicons dashicons-no ghb-item-remove" title="Remove"></span>
                    </div>
                `;
                
                // Append the component BEFORE the add item button
                $(componentHTML).insertBefore($activeCol.find('.ghb-add-item'));
                // Close picker
                $picker.removeClass('is-open');

                // Update State
                updateHeaderBuilderState();
            }
        });

        // Remove component
        $builder.on('click', '.ghb-item-remove', function(e) {
            e.stopPropagation();
            $(this).closest('.ghb-dropped-item').remove();

            // Update State
            updateHeaderBuilderState();
        });

        // Component Metadata Map
        var componentMap = {
            'logo': { label: 'Logo', icon: 'dashicons dashicons-menu', section: 'title_tagline' },
            'primary-navigation': { label: 'Primary Navigation', icon: 'dashicons dashicons-menu', section: 'gravisain_header_primary_navigation' },
            'secondary-navigation': { label: 'Secondary Navigation', icon: 'dashicons dashicons-menu', section: 'gravisain_header_secondary_navigation' },
            'action-button': { label: 'Action Button', icon: 'dashicons dashicons-menu', section: 'gravisain_header_action_button' },
            'social': { label: 'Social', icon: 'dashicons dashicons-share', section: 'gravisain_header_social' },
            'html': { label: 'HTML', icon: 'dashicons dashicons-editor-code', section: 'gravisain_header_html' },
            'search': { label: 'Search', icon: 'dashicons dashicons-search', section: 'gravisain_header_search' },
            'menu-trigger': { label: 'Menu Trigger', icon: 'dashicons dashicons-menu-alt', section: 'gravisain_header_menu_trigger' },
            'account': { label: 'Account', icon: 'dashicons dashicons-admin-users', section: 'gravisain_header_account' },
            'divider': { label: 'Divider', icon: 'dashicons dashicons-minus', section: 'gravisain_header_divider' },
            'contact': { label: 'Contact Info', icon: 'dashicons dashicons-phone', section: 'gravisain_header_contact' },
            'cart': { label: 'Cart', icon: 'dashicons dashicons-cart', section: 'gravisain_header_cart' }
        };

        function populateHeaderBuilderGrid() {
            var val = '';
            if (wp.customize('gravisain_header_builder_layout')) {
                val = wp.customize('gravisain_header_builder_layout').get();
            }
            var state = null;
            try {
                if (val) state = JSON.parse(val);
            } catch(e) {}
            if (!state || typeof state !== 'object') {
                state = {
                    top: { left: [], center: [], right: [] },
                    main: { left: ['logo'], center: ['primary-navigation'], right: [] },
                    bottom: { left: [], center: [], right: [] }
                };
            }

            $builder.find('.ghb-dropped-item').remove();

            $.each(state, function(row, cols) {
                $.each(cols, function(col, items) {
                    var $colEl = $builder.find('.ghb-row-wrapper[data-row="' + row + '"] .ghb-col[data-col="' + col + '"]');
                    if ($colEl.length && Array.isArray(items)) {
                        $.each(items, function(i, type) {
                            var meta = componentMap[type] || { label: type, icon: 'dashicons dashicons-admin-generic', section: '' };
                            var componentHTML = `
                                <div class="ghb-dropped-item" data-type="${type}" data-section="${meta.section || ''}">
                                    <span class="${meta.icon}"></span>
                                    <span class="ghb-item-label">${meta.label}</span>
                                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="Settings"></span>
                                    <span class="dashicons dashicons-no ghb-item-remove" title="Remove"></span>
                                </div>
                            `;
                            $(componentHTML).insertBefore($colEl.find('.ghb-add-item'));
                        });
                    }
                });
            });
            
            updatePickerAvailability();
        }

        // Initialize grid when setting is available
        if (wp.customize('gravisain_header_builder_layout')) {
            wp.customize('gravisain_header_builder_layout', function(setting) {
                populateHeaderBuilderGrid();
                setting.bind(function() {
                    if (!isUpdatingHeaderBuilderState) {
                        populateHeaderBuilderGrid();
                    }
                });
            });
        }
        setTimeout(populateHeaderBuilderGrid, 300);

        // Click on component or gear to focus relevant Customizer section
        $builder.on('click', '.ghb-dropped-item, .ghb-item-settings', function(e) {
            if ($(e.target).hasClass('ghb-item-remove')) return;
            e.stopPropagation();
            var type = $(this).closest('.ghb-dropped-item').data('type');
            var meta = componentMap[type];
            var sectionId = (meta && meta.section) ? meta.section : '';
            if (type === 'logo') sectionId = 'title_tagline';
            if (sectionId && wp.customize.section(sectionId)) {
                wp.customize.section(sectionId).focus();
            } else if (sectionId && wp.customize.panel(sectionId)) {
                wp.customize.panel(sectionId).focus();
            } else if (wp.customize.panel('gravisain_header_panel')) {
                wp.customize.panel('gravisain_header_panel').focus();
            }
        });

        // ==========================================
        // FOOTER BUILDER UI
        // ==========================================
        var footerBuilderHTML = `
            <div id="gravisain-footer-builder" class="gravisain-header-builder gravisain-footer-builder">
                <div class="ghb-header-bar">
                    <span style="font-weight:600; font-size:13px; margin-right:auto; color:#1d2327;">Footer Builder</span>
                    <button type="button" class="ghb-hide-btn gfb-hide-btn"><span class="dashicons dashicons-no-alt"></span> Hide</button>
                </div>
                <div class="ghb-body">
                    <div class="ghb-row-wrapper" data-row="top">
                        <div class="ghb-row-tab" data-section="gravisain_footer_top_row">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <span class="ghb-tab-title">TOP</span>
                        </div>
                        <div class="ghb-row-grid">
                            <div class="ghb-col" data-col="col-1"></div>
                            <div class="ghb-col" data-col="col-2"></div>
                            <div class="ghb-col" data-col="col-3"></div>
                            <div class="ghb-col" data-col="col-4"></div>
                        </div>
                    </div>
                    <div class="ghb-row-wrapper" data-row="main">
                        <div class="ghb-row-tab" data-section="gravisain_footer_main_row">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <span class="ghb-tab-title">MAIN</span>
                        </div>
                        <div class="ghb-row-grid">
                            <div class="ghb-col" data-col="col-1"></div>
                            <div class="ghb-col" data-col="col-2"></div>
                            <div class="ghb-col" data-col="col-3"></div>
                            <div class="ghb-col" data-col="col-4"></div>
                        </div>
                    </div>
                    <div class="ghb-row-wrapper" data-row="bottom">
                        <div class="ghb-row-tab" data-section="gravisain_footer_bottom_row">
                            <span class="dashicons dashicons-admin-generic"></span>
                            <span class="ghb-tab-title">BOTTOM</span>
                        </div>
                        <div class="ghb-row-grid">
                            <div class="ghb-col" data-col="col-1"></div>
                            <div class="ghb-col" data-col="col-2"></div>
                            <div class="ghb-col" data-col="col-3"></div>
                            <div class="ghb-col" data-col="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="gravisain-footer-builder-toggle" class="gravisain-header-builder-toggle gravisain-footer-builder-toggle">
                <span class="dashicons dashicons-admin-generic"></span> Footer Builder
            </button>
        `;

        var footerPickerHTML = `
            <div id="gfb-component-picker" class="ghb-component-picker">
                <div class="ghb-picker-header">Footer Components <span class="dashicons dashicons-no gfb-picker-close"></span></div>
                <div class="ghb-picker-body">
                    <div class="ghb-picker-item" data-type="copyright" data-label="Copyright"><span class="dashicons dashicons-editor-code"></span> Copyright</div>
                    <div class="ghb-picker-item" data-type="footer-navigation" data-label="Footer Nav"><span class="dashicons dashicons-menu"></span> Footer Nav</div>
                    <div class="ghb-picker-item" data-type="social" data-label="Social"><span class="dashicons dashicons-share"></span> Social</div>
                    <div class="ghb-picker-item" data-type="widget-1" data-label="Widget Area 1"><span class="dashicons dashicons-welcome-widgets-menus"></span> Widget 1</div>
                    <div class="ghb-picker-item" data-type="widget-2" data-label="Widget Area 2"><span class="dashicons dashicons-welcome-widgets-menus"></span> Widget 2</div>
                    <div class="ghb-picker-item" data-type="widget-3" data-label="Widget Area 3"><span class="dashicons dashicons-welcome-widgets-menus"></span> Widget 3</div>
                    <div class="ghb-picker-item" data-type="widget-4" data-label="Widget Area 4"><span class="dashicons dashicons-welcome-widgets-menus"></span> Widget 4</div>
                    <div class="ghb-picker-item" data-type="html" data-label="Custom HTML"><span class="dashicons dashicons-editor-code"></span> HTML</div>
                </div>
            </div>
        `;

        $previewContainer.append(footerBuilderHTML);
        $previewContainer.append(footerPickerHTML);

        var $fBuilder = $('#gravisain-footer-builder');
        var $fToggleBtn = $('#gravisain-footer-builder-toggle');
        var $fPicker = $('#gfb-component-picker');

        $fBuilder.find('.ghb-col').append('<div class="ghb-add-item" title="Add Component"><span class="dashicons dashicons-plus"></span></div>');

        var footerUniqueTypes = ['copyright', 'footer-navigation', 'social', 'widget-1', 'widget-2', 'widget-3', 'widget-4', 'html'];

        function updateFooterPickerAvailability() {
            var usedTypes = [];
            $fBuilder.find('.ghb-dropped-item').each(function() {
                usedTypes.push($(this).data('type'));
            });

            $fPicker.find('.ghb-picker-item').each(function() {
                var type = $(this).data('type');
                if (footerUniqueTypes.indexOf(type) !== -1 && usedTypes.indexOf(type) !== -1) {
                    $(this).addClass('is-disabled');
                    if (!$(this).find('.ghb-item-badge').length) {
                        $(this).append('<span class="ghb-item-badge" style="margin-left:auto; font-size:10px; background:#e2e8f0; color:#64748b; padding:1px 6px; border-radius:10px;">Used</span>');
                    }
                } else {
                    $(this).removeClass('is-disabled');
                    $(this).find('.ghb-item-badge').remove();
                }
            });
        }

        var isUpdatingFooterBuilderState = false;

        function updateFooterBuilderState() {
            var state = {
                top: { 'col-1': [], 'col-2': [], 'col-3': [], 'col-4': [] },
                main: { 'col-1': [], 'col-2': [], 'col-3': [], 'col-4': [] },
                bottom: { 'col-1': [], 'col-2': [], 'col-3': [], 'col-4': [] }
            };

            $fBuilder.find('.ghb-row-wrapper').each(function() {
                var row = $(this).data('row');
                $(this).find('.ghb-col').each(function() {
                    var col = $(this).data('col');
                    var components = [];
                    $(this).find('.ghb-dropped-item').each(function() {
                        components.push($(this).data('type'));
                    });
                    if (state[row] && state[row][col] !== undefined) {
                        state[row][col] = components;
                    }
                });
            });

            var jsonString = JSON.stringify(state);
            if (wp.customize('gravisain_footer_builder_layout')) {
                if (wp.customize('gravisain_footer_builder_layout').get() !== jsonString) {
                    isUpdatingFooterBuilderState = true;
                    wp.customize('gravisain_footer_builder_layout').set(jsonString);
                    isUpdatingFooterBuilderState = false;
                }
            }
        }

        function populateFooterBuilderGrid() {
            if (!wp.customize('gravisain_footer_builder_layout')) return;
            var val = wp.customize('gravisain_footer_builder_layout').get();
            var layout = {};
            try {
                layout = val ? JSON.parse(val) : {};
            } catch (e) {
                layout = {};
            }

            $fBuilder.find('.ghb-dropped-item').remove();

            var footerComponentLabels = {
                'copyright': 'Copyright',
                'footer-navigation': 'Footer Nav',
                'social': 'Social',
                'widget-1': 'Widget Area 1',
                'widget-2': 'Widget Area 2',
                'widget-3': 'Widget Area 3',
                'widget-4': 'Widget Area 4'
            };

            $.each(layout, function(row, cols) {
                $.each(cols, function(col, items) {
                    var $colEl = $fBuilder.find('.ghb-row-wrapper[data-row="' + row + '"] .ghb-col[data-col="' + col + '"]');
                    if ($colEl.length && Array.isArray(items)) {
                        $.each(items, function(i, type) {
                            var label = footerComponentLabels[type] || type;
                            var itemHTML = `
                                <div class="ghb-dropped-item" data-type="${type}">
                                    <span class="ghb-item-label">${label}</span>
                                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="Settings"></span>
                                    <span class="dashicons dashicons-no-alt ghb-item-remove" title="Remove"></span>
                                </div>
                            `;
                            $(itemHTML).insertBefore($colEl.find('.ghb-add-item'));
                        });
                    }
                });
            });

            updateFooterPickerAvailability();
        }

        var userHidFooter = false;
        function openFooterBuilder() {
            userHidFooter = false;
            $builder.removeClass('is-active'); // Close Header Builder
            $fToggleBtn.removeClass('is-visible');
            $fBuilder.addClass('is-active');
            $('.wp-full-overlay-main').css({ 'bottom': '330px', 'height': 'calc(100% - 330px)', 'padding-bottom': '0' });
            setTimeout(function() {
                try {
                    var $iframe = $('#customize-preview iframe');
                    if ($iframe.length && $iframe[0].contentWindow) {
                        var win = $iframe[0].contentWindow;
                        var doc = win.document;
                        if (doc && doc.body) {
                            win.scrollTo({ top: doc.body.scrollHeight, behavior: 'smooth' });
                        }
                    }
                } catch (e) {}
            }, 150);
        }

        var footerWidgetSections = [
            'sidebar-widgets-footer-widget-1',
            'sidebar-widgets-footer-widget-2',
            'sidebar-widgets-footer-widget-3',
            'sidebar-widgets-footer-widget-4'
        ];

        footerWidgetSections.forEach(function(secId) {
            wp.customize.section(secId, function(section) {
                section.expanded.bind(function(isExpanded) {
                    if (isExpanded && !userHidFooter) {
                        openFooterBuilder();
                    }
                });
            });
        });

        wp.customize.panel('gravisain_footer_panel', function(panel) {
            panel.expanded.bind(function(isExpanded) {
                if (isExpanded) {
                    if (!userHidFooter) {
                        openFooterBuilder();
                    } else {
                        $fToggleBtn.addClass('is-visible');
                    }
                } else {
                    setTimeout(function() {
                        var inFooterWidget = false;
                        footerWidgetSections.forEach(function(secId) {
                            var sec = wp.customize.section(secId);
                            if (sec && sec.expanded()) inFooterWidget = true;
                        });
                        if (!inFooterWidget) {
                            $fBuilder.removeClass('is-active');
                            $fToggleBtn.removeClass('is-visible');
                            if (!$builder.hasClass('is-active')) {
                                $('.wp-full-overlay-main').css({ 'bottom': '', 'height': '', 'padding-bottom': '' });
                            }
                        }
                    }, 80);
                }
            });
        });

        $fToggleBtn.on('click', function() {
            openFooterBuilder();
            if (wp.customize.panel('gravisain_footer_panel')) {
                wp.customize.panel('gravisain_footer_panel').focus();
            }
        });

        $fBuilder.on('click', '.gfb-hide-btn', function() {
            userHidFooter = true;
            $fBuilder.removeClass('is-active');
            $fToggleBtn.addClass('is-visible');
            if (!$builder.hasClass('is-active')) {
                $('.wp-full-overlay-main').css({ 'bottom': '', 'height': '', 'padding-bottom': '' });
            }
        });

        $fBuilder.on('click', '.ghb-row-tab', function() {
            var sectionId = $(this).data('section');
            if (sectionId && wp.customize.section(sectionId)) {
                wp.customize.section(sectionId).focus();
            }
        });

        var $activeFooterCol = null;
        $fBuilder.on('click', '.ghb-add-item', function(e) {
            e.stopPropagation();
            $activeFooterCol = $(this).closest('.ghb-col');
            var offset = $(this).offset();
            $fPicker.css({
                top: (offset.top - 210) + 'px',
                left: offset.left + 'px',
                display: 'flex'
            }).addClass('is-open');
        });

        $fPicker.on('click', '.gfb-picker-close', function() {
            $fPicker.removeClass('is-open').hide();
            $activeFooterCol = null;
        });

        $fPicker.on('click', '.ghb-picker-item', function() {
            if ($(this).hasClass('is-disabled') || !$activeFooterCol) return;
            var type = $(this).data('type');
            var label = $(this).data('label');
            var itemHTML = `
                <div class="ghb-dropped-item" data-type="${type}">
                    <span class="ghb-item-label">${label}</span>
                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="Settings"></span>
                    <span class="dashicons dashicons-no-alt ghb-item-remove" title="Remove"></span>
                </div>
            `;
            $(itemHTML).insertBefore($activeFooterCol.find('.ghb-add-item'));
            $fPicker.removeClass('is-open').hide();
            $activeFooterCol = null;
            updateFooterBuilderState();
            updateFooterPickerAvailability();
        });

        $fBuilder.on('click', '.ghb-item-remove', function(e) {
            e.stopPropagation();
            $(this).closest('.ghb-dropped-item').remove();
            updateFooterBuilderState();
            updateFooterPickerAvailability();
        });

        $fBuilder.find('.ghb-col').sortable({
            items: '.ghb-dropped-item',
            connectWith: '#gravisain-footer-builder .ghb-col',
            placeholder: 'ghb-sortable-placeholder',
            tolerance: 'pointer',
            start: function(event, ui) {
                $('#customize-preview iframe').css('pointer-events', 'none');
            },
            stop: function(event, ui) {
                $('#customize-preview iframe').css('pointer-events', 'auto');
                updateFooterBuilderState();
            }
        });

        if (wp.customize('gravisain_footer_builder_layout')) {
            wp.customize('gravisain_footer_builder_layout', function(setting) {
                populateFooterBuilderGrid();
                setting.bind(function() {
                    if (!isUpdatingFooterBuilderState) {
                        populateFooterBuilderGrid();
                    }
                });
            });
        }
        setTimeout(populateFooterBuilderGrid, 400);

        $fBuilder.on('click', '.ghb-dropped-item, .ghb-item-settings', function(e) {
            if ($(e.target).hasClass('ghb-item-remove')) return;
            e.stopPropagation();
            var type = $(this).closest('.ghb-dropped-item').data('type');
            var sectionId = '';
            var panelId = '';

            if (type === 'copyright') {
                sectionId = 'gravisain_footer_copyright_section';
            } else if (type === 'social') {
                sectionId = 'gravisain_footer_social';
            } else if (type === 'footer-navigation') {
                sectionId = 'gravisain_footer_navigation';
            } else if (type === 'html') {
                sectionId = 'gravisain_footer_html';
            } else if (type === 'widget-1') {
                sectionId = 'sidebar-widgets-footer-widget-1';
                panelId = 'widgets';
            } else if (type === 'widget-2') {
                sectionId = 'sidebar-widgets-footer-widget-2';
                panelId = 'widgets';
            } else if (type === 'widget-3') {
                sectionId = 'sidebar-widgets-footer-widget-3';
                panelId = 'widgets';
            } else if (type === 'widget-4') {
                sectionId = 'sidebar-widgets-footer-widget-4';
                panelId = 'widgets';
            } else {
                sectionId = 'gravisain_footer_main_row';
            }

            if (panelId && wp.customize.panel(panelId)) {
                wp.customize.panel(panelId).focus();
                setTimeout(function() {
                    if (sectionId && wp.customize.section(sectionId)) {
                        wp.customize.section(sectionId).focus();
                    }
                }, 150);
            } else if (sectionId && wp.customize.section(sectionId)) {
                wp.customize.section(sectionId).focus();
            } else if (wp.customize.panel('gravisain_footer_panel')) {
                wp.customize.panel('gravisain_footer_panel').focus();
            }
        });
    });

})(window.wp, jQuery);
