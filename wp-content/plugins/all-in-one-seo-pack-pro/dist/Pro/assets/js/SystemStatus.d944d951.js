import{m as n}from"./vuex.esm.8fdeb4b6.js";import{C as l}from"./Card.0104a053.js";import{G as m,a as c}from"./Row.830f6397.js";import{S as u}from"./Checkmark.f26f6201.js";import{e as d}from"./index.0395bbae.js";import{S as p}from"./Download.ef366516.js";import{T as _,a as f}from"./Row.2f03c6a0.js";import{n as h}from"./_plugin-vue2_normalizer.61652a7c.js";import"./Tooltip.68a8a92b.js";import"./_commonjsHelpers.f84db168.js";import"./Caret.6d7f2e24.js";import"./Slide.15a07930.js";import"./client.e62d6c37.js";import"./translations.c394afe3.js";import"./default-i18n.3a91e0e5.js";import"./constants.8df4c584.js";import"./isArrayLikeObject.75d4eb51.js";import"./index.da77b995.js";import"./helpers.871dba46.js";import"./portal-vue.esm.98f2e05b.js";const y={components:{CoreCard:l,GridColumn:m,GridRow:c,SvgCheckmark:u,SvgCopy:d,SvgDownload:p,TableColumn:_,TableRow:f},data(){return{copied:!1,emailError:null,emailAddress:null,sendingEmail:!1,strings:{systemStatusInfo:this.$t.__("System Status Info",this.$td),downloadSystemInfoFile:this.$t.__("Download System Info File",this.$td),copyToClipboard:this.$t.__("Copy to Clipboard",this.$td),emailDebugInformation:this.$t.__("Email Debug Information",this.$td),submit:this.$t.__("Submit",this.$td),wordPress:this.$t.__("WordPress",this.$td),serverInfo:this.$t.__("Server Info",this.$td),activeTheme:this.$t.__("Active Theme",this.$td),muPlugins:this.$t.__("Must-Use Plugins",this.$td),activePlugins:this.$t.__("Active Plugins",this.$td),inactivePlugins:this.$t.__("Inactive Plugins",this.$td),copied:this.$t.__("Copied!",this.$td)}}},computed:{copySystemStatusInfo(){return JSON.stringify(this.$aioseo.data.status)}},methods:{...n(["emailDebugInfo"]),onCopy(){this.copied=!0,setTimeout(()=>{this.copied=!1},2e3)},onError(){},downloadSystemStatusInfo(){const i=new Blob([JSON.stringify(this.$aioseo.data.status)],{type:"application/json"}),t=document.createElement("a");t.href=URL.createObjectURL(i),t.download=`aioseo-system-status-${this.$dateTime.now().toFormat("yyyy-MM-dd")}.json`,t.click(),URL.revokeObjectURL(t.href)},processEmailDebugInfo(){if(this.emailError=!1,!this.emailAddress||!/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(this.emailAddress)){this.emailError=!0;return}this.sendingEmail=!0,this.emailDebugInfo(this.emailAddress).then(()=>{this.emailAddress=null,this.sendingEmail=!1})}}};var g=function(){var t=this,s=t._self._c;return s("div",{staticClass:"aioseo-tools-system-status-info"},[s("core-card",{attrs:{slug:"systemStatusInfo","header-text":t.strings.systemStatusInfo}},[s("div",{staticClass:"actions"},[s("grid-row",[s("grid-column",{staticClass:"left",attrs:{sm:"6"}},[s("base-button",{attrs:{type:"blue",size:"medium"},on:{click:t.downloadSystemStatusInfo}},[s("svg-download"),t._v(" "+t._s(t.strings.downloadSystemInfoFile)+" ")],1),s("base-button",{directives:[{name:"clipboard",rawName:"v-clipboard:copy",value:t.copySystemStatusInfo,expression:"copySystemStatusInfo",arg:"copy"},{name:"clipboard",rawName:"v-clipboard:success",value:t.onCopy,expression:"onCopy",arg:"success"},{name:"clipboard",rawName:"v-clipboard:error",value:t.onError,expression:"onError",arg:"error"}],attrs:{type:"blue",size:"medium"}},[t.copied?t._e():[s("svg-copy"),t._v(" "+t._s(t.strings.copyToClipboard)+" ")],t.copied?[s("svg-checkmark"),t._v(" "+t._s(t.strings.copied)+" ")]:t._e()],2)],1),s("grid-column",{staticClass:"right",attrs:{sm:"6"}},[s("base-input",{class:{"aioseo-error":t.emailError},attrs:{size:"medium",placeholder:t.strings.emailDebugInformation},model:{value:t.emailAddress,callback:function(e){t.emailAddress=e},expression:"emailAddress"}}),s("base-button",{attrs:{type:"blue",size:"medium",loading:t.sendingEmail},on:{click:t.processEmailDebugInfo}},[t._v(" "+t._s(t.strings.submit)+" ")])],1)],1)],1),s("div",{staticClass:"aioseo-settings-row"},[t._l(t.$aioseo.data.status,function(e,r){return[e.results.length?s("div",{key:r,staticClass:"settings-group"},[s("div",{staticClass:"settings-name"},[s("div",{staticClass:"name"},[t._v(t._s(e.label))])]),s("div",{staticClass:"settings-content"},[s("div",{staticClass:"system-status-table"},t._l(e.results,function(o,a){return s("table-row",{key:a,class:{even:a%2===0}},[s("table-column",{staticClass:"system-status-header"},[t._v(" "+t._s(o.header)+" ")]),s("table-column",[t._v(" "+t._s(o.value)+" ")])],1)}),1)])]):t._e()]})],2)])],1)},v=[],b=h(y,g,v,!1,null,null,null,null);const G=b.exports;export{G as default};
