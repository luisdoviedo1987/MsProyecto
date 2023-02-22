import{a as n}from"./WpTable.e9a9eb34.js";import{n as l}from"./_plugin-vue2_normalizer.61652a7c.js";import"./index.da77b995.js";import"./SaveChanges.e40a9083.js";import{b as p,m as c}from"./vuex.esm.8fdeb4b6.js";import{B as d}from"./HighlightToggle.62b97732.js";import{G as m,a as u}from"./Row.830f6397.js";import{W as _,a as g,b as h}from"./Header.f5e32717.js";import{W as v,a as f}from"./Steps.d3d209b0.js";import"./helpers.871dba46.js";import"./attachments.506687b9.js";import"./cleanForSlug.071f7a1a.js";import"./isArrayLikeObject.75d4eb51.js";import"./constants.8df4c584.js";import"./default-i18n.3a91e0e5.js";import"./Caret.6d7f2e24.js";import"./_commonjsHelpers.f84db168.js";import"./html.50126bda.js";import"./Index.ffa20ee1.js";import"./Checkbox.60ba2f56.js";import"./Checkmark.f26f6201.js";import"./Radio.7965b35c.js";import"./Logo.8785cc9f.js";const o=""+window.__aioseoDynamicImportPreload__("images/yoast-logo-small.d61ba0ec.png"),y=""+window.__aioseoDynamicImportPreload__("images/rank-math-seo-logo-small.ca2c09ed.png"),w=""+window.__aioseoDynamicImportPreload__("svg/seopress-free-logo-small.ac91e892.svg"),I=""+window.__aioseoDynamicImportPreload__("svg/seopress-pro-logo-small.6e7e5cab.svg");const k={components:{BaseHighlightToggle:d,GridColumn:m,GridRow:u,WizardBody:_,WizardCloseAndExit:v,WizardContainer:g,WizardHeader:h,WizardSteps:f},mixins:[n],data(){return{loading:!1,stage:"import",strings:{importData:this.$t.__("Import data from your current plugins",this.$td),weHaveDetected:this.$t.sprintf(this.$t.__("We have detected other SEO plugins installed on your website. Select which plugins you would like to import data to %1$s.",this.$td),"AIOSEO"),importDataAndContinue:this.$t.__("Import Data and Continue",this.$td)},pluginImages:{"yoast-seo":this.$getAssetUrl(o),"yoast-seo-premium":this.$getAssetUrl(o),"rank-math-seo":this.$getAssetUrl(y),seopress:this.$getAssetUrl(w),"seopress-pro":this.$getAssetUrl(I)},selected:[]}},watch:{selected(i){this.updateImporters(i.map(t=>t.slug))}},computed:{getPlugins(){return this.$aioseo.importers.filter(i=>i.canImport)}},methods:{...p("wizard",["updateImporters"]),...c("wizard",["saveWizard"]),updateValue(i,t){if(i){this.selected.push(t);return}const s=this.selected.findIndex(e=>e.value===t.value);s!==-1&&this.$delete(this.selected,s)},getValue(i){return this.selected.includes(i)},isActive(i){return this.selected.findIndex(s=>s.slug===i.slug)!==-1},saveAndContinue(){this.loading=!0,this.saveWizard("importers").then(()=>{this.$router.push(this.getNextLink)})},skipStep(){this.saveWizard(),this.$router.push(this.getNextLink)}}};var x=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-wizard-import"},[s("wizard-header"),s("wizard-container",[s("wizard-body",{scopedSlots:t._u([{key:"footer",fn:function(){return[s("div",{staticClass:"go-back"},[s("router-link",{staticClass:"no-underline",attrs:{to:t.getPrevLink}},[t._v("←")]),t._v("   "),s("router-link",{attrs:{to:t.getPrevLink}},[t._v(t._s(t.strings.goBack))])],1),s("div",{staticClass:"spacer"}),s("base-button",{attrs:{type:"gray"},on:{click:t.skipStep}},[t._v(t._s(t.strings.skipThisStep))]),s("base-button",{attrs:{type:"blue",loading:t.loading},on:{click:t.saveAndContinue}},[t._v(t._s(t.strings.importDataAndContinue)+" →")])]},proxy:!0}])},[s("wizard-steps"),s("div",{staticClass:"header"},[t._v(" "+t._s(t.strings.importData)+" ")]),s("div",{staticClass:"description"},[t._v(t._s(t.strings.weHaveDetected))]),s("div",{staticClass:"plugins"},[s("grid-row",t._l(t.getPlugins,function(e,r){return s("grid-column",{key:r,attrs:{md:"6"}},[s("base-highlight-toggle",{attrs:{type:"checkbox",round:"",active:t.isActive(e),name:e.name,value:t.getValue(e)},on:{input:a=>t.updateValue(a,e)}},[t.pluginImages[e.slug]?s("img",{staticClass:"icon",class:e.slug,attrs:{alt:e.name+" Plugin Icon",src:t.pluginImages[e.slug]}}):t._e(),t.pluginImages[e.slug]?t._e():s("span",{staticClass:"icon dashicons dashicons-admin-plugins"}),t._v(" "+t._s(e.name)+" ")])],1)}),1)],1)],1),s("wizard-close-and-exit")],1)],1)},z=[],C=l(k,x,z,!1,null,null,null,null);const K=C.exports;export{K as default};
