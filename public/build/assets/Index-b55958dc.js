import{_ as m}from"./ClientareaLayout-b9cd9644.js";import{o as t,c as a,F as n,l as c,g as p,e as d,b as l,t as i,u as g,i as f,m as h,k as x,a as _,O as y}from"./app-7a9802b8.js";import{_ as k}from"./InputForm-3474cb00.js";import"./IconUser-cedad579.js";const v={class:"grid grid-cols-2 lg:grid-cols-4 gap-4"},b={class:"mb-1 font-medium"},V={class:"text-xs flex flex-col gap-1"},$={key:0,class:"text-gray-400"},w={__name:"ResultTab",props:{results:{type:Object,required:!0}},setup(o){return(s,r)=>(t(),a("div",v,[(t(!0),a(n,null,c(o.results,e=>(t(),p(g(f),{href:s.route("clientarea.results.show",e.id),class:"bg-card rounded-xl p-2 w-full text-gray-600"},{default:d(()=>[l("div",b,i(e.name),1),l("div",V,[e.results.length==0?(t(),a("span",$," No hay resultados 😥️ ")):(t(!0),a(n,{key:1},c(e.results,u=>(t(),a("div",null,i(u),1))),256))])]),_:2},1032,["href"]))),256))]))}},B=l("span",{class:"title"}," Resultados ",-1),O={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},j={__name:"Index",props:{results:{type:Object,required:!0}},setup(o){const s=h({date:""});return x(()=>s,()=>{let r={...s};for(const e in r)r[e]||delete r[e];y.get(route("clientarea.results.index"),r,{preserveState:!0,only:["results"],replace:!0})},{deep:!0}),(r,e)=>(t(),p(m,{title:"Resultados"},{header:d(()=>[B]),default:d(()=>[l("div",O,[_(k,{modelValue:s.date,"onUpdate:modelValue":e[0]||(e[0]=u=>s.date=u),text:"Fecha",type:"date"},null,8,["modelValue"])]),_(w,{results:o.results},null,8,["results"])]),_:1}))}};export{j as default};
