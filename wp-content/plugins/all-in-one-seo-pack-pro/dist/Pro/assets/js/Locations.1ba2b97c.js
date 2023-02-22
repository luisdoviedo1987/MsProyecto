import{n,V as _}from"./_plugin-vue2_normalizer.61652a7c.js";import{a as r,c as h}from"./vuex.esm.8fdeb4b6.js";import{B as u}from"./RadioToggle.e6e54396.js";import{A as m}from"./WpTable.e9a9eb34.js";import{U as g}from"./Image.ac903a77.js";import"./SaveChanges.e40a9083.js";import{C as i}from"./Card.0104a053.js";import{C as l}from"./SettingsRow.edbb3005.js";import{L as f,a as $,b,c as y,d as v,e as S,f as C,g as x,h as L}from"./PaymentInfo.c1cf2a7a.js";import{C as d}from"./index.0395bbae.js";import{C as p}from"./ProBadge.66f48bdc.js";import{C as w}from"./AttributesList.fb8c2448.js";import{C as B}from"./DisplayInfo.1f7bb25d.js";import{B as k}from"./Checkbox.60ba2f56.js";import{S as I,a as A}from"./Mobile.dbdc2be1.js";import{A as T,U as P}from"./UpdateCta.ed778058.js";import{C as D}from"./Blur.f36c594d.js";import{S as U}from"./Plus.6984df43.js";import{R as O}from"./RequiredPlans.389a71cb.js";import{C as E}from"./Index.5c05423e.js";import"./index.da77b995.js";import"./helpers.871dba46.js";import"./attachments.506687b9.js";import"./cleanForSlug.071f7a1a.js";import"./isArrayLikeObject.75d4eb51.js";import"./constants.8df4c584.js";import"./default-i18n.3a91e0e5.js";import"./Caret.6d7f2e24.js";import"./_commonjsHelpers.f84db168.js";import"./html.50126bda.js";import"./Index.ffa20ee1.js";import"./Tooltip.68a8a92b.js";import"./Slide.15a07930.js";import"./Row.830f6397.js";import"./HtmlTagsEditor.3c4e873a.js";import"./Editor.e0f43476.js";import"./UnfilteredHtml.395cff91.js";import"./Phone.c26b4769.js";import"./Img.137dcbf1.js";import"./Map.58a6871a.js";import"./isEqual.e7f6747c.js";import"./_baseIsEqual.c1076d2e.js";import"./_getTag.9d8fc96e.js";import"./client.e62d6c37.js";import"./translations.c394afe3.js";import"./portal-vue.esm.98f2e05b.js";import"./Php.f9636158.js";import"./CheckSolid.731d2c48.js";import"./Checkmark.f26f6201.js";const R={data(){return{hoveringOver:!1,strings:{locations:this.$t.__("Locations",this.$td),allLocations:this.$t.__("All Locations",this.$tdPro),addNew:this.$t.__("Add New",this.$td),locationCategories:this.$t.__("Location Categories",this.$td)}}}};var G=function(){var s=this,t=s._self._c;return t("li",{staticClass:"wp-has-submenu wp-not-current-submenu menu-top menu-icon-aioseo-location menu-top-last",class:{opensub:s.hoveringOver===0},attrs:{id:"menu-posts-aioseo-location"},on:{mouseover:function(e){s.hoveringOver=0},mouseleave:function(e){s.hoveringOver=-1}}},[t("a",{staticClass:"wp-has-submenu wp-not-current-submenu menu-top menu-icon-aioseo-location menu-top-last",attrs:{href:"edit.php?post_type=aioseo-location","aria-haspopup":"true"}},[t("div",{staticClass:"wp-menu-image dashicons-before dashicons-location",attrs:{"aria-hidden":"true"}}),t("div",{staticClass:"wp-menu-name"},[s._v(s._s(s.strings.locations))])]),t("ul",{staticClass:"wp-submenu wp-submenu-wrap"},[t("li",{staticClass:"wp-submenu-head",attrs:{"aria-hidden":"true"}},[s._v(" "+s._s(s.strings.locations)+" ")]),t("li",{staticClass:"wp-first-item"},[t("a",{staticClass:"wp-first-item",attrs:{href:"edit.php?post_type=aioseo-location"}},[s._v(s._s(s.strings.allLocations))])]),t("li",[t("a",{attrs:{href:"post-new.php?post_type=aioseo-location"}},[s._v(s._s(s.strings.addNew))])]),t("li",[t("a",{attrs:{href:"edit-tags.php?taxonomy=aioseo-location-category&post_type=aioseo-location"}},[s._v(s._s(s.strings.locationCategories))])])])])},M=[],z=n(R,G,M,!1,null,null,null,null);const N=z.exports,F={components:{CoreCard:i,CoreSettingsRow:l,LocalBusinessAreaServed:f,LocalBusinessBusinessAddress:$,LocalBusinessBusinessContact:b,LocalBusinessBusinessIds:y,LocalBusinessBusinessType:v,LocalBusinessImage:S,LocalBusinessMap:C,LocalBusinessName:x,LocalBusinessPaymentInfo:L},mixins:[g],data(){return{strings:{locationInfo1:this.$t.__("Local Business schema markup enables you to tell Google about your business, including your business name, address and phone number, opening hours and price range. This information may be displayed as a Knowledge Graph card or business carousel.",this.$td),locationInfo2:this.$t.__("Local business information may be displayed when users search for businesses on Google search or Google Maps. Google decides on a per search basis whether to display this information or not and it’s completely automated.",this.$td),businessInfo:this.$t.__("Business Info",this.$td),name:this.$t.__("Name",this.$td),businessType:this.$t.__("Type",this.$td),urls:this.$t.__("URLs",this.$td),businessAddress:this.$t.__("Address",this.$td),businessContact:this.$t.__("Contact Info",this.$td),businessIDs:this.$t.__("IDs",this.$td),paymentInfo:this.$t.__("Payment Info",this.$td),areaServed:this.$t.__("Area Served",this.$td),image:this.$t.__("Image",this.$td),map:this.$t.__("Map",this.$td)}}},computed:{...r(["options"])}};var H=function(){var s=this,t=s._self._c;return t("div",[s.options.localBusiness.locations.general.multiple?s._e():t("core-card",{attrs:{slug:"localBusinessInfo","header-text":s.strings.businessInfo}},[t("div",{staticClass:"aioseo-settings-row aioseo-section-description"},[t("p",{staticClass:"location-description"},[s._v(s._s(s.strings.locationInfo1))]),t("p",{staticClass:"location-description mb-0"},[s._v(s._s(s.strings.locationInfo2))])]),t("core-settings-row",{staticClass:"info-name-row",attrs:{name:s.strings.name,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-name")]},proxy:!0}],null,!1,276075501)}),t("core-settings-row",{staticClass:"info-business-image",attrs:{name:s.strings.image,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-image")]},proxy:!0}],null,!1,3202536589)}),t("core-settings-row",{staticClass:"info-business-type",attrs:{id:"info-business-type",name:s.strings.businessType,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-business-type")]},proxy:!0}],null,!1,4144345881)}),t("core-settings-row",{staticClass:"info-business-address-row",attrs:{id:"info-business-address-row",name:s.strings.businessAddress,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-business-address")]},proxy:!0}],null,!1,1864513495)}),t("core-settings-row",{attrs:{name:s.strings.map,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-map")]},proxy:!0}],null,!1,1779716662)}),t("core-settings-row",{staticClass:"info-business-contact-row",attrs:{id:"info-business-contact-row",name:s.strings.businessContact,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-business-contact")]},proxy:!0}],null,!1,3695398241)}),t("core-settings-row",{staticClass:"info-business-IDs-row",attrs:{name:s.strings.businessIDs,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-business-ids")]},proxy:!0}],null,!1,420205695)}),t("core-settings-row",{staticClass:"info-payment-info-row",attrs:{id:"info-payment-info-row",name:s.strings.paymentInfo,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-payment-info")]},proxy:!0}],null,!1,332645171)}),t("core-settings-row",{staticClass:"info-area-row",attrs:{name:s.strings.areaServed,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("local-business-area-served")]},proxy:!0}],null,!1,1581046819)})],1)],1)},W=[],q=n(F,H,W,!1,null,null,null,null);const V=q.exports,Y={components:{CoreAttributesList:w,CoreDisplayInfo:B},props:{label:null,displayOptions:{type:Object,required:!0}},data(){return{strings:{shortcodeAttributesDescription:this.$t.__("The following shortcode attributes can be used to override the default settings:",this.$td),phpArgumentsDescription:this.$t.__("The function accepts an associative array with the following arguments that can be used to override the default settings:",this.$td),advancedSettings:this.$t.__("Advanced Settings",this.$td)},attributes:[{name:"location_id",description:this.$t.__("A Location ID if Multiple Locations is on.",this.$td)},{name:"show_labels",description:this.$t.__("Show or hide labels ( ‘Address:’, ‘Phone:’, ‘Fax:’, ‘Email:’, etc ).",this.$td)},{name:"show_icons",description:this.$t.__("Show or hide icons ( address, phone, fax, email ).",this.$td)},{name:"show_name",description:this.$t.__("Show or hide the business name.",this.$td)},{name:"show_address",description:this.$t.__("Show or hide the address.",this.$td)},{name:"show_phone",description:this.$t.__("Show or hide the phone number.",this.$td)},{name:"show_fax",description:this.$t.__("Show or hide the fax number.",this.$td)},{name:"show_email",description:this.$t.__("Show or hide the email.",this.$td)},{name:"show_vat",description:this.$t.__("Show or hide the Vat ID.",this.$td)},{name:"show_tax",description:this.$t.__("Show or hide the Tax ID.",this.$td)},{name:"address_label",description:this.$t.__("The address label.",this.$td)},{name:"vat_id_label",description:this.$t.__("The VAT ID label.",this.$td)},{name:"tax_id_label",description:this.$t.__("The Tax ID label.",this.$td)},{name:"phone_label",description:this.$t.__("The phone label.",this.$td)},{name:"fax_label",description:this.$t.__("The fax label.",this.$td)},{name:"email_label",description:this.$t.__("The email label.",this.$td)}]}}};var j=function(){var s=this,t=s._self._c;return t("core-display-info",{attrs:{label:s.label,options:s.displayOptions},scopedSlots:s._u([{key:"shortcodeAdvanced",fn:function(){return[t("core-attributes-list",{attrs:{description:s.strings.shortcodeAttributesDescription,attributes:s.attributes}})]},proxy:!0},{key:"phpAdvanced",fn:function(){return[t("core-attributes-list",{attrs:{description:s.strings.phpArgumentsDescription,attributes:s.attributes}})]},proxy:!0}])})},K=[],J=n(Y,j,K,!1,null,null,null,null);const Q=J.exports,X={components:{BaseCheckbox:k,BaseRadioToggle:u,CoreCard:i,CoreSettingsRow:l,CoreAlert:d},data(){return{strings:{advancedLocationsSettings:this.$t.__("Advanced Locations Settings",this.$td),locationsPermalink:this.$t.__("Locations Permalink",this.$td),useCustomSlug:this.$t.__("Use custom slug",this.$td),invalidCustomSlug:this.$t.__("Slug is empty or is already taken. Please enter a different one.",this.$td),locationsCategoryPermalink:this.$t.__("Locations Category Permalink",this.$td),useCustomCategorySlug:this.$t.__("Use custom category slug",this.$td),enhancedSearch:this.$t.__("Enhanced Search",this.$td),enhancedSearchDesc:this.$t.__("Include business locations in site-wide search results. Users searching for street name, zip code or city will now also get your business location(s) in their search results.",this.$td),enhancedSearchError:this.$t.sprintf(this.$t.__("Enhanced Search cannot be enabled on your website because there is a search query conflict. To learn more about this, %1$sclick here%2$s.",this.$td),`<a href="${this.$links.getDocUrl("localSeoSearchQueryConflict")}" target="_blank">`,"</a>"),enhancedSearchExcerpt:this.$t.__("Enhanced Search - Excerpt",this.$td),enhancedSearchExcerptDesc:this.$t.__("Shows the location address appended to the search result.",this.$td),customAdminLabels:this.$t.__("Custom Admin Labels",this.$td),customAdminLabelsDesc:this.$t.__("With multiple locations, you will have a new menu item in your admin sidebar. By default, this menu item is labeled using the plural term of locations with each single item being called a location. If you like, you may enter custom labels to better match your business.",this.$td),singleLabel:this.$t.__("Single label",this.$td),pluralLabel:this.$t.__("Plural label",this.$td)},validCustomSlug:!0,validCustomCategorySlug:!0}},computed:{...r(["options"]),currentPostTypeSlug(){return this.options.localBusiness.locations.general.useCustomSlug&&this.options.localBusiness.locations.general.customSlug?this.options.localBusiness.locations.general.customSlug:this.$aioseo.localBusiness.postTypeDefaultSlug},currentTaxonomySlug(){return this.options.localBusiness.locations.general.useCustomCategorySlug&&this.options.localBusiness.locations.general.customCategorySlug?this.options.localBusiness.locations.general.customCategorySlug:this.$aioseo.localBusiness.taxonomyDefaultSlug}},methods:{validateCustomSlug(o){this.validCustomSlug=!0,o=o.replace(/^\/+/,"").replace(/\/+$/,"").replace(/\s+/g,"-"),this.options.localBusiness.locations.general.customSlug=o,(0>=o.length||0<this.$aioseo.postData.postTypes.filter(s=>s.name!==this.$aioseo.localBusiness.postTypeName&&s.slug===o).length)&&(this.validCustomSlug=!1)},validateCustomCategorySlug(o){this.validCustomCategorySlug=!0,o=o.replace(/^\/+/g,"").replace(/\/+$/g,"").replace(/\s+/g,"-"),this.options.localBusiness.locations.general.customCategorySlug=o,(0>=o.length||0<this.$aioseo.postData.taxonomies.filter(s=>s.name!==this.$aioseo.localBusiness.taxonomyName&&s.slug===o).length)&&(this.validCustomCategorySlug=!1)}}};var Z=function(){var s=this,t=s._self._c;return t("div",{staticClass:"aioseo-locations aioseo-locations-multiple-locations-settings"},[s.options.localBusiness.locations.general.multiple&&s.$aioseo.license.isActive?t("core-card",{attrs:{slug:"advancedLocationsSettings","header-text":s.strings.advancedLocationsSettings}},[t("core-settings-row",{staticClass:"location-permalink",attrs:{name:s.strings.locationsPermalink},scopedSlots:s._u([{key:"content",fn:function(){return[t("div",{staticClass:"location-permalink-preview"},[t("span",{staticClass:"baseurl"},[s._v(s._s(s.$aioseo.urls.mainSiteUrl)+"/")]),s._l(s.$aioseo.localBusiness.postTypePermalinkStructure,function(e,a){return t("span",{key:a,class:e=="{slug}"?"slug":""},[s._v(s._s(e=="{slug}"?s.currentPostTypeSlug:e))])})],2),t("base-checkbox",{attrs:{size:"medium"},model:{value:s.options.localBusiness.locations.general.useCustomSlug,callback:function(e){s.$set(s.options.localBusiness.locations.general,"useCustomSlug",e)},expression:"options.localBusiness.locations.general.useCustomSlug"}},[s._v(" "+s._s(s.strings.useCustomSlug)+" ")]),s.options.localBusiness.locations.general.useCustomSlug?t("base-input",{staticClass:"custom-slug",class:{"aioseo-error":!s.validCustomSlug},attrs:{spellcheck:!1},on:{input:e=>s.validateCustomSlug(e)},model:{value:s.options.localBusiness.locations.general.customSlug,callback:function(e){s.$set(s.options.localBusiness.locations.general,"customSlug",e)},expression:"options.localBusiness.locations.general.customSlug"}}):s._e(),s.options.localBusiness.locations.general.useCustomSlug&&!s.validCustomSlug?t("div",{staticClass:"aioseo-description aioseo-error"},[s._v(" "+s._s(s.strings.invalidCustomSlug)+" ")]):s._e()]},proxy:!0}],null,!1,4281210992)}),t("core-settings-row",{staticClass:"location-category-permalink",attrs:{name:s.strings.locationsCategoryPermalink},scopedSlots:s._u([{key:"content",fn:function(){return[t("div",{staticClass:"location-permalink-preview location-category-permalink-preview"},[t("span",{staticClass:"baseurl"},[s._v(s._s(s.$aioseo.urls.mainSiteUrl)+"/")]),s._l(s.$aioseo.localBusiness.taxonomyPermalinkStructure,function(e,a){return t("span",{key:a,class:e=="{slug}"?"slug":""},[s._v(s._s(e=="{slug}"?s.currentTaxonomySlug:e))])})],2),t("base-checkbox",{attrs:{size:"medium"},model:{value:s.options.localBusiness.locations.general.useCustomCategorySlug,callback:function(e){s.$set(s.options.localBusiness.locations.general,"useCustomCategorySlug",e)},expression:"options.localBusiness.locations.general.useCustomCategorySlug"}},[s._v(" "+s._s(s.strings.useCustomCategorySlug)+" ")]),s.options.localBusiness.locations.general.useCustomCategorySlug?t("base-input",{staticClass:"custom-slug",class:{"aioseo-error":!s.validCustomCategorySlug},attrs:{spellcheck:!1},on:{input:e=>s.validateCustomCategorySlug(e)},model:{value:s.options.localBusiness.locations.general.customCategorySlug,callback:function(e){s.$set(s.options.localBusiness.locations.general,"customCategorySlug",e)},expression:"options.localBusiness.locations.general.customCategorySlug"}}):s._e(),s.options.localBusiness.locations.general.useCustomCategorySlug&&!s.validCustomCategorySlug?t("div",{staticClass:"aioseo-description aioseo-error"},[s._v(" "+s._s(s.strings.invalidCustomSlug)+" ")]):s._e()]},proxy:!0}],null,!1,681061009)}),t("core-settings-row",{staticClass:"location-enhanced-search",attrs:{name:s.strings.enhancedSearch},scopedSlots:s._u([{key:"content",fn:function(){return[t("base-radio-toggle",{attrs:{name:"enhancedSearch",disabled:!s.$aioseo.localBusiness.enhancedSearchTest,options:[{label:s.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:s.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:s.options.localBusiness.locations.general.enhancedSearch,callback:function(e){s.$set(s.options.localBusiness.locations.general,"enhancedSearch",e)},expression:"options.localBusiness.locations.general.enhancedSearch"}}),t("div",{staticClass:"aioseo-description"},[s._v(s._s(s.strings.enhancedSearchDesc))]),s.$aioseo.localBusiness.enhancedSearchTest?s._e():t("core-alert",{attrs:{type:"yellow"},domProps:{innerHTML:s._s(s.strings.enhancedSearchError)}})]},proxy:!0}],null,!1,2473193590)}),s.options.localBusiness.locations.general.enhancedSearch?t("core-settings-row",{staticClass:"location-enhanced-search",attrs:{name:s.strings.enhancedSearchExcerpt},scopedSlots:s._u([{key:"content",fn:function(){return[t("base-radio-toggle",{attrs:{name:"enhancedSearchExcerpt",options:[{label:s.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:s.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:s.options.localBusiness.locations.general.enhancedSearchExcerpt,callback:function(e){s.$set(s.options.localBusiness.locations.general,"enhancedSearchExcerpt",e)},expression:"options.localBusiness.locations.general.enhancedSearchExcerpt"}}),t("div",{staticClass:"aioseo-description"},[s._v(s._s(s.strings.enhancedSearchExcerptDesc))])]},proxy:!0}],null,!1,1695670279)}):s._e(),t("core-settings-row",{staticClass:"location-admin-labels",attrs:{name:s.strings.customAdminLabels},scopedSlots:s._u([{key:"content",fn:function(){return[t("p",{staticClass:"admin-labels-description"},[s._v(s._s(s.strings.customAdminLabelsDesc))]),t("div",{staticClass:"aioseo-columns"},[t("div",{staticClass:"aioseo-col col-xs-12 col-md-6 text-xs-left"},[t("span",{staticClass:"label-description"},[s._v(s._s(s.strings.singleLabel))]),t("base-input",{attrs:{type:"text",size:"medium"},model:{value:s.options.localBusiness.locations.general.singleLabel,callback:function(e){s.$set(s.options.localBusiness.locations.general,"singleLabel",e)},expression:"options.localBusiness.locations.general.singleLabel"}})],1),t("div",{staticClass:"aioseo-col col-xs-12 col-md-6 text-xs-left"},[t("span",{staticClass:"label-description"},[s._v(s._s(s.strings.pluralLabel))]),t("base-input",{attrs:{type:"text",size:"medium"},model:{value:s.options.localBusiness.locations.general.pluralLabel,callback:function(e){s.$set(s.options.localBusiness.locations.general,"pluralLabel",e)},expression:"options.localBusiness.locations.general.pluralLabel"}})],1)])]},proxy:!0}],null,!1,4277414536)})],1):s._e()],1)},ss=[],ts=n(X,Z,ss,!1,null,null,null,null);const es=ts.exports;const os={components:{BaseRadioToggle:u,BusinessInfo:V,CoreAlert:d,CoreCard:i,CoreProBadge:p,CoreSettingsRow:l,LocalBusinessLocationsDisplayInfo:Q,MultipleLocationsSettings:es,SvgDesktop:I,SvgMobile:A},data(){return{canShowMultipleLink:!1,displayInfo:{block:{copy:"",desc:this.$t.sprintf(this.$t.__('To add this block, edit a page or post and search for the "%1$s Local - Business Info" block.',this.$td),"AIOSEO")},shortcode:{copy:"[aioseo_local_business_info]",desc:this.$t.sprintf(this.$t.__("Use the following shortcode to display the location info. %1$s",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"localSeoShortcodeBusinessInfo",!0))},widget:{copy:"",desc:this.$t.sprintf(this.$t.__('To add this widget, visit the %1$swidgets page%2$s and look for the "%3$s Local - Business Info" widget.',this.$td),`<a href="${this.$aioseo.urls.admin.widgets}" target="_blank">`,"</a>","AIOSEO")},php:{copy:"<?php if( function_exists( 'aioseo_local_business_info' ) ) aioseo_local_business_info(); ?>",desc:this.$t.sprintf(this.$t.__("Use the following PHP code anywhere in your theme to display the location info. %1$s",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"localSeoFunctionBusinessInfo",!0))}},strings:{locationsSettings:this.$t.__("Locations Settings",this.$td),description:this.$t.sprintf(this.$t.__("Whether your business has multiple locations, or just one, %1$s makes it easy to configure and display relevant information about your local business. You can use the custom-built tools below, or you can use the Locations custom post type (multiple locations only) to generate relevant and necessary information for search engines or for your customers.",this.$td),"AIOSEO"),multipleLocations:this.$t.__("Multiple Locations",this.$td),multipleLocationsLink:this.$t.sprintf(this.$t.__("Use the %1$sLocations%2$s Post Type in the menu on the left to start adding your locations.",this.$td),`<a href="${this.$aioseo.localBusiness.postTypeEditLink}">`,"</a>"),multipleLocationsFree:this.$t.sprintf(this.$t.__("Multiple Locations feature is available only for %1$s Pro users. Upgrade to Pro and unlock all %2$s features!",this.$td),"AIOSEO","AIOSEO"),displayLocationInfo:this.$t.__("Display Location Info",this.$td),widget:this.$t.__("Widget",this.$td),shortcode:this.$t.__("Shortcode",this.$td),gutenbergBlock:this.$t.__("Gutenberg Block",this.$td),phpCode:this.$t.__("PHP Code",this.$td)}}},computed:{...h(["isUnlicensed"]),...r(["options"]),isMultipleLocation:{get(){return this.isUnlicensed?!1:this.options.localBusiness.locations.general.multiple},set(o){this.options.localBusiness.locations.general.multiple=o}}},methods:{handlePostTypeMenu(){const o=this.options.localBusiness.locations.general.multiple,s=document.getElementById("menu-posts-aioseo-location");if(o&&!s){const t=document.querySelectorAll("#adminmenu .wp-menu-separator"),e=document.createElement("div");e.setAttribute("id","aioseo-locations"),t[1]&&(t[1].parentNode.insertBefore(e,t[1].previousSibling),new _({render:a=>a(N)}).$mount(`#${e.getAttribute("id")}`))}!o&&s&&s.parentElement.removeChild(s),this.canShowMultipleLink=o}},mounted(){this.canShowMultipleLink=this.options.localBusiness.locations.general.multiple,this.$bus.$on("changes-saved",this.handlePostTypeMenu)}};var ns=function(){var s=this,t=s._self._c;return t("div",{staticClass:"aioseo-locations"},[t("core-card",{attrs:{slug:"locationsSettings","header-text":s.strings.locationsSettings}},[t("div",{staticClass:"aioseo-settings-row"},[t("p",{staticClass:"location-description"},[s._v(s._s(s.strings.description))])]),t("core-settings-row",{staticClass:"multiple-locations",scopedSlots:s._u([{key:"name",fn:function(){return[s._v(" "+s._s(s.strings.multipleLocations)+" "),s.isUnlicensed?t("core-pro-badge"):s._e()]},proxy:!0},{key:"content",fn:function(){return[t("base-radio-toggle",{attrs:{name:"multipleLocations",disabled:s.isUnlicensed,options:[{label:s.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:s.$constants.GLOBAL_STRINGS.yes,value:!0}]},scopedSlots:s._u([{key:"desktop",fn:function(){return[t("svg-desktop")]},proxy:!0},{key:"mobile",fn:function(){return[t("svg-mobile")]},proxy:!0}]),model:{value:s.isMultipleLocation,callback:function(e){s.isMultipleLocation=e},expression:"isMultipleLocation"}}),s.$aioseo.license.isActive&&s.canShowMultipleLink?t("core-alert",{staticClass:"locations-link",attrs:{type:"blue"}},[t("div",{domProps:{innerHTML:s._s(s.strings.multipleLocationsLink)}})]):s._e(),s.isUnlicensed?t("core-alert",{staticClass:"locations-link",attrs:{type:"blue"}},[t("div",{domProps:{innerHTML:s._s(s.strings.multipleLocationsFree)}})]):s._e()]},proxy:!0}])}),t("local-business-locations-display-info",{attrs:{label:s.strings.displayLocationInfo,displayOptions:s.displayInfo}})],1),s.options.localBusiness.locations.general.multiple?s._e():t("business-info"),s.options.localBusiness.locations.general.multiple?t("multiple-locations-settings"):s._e()],1)},is=[],as=n(os,ns,is,!1,null,null,null,null);const ls=as.exports;const rs={components:{CoreBlur:D,CoreSettingsRow:l,SvgCirclePlus:U},data(){return{strings:{description:this.$t.sprintf(this.$t.__("Whether your business has multiple locations, or just one, %1$s makes it easy to configure and display relevant information about your local business. You can use the custom-built tools below, or you can use the Locations custom post type (multiple locations only) to generate relevant and necessary information for search engines or for your customers.",this.$td),"AIOSEO"),name:this.$t.__("name",this.$td),nameDesc:this.$t.__("Your name or company name.",this.$td),businessType:this.$t.__("Type",this.$td),urls:this.$t.__("URLs",this.$td),image:this.$t.__("Image",this.$td),uploadOrSelectImage:this.$t.__("Upload or Select Image",this.$td),pasteYourImageUrl:this.$t.__("Paste your image URL or select a new image",this.$td),minimumSize:this.$t.__("Minimum size: 112px x 112px, The image must be in JPG, PNG, GIF, SVG, or WEBP format.",this.$td),remove:this.$t.__("Remove",this.$td),websiteDesc:this.$t.__("Website URL:",this.$td),aboutDesc:this.$t.__("About Page URL:",this.$td),contactDesc:this.$t.__("Contact Page URL:",this.$td)},businessTypes:[{label:this.$t.__("default",this.$td),value:"LocalBusiness"},{label:this.$t.__("Animal Shelter",this.$td),value:"Animal Shelter"}]}}};var cs=function(){var s=this,t=s._self._c;return t("div",{staticClass:"aioseo-locations-blur"},[t("core-blur",[t("div",{staticClass:"aioseo-settings-row"},[t("p",{staticClass:"location-description"},[s._v(s._s(s.strings.description))])]),t("core-settings-row",{staticClass:"info-name-row",attrs:{name:s.strings.name,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[t("base-input",{attrs:{type:"text",size:"medium"}}),t("span",{staticClass:"field-description"},[s._v(s._s(s.strings.nameDesc))])],1)]},proxy:!0}])}),t("core-settings-row",{staticClass:"info-business-image",attrs:{name:s.strings.image},scopedSlots:s._u([{key:"content",fn:function(){return[t("div",{staticClass:"image-upload"},[t("base-input",{attrs:{size:"medium",placeholder:s.strings.pasteYourImageUrl}}),t("base-button",{staticClass:"insert-image",attrs:{size:"medium",type:"black"}},[t("svg-circle-plus"),s._v(" "+s._s(s.strings.uploadOrSelectImage)+" ")],1),t("base-button",{staticClass:"remove-image",attrs:{size:"medium",type:"gray"}},[s._v(" "+s._s(s.strings.remove)+" ")])],1),t("div",{staticClass:"aioseo-description"},[s._v(" "+s._s(s.strings.minimumSize)+" ")])]},proxy:!0}])}),t("core-settings-row",{staticClass:"info-business-type",attrs:{name:s.strings.businessType,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("base-select",{attrs:{size:"large",options:s.businessTypes,value:"default"}})]},proxy:!0}])}),t("core-settings-row",{staticClass:"info-urls-row",attrs:{name:s.strings.urls,align:""},scopedSlots:s._u([{key:"content",fn:function(){return[t("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[t("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[t("span",{staticClass:"field-description"},[s._v(s._s(s.strings.websiteDesc))]),t("base-input",{attrs:{type:"text",size:"medium"}})],1),t("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[t("span",{staticClass:"field-description mt-8"},[s._v(s._s(s.strings.aboutDesc))]),t("base-input",{attrs:{type:"text",size:"medium"}})],1),t("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[t("span",{staticClass:"field-description mt-8"},[s._v(s._s(s.strings.contactDesc))]),t("base-input",{attrs:{type:"text",size:"medium"}})],1)])]},proxy:!0}])})],1)],1)},us=[],ds=n(rs,cs,us,!1,null,null,null,null);const c=ds.exports,ps={components:{ActivateCta:T,Blur:c,CoreCard:i},data(){return{strings:{businessInfo:this.$t.__("Business Info",this.$td)}}}};var _s=function(){var s=this,t=s._self._c;return t("div",[t("core-card",{attrs:{slug:"localBusinessInfo","header-text":s.strings.businessInfo,noSlide:!0}},[t("blur"),t("activate-cta",{attrs:{"align-top":!0}})],1)],1)},hs=[],ms=n(ps,_s,hs,!1,null,null,null,null);const gs=ms.exports;const fs={components:{Blur:c,RequiredPlans:O,CoreCard:i,CoreProBadge:p,Cta:E},data(){return{features:[this.$t.__("Local Business Schema",this.$td),this.$t.__("Multiple Locations",this.$td),this.$t.__("Business Info and Location blocks, widgets and shortcodes",this.$td),this.$t.__("Detailed Address, Contact and Payment Info",this.$td)],strings:{locationInfo1:this.$t.__("Local Business schema markup enables you to tell Google about your business, including your business name, address and phone number, opening hours and price range. This information may be displayed as a Knowledge Graph card or business carousel.",this.$td),businessInfo:this.$t.__("Business Info",this.$td),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Local SEO",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Local SEO is only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro")}}}};var $s=function(){var s=this,t=s._self._c;return t("div",{staticClass:"aioseo-locations-lite"},[t("core-card",{staticClass:"aioseo-locations-card",attrs:{slug:"localBusinessInfo",noSlide:!0},scopedSlots:s._u([{key:"header",fn:function(){return[t("span",[s._v(s._s(s.strings.businessInfo))]),t("core-pro-badge")]},proxy:!0}])},[t("blur"),t("cta",{attrs:{"cta-link":s.$links.getPricingUrl("local-seo","local-seo-upsell","locations"),"button-text":s.strings.ctaButtonText,"learn-more-link":s.$links.getUpsellUrl("local-seo",null,"home"),"feature-list":s.features,"align-top":""},scopedSlots:s._u([{key:"header-text",fn:function(){return[s._v(" "+s._s(s.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t("required-plans",{attrs:{addon:"aioseo-local-business"}}),s._v(" "+s._s(s.strings.locationInfo1)+" ")]},proxy:!0}])})],1)],1)},bs=[],ys=n(fs,$s,bs,!1,null,null,null,null);const vs=ys.exports,Ss={components:{Blur:c,CoreCard:i,UpdateCta:P},data(){return{strings:{businessInfo:this.$t.__("Business Info",this.$td)}}}};var Cs=function(){var s=this,t=s._self._c;return t("div",[t("core-card",{attrs:{slug:"localBusinessInfo","header-text":s.strings.businessInfo,noSlide:!0}},[t("blur"),t("update-cta",{attrs:{"align-top":!0}})],1)],1)},xs=[],Ls=n(Ss,Cs,xs,!1,null,null,null,null);const ws=Ls.exports,Bs={mixins:[m],components:{Locations:ls,Activate:gs,Lite:vs,Update:ws},data(){return{addonSlug:"aioseo-local-business"}}};var ks=function(){var s=this,t=s._self._c;return t("div",{staticClass:"aioseo-locations"},[s.shouldShowMain?t("locations"):s._e(),s.shouldShowActivate?t("activate"):s._e(),s.shouldShowUpdate?t("update"):s._e(),s.shouldShowLite?t("lite"):s._e()],1)},Is=[],As=n(Bs,ks,Is,!1,null,null,null,null);const wt=As.exports;export{wt as default};
