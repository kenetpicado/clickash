import{j as a,o as n,c as r,b as k,a as v,u as g,d as l,F as m,h,n as f,t as b,O as y}from"./app-7c5cc7f0.js";import{c as C}from"./createVueComponent-565fb9f0.js";import{I as x}from"./IconChevronRight-245883ec.js";var _=C("chevron-left","IconChevronLeft",[["path",{d:"M15 6l-6 6l6 6",key:"svg-0"}]]);const I={key:0,class:"w-full py-2 px-4 mb-4"},L={class:"flex justify-end items-center gap-2"},V=["onClick"],S={__name:"ThePaginator",props:{links:{type:Object,required:!1}},setup(u){const t=u,i=a(()=>t.links[0].url),c=a(()=>t.links[t.links.length-1].url),p=a(()=>t.links.slice(1,t.links.length-1));function o(d){y.get(d,{},{preserveState:!0,preserveScroll:!0})}return(d,s)=>u.links&&p.value.length>1?(n(),r("div",I,[k("div",L,[i.value?(n(),r("span",{key:0,onClick:s[0]||(s[0]=e=>o(i.value)),class:"px-3 hover:bg-gray-100 rounded-md",role:"button"},[v(g(_))])):l("",!0),(n(!0),r(m,null,h(p.value,e=>(n(),r("span",{onClick:j=>o(e.url),class:f(["px-3 rounded-md",{"bg-indigo-600 text-white":e.active,"hover:bg-indigo-50":!e.active}]),role:"button"},b(e.label),11,V))),256)),c.value?(n(),r("button",{key:1,onClick:s[1]||(s[1]=e=>o(c.value)),class:"px-3 hover:bg-gray-100 rounded-md",type:"button"},[v(g(x))])):l("",!0)])])):l("",!0)}};export{S as _};