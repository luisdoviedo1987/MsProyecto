import{a as s}from"./vuex.esm.8fdeb4b6.js";import{B as r}from"./Textarea.ce149d81.js";import{C as l}from"./index.0395bbae.js";import{C as n}from"./Card.0104a053.js";import{C as c}from"./SettingsRow.edbb3005.js";import{n as a}from"./_plugin-vue2_normalizer.61652a7c.js";import"./client.e62d6c37.js";import"./_commonjsHelpers.f84db168.js";import"./translations.c394afe3.js";import"./default-i18n.3a91e0e5.js";import"./Caret.6d7f2e24.js";import"./constants.8df4c584.js";import"./isArrayLikeObject.75d4eb51.js";import"./index.da77b995.js";import"./helpers.871dba46.js";import"./portal-vue.esm.98f2e05b.js";import"./Tooltip.68a8a92b.js";import"./Slide.15a07930.js";import"./Row.830f6397.js";const i={components:{BaseTextarea:r,CoreAlert:l,CoreCard:n,CoreSettingsRow:c},data(){return{strings:{badBotBlocker:this.$t.__("Bad Bot Blocker",this.$td),blockBadBotsHttp:this.$t.__("Block Bad Bots using HTTP",this.$td),blockReferralSpamHttp:this.$t.__("Block Referral Spam using HTTP",this.$td),trackBlockedBots:this.$t.__("Track Blocked Bots",this.$td),useCustomBlocklists:this.$t.__("Use Custom Blocklists",this.$td),userAgentBlocklist:this.$t.__("User Agent Blocklist",this.$td),refererBlockList:this.$t.__("Referer Blocklist",this.$td),blockedBotsLog:this.$t.__("Blocked Bots Log",this.$td),logLocation:this.$t.sprintf(this.$t.__("The log for the blocked bots is located here: %1$s",this.$td),'<br><a href="'+this.$aioseo.urls.blockedBotsLogUrl+'" target="_blank">'+this.$aioseo.urls.blockedBotsLogUrl+"</a>")}}},computed:{...s(["options"])}};var p=function(){var o=this,t=o._self._c;return t("div",{staticClass:"aioseo-tools-bad-bot-blocker"},[t("core-card",{attrs:{slug:"badBotBlocker","header-text":o.strings.badBotBlocker}},[t("core-settings-row",{attrs:{name:o.strings.blockBadBotsHttp},scopedSlots:o._u([{key:"content",fn:function(){return[t("base-toggle",{model:{value:o.options.deprecated.tools.blocker.blockBots,callback:function(e){o.$set(o.options.deprecated.tools.blocker,"blockBots",e)},expression:"options.deprecated.tools.blocker.blockBots"}})]},proxy:!0}])}),t("core-settings-row",{attrs:{name:o.strings.blockReferralSpamHttp},scopedSlots:o._u([{key:"content",fn:function(){return[t("base-toggle",{model:{value:o.options.deprecated.tools.blocker.blockReferer,callback:function(e){o.$set(o.options.deprecated.tools.blocker,"blockReferer",e)},expression:"options.deprecated.tools.blocker.blockReferer"}})]},proxy:!0}])}),o.options.deprecated.tools.blocker.blockBots||o.options.deprecated.tools.blocker.blockReferer?t("core-settings-row",{attrs:{name:o.strings.useCustomBlocklists},scopedSlots:o._u([{key:"content",fn:function(){return[t("base-toggle",{model:{value:o.options.deprecated.tools.blocker.custom.enable,callback:function(e){o.$set(o.options.deprecated.tools.blocker.custom,"enable",e)},expression:"options.deprecated.tools.blocker.custom.enable"}})]},proxy:!0}],null,!1,2813344989)}):o._e(),o.options.deprecated.tools.blocker.blockBots&&o.options.deprecated.tools.blocker.custom.enable?t("core-settings-row",{attrs:{name:o.strings.userAgentBlocklist},scopedSlots:o._u([{key:"content",fn:function(){return[t("base-textarea",{attrs:{minHeight:200,maxHeight:200},model:{value:o.options.deprecated.tools.blocker.custom.bots,callback:function(e){o.$set(o.options.deprecated.tools.blocker.custom,"bots",e)},expression:"options.deprecated.tools.blocker.custom.bots"}})]},proxy:!0}],null,!1,2333962956)}):o._e(),o.options.deprecated.tools.blocker.blockReferer&&o.options.deprecated.tools.blocker.custom.enable?t("core-settings-row",{attrs:{name:o.strings.refererBlockList},scopedSlots:o._u([{key:"content",fn:function(){return[t("base-textarea",{attrs:{minHeight:200,maxHeight:200},model:{value:o.options.deprecated.tools.blocker.custom.referer,callback:function(e){o.$set(o.options.deprecated.tools.blocker.custom,"referer",e)},expression:"options.deprecated.tools.blocker.custom.referer"}})]},proxy:!0}],null,!1,3362070519)}):o._e(),o.options.deprecated.tools.blocker.blockBots||o.options.deprecated.tools.blocker.blockReferer?t("core-settings-row",{attrs:{name:o.strings.trackBlockedBots},scopedSlots:o._u([{key:"content",fn:function(){return[t("base-toggle",{model:{value:o.options.deprecated.tools.blocker.track,callback:function(e){o.$set(o.options.deprecated.tools.blocker,"track",e)},expression:"options.deprecated.tools.blocker.track"}}),t("core-alert",{attrs:{type:"blue"},domProps:{innerHTML:o._s(o.strings.logLocation)}})]},proxy:!0}],null,!1,3972286096)}):o._e()],1)],1)},d=[],u=a(i,p,d,!1,null,null,null,null);const U=u.exports;export{U as default};
