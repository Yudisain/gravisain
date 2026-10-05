(function(s,e){!s||!s.customize||e(document).ready(function(){var O=`
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
        `,F=`
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
                    <div class="ghb-picker-item" data-type="theme-switcher" data-label="Theme Switcher"><span class="dashicons dashicons-admin-appearance"></span> Theme Switcher</div>
                </div>
            </div>
        `,m=e("body");m.append(O),m.append(F);var n=e("#gravisain-header-builder"),v=e("#gravisain-header-builder-toggle"),r=e("#ghb-component-picker");n.find(".ghb-col").append('<div class="ghb-add-item" title="Add Component"><span class="dashicons dashicons-plus"></span></div>');var R=["logo","primary-navigation","secondary-navigation","action-button","social","html","search","menu-trigger","account","divider","contact","cart","theme-switcher"];function k(){var i=[];n.find(".ghb-dropped-item").each(function(){i.push(e(this).data("type"))}),r.find(".ghb-picker-item").each(function(){var a=e(this).data("type");R.indexOf(a)!==-1&&i.indexOf(a)!==-1?(e(this).addClass("is-disabled"),e(this).find(".ghb-item-badge").length||e(this).append('<span class="ghb-item-badge" style="margin-left:auto; font-size:10px; background:#e2e8f0; color:#64748b; padding:1px 6px; border-radius:10px;">Used</span>')):(e(this).removeClass("is-disabled"),e(this).find(".ghb-item-badge").remove())})}var C=!1;function T(){var i={top:{left:[],center:[],right:[]},main:{left:[],center:[],right:[]},bottom:{left:[],center:[],right:[]}};if(n.find(".ghb-row-wrapper").each(function(){var t=e(this).data("row");t&&e(this).find(".ghb-col").each(function(){var o=e(this).data("col");o&&e(this).find(".ghb-dropped-item").each(function(){i[t][o].push(e(this).data("type"))})})}),s.customize("gravisain_header_builder_layout")){var a=JSON.stringify(i);s.customize("gravisain_header_builder_layout").get()!==a&&(C=!0,s.customize("gravisain_header_builder_layout").set(a),C=!1)}k()}n.find(".ghb-col").sortable({connectWith:".ghb-col",items:".ghb-dropped-item",placeholder:"ghb-sortable-placeholder",forcePlaceholderSize:!0,helper:"clone",appendTo:"body",zIndex:999999,start:function(i,a){e("#customize-preview iframe").css("pointer-events","none")},stop:function(i,a){e("#customize-preview iframe").css("pointer-events","auto"),T()}});var S=!1;function p(){S=!1,v.removeClass("is-visible"),n.addClass("is-active"),e(".wp-full-overlay-main").css({bottom:"330px",height:"calc(100% - 330px)","padding-bottom":"0"}),setTimeout(function(){try{var i=e("#customize-preview iframe");if(i.length&&i[0].contentWindow){var a=i[0].contentWindow;a&&a.scrollTo({top:0,behavior:"smooth"})}}catch{}},150)}s.customize.panel("gravisain_header_panel",function(i){i.expanded.bind(function(a){a?S?v.addClass("is-visible"):p():(n.removeClass("is-active"),v.removeClass("is-visible"),e(".wp-full-overlay-main").css({bottom:"",height:"","padding-bottom":""}))})});var I=["gravisain_header_top_row","gravisain_header_main_row","gravisain_header_bottom_row","gravisain_header_options","title_tagline"];e.each(I,function(i,a){s.customize.section(a,function(t){t.expanded.bind(function(o){o&&p()})})});var U=["gravisain_footer_top_row","gravisain_footer_main_row","gravisain_footer_bottom_row","gravisain_footer_copyright_section"];e.each(U,function(i,a){s.customize.section(a,function(t){t.expanded.bind(function(o){o&&g()})})}),s.customize.previewer&&(s.customize.previewer.bind("gravisain-open-header-builder",function(){p()}),s.customize.previewer.bind("gravisain-open-header-builder-row",function(i){p(),i&&i.section&&s.customize.section(i.section)&&s.customize.section(i.section).focus()}),s.customize.previewer.bind("gravisain-open-footer-builder",function(){g()}),s.customize.previewer.bind("gravisain-open-footer-builder-row",function(i){g(),i&&i.section&&s.customize.section(i.section)&&s.customize.section(i.section).focus()}),s.customize.previewer.bind("gravisain-focus-section",function(i){i&&(i.indexOf("sidebar-widgets-")===0&&s.customize.panel("widgets")?(s.customize.panel("widgets").focus(),setTimeout(function(){s.customize.section(i)&&s.customize.section(i).focus()},150)):s.customize.section(i)&&s.customize.section(i).focus())})),n.on("click",".ghb-row-tab",function(){var i=e(this).data("section");i&&s.customize.section(i)&&s.customize.section(i).focus()}),n.on("click",".ghb-hide-btn",function(){S=!0,n.removeClass("is-active"),e(".wp-full-overlay-main").css({bottom:"",height:"","padding-bottom":""}),v.addClass("is-visible")}),v.on("click",function(){p()});var _=null;n.on("click",".ghb-add-item",function(i){i.stopPropagation(),_=e(this).closest(".ghb-col");var a=e(this).offset();k(),r.css({top:a.top-r.outerHeight()-10,left:a.left}).addClass("is-open")}),r.on("click",".ghb-picker-close",function(){r.removeClass("is-open"),_=null}),e(document).on("click",function(i){e(i.target).closest(".ghb-component-picker, .ghb-add-item").length||r.removeClass("is-open")}),r.on("click",".ghb-picker-item",function(){if(!e(this).hasClass("is-disabled")){var i=e(this).data("type"),a=e(this).data("label")||e(this).text(),t=e(this).find(".dashicons").attr("class");if(_){var o=`
                    <div class="ghb-dropped-item" data-type="${i}">
                        <span class="${t}"></span>
                        <span class="ghb-item-label">${a}</span>
                        <span class="dashicons dashicons-admin-generic ghb-item-settings" title="Settings"></span>
                        <span class="dashicons dashicons-no ghb-item-remove" title="Remove"></span>
                    </div>
                `;e(o).insertBefore(_.find(".ghb-add-item")),r.removeClass("is-open"),T()}}}),n.on("click",".ghb-item-remove",function(i){i.stopPropagation(),e(this).closest(".ghb-dropped-item").remove(),T()});var P={logo:{label:"Logo",icon:"dashicons dashicons-menu",section:"title_tagline"},"primary-navigation":{label:"Primary Navigation",icon:"dashicons dashicons-menu",section:"gravisain_header_primary_navigation"},"secondary-navigation":{label:"Secondary Navigation",icon:"dashicons dashicons-menu",section:"gravisain_header_secondary_navigation"},"action-button":{label:"Action Button",icon:"dashicons dashicons-menu",section:"gravisain_header_action_button"},social:{label:"Social",icon:"dashicons dashicons-share",section:"gravisain_header_social"},html:{label:"HTML",icon:"dashicons dashicons-editor-code",section:"gravisain_header_html"},search:{label:"Search",icon:"dashicons dashicons-search",section:"gravisain_header_search"},"menu-trigger":{label:"Menu Trigger",icon:"dashicons dashicons-menu-alt",section:"gravisain_header_menu_trigger"},account:{label:"Account",icon:"dashicons dashicons-admin-users",section:"gravisain_header_account"},divider:{label:"Divider",icon:"dashicons dashicons-minus",section:"gravisain_header_divider"},contact:{label:"Contact Info",icon:"dashicons dashicons-phone",section:"gravisain_header_contact"},cart:{label:"Cart",icon:"dashicons dashicons-cart",section:"gravisain_header_cart"},"theme-switcher":{label:"Theme Switcher",icon:"dashicons dashicons-admin-appearance",section:"gravisain_header_theme_switcher"}};function x(){var i="";s.customize("gravisain_header_builder_layout")&&(i=s.customize("gravisain_header_builder_layout").get());var a=null;try{i&&(a=JSON.parse(i))}catch{}(!a||typeof a!="object")&&(a={top:{left:[],center:[],right:[]},main:{left:["logo"],center:["primary-navigation"],right:[]},bottom:{left:[],center:[],right:[]}}),n.find(".ghb-dropped-item").remove(),e.each(a,function(t,o){e.each(o,function(d,w){var f=n.find('.ghb-row-wrapper[data-row="'+t+'"] .ghb-col[data-col="'+d+'"]');f.length&&Array.isArray(w)&&e.each(w,function(W,z){var l=P[z]||{label:z,icon:"dashicons dashicons-admin-generic",section:""},L=`
                                <div class="ghb-dropped-item" data-type="${z}" data-section="${l.section||""}">
                                    <span class="${l.icon}"></span>
                                    <span class="ghb-item-label">${l.label}</span>
                                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="Settings"></span>
                                    <span class="dashicons dashicons-no ghb-item-remove" title="Remove"></span>
                                </div>
                            `;e(L).insertBefore(f.find(".ghb-add-item"))})})}),k()}s.customize("gravisain_header_builder_layout")&&s.customize("gravisain_header_builder_layout",function(i){x(),i.bind(function(){C||x()})}),setTimeout(x,300),n.on("click",".ghb-dropped-item, .ghb-item-settings",function(i){if(!e(i.target).hasClass("ghb-item-remove")){i.stopPropagation();var a=e(this).closest(".ghb-dropped-item").data("type"),t=P[a],o=t&&t.section?t.section:"";a==="logo"&&(o="title_tagline"),o&&s.customize.section(o)?s.customize.section(o).focus():o&&s.customize.panel(o)?s.customize.panel(o).focus():s.customize.panel("gravisain_header_panel")&&s.customize.panel("gravisain_header_panel").focus()}});var E=`
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
        `,J=`
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
        `;m.append(E),m.append(J);var c=e("#gravisain-footer-builder"),b=e("#gravisain-footer-builder-toggle"),h=e("#gfb-component-picker");c.find(".ghb-col").append('<div class="ghb-add-item" title="Add Component"><span class="dashicons dashicons-plus"></span></div>');var D=["copyright","footer-navigation","social","widget-1","widget-2","widget-3","widget-4","html"];function B(){var i=[];c.find(".ghb-dropped-item").each(function(){i.push(e(this).data("type"))}),h.find(".ghb-picker-item").each(function(){var a=e(this).data("type");D.indexOf(a)!==-1&&i.indexOf(a)!==-1?(e(this).addClass("is-disabled"),e(this).find(".ghb-item-badge").length||e(this).append('<span class="ghb-item-badge" style="margin-left:auto; font-size:10px; background:#e2e8f0; color:#64748b; padding:1px 6px; border-radius:10px;">Used</span>')):(e(this).removeClass("is-disabled"),e(this).find(".ghb-item-badge").remove())})}var A=!1;function H(){var i={top:{"col-1":[],"col-2":[],"col-3":[],"col-4":[]},main:{"col-1":[],"col-2":[],"col-3":[],"col-4":[]},bottom:{"col-1":[],"col-2":[],"col-3":[],"col-4":[]}};c.find(".ghb-row-wrapper").each(function(){var t=e(this).data("row");e(this).find(".ghb-col").each(function(){var o=e(this).data("col"),d=[];e(this).find(".ghb-dropped-item").each(function(){d.push(e(this).data("type"))}),i[t]&&i[t][o]!==void 0&&(i[t][o]=d)})});var a=JSON.stringify(i);s.customize("gravisain_footer_builder_layout")&&s.customize("gravisain_footer_builder_layout").get()!==a&&(A=!0,s.customize("gravisain_footer_builder_layout").set(a),A=!1)}function M(){if(s.customize("gravisain_footer_builder_layout")){var i=s.customize("gravisain_footer_builder_layout").get(),a={};try{a=i?JSON.parse(i):{}}catch{a={}}c.find(".ghb-dropped-item").remove();var t={copyright:"Copyright","footer-navigation":"Footer Nav",social:"Social","widget-1":"Widget Area 1","widget-2":"Widget Area 2","widget-3":"Widget Area 3","widget-4":"Widget Area 4"};e.each(a,function(o,d){e.each(d,function(w,f){var W=c.find('.ghb-row-wrapper[data-row="'+o+'"] .ghb-col[data-col="'+w+'"]');W.length&&Array.isArray(f)&&e.each(f,function(z,l){var L=t[l]||l,j=`
                                <div class="ghb-dropped-item" data-type="${l}">
                                    <span class="ghb-item-label">${L}</span>
                                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="Settings"></span>
                                    <span class="dashicons dashicons-no-alt ghb-item-remove" title="Remove"></span>
                                </div>
                            `;e(j).insertBefore(W.find(".ghb-add-item"))})})}),B()}}var y=!1;function g(){y=!1,n.removeClass("is-active"),b.removeClass("is-visible"),c.addClass("is-active"),e(".wp-full-overlay-main").css({bottom:"330px",height:"calc(100% - 330px)","padding-bottom":"0"}),setTimeout(function(){try{var i=e("#customize-preview iframe");if(i.length&&i[0].contentWindow){var a=i[0].contentWindow,t=a.document;t&&t.body&&a.scrollTo({top:t.body.scrollHeight,behavior:"smooth"})}}catch{}},150)}var N=["sidebar-widgets-footer-widget-1","sidebar-widgets-footer-widget-2","sidebar-widgets-footer-widget-3","sidebar-widgets-footer-widget-4"];N.forEach(function(i){s.customize.section(i,function(a){a.expanded.bind(function(t){t&&!y&&g()})})}),s.customize.panel("gravisain_footer_panel",function(i){i.expanded.bind(function(a){a?y?b.addClass("is-visible"):g():setTimeout(function(){var t=!1;N.forEach(function(o){var d=s.customize.section(o);d&&d.expanded()&&(t=!0)}),t||(c.removeClass("is-active"),b.removeClass("is-visible"),n.hasClass("is-active")||e(".wp-full-overlay-main").css({bottom:"",height:"","padding-bottom":""}))},80)})}),b.on("click",function(){g(),s.customize.panel("gravisain_footer_panel")&&s.customize.panel("gravisain_footer_panel").focus()}),c.on("click",".gfb-hide-btn",function(){y=!0,c.removeClass("is-active"),b.addClass("is-visible"),n.hasClass("is-active")||e(".wp-full-overlay-main").css({bottom:"",height:"","padding-bottom":""})}),c.on("click",".ghb-row-tab",function(){var i=e(this).data("section");i&&s.customize.section(i)&&s.customize.section(i).focus()});var u=null;c.on("click",".ghb-add-item",function(i){i.stopPropagation(),u=e(this).closest(".ghb-col");var a=e(this).offset();h.css({top:a.top-210+"px",left:a.left+"px",display:"flex"}).addClass("is-open")}),h.on("click",".gfb-picker-close",function(){h.removeClass("is-open").hide(),u=null}),h.on("click",".ghb-picker-item",function(){if(!(e(this).hasClass("is-disabled")||!u)){var i=e(this).data("type"),a=e(this).data("label"),t=`
                <div class="ghb-dropped-item" data-type="${i}">
                    <span class="ghb-item-label">${a}</span>
                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="Settings"></span>
                    <span class="dashicons dashicons-no-alt ghb-item-remove" title="Remove"></span>
                </div>
            `;e(t).insertBefore(u.find(".ghb-add-item")),h.removeClass("is-open").hide(),u=null,H(),B()}}),c.on("click",".ghb-item-remove",function(i){i.stopPropagation(),e(this).closest(".ghb-dropped-item").remove(),H(),B()}),c.find(".ghb-col").sortable({items:".ghb-dropped-item",connectWith:"#gravisain-footer-builder .ghb-col",placeholder:"ghb-sortable-placeholder",tolerance:"pointer",start:function(i,a){e("#customize-preview iframe").css("pointer-events","none")},stop:function(i,a){e("#customize-preview iframe").css("pointer-events","auto"),H()}}),s.customize("gravisain_footer_builder_layout")&&s.customize("gravisain_footer_builder_layout",function(i){M(),i.bind(function(){A||M()})}),setTimeout(M,400),c.on("click",".ghb-dropped-item, .ghb-item-settings",function(i){if(!e(i.target).hasClass("ghb-item-remove")){i.stopPropagation();var a=e(this).closest(".ghb-dropped-item").data("type"),t="",o="";a==="copyright"?t="gravisain_footer_copyright_section":a==="social"?t="gravisain_footer_social":a==="footer-navigation"?t="gravisain_footer_navigation":a==="html"?t="gravisain_footer_html":a==="widget-1"?(t="sidebar-widgets-footer-widget-1",o="widgets"):a==="widget-2"?(t="sidebar-widgets-footer-widget-2",o="widgets"):a==="widget-3"?(t="sidebar-widgets-footer-widget-3",o="widgets"):a==="widget-4"?(t="sidebar-widgets-footer-widget-4",o="widgets"):t="gravisain_footer_main_row",o&&s.customize.panel(o)?(s.customize.panel(o).focus(),setTimeout(function(){t&&s.customize.section(t)&&s.customize.section(t).focus()},150)):t&&s.customize.section(t)?s.customize.section(t).focus():s.customize.panel("gravisain_footer_panel")&&s.customize.panel("gravisain_footer_panel").focus()}})})})(window.wp,jQuery);
