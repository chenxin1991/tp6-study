(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-8d35edc4"],{2934:function(e,t,n){"use strict";n.d(t,"e",(function(){return i})),n.d(t,"a",(function(){return o})),n.d(t,"c",(function(){return c})),n.d(t,"f",(function(){return s})),n.d(t,"d",(function(){return u})),n.d(t,"b",(function(){return l}));var r=n("b775"),a={role:"/common/getRoles",car:"/common/getCars",goods:"/common/getGoods",setting:"/common/getSetting",leader:"/common/getLeaders",category:"/common/getCategory"};function i(e){return Object(r["b"])({url:a.role,method:"get",params:e})}function o(e){return Object(r["b"])({url:a.car,method:"get",params:e})}function c(e){return Object(r["b"])({url:a.goods,method:"get",params:e})}function s(e){return Object(r["b"])({url:a.setting+"/"+e.id,method:"get",params:e})}function u(e){return Object(r["b"])({url:a.leader,method:"get",params:e})}function l(e){return Object(r["b"])({url:a.category,method:"get",params:e})}},"563d":function(e,t,n){},"6b31":function(e,t,n){"use strict";n.r(t);var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("a-card",{attrs:{bordered:!1}},[n("div",{staticClass:"table-page-search-wrapper"},[n("a-form",{attrs:{layout:"inline"}},[n("a-row",{attrs:{gutter:48}},[n("a-col",{attrs:{md:6,sm:24}},[n("a-form-item",{attrs:{label:"名称"}},[n("a-input",{nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.$refs.table.refresh(!0)}},model:{value:e.queryParam.name,callback:function(t){e.$set(e.queryParam,"name",t)},expression:"queryParam.name"}})],1)],1),n("a-col",{attrs:{md:6,sm:24}},[n("span",{staticClass:"table-page-search-submitButtons"},[n("a-button",{attrs:{type:"primary"},on:{click:function(t){return e.$refs.table.refresh(!0)}}},[e._v("查询")]),n("a-button",{staticStyle:{"margin-left":"8px"},on:{click:function(){return e.queryParam={}}}},[e._v("重置")])],1)])],1)],1)],1),n("div",{staticClass:"table-operator"},[n("a-button",{attrs:{type:"primary",icon:"plus"},on:{click:function(t){return e.handleAdd()}}},[e._v("新建")])],1),n("s-table",{ref:"table",attrs:{size:"default",rowKey:"id",columns:e.columns,data:e.loadData},scopedSlots:e._u([{key:"image",fn:function(t){return[t?n("img",{attrs:{src:t,width:"100"}}):e._e()]}},{key:"action",fn:function(t,r){return n("span",{},[[n("a",{on:{click:function(t){return e.handleEdit(r)}}},[e._v("编辑")]),n("a-divider",{attrs:{type:"vertical"}}),n("a",{on:{click:function(t){return e.handleDelete(r)}}},[e._v("删除")])]],2)}}])}),n("goods-form",{ref:"GoodsForm",attrs:{params:{category:e.category}},on:{ok:e.handleOk}})],1)},a=[],i=(n("b0c0"),n("2af9")),o=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("a-modal",{attrs:{title:e.config.title,width:640,visible:e.visible,confirmLoading:e.confirmLoading},on:{ok:e.handleSubmit,cancel:e.handleCancel}},[n("a-spin",{attrs:{spinning:e.confirmLoading}},[n("a-form",{attrs:{form:e.form,"label-col":e.labelCol,"wrapper-col":e.wrapperCol}},[n("a-form-item",{attrs:{label:"名称"}},[n("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["name",{rules:[{required:!0,message:"请输入名称！"}]}],expression:"['name', { rules: [{ required: true, message: '请输入名称！' }] }]"}]})],1),n("a-form-item",{attrs:{label:"单价（元）"}},[n("a-input-number",{directives:[{name:"decorator",rawName:"v-decorator",value:["price",{rules:[{required:!0,message:"请输入单价！"}]}],expression:"[\n            'price',\n            {\n              rules: [{ required: true, message: '请输入单价！' }],\n            },\n          ]"}],staticStyle:{width:"100%"},attrs:{min:0}})],1),n("a-form-item",{attrs:{label:"分类"}},[n("a-select",{directives:[{name:"decorator",rawName:"v-decorator",value:["cid",{rules:[{required:!0,message:"请选择分类！"}]}],expression:"['cid', { rules: [{ required: true, message: '请选择分类！' }] }]"}],attrs:{placeholder:"请选择"}},e._l(e.params.category,(function(t,r){return n("a-select-option",{key:r,attrs:{value:t.id}},[e._v(e._s(t.name))])})),1)],1),n("a-form-item",{attrs:{label:"上传图片"}},[n("a-upload",{attrs:{name:"avatar",action:"/index.php/admin/test/avatar","list-type":"picture-card","file-list":e.fileList},on:{preview:e.handlePreview,change:e.handleChange}},[e.fileList.length<8?n("div",[n("a-icon",{attrs:{type:"plus"}}),n("div",{staticClass:"ant-upload-text"},[e._v(" Upload ")])],1):e._e()]),n("a-modal",{attrs:{visible:e.previewVisible,footer:null},on:{cancel:e.handleCancel2}},[n("img",{staticStyle:{width:"100%"},attrs:{alt:"example",src:e.previewImage}})])],1)],1)],1)],1)},c=[];n("d3b7"),n("96cf");function s(e,t,n,r,a,i,o){try{var c=e[i](o),s=c.value}catch(u){return void n(u)}c.done?t(s):Promise.resolve(s).then(r,a)}function u(e){return function(){var t=this,n=arguments;return new Promise((function(r,a){var i=e.apply(t,n);function o(e){s(i,r,a,o,c,"next",e)}function c(e){s(i,r,a,o,c,"throw",e)}o(void 0)}))}}var l=n("88bc"),d=n.n(l),f=n("b775"),m={Goods:"/Goods"};function h(e){return Object(f["b"])({url:m.Goods,method:"post",data:e})}function p(e){return Object(f["b"])({url:m.Goods+"/"+e.id,method:"put",data:e})}function b(e){return Object(f["b"])({url:m.Goods+"/"+e.id,method:"delete",data:e})}function g(e){return Object(f["b"])({url:m.Goods,method:"get",params:e})}function v(e){return new Promise((function(t,n){var r=new FileReader;r.readAsDataURL(e),r.onload=function(){return t(r.result)},r.onerror=function(e){return n(e)}}))}var y={props:{params:{type:Object,required:!0}},data:function(){return{labelCol:{xs:{span:24},sm:{span:5}},wrapperCol:{xs:{span:24},sm:{span:16}},visible:!1,confirmLoading:!1,config:{},form:this.$form.createForm(this),previewVisible:!1,previewImage:"",fileList:[],imageList:[]}},methods:{add:function(){var e=this;this.config.action="add",this.config.title="新增物品",this.visible=!0,this.$nextTick((function(){e.form.resetFields(),e.fileList=[]}))},edit:function(e){var t=this;this.config.action="edit",this.config.title="编辑物品",this.config.id=e.id,""===e.image_url||null===e.image_url?this.fileList=[]:this.fileList=e.image_url,this.visible=!0,this.$nextTick((function(){t.form.setFieldsValue(d()(e,["name","price","cid"]))}))},handleCancel2:function(){this.previewVisible=!1},handlePreview:function(e){var t=this;return u(regeneratorRuntime.mark((function n(){return regeneratorRuntime.wrap((function(n){while(1)switch(n.prev=n.next){case 0:if(e.url||e.preview){n.next=4;break}return n.next=3,v(e.originFileObj);case 3:e.preview=n.sent;case 4:t.previewImage=e.url||e.preview,t.previewVisible=!0;case 6:case"end":return n.stop()}}),n)})))()},handleChange:function(e){var t=e.file,n=e.fileList,r=n.length;"done"===t.status&&(n[r-1]={uid:t.uid,name:t.name,url:t.response.url,status:"done"}),"error"===t.status&&(n[r-1]={uid:t.uid,name:t.name,status:"error"}),this.fileList=n},handleSubmit:function(){var e=this,t=this.form.validateFields;this.confirmLoading=!0;var n=this.$message;t((function(t,r){r.image_url=e.fileList,t?e.confirmLoading=!1:"add"===e.config.action?h(r).then((function(t){n.success("添加成功"),e.visible=!1,e.confirmLoading=!1,e.$emit("ok",r)})).catch((function(e){n.error("load user err: ".concat(e.message))})):"edit"===e.config.action&&(r.id=e.config.id,p(r).then((function(t){n.success("修改成功"),e.visible=!1,e.confirmLoading=!1,e.$emit("ok",r)})).catch((function(e){n.error("load user err: ".concat(e.message))})))}))},handleCancel:function(){this.visible=!1}}},w=y,j=(n("9f9b"),n("2877")),k=Object(j["a"])(w,o,c,!1,null,"35c854b0",null),x=k.exports,O=n("2934"),_={name:"BasicGoods",components:{STable:i["r"],GoodsForm:x},data:function(){var e=this;return{queryParam:{},columns:[{title:"名称",dataIndex:"name"},{title:"单价（元）",dataIndex:"price"},{title:"物品图片",dataIndex:"image_url",scopedSlots:{customRender:"image"}},{title:"分类",dataIndex:"category"},{title:"操作",dataIndex:"action",width:"150px",scopedSlots:{customRender:"action"}}],category:[],loadData:function(t){return g(Object.assign(t,e.queryParam)).then((function(e){return e.result}))}}},created:function(){var e=this;Object(O["b"])({t:new Date}).then((function(t){e.category=t}))},methods:{handleAdd:function(){this.$refs.GoodsForm.add()},handleEdit:function(e){this.$refs.GoodsForm.edit(e)},handleOk:function(){this.$refs.table.refresh()},handleDelete:function(e){var t=this;this.$confirm({title:"警告",content:"真的要删除 ".concat(e.name," 吗?"),okText:"删除",okType:"danger",cancelText:"取消",onOk:function(){b(e).then((function(e){t.$message.success("删除成功"),t.$refs.table.refresh()})).catch((function(e){t.$message.error("load user err: ".concat(e.message))}))}})}}},L=_,C=Object(j["a"])(L,r,a,!1,null,null,null);t["default"]=C.exports},"88bc":function(e,t,n){(function(t){var n=1/0,r=9007199254740991,a="[object Arguments]",i="[object Function]",o="[object GeneratorFunction]",c="[object Symbol]",s="object"==typeof t&&t&&t.Object===Object&&t,u="object"==typeof self&&self&&self.Object===Object&&self,l=s||u||Function("return this")();function d(e,t,n){switch(n.length){case 0:return e.call(t);case 1:return e.call(t,n[0]);case 2:return e.call(t,n[0],n[1]);case 3:return e.call(t,n[0],n[1],n[2])}return e.apply(t,n)}function f(e,t){var n=-1,r=e?e.length:0,a=Array(r);while(++n<r)a[n]=t(e[n],n,e);return a}function m(e,t){var n=-1,r=t.length,a=e.length;while(++n<r)e[a+n]=t[n];return e}var h=Object.prototype,p=h.hasOwnProperty,b=h.toString,g=l.Symbol,v=h.propertyIsEnumerable,y=g?g.isConcatSpreadable:void 0,w=Math.max;function j(e,t,n,r,a){var i=-1,o=e.length;n||(n=_),a||(a=[]);while(++i<o){var c=e[i];t>0&&n(c)?t>1?j(c,t-1,n,r,a):m(a,c):r||(a[a.length]=c)}return a}function k(e,t){return e=Object(e),x(e,t,(function(t,n){return n in e}))}function x(e,t,n){var r=-1,a=t.length,i={};while(++r<a){var o=t[r],c=e[o];n(c,o)&&(i[o]=c)}return i}function O(e,t){return t=w(void 0===t?e.length-1:t,0),function(){var n=arguments,r=-1,a=w(n.length-t,0),i=Array(a);while(++r<a)i[r]=n[t+r];r=-1;var o=Array(t+1);while(++r<t)o[r]=n[r];return o[t]=i,d(e,this,o)}}function _(e){return $(e)||C(e)||!!(y&&e&&e[y])}function L(e){if("string"==typeof e||I(e))return e;var t=e+"";return"0"==t&&1/e==-n?"-0":t}function C(e){return q(e)&&p.call(e,"callee")&&(!v.call(e,"callee")||b.call(e)==a)}var $=Array.isArray;function S(e){return null!=e&&G(e.length)&&!F(e)}function q(e){return A(e)&&S(e)}function F(e){var t=P(e)?b.call(e):"";return t==i||t==o}function G(e){return"number"==typeof e&&e>-1&&e%1==0&&e<=r}function P(e){var t=typeof e;return!!e&&("object"==t||"function"==t)}function A(e){return!!e&&"object"==typeof e}function I(e){return"symbol"==typeof e||A(e)&&b.call(e)==c}var R=O((function(e,t){return null==e?{}:k(e,f(j(t,1),L))}));e.exports=R}).call(this,n("c8ba"))},"9f9b":function(e,t,n){"use strict";var r=n("563d"),a=n.n(r);a.a}}]);