import{_ as u,I as _}from"./ClientareaLayout-73e9e689.js";import{_ as g}from"./InputForm-e71775d0.js";import{_ as p}from"./ThePaginator-6b6d9959.js";import{_ as f}from"./Transaction-5595e3a0.js";import{_ as y}from"./StatCard-b273ec58.js";import{l as h,g as k,o as t,j as l,e as d,b as c,a as o,u as x,c as i,F as v,h as w,O as V}from"./app-ff81f535.js";import"./IconUser-aede0555.js";import"./Carbon-e7b34390.js";const $=c("span",{class:"title"}," Transacciones ",-1),b={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},B={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},I={key:0,class:"w-full text-center text-gray-400"},N={key:1,class:"grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4"},U={__name:"Index",props:{transactions:{type:Object,required:!0},daily_transactions:{type:Number,required:!0}},setup(s){const m=new URLSearchParams(window.location.search),r=h({date:m.get("date")??""});return k(()=>r,()=>{let a={...route().params,...r};for(const e in a)a[e]===""&&delete a[e];V.get(route("clientarea.transactions.index"),a,{preserveState:!0,preserveScroll:!0,only:["transactions","daily_transactions"],replace:!0})},{deep:!0}),(a,e)=>(t(),l(u,{title:"Inicio"},{header:d(()=>[$]),default:d(()=>[c("div",b,[o(g,{modelValue:r.date,"onUpdate:modelValue":e[0]||(e[0]=n=>r.date=n),text:"Fecha",type:"date"},null,8,["modelValue"])]),c("div",B,[o(y,{stat:{title:"Ventas del dia",value:"C$ "+s.daily_transactions.toLocaleString(),icon:x(_)}},null,8,["stat"])]),s.transactions.data.length==0?(t(),i("div",I," No hay transacciones ")):(t(),i("div",N,[(t(!0),i(v,null,w(s.transactions.data,n=>(t(),l(f,{transaction:n,key:n.id},null,8,["transaction"]))),128))])),o(p,{links:s.transactions.links},null,8,["links"])]),_:1}))}};export{U as default};