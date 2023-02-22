import{N as d}from"./WpTable.e9a9eb34.js";import{n as o}from"./_plugin-vue2_normalizer.61652a7c.js";import"./index.da77b995.js";import"./SaveChanges.e40a9083.js";import{a,c as n,m as c}from"./vuex.esm.8fdeb4b6.js";import{C as u}from"./Card.0104a053.js";import{C as _,S as m,a as h}from"./SitemapsPro.dc3ade0b.js";import{C as p}from"./GettingStarted.da5e4e39.js";import{C as g,a as f}from"./Index.f43bb78a.js";import{C as v}from"./Overview.3619b656.js";import{C as $}from"./SeoSetup.a73f38ca.js";import{p as S}from"./popup.b60b699f.js";import{S as l}from"./SeoSiteScore.29a89953.js";import{C}from"./Blur.f36c594d.js";import{C as k}from"./Index.60da4b92.js";import{C as y}from"./Tooltip.68a8a92b.js";import{C as w}from"./Index.5c05423e.js";import{G as b,a as x}from"./Row.830f6397.js";import{S as A}from"./Book.9dd59972.js";import{a as L,S as N}from"./Build.6a71ce0a.js";import{S as O}from"./index.0395bbae.js";import{S as E}from"./History.3424d012.js";import{S as z}from"./Message.4e485e01.js";import{S as M}from"./Redirect.e48d081e.js";import{S as U}from"./Rocket.dc643d1e.js";import{S as R}from"./Statistics.0134656c.js";import{S as T}from"./VideoCamera.8ac2fbea.js";import"./helpers.871dba46.js";import"./attachments.506687b9.js";import"./cleanForSlug.071f7a1a.js";import"./isArrayLikeObject.75d4eb51.js";import"./constants.8df4c584.js";import"./default-i18n.3a91e0e5.js";import"./Caret.6d7f2e24.js";import"./_commonjsHelpers.f84db168.js";import"./html.50126bda.js";import"./Index.ffa20ee1.js";import"./Slide.15a07930.js";import"./params.597cd0f5.js";import"./Url.c71d5763.js";/* empty css             */import"./Header.0387fa6e.js";import"./LicenseKeyBar.ac0fda9d.js";import"./LogoGear.16108a75.js";import"./AnimatedNumber.932b583a.js";import"./Logo.8785cc9f.js";import"./Support.85587a91.js";import"./Tabs.659e6500.js";import"./TruSeoScore.339d22e1.js";import"./Information.93f80cbf.js";import"./Exclamation.fd45a7b0.js";import"./Gear.184e0c65.js";import"./DonutChartWithLegend.72361d7c.js";import"./Index.b3d97c21.js";import"./client.e62d6c37.js";import"./translations.c394afe3.js";import"./portal-vue.esm.98f2e05b.js";const V={components:{CoreSiteScore:k},mixins:[l],props:{score:Number,loading:Boolean,summary:{type:Object,default(){return{}}}},data(){return{strings:{anErrorOccurred:this.$t.__("An error occurred while analyzing your site.",this.$td),criticalIssues:this.$t.__("Important Issues",this.$td),warnings:this.$t.__("Warnings",this.$td),recommendedImprovements:this.$t.__("Recommended Improvements",this.$td),goodResults:this.$t.__("Good Results",this.$td),completeSiteAuditChecklist:this.$t.__("Complete Site Audit Checklist",this.$td)}}},computed:{...a(["analyzeError"]),getError(){switch(this.analyzeError){case"invalid-url":return this.$t.__("The URL provided is invalid.",this.$td);case"missing-content":return this.$t.__("We were unable to parse the content for this site.",this.$td);case"invalid-token":return this.$t.sprintf(this.$t.__("Your site is not connected. Please connect to %1$s, then try again.",this.$td),"AIOSEO")}return this.analyzeError}}};var H=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-site-score-dashboard"},[t.analyzeError?t._e():s("div",{staticClass:"aioseo-seo-site-score-score"},[s("core-site-score",{attrs:{loading:t.loading,score:t.score,description:t.description}})],1),t.analyzeError?t._e():s("div",{staticClass:"aioseo-seo-site-score-recommendations"},[s("div",{staticClass:"critical"},[s("span",{staticClass:"round red"},[t._v(t._s(t.summary.critical||0))]),t._v(" "+t._s(t.strings.criticalIssues)+" ")]),s("div",{staticClass:"recommended"},[s("span",{staticClass:"round blue"},[t._v(t._s(t.summary.recommended||0))]),t._v(" "+t._s(t.strings.recommendedImprovements)+" ")]),s("div",{staticClass:"good"},[s("span",{staticClass:"round green"},[t._v(t._s(t.summary.good||0))]),t._v(" "+t._s(t.strings.goodResults)+" ")]),t.$allowed("aioseo_seo_analysis_settings")?s("div",{staticClass:"links"},[s("a",{attrs:{href:t.$aioseo.urls.aio.seoAnalysis}},[t._v(t._s(t.strings.completeSiteAuditChecklist))]),s("a",{staticClass:"no-underline",attrs:{href:t.$aioseo.urls.aio.seoAnalysis}},[t._v("→")])]):t._e()]),t.analyzeError?s("div",{staticClass:"analyze-errors"},[s("h3",[t._v(t._s(t.strings.anErrorOccurred))]),t._v(" "+t._s(t.getError)+" ")]):t._e()])},P=[],D=o(V,H,P,!1,null,null,null,null);const G=D.exports;const I={components:{CoreBlur:C,CoreSiteScoreDashboard:G},mixins:[l],computed:{...a(["internalOptions","options","analyzing"]),...n(["goodCount","recommendedCount","criticalCount","licenseKey"]),getSummary(){return{recommended:this.recommendedCount(),critical:this.criticalCount(),good:this.goodCount()}}},methods:{...c(["saveConnectToken","runSiteAnalyzer"]),openPopup(e){S(e,this.connectWithAioseo,600,630,!0,["token"],this.completedCallback,this.closedCallback)},completedCallback(e){return this.saveConnectToken(e.token)},closedCallback(e){e&&this.runSiteAnalyzer(),this.$store.commit("analyzing",!0)}},mounted(){!this.internalOptions.internal.siteAnalysis.score&&this.licenseKey&&(this.$store.commit("analyzing",!0),this.runSiteAnalyzer())}};var q=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-seo-site-score"},[t.licenseKey?t._e():s("core-blur",[s("core-site-score-dashboard",{attrs:{score:85,description:t.description}})],1),t.licenseKey?t._e():s("div",{staticClass:"aioseo-seo-site-score-cta"},[s("a",{attrs:{href:t.$aioseo.urls.aio.settings}},[t._v(t._s(t.strings.enterLicenseKey))]),t._v(" "+t._s(t.strings.toSeeYourSiteScore)+" ")]),t.licenseKey?s("core-site-score-dashboard",{attrs:{score:t.internalOptions.internal.siteAnalysis.score,description:t.description,loading:t.analyzing,summary:t.getSummary}}):t._e()],1)},Z=[],B=o(I,q,Z,!1,null,null,null,null);const F=B.exports,W={};var K=function(){var t=this,s=t._self._c;return s("svg",{staticClass:"aioseo-svg-clipboard-checkmark",attrs:{viewBox:"0 0 28 28",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[s("path",{attrs:{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M17.29 4.66668H22.1667C23.45 4.66668 24.5 5.71668 24.5 7.00001V23.3333C24.5 24.6167 23.45 25.6667 22.1667 25.6667H5.83333C5.67 25.6667 5.51833 25.655 5.36667 25.6317C4.91167 25.5383 4.50333 25.305 4.18833 24.99C3.97833 24.7683 3.80333 24.5233 3.68667 24.2433C3.57 23.9633 3.5 23.6483 3.5 23.3333V7.00001C3.5 6.67334 3.57 6.37001 3.68667 6.10168C3.80333 5.82168 3.97833 5.56501 4.18833 5.35501C4.50333 5.04001 4.91167 4.80668 5.36667 4.71334C5.51833 4.67834 5.67 4.66668 5.83333 4.66668H10.71C11.2 3.31334 12.4833 2.33334 14 2.33334C15.5167 2.33334 16.8 3.31334 17.29 4.66668ZM19.355 10.01L21 11.6667L11.6667 21L7 16.3334L8.645 14.6884L11.6667 17.6984L19.355 10.01ZM14 4.37501C14.4783 4.37501 14.875 4.77168 14.875 5.25001C14.875 5.72834 14.4783 6.12501 14 6.12501C13.5217 6.12501 13.125 5.72834 13.125 5.25001C13.125 4.77168 13.5217 4.37501 14 4.37501ZM5.83333 23.3333H22.1667V7.00001H5.83333V23.3333Z",fill:"currentColor"}})])},Y=[],j=o(W,K,Y,!1,null,null,null,null);const Q=j.exports,X={};var J=function(){var t=this,s=t._self._c;return s("svg",{staticClass:"aioseo-location-pin",attrs:{viewBox:"0 0 28 28",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[s("path",{attrs:{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M13.9999 2.33331C17.8616 2.33331 20.9999 5.47165 20.9999 9.33331C20.9999 14.5833 13.9999 22.1666 13.9999 22.1666C13.9999 22.1666 6.99992 14.5833 6.99992 9.33331C6.99992 5.47165 10.1383 2.33331 13.9999 2.33331ZM22.1666 25.6666V23.3333H5.83325V25.6666H22.1666ZM9.33325 9.33331C9.33325 6.75498 11.4216 4.66665 13.9999 4.66665C16.5783 4.66665 18.6666 6.75498 18.6666 9.33331C18.6666 11.8183 16.2399 15.7033 13.9999 18.5616C11.7599 15.715 9.33325 11.8183 9.33325 9.33331ZM11.6666 9.33331C11.6666 8.04998 12.7166 6.99998 13.9999 6.99998C15.2833 6.99998 16.3333 8.04998 16.3333 9.33331C16.3333 10.6166 15.2949 11.6666 13.9999 11.6666C12.7166 11.6666 11.6666 10.6166 11.6666 9.33331Z",fill:"currentColor"}})])},tt=[],st=o(X,J,tt,!1,null,null,null,null);const it=st.exports,et={};var ot=function(){var t=this,s=t._self._c;return s("svg",{staticClass:"aioseo-title-and-meta",attrs:{viewBox:"0 0 28 28",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[s("path",{attrs:{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M22.75 4.08334L21 2.33334L19.25 4.08334L17.5 2.33334L15.75 4.08334L14 2.33334L12.25 4.08334L10.5 2.33334L8.75 4.08334L7 2.33334L5.25 4.08334L3.5 2.33334V25.6667L5.25 23.9167L7 25.6667L8.75 23.9167L10.5 25.6667L12.25 23.9167L14 25.6667L15.75 23.9167L17.5 25.6667L19.25 23.9167L21 25.6667L22.75 23.9167L24.5 25.6667V2.33334L22.75 4.08334ZM22.1667 22.2717H5.83333V5.72833H22.1667V22.2717ZM21 17.5H7V19.8333H21V17.5ZM7 12.8333H21V15.1667H7V12.8333ZM21 8.16668H7V10.5H21V8.16668Z",fill:"currentColor"}})])},rt=[],at=o(et,ot,rt,!1,null,null,null,null);const nt=at.exports;const ct={components:{CoreCard:u,CoreFeatureCard:_,CoreGettingStarted:p,CoreMain:g,CoreNotificationCards:f,CoreOverview:v,CoreSeoSetup:$,CoreSeoSiteScore:F,CoreTooltip:y,Cta:w,GridColumn:b,GridRow:x,SvgBook:A,SvgBuild:L,SvgCircleQuestionMark:O,SvgClipboardCheckmark:Q,SvgHistory:E,SvgLinkAssistant:m,SvgLocationPin:it,SvgMessage:z,SvgRedirect:M,SvgRocket:U,SvgShare:N,SvgSitemapsPro:h,SvgStatistics:R,SvgTitleAndMeta:nt,SvgVideoCamera:T},mixins:[d],data(){return{dismissed:!1,visibleNotifications:3,strings:{pageName:this.$t.__("Dashboard",this.$td),noNewNotificationsThisMoment:this.$t.__("There are no new notifications at this moment.",this.$td),seeAllDismissedNotifications:this.$t.__("See all dismissed notifications.",this.$td),seoSiteScore:this.$t.__("SEO Site Score",this.$td),seoOverview:this.$t.sprintf(this.$t.__("%1$s Overview",this.$td),"AIOSEO"),seoSetup:this.$t.__("SEO Setup",this.$td),support:this.$t.__("Support",this.$td),readSeoUserGuide:this.$t.sprintf(this.$t.__("Read the %1$s user guide",this.$td),"All in One SEO"),accessPremiumSupport:this.$t.__("Access our Premium Support",this.$td),viewChangelog:this.$t.__("View the Changelog",this.$td),watchVideoTutorials:this.$t.__("Watch video tutorials",this.$td),gettingStarted:this.$t.__("Getting started? Read the Beginners Guide",this.$td),quicklinks:this.$t.__("Quicklinks",this.$td),quicklinksTooltip:this.$t.__("You can use these quicklinks to quickly access our settings pages to adjust your site's SEO settings.",this.$td),searchAppearance:this.$t.__("Search Appearance",this.$td),manageSearchAppearance:this.$t.__("Configure how your website content will look in Google, Bing and other search engines.",this.$td),seoAnalysis:this.$t.__("SEO Analysis",this.$td),manageSeoAnalysis:this.$t.__("Check how your site scores with our SEO analyzer and compare against your competitor's site.",this.$td),localSeo:this.$t.__("Local SEO",this.$td),manageLocalSeo:this.$t.__("Improve local SEO rankings with schema for business address, open hours, contact, and more.",this.$td),socialNetworks:this.$t.__("Social Networks",this.$td),manageSocialNetworks:this.$t.__("Setup Open Graph for Facebook, Twitter, etc. to show the right content / thumbnail preview.",this.$td),tools:this.$t.__("Tools",this.$td),manageTools:this.$t.__("Fine-tune your site with our powerful tools including Robots.txt editor, import/export and more.",this.$td),sitemap:this.$t.__("Sitemaps",this.$td),manageSitemap:this.$t.__("Manage all of your sitemap settings, including XML, Video, News and more.",this.$td),linkAssistant:this.$t.__("Link Assistant",this.$td),manageLinkAssistant:this.$t.__("Manage existing links, get relevant suggestions for adding internal links to older content, discover orphaned posts and more.",this.$td),redirects:this.$t.__("Redirection Manager",this.$td),manageRedirects:this.$t.__("Easily create and manage redirects for your broken links to avoid confusing search engines and users, as well as losing valuable backlinks.",this.$td),searchStatistics:this.$t.__("Search Statistics",this.$td),manageSearchStatistics:this.$t.__("Track how your site is performing in search rankings and generate reports with actionable insights.",this.$td),ctaHeaderText:this.$t.sprintf(this.$t.__("Get more features in %1$s %2$s:",this.$td),"AIOSEO","Pro"),ctaButton:this.$t.sprintf(this.$t.__("Upgrade to %1$s and Save %2$s",this.$td),"Pro",this.$constants.DISCOUNT_PERCENTAGE),dismissAll:this.$t.__("Dismiss All",this.$td),relaunchSetupWizard:this.$t.__("Relaunch Setup Wizard",this.$td)}}},computed:{...n(["isUnlicensed"]),...a(["settings"]),moreNotifications(){return this.$t.sprintf(this.$t.__("You have %1$s more notifications",this.$td),this.remainingNotificationsCount)},remainingNotificationsCount(){return this.notifications.length-this.visibleNotifications},filteredNotifications(){return[...this.notifications].splice(0,this.visibleNotifications)},supportOptions(){const e=[{icon:"svg-book",text:this.strings.readSeoUserGuide,link:this.$links.utmUrl("dashboard-support-box","user-guide","doc-categories/getting-started/"),blank:!0},{icon:"svg-message",text:this.strings.accessPremiumSupport,link:this.$links.utmUrl("dashboard-support-box","premium-support","contact/"),blank:!0},{icon:"svg-history",text:this.strings.viewChangelog,link:this.$links.utmUrl("dashboard-support-box","changelog","changelog/"),blank:!0},{icon:"svg-book",text:this.strings.gettingStarted,link:this.$links.utmUrl("dashboard-support-box","beginners-guide","docs/quick-start-guide/"),blank:!0}];return this.$allowed("aioseo_setup_wizard")?this.settings.showSetupWizard?e:e.concat({icon:"svg-rocket",text:this.strings.relaunchSetupWizard,link:this.$aioseo.urls.aio.wizard,blank:!1}):e},quickLinks(){return[{icon:"svg-title-and-meta",description:this.strings.manageSearchAppearance,name:this.strings.searchAppearance,manageUrl:this.$aioseo.urls.aio.searchAppearance,access:"aioseo_search_appearance_settings"},{icon:"svg-clipboard-checkmark",description:this.strings.manageSeoAnalysis,name:this.strings.seoAnalysis,manageUrl:this.$aioseo.urls.aio.seoAnalysis,access:"aioseo_seo_analysis_settings"},{icon:"svg-location-pin",description:this.strings.manageLocalSeo,name:this.strings.localSeo,manageUrl:this.$aioseo.urls.aio.localSeo,access:"aioseo_local_seo_settings"},{icon:"svg-share",description:this.strings.manageSocialNetworks,name:this.strings.socialNetworks,manageUrl:this.$aioseo.urls.aio.socialNetworks,access:"aioseo_social_networks_settings"},{icon:"svg-statistics",description:this.strings.manageSearchStatistics,name:this.strings.searchStatistics,manageUrl:this.$aioseo.urls.aio.searchStatistics,access:"aioseo_search_statistics_settings"},{icon:"svg-sitemaps-pro",description:this.strings.manageSitemap,name:this.strings.sitemap,manageUrl:this.$aioseo.urls.aio.sitemaps,access:"aioseo_sitemap_settings"},{icon:"svg-link-assistant",description:this.strings.manageLinkAssistant,name:this.strings.linkAssistant,manageUrl:this.$aioseo.urls.aio.linkAssistant,access:"aioseo_link_assistant_settings"},{icon:"svg-redirect",description:this.strings.manageRedirects,name:this.strings.redirects,manageUrl:this.$aioseo.urls.aio.redirects,access:"aioseo_redirects_settings"}].filter(e=>this.$allowed(e.access))}},methods:{...c(["dismissNotifications"]),processDismissAllNotifications(){const e=[];this.notifications.forEach(t=>{e.push(t.slug)}),this.dismissNotifications(e)}}};var lt=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-dashboard"},[s("core-main",{attrs:{"page-name":t.strings.pageName,"show-tabs":!1,"show-save-button":!1}},[s("div",[t.settings.showSetupWizard&&t.$allowed("aioseo_setup_wizard")?s("div",{staticClass:"dashboard-getting-started"},[s("core-getting-started")],1):t._e(),s("grid-row",[s("grid-column",{attrs:{md:"6"}},[t.$aioseo.setupWizard.isCompleted?t._e():s("core-card",{attrs:{slug:"dashboardSeoSetup","header-text":t.strings.seoSetup}},[s("core-seo-setup")],1),s("core-card",{attrs:{slug:"dashboardOverview","header-text":t.strings.seoOverview}},[s("core-overview")],1),t.quickLinks.length>0?s("grid-row",[s("grid-column",[s("div",{staticClass:"aioseo-quicklinks-title"},[t._v(" "+t._s(t.strings.quicklinks)+" "),s("core-tooltip",{scopedSlots:t._u([{key:"tooltip",fn:function(){return[t._v(" "+t._s(t.strings.quicklinksTooltip)+" ")]},proxy:!0}],null,!1,1392699054)},[s("svg-circle-question-mark")],1)],1)]),t._l(t.quickLinks,function(i,r){return s("grid-column",{key:r,staticClass:"aioseo-quicklinks-cards",attrs:{lg:"6"}},[s("core-feature-card",{attrs:{feature:i,"can-activate":!1,"can-manage":t.$allowed(i.access),"static-card":""},scopedSlots:t._u([{key:"title",fn:function(){return[s(i.icon,{tag:"component"}),t._v(" "+t._s(i.name)+" ")]},proxy:!0},{key:"description",fn:function(){return[t._v(" "+t._s(i.description)+" ")]},proxy:!0}],null,!0)})],1)})],2):t._e()],1),s("grid-column",{attrs:{md:"6"}},[s("core-card",{attrs:{slug:"dashboardSeoSiteScore","header-text":t.strings.seoSiteScore}},[s("core-seo-site-score")],1),s("core-card",{staticClass:"dashboard-notifications",attrs:{slug:"dashboardNotifications"},scopedSlots:t._u([{key:"header",fn:function(){return[t.notificationsCount?s("div",{staticClass:"notifications-count"},[t._v(" ("+t._s(t.notificationsCount)+") ")]):t._e(),s("div",[t._v(t._s(t.notificationTitle))]),t.dismissed?s("a",{staticClass:"show-dismissed-notifications",attrs:{href:"#"},on:{click:function(i){i.preventDefault(),t.dismissed=!1}}},[t._v(t._s(t.strings.activeNotifications))]):t._e()]},proxy:!0}])},[s("core-notification-cards",{attrs:{notifications:t.filteredNotifications,dismissedCount:t.dismissedNotificationsCount},on:{"toggle-dismissed":function(i){t.dismissed=!t.dismissed}},scopedSlots:t._u([{key:"no-notifications",fn:function(){return[s("div",{staticClass:"no-dashboard-notifications"},[s("div",[t._v(" "+t._s(t.strings.noNewNotificationsThisMoment)+" ")]),t.dismissedNotificationsCount?s("a",{attrs:{href:"#"},on:{click:function(i){i.preventDefault(),t.dismissed=!0}}},[t._v(t._s(t.strings.seeAllDismissedNotifications))]):t._e()])]},proxy:!0}])}),t.filteredNotifications.length&&(!t.dismissed||3<t.filteredNotifications.length)?s("div",{staticClass:"notification-footer"},[s("div",{staticClass:"more-notifications"},[t.notifications.length>t.visibleNotifications?[s("a",{attrs:{href:"#"},on:{click:function(i){return i.stopPropagation(),i.preventDefault(),t.toggleNotifications.apply(null,arguments)}}},[t._v(t._s(t.moreNotifications))]),s("a",{staticClass:"no-underline",attrs:{href:"#"},on:{click:function(i){return i.stopPropagation(),i.preventDefault(),t.toggleNotifications.apply(null,arguments)}}},[t._v("→")])]:t._e()],2),t.dismissed?t._e():s("div",{staticClass:"dismiss-all"},[t.notifications.length?s("a",{staticClass:"dismiss",attrs:{href:"#"},on:{click:function(i){return i.stopPropagation(),i.preventDefault(),t.processDismissAllNotifications.apply(null,arguments)}}},[t._v(t._s(t.strings.dismissAll))]):t._e()])]):t._e()],1),s("core-card",{staticClass:"dashboard-support",attrs:{slug:"dashboardSupport","header-text":t.strings.support}},t._l(t.supportOptions,function(i,r){return s("div",{key:r,staticClass:"aioseo-settings-row"},[s("a",{attrs:{href:i.link,target:i.blank?"_blank":null}},[s(i.icon,{tag:"component"}),t._v(" "+t._s(i.text)+" ")],1)])}),0),t.isUnlicensed?s("cta",{staticClass:"dashboard-cta",attrs:{type:3,floating:!1,"cta-link":t.$links.utmUrl("dashboard-cta"),"feature-list":t.$constants.UPSELL_FEATURE_LIST,"button-text":t.strings.ctaButton,"learn-more-link":t.$links.getUpsellUrl("dashboard-cta",null,"home")},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeaderText)+" ")]},proxy:!0}],null,!1,2059824803)}):t._e()],1)],1)],1)])],1)},dt=[],ut=o(ct,lt,dt,!1,null,null,null,null);const ps=ut.exports;export{ps as default};
