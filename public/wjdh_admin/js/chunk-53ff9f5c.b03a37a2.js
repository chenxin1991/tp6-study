(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-53ff9f5c"],{"258b":function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("a-card",{attrs:{bordered:!1}},[a("div",{staticClass:"table-page-search-wrapper"},[a("a-form",{attrs:{layout:"inline"}},[a("a-row",{attrs:{gutter:48}},[a("a-col",{attrs:{md:6,sm:24}},[a("a-form-item",{attrs:{label:"队长"}},[a("a-input",{nativeOn:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.$refs.table.refresh(!0)}},model:{value:t.queryParam.name,callback:function(e){t.$set(t.queryParam,"name",e)},expression:"queryParam.name"}})],1)],1),a("a-col",{attrs:{md:6,sm:24}},[a("a-form-item",{attrs:{label:"下单日期"}},[a("a-range-picker",{on:{change:t.onChange1}})],1)],1),a("a-col",{attrs:{md:6,sm:24}},[a("span",{staticClass:"table-page-search-submitButtons"},[a("a-button",{attrs:{type:"primary"},on:{click:function(e){return t.$refs.table.refresh(!0)}}},[t._v("查询")]),a("a-button",{staticStyle:{"margin-left":"8px"},on:{click:function(){return t.queryParam={}}}},[t._v("重置")])],1)])],1)],1)],1),a("s-table",{ref:"table",attrs:{size:"default",rowKey:"key",columns:t.columns,data:t.loadData}})],1)},r=[],o=a("2af9"),s=a("48fb"),l={name:"StatisticsPartner",components:{STable:o["o"]},data:function(){var t=this;return{queryParam:{},columns:[{title:"接线员",dataIndex:"name"},{title:"总接单量",dataIndex:"totalCount"},{title:"已成交单量",dataIndex:"completedCount"},{title:"进行中单量",dataIndex:"ongoingCount"},{title:"未成交单量",dataIndex:"cancelCount"},{title:"接单总金额",dataIndex:"totalCost"},{title:"已成交总金额",dataIndex:"completedCost"},{title:"进行中总金额",dataIndex:"ongoingCost"},{title:"未成交总金额",dataIndex:"cancelCost"}],loadData:function(e){return Object(s["a"])(Object.assign(e,t.queryParam)).then((function(t){return t.result}))}}},methods:{handleOk:function(){this.$refs.table.refresh()},onChange1:function(t,e){this.queryParam.orderDate=e}}},u=l,i=a("2877"),c=Object(i["a"])(u,n,r,!1,null,null,null);e["default"]=c.exports},"48fb":function(t,e,a){"use strict";a.d(e,"b",(function(){return o})),a.d(e,"a",(function(){return s}));var n=a("b775"),r={telephone:"/Statistics/telephone",partner:"/Statistics/partner"};function o(t){return Object(n["b"])({url:r.telephone,method:"get",params:t})}function s(t){return Object(n["b"])({url:r.partner,method:"get",params:t})}}}]);