import{_ as v}from"./StatCard-fd0c943b.js";import{_ as y}from"./ThePaginator-0617ef65.js";import{_ as k,I as x}from"./ClientareaLayout-901333af.js";import{_ as b}from"./Invoice-2d16128b.js";import{_ as w}from"./InputForm-acb6448b.js";import{m as V,h as S,j as N,o as s,k as d,f as o,d as i,t as $,b as n,c,l as f,F as p,u,g as q,n as _,O as B}from"./app-ae25cce0.js";import{d as O,u as j,a as C}from"./switch-3aa42de7.js";import"./IconUser-0a386455.js";import"./use-resolve-button-type-eeb630b5.js";const F={class:"title"},L={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},P={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},U={class:"flex items-center mb-5"},D={key:0,class:"w-full text-center text-gray-400"},I={key:1,class:"grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4"},M={__name:"Show",props:{seller:{type:Object,required:!0},invoices:{type:Object,required:!0},total:{type:[Number,String],required:!0}},setup(r){const m=r,h=V(()=>[{title:"Total",value:m.total.toLocaleString(),icon:x}]),g=new URLSearchParams(window.location.search),t=S({date:g.get("date")??"",trashed:g.get("trashed")==="true"});return N(()=>t,()=>{let l={...t};for(const a in l)l[a]||delete l[a];B.get(route("clientarea.sellers.show",m.seller.id),l,{preserveState:!0,preserveScroll:!0,only:["invoices","total"],replace:!0})},{deep:!0}),(l,a)=>(s(),d(k,{title:"Ventas"},{header:o(()=>[i("span",F,$(r.seller.name),1)]),default:o(()=>[i("div",L,[n(w,{modelValue:t.date,"onUpdate:modelValue":a[0]||(a[0]=e=>t.date=e),text:"Fecha",type:"date"},null,8,["modelValue"])]),i("div",P,[(s(!0),c(p,null,f(h.value,e=>(s(),d(v,{stat:e,key:e.title},null,8,["stat"]))),128))]),n(u(C),null,{default:o(()=>[i("div",U,[n(u(O),{class:"mr-4 text-gray-400"},{default:o(()=>[q("Ver eliminadas")]),_:1}),n(u(j),{modelValue:t.trashed,"onUpdate:modelValue":a[1]||(a[1]=e=>t.trashed=e),class:_([t.trashed?"bg-primary":"bg-gray-200","relative inline-flex h-6 w-11 items-center rounded-full transition-colors"])},{default:o(()=>[i("span",{class:_([t.trashed?"translate-x-6":"translate-x-1","inline-block h-4 w-4 transform rounded-full bg-white transition-transform"])},null,2)]),_:1},8,["modelValue","class"])])]),_:1}),r.invoices.data.length==0?(s(),c("div",D," No hay transacciones ")):(s(),c("div",I,[(s(!0),c(p,null,f(r.invoices.data,e=>(s(),d(b,{invoice:e,key:e.invoice_number},null,8,["invoice"]))),128))])),n(y,{links:r.invoices.meta.links},null,8,["links"])]),_:1}))}};export{M as default};