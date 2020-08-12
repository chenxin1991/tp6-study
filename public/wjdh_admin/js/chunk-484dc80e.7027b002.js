(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-484dc80e"],{2934:function(e,t,r){"use strict";r.d(t,"e",(function(){return o})),r.d(t,"a",(function(){return i})),r.d(t,"c",(function(){return s})),r.d(t,"f",(function(){return c})),r.d(t,"d",(function(){return u})),r.d(t,"b",(function(){return l}));var n=r("b775"),a={role:"/common/getRoles",car:"/common/getCars",goods:"/common/getGoods",setting:"/common/getSetting",leader:"/common/getLeaders",category:"/common/getCategory"};function o(e){return Object(n["b"])({url:a.role,method:"get",params:e})}function i(e){return Object(n["b"])({url:a.car,method:"get",params:e})}function s(e){return Object(n["b"])({url:a.goods,method:"get",params:e})}function c(e){return Object(n["b"])({url:a.setting+"/"+e.id,method:"get",params:e})}function u(e){return Object(n["b"])({url:a.leader,method:"get",params:e})}function l(e){return Object(n["b"])({url:a.category,method:"get",params:e})}},3218:function(e,t,r){"use strict";r.r(t);var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("a-card",{attrs:{bordered:!1}},[r("div",{staticClass:"table-page-search-wrapper"},[r("a-form",{attrs:{layout:"inline"}},[r("a-row",{attrs:{gutter:48}},[r("a-col",{attrs:{md:6,sm:24}},[r("a-form-item",{attrs:{label:"用户名/姓名"}},[r("a-input",{nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.$refs.table.refresh(!0)}},model:{value:e.queryParam.name,callback:function(t){e.$set(e.queryParam,"name",t)},expression:"queryParam.name"}})],1)],1),r("a-col",{attrs:{md:6,sm:24}},[r("a-form-item",{attrs:{label:"角色"}},[r("a-select",{attrs:{placeholder:"请选择"},model:{value:e.queryParam.role_id,callback:function(t){e.$set(e.queryParam,"role_id",t)},expression:"queryParam.role_id"}},e._l(e.roles,(function(t,n){return r("a-select-option",{key:n,attrs:{value:t.id}},[e._v(e._s(t.name))])})),1)],1)],1),r("a-col",{attrs:{md:6,sm:24}},[r("a-form-item",{attrs:{label:"状态"}},[r("a-select",{attrs:{placeholder:"请选择"},model:{value:e.queryParam.status,callback:function(t){e.$set(e.queryParam,"status",t)},expression:"queryParam.status"}},[r("a-select-option",{attrs:{value:"0"}},[e._v("启用")]),r("a-select-option",{attrs:{value:"1"}},[e._v("禁用")])],1)],1)],1),r("a-col",{attrs:{md:6,sm:24}},[r("span",{staticClass:"table-page-search-submitButtons"},[r("a-button",{attrs:{type:"primary"},on:{click:function(t){return e.$refs.table.refresh(!0)}}},[e._v("查询")]),r("a-button",{staticStyle:{"margin-left":"8px"},on:{click:function(){return e.queryParam={}}}},[e._v("重置")])],1)])],1)],1)],1),r("div",{staticClass:"table-operator"},[r("a-button",{attrs:{type:"primary",icon:"plus"},on:{click:function(t){return e.handleAdd()}}},[e._v("新建")])],1),r("s-table",{ref:"table",attrs:{size:"default",rowKey:"id",columns:e.columns,data:e.loadData},scopedSlots:e._u([{key:"status",fn:function(t){return r("span",{},["正常"===t?r("a-badge",{attrs:{status:"success",text:t}}):e._e(),"禁用"===t?r("a-badge",{attrs:{status:"error",text:t}}):e._e()],1)}},{key:"action",fn:function(t,n){return r("span",{},[[r("a",{on:{click:function(t){return e.handleEdit(n)}}},[e._v("编辑")]),r("a-divider",{attrs:{type:"vertical"}}),r("a",{on:{click:function(t){return e.handleDisable(n)}}},[e._v("禁用")])]],2)}}])}),r("user-form",{ref:"userForm",attrs:{params:{roles:e.roles}},on:{ok:e.handleOk}})],1)},a=[],o=r("2af9"),i=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("a-modal",{attrs:{title:e.config.title,width:640,visible:e.visible,confirmLoading:e.confirmLoading},on:{ok:e.handleSubmit,cancel:e.handleCancel}},[r("a-spin",{attrs:{spinning:e.confirmLoading}},[r("a-form",{attrs:{form:e.form,"label-col":e.labelCol,"wrapper-col":e.wrapperCol}},[r("a-form-item",{attrs:{label:"用户名"}},[r("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["username",{rules:[{required:!0,message:"请输入用户名！"}]}],expression:"['username', { rules: [{ required: true, message: '请输入用户名！' }] }]"}]})],1),r("a-form-item",{attrs:{label:"真实姓名"}},[r("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["name",{rules:[{required:!0,message:"请输入真实姓名！"}]}],expression:"['name', { rules: [{ required: true, message: '请输入真实姓名！' }] }]"}]})],1),r("a-form-item",{attrs:{label:"角色"}},[r("a-select",{directives:[{name:"decorator",rawName:"v-decorator",value:["role_id",{rules:[{required:!0,message:"请选择角色！"}]}],expression:"['role_id', { rules: [{ required: true, message: '请选择角色！' }] }]"}],attrs:{placeholder:"请选择"}},e._l(e.params.roles,(function(t,n){return r("a-select-option",{key:n,attrs:{value:t.id}},[e._v(e._s(t.name))])})),1)],1)],1)],1)],1)},s=[],c=r("88bc"),u=r.n(c),l=r("b775"),d={user:"/systemUser"};function m(e){return Object(l["b"])({url:d.user,method:"post",data:e})}function f(e){return Object(l["b"])({url:d.user+"/"+e.id,method:"put",data:e})}function b(e){return Object(l["b"])({url:d.user,method:"get",params:e})}var h={props:{params:{type:Object,required:!0}},data:function(){return{labelCol:{xs:{span:24},sm:{span:5}},wrapperCol:{xs:{span:24},sm:{span:16}},visible:!1,confirmLoading:!1,config:{},form:this.$form.createForm(this)}},methods:{add:function(){var e=this;this.config.action="add",this.config.title="新增用户",this.visible=!0,this.$nextTick((function(){e.form.resetFields()}))},edit:function(e){var t=this;this.config.action="edit",this.config.title="编辑用户",this.config.id=e.id,this.visible=!0,this.$nextTick((function(){t.form.setFieldsValue(u()(e,["username","name","role_id"]))}))},handleSubmit:function(){var e=this,t=this.form.validateFields;this.confirmLoading=!0;var r=this.$message;t((function(t,n){t?e.confirmLoading=!1:"add"===e.config.action?m(n).then((function(t){r.success("添加成功"),e.visible=!1,e.confirmLoading=!1,e.$emit("ok",n)})).catch((function(e){r.error("load user err: ".concat(e.message))})):"edit"===e.config.action&&(n.id=e.config.id,f(n).then((function(t){r.success("修改成功"),e.visible=!1,e.confirmLoading=!1,e.$emit("ok",n)})).catch((function(e){r.error("load user err: ".concat(e.message))})))}))},handleCancel:function(){this.visible=!1}}},p=h,g=r("2877"),v=Object(g["a"])(p,i,s,!1,null,null,null),y=v.exports,j=r("2934"),k={name:"SettingUser",components:{STable:o["r"],UserForm:y},data:function(){var e=this;return{queryParam:{},columns:[{title:"用户名",dataIndex:"username"},{title:"姓名",dataIndex:"name"},{title:"角色",dataIndex:"rolename"},{title:"状态",dataIndex:"status",scopedSlots:{customRender:"status"}},{title:"创建时间",dataIndex:"create_time"},{title:"操作",dataIndex:"action",width:"150px",scopedSlots:{customRender:"action"}}],roles:[],loadData:function(t){return b(Object.assign(t,e.queryParam)).then((function(e){return e.result}))}}},created:function(){var e=this;Object(j["e"])({t:new Date}).then((function(t){e.roles=t}))},methods:{handleAdd:function(){this.$refs.userForm.add()},handleEdit:function(e){this.$refs.userForm.edit(e)},handleOk:function(){this.$refs.table.refresh()},handleDisable:function(e){}}},_=k,w=Object(g["a"])(_,n,a,!1,null,null,null);t["default"]=w.exports},"88bc":function(e,t,r){(function(t){var r=1/0,n=9007199254740991,a="[object Arguments]",o="[object Function]",i="[object GeneratorFunction]",s="[object Symbol]",c="object"==typeof t&&t&&t.Object===Object&&t,u="object"==typeof self&&self&&self.Object===Object&&self,l=c||u||Function("return this")();function d(e,t,r){switch(r.length){case 0:return e.call(t);case 1:return e.call(t,r[0]);case 2:return e.call(t,r[0],r[1]);case 3:return e.call(t,r[0],r[1],r[2])}return e.apply(t,r)}function m(e,t){var r=-1,n=e?e.length:0,a=Array(n);while(++r<n)a[r]=t(e[r],r,e);return a}function f(e,t){var r=-1,n=t.length,a=e.length;while(++r<n)e[a+r]=t[r];return e}var b=Object.prototype,h=b.hasOwnProperty,p=b.toString,g=l.Symbol,v=b.propertyIsEnumerable,y=g?g.isConcatSpreadable:void 0,j=Math.max;function k(e,t,r,n,a){var o=-1,i=e.length;r||(r=O),a||(a=[]);while(++o<i){var s=e[o];t>0&&r(s)?t>1?k(s,t-1,r,n,a):f(a,s):n||(a[a.length]=s)}return a}function _(e,t){return e=Object(e),w(e,t,(function(t,r){return r in e}))}function w(e,t,r){var n=-1,a=t.length,o={};while(++n<a){var i=t[n],s=e[i];r(s,i)&&(o[i]=s)}return o}function x(e,t){return t=j(void 0===t?e.length-1:t,0),function(){var r=arguments,n=-1,a=j(r.length-t,0),o=Array(a);while(++n<a)o[n]=r[t+n];n=-1;var i=Array(t+1);while(++n<t)i[n]=r[n];return i[t]=o,d(e,this,i)}}function O(e){return C(e)||$(e)||!!(y&&e&&e[y])}function q(e){if("string"==typeof e||E(e))return e;var t=e+"";return"0"==t&&1/e==-r?"-0":t}function $(e){return S(e)&&h.call(e,"callee")&&(!v.call(e,"callee")||p.call(e)==a)}var C=Array.isArray;function P(e){return null!=e&&L(e.length)&&!F(e)}function S(e){return I(e)&&P(e)}function F(e){var t=A(e)?p.call(e):"";return t==o||t==i}function L(e){return"number"==typeof e&&e>-1&&e%1==0&&e<=n}function A(e){var t=typeof e;return!!e&&("object"==t||"function"==t)}function I(e){return!!e&&"object"==typeof e}function E(e){return"symbol"==typeof e||I(e)&&p.call(e)==s}var D=x((function(e,t){return null==e?{}:_(e,m(k(t,1),q))}));e.exports=D}).call(this,r("c8ba"))}}]);