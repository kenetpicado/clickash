import{_}from"./StatCard-65b76374.js";import{_ as v}from"./ThePaginator-92770ef5.js";import{_ as y,I as h}from"./ClientareaLayout-6ba07821.js";import{_ as k}from"./Invoice-5bcc077e.js";import{m as w,h as b,j as x,o as t,k as l,f as d,d as n,t as S,b as m,c as i,l as u,F as f,O as V}from"./app-0b1a365b.js";import{_ as $}from"./InputForm-4bef88d5.js";import"./createVueComponent-cad2a883.js";import"./DropdownItem-77132e59.js";import"./IconUser-13c14842.js";const q={class:"title"},B={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},O={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},j={key:0,class:"w-full text-center text-gray-400"},F={key:1,class:"grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4"},T={__name:"Show",props:{raffle:{type:Object,required:!0},invoices:{type:Object,required:!0},total:{type:String,required:!0}},setup(r){const c=r,p=w(()=>[{title:"Total",value:c.total.toLocaleString(),icon:h}]),g=new URLSearchParams(window.location.search),o=b({date:g.get("date")??""});return x(()=>o,()=>{let s={...route().params,...o};for(const a in s)(!s[a]||a=="raffle")&&delete s[a];V.get(route("clientarea.raffles.show",c.raffle.id),s,{preserveState:!0,preserveScroll:!0,only:["invoices","total"],replace:!0})},{deep:!0}),(s,a)=>(t(),l(y,{title:"Rifa"},{header:d(()=>[n("span",q,S(r.raffle.name)+": Recibos ",1)]),default:d(()=>[n("div",B,[m($,{modelValue:o.date,"onUpdate:modelValue":a[0]||(a[0]=e=>o.date=e),text:"Fecha",type:"date"},null,8,["modelValue"])]),n("div",O,[(t(!0),i(f,null,u(p.value,e=>(t(),l(_,{stat:e,key:e.title},null,8,["stat"]))),128))]),r.invoices.data.length==0?(t(),i("div",j," No hay transacciones ")):(t(),i("div",F,[(t(!0),i(f,null,u(r.invoices.data,e=>(t(),l(k,{invoice:e,key:e.invoice_number},null,8,["invoice"]))),128))])),m(v,{links:r.invoices.meta.links},null,8,["links"])]),_:1}))}};export{T as default};