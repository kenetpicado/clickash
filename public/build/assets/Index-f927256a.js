import{_ as p}from"./ClientareaLayout-60ab41ff.js";import{o as s,c as l,F as u,l as c,k as _,f as d,d as n,t as m,n as f,u as y,i as h,e as x,h as b,j as v,b as g,O as k}from"./app-7036221c.js";import{_ as w}from"./InputForm-81d54900.js";import"./DropdownItem-236e3c27.js";import"./IconUser-057cecd7.js";const V={key:0,class:"grid grid-cols-2 lg:grid-cols-4 gap-4"},B={class:"mb-1 font-medium"},$={class:"grid grid-cols-1 gap-2"},C={key:1},N=n("div",{class:"w-full text-center text-gray-400"}," No hay resultados ",-1),O=[N],j={__name:"ResultTab",props:{results:{type:Object,required:!0}},setup(o){function r(e){return e.includes("11:")?"bg-cyan-600":e.includes("9:")?"bg-indigo-600":e.includes("6:")?"bg-emerald-600":e.includes("3:")?"bg-amber-600":"bg-rose-600"}return(e,a)=>o.results.some(t=>t.results.length>0)?(s(),l("div",V,[(s(!0),l(u,null,c(o.results,t=>(s(),l(u,null,[t.results.length>0?(s(),_(y(h),{key:0,href:e.route("clientarea.results.show",t.id),class:"bg-gray-100 rounded-xl p-3 w-full text-gray-600"},{default:d(()=>[n("div",B,m(t.name),1),n("div",$,[(s(!0),l(u,null,c(t.results,i=>(s(),l("div",{class:f(["text-sm text-white text-center rounded-xl py-1 px-0.5",r(i)])},m(i),3))),256))])]),_:2},1032,["href"])):x("",!0)],64))),256))])):(s(),l("div",C,O))}},q=n("span",{class:"title"}," Resultados ",-1),F={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},I={__name:"Index",props:{results:{type:Object,required:!0}},setup(o){const r=b({date:""});return v(()=>r,()=>{let e={...r};for(const a in e)e[a]||delete e[a];k.get(route("clientarea.results.index"),e,{preserveState:!0,only:["results"],replace:!0})},{deep:!0}),(e,a)=>(s(),_(p,{title:"Resultados"},{header:d(()=>[q]),default:d(()=>[n("div",F,[g(w,{modelValue:r.date,"onUpdate:modelValue":a[0]||(a[0]=t=>r.date=t),text:"Fecha",type:"date"},null,8,["modelValue"])]),g(j,{results:o.results},null,8,["results"])]),_:1}))}};export{I as default};
