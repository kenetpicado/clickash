import{_ as p}from"./StatCard-b21159fd.js";import{_ as y}from"./ThePaginator-fedba429.js";import{_ as h,I as k}from"./ClientareaLayout-f9250a00.js";import{_ as v}from"./Transaction-88a84ede.js";import{k as w,l as x,g as S,o as e,j as i,e as d,b as l,t as b,a as u,c as o,h as m,F as f,O as V}from"./app-dfedfc23.js";import{_ as $}from"./InputForm-34f7df9d.js";import"./IconUser-8b5c3636.js";import"./Carbon-e7b34390.js";const q={class:"title"},B={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},N={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},O={key:0,class:"w-full text-center text-gray-400"},j={key:1,class:"grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"},E={__name:"Show",props:{raffle:{type:Object,required:!0},transactions:{type:Object,required:!0},daily_transactions:{type:[Number,String],required:!0}},setup(r){const c=r,g=w(()=>[{title:"Ventas del dia",value:"C$"+c.daily_transactions.toLocaleString(),icon:k}]),_=new URLSearchParams(window.location.search),n=x({date:_.get("date")??""});return S(()=>n,()=>{let s={...route().params,...n};for(const a in s)(!s[a]||a=="raffle")&&delete s[a];V.get(route("clientarea.raffles.show",c.raffle.id),s,{preserveState:!0,preserveScroll:!0,only:["transactions","daily_transactions"]})},{deep:!0}),(s,a)=>(e(),i(h,{title:"Rifa"},{header:d(()=>[l("span",q,b(r.raffle.name),1)]),default:d(()=>[l("div",B,[u($,{modelValue:n.date,"onUpdate:modelValue":a[0]||(a[0]=t=>n.date=t),text:"Fecha",type:"date"},null,8,["modelValue"])]),l("div",N,[(e(!0),o(f,null,m(g.value,t=>(e(),i(p,{stat:t,key:t.title},null,8,["stat"]))),128))]),r.transactions.data.length==0?(e(),o("div",O," No hay transacciones ")):(e(),o("div",j,[(e(!0),o(f,null,m(r.transactions.data,t=>(e(),i(v,{transaction:t,key:t.id},null,8,["transaction"]))),128))])),u(y,{links:r.transactions.links},null,8,["links"])]),_:1}))}};export{E as default};
