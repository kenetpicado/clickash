import{T as m}from"./TableSection-ff8fb781.js";import{_}from"./ThePaginator-0c371bd1.js";import{_ as h}from"./AppLayout-142a13e5.js";import{C as l}from"./Carbon-e7b34390.js";import{o,e as p,f as r,b as e,t,a as i,c as n,h as f,u as c,F as b,d as g}from"./app-8e3fa869.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./createVueComponent-154e72e1.js";import"./IconChevronRight-dcb3cb89.js";const y={class:"title"},k=e("th",null,"Rifa",-1),x=e("th",null,"Turno",-1),V=e("th",null,"Monto",-1),w=e("th",null,"Numero",-1),C=e("th",null,"Fecha",-1),N={class:"badge-primary whitespace-nowrap"},T={class:"badge-primary"},B={key:0},F=e("td",{colspan:"4",class:"text-center"},"No hay datos",-1),S=[F],Y={__name:"Show",props:{seller:{type:Object,required:!0},transactions:{type:Object,required:!0}},setup(a){const d=a,u=[{name:"Inicio",route:route("clientarea.index")},{name:"Vendedores",route:route("clientarea.sellers.index")},{name:"Ver",route:route("clientarea.sellers.show",d.seller.id)}];return($,j)=>(o(),p(h,{title:"Vendedor",breads:u},{header:r(()=>[e("span",y,t(a.seller.name),1)]),default:r(()=>[i(m,null,{header:r(()=>[k,x,V,w,C]),body:r(()=>[(o(!0),n(b,null,f(a.transactions.data,s=>(o(),n("tr",null,[e("td",null,t(s.raffle.name),1),e("td",null,[e("span",N,t(c(l).create().setTime(s.hour).getTimeFormat()),1)]),e("td",null," C$"+t(s.amount),1),e("td",null,[e("span",T,t(s.digit),1)]),e("td",null,t(c(l).create(s.created_at).format("d/m/Y")),1)]))),256)),a.transactions.data.length==0?(o(),n("tr",B,S)):g("",!0)]),paginator:r(()=>[i(_,{links:a.transactions.links},null,8,["links"])]),_:1})]),_:1}))}};export{Y as default};
