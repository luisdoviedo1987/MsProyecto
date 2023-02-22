import{c as v}from"./WpTable.e9a9eb34.js";import{n as k}from"./_plugin-vue2_normalizer.61652a7c.js";import"./index.da77b995.js";import{S}from"./SaveChanges.e40a9083.js";import{a as C,c as O,m as x,b as N}from"./vuex.esm.8fdeb4b6.js";import{B as E}from"./Editor.e0f43476.js";import{B as P}from"./Radio.7965b35c.js";import{C as T,a as L}from"./index.0395bbae.js";import{C as A}from"./Card.0104a053.js";import{C as U}from"./Caret.6d7f2e24.js";import{C as J}from"./NetworkSiteSelector.588e4ae1.js";import{C as z}from"./SettingsRow.edbb3005.js";import{C as I}from"./Tooltip.68a8a92b.js";import{S as D}from"./Plus.6984df43.js";import{S as j}from"./External.4c957e9a.js";import"./helpers.871dba46.js";import"./attachments.506687b9.js";import"./cleanForSlug.071f7a1a.js";import"./isArrayLikeObject.75d4eb51.js";import"./constants.8df4c584.js";import"./default-i18n.3a91e0e5.js";import"./html.50126bda.js";import"./Index.ffa20ee1.js";import"./_commonjsHelpers.f84db168.js";import"./Checkmark.f26f6201.js";import"./client.e62d6c37.js";import"./translations.c394afe3.js";import"./portal-vue.esm.98f2e05b.js";import"./Slide.15a07930.js";import"./Row.830f6397.js";const $=e=>{const t=[];return Object.keys(e).forEach(s=>{const r=e[s];t.push(`User-agent: ${s}`),Object.keys(r).forEach(o=>{r[o].forEach(i=>{t.push(`${o.charAt(0).toUpperCase()+o.slice(1)}: ${i}`)})}),t.push("")}),t.join(`\r
`)},u=(e,t=!1)=>{const s={};return e.forEach(r=>{const o=JSON.parse(r);if(o.userAgent===null||o.directoryPath===null)return;s[o.userAgent]||(s[o.userAgent]={allow:[],disallow:[]});let n=!1;s[o.userAgent][o.rule].forEach(i=>{i===o.directoryPath&&(n=!0)}),!(n&&!t)&&s[o.userAgent][o.rule].push(o.directoryPath)}),s},p=(e,t,s=!1,r=!1)=>{for(const o in t){if(!o)continue;if(!(o in e)){e[o]=R(t[o],t[o],s,r);continue}R(e[o],t[o],s,r,!0);const n=[...e[o].allow,...t[o].allow];e[o].allow=s?n:y(n);const i=[...e[o].disallow,...t[o].disallow];e[o].disallow=s?i:y(i)}return e},R=(e,t,s,r,o=!1)=>{const n=(i,c,a,d,b,l=!1)=>{const f=i==="allow"?"disallow":"allow";return a[i].forEach((m,w)=>{const _=c[f].indexOf(m);if(_!==-1&&(b?c[f].splice(_,1):d||a[i].splice(w,1)),l){const g="^"+m.replace(/./g,"\\.").replace(/\//g,"\\/").replace(/\*/g,"(.*)").replace(/\?/,"\\?")+"$";(c.allow.some(h=>h&&h.match(g))||c.disallow.some(h=>h&&h.match(g)))&&(d||a[i].splice(w,1))}}),[c,a]};return[e,t]=n("disallow",e,t,s,r,o),[e,t]=n("allow",e,t,s,r,o),e},y=e=>{const t=e.concat();for(let s=0;s<t.length;++s)for(let r=s+1;r<t.length;++r)t[s]===t[r]&&t.splice(r--,1);return t};const B={userAgent:null,rule:"allow",directoryPath:null},F={components:{BaseEditor:E,BaseRadio:P,CoreAlert:T,CoreCard:A,CoreLoader:U,CoreNetworkSiteSelector:J,CoreSettingsRow:z,CoreTooltip:I,SvgCirclePlus:D,SvgExternal:j,SvgTrash:L},mixins:[v,S],data(){return{site:{},inputKey:0,importLoading:!1,deleteLoading:!1,siteLoading:!1,isNetwork:!1,errors:{},strings:{selectSite:this.$t.__("Select Site",this.$td),networkAlert:this.$t.__("These custom robots.txt rules will apply globally to your entire network. To make adjust the robots.txt rules for an individual site, please choose it in the list above.",this.$td),networkAlertLite:this.$t.__("These custom robots.txt rules will apply globally to your entire network. To make adjust the robots.txt rules for an individual site, please visit the dashboard for that site directly and upate the settings there.",this.$td),robotsEditor:this.$t.__("Robots.txt Editor",this.$td),description:this.$t.sprintf(this.$t.__("The robots.txt editor in %1$s allows you to set up a robots.txt file for your site that will override the default robots.txt file that WordPress creates. By creating a robots.txt file with %2$s you have greater control over the instructions you give web crawlers about your site.",this.$td),"AIOSEO","AIOSEO"),description2:this.$t.sprintf(this.$t.__("Just like WordPress, %1$s generates a dynamic file so there is no static file to be found on your server.  The content of the robots.txt file is stored in your WordPress database.",this.$td),"All in One SEO"),enableCustomRobots:this.$t.__("Enable Custom Robots.txt",this.$td),duplicateOrInvalid:this.$t.__("Duplicate or invalid entries have been detected! Please check your rules and try again.",this.$td),userAgent:this.$t.__("User Agent",this.$td),rule:this.$t.__("Rule",this.$td),directoryPath:this.$t.__("Directory Path",this.$td),allow:this.$t.__("Allow",this.$td),disallow:this.$t.__("Disallow",this.$td),addRule:this.$t.__("Add Rule",this.$td),deleteRule:this.$t.__("Delete Rule",this.$td),robotsPreview:this.$t.__("Robots.txt Preview:",this.$td),openRobotsTxt:this.$t.__("Open Robots.txt",this.$td),physicalRobotsFound:this.$t.sprintf(this.$t.__("%1$s has detected a physical robots.txt file in the root folder of your WordPress installation. We recommend removing this file as it could cause conflicts with WordPress' dynamically generated one. %2$s can import this file and delete it, or you can simply delete it.",this.$td),"AIOSEO","AIOSEO"),importAndDelete:this.$t.__("Import and Delete",this.$td),delete:this.$t.__("Delete",this.$td)}}},watch:{networkRobots:{deep:!0,async handler(){if(this.validateRules(),await this.$nextTick(),this.isNetwork){this.$set(this.networkOptions.tools.robots,"rules",this.networkRobots.rules);return}this.$set(this.options.tools.robots,"rules",this.networkRobots.rules)}},site(e,t){this.isNetwork=!1,e.blog_id==="network"&&(this.isNetwork=!0),t.blog_id&&this.processFetchSiteRobots()},"getOptions.enable"(){this.validateRules()}},computed:{...C(["options","networkRobots","networkOptions"]),...O(["getNetworkRobots","isUnlicensed"]),isValidRobotsSite(){return this.$aioseo.data.subdomain||this.isNetwork||this.isMainSite(this.site.domain,this.site.path)||!this.$aioseo.data.isNetworkAdmin&&this.$aioseo.data.mainSite},robotsTxtUrl(){return this.site.blog_id==="network"||!this.isValidRobotsSite||!this.site.domain?this.$aioseo.urls.robotsTxtUrl:`${this.$aioseo.data.isSsl?"https://":"http://"}${this.site.domain}${this.site.path}robots.txt`},getOptions(){return this.isNetwork?this.getNetworkRobots:this.options.tools.robots},parsedRules(){return this.networkRobots.rules.map(e=>JSON.parse(e))},robotsTxt(){const e=JSON.parse(JSON.stringify(this.$aioseo.data.isMultisite&&this.$aioseo.networkOptions.tools.robots.enable&&!this.isNetwork?u(this.getNetworkRobots.rules):{})),t=JSON.parse(JSON.stringify(this.$aioseo.data.robots.defaultRules)),s=`\r
`+this.$aioseo.data.robots.sitemapUrls.filter(r=>0<r.length).join(`\r
`);return this.getOptions.enable?$(p({...t},p({...e},u(this.networkRobots.rules)),!1,!0))+s:$(p({...t},{...e}))+s},sanitizedRobotsTxt(){return this.robotsTxt.replace(/(<([^>]+)>)/gi,"")},hasErrors(){return Object.keys(this.errors).length},subdirectoryAlert(){return this.$t.sprintf(this.$t.__("This site is running in a sub-directory of your main site located at %1$s. Your robots.txt file should only appear in the root directory of that site.",this.$td),'<a href="'+this.$aioseo.urls.mainSiteUrl+'" target="_blank"><strong>'+this.$aioseo.urls.mainSiteUrl+"</strong></a>")},missingRewriteRules(){const e=this.$t.__("It looks like you are missing the proper rewrite rules for the robots.txt file.",this.$td);let t="";return this.$aioseo.data.server.apache?t=this.$t.sprintf(this.$t.__("It appears that your server is running on Apache, so the fix should be as simple as checking the %1$scorrect .htaccess implementation on wordpress.org%2$s.",this.$td),'<a href="https://wordpress.org/support/article/htaccess/" target="_blank">',"</a>"):this.$aioseo.data.server.nginx&&(t=t=this.$t.sprintf(this.$t.__("It appears that your server is running on nginx, so the fix will most likely require adding the correct rewrite rules to our nginx configuration. %1$sCheck our documentation for more information%2$s.",this.$td),'<a href="'+this.$links.getDocUrl("robotsRewrite")+'" target="_blank">',"</a>")),e+" "+t}},methods:{...x(["processButtonAction","fetchSiteRobots"]),...N(["updateNetworkRobots"]),processFetchSiteRobots(){this.siteLoading=!0,this.fetchSiteRobots(this.site.blog_id).then(()=>{this.networkRobots.rules.length||this.addRow()}).then(()=>this.siteLoading=!1)},removeRow(e){this.$delete(this.networkRobots.rules,e),this.networkRobots.rules.length||this.addRow(),this.validateRules()},addRow(){this.isValidRobotsSite&&(this.networkRobots.rules.push(JSON.stringify({...B})),this.$nextTick(()=>{this.$refs.userAgent[this.networkRobots.rules.length-1].$el.querySelector(".robots-user-agent input").focus()}))},updateRule(e,t,s){const r=JSON.parse(this.networkRobots.rules[s]);r[e]=t,this.$set(this.networkRobots.rules,s,JSON.stringify(r)),e==="directoryPath"&&(r[e]=this.sanitizePath(t),this.inputKey++,this.$set(this.networkRobots.rules,s,JSON.stringify(r))),this.validateRules(),e==="rule"&&this.$nextTick(()=>this.$refs[t][s].$el.querySelector("input").focus())},sanitizePath(e){return e.slice(e.length-1)!=="*"&&!e.includes(".")&&(e=this.$links.trailingSlashIt(e)),e.charAt(0)!=="/"&&(e="/"+e),e.toLowerCase()},hasError(e){return this.errors[e]?"aioseo-error":""},validateRules(){if(this.errors={},!this.getOptions.enable)return;const e={},t=JSON.parse(JSON.stringify(this.$aioseo.data.isMultisite&&!this.isNetwork?u(this.getNetworkRobots.rules):{})),s=JSON.parse(JSON.stringify(this.$aioseo.data.robots.defaultRules)),r=p({...s},u(this.networkRobots.rules,!0),!0);Object.keys(r).forEach(i=>{const c=r[i];e[i]||(e[i]={allow:[],disallow:[]}),c.allow.forEach(a=>{if(e[i].allow.includes(a)){this.errors[i+"allow"+a]=!0;return}e[i].allow.push(a)}),c.disallow.forEach(a=>{if(e[i].disallow.includes(a)){this.errors[i+"disallow"+a]=!0;return}e[i].disallow.push(a)})});const o={},n=p({...t},u(this.networkRobots.rules,!0),!0);Object.keys(n).forEach(i=>{const c=n[i];o[i]||(o[i]={allow:[],disallow:[]}),c.allow.forEach(a=>{if(o[i].allow.includes(a)){this.errors[i+"allow"+a]=!0;return}else if(o[i].disallow.includes(a)){this.errors[i+"allow"+a]=!0,this.errors[i+"disallow"+a]=!0;return}const d="^"+a.replace(".","\\.").replace("/","\\/").replace("*","(.*)")+"$";if(o[i].allow.some(l=>l&&l.match(d))||o[i].disallow.some(l=>l&&l.match(d))){this.errors[i+"allow"+a]=!0,this.errors[i+"disallow"+a]=!0;return}o[i].allow.push(a)}),c.disallow.forEach(a=>{if(o[i].disallow.includes(a)){this.errors[i+"disallow"+a]=!0;return}else if(o[i].allow.includes(a)){this.errors[i+"allow"+a]=!0,this.errors[i+"disallow"+a]=!0;return}const d="^"+a.replace(".","\\.").replace("/","\\/").replace("*","(.*)")+"$";if(o[i].allow.some(l=>l&&l.match(d))||o[i].disallow.some(l=>l&&l.match(d))){this.errors[i+"allow"+a]=!0,this.errors[i+"disallow"+a]=!0;return}o[i].disallow.push(a)})})},importAndDeleteRobots(){this.importLoading=!0,this.processButtonAction("tools/import-robots-txt").then(()=>{window.location.reload()})},deleteRobots(){this.deleteLoading=!0,this.processButtonAction("tools/delete-robots-txt").then(()=>{window.location.reload()})},hideRobotsDetected(){this.getOptions.robotsDetected=!1,this.saveChanges()}},created(){this.$aioseo.data.isNetworkAdmin&&(this.isNetwork=!0)},mounted(){this.validateRules(),this.networkRobots.rules.length||this.addRow();const e=this.isNetwork?this.getNetworkRobots.rules:this.options.tools.robots.rules;e.length&&this.updateNetworkRobots(e)}};var M=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-tools-robots-editor"},[s("core-card",{attrs:{slug:"robotsEditor","header-text":t.strings.robotsEditor}},[t.$aioseo.data.isNetworkAdmin&&!t.isUnlicensed&&t.$license.hasCoreFeature("tools","network-tools-robots")?s("div",{staticClass:"aioseo-settings-row"},[s("div",{staticClass:"select-site"},[t._v(" "+t._s(t.strings.selectSite)+" ")]),s("core-network-site-selector",{attrs:{"show-network":""},on:{"selected-site":function(r){t.site=r}}})],1):t._e(),s("div",{staticClass:"robots-background"},[t.siteLoading?s("div",{staticClass:"loader-overlay"},[s("core-loader")],1):t._e(),s("div",{staticClass:"aioseo-settings-row aioseo-section-description"},[t.isNetwork?s("core-alert",{attrs:{type:"blue"}},[t._v(" "+t._s(t.isUnlicensed||!t.$license.hasCoreFeature("tools","network-tools-robots")?t.strings.networkAlertLite:t.strings.networkAlert)+" ")]):t._e(),t._v(" "+t._s(t.strings.description)+" "),s("br"),s("br"),t._v(" "+t._s(t.strings.description2)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"robotsEditor",!0))}})],1),t.$aioseo.data.robots.hasPhysicalRobots&&t.getOptions.robotsDetected?s("div",{staticClass:"aioseo-settings-row physical-robots"},[s("core-alert",{attrs:{type:"red","show-close":""},on:{"close-alert":t.hideRobotsDetected}},[t._v(" "+t._s(t.strings.physicalRobotsFound)+" "),s("div",{staticClass:"buttons"},[s("base-button",{attrs:{type:"blue",size:"medium",loading:t.importLoading},on:{click:t.importAndDeleteRobots}},[t._v(" "+t._s(t.strings.importAndDelete)+" ")]),s("base-button",{attrs:{type:"blue",size:"medium",loading:t.deleteLoading},on:{click:t.deleteRobots}},[t._v(" "+t._s(t.strings.delete)+" ")])],1)])],1):t._e(),t.$aioseo.data.robots.rewriteExists?t._e():s("div",{staticClass:"aioseo-settings-row rewrite-exists"},[s("core-alert",{attrs:{type:"red"},domProps:{innerHTML:t._s(t.missingRewriteRules)}})],1),s("core-settings-row",{attrs:{name:t.$constants.GLOBAL_STRINGS.preview,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[s("div",{staticClass:"aioseo-sitemap-preview"},[s("base-button",{attrs:{size:"medium",type:"blue",tag:"a",href:t.robotsTxtUrl,target:"_blank"}},[s("svg-external"),t._v(" "+t._s(t.strings.openRobotsTxt)+" ")],1)],1)]},proxy:!0}])}),t.isValidRobotsSite?s("core-settings-row",{attrs:{name:t.strings.enableCustomRobots},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-toggle",{model:{value:t.getOptions.enable,callback:function(r){t.$set(t.getOptions,"enable",r)},expression:"getOptions.enable"}})]},proxy:!0}],null,!1,3370567996)}):t._e(),t.isValidRobotsSite?t._e():s("core-alert",{attrs:{type:"blue"},domProps:{innerHTML:t._s(t.subdirectoryAlert)}}),t.isValidRobotsSite?s("div",{staticClass:"aioseo-settings-row"},[s("div",{staticClass:"settings-content"},[this.hasErrors?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.duplicateOrInvalid)+" ")]):t._e(),s("div",{staticClass:"robots-table"},[s("div",{staticClass:"robots-header"},[s("div",{staticClass:"robots-user-agent"},[t._v(t._s(t.strings.userAgent))]),s("div",{staticClass:"robots-rule"},[t._v(t._s(t.strings.rule))]),s("div",{staticClass:"robots-directory-path"},[t._v(t._s(t.strings.directoryPath))]),s("div",{staticClass:"robots-actions"})]),s("div",{staticClass:"robots-rows"},t._l(t.parsedRules,function(r,o){return s("div",{key:o,staticClass:"robots-row",class:{even:o%2===0}},[s("div",{staticClass:"robots-user-agent"},[s("base-input",{ref:"userAgent",refInFor:!0,class:t.hasError(r.userAgent+r.rule+r.directoryPath),attrs:{value:r.userAgent,size:"medium",placeholder:t.strings.userAgentPlaceholder,disabled:!t.getOptions.enable},on:{blur:function(n){return t.updateRule("userAgent",n,o)}}})],1),s("div",{staticClass:"robots-rule"},[s("base-radio",{ref:"allow",refInFor:!0,attrs:{name:`rule-${o}`,value:r.rule==="allow",disabled:!t.getOptions.enable,size:"medium",type:2},on:{input:function(n){return t.updateRule("rule","allow",o)}}},[t._v(" "+t._s(t.strings.allow)+" ")]),s("base-radio",{ref:"disallow",refInFor:!0,attrs:{name:`rule-${o}`,value:r.rule==="disallow",disabled:!t.getOptions.enable,size:"medium",type:2},on:{input:function(n){return t.updateRule("rule","disallow",o)}}},[t._v(" "+t._s(t.strings.disallow)+" ")])],1),s("div",{staticClass:"robots-directory-path"},[s("base-input",{key:t.inputKey,class:t.hasError(r.userAgent+r.rule+r.directoryPath),attrs:{value:r.directoryPath,size:"medium",placeholder:t.strings.directoryPathPlaceholder,disabled:!t.getOptions.enable},on:{blur:function(n){return t.updateRule("directoryPath",n,o)}}})],1),s("div",{staticClass:"robots-actions"},[t.getOptions.enable?s("core-tooltip",{attrs:{type:"action"},scopedSlots:t._u([{key:"tooltip",fn:function(){return[t._v(" "+t._s(t.strings.deleteRule)+" ")]},proxy:!0}],null,!0)},[s("svg-trash",{nativeOn:{click:function(n){return n.stopPropagation(),t.removeRow(o)}}})],1):t._e()],1)])}),0)]),s("base-button",{attrs:{type:"blue",size:"medium",disabled:!t.getOptions.enable},on:{click:t.addRow}},[s("svg-circle-plus"),t._v(" "+t._s(t.strings.addRule)+" ")],1)],1)]):t._e(),t.isValidRobotsSite?s("div",{staticClass:"aioseo-settings-row"},[s("div",{staticClass:"settings-name"},[s("div",{staticClass:"name"},[t._v(t._s(t.strings.robotsPreview))])]),s("div",{staticClass:"settings-content"},[s("base-editor",{attrs:{value:t.sanitizedRobotsTxt,"line-numbers":!0,"minimum-line-numbers":13,disabled:"","force-updates":"",monospace:""}})],1)]):t._e()],1)])],1)},V=[],W=k(F,M,V,!1,null,null,null,null);const vt=W.exports;export{vt as default};
