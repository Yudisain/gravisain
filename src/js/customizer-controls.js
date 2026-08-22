/**
 * Customizer Controls JS
 */
(function ($, wp) {
    'use strict';

    if (!wp || !wp.customize) {
        return;
    }

    /**
     * Gravisain Visibility Control
     */
    wp.customize.controlConstructor['gravisain-visibility'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;
            if (control.params.tab) {
                $el.attr('data-tab', control.params.tab);
            }
            var $buttons = $el.find('.gravisain-visibility-btn');
            var $hidden = $el.find('.gravisain-visibility-hidden-value');

            $buttons.on('click', function () {
                var $btn = $(this);
                $btn.toggleClass('active');

                var activeDevices = [];
                $buttons.filter('.active').each(function () {
                    activeDevices.push($(this).data('device'));
                });

                var valStr = activeDevices.join(',');
                $hidden.val(valStr);
                control.setting.set(valStr);
            });
        }
    });

    /**
     * Gravisain Slider Control
     */
    wp.customize.controlConstructor['gravisain-slider'] = wp.customize.Control.extend({

        ready: function () {
            var control = this;
            var $el = control.container;
            if (control.params.tab) {
                $el.attr('data-tab', control.params.tab);
            }

            control.$slider = $el.find('.gravisain-slider-range');
            control.$input = $el.find('.gravisain-slider-input');
            control.$hidden = $el.find('.gravisain-slider-hidden-value');
            control.$unitSelect = $el.find('.gravisain-slider-unit-select');
            control.$reset = $el.find('.gravisain-slider-reset');

            control.currentDevice = 'desktop';

            if (control.params.responsive) {
                var $deviceButtons = $el.find('.gravisain-responsive-devices button');
                $deviceButtons.on('click', function (e) {
                    e.stopPropagation();
                    var device = $(this).data('device');
                    if (wp.customize.previewedDevice) {
                        wp.customize.previewedDevice.set(device);
                    } else {
                        control.currentDevice = device;
                        control.initValues();
                    }
                });

                var setupDeviceBinding = function() {
                    if (wp.customize.previewedDevice) {
                        control.currentDevice = wp.customize.previewedDevice.get() || 'desktop';
                        wp.customize.previewedDevice.bind(function (device) {
                            control.currentDevice = device;
                            control.initValues();
                        });
                        control.initValues();
                    } else {
                        setTimeout(setupDeviceBinding, 50);
                    }
                };
                setupDeviceBinding();
            }

            control.initValues();
            control.bindEvents();
        },

        initValues: function () {
            var control = this;
            var val = control.setting.get() || '';
            var valToParse = val;

            if (control.params.responsive) {
                if (wp.customize.previewedDevice) {
                    control.currentDevice = wp.customize.previewedDevice.get() || 'desktop';
                }
                var currentDev = control.currentDevice || 'desktop';
                control.container.find('.gravisain-responsive-devices li').removeClass('active');
                control.container.find('.gravisain-responsive-devices li.' + currentDev).addClass('active');

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
                valToParse = obj[control.currentDevice] || obj['desktop'] || '';
            }

            var parsed = control.parseValue(valToParse);

            control.currentUnit = parsed.unit;
            control.currentValue = parsed.value;

            control.updateUI();
        },

        parseValue: function (val) {
            var control = this;
            var defaultUnit = control.params.units[0] || 'px';

            if (!val) {
                return { value: '', unit: defaultUnit };
            }

            var match = val.toString().match(/^(\d+(?:\.\d+)?)([a-zA-Z%]+)$/);
            if (match) {
                return { value: parseFloat(match[1]), unit: match[2] };
            }

            // Fallback if it's just a number
            return { value: parseFloat(val) || '', unit: defaultUnit };
        },

        updateUI: function () {
            var control = this;

            // Update Select Value
            control.$unitSelect.val(control.currentUnit);

            // Update Slider Attributes based on Unit
            var attrs = control.params.input_attrs[control.currentUnit] || { min: 0, max: 100, step: 1 };
            control.$slider.attr({
                min: attrs.min,
                max: attrs.max,
                step: attrs.step
            });
            control.$input.attr({
                min: attrs.min,
                max: attrs.max,
                step: attrs.step
            });

            // Set Values
            control.$slider.val(control.currentValue);
            control.$input.val(control.currentValue);
        },

        saveValue: function () {
            var control = this;
            var valStr = control.currentValue !== '' ? control.currentValue + control.currentUnit : '';

            if (control.params.responsive) {
                var currentVal = control.setting.get() || '';
                var obj = {};
                try {
                    if (typeof currentVal === 'string' && currentVal.charAt(0) === '{') {
                        obj = JSON.parse(currentVal);
                    } else if (typeof currentVal === 'object' && currentVal !== null) {
                        obj = Object.assign({}, currentVal);
                    } else if (typeof currentVal === 'string' && currentVal !== '') {
                        obj = { desktop: currentVal };
                    }
                } catch (e) {
                    obj = {};
                }
                obj[control.currentDevice] = valStr;
                var jsonStr = JSON.stringify(obj);
                control.$hidden.val(jsonStr);
                control.setting.set(jsonStr);
            } else {
                control.$hidden.val(valStr);
                control.setting.set(valStr);
            }
        },

        bindEvents: function () {
            var control = this;

            // Unit Select Change
            control.$unitSelect.on('change', function () {
                control.currentUnit = $(this).val();
                control.updateUI();
                control.saveValue();
            });

            // Slider Change
            control.$slider.on('input change', function () {
                control.currentValue = $(this).val();
                control.$input.val(control.currentValue);
                control.saveValue();
            });

            // Input Change
            control.$input.on('input change', function () {
                control.currentValue = $(this).val();
                control.$slider.val(control.currentValue);
                control.saveValue();
            });

            // Reset Click
            control.$reset.on('click', function () {
                var defaultVal = control.params.default || '';
                var valToParse = defaultVal;

                if (control.params.responsive) {
                    try {
                        if (typeof defaultVal === 'string' && defaultVal.charAt(0) === '{') {
                            var defObj = JSON.parse(defaultVal);
                            valToParse = defObj[control.currentDevice] || defObj['desktop'] || '';
                        }
                    } catch (e) {}
                }

                var parsed = control.parseValue(valToParse);
                
                control.currentValue = parsed.value;
                control.currentUnit = parsed.unit;
                control.updateUI();
                control.saveValue();
            });
        }
    });

    // Heading Control Constructor
    wp.customize.controlConstructor['gravisain-heading'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;
            if (control.params && control.params.tab) {
                $el.attr('data-tab', control.params.tab);
            }
        }
    });

    // Heading Section Constructor (Panel Category Divider)
    wp.customize.sectionConstructor['gravisain-heading-section'] = wp.customize.Section.extend({
        attachEvents: function () {}, // Empty so clicking does not open or trigger accordion
        isContextuallyActive: function () {
            return true;
        }
    });

    // Section Tabs Control Constructor
    wp.customize.controlConstructor['gravisain-section-tabs'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;
            var $section = $el.closest('.control-section');

            var switchTab = function (tabKey) {
                $el.find('.gravisain-tab-btn').removeClass('active');
                $el.find('.gravisain-tab-btn[data-tab="' + tabKey + '"]').addClass('active');

                $section.find('li.customize-control').each(function () {
                    var $controlLi = $(this);
                    if ($controlLi.hasClass('customize-control-gravisain-section-tabs')) {
                        return;
                    }
                    var ctrlId = $controlLi.attr('id') ? $controlLi.attr('id').replace('customize-control-', '') : '';
                    var controlTab = $controlLi.attr('data-tab') || $controlLi.data('tab') || $controlLi.find('[data-tab]').attr('data-tab') || $controlLi.find('[data-tab]').data('tab');
                    if (!controlTab && ctrlId && wp.customize.control(ctrlId) && wp.customize.control(ctrlId).params && wp.customize.control(ctrlId).params.tab) {
                        controlTab = wp.customize.control(ctrlId).params.tab;
                        $controlLi.attr('data-tab', controlTab);
                    }
                    if (!controlTab) {
                        if ((ctrlId && (ctrlId.indexOf('colors') !== -1 || ctrlId.indexOf('background') !== -1 || ctrlId.indexOf('font') !== -1 || ctrlId.indexOf('typography') !== -1 || ctrlId.indexOf('button_style') !== -1 || ctrlId.indexOf('button_size') !== -1)) || $controlLi.hasClass('customize-control-gravisain-color-group') || $controlLi.hasClass('customize-control-gravisain-typography') || $controlLi.hasClass('customize-control-gravisain-social-icons') || $controlLi.hasClass('customize-control-gravisain-button-group')) {
                            controlTab = 'style';
                        } else if ((ctrlId && (ctrlId.indexOf('menu') !== -1 || ctrlId.indexOf('spacing') !== -1 || ctrlId.indexOf('stretch') !== -1 || ctrlId.indexOf('fill_center') !== -1 || ctrlId.indexOf('tabs') !== -1))) {
                            controlTab = 'layout';
                        } else if ($controlLi.hasClass('customize-control-gravisain-slider') || ctrlId === 'gravisain_header_social_brand_colors' || $controlLi.hasClass('customize-control-color') || $controlLi.find('.customize-control-color, .wp-picker-container').length) {
                            controlTab = 'style';
                        } else {
                            controlTab = $el.find('.gravisain-tab-btn').first().data('tab') || 'layout';
                        }
                    }

                    if (controlTab === 'style' && !$el.find('.gravisain-tab-btn[data-tab="style"]').length && $el.find('.gravisain-tab-btn[data-tab="design"]').length) {
                        controlTab = 'design';
                    }

                    if (controlTab === tabKey) {
                        // For notice controls: check if transparent header is active
                        if ($controlLi.hasClass('customize-control-gravisain-notice')) {
                            var transparentSetting = wp.customize('gravisain_transparent_header_enable');
                            var isActive = transparentSetting && (function(v) {
                                return v === true || v === '1' || v === 1 || v === 'true';
                            })(transparentSetting.get());
                            if (isActive) {
                                $controlLi.css('display', '');
                            } else {
                                $controlLi.css('display', 'none');
                            }
                        } else if (!$controlLi.hasClass('gravisain-dependency-hidden')) {
                            $controlLi.css('display', '');
                        }
                    } else {
                        $controlLi.css('display', 'none');
                    }
                });
            };

            $el.on('click', '.gravisain-tab-btn', function (e) {
                e.preventDefault();
                var tabKey = $(this).data('tab');
                switchTab(tabKey);
            });

            setTimeout(function () {
                var firstTab = $el.find('.gravisain-tab-btn').first().data('tab') || 'layout';
                switchTab(firstTab);
            }, 100);
        }
    });

    // Social Icons Control Constructor
    wp.customize.controlConstructor['gravisain-social-icons'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;
            if (control.params.tab) {
                $el.attr('data-tab', control.params.tab);
            } else {
                $el.attr('data-tab', 'design');
            }
            var $list = $el.find('.gravisain-social-accordion-list');
            var $input = $el.find('.social-items-value-input');
            var defaultIcons = control.params.defaultIcons || {};

            var items = null;
            try {
                var val = $input.val();
                if (val && val !== '') items = JSON.parse(val);
            } catch (e) {}

            if (items === null) {
                var initKeys = ['facebook', 'threads', 'youtube', 'instagram', 'shopee'];
                items = [];
                $.each(initKeys, function (idx, key) {
                    var def = defaultIcons[key] || { label: key };
                    var legacyUrl = '';
                    if (wp.customize('gravisain_header_social_' + key)) {
                        legacyUrl = wp.customize('gravisain_header_social_' + key).get() || '';
                    }
                    items.push({
                        id: key,
                        label: def.label || key,
                        url: legacyUrl,
                        source_type: 'icon',
                        icon_style: 'filled',
                        custom_svg: '',
                        custom_image: '',
                        max_width: '24',
                        show_label: false
                    });
                });
            }

            function renderList() {
                $list.empty();
                $.each(items, function (idx, item) {
                    var def = defaultIcons[item.id] || { label: item.id, filled: '', outline: '', solid: '' };
                    var previewSvg = def.filled || '';
                    
                    if (item.source_type === 'svg' && item.custom_svg) previewSvg = item.custom_svg;
                    else if (item.source_type === 'image' && item.custom_image) previewSvg = '<img src="' + item.custom_image + '" style="max-width:18px;max-height:18px;" />';

                    var html = '<div class="gravisain-social-accordion-item" data-idx="' + idx + '" data-id="' + item.id + '">' +
                        '<div class="gravisain-social-accordion-header">' +
                            '<span class="social-icon-preview">' + previewSvg + '</span>' +
                            '<span class="social-label">' + (item.label || def.label) + '</span>' +
                            '<span class="accordion-toggle-sep"></span>' +
                            '<span class="dashicons dashicons-arrow-down-alt2 accordion-toggle"></span>' +
                        '</div>' +
                        '<div class="gravisain-social-accordion-body" style="display:none;">' +
                            '<div class="social-subtabs">' +
                                '<button type="button" class="subtab-btn ' + (item.source_type === 'icon' || !item.source_type ? 'active' : '') + '" data-subtab="icon">ICON</button>' +
                                '<button type="button" class="subtab-btn ' + (item.source_type === 'svg' ? 'active' : '') + '" data-subtab="svg">SVG</button>' +
                                '<button type="button" class="subtab-btn ' + (item.source_type === 'image' ? 'active' : '') + '" data-subtab="image">IMAGE</button>' +
                            '</div>' +

                            '<!-- ICON SUBTAB -->' +
                            '<div class="subtab-content subtab-icon" ' + (item.source_type !== 'icon' && item.source_type ? 'style="display:none;"' : '') + '>' +
                                '<div class="social-field-group" style="margin-bottom:12px;">' +
                                    '<label class="social-control-label">SOCIAL NETWORK</label>' +
                                    '<select class="social-select social-network-select" style="width:100%;">' +
                                        (function() {
                                            var opts = '';
                                            $.each(defaultIcons, function(k, d) {
                                                opts += '<option value="' + k + '" ' + (k === item.id ? 'selected' : '') + '>' + (d.label || k) + '</option>';
                                            });
                                            return opts;
                                        })() +
                                    '</select>' +
                                '</div>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">ITEM LABEL</label>' +
                                    '<input type="text" class="social-input social-label-input" value="' + (item.label || '') + '" />' +
                                '</div>' +
                                '<div class="social-field-group social-switch-group">' +
                                    '<label class="social-control-label">SHOW ICON LABEL</label>' +
                                    '<label class="gravisain-switch">' +
                                        '<input type="checkbox" class="social-checkbox social-showlabel-checkbox" ' + (item.show_label ? 'checked' : '') + ' />' +
                                        '<span class="gravisain-switch-slider"></span>' +
                                    '</label>' +
                                '</div>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">URL</label>' +
                                    '<input type="url" class="social-input social-url-input" placeholder="https://..." value="' + (item.url || '') + '" />' +
                                '</div>' +
                            '</div>' +

                            '<!-- SVG SUBTAB -->' +
                            '<div class="subtab-content subtab-svg" ' + (item.source_type !== 'svg' ? 'style="display:none;"' : '') + '>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">SVG HTML</label>' +
                                    '<textarea class="social-textarea social-svg-input" rows="3" placeholder="&lt;svg...&gt;...&lt;/svg&gt;">' + (item.custom_svg || '') + '</textarea>' +
                                '</div>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">MAX WIDTH (PX)</label>' +
                                    '<div class="slider-wrapper">' +
                                        '<input type="range" class="social-slider social-maxwidth-slider" min="10" max="100" value="' + (item.max_width || '24') + '" />' +
                                        '<input type="number" class="social-number social-maxwidth-number" min="10" max="100" value="' + (item.max_width || '24') + '" />' +
                                    '</div>' +
                                '</div>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">ITEM LABEL</label>' +
                                    '<input type="text" class="social-input social-label-input" value="' + (item.label || '') + '" />' +
                                '</div>' +
                                '<div class="social-field-group social-switch-group">' +
                                    '<label class="social-control-label">SHOW ICON LABEL</label>' +
                                    '<label class="gravisain-switch">' +
                                        '<input type="checkbox" class="social-checkbox social-showlabel-checkbox" ' + (item.show_label ? 'checked' : '') + ' />' +
                                        '<span class="gravisain-switch-slider"></span>' +
                                    '</label>' +
                                '</div>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">URL</label>' +
                                    '<input type="url" class="social-input social-url-input" placeholder="https://..." value="' + (item.url || '') + '" />' +
                                '</div>' +
                            '</div>' +

                            '<!-- IMAGE SUBTAB -->' +
                            '<div class="subtab-content subtab-image" ' + (item.source_type !== 'image' ? 'style="display:none;"' : '') + '>' +
                                '<div class="social-field-group">' +
                                    '<div class="image-upload-wrapper">' +
                                        '<button type="button" class="social-add-image-btn" ' + (item.custom_image ? 'style="display:none;"' : '') + '>Add Image</button>' +
                                        '<div class="image-preview-box" ' + (!item.custom_image ? 'style="display:none;"' : '') + '>' +
                                            '<img src="' + (item.custom_image || '') + '" class="social-image-preview" />' +
                                            '<button type="button" class="social-remove-image-btn">Remove</button>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">MAX WIDTH (PX)</label>' +
                                    '<div class="slider-wrapper">' +
                                        '<input type="range" class="social-slider social-maxwidth-slider" min="10" max="100" value="' + (item.max_width || '24') + '" />' +
                                        '<input type="number" class="social-number social-maxwidth-number" min="10" max="100" value="' + (item.max_width || '24') + '" />' +
                                    '</div>' +
                                '</div>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">ITEM LABEL</label>' +
                                    '<input type="text" class="social-input social-label-input" value="' + (item.label || '') + '" />' +
                                '</div>' +
                                '<div class="social-field-group social-switch-group">' +
                                    '<label class="social-control-label">SHOW ICON LABEL</label>' +
                                    '<label class="gravisain-switch">' +
                                        '<input type="checkbox" class="social-checkbox social-showlabel-checkbox" ' + (item.show_label ? 'checked' : '') + ' />' +
                                        '<span class="gravisain-switch-slider"></span>' +
                                    '</label>' +
                                '</div>' +
                                '<div class="social-field-group">' +
                                    '<label class="social-control-label">URL</label>' +
                                    '<input type="url" class="social-input social-url-input" placeholder="https://..." value="' + (item.url || '') + '" />' +
                                '</div>' +
                            '</div>' +

                            '<div class="social-item-footer">' +
                                '<button type="button" class="social-item-remove-btn">Remove Item <span class="dashicons dashicons-no-alt"></span></button>' +
                            '</div>' +

                        '</div>' +
                    '</div>';

                    $list.append(html);
                });
            }

            function saveItems() {
                var json = JSON.stringify(items);
                $input.val(json).trigger('change');
                control.setting.set(json);

                // Also sync to legacy settings so they stay compatible
                $.each(items, function(i, item) {
                    if (wp.customize('gravisain_header_social_' + item.id)) {
                        wp.customize('gravisain_header_social_' + item.id).set(item.url || '');
                    }
                });
            }

            // Accordion toggle
            $list.on('click', '.gravisain-social-accordion-header', function() {
                var $item = $(this).closest('.gravisain-social-accordion-item');
                $item.toggleClass('is-expanded');
                $item.find('.gravisain-social-accordion-body').slideToggle(200);
            });

            // Subtab toggle
            $list.on('click', '.subtab-btn', function() {
                var $btn = $(this);
                var $item = $btn.closest('.gravisain-social-accordion-item');
                var idx = $item.data('idx');
                var subtab = $btn.data('subtab');

                $btn.siblings().removeClass('active');
                $btn.addClass('active');

                $item.find('.subtab-content').hide();
                $item.find('.subtab-' + subtab).show();

                items[idx].source_type = subtab;
                saveItems();
                updatePreviewIcon($item, items[idx]);
            });

            // Input changes (Label, ShowLabel, URL, SVG, MaxWidth)
            $list.on('input change', '.social-label-input, .social-showlabel-checkbox, .social-url-input, .social-svg-input, .social-maxwidth-slider, .social-maxwidth-number', function() {
                var $el = $(this);
                var $item = $el.closest('.gravisain-social-accordion-item');
                var idx = $item.data('idx');

                if ($el.hasClass('social-label-input')) {
                    var val = $el.val();
                    items[idx].label = val;
                    $item.find('.social-label-input').val(val); // sync all 3 inputs
                    $item.find('.social-label').text(val);
                } else if ($el.hasClass('social-showlabel-checkbox')) {
                    var val = $el.is(':checked');
                    items[idx].show_label = val;
                    $item.find('.social-showlabel-checkbox').prop('checked', val); // sync all 3 checkboxes
                } else if ($el.hasClass('social-url-input')) {
                    var val = $el.val();
                    items[idx].url = val;
                    $item.find('.social-url-input').val(val); // sync all 3 inputs
                } else if ($el.hasClass('social-svg-input')) {
                    items[idx].custom_svg = $el.val();
                    updatePreviewIcon($item, items[idx]);
                } else if ($el.hasClass('social-maxwidth-slider')) {
                    var val = $el.val();
                    items[idx].max_width = val;
                    $item.find('.social-maxwidth-number').val(val);
                    $item.find('.social-maxwidth-slider').val(val);
                } else if ($el.hasClass('social-maxwidth-number')) {
                    var val = $el.val();
                    items[idx].max_width = val;
                    $item.find('.social-maxwidth-slider').val(val);
                    $item.find('.social-maxwidth-number').val(val);
                }

                saveItems();
            });

            // Media uploader
            $list.on('click', '.social-add-image-btn', function() {
                var $btn = $(this);
                var $item = $btn.closest('.gravisain-social-accordion-item');
                var idx = $item.data('idx');

                var frame = wp.media({
                    title: 'Select Social Icon Image',
                    button: { text: 'Use Image' },
                    multiple: false
                });

                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    var imgUrl = attachment.url;
                    items[idx].custom_image = imgUrl;
                    $item.find('.social-add-image-btn').hide();
                    $item.find('.image-preview-box').show().find('.social-image-preview').attr('src', imgUrl);
                    saveItems();
                    updatePreviewIcon($item, items[idx]);
                });

                frame.open();
            });

            $list.on('click', '.social-remove-image-btn', function() {
                var $btn = $(this);
                var $item = $btn.closest('.gravisain-social-accordion-item');
                var idx = $item.data('idx');

                items[idx].custom_image = '';
                $item.find('.image-preview-box').hide().find('.social-image-preview').attr('src', '');
                $item.find('.social-add-image-btn').show();
                saveItems();
                updatePreviewIcon($item, items[idx]);
            });

            // Remove social item
            $list.on('click', '.social-item-remove-btn', function(e) {
                e.stopPropagation();
                var $item = $(this).closest('.gravisain-social-accordion-item');
                var idx = $item.data('idx');
                items.splice(idx, 1);
                saveItems();
                renderList();
            });

            // Add social network item - Toggle picker
            control.container.on('click', '.gravisain-social-add-btn', function() {
                var $picker = control.container.find('.gravisain-social-network-picker');
                var $grid = $picker.find('.gravisain-social-picker-grid');
                
                if ($grid.is(':empty')) {
                    var sortedKeys = Object.keys(defaultIcons).sort(function(a, b) {
                        var labelA = (defaultIcons[a].label || a).toUpperCase();
                        var labelB = (defaultIcons[b].label || b).toUpperCase();
                        return labelA.localeCompare(labelB);
                    });
                    
                    var html = '';
                    $.each(sortedKeys, function(i, key) {
                        var def = defaultIcons[key];
                        html += '<button type="button" class="gravisain-picker-item-btn" data-id="' + key + '">' +
                            (def.label || key).toUpperCase() +
                        '</button>';
                    });
                    $grid.html(html);
                }
                
                $picker.slideToggle(200);
            });

            // Close picker button
            control.container.on('click', '.gravisain-close-picker-btn', function() {
                control.container.find('.gravisain-social-network-picker').slideUp(200);
            });

            // Select item from picker
            control.container.on('click', '.gravisain-picker-item-btn', function() {
                var toAdd = $(this).data('id');
                var def = defaultIcons[toAdd] || { label: toAdd };
                
                items.push({
                    id: toAdd,
                    label: def.label || toAdd,
                    url: '',
                    source_type: 'icon',
                    icon_style: 'filled',
                    custom_svg: '',
                    custom_image: '',
                    max_width: '24',
                    show_label: false
                });
                
                saveItems();
                renderList();
                
                // Hide picker
                control.container.find('.gravisain-social-network-picker').slideUp(200);

                // Auto expand newly added item
                var $newItem = $list.find('.gravisain-social-accordion-item').last();
                $newItem.addClass('is-expanded');
                $newItem.find('.gravisain-social-accordion-body').show();
            });


            // Reset to defaults button
            control.container.on('click', '.gravisain-social-reset-btn', function() {
                if (!confirm('Reset social networks list to default (Facebook, Threads, YouTube, Instagram, Shopee)?')) {
                    return;
                }
                var initKeys = ['facebook', 'threads', 'youtube', 'instagram', 'shopee'];
                items = [];
                $.each(initKeys, function (idx, key) {
                    var def = defaultIcons[key] || { label: key };
                    items.push({
                        id: key,
                        label: def.label || key,
                        url: '',
                        source_type: 'icon',
                        icon_style: 'filled',
                        custom_svg: '',
                        custom_image: '',
                        max_width: '24',
                        show_label: false
                    });
                });
                saveItems();
                renderList();
            });

            // Social network select dropdown change
            $list.on('change', '.social-network-select', function() {
                var $select = $(this);
                var $item = $select.closest('.gravisain-social-accordion-item');
                var idx = $item.data('idx');
                var newId = $select.val();
                var def = defaultIcons[newId] || { label: newId, filled: '', outline: '', solid: '' };

                items[idx].id = newId;
                items[idx].label = def.label || newId;

                $item.attr('data-id', newId);
                $item.find('.social-label').text(items[idx].label);
                $item.find('.social-label-input').val(items[idx].label);

                saveItems();
                updatePreviewIcon($item, items[idx]);
            });

            function updatePreviewIcon($item, item) {
                var def = defaultIcons[item.id] || { filled: '', outline: '', solid: '' };
                var previewSvg = def.filled || '';
                
                if (item.source_type === 'svg' && item.custom_svg) previewSvg = item.custom_svg;
                else if (item.source_type === 'image' && item.custom_image) previewSvg = '<img src="' + item.custom_image + '" style="max-width:18px;max-height:18px;" />';
                $item.find('.social-icon-preview').html(previewSvg);
            }

            renderList();
        }
    });

    // Notice Control Constructor
    // Handles visibility of notice controls that depend on the transparent header setting.
    // We do NOT use gravisain-dependency-hidden to avoid conflicts with switchTab.
    // Instead, switchTab checks gravisain_transparent_header_enable directly for notice controls.
    wp.customize.controlConstructor['gravisain-notice'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var tab = control.params.tab || (control.params.wrapper_attrs ? control.params.wrapper_attrs['data-tab'] : '');
            if ( tab ) {
                control.container.attr('data-tab', tab);
            }

            // If this is a transparent notice, add an attribute for switchTab to look for
            if (control.params.type === 'transparent-notice' || (control.params.description && control.params.description.indexOf('transparent') !== -1)) {
                control.container.attr('data-transparent-notice', '1');
            }

            // React to transparent header setting changes: re-trigger current tab display
            var setting = wp.customize('gravisain_transparent_header_enable');
            if (setting) {
                setting.bind(function() {
                    // Find and trigger the active tab button to re-apply switchTab
                    var $section = control.container.closest('.control-section');
                    var $activeTab = $section.find('.gravisain-tab-btn.active');
                    if ($activeTab.length) {
                        $activeTab.trigger('click');
                    }
                });
            }
        }
    });

    // Toggle Control Constructor
    wp.customize.controlConstructor['gravisain-toggle'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $input = control.container.find('.gravisain-toggle-input');

            // Set initial checked state from setting value
            var currentVal = control.setting.get();
            if ( currentVal === true || currentVal === 'true' || currentVal === '1' || currentVal === 1 ) {
                $input.prop('checked', true);
            } else {
                $input.prop('checked', false);
            }

            // When the toggle is clicked, update the setting
            $input.on('change', function () {
                control.setting.set( $(this).is(':checked') ? true : false );
            });

            // Handle data-tab visibility for Section Tabs
            var tab = control.params.tab || '';
            if ( tab ) {
                control.container.attr('data-tab', tab);
            }
        }
    });



    /**
     * Gravisain Color Group Control
     */
    wp.customize.controlConstructor['gravisain-color-group'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;
            var tab = control.params.tab || (control.params.wrapper_attrs ? control.params.wrapper_attrs['data-tab'] : '') || 'design';
            $el.attr('data-tab', tab);
            var $activeTab = $el.closest('.control-section').find('.gravisain-tab-btn.active');
            if ($activeTab.length) {
                if ($activeTab.data('tab') === tab) {
                    $el.css('display', '');
                } else {
                    $el.css('display', 'none');
                }
            }

            var $reset = $el.find('.gravisain-accordion-reset');
            var $header = $el.find('.gravisain-accordion-header');
            var $body = $el.find('.gravisain-accordion-body');
            var $toggle = $el.find('.gravisain-accordion-toggle');

            // Toggle accordion
            $header.on('click', function(e) {
                if ($(e.target).closest('.gravisain-accordion-reset').length) {
                    return;
                }
                $el.toggleClass('collapsed');
                $body.slideToggle(200);
                if ($el.hasClass('collapsed')) {
                    $toggle.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
                } else {
                    $toggle.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
                }
            });

            // Get current value object
            var getValObj = function() {
                var valStr = control.setting.get();
                var obj = {};
                try {
                    if (typeof valStr === 'string' && valStr !== '') {
                        obj = JSON.parse(valStr) || {};
                    } else if (typeof valStr === 'object' && valStr !== null) {
                        obj = JSON.parse(JSON.stringify(valStr)) || {};
                    }
                } catch(e) {
                    obj = {};
                }
                return obj;
            };

            // Save value object
            var saveValObj = function(obj) {
                var jsonStr = JSON.stringify(obj);
                control.setting.set(jsonStr);
                if (wp.customize && wp.customize.state && wp.customize.state('saved')) {
                    wp.customize.state('saved').set(false);
                }
                if (wp.customize && wp.customize.previewer && wp.customize.previewer.send) {
                    wp.customize.previewer.send('setting', [control.setting.id, jsonStr]);
                }
            };

            // Helper to update both input and React SketchPicker mount
            var updateReactColorPicker = function($input, color) {
                var fieldKey = $input.attr('data-field');
                $input.val(color).trigger('change');
                var $mount = $input.prev('.gravisain-react-color-picker-mount');
                if ($mount.length && window.GravisainMountColorPicker) {
                    window.GravisainMountColorPicker($mount[0], {
                        initialColor: color,
                        onChange: function(newColor) {
                            $input.val(newColor).trigger('change');
                            var obj = getValObj();
                            obj[fieldKey] = newColor;
                            saveValObj(obj);
                        },
                        onClear: function() {
                            $input.val('').trigger('change');
                            var obj = getValObj();
                            obj[fieldKey] = '';
                            saveValObj(obj);
                        }
                    });
                }
            };

            // Initialize color pickers
            $el.find('.gravisain-color-picker-input').each(function() {
                var $input = $(this);
                // Hide the original input
                $input.hide();
                // Create a mount point for React
                var $mountPoint = $('<div class="gravisain-react-color-picker-mount" style="display: inline-block;"></div>');
                $input.before($mountPoint);
                updateReactColorPicker($input, $input.val());
            });

            // Reset button
            $reset.on('click', function(e) {
                e.stopPropagation();
                var defaultObj = {};
                $el.find('.gravisain-color-group-row').each(function() {
                    var k = $(this).attr('data-field');
                    defaultObj[k] = '';
                });
                saveValObj(defaultObj);
                $el.find('.gravisain-color-picker-input').each(function() {
                    updateReactColorPicker($(this), '');
                });
            });

            // Globe button (Global Palette quick selector)
            $el.find('.gravisain-color-globe-btn').on('click', function(e) {
                e.preventDefault();
                var $btn = $(this);
                $btn.toggleClass('active');
                var $pickerWrap = $btn.closest('.gravisain-color-group-picker-wrap');
                var $input = $pickerWrap.find('.gravisain-color-picker-input');
                if ($btn.hasClass('active')) {
                    var paletteColors = ['#4f46e5', '#10b981', '#f59e0b', '#ef4444', '#3b82f6', '#1e293b', '#64748b'];
                    if (window.GravisainCustomizerOptions && window.GravisainCustomizerOptions.palette && window.GravisainCustomizerOptions.palette.length) {
                        paletteColors = window.GravisainCustomizerOptions.palette;
                    }
                    var randomColor = paletteColors[0] || '#4f46e5';
                    updateReactColorPicker($input, randomColor);
                    var obj = getValObj();
                    var fieldKey = $input.attr('data-field');
                    obj[fieldKey] = randomColor;
                    saveValObj(obj);
                }
            });
        }
    });

    /**
     * Gravisain Typography Control
     */
    wp.customize.controlConstructor['gravisain-typography'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;
            var tab = control.params.tab || (control.params.wrapper_attrs ? control.params.wrapper_attrs['data-tab'] : '') || 'design';
            $el.attr('data-tab', tab);
            var $activeTab = $el.closest('.control-section').find('.gravisain-tab-btn.active');
            if ($activeTab.length) {
                if ($activeTab.data('tab') === tab) {
                    $el.css('display', '');
                } else {
                    $el.css('display', 'none');
                }
            }

            var $reset = $el.find('.gravisain-accordion-reset');
            var $header = $el.find('.gravisain-accordion-header');
            var $body = $el.find('.gravisain-accordion-body');
            var $toggle = $el.find('.gravisain-accordion-toggle');
            var $preview = $el.find('.gravisain-typography-live-preview');

            // Toggle accordion
            $header.on('click', function(e) {
                if ($(e.target).closest('.gravisain-accordion-reset').length) {
                    return;
                }
                $el.toggleClass('collapsed');
                $body.slideToggle(200);
                if ($el.hasClass('collapsed')) {
                    $toggle.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
                } else {
                    $toggle.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
                }
            });

            var getValObj = function() {
                var valStr = control.setting.get();
                var obj = {};
                try {
                    if (typeof valStr === 'string' && valStr !== '') {
                        obj = JSON.parse(valStr) || {};
                    } else if (typeof valStr === 'object' && valStr !== null) {
                        obj = valStr;
                    }
                } catch(e) {
                    obj = {};
                }
                return obj;
            };

            var saveValObj = function(obj) {
                control.setting.set(JSON.stringify(obj));
            };

            var updateLivePreview = function(obj) {
                var fam = obj.family || 'inherit';
                if (fam === 'system-stack') {
                    fam = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
                }
                $preview.css('font-family', fam);

                var st = obj.style || 'normal';
                if (st.indexOf('italic') !== -1) {
                    $preview.css('font-style', 'italic');
                } else {
                    $preview.css('font-style', 'normal');
                }

                var numMatch = st.match(/\d+/);
                if (numMatch) {
                    $preview.css('font-weight', numMatch[0]);
                } else if (st === 'bold' || st === 'bold italic') {
                    $preview.css('font-weight', '700');
                } else {
                    $preview.css('font-weight', '500');
                }

                var sz = obj.size || '16';
                $preview.css('font-size', sz + 'px');

                var sp = obj.spacing || '0';
                $preview.css('letter-spacing', sp + 'px');
            };

            // References for font picker
            var $fontRow = $el.find('.gravisain-font-family-row');
            var $picker = $fontRow.find('.gravisain-font-picker');
            var $pickerSelected = $fontRow.find('.gravisain-font-picker-selected');
            var $pickerValue = $fontRow.find('.gravisain-font-picker-value');
            var $pickerDropdown = $fontRow.find('.gravisain-font-picker-dropdown');
            var $pickerSearch = $fontRow.find('.gravisain-font-picker-search input');
            var $pickerList = $fontRow.find('.gravisain-font-picker-list');
            var $hiddenFamily = $fontRow.find('.gravisain-typography-input-family');
            
            var $styleSelect = $el.find('[data-field="style"]');
            var $sizeInput = $el.find('[data-field="size"]');
            var $spacingInput = $el.find('[data-field="spacing"]');

            var fontsData = typeof GravisainFonts !== 'undefined' ? GravisainFonts : { catalog: {}, system_fonts: {} };
            var catalog = fontsData.catalog || {};
            var systemFonts = fontsData.system_fonts || {};

            var weightLabels = {
                100: 'Thin (100)',
                200: 'Extra Light (200)',
                300: 'Light (300)',
                400: 'Regular (400)',
                500: 'Medium (500)',
                600: 'Semi Bold (600)',
                700: 'Bold (700)',
                800: 'Extra Bold (800)',
                900: 'Black (900)'
            };

            var getFallback = function(category) {
                switch(category) {
                    case 'serif': return 'serif';
                    case 'monospace': return 'monospace';
                    case 'handwriting': return 'cursive';
                    case 'display': return 'sans-serif';
                    default: return 'sans-serif';
                }
            };

            var buildFontList = function() {
                var html = '';
                
                // System Fonts
                html += '<li class="gravisain-font-picker-optgroup">System Fonts</li>';
                $.each(systemFonts, function(key, label) {
                    html += '<li class="gravisain-font-picker-option" data-val="' + key + '" data-label="' + label + '" data-type="system">' + label + '</li>';
                });

                // Google Fonts grouped by category
                var categories = {};
                $.each(catalog, function(key, data) {
                    var cat = data.category || 'sans-serif';
                    if (!categories[cat]) categories[cat] = [];
                    categories[cat].push(key);
                });

                var catOrder = ['sans-serif', 'serif', 'display', 'handwriting', 'monospace'];
                $.each(catOrder, function(i, cat) {
                    if (categories[cat] && categories[cat].length > 0) {
                        html += '<li class="gravisain-font-picker-optgroup">Google Fonts: ' + cat.toUpperCase() + '</li>';
                        categories[cat].sort();
                        $.each(categories[cat], function(j, key) {
                            var fallback = getFallback(cat);
                            var val = key + ', ' + fallback; // Save format: "Inter, sans-serif"
                            html += '<li class="gravisain-font-picker-option" data-val="' + val + '" data-label="' + key + '" data-type="google" data-key="' + key + '">' + key + '</li>';
                        });
                    }
                });
                
                $pickerList.html(html);
            };

            var updateStyleDropdown = function(fontKey, currentStyle) {
                if (!fontKey) return;
                
                var availableWeights = [400, 700]; // Default fallback for system fonts
                var isGoogle = false;

                // Extract pure name if it has fallback
                var pureName = fontKey.split(',')[0].replace(/['"]/g, '').trim();

                if (catalog[pureName] && catalog[pureName].weights) {
                    availableWeights = catalog[pureName].weights;
                    isGoogle = true;
                }

                var html = '';
                if (!isGoogle && (pureName === 'inherit' || pureName === 'system-stack')) {
                    // Standard styles
                    html += '<option value="normal">Normal</option>';
                    html += '<option value="italic">Italic</option>';
                    html += '<option value="700">Bold (700)</option>';
                    html += '<option value="700 italic">Bold Italic</option>';
                } else {
                    $.each(availableWeights, function(i, w) {
                        var lbl = weightLabels[w] || (w + '');
                        html += '<option value="' + w + '">' + lbl + '</option>';
                        html += '<option value="' + w + ' italic">' + lbl + ' Italic</option>';
                    });
                }

                $styleSelect.html(html);

                // Try to keep previously selected style if it exists
                if ($styleSelect.find('option[value="' + currentStyle + '"]').length > 0) {
                    $styleSelect.val(currentStyle);
                } else {
                    $styleSelect.find('option:first').prop('selected', true);
                }
            };

            var getValObj = function() {
                var valStr = control.setting.get();
                var obj = {};
                try {
                    if (typeof valStr === 'string' && valStr !== '') {
                        obj = JSON.parse(valStr) || {};
                    } else if (typeof valStr === 'object' && valStr !== null) {
                        obj = valStr;
                    }
                } catch(e) {
                    obj = {};
                }
                return obj;
            };

            var saveValObj = function(obj) {
                control.setting.set(JSON.stringify(obj));
            };

            var updateLivePreview = function(obj) {
                var fam = obj.family || 'inherit';
                var pureName = fam.split(',')[0].replace(/['"]/g, '').trim();

                if (fam === 'system-stack') {
                    fam = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
                }

                // If Google Font, dynamically load it for the preview area
                if (catalog[pureName]) {
                    var styleUrl = 'https://fonts.googleapis.com/css2?family=' + pureName.replace(/\s+/g, '+') + ':ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap';
                    var linkId = 'gravisain-preview-font-' + pureName.replace(/\s+/g, '-').toLowerCase();
                    if ($('#' + linkId).length === 0) {
                        $('head').append('<link id="' + linkId + '" rel="stylesheet" href="' + styleUrl + '">');
                    }
                }

                $preview.css('font-family', fam);

                var st = obj.style || 'normal';
                if (st.indexOf('italic') !== -1) {
                    $preview.css('font-style', 'italic');
                } else {
                    $preview.css('font-style', 'normal');
                }

                var numMatch = st.match(/\d+/);
                if (numMatch) {
                    $preview.css('font-weight', numMatch[0]);
                } else if (st === 'bold' || st === 'bold italic') {
                    $preview.css('font-weight', '700');
                } else {
                    $preview.css('font-weight', '400');
                }

                var sz = obj.size || '16';
                $preview.css('font-size', sz + 'px');
                
                var lh = obj.line_height !== undefined && obj.line_height !== '' ? obj.line_height : '1.5';
                $preview.css('line-height', lh);

                var sp = obj.spacing !== undefined && obj.spacing !== '' ? obj.spacing : '0';
                $preview.css('letter-spacing', sp + 'px');
            };

            // Initialize Customizer Control View
            buildFontList();
            var initialObj = getValObj();
            var initialFamily = initialObj.family || 'inherit';
            var initialStyle = initialObj.style || 'normal';
            
            // Set initial label
            var $initialOpt = $pickerList.find('.gravisain-font-picker-option[data-val="' + initialFamily + '"]');
            if ($initialOpt.length) {
                $pickerValue.text($initialOpt.data('label'));
                $initialOpt.addClass('is-selected');
            } else {
                var pureInit = initialFamily.split(',')[0].replace(/['"]/g, '').trim();
                $pickerValue.text(pureInit);
            }
            updateStyleDropdown(initialFamily, initialStyle);

            // Picker Events
            $pickerSelected.on('click', function(e) {
                e.stopPropagation();
                var isOpen = $pickerDropdown.is(':visible');
                $('.gravisain-font-picker-dropdown').hide(); // close others
                if (!isOpen) {
                    $pickerDropdown.show();
                    $pickerSearch.val('').trigger('input').focus();
                    
                    // scroll to selected
                    var $selected = $pickerList.find('.is-selected');
                    if ($selected.length) {
                        $pickerList.scrollTop($selected[0].offsetTop - $pickerList.height()/2);
                    }
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.gravisain-font-picker').length) {
                    $pickerDropdown.hide();
                }
            });

            $pickerSearch.on('input', function() {
                var q = $(this).val().toLowerCase().trim();
                if (!q) {
                    $pickerList.find('li').show();
                    return;
                }
                $pickerList.find('li').each(function() {
                    var $li = $(this);
                    if ($li.hasClass('gravisain-font-picker-optgroup')) {
                        $li.show(); // keep groups visible initially, filter later if empty
                    } else {
                        var text = $li.text().toLowerCase();
                        if (text.indexOf(q) !== -1) {
                            $li.show();
                        } else {
                            $li.hide();
                        }
                    }
                });
                
                // Hide empty optgroups
                $pickerList.find('.gravisain-font-picker-optgroup').each(function() {
                    var $group = $(this);
                    var $nextOptions = $group.nextUntil('.gravisain-font-picker-optgroup').filter('.gravisain-font-picker-option');
                    if ($nextOptions.filter(':visible').length === 0) {
                        $group.hide();
                    } else {
                        $group.show();
                    }
                });
            });

            $pickerList.on('click', '.gravisain-font-picker-option', function(e) {
                e.stopPropagation();
                var $opt = $(this);
                var val = $opt.attr('data-val');
                var label = $opt.attr('data-label');
                
                $pickerList.find('.is-selected').removeClass('is-selected');
                $opt.addClass('is-selected');
                $pickerValue.text(label);
                $hiddenFamily.val(val).trigger('change');
                $pickerDropdown.hide();
            });

            // Listen for changes on all inputs
            $el.find('.gravisain-typography-input-family, .gravisain-typography-select, .gravisain-typography-input').on('change input', function() {
                var $field = $(this);
                var fieldKey = $field.attr('data-field');
                var val = $field.val();
                
                var obj = getValObj();
                obj[fieldKey] = val;
                
                if (fieldKey === 'family') {
                    // Update style options based on new font family
                    updateStyleDropdown(val, obj.style || 'normal');
                    // Ensure obj.style is valid for new family
                    obj.style = $styleSelect.val() || 'normal';
                }

                saveValObj(obj);
                updateLivePreview(obj);
            });

            var $rangeSlider = $el.find('.gravisain-typography-range-slider');

            $rangeSlider.on('input change', function() {
                var val = $(this).val();
                $spacingInput.val(val).trigger('change');
            });

            $spacingInput.on('input change', function() {
                var val = $(this).val();
                $rangeSlider.val(val);
            });

            // Reset
            $reset.on('click', function(e) {
                e.stopPropagation();
                var defaultObj = { family: 'inherit', style: 'normal', size: '16', line_height: '1.5', spacing: '0' };
                saveValObj(defaultObj);
                
                $hiddenFamily.val('inherit');
                $pickerList.find('.is-selected').removeClass('is-selected');
                var $defOpt = $pickerList.find('.gravisain-font-picker-option[data-val="inherit"]');
                if ($defOpt.length) {
                    $defOpt.addClass('is-selected');
                    $pickerValue.text($defOpt.attr('data-label'));
                } else {
                    $pickerValue.text('Inherit');
                }
                
                updateStyleDropdown('inherit', 'normal');
                $styleSelect.val('normal');
                $sizeInput.val('16');
                $el.find('[data-field="line_height"]').val('1.5');
                $spacingInput.val('0');
                if (typeof $rangeSlider !== 'undefined' && $rangeSlider.length) {
                    $rangeSlider.val('0');
                }
                updateLivePreview(defaultObj);
            });
        }
    });


    // Dynamic Visibility for Controls
    wp.customize.bind('ready', function() {
        // Toggle Fill and Center control based on Stretch Menu (Primary)
        var toggleFillCenterVisibility = function(isStretch) {
            var control = wp.customize.control('gravisain_header_primary_nav_fill_center');
            if (control) {
                var active = (isStretch === true || isStretch === 'true' || isStretch === 1 || isStretch === '1');
                if (active) {
                    control.container.slideDown(200);
                } else {
                    control.container.slideUp(200);
                }
            }
        };

        // Toggle Fill and Center control based on Stretch Menu (Secondary)
        var toggleSecondaryFillCenterVisibility = function(isStretch) {
            var control = wp.customize.control('gravisain_header_secondary_nav_fill_center');
            if (control) {
                var active = (isStretch === true || isStretch === 'true' || isStretch === 1 || isStretch === '1');
                if (active) {
                    control.container.slideDown(200);
                } else {
                    control.container.slideUp(200);
                }
            }
        };

        // Initial check for Primary
        if (wp.customize('gravisain_header_primary_nav_stretch')) {
            toggleFillCenterVisibility(wp.customize('gravisain_header_primary_nav_stretch').get());

            // Listen for changes
            wp.customize('gravisain_header_primary_nav_stretch', function(setting) {
                setting.bind(toggleFillCenterVisibility);
            });
        }

        // Initial check for Secondary
        // Toggle Fill Center for Secondary Navigation
        var toggleSecondaryFillCenterVisibility = function(stretch) {
            var control = wp.customize.control('gravisain_header_secondary_nav_fill_center');
            if (control) {
                if (stretch === 'stretch') {
                    control.container.removeClass('gravisain-dependency-hidden').slideDown(200);
                } else {
                    control.container.addClass('gravisain-dependency-hidden').slideUp(200);
                }
            }
        };

        if (wp.customize('gravisain_header_secondary_nav_stretch')) {
            toggleSecondaryFillCenterVisibility(wp.customize('gravisain_header_secondary_nav_stretch').get());
            wp.customize('gravisain_header_secondary_nav_stretch', function(setting) {
                setting.bind(toggleSecondaryFillCenterVisibility);
            });
        }

        // Toggle Custom Padding for Action Button
        wp.customize.control('gravisain_header_button_custom_padding', function(control) {
            var toggleVisibility = function(size) {
                if (size === 'custom') {
                    control.container.removeClass('gravisain-dependency-hidden').slideDown(200);
                } else {
                    control.container.addClass('gravisain-dependency-hidden').hide(); // Hide instantly on initial load or bind trigger
                }
            };

            var sizeSetting = wp.customize('gravisain_header_button_size');
            if (sizeSetting) {
                toggleVisibility(sizeSetting.get());
                sizeSetting.bind(function(val) {
                    if (val === 'custom') {
                        control.container.removeClass('gravisain-dependency-hidden').slideDown(200);
                    } else {
                        control.container.addClass('gravisain-dependency-hidden').slideUp(200);
                    }
                });
            }
        });

        // Toggle Border Width for Action Button
        wp.customize.control('gravisain_header_button_border_width', function(control) {
            var toggleVisibility = function(style) {
                if (style && style !== 'none') {
                    control.container.removeClass('gravisain-dependency-hidden').slideDown(200);
                } else {
                    control.container.addClass('gravisain-dependency-hidden').hide();
                }
            };

            var styleSetting = wp.customize('gravisain_header_button_border_style');
            if (styleSetting) {
                toggleVisibility(styleSetting.get());
                styleSetting.bind(function(val) {
                    if (val && val !== 'none') {
                        control.container.removeClass('gravisain-dependency-hidden').slideDown(200);
                    } else {
                        control.container.addClass('gravisain-dependency-hidden').slideUp(200);
                    }
                });
            }
        });
    });

    /**
     * Gravisain Button Group Control
     */
    wp.customize.controlConstructor['gravisain-button-group'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;
            
            // Handle data-tab visibility
            var tab = control.params.wrapper_attrs && control.params.wrapper_attrs['data-tab'] ? control.params.wrapper_attrs['data-tab'] : (control.params.tab || '');
            if ( tab ) {
                $el.attr('data-tab', tab);
            }

            var $radios = $el.find('.gravisain-button-group-input');
            var $reset = $el.find('.gravisain-button-group-reset');

            $radios.on('change', function() {
                control.setting.set($(this).val());
            });

            $reset.on('click', function() {
                var defaultVal = control.params.default || '';
                control.setting.set(defaultVal);
                $radios.filter('[value="' + defaultVal + '"]').prop('checked', true);
            });
        }
    });

    wp.customize.controlConstructor['gravisain-spacing'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;

            var tab = control.params.wrapper_attrs && control.params.wrapper_attrs['data-tab'] ? control.params.wrapper_attrs['data-tab'] : (control.params.tab || '');
            if ( tab ) {
                $el.attr('data-tab', tab);
            }

            var $inputs = $el.find('.gravisain-spacing-input');
            var $unitSelect = $el.find('.gravisain-spacing-unit');
            var $linkBtn = $el.find('.gravisain-spacing-link');
            var $resetBtn = $el.find('.gravisain-spacing-reset');
            var $hidden = $el.find('.gravisain-spacing-hidden-value');

            var updateSetting = function() {
                var val = {
                    top: $el.find('[data-id="top"]').val(),
                    right: $el.find('[data-id="right"]').val(),
                    bottom: $el.find('[data-id="bottom"]').val(),
                    left: $el.find('[data-id="left"]').val(),
                    unit: $unitSelect.val(),
                    linked: !$el.find('.dashicons-admin-links').is(':hidden')
                };
                var jsonStr = JSON.stringify(val);
                $hidden.val(jsonStr);
                control.setting.set(jsonStr);
            };

            $inputs.on('input change', function() {
                var $this = $(this);
                if ( !$el.find('.dashicons-admin-links').is(':hidden') ) {
                    $inputs.val($this.val());
                }
                updateSetting();
            });

            $unitSelect.on('change', function() {
                updateSetting();
            });

            $linkBtn.on('click', function() {
                var $linkedIcon = $(this).find('.dashicons-admin-links');
                var $unlinkedIcon = $(this).find('.dashicons-editor-unlink');
                
                if ( $linkedIcon.is(':hidden') ) {
                    $linkedIcon.show();
                    $unlinkedIcon.hide();
                    var topVal = $el.find('[data-id="top"]').val();
                    $inputs.val(topVal);
                } else {
                    $linkedIcon.hide();
                    $unlinkedIcon.show();
                }
                updateSetting();
            });

            $resetBtn.on('click', function() {
                var defaultVal = control.params.default;
                if ( typeof defaultVal === 'string' && defaultVal !== '' ) {
                    try { defaultVal = JSON.parse(defaultVal); } catch (e) {}
                }
                if ( typeof defaultVal !== 'object' || defaultVal === null ) {
                    defaultVal = { top: '', right: '', bottom: '', left: '', unit: 'px', linked: true };
                }
                
                $el.find('[data-id="top"]').val(defaultVal.top);
                $el.find('[data-id="right"]').val(defaultVal.right);
                $el.find('[data-id="bottom"]').val(defaultVal.bottom);
                $el.find('[data-id="left"]').val(defaultVal.left);
                $unitSelect.val(defaultVal.unit || 'px');
                
                if ( defaultVal.linked ) {
                    $el.find('.dashicons-admin-links').show();
                    $el.find('.dashicons-editor-unlink').hide();
                } else {
                    $el.find('.dashicons-admin-links').hide();
                    $el.find('.dashicons-editor-unlink').show();
                }
                updateSetting();
            });
        }
    });

    /**
     * Gravisain Palette Control
     */
    wp.customize.controlConstructor['gravisain-palette'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;
            var $el = control.container;
            
            if (control.params.tab) {
                $el.attr('data-tab', control.params.tab);
            }

            var $hidden = $el.find('.gravisain-palette-value');
            
            // Initialize Color Pickers
            $el.find('.gravisain-palette-color-input').each(function() {
                var $input = $(this);
                
                // Hide the original input
                $input.hide();
                
                // Create a mount point for React
                var $mountPoint = $('<div class="gravisain-react-color-picker-mount" style="display: inline-block;"></div>');
                $input.before($mountPoint);

                window.GravisainMountColorPicker($mountPoint[0], {
                    initialColor: $input.val(),
                    onChange: function(color) {
                        $input.val(color).trigger('change');
                        var index = $input.data('index');
                        
                        // Update preview circle
                        $el.find('.gravisain-palette-color-item[data-index="'+index+'"] .gravisain-palette-color-preview').css('background-color', color);
                        
                        updateSetting();
                    },
                    onClear: function() {
                        $input.val('').trigger('change');
                        var index = $input.data('index');
                        $el.find('.gravisain-palette-color-item[data-index="'+index+'"] .gravisain-palette-color-preview').css('background-color', '');
                        updateSetting();
                    }
                });
            });

            // Toggle Color Picker Popups
            $el.find('.gravisain-palette-color-preview').on('click', function(e) {
                e.stopPropagation();
                var $preview = $(this);
                var index = $preview.closest('.gravisain-palette-color-item').data('index');
                var $pickerWrap = $el.find('.gravisain-palette-color-picker-wrap[data-index="'+index+'"]');
                
                // Close others
                $el.find('.gravisain-palette-color-picker-wrap').not($pickerWrap).removeClass('is-open');
                
                // Toggle current
                $pickerWrap.toggleClass('is-open');
            });

            // Close popups when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.gravisain-palette-color-item, .gravisain-palette-color-picker-wrap').length) {
                    $el.find('.gravisain-palette-color-picker-wrap').removeClass('is-open');
                }
            });

            // Preset Buttons
            $el.find('.gravisain-palette-preset-btn').on('click', function() {
                var index = $(this).data('preset');
                var presets = control.params.presets || [];
                if (presets[index] && presets[index].colors) {
                    var newColors = presets[index].colors;
                    
                    // Update all color pickers
                    $el.find('.gravisain-palette-color-input').each(function(i) {
                        var $input = $(this);
                        var color = newColors[i] || '';
                        $input.val(color).trigger('change');
                        $el.find('.gravisain-palette-color-item[data-index="'+i+'"] .gravisain-palette-color-preview').css('background-color', color);
                        
                        var $mount = $input.prev('.gravisain-react-color-picker-mount');
                        if ($mount.length && window.GravisainMountColorPicker) {
                            window.GravisainMountColorPicker($mount[0], {
                                initialColor: color,
                                onChange: function(newColor) {
                                    $input.val(newColor).trigger('change');
                                    $el.find('.gravisain-palette-color-item[data-index="'+i+'"] .gravisain-palette-color-preview').css('background-color', newColor);
                                    updateSetting();
                                },
                                onClear: function() {
                                    $input.val('').trigger('change');
                                    $el.find('.gravisain-palette-color-item[data-index="'+i+'"] .gravisain-palette-color-preview').css('background-color', '');
                                    updateSetting();
                                }
                            });
                        }
                    });
                    
                    updateSetting();
                }
            });

            function updateSetting() {
                var colors = [];
                $el.find('.gravisain-palette-color-input').each(function() {
                    colors.push($(this).val());
                });
                
                var jsonStr = JSON.stringify(colors);
                $hidden.val(jsonStr);
                control.setting.set(jsonStr);
                if (wp.customize && wp.customize.state && wp.customize.state('saved')) {
                    wp.customize.state('saved').set(false);
                }
                if (wp.customize && wp.customize.previewer && wp.customize.previewer.send) {
                    wp.customize.previewer.send('setting', [control.setting.id, jsonStr]);
                }
            }
        }
    });

    // Override the default WordPress color control to use our React SketchPicker
    wp.customize.controlConstructor['color'] = wp.customize.Control.extend({
        ready: function() {
            var control = this;
            var $input = control.container.find('.color-picker-hex');
            
            if (!$input.length) {
                return;
            }

            // Hide the original input
            $input.hide();
            
            // Create a mount point for React
            var $mountPoint = $('<div class="gravisain-react-color-picker-mount" style="display: inline-block;"></div>');
            $input.before($mountPoint);

            if (window.GravisainMountColorPicker) {
                window.GravisainMountColorPicker($mountPoint[0], {
                    initialColor: control.setting(),
                    onChange: function(color) {
                        control.setting.set(color);
                        if (wp.customize && wp.customize.state && wp.customize.state('saved')) {
                            wp.customize.state('saved').set(false);
                        }
                        if (wp.customize && wp.customize.previewer && wp.customize.previewer.send) {
                            wp.customize.previewer.send('setting', [control.setting.id, color]);
                        }
                    },
                    onClear: function() {
                        control.setting.set('');
                        if (wp.customize && wp.customize.state && wp.customize.state('saved')) {
                            wp.customize.state('saved').set(false);
                        }
                        if (wp.customize && wp.customize.previewer && wp.customize.previewer.send) {
                            wp.customize.previewer.send('setting', [control.setting.id, '']);
                        }
                    }
                });
            }
        }
    });

    /**
     * Scroll to Top Controls Real-Time Visibility Toggle
     */
    wp.customize.bind('ready', function() {
        wp.customize('gravisain_enable_scroll_top', function(setting) {
            var updateScrollTopControlsVisibility = function(enabled) {
                var controls = [
                    'gravisain_scroll_top_position',
                    'gravisain_scroll_top_icon_size',
                    'gravisain_scroll_top_side_offset',
                    'gravisain_scroll_top_bottom_offset',
                    'gravisain_scroll_top_position_footer_control',
                    'gravisain_scroll_top_icon_size_footer_control',
                    'gravisain_scroll_top_side_offset_footer_control',
                    'gravisain_scroll_top_bottom_offset_footer_control'
                ];
                controls.forEach(function(ctrlId) {
                    var ctrl = wp.customize.control(ctrlId);
                    if (ctrl && ctrl.container) {
                        if (enabled) {
                            ctrl.container.slideDown(180);
                        } else {
                            ctrl.container.slideUp(180);
                        }
                    }
                });
            };

            setting.bind(function(val) {
                updateScrollTopControlsVisibility(val);
            });
        });
    });

})(jQuery, wp);
