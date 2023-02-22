import{V as c,n as _}from"./js/_plugin-vue2_normalizer.61652a7c.js";import"./js/index.0395bbae.js";import{a as p}from"./js/vuex.esm.8fdeb4b6.js";import{C as d}from"./js/Caret.6d7f2e24.js";import{C as h}from"./js/Index.ffa20ee1.js";import{S as f}from"./js/Information.93f80cbf.js";import{s as m}from"./js/index.da77b995.js";import{_ as v,a as i,s as g,b as w}from"./js/index.b54837e0.js";import{_ as a}from"./js/default-i18n.3a91e0e5.js";import"./js/client.e62d6c37.js";import"./js/_commonjsHelpers.f84db168.js";import"./js/translations.c394afe3.js";import"./js/constants.8df4c584.js";import"./js/isArrayLikeObject.75d4eb51.js";import"./js/helpers.871dba46.js";import"./js/portal-vue.esm.98f2e05b.js";function y({next:s,router:t,to:e}){const l="Pro".toLowerCase()!=="pro"||!window.aioseo.license.isActive,r=e.meta.licenseFeature||e.meta.middlewareData.licenseFeature||"";return l||!c.prototype.$license.hasCoreFeature(r[0],r[1])?t.push({name:e.meta.middlewareData.routeName}).catch(()=>{}):s()}const R={components:{CoreLoader:d,CoreModal:h,SvgCircleInformation:f},data(){return{strings:{title:this.$t.__("Refreshing data",this.$td),description:this.$t.__("Loading new report data...",this.$td)}}},computed:{...p("search-statistics",["fetching"])}};var S=function(){var t=this,e=t._self._c;return t.fetching?e("core-modal",{attrs:{classes:["aioseo-fetching-data"],noHeader:""},scopedSlots:t._u([{key:"body",fn:function(){return[e("svg-circle-information",{attrs:{width:"90",height:"90"}}),e("div",{staticClass:"aioseo-fetching-data-title"},[t._v(t._s(t.strings.title))]),e("div",{staticClass:"aioseo-fetching-data-description"},[t._v(t._s(t.strings.description))]),e("core-loader",{attrs:{dark:""}})]},proxy:!0}],null,!1,1864802177)}):t._e()},b=[],C=_(R,S,b,!1,null,null,null,null);const D=C.exports,$={components:{Fetching:D}};var k=function(){var t=this,e=t._self._c;return e("div",{staticClass:"aioseo-app"},[e("router-view"),e("fetching")],1)},A=[],E=_($,k,A,!1,null,null,null,null);const F=E.exports,n="all-in-one-seo-pack",o=s=>()=>v(Object.assign({"../views/Dashboard.vue":()=>i(()=>import("./js/Dashboard.d32219f6.js"),[window.__aioseoDynamicImportPreload__("js/Dashboard.d32219f6.js"),window.__aioseoDynamicImportPreload__("js/vuex.esm.8fdeb4b6.js"),window.__aioseoDynamicImportPreload__("js/_plugin-vue2_normalizer.61652a7c.js"),window.__aioseoDynamicImportPreload__("js/Blur.f36c594d.js"),window.__aioseoDynamicImportPreload__("css/Blur.6e77dae4.css"),window.__aioseoDynamicImportPreload__("js/Card.0104a053.js"),window.__aioseoDynamicImportPreload__("js/Tooltip.68a8a92b.js"),window.__aioseoDynamicImportPreload__("js/_commonjsHelpers.f84db168.js"),window.__aioseoDynamicImportPreload__("css/Tooltip.c2302985.css"),window.__aioseoDynamicImportPreload__("js/Caret.6d7f2e24.js"),window.__aioseoDynamicImportPreload__("css/Caret.be535beb.css"),window.__aioseoDynamicImportPreload__("js/index.0395bbae.js"),window.__aioseoDynamicImportPreload__("js/client.e62d6c37.js"),window.__aioseoDynamicImportPreload__("js/translations.c394afe3.js"),window.__aioseoDynamicImportPreload__("js/default-i18n.3a91e0e5.js"),window.__aioseoDynamicImportPreload__("js/constants.8df4c584.js"),window.__aioseoDynamicImportPreload__("js/isArrayLikeObject.75d4eb51.js"),window.__aioseoDynamicImportPreload__("js/index.da77b995.js"),window.__aioseoDynamicImportPreload__("js/helpers.871dba46.js"),window.__aioseoDynamicImportPreload__("js/portal-vue.esm.98f2e05b.js"),window.__aioseoDynamicImportPreload__("css/index.e8e7e8d0.css"),window.__aioseoDynamicImportPreload__("js/Slide.15a07930.js"),window.__aioseoDynamicImportPreload__("css/Card.1dc33bd1.css"),window.__aioseoDynamicImportPreload__("js/Tabs.659e6500.js"),window.__aioseoDynamicImportPreload__("js/SaveChanges.e40a9083.js"),window.__aioseoDynamicImportPreload__("js/TruSeoScore.339d22e1.js"),window.__aioseoDynamicImportPreload__("js/Information.93f80cbf.js"),window.__aioseoDynamicImportPreload__("css/Tabs.fb196b90.css"),window.__aioseoDynamicImportPreload__("js/Overview.3619b656.js"),window.__aioseoDynamicImportPreload__("js/DonutChartWithLegend.72361d7c.js"),window.__aioseoDynamicImportPreload__("js/AnimatedNumber.932b583a.js"),window.__aioseoDynamicImportPreload__("css/DonutChartWithLegend.23d5f7fe.css"),window.__aioseoDynamicImportPreload__("css/Overview.63555ee7.css"),window.__aioseoDynamicImportPreload__("js/Row.830f6397.js"),window.__aioseoDynamicImportPreload__("css/Row.576b0c57.css"),window.__aioseoDynamicImportPreload__("js/KeywordsGraph.b1ced50c.js"),window.__aioseoDynamicImportPreload__("js/Table.a4e25fec.js"),window.__aioseoDynamicImportPreload__("css/Table.14a882e0.css"),window.__aioseoDynamicImportPreload__("js/Index.5c05423e.js"),window.__aioseoDynamicImportPreload__("css/Index.b175e011.css"),window.__aioseoDynamicImportPreload__("js/WpTable.e9a9eb34.js"),window.__aioseoDynamicImportPreload__("js/attachments.506687b9.js"),window.__aioseoDynamicImportPreload__("js/cleanForSlug.071f7a1a.js"),window.__aioseoDynamicImportPreload__("js/html.50126bda.js"),window.__aioseoDynamicImportPreload__("js/Index.ffa20ee1.js"),window.__aioseoDynamicImportPreload__("css/Index.736c3936.css"),window.__aioseoDynamicImportPreload__("css/KeywordsGraph.6b9db545.css"),window.__aioseoDynamicImportPreload__("js/List.41118d8d.js"),window.__aioseoDynamicImportPreload__("js/Statistics.0134656c.js"),window.__aioseoDynamicImportPreload__("js/PostsTable.ad656834.js"),window.__aioseoDynamicImportPreload__("js/PostTypes.9ab32454.js"),window.__aioseoDynamicImportPreload__("js/ScoreButton.392b731e.js"),window.__aioseoDynamicImportPreload__("css/ScoreButton.30a33f11.css"),window.__aioseoDynamicImportPreload__("js/Table.8c51f443.js"),window.__aioseoDynamicImportPreload__("css/Table.7858fdb8.css"),window.__aioseoDynamicImportPreload__("js/Affiliate.e587b0fd.js"),window.__aioseoDynamicImportPreload__("js/Suggestion.5facc4fd.js"),window.__aioseoDynamicImportPreload__("css/PostsTable.9e7578fb.css"),window.__aioseoDynamicImportPreload__("js/RequiredPlans.389a71cb.js"),window.__aioseoDynamicImportPreload__("css/Dashboard.7388ac01.css")],import.meta.url),"../views/KeywordRankings.vue":()=>i(()=>import("./js/KeywordRankings.efe115c1.js").then(t=>t.b),[window.__aioseoDynamicImportPreload__("js/KeywordRankings.efe115c1.js"),window.__aioseoDynamicImportPreload__("js/vuex.esm.8fdeb4b6.js"),window.__aioseoDynamicImportPreload__("js/Blur.f36c594d.js"),window.__aioseoDynamicImportPreload__("js/_plugin-vue2_normalizer.61652a7c.js"),window.__aioseoDynamicImportPreload__("css/Blur.6e77dae4.css"),window.__aioseoDynamicImportPreload__("js/Card.0104a053.js"),window.__aioseoDynamicImportPreload__("js/Tooltip.68a8a92b.js"),window.__aioseoDynamicImportPreload__("js/_commonjsHelpers.f84db168.js"),window.__aioseoDynamicImportPreload__("css/Tooltip.c2302985.css"),window.__aioseoDynamicImportPreload__("js/Caret.6d7f2e24.js"),window.__aioseoDynamicImportPreload__("css/Caret.be535beb.css"),window.__aioseoDynamicImportPreload__("js/index.0395bbae.js"),window.__aioseoDynamicImportPreload__("js/client.e62d6c37.js"),window.__aioseoDynamicImportPreload__("js/translations.c394afe3.js"),window.__aioseoDynamicImportPreload__("js/default-i18n.3a91e0e5.js"),window.__aioseoDynamicImportPreload__("js/constants.8df4c584.js"),window.__aioseoDynamicImportPreload__("js/isArrayLikeObject.75d4eb51.js"),window.__aioseoDynamicImportPreload__("js/index.da77b995.js"),window.__aioseoDynamicImportPreload__("js/helpers.871dba46.js"),window.__aioseoDynamicImportPreload__("js/portal-vue.esm.98f2e05b.js"),window.__aioseoDynamicImportPreload__("css/index.e8e7e8d0.css"),window.__aioseoDynamicImportPreload__("js/Slide.15a07930.js"),window.__aioseoDynamicImportPreload__("css/Card.1dc33bd1.css"),window.__aioseoDynamicImportPreload__("js/Row.830f6397.js"),window.__aioseoDynamicImportPreload__("css/Row.576b0c57.css"),window.__aioseoDynamicImportPreload__("js/Table.a4e25fec.js"),window.__aioseoDynamicImportPreload__("css/Table.14a882e0.css"),window.__aioseoDynamicImportPreload__("js/KeywordsGraph.b1ced50c.js"),window.__aioseoDynamicImportPreload__("js/Index.5c05423e.js"),window.__aioseoDynamicImportPreload__("css/Index.b175e011.css"),window.__aioseoDynamicImportPreload__("js/WpTable.e9a9eb34.js"),window.__aioseoDynamicImportPreload__("js/attachments.506687b9.js"),window.__aioseoDynamicImportPreload__("js/cleanForSlug.071f7a1a.js"),window.__aioseoDynamicImportPreload__("js/html.50126bda.js"),window.__aioseoDynamicImportPreload__("js/Index.ffa20ee1.js"),window.__aioseoDynamicImportPreload__("css/Index.736c3936.css"),window.__aioseoDynamicImportPreload__("js/SaveChanges.e40a9083.js"),window.__aioseoDynamicImportPreload__("css/KeywordsGraph.6b9db545.css"),window.__aioseoDynamicImportPreload__("js/PostTypes.9ab32454.js"),window.__aioseoDynamicImportPreload__("js/Table.8c51f443.js"),window.__aioseoDynamicImportPreload__("css/Table.7858fdb8.css"),window.__aioseoDynamicImportPreload__("js/RequiredPlans.389a71cb.js"),window.__aioseoDynamicImportPreload__("css/KeywordRankings.3e562ef8.css")],import.meta.url),"../views/Main.vue":()=>i(()=>import("./js/Main.ef12ff23.js"),[window.__aioseoDynamicImportPreload__("js/Main.ef12ff23.js"),window.__aioseoDynamicImportPreload__("js/vuex.esm.8fdeb4b6.js"),window.__aioseoDynamicImportPreload__("js/index.0395bbae.js"),window.__aioseoDynamicImportPreload__("js/_plugin-vue2_normalizer.61652a7c.js"),window.__aioseoDynamicImportPreload__("js/client.e62d6c37.js"),window.__aioseoDynamicImportPreload__("js/_commonjsHelpers.f84db168.js"),window.__aioseoDynamicImportPreload__("js/translations.c394afe3.js"),window.__aioseoDynamicImportPreload__("js/default-i18n.3a91e0e5.js"),window.__aioseoDynamicImportPreload__("js/Caret.6d7f2e24.js"),window.__aioseoDynamicImportPreload__("css/Caret.be535beb.css"),window.__aioseoDynamicImportPreload__("js/constants.8df4c584.js"),window.__aioseoDynamicImportPreload__("js/isArrayLikeObject.75d4eb51.js"),window.__aioseoDynamicImportPreload__("js/index.da77b995.js"),window.__aioseoDynamicImportPreload__("js/helpers.871dba46.js"),window.__aioseoDynamicImportPreload__("js/portal-vue.esm.98f2e05b.js"),window.__aioseoDynamicImportPreload__("css/index.e8e7e8d0.css"),window.__aioseoDynamicImportPreload__("js/Blur.f36c594d.js"),window.__aioseoDynamicImportPreload__("css/Blur.6e77dae4.css"),window.__aioseoDynamicImportPreload__("js/Index.f43bb78a.js"),window.__aioseoDynamicImportPreload__("js/params.597cd0f5.js"),window.__aioseoDynamicImportPreload__("js/WpTable.e9a9eb34.js"),window.__aioseoDynamicImportPreload__("js/attachments.506687b9.js"),window.__aioseoDynamicImportPreload__("js/cleanForSlug.071f7a1a.js"),window.__aioseoDynamicImportPreload__("js/html.50126bda.js"),window.__aioseoDynamicImportPreload__("js/Index.ffa20ee1.js"),window.__aioseoDynamicImportPreload__("css/Index.736c3936.css"),window.__aioseoDynamicImportPreload__("js/SaveChanges.e40a9083.js"),window.__aioseoDynamicImportPreload__("js/Header.0387fa6e.js"),window.__aioseoDynamicImportPreload__("js/LicenseKeyBar.ac0fda9d.js"),window.__aioseoDynamicImportPreload__("js/LogoGear.16108a75.js"),window.__aioseoDynamicImportPreload__("css/LicenseKeyBar.781b116c.css"),window.__aioseoDynamicImportPreload__("js/AnimatedNumber.932b583a.js"),window.__aioseoDynamicImportPreload__("js/Logo.8785cc9f.js"),window.__aioseoDynamicImportPreload__("css/Header.7a416ec3.css"),window.__aioseoDynamicImportPreload__("js/Support.85587a91.js"),window.__aioseoDynamicImportPreload__("js/Tabs.659e6500.js"),window.__aioseoDynamicImportPreload__("js/TruSeoScore.339d22e1.js"),window.__aioseoDynamicImportPreload__("js/Information.93f80cbf.js"),window.__aioseoDynamicImportPreload__("js/Slide.15a07930.js"),window.__aioseoDynamicImportPreload__("css/Tabs.fb196b90.css"),window.__aioseoDynamicImportPreload__("js/Exclamation.fd45a7b0.js"),window.__aioseoDynamicImportPreload__("js/Url.c71d5763.js"),window.__aioseoDynamicImportPreload__("js/Gear.184e0c65.js"),window.__aioseoDynamicImportPreload__("css/Index.1c387358.css"),window.__aioseoDynamicImportPreload__("css/main.fca70088.css"),window.__aioseoDynamicImportPreload__("js/Index.5c05423e.js"),window.__aioseoDynamicImportPreload__("js/Row.830f6397.js"),window.__aioseoDynamicImportPreload__("css/Row.576b0c57.css"),window.__aioseoDynamicImportPreload__("css/Index.b175e011.css"),window.__aioseoDynamicImportPreload__("js/Dashboard.d32219f6.js"),window.__aioseoDynamicImportPreload__("js/Card.0104a053.js"),window.__aioseoDynamicImportPreload__("js/Tooltip.68a8a92b.js"),window.__aioseoDynamicImportPreload__("css/Tooltip.c2302985.css"),window.__aioseoDynamicImportPreload__("css/Card.1dc33bd1.css"),window.__aioseoDynamicImportPreload__("js/Overview.3619b656.js"),window.__aioseoDynamicImportPreload__("js/DonutChartWithLegend.72361d7c.js"),window.__aioseoDynamicImportPreload__("css/DonutChartWithLegend.23d5f7fe.css"),window.__aioseoDynamicImportPreload__("css/Overview.63555ee7.css"),window.__aioseoDynamicImportPreload__("js/KeywordsGraph.b1ced50c.js"),window.__aioseoDynamicImportPreload__("js/Table.a4e25fec.js"),window.__aioseoDynamicImportPreload__("css/Table.14a882e0.css"),window.__aioseoDynamicImportPreload__("css/KeywordsGraph.6b9db545.css"),window.__aioseoDynamicImportPreload__("js/List.41118d8d.js"),window.__aioseoDynamicImportPreload__("js/Statistics.0134656c.js"),window.__aioseoDynamicImportPreload__("js/PostsTable.ad656834.js"),window.__aioseoDynamicImportPreload__("js/PostTypes.9ab32454.js"),window.__aioseoDynamicImportPreload__("js/ScoreButton.392b731e.js"),window.__aioseoDynamicImportPreload__("css/ScoreButton.30a33f11.css"),window.__aioseoDynamicImportPreload__("js/Table.8c51f443.js"),window.__aioseoDynamicImportPreload__("css/Table.7858fdb8.css"),window.__aioseoDynamicImportPreload__("js/Affiliate.e587b0fd.js"),window.__aioseoDynamicImportPreload__("js/Suggestion.5facc4fd.js"),window.__aioseoDynamicImportPreload__("css/PostsTable.9e7578fb.css"),window.__aioseoDynamicImportPreload__("js/RequiredPlans.389a71cb.js"),window.__aioseoDynamicImportPreload__("css/Dashboard.7388ac01.css"),window.__aioseoDynamicImportPreload__("js/KeywordRankings.efe115c1.js"),window.__aioseoDynamicImportPreload__("css/KeywordRankings.3e562ef8.css"),window.__aioseoDynamicImportPreload__("js/Index.b3d97c21.js"),window.__aioseoDynamicImportPreload__("css/Index.dcc96274.css"),window.__aioseoDynamicImportPreload__("js/Mobile.dbdc2be1.js"),window.__aioseoDynamicImportPreload__("js/Refresh.8f2b379b.js"),window.__aioseoDynamicImportPreload__("js/SettingsRow.edbb3005.js"),window.__aioseoDynamicImportPreload__("css/SettingsRow.64332056.css"),window.__aioseoDynamicImportPreload__("js/SeoStatistics.52cdc2d4.js"),window.__aioseoDynamicImportPreload__("css/SeoStatistics.29909a91.css"),window.__aioseoDynamicImportPreload__("css/Main.58c29099.css")],import.meta.url),"../views/SeoStatistics.vue":()=>i(()=>import("./js/SeoStatistics.52cdc2d4.js"),[window.__aioseoDynamicImportPreload__("js/SeoStatistics.52cdc2d4.js"),window.__aioseoDynamicImportPreload__("js/vuex.esm.8fdeb4b6.js"),window.__aioseoDynamicImportPreload__("js/Blur.f36c594d.js"),window.__aioseoDynamicImportPreload__("js/_plugin-vue2_normalizer.61652a7c.js"),window.__aioseoDynamicImportPreload__("css/Blur.6e77dae4.css"),window.__aioseoDynamicImportPreload__("js/Card.0104a053.js"),window.__aioseoDynamicImportPreload__("js/Tooltip.68a8a92b.js"),window.__aioseoDynamicImportPreload__("js/_commonjsHelpers.f84db168.js"),window.__aioseoDynamicImportPreload__("css/Tooltip.c2302985.css"),window.__aioseoDynamicImportPreload__("js/Caret.6d7f2e24.js"),window.__aioseoDynamicImportPreload__("css/Caret.be535beb.css"),window.__aioseoDynamicImportPreload__("js/index.0395bbae.js"),window.__aioseoDynamicImportPreload__("js/client.e62d6c37.js"),window.__aioseoDynamicImportPreload__("js/translations.c394afe3.js"),window.__aioseoDynamicImportPreload__("js/default-i18n.3a91e0e5.js"),window.__aioseoDynamicImportPreload__("js/constants.8df4c584.js"),window.__aioseoDynamicImportPreload__("js/isArrayLikeObject.75d4eb51.js"),window.__aioseoDynamicImportPreload__("js/index.da77b995.js"),window.__aioseoDynamicImportPreload__("js/helpers.871dba46.js"),window.__aioseoDynamicImportPreload__("js/portal-vue.esm.98f2e05b.js"),window.__aioseoDynamicImportPreload__("css/index.e8e7e8d0.css"),window.__aioseoDynamicImportPreload__("js/Slide.15a07930.js"),window.__aioseoDynamicImportPreload__("css/Card.1dc33bd1.css"),window.__aioseoDynamicImportPreload__("js/Table.a4e25fec.js"),window.__aioseoDynamicImportPreload__("css/Table.14a882e0.css"),window.__aioseoDynamicImportPreload__("js/Row.830f6397.js"),window.__aioseoDynamicImportPreload__("css/Row.576b0c57.css"),window.__aioseoDynamicImportPreload__("js/PostsTable.ad656834.js"),window.__aioseoDynamicImportPreload__("js/WpTable.e9a9eb34.js"),window.__aioseoDynamicImportPreload__("js/attachments.506687b9.js"),window.__aioseoDynamicImportPreload__("js/cleanForSlug.071f7a1a.js"),window.__aioseoDynamicImportPreload__("js/html.50126bda.js"),window.__aioseoDynamicImportPreload__("js/Index.ffa20ee1.js"),window.__aioseoDynamicImportPreload__("css/Index.736c3936.css"),window.__aioseoDynamicImportPreload__("js/SaveChanges.e40a9083.js"),window.__aioseoDynamicImportPreload__("js/PostTypes.9ab32454.js"),window.__aioseoDynamicImportPreload__("js/ScoreButton.392b731e.js"),window.__aioseoDynamicImportPreload__("css/ScoreButton.30a33f11.css"),window.__aioseoDynamicImportPreload__("js/Table.8c51f443.js"),window.__aioseoDynamicImportPreload__("css/Table.7858fdb8.css"),window.__aioseoDynamicImportPreload__("js/Index.5c05423e.js"),window.__aioseoDynamicImportPreload__("css/Index.b175e011.css"),window.__aioseoDynamicImportPreload__("js/Affiliate.e587b0fd.js"),window.__aioseoDynamicImportPreload__("js/Suggestion.5facc4fd.js"),window.__aioseoDynamicImportPreload__("css/PostsTable.9e7578fb.css"),window.__aioseoDynamicImportPreload__("js/RequiredPlans.389a71cb.js"),window.__aioseoDynamicImportPreload__("css/SeoStatistics.29909a91.css")],import.meta.url)}),`../views/${s}.vue`),L=[{path:"*",redirect:"/dashboard"},{path:"/dashboard",name:"dashboard",component:o("Main"),meta:{access:"aioseo_search_statistics_settings",name:a("Dashboard",n),hideSaveButton:!0}},{path:"/seo-statistics",name:"seo-statistics",component:o("Main"),meta:{access:"aioseo_search_statistics_settings",name:a("SEO Statistics",n),hideSaveButton:!0}},{path:"/keyword-rankings",name:"keyword-rankings",component:o("Main"),meta:{access:"aioseo_search_statistics_settings",name:a("Keyword Rankings",n),hideSaveButton:!0}},{path:"/settings",name:"settings",component:o("Main"),meta:{access:"aioseo_search_statistics_settings",name:a("Settings",n)}},{path:"/post-detail",name:"post-detail",component:o("Main"),meta:{access:"aioseo_search_statistics_settings",name:a("Post Detail",n),hideSaveButton:!0,licenseFeature:["search-statistics","post-detail"],middleware:[y],middlewareData:{routeName:"dashboard"}}}],u=g(L);w(m,u);new c({router:u,store:m,render:s=>s(F)}).$mount("#aioseo-app");
