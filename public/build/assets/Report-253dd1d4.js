import{_ as p}from"./InputForm-e71775d0.js";import{_ as f}from"./SelectForm-0bd2086b.js";import{_}from"./ReportView-79aa1a46.js";import{_ as h}from"./ClientareaLayout-73e9e689.js";import{C as y}from"./Carbon-e7b34390.js";import{l as g,g as b,o,j as v,e as n,b as d,t as c,a as u,c as l,h as V,F as k,O as x,u as w}from"./app-ff81f535.js";import"./IconUser-aede0555.js";const O={class:"title"},j={class:"grid grid-cols-2 lg:grid-cols-4 gap-4 text-gray-600"},q={key:0,value:"",selected:""},B={key:1,value:"",selected:""},F=["value"],U={__name:"Report",props:{raffle:{type:Object,required:!0},sales_by_number:{type:Object,required:!0},hours:{type:Object,required:!0}},setup(r){const m=r,i=new URLSearchParams(window.location.search),t=g({hour:i.get("hour")??"",date:i.get("date")??""});return b(()=>t,()=>{let s={...t};for(const e in s)s[e]||delete s[e];x.get(route("clientarea.raffles.reports",m.raffle.id),s,{preserveState:!0,preserveScroll:!0,only:["sales_by_number"],replace:!0})},{deep:!0}),(s,e)=>(o(),v(h,{title:"Reporte"},{header:n(()=>[d("span",O,c(r.raffle.name)+": Reporte de ventas ",1)]),default:n(()=>[d("div",j,[u(p,{modelValue:t.date,"onUpdate:modelValue":e[0]||(e[0]=a=>t.date=a),text:"Fecha",type:"date"},null,8,["modelValue"]),u(f,{modelValue:t.hour,"onUpdate:modelValue":e[1]||(e[1]=a=>t.hour=a),text:"Turno"},{default:n(()=>[r.hours.length>0?(o(),l("option",q,"Turno")):(o(),l("option",B,"No hay turnos")),(o(!0),l(k,null,V(r.hours,a=>(o(),l("option",{value:a},c(w(y).create().setTime(a).getTimeFormat()),9,F))),256))]),_:1},8,["modelValue"])]),u(_,{sales:r.sales_by_number},null,8,["sales"])]),_:1}))}};export{U as default};