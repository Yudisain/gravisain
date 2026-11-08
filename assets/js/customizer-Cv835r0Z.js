(function(s,e){if(!(!s||!s.customize)){var o=s&&s.i18n&&s.i18n.__?function(p){return s.i18n.__(p,"gravisain")}:function(p){return p};e(document).ready(function(){var p=`
            <div id="gravisain-header-builder" class="gravisain-header-builder">
                <div class="ghb-header-bar">
                    <button type="button" class="ghb-hide-btn"><span class="dashicons dashicons-no-alt"></span> ${o("Hide")}</button>
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
                <span class="dashicons dashicons-admin-generic"></span> ${o("Header Builder")}
            </button>
        `,R=`
            <div id="ghb-component-picker" class="ghb-component-picker">
                <div class="ghb-picker-header">${o("Available Components")} <span class="dashicons dashicons-no ghb-picker-close"></span></div>
                <div class="ghb-picker-body">
                    <div class="ghb-picker-item" data-type="logo" data-label="Logo"><span class="dashicons dashicons-menu"></span> ${o("Logo")}</div>
                    <div class="ghb-picker-item" data-type="primary-navigation" data-label="Primary Navigation"><span class="dashicons dashicons-menu"></span> ${o("Primary Navigation")}</div>
                    <div class="ghb-picker-item" data-type="secondary-navigation" data-label="Secondary Navigation"><span class="dashicons dashicons-menu"></span> ${o("Secondary Navigation")}</div>
                    <div class="ghb-picker-item" data-type="action-button" data-label="Action Button"><span class="dashicons dashicons-menu"></span> ${o("Action Button")}</div>
                    <div class="ghb-picker-item" data-type="social" data-label="Social"><span class="dashicons dashicons-share"></span> ${o("Social")}</div>
                    <div class="ghb-picker-item" data-type="html" data-label="HTML"><span class="dashicons dashicons-editor-code"></span> ${o("HTML")}</div>
                    <div class="ghb-picker-item" data-type="search" data-label="Search"><span class="dashicons dashicons-search"></span> ${o("Search")}</div>
                    <div class="ghb-picker-item" data-type="menu-trigger" data-label="Menu Trigger"><span class="dashicons dashicons-menu-alt"></span> ${o("Menu Trigger")}</div>
                    <div class="ghb-picker-item" data-type="account" data-label="Account"><span class="dashicons dashicons-admin-users"></span> ${o("Account")}</div>
                    <div class="ghb-picker-item" data-type="divider" data-label="Divider"><span class="dashicons dashicons-minus"></span> ${o("Divider")}</div>
                    <div class="ghb-picker-item" data-type="contact" data-label="Contact Info"><span class="dashicons dashicons-phone"></span> ${o("Contact Info")}</div>
                    <div class="ghb-picker-item" data-type="cart" data-label="Cart"><span class="dashicons dashicons-cart"></span> ${o("Cart")}</div>
                    <div class="ghb-picker-item" data-type="theme-switcher" data-label="Theme Switcher"><span class="dashicons dashicons-admin-appearance"></span> ${o("Theme Switcher")}</div>
                </div>
            </div>
        `,y=e("body");y.append(p),y.append(R);var c=e("#gravisain-header-builder"),b=e("#gravisain-header-builder-toggle"),l=e("#ghb-component-picker");c.find(".ghb-col").append('<div class="ghb-add-item" title="'+o("Add Component")+'"><span class="dashicons dashicons-plus"></span></div>');var I=["logo","primary-navigation","secondary-navigation","action-button","social","html","search","menu-trigger","account","divider","contact","cart","theme-switcher"];function T(){var i=[];c.find(".ghb-dropped-item").each(function(){i.push(e(this).data("type"))}),l.find(".ghb-picker-item").each(function(){var a=e(this).data("type");I.indexOf(a)!==-1&&i.indexOf(a)!==-1?(e(this).addClass("is-disabled"),e(this).find(".ghb-item-badge").length||e(this).append('<span class="ghb-item-badge" style="margin-left:auto; font-size:10px; background:#e2e8f0; color:#64748b; padding:1px 6px; border-radius:10px;">'+o("Used")+"</span>")):(e(this).removeClass("is-disabled"),e(this).find(".ghb-item-badge").remove())})}var S=!1;function x(){var i={top:{left:[],center:[],right:[]},main:{left:[],center:[],right:[]},bottom:{left:[],center:[],right:[]}};if(c.find(".ghb-row-wrapper").each(function(){var t=e(this).data("row");t&&e(this).find(".ghb-col").each(function(){var n=e(this).data("col");n&&e(this).find(".ghb-dropped-item").each(function(){i[t][n].push(e(this).data("type"))})})}),s.customize("gravisain_header_builder_layout")){var a=JSON.stringify(i);s.customize("gravisain_header_builder_layout").get()!==a&&(S=!0,s.customize("gravisain_header_builder_layout").set(a),S=!1)}T()}c.find(".ghb-col").sortable({connectWith:".ghb-col",items:".ghb-dropped-item",placeholder:"ghb-sortable-placeholder",forcePlaceholderSize:!0,helper:"clone",appendTo:"body",zIndex:999999,start:function(i,a){e("#customize-preview iframe").css("pointer-events","none")},stop:function(i,a){e("#customize-preview iframe").css("pointer-events","auto"),x()}});var B=!1;function u(){B=!1,b.removeClass("is-visible"),c.addClass("is-active"),e(".wp-full-overlay-main").css({bottom:"330px",height:"calc(100% - 330px)","padding-bottom":"0"}),setTimeout(function(){try{var i=e("#customize-preview iframe");if(i.length&&i[0].contentWindow){var a=i[0].contentWindow;a&&a.scrollTo({top:0,behavior:"smooth"})}}catch{}},150)}s.customize.panel("gravisain_header_panel",function(i){i.expanded.bind(function(a){a?B?b.addClass("is-visible"):u():(c.removeClass("is-active"),b.removeClass("is-visible"),e(".wp-full-overlay-main").css({bottom:"",height:"","padding-bottom":""}))})});var U=["gravisain_header_top_row","gravisain_header_main_row","gravisain_header_bottom_row","gravisain_header_options","title_tagline"];e.each(U,function(i,a){s.customize.section(a,function(t){t.expanded.bind(function(n){n&&u()})})});var E=["gravisain_footer_top_row","gravisain_footer_main_row","gravisain_footer_bottom_row","gravisain_footer_copyright_section"];e.each(E,function(i,a){s.customize.section(a,function(t){t.expanded.bind(function(n){n&&v()})})}),s.customize.previewer&&(s.customize.previewer.bind("gravisain-open-header-builder",function(){u()}),s.customize.previewer.bind("gravisain-open-header-builder-row",function(i){u(),i&&i.section&&s.customize.section(i.section)&&s.customize.section(i.section).focus()}),s.customize.previewer.bind("gravisain-open-footer-builder",function(){v()}),s.customize.previewer.bind("gravisain-open-footer-builder-row",function(i){v(),i&&i.section&&s.customize.section(i.section)&&s.customize.section(i.section).focus()}),s.customize.previewer.bind("gravisain-focus-section",function(i){i&&(i.indexOf("sidebar-widgets-")===0&&s.customize.panel("widgets")?(s.customize.panel("widgets").focus(),setTimeout(function(){s.customize.section(i)&&s.customize.section(i).focus()},150)):s.customize.section(i)&&s.customize.section(i).focus())})),c.on("click",".ghb-row-tab",function(){var i=e(this).data("section");i&&s.customize.section(i)&&s.customize.section(i).focus()}),c.on("click",".ghb-hide-btn",function(){B=!0,c.removeClass("is-active"),e(".wp-full-overlay-main").css({bottom:"",height:"","padding-bottom":""}),b.addClass("is-visible")}),b.on("click",function(){u()});var w=null;c.on("click",".ghb-add-item",function(i){i.stopPropagation(),w=e(this).closest(".ghb-col");var a=e(this).offset();T(),l.css({top:a.top-l.outerHeight()-10,left:a.left}).addClass("is-open")}),l.on("click",".ghb-picker-close",function(){l.removeClass("is-open"),w=null}),e(document).on("click",function(i){e(i.target).closest(".ghb-component-picker, .ghb-add-item").length||l.removeClass("is-open")}),l.on("click",".ghb-picker-item",function(){if(!e(this).hasClass("is-disabled")){var i=e(this).data("type"),a=e(this).data("label")||e(this).text(),t=e(this).find(".dashicons").attr("class");if(w){var n=`
                    <div class="ghb-dropped-item" data-type="${i}">
                        <span class="${t}"></span>
                        <span class="ghb-item-label">${a}</span>
                        <span class="dashicons dashicons-admin-generic ghb-item-settings" title="${o("Settings")}"></span>
                        <span class="dashicons dashicons-no ghb-item-remove" title="${o("Remove")}"></span>
                    </div>
                `;e(n).insertBefore(w.find(".ghb-add-item")),l.removeClass("is-open"),x()}}}),c.on("click",".ghb-item-remove",function(i){i.stopPropagation(),e(this).closest(".ghb-dropped-item").remove(),x()});var O={logo:{label:"Logo",icon:"dashicons dashicons-menu",section:"title_tagline"},"primary-navigation":{label:"Primary Navigation",icon:"dashicons dashicons-menu",section:"gravisain_header_primary_navigation"},"secondary-navigation":{label:"Secondary Navigation",icon:"dashicons dashicons-menu",section:"gravisain_header_secondary_navigation"},"action-button":{label:"Action Button",icon:"dashicons dashicons-menu",section:"gravisain_header_action_button"},social:{label:"Social",icon:"dashicons dashicons-share",section:"gravisain_header_social"},html:{label:"HTML",icon:"dashicons dashicons-editor-code",section:"gravisain_header_html"},search:{label:"Search",icon:"dashicons dashicons-search",section:"gravisain_header_search"},"menu-trigger":{label:"Menu Trigger",icon:"dashicons dashicons-menu-alt",section:"gravisain_header_menu_trigger"},account:{label:"Account",icon:"dashicons dashicons-admin-users",section:"gravisain_header_account"},divider:{label:"Divider",icon:"dashicons dashicons-minus",section:"gravisain_header_divider"},contact:{label:"Contact Info",icon:"dashicons dashicons-phone",section:"gravisain_header_contact"},cart:{label:"Cart",icon:"dashicons dashicons-cart",section:"gravisain_header_cart"},"theme-switcher":{label:"Theme Switcher",icon:"dashicons dashicons-admin-appearance",section:"gravisain_header_theme_switcher"}};function A(){var i="";s.customize("gravisain_header_builder_layout")&&(i=s.customize("gravisain_header_builder_layout").get());var a=null;try{i&&(a=JSON.parse(i))}catch{}(!a||typeof a!="object")&&(a={top:{left:[],center:[],right:[]},main:{left:["logo"],center:["primary-navigation"],right:[]},bottom:{left:[],center:[],right:[]}}),c.find(".ghb-dropped-item").remove(),e.each(a,function(t,n){e.each(n,function(r,k){var _=c.find('.ghb-row-wrapper[data-row="'+t+'"] .ghb-col[data-col="'+r+'"]');_.length&&Array.isArray(k)&&e.each(k,function(P,C){var h=O[C]||{label:C,icon:"dashicons dashicons-admin-generic",section:""},N=`
                                <div class="ghb-dropped-item" data-type="${C}" data-section="${h.section||""}">
                                    <span class="${h.icon}"></span>
                                    <span class="ghb-item-label">${h.label}</span>
                                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="${o("Settings")}"></span>
                                    <span class="dashicons dashicons-no ghb-item-remove" title="${o("Remove")}"></span>
                                </div>
                            `;e(N).insertBefore(_.find(".ghb-add-item"))})})}),T()}s.customize("gravisain_header_builder_layout")&&s.customize("gravisain_header_builder_layout",function(i){A(),i.bind(function(){S||A()})}),setTimeout(A,300),c.on("click",".ghb-dropped-item, .ghb-item-settings",function(i){if(!e(i.target).hasClass("ghb-item-remove")){i.stopPropagation();var a=e(this).closest(".ghb-dropped-item").data("type"),t=O[a],n=t&&t.section?t.section:"";a==="logo"&&(n="title_tagline"),n&&s.customize.section(n)?s.customize.section(n).focus():n&&s.customize.panel(n)?s.customize.panel(n).focus():s.customize.panel("gravisain_header_panel")&&s.customize.panel("gravisain_header_panel").focus()}});var J=`
            <div id="gravisain-footer-builder" class="gravisain-header-builder gravisain-footer-builder">
                <div class="ghb-header-bar">
                    <span style="font-weight:600; font-size:13px; margin-right:auto; color:#1d2327;">${o("Footer Builder")}</span>
                    <button type="button" class="ghb-hide-btn gfb-hide-btn"><span class="dashicons dashicons-no-alt"></span> ${o("Hide")}</button>
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
                <span class="dashicons dashicons-admin-generic"></span> ${o("Footer Builder")}
            </button>
        `,D=`
            <div id="gfb-component-picker" class="ghb-component-picker">
                <div class="ghb-picker-header">${o("Footer Components")} <span class="dashicons dashicons-no gfb-picker-close"></span></div>
                <div class="ghb-picker-body">
                    <div class="ghb-picker-item" data-type="copyright" data-label="Copyright"><span class="dashicons dashicons-editor-code"></span> ${o("Copyright")}</div>
                    <div class="ghb-picker-item" data-type="footer-navigation" data-label="Footer Nav"><span class="dashicons dashicons-menu"></span> ${o("Footer Nav")}</div>
                    <div class="ghb-picker-item" data-type="social" data-label="Social"><span class="dashicons dashicons-share"></span> ${o("Social")}</div>
                    <div class="ghb-picker-item" data-type="widget-1" data-label="Widget Area 1"><span class="dashicons dashicons-welcome-widgets-menus"></span> ${o("Widget 1")}</div>
                    <div class="ghb-picker-item" data-type="widget-2" data-label="Widget Area 2"><span class="dashicons dashicons-welcome-widgets-menus"></span> ${o("Widget 2")}</div>
                    <div class="ghb-picker-item" data-type="widget-3" data-label="Widget Area 3"><span class="dashicons dashicons-welcome-widgets-menus"></span> ${o("Widget 3")}</div>
                    <div class="ghb-picker-item" data-type="widget-4" data-label="Widget Area 4"><span class="dashicons dashicons-welcome-widgets-menus"></span> ${o("Widget 4")}</div>
                    <div class="ghb-picker-item" data-type="html" data-label="Custom HTML"><span class="dashicons dashicons-editor-code"></span> ${o("HTML")}</div>
                </div>
            </div>
        `;y.append(J),y.append(D);var d=e("#gravisain-footer-builder"),f=e("#gravisain-footer-builder-toggle"),g=e("#gfb-component-picker");d.find(".ghb-col").append('<div class="ghb-add-item" title="'+o("Add Component")+'"><span class="dashicons dashicons-plus"></span></div>');var j=["copyright","footer-navigation","social","widget-1","widget-2","widget-3","widget-4","html"];function H(){var i=[];d.find(".ghb-dropped-item").each(function(){i.push(e(this).data("type"))}),g.find(".ghb-picker-item").each(function(){var a=e(this).data("type");j.indexOf(a)!==-1&&i.indexOf(a)!==-1?(e(this).addClass("is-disabled"),e(this).find(".ghb-item-badge").length||e(this).append('<span class="ghb-item-badge" style="margin-left:auto; font-size:10px; background:#e2e8f0; color:#64748b; padding:1px 6px; border-radius:10px;">'+o("Used")+"</span>")):(e(this).removeClass("is-disabled"),e(this).find(".ghb-item-badge").remove())})}var M=!1;function W(){var i={top:{"col-1":[],"col-2":[],"col-3":[],"col-4":[]},main:{"col-1":[],"col-2":[],"col-3":[],"col-4":[]},bottom:{"col-1":[],"col-2":[],"col-3":[],"col-4":[]}};d.find(".ghb-row-wrapper").each(function(){var t=e(this).data("row");e(this).find(".ghb-col").each(function(){var n=e(this).data("col"),r=[];e(this).find(".ghb-dropped-item").each(function(){r.push(e(this).data("type"))}),i[t]&&i[t][n]!==void 0&&(i[t][n]=r)})});var a=JSON.stringify(i);s.customize("gravisain_footer_builder_layout")&&s.customize("gravisain_footer_builder_layout").get()!==a&&(M=!0,s.customize("gravisain_footer_builder_layout").set(a),M=!1)}function L(){if(s.customize("gravisain_footer_builder_layout")){var i=s.customize("gravisain_footer_builder_layout").get(),a={};try{a=i?JSON.parse(i):{}}catch{a={}}d.find(".ghb-dropped-item").remove();var t={copyright:"Copyright","footer-navigation":"Footer Nav",social:"Social","widget-1":"Widget Area 1","widget-2":"Widget Area 2","widget-3":"Widget Area 3","widget-4":"Widget Area 4"};e.each(a,function(n,r){e.each(r,function(k,_){var P=d.find('.ghb-row-wrapper[data-row="'+n+'"] .ghb-col[data-col="'+k+'"]');P.length&&Array.isArray(_)&&e.each(_,function(C,h){var N=t[h]||h,q=`
                                <div class="ghb-dropped-item" data-type="${h}">
                                    <span class="ghb-item-label">${N}</span>
                                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="${o("Settings")}"></span>
                                    <span class="dashicons dashicons-no-alt ghb-item-remove" title="${o("Remove")}"></span>
                                </div>
                            `;e(q).insertBefore(P.find(".ghb-add-item"))})})}),H()}}var z=!1;function v(){z=!1,c.removeClass("is-active"),f.removeClass("is-visible"),d.addClass("is-active"),e(".wp-full-overlay-main").css({bottom:"330px",height:"calc(100% - 330px)","padding-bottom":"0"}),setTimeout(function(){try{var i=e("#customize-preview iframe");if(i.length&&i[0].contentWindow){var a=i[0].contentWindow,t=a.document;t&&t.body&&a.scrollTo({top:t.body.scrollHeight,behavior:"smooth"})}}catch{}},150)}var F=["sidebar-widgets-footer-widget-1","sidebar-widgets-footer-widget-2","sidebar-widgets-footer-widget-3","sidebar-widgets-footer-widget-4"];F.forEach(function(i){s.customize.section(i,function(a){a.expanded.bind(function(t){t&&!z&&v()})})}),s.customize.panel("gravisain_footer_panel",function(i){i.expanded.bind(function(a){a?z?f.addClass("is-visible"):v():setTimeout(function(){var t=!1;F.forEach(function(n){var r=s.customize.section(n);r&&r.expanded()&&(t=!0)}),t||(d.removeClass("is-active"),f.removeClass("is-visible"),c.hasClass("is-active")||e(".wp-full-overlay-main").css({bottom:"",height:"","padding-bottom":""}))},80)})}),f.on("click",function(){v(),s.customize.panel("gravisain_footer_panel")&&s.customize.panel("gravisain_footer_panel").focus()}),d.on("click",".gfb-hide-btn",function(){z=!0,d.removeClass("is-active"),f.addClass("is-visible"),c.hasClass("is-active")||e(".wp-full-overlay-main").css({bottom:"",height:"","padding-bottom":""})}),d.on("click",".ghb-row-tab",function(){var i=e(this).data("section");i&&s.customize.section(i)&&s.customize.section(i).focus()});var m=null;d.on("click",".ghb-add-item",function(i){i.stopPropagation(),m=e(this).closest(".ghb-col");var a=e(this).offset();g.css({top:a.top-210+"px",left:a.left+"px",display:"flex"}).addClass("is-open")}),g.on("click",".gfb-picker-close",function(){g.removeClass("is-open").hide(),m=null}),g.on("click",".ghb-picker-item",function(){if(!(e(this).hasClass("is-disabled")||!m)){var i=e(this).data("type"),a=e(this).data("label"),t=`
                <div class="ghb-dropped-item" data-type="${i}">
                    <span class="ghb-item-label">${a}</span>
                    <span class="dashicons dashicons-admin-generic ghb-item-settings" title="${o("Settings")}"></span>
                    <span class="dashicons dashicons-no-alt ghb-item-remove" title="${o("Remove")}"></span>
                </div>
            `;e(t).insertBefore(m.find(".ghb-add-item")),g.removeClass("is-open").hide(),m=null,W(),H()}}),d.on("click",".ghb-item-remove",function(i){i.stopPropagation(),e(this).closest(".ghb-dropped-item").remove(),W(),H()}),d.find(".ghb-col").sortable({items:".ghb-dropped-item",connectWith:"#gravisain-footer-builder .ghb-col",placeholder:"ghb-sortable-placeholder",tolerance:"pointer",start:function(i,a){e("#customize-preview iframe").css("pointer-events","none")},stop:function(i,a){e("#customize-preview iframe").css("pointer-events","auto"),W()}}),s.customize("gravisain_footer_builder_layout")&&s.customize("gravisain_footer_builder_layout",function(i){L(),i.bind(function(){M||L()})}),setTimeout(L,400),d.on("click",".ghb-dropped-item, .ghb-item-settings",function(i){if(!e(i.target).hasClass("ghb-item-remove")){i.stopPropagation();var a=e(this).closest(".ghb-dropped-item").data("type"),t="",n="";a==="copyright"?t="gravisain_footer_copyright_section":a==="social"?t="gravisain_footer_social":a==="footer-navigation"?t="gravisain_footer_navigation":a==="html"?t="gravisain_footer_html":a==="widget-1"?(t="sidebar-widgets-footer-widget-1",n="widgets"):a==="widget-2"?(t="sidebar-widgets-footer-widget-2",n="widgets"):a==="widget-3"?(t="sidebar-widgets-footer-widget-3",n="widgets"):a==="widget-4"?(t="sidebar-widgets-footer-widget-4",n="widgets"):t="gravisain_footer_main_row",n&&s.customize.panel(n)?(s.customize.panel(n).focus(),setTimeout(function(){t&&s.customize.section(t)&&s.customize.section(t).focus()},150)):t&&s.customize.section(t)?s.customize.section(t).focus():s.customize.panel("gravisain_footer_panel")&&s.customize.panel("gravisain_footer_panel").focus()}})})}})(window.wp,jQuery);
