import{I as t,_ as i}from"./AppLayout-88627344.js";import{_ as u}from"./StatCard-ff964a6a.js";import{o as r,e as _,f as a,b as o,c as d,h as m,F as p,a as f}from"./app-fc7d5a4b.js";import"./createVueComponent-3215f9e0.js";import"./IconChevronRight-e06cb0eb.js";const h=o("span",{class:"title"}," Overview ",-1),b={class:"grid grid-cols-4 gap-4"},I={__name:"Index",props:{users_count:{type:Number,default:0},sellers_count:{type:Number,default:0}},setup(n){const e=n,c=[{name:"Home",route:route("dashboard.users.index")}],l=[{value:e.users_count,title:"Users",icon:t},{value:e.sellers_count,title:"Sellers",icon:t}];return(v,x)=>(r(),_(i,{title:"Users",breads:c},{header:a(()=>[h]),default:a(()=>[o("div",b,[(r(),d(p,null,m(l,s=>f(u,{stat:s,key:s.name},null,8,["stat"])),64))])]),_:1}))}};export{I as default};