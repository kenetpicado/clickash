import{_ as p}from"./InputForm-981d530e.js";import{_ as f}from"./SelectForm-84610b4a.js";import{T as g}from"./TableSection-ca8a93d6.js";import{_ as y}from"./ClientareaLayout-3aa7a5ac.js";import{C as b}from"./Carbon-e7b34390.js";import{l as v,g as V,o,j as x,e as n,b as a,a as d,c as r,h as m,F as _,d as S,O as k,t as i,u as T}from"./app-c128e984.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./IconUser-b8250f54.js";const w=a("span",{class:"title"}," Reporte de ventas ",-1),C={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},N={key:0,value:"",selected:""},O={key:1,value:"",selected:""},j=["value"],q=a("th",null,"Dígito",-1),B=a("th",null,"Total",-1),F={key:0},R=a("td",{colspan:"2",class:"text-center"},"No hay datos",-1),$=[R],H={__name:"Report",props:{raffle:{type:Object,required:!0},sales_by_number:{type:Object,required:!0},hours:{type:Object,required:!0}},setup(l){const h=l,e=v({hour:"",date:""}),u=new URLSearchParams(window.location.search);return u.get("hour")&&(e.hour=u.get("hour")),u.get("date")&&(e.date=u.get("date")),V(()=>[e.hour,e.date],([c,s])=>{c||delete e.hour,s||delete e.date,k.get(route("clientarea.raffles.reports",h.raffle.id),e,{preserveState:!0,preserveScroll:!0,only:["sales_by_number"]})}),(c,s)=>(o(),x(y,{title:"Reporte"},{header:n(()=>[w]),default:n(()=>[a("div",C,[d(p,{modelValue:e.date,"onUpdate:modelValue":s[0]||(s[0]=t=>e.date=t),text:"Fecha",type:"date"},null,8,["modelValue"]),d(f,{modelValue:e.hour,"onUpdate:modelValue":s[1]||(s[1]=t=>e.hour=t),text:"Turno"},{default:n(()=>[l.hours.length>0?(o(),r("option",N,"Seleccione un turno")):(o(),r("option",O,"No hay turnos")),(o(!0),r(_,null,m(l.hours,t=>(o(),r("option",{value:t},i(T(b).create().setTime(t).getTimeFormat()),9,j))),256))]),_:1},8,["modelValue"])]),d(g,null,{header:n(()=>[q,B]),body:n(()=>[(o(!0),r(_,null,m(l.sales_by_number,t=>(o(),r("tr",null,[a("td",null,i(t.digit),1),a("td",null," C$"+i(t.total.toLocaleString()),1)]))),256)),l.sales_by_number.length==0?(o(),r("tr",F,$)):S("",!0)]),_:1})]),_:1}))}};export{H as default};