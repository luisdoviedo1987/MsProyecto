import{a as r,m as l}from"./vuex.esm.8fdeb4b6.js";import"./WpTable.e9a9eb34.js";import{n as o}from"./_plugin-vue2_normalizer.61652a7c.js";import{U as u}from"./Image.ac903a77.js";import"./SaveChanges.e40a9083.js";import{D as n}from"./Map.58a6871a.js";import{B as c}from"./Img.137dcbf1.js";import{C as i}from"./SettingsRow.edbb3005.js";import{S as m}from"./Plus.6984df43.js";const p={components:{BaseImg:c,CoreSettingsRow:i,SvgCirclePlus:m},mixins:[u,n],data(){return{strings:{customMarker:this.$t.__("Custom Marker",this.$td),uploadOrSelectImage:this.$t.__("Upload or Select Image",this.$td),pasteYourImageUrl:this.$t.__("Paste your image URL or select a new image",this.$td),minimumSize:this.$t.sprintf(this.$t.__("%1$sThe custom marker should be: 100x100 px.%2$s If the image exceeds those dimensions it could (partially) cover the info popup.",this.$td),"<strong>","</strong>"),remove:this.$t.__("Remove",this.$td)}}},computed:{...r(["currentPost","options"])},methods:{...l(["savePostState"]),setImageUrl(s){if(this.$root._data.screenContext!=="metabox"){this.options.localBusiness.maps.customMarker=s;return}this.currentPost.local_seo.maps.customMarker=s,this.savePostState()}}};var _=function(){var t=this,e=t._self._c;return e("core-settings-row",{attrs:{name:t.strings.customMarker,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("div",{staticClass:"image-upload"},[e("base-input",{attrs:{size:"medium",placeholder:t.strings.pasteYourImageUrl},model:{value:t.getDataObject().customMarker,callback:function(a){t.$set(t.getDataObject(),"customMarker",a)},expression:"getDataObject().customMarker"}}),e("base-button",{staticClass:"insert-image",attrs:{size:"medium",type:"black"},on:{click:function(a){return t.openUploadModal("customMarkerImage",t.setImageUrl)}}},[e("svg-circle-plus"),t._v(" "+t._s(t.strings.uploadOrSelectImage)+" ")],1),e("base-button",{staticClass:"remove-image",attrs:{size:"medium",type:"gray"},on:{click:function(a){t.getDataObject().customMarker=null}}},[t._v(" "+t._s(t.strings.remove)+" ")])],1),e("div",{staticClass:"aioseo-description",domProps:{innerHTML:t._s(t.strings.minimumSize)}}),e("base-img",{attrs:{src:t.getDataObject().customMarker}})]},proxy:!0}])})},d=[],f=o(p,_,d,!1,null,"fe9aa551",null,null);const D=f.exports,g={components:{CoreSettingsRow:i},mixins:[n],data(){return{strings:{defaultMapStyle:this.$t.__("Default Map Style",this.$td)},defaultMapStyles:[{label:this.$t.__("Roadmap",this.$td),value:"roadmap"},{label:this.$t.__("Hybrid",this.$td),value:"hybrid"},{label:this.$t.__("Satellite",this.$td),value:"satellite"},{label:this.$t.__("Terrain",this.$td),value:"terrain"}]}},computed:{...r(["options"])},methods:{getValue(){return this.getDataObject().mapOptions.mapTypeId?this.defaultMapStyles.find(s=>s.value===this.getDataObject().mapOptions.mapTypeId):this.defaultMapStyles.find(s=>s.value===this.options.localBusiness.maps.mapOptions.mapTypeId)}}};var h=function(){var t=this,e=t._self._c;return e("core-settings-row",{attrs:{name:t.strings.defaultMapStyle,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("base-select",{attrs:{value:t.getValue(),options:t.defaultMapStyles},on:{input:a=>t.getDataObject().mapOptions.mapTypeId=a.value}})]},proxy:!0}])})},v=[],y=o(g,h,v,!1,null,null,null,null);const U=y.exports;export{D as L,U as a};
