import{a}from"./vuex.esm.8fdeb4b6.js";import{B as n}from"./Checkbox.60ba2f56.js";import{B as o}from"./RadioToggle.e6e54396.js";import{B as r}from"./Textarea.ce149d81.js";import{C as i,S as c}from"./index.0395bbae.js";import{C as l}from"./Card.0104a053.js";import{C as d}from"./ExcludePosts.b97d645f.js";import{C as p}from"./HtmlTagsEditor.3c4e873a.js";import{C as u}from"./PostTypeOptions.9ef7007d.js";import{C as g}from"./RobotsMeta.5a1b6c31.js";import{C as h}from"./SettingsRow.edbb3005.js";import{C as _}from"./Tooltip.68a8a92b.js";import{S as m}from"./External.4c957e9a.js";import{n as f}from"./_plugin-vue2_normalizer.61652a7c.js";import"./Checkmark.f26f6201.js";import"./client.e62d6c37.js";import"./_commonjsHelpers.f84db168.js";import"./translations.c394afe3.js";import"./default-i18n.3a91e0e5.js";import"./Caret.6d7f2e24.js";import"./constants.8df4c584.js";import"./isArrayLikeObject.75d4eb51.js";import"./index.da77b995.js";import"./helpers.871dba46.js";import"./portal-vue.esm.98f2e05b.js";import"./Slide.15a07930.js";import"./WpTable.e9a9eb34.js";import"./attachments.506687b9.js";import"./cleanForSlug.071f7a1a.js";import"./html.50126bda.js";import"./Index.ffa20ee1.js";import"./JsonValues.870a4901.js";import"./SaveChanges.e40a9083.js";import"./AddPlus.9af097bc.js";import"./Editor.e0f43476.js";import"./UnfilteredHtml.395cff91.js";import"./HighlightToggle.62b97732.js";import"./Radio.7965b35c.js";import"./Row.830f6397.js";const v={components:{BaseCheckbox:n,BaseRadioToggle:o,BaseTextarea:r,CoreAlert:i,CoreCard:l,CoreExcludePosts:d,CoreHtmlTagsEditor:p,CorePostTypeOptions:u,CoreRobotsMeta:g,CoreSettingsRow:h,CoreTooltip:_,SvgCircleQuestionMark:c,SvgExternal:m},data(){return{emptyString:"",strings:{advanced:this.$t.__("Advanced Settings",this.$td),globalRobotsMeta:this.$t.__("Global Robots Meta",this.$td),noIndexEmptyCat:this.$t.__("Noindex Empty Category and Tag Archives",this.$td),removeStopWords:this.$t.__("Remove Stopwords from Permalinks",this.$td),autogenerateDescriptions:this.$t.__("Autogenerate Descriptions",this.$td),useContentForAutogeneratedDescriptions:this.$t.__("Use Content for Autogenerated Descriptions",this.$td),runShortcodes:this.$t.__("Run Shortcodes",this.$td),runShortcodesDescription:this.$t.sprintf(this.$t.__("This option allows you to control whether %1$s should parse shortcodes when generating data such as the SEO title/meta description. Enabling this setting may cause conflicts with third-party plugins/themes. %2$s",this.$td),"AIOSEO",this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"runningShortcodes",!0)),runShortcodesWarning:this.$t.sprintf(this.$t.__("NOTE: Enabling this setting may cause conflicts with third-party plugins/themes. %1$s",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"runningShortcodes",!0)),noPaginationForCanonical:this.$t.__("No Pagination for Canonical URLs",this.$td),useKeywords:this.$t.__("Use Meta Keywords",this.$td),useKeywordsDescription:this.$t.__("This option allows you to toggle the use of Meta Keywords throughout the whole of the site.",this.$td),useCategoriesForMetaKeywords:this.$t.__("Use Categories for Meta Keywords",this.$td),useCategoriesDescription:this.$t.__("Check this if you want your categories for a given post used as the Meta Keywords for this post (in addition to any keywords you specify on the Edit Post screen).",this.$td),useTagsForMetaKeywords:this.$t.__("Use Tags for Meta Keywords",this.$td),removeUnrecognizedQueryArgs:this.$t.__("Remove Query Args",this.$td),removeUnrecognizedQueryArgsDescription:this.$t.__("Enable this option to remove any unrecognized query args from your site.",this.$td),removeUnrecognizedQueryArgsAlert:this.$t.__("This will help prevent search engines from crawling every variation of your pages with all the unrecognized query arguments. Only enable this if you understand exactly what it does as it can have a significant impact on your site.",this.$td),allowedQueryArgs:this.$t.__("Allowed Query Args",this.$td),allowedQueryArgsDescription:this.$t.sprintf(this.$t.__('Add any query args that you want to allow, one per line. You can also use regular expressions here for advanced use. All query args that are used by WordPress Core (e.g. "s" for search pages) are automatically whitelisted by default. %1$s',this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"crawlCleanup",!0)),useTagsDescription:this.$t.__("Check this if you want your tags for a given post used as the Meta Keywords for this post (in addition to any keywords you specify on the Edit Post screen).",this.$td),dynamicallyGenerateKeywords:this.$t.__("Dynamically Generate Meta Keywords",this.$td),dynamicallyGenerateDescription:this.$t.__("Check this if you want your keywords on your Posts page (set in WordPress under Settings, Reading, Front Page Displays) and your archive pages to be dynamically generated from the keywords of the posts showing on that page. If unchecked, it will use the keywords set in the edit page screen for the posts page.",this.$td),pagedFormat:this.$t.__("Paged Format",this.$td),pagedFormatDescription:this.$t.__("This string gets appended to the titles and descriptions of paginated pages (like term or archive pages).",this.$td),descriptionFormat:this.$t.__("Description Format",this.$td),excludePostsPages:this.$t.__("Exclude Posts / Pages",this.$td),excludeTerms:this.$t.__("Exclude Terms",this.$td),sitelinks:this.$t.__("Enable Sitelinks Search Box",this.$td),sitelinksDescription:this.$t.sprintf(this.$t.__("Choose whether %1$s should output the required schema markup that Google needs to generate a sitelinks search box.",this.$td),"AIOSEO"),descriptionTagRequired:this.$t.__("A Description tag is required in order to properly display your meta descriptions on your site.",this.$td),crawlCleanup:this.$t.__("Crawl Cleanup",this.$td),crawlCleanupDescription:this.$t.__("Removing unrecognized query arguments from URLs and disabling unnecessary RSS feeds can help save search engine crawl quota and speed up content indexing for larger sites. If you choose to disable any feeds, those feed links will automatically redirect to your homepage or applicable archive page.",this.$td),globalFeed:this.$t.__("Global RSS Feed",this.$td),globalFeedDescription:this.$t.__("The global RSS feed is how users subscribe to any new content that has been created on your site.",this.$td),openYourRssFeed:this.$t.__("Open Your RSS Feed",this.$td),disableGlobalFeedAlert:this.$t.__("Disabling the global RSS feed is NOT recommended. This will prevent users from subscribing to your content and can hurt your SEO rankings.",this.$td),globalCommentsFeed:this.$t.__("Global Comments RSS Feed",this.$td),globalCommentsFeedDescription:this.$t.__("The global comments feed allows users to subscribe to any new comments added to your site.",this.$td),openYourCommentsRssFeed:this.$t.__("Open Your Comments RSS Feed",this.$td),staticBlogPageFeed:this.$t.__("Static Posts Page Feed",this.$td),staticBlogPageFeedDescription:this.$t.__("The static posts page feed allows users to subscribe to any new content added to your blog page.",this.$td),openYourStaticBlogPageFeed:this.$t.__("Open Your Static Posts Page RSS Feed",this.$td),authorsFeed:this.$t.__("Author Feeds",this.$td),authorsFeedDescription:this.$t.__("The authors feed allows your users to subscribe to any new content written by a specific author.",this.$td),postCommentsFeed:this.$t.__("Post Comment Feeds",this.$td),postCommentsFeedDescription:this.$t.__("The post comments feed allows your users to subscribe to any new comments on a specific page or post.",this.$td),searchFeed:this.$t.__("Search Feed",this.$td),searchFeedDescription:this.$t.__("The search feed description allows visitors to subscribe to your content based on a specific search term.",this.$td),attachmentsFeed:this.$t.__("Attachments Feed",this.$td),attachmentsFeedDescription:this.$t.__("The attachments feed allows users to subscribe to any changes to your site made to media file categories.",this.$td),postTypesFeed:this.$t.__("Post Type Archive Feeds",this.$td),includeAllPostTypes:this.$t.__("Include All Post Type Archives",this.$td),selectPostTypes:this.$t.__("Select which post type archives should include an RSS feed. This only applies to post types that include an archive page.",this.$td),taxonomiesFeed:this.$t.__("Taxonomy Feeds",this.$td),includeAllTaxonomies:this.$t.__("Include All Taxonomies",this.$td),selectTaxonomies:this.$t.__("Select which Taxonomies should include an RSS feed.",this.$td),atomFeed:this.$t.__("Atom Feed",this.$td),atomFeedDescription:this.$t.sprintf(this.$t.__("This is a global feed of your site output in the Atom format. %1$s",this.$td),this.$links.getPlainLink(this.$constants.GLOBAL_STRINGS.learnMore,"http://www.atomenabled.org/",!0)),openYourAtomFeed:this.$t.__("Open Your Atom Feed",this.$td),rdfFeed:this.$t.__("RDF/RSS 1.0 Feed",this.$td),rdfFeedDescription:this.$t.sprintf(this.$t.__("This is a global feed of your site output in the RDF/RSS 1.0 format. %1$s",this.$td),this.$links.getPlainLink(this.$constants.GLOBAL_STRINGS.learnMore,"https://web.resource.org/rss/1.0/",!0)),openYourRdfFeed:this.$t.__("Open Your RDF Feed",this.$td),paginatedFeed:this.$t.__("Paginated RSS Feeds",this.$td),paginatedFeedDescription:this.$t.__("The paginated RSS feeds are for any posts or pages that are paginated.",this.$td)}}},computed:{...a(["options","internalOptions"])}};var y=function(){var e=this,s=e._self._c;return s("div",{staticClass:"aioseo-search-appearance-advanced"},[s("core-card",{attrs:{slug:"searchAdvanced","header-text":e.strings.advanced}},[s("core-settings-row",{attrs:{name:e.strings.globalRobotsMeta},scopedSlots:e._u([{key:"content",fn:function(){return[s("core-robots-meta",{attrs:{options:e.options.searchAppearance.advanced.globalRobotsMeta,global:""}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.sitelinks,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:e.strings.sitelinks,options:[{label:e.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:e.options.searchAppearance.advanced.sitelinks,callback:function(t){e.$set(e.options.searchAppearance.advanced,"sitelinks",t)},expression:"options.searchAppearance.advanced.sitelinks"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.sitelinksDescription)+" ")])]},proxy:!0}])}),e.internalOptions.internal.deprecatedOptions.includes("autogenerateDescriptions")?s("core-settings-row",{attrs:{name:e.strings.autogenerateDescriptions,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"autogenerateDescriptions",options:[{label:e.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:e.options.deprecated.searchAppearance.advanced.autogenerateDescriptions,callback:function(t){e.$set(e.options.deprecated.searchAppearance.advanced,"autogenerateDescriptions",t)},expression:"options.deprecated.searchAppearance.advanced.autogenerateDescriptions"}})]},proxy:!0}],null,!1,3425659337)}):e._e(),e.internalOptions.internal.deprecatedOptions.includes("useContentForAutogeneratedDescriptions")&&(!e.internalOptions.internal.deprecatedOptions.includes("autogenerateDescriptions")||e.options.deprecated.searchAppearance.advanced.autogenerateDescriptions)?s("core-settings-row",{attrs:{name:e.strings.useContentForAutogeneratedDescriptions,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"useContentForAutogeneratedDescriptions",options:[{label:e.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:e.options.deprecated.searchAppearance.advanced.useContentForAutogeneratedDescriptions,callback:function(t){e.$set(e.options.deprecated.searchAppearance.advanced,"useContentForAutogeneratedDescriptions",t)},expression:"options.deprecated.searchAppearance.advanced.useContentForAutogeneratedDescriptions"}})]},proxy:!0}],null,!1,1103360809)}):e._e(),s("core-settings-row",{attrs:{name:e.strings.noPaginationForCanonical,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"noPaginationForCanonical",options:[{label:e.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:e.options.searchAppearance.advanced.noPaginationForCanonical,callback:function(t){e.$set(e.options.searchAppearance.advanced,"noPaginationForCanonical",t)},expression:"options.searchAppearance.advanced.noPaginationForCanonical"}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.useKeywords,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"useKeywords",options:[{label:e.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:e.options.searchAppearance.advanced.useKeywords,callback:function(t){e.$set(e.options.searchAppearance.advanced,"useKeywords",t)},expression:"options.searchAppearance.advanced.useKeywords"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.useKeywordsDescription)+" ")])]},proxy:!0}])}),e.options.searchAppearance.advanced.useKeywords?s("core-settings-row",{attrs:{name:e.strings.useCategoriesForMetaKeywords,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"useCategoriesForMetaKeywords",options:[{label:e.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:e.options.searchAppearance.advanced.useCategoriesForMetaKeywords,callback:function(t){e.$set(e.options.searchAppearance.advanced,"useCategoriesForMetaKeywords",t)},expression:"options.searchAppearance.advanced.useCategoriesForMetaKeywords"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.useCategoriesDescription)+" ")])]},proxy:!0}],null,!1,1182210491)}):e._e(),e.options.searchAppearance.advanced.useKeywords?s("core-settings-row",{attrs:{name:e.strings.useTagsForMetaKeywords,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"useTagsForMetaKeywords",options:[{label:e.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:e.options.searchAppearance.advanced.useTagsForMetaKeywords,callback:function(t){e.$set(e.options.searchAppearance.advanced,"useTagsForMetaKeywords",t)},expression:"options.searchAppearance.advanced.useTagsForMetaKeywords"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.useTagsDescription)+" ")])]},proxy:!0}],null,!1,980507244)}):e._e(),e.options.searchAppearance.advanced.useKeywords?s("core-settings-row",{attrs:{name:e.strings.dynamicallyGenerateKeywords,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"dynamicallyGenerateKeywords",options:[{label:e.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:e.options.searchAppearance.advanced.dynamicallyGenerateKeywords,callback:function(t){e.$set(e.options.searchAppearance.advanced,"dynamicallyGenerateKeywords",t)},expression:"options.searchAppearance.advanced.dynamicallyGenerateKeywords"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.dynamicallyGenerateDescription)+" ")])]},proxy:!0}],null,!1,3269411336)}):e._e(),e.internalOptions.internal.deprecatedOptions.includes("descriptionFormat")?s("core-settings-row",{attrs:{id:"description-format",name:e.strings.descriptionFormat,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("core-html-tags-editor",{staticClass:"description-format",attrs:{"line-numbers":!1,single:"","show-tags-description":!1,"tags-context":"descriptionFormat","default-tags":["description","site_title","tagline"],"show-all-tags-link":!0},scopedSlots:e._u([{key:"tags-description",fn:function(){return[e._v(" "+e._s(e.emptyString)+" ")]},proxy:!0}],null,!1,115256282),model:{value:e.options.deprecated.searchAppearance.global.descriptionFormat,callback:function(t){e.$set(e.options.deprecated.searchAppearance.global,"descriptionFormat",t)},expression:"options.deprecated.searchAppearance.global.descriptionFormat"}}),e.options.deprecated.searchAppearance.global.descriptionFormat.includes("#description")?e._e():s("core-alert",{staticClass:"description-notice",attrs:{type:"red"}},[e._v(" "+e._s(e.strings.descriptionTagRequired)+" ")])]},proxy:!0}],null,!1,3789774672)}):e._e(),s("core-settings-row",{attrs:{name:e.strings.runShortcodes,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"runShortcodes",options:[{label:e.$constants.GLOBAL_STRINGS.off,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.on,value:!0}]},model:{value:e.options.searchAppearance.advanced.runShortcodes,callback:function(t){e.$set(e.options.searchAppearance.advanced,"runShortcodes",t)},expression:"options.searchAppearance.advanced.runShortcodes"}}),e.options.searchAppearance.advanced.runShortcodes?s("core-alert",{staticClass:"run-shortcodes-alert",attrs:{type:"yellow"},domProps:{innerHTML:e._s(e.strings.runShortcodesWarning)}}):e._e(),s("div",{staticClass:"aioseo-description",domProps:{innerHTML:e._s(e.strings.runShortcodesDescription)}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.pagedFormat,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("core-html-tags-editor",{staticClass:"paged-format",attrs:{"line-numbers":!1,single:"","tags-context":"pagedFormat","default-tags":["page_number"],"show-all-tags-link":!1},scopedSlots:e._u([{key:"tags-description",fn:function(){return[e._v(" "+e._s(e.emptyString)+" ")]},proxy:!0}]),model:{value:e.options.searchAppearance.advanced.pagedFormat,callback:function(t){e.$set(e.options.searchAppearance.advanced,"pagedFormat",t)},expression:"options.searchAppearance.advanced.pagedFormat"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.pagedFormatDescription)+" ")])]},proxy:!0}])}),e.internalOptions.internal.deprecatedOptions.includes("excludePosts")?s("core-settings-row",{staticClass:"aioseo-exclude-pages-posts",attrs:{name:e.strings.excludePostsPages,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("core-exclude-posts",{attrs:{options:e.options.deprecated.searchAppearance.advanced,type:"posts"}})]},proxy:!0}],null,!1,4134150415)}):e._e(),e.internalOptions.internal.deprecatedOptions.includes("excludeTerms")?s("core-settings-row",{staticClass:"aioseo-exclude-terms",attrs:{name:e.strings.excludeTerms,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("core-exclude-posts",{attrs:{options:e.options.deprecated.searchAppearance.advanced,type:"terms"}})]},proxy:!0}],null,!1,1691116537)}):e._e()],1),s("core-card",{staticClass:"aioseo-rss-content-advanced",attrs:{slug:"searchAdvancedCrawlCleanup",toggles:e.options.searchAppearance.advanced.crawlCleanup.enable},scopedSlots:e._u([{key:"header",fn:function(){return[s("base-toggle",{model:{value:e.options.searchAppearance.advanced.crawlCleanup.enable,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup,"enable",t)},expression:"options.searchAppearance.advanced.crawlCleanup.enable"}}),s("span",[e._v(e._s(e.strings.crawlCleanup))]),e.options.searchAppearance.advanced.crawlCleanup.enable?e._e():s("core-tooltip",{scopedSlots:e._u([{key:"tooltip",fn:function(){return[e._v(" "+e._s(e.strings.crawlCleanupDescription)+" "),s("span",{domProps:{innerHTML:e._s(e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"crawlCleanup",!0))}})]},proxy:!0}],null,!1,3235161590)},[s("svg-circle-question-mark")],1)]},proxy:!0}])},[s("div",{staticClass:"aioseo-settings-row aioseo-section-description"},[e._v(" "+e._s(e.strings.crawlCleanupDescription)+" "),s("span",{domProps:{innerHTML:e._s(e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"crawlCleanup",!0))}})]),s("core-settings-row",{attrs:{name:e.strings.removeUnrecognizedQueryArgs,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"removeUnrecognizedQueryArgs",options:[{label:e.$constants.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.removeUnrecognizedQueryArgs,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup,"removeUnrecognizedQueryArgs",t)},expression:"options.searchAppearance.advanced.crawlCleanup.removeUnrecognizedQueryArgs"}}),e.options.searchAppearance.advanced.crawlCleanup.removeUnrecognizedQueryArgs?e._e():s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.removeUnrecognizedQueryArgsDescription)+" "+e._s(e.strings.removeUnrecognizedQueryArgsAlert)+" ")]),e.options.searchAppearance.advanced.crawlCleanup.removeUnrecognizedQueryArgs?s("core-alert",{attrs:{type:"yellow"}},[e._v(" "+e._s(e.strings.removeUnrecognizedQueryArgsAlert)+" ")]):e._e()]},proxy:!0}])}),e.options.searchAppearance.advanced.crawlCleanup.removeUnrecognizedQueryArgs?s("core-settings-row",{attrs:{name:e.strings.allowedQueryArgs},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-textarea",{attrs:{minHeight:200,maxHeight:200},model:{value:e.options.searchAppearance.advanced.crawlCleanup.allowedQueryArgs,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup,"allowedQueryArgs",t)},expression:"options.searchAppearance.advanced.crawlCleanup.allowedQueryArgs"}}),s("div",{staticClass:"aioseo-description",domProps:{innerHTML:e._s(e.strings.allowedQueryArgsDescription)}})]},proxy:!0}],null,!1,4112819009)}):e._e(),s("core-settings-row",{attrs:{id:"crawl-content-global-feed",name:e.strings.globalFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"global",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.global,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"global",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.global"}}),e.options.searchAppearance.advanced.crawlCleanup.feeds.global?s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.globalFeedDescription)+" "+e._s(e.strings.disableGlobalFeedAlert)+" "),s("div",{staticClass:"rss-link"},[s("a",{attrs:{href:e.$aioseo.urls.feeds.global,target:"_blank"}},[e._v(e._s(e.strings.openYourRssFeed))]),s("a",{staticClass:"no-underline",attrs:{href:e.$aioseo.urls.feeds.global,target:"_blank"}},[e._v(" "),s("svg-external")],1)])]):e._e(),e.options.searchAppearance.advanced.crawlCleanup.feeds.global?e._e():s("core-alert",{attrs:{type:"red"}},[e._v(" "+e._s(e.strings.disableGlobalFeedAlert)+" ")])]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.globalCommentsFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"globalComments",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.globalComments,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"globalComments",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.globalComments"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.globalCommentsFeedDescription)+" ")]),e.options.searchAppearance.advanced.crawlCleanup.feeds.globalComments?s("div",{staticClass:"aioseo-description"},[s("a",{attrs:{href:e.$aioseo.urls.feeds.globalComments,target:"_blank"}},[e._v(e._s(e.strings.openYourCommentsRssFeed))]),s("a",{staticClass:"no-underline",attrs:{href:e.$aioseo.urls.feeds.globalComments,target:"_blank"}},[e._v(" "),s("svg-external")],1)]):e._e()]},proxy:!0}])}),e.$aioseo.data.staticBlogPage?s("core-settings-row",{attrs:{name:e.strings.staticBlogPageFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"staticBlogPage",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.staticBlogPage,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"staticBlogPage",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.staticBlogPage"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.staticBlogPageFeedDescription)+" ")]),e.options.searchAppearance.advanced.crawlCleanup.feeds.staticBlogPage?s("div",{staticClass:"aioseo-description"},[s("a",{attrs:{href:e.$aioseo.urls.feeds.staticBlogPage,target:"_blank"}},[e._v(e._s(e.strings.openYourStaticBlogPageFeed))]),s("a",{staticClass:"no-underline",attrs:{href:e.$aioseo.urls.feeds.staticBlogPage,target:"_blank"}},[e._v(" "),s("svg-external")],1)]):e._e()]},proxy:!0}],null,!1,2073575804)}):e._e(),s("core-settings-row",{attrs:{name:e.strings.authorsFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"authors",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.authors,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"authors",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.authors"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.authorsFeedDescription)+" ")])]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.postCommentsFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"postComments",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.postComments,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"postComments",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.postComments"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.postCommentsFeedDescription)+" ")])]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.searchFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"search",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.search,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"search",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.search"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.searchFeedDescription)+" ")])]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.attachmentsFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"attachments",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.attachments,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"attachments",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.attachments"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.attachmentsFeedDescription)+" ")])]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.paginatedFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"paginated",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.paginated,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"paginated",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.paginated"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.paginatedFeedDescription)+" ")])]},proxy:!0}])}),e.$aioseo.postData.archives.length?s("core-settings-row",{attrs:{name:e.strings.postTypesFeed},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-checkbox",{attrs:{size:"medium"},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.archives.all,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds.archives,"all",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.archives.all"}},[e._v(" "+e._s(e.strings.includeAllPostTypes)+" ")]),e.options.searchAppearance.advanced.crawlCleanup.feeds.archives.all?e._e():s("core-post-type-options",{attrs:{options:e.options.searchAppearance.advanced.crawlCleanup.feeds,type:"archives"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.selectPostTypes)+" ")])]},proxy:!0}],null,!1,1023774212)}):e._e(),s("core-settings-row",{attrs:{name:e.strings.taxonomiesFeed},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-checkbox",{attrs:{size:"medium"},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.taxonomies.all,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds.taxonomies,"all",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.taxonomies.all"}},[e._v(" "+e._s(e.strings.includeAllTaxonomies)+" ")]),e.options.searchAppearance.advanced.crawlCleanup.feeds.taxonomies.all?e._e():s("core-post-type-options",{attrs:{options:e.options.searchAppearance.advanced.crawlCleanup.feeds,type:"taxonomies"}}),s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.selectTaxonomies)+" ")])]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.atomFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"atom",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.atom,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"atom",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.atom"}}),s("div",{staticClass:"aioseo-description",domProps:{innerHTML:e._s(e.strings.atomFeedDescription)}}),e.options.searchAppearance.advanced.crawlCleanup.feeds.atom?s("div",{staticClass:"aioseo-description"},[s("a",{attrs:{href:e.$aioseo.urls.feeds.atom,target:"_blank"}},[e._v(e._s(e.strings.openYourAtomFeed))]),s("a",{staticClass:"no-underline",attrs:{href:e.$aioseo.urls.feeds.atom,target:"_blank"}},[e._v(" "),s("svg-external")],1)]):e._e()]},proxy:!0}])}),s("core-settings-row",{attrs:{name:e.strings.rdfFeed,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-radio-toggle",{attrs:{name:"rdf",options:[{label:e.$constants.GLOBAL_STRINGS.disabled,value:!1,activeClass:"dark"},{label:e.$constants.GLOBAL_STRINGS.enabled,value:!0}]},model:{value:e.options.searchAppearance.advanced.crawlCleanup.feeds.rdf,callback:function(t){e.$set(e.options.searchAppearance.advanced.crawlCleanup.feeds,"rdf",t)},expression:"options.searchAppearance.advanced.crawlCleanup.feeds.rdf"}}),s("div",{staticClass:"aioseo-description",domProps:{innerHTML:e._s(e.strings.rdfFeedDescription)}}),e.options.searchAppearance.advanced.crawlCleanup.feeds.rdf?s("div",{staticClass:"aioseo-description"},[s("a",{attrs:{href:e.$aioseo.urls.feeds.rdf,target:"_blank"}},[e._v(e._s(e.strings.openYourRdfFeed))]),s("a",{staticClass:"no-underline",attrs:{href:e.$aioseo.urls.feeds.rdf,target:"_blank"}},[e._v(" "),s("svg-external")],1)]):e._e()]},proxy:!0}])})],1)],1)},$=[],b=f(v,y,$,!1,null,null,null,null);const ce=b.exports;export{ce as default};
