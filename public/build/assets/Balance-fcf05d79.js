import{_}from"./InputForm-637bf0b5.js";import{_ as g}from"./StatCard-4f243138.js";import{_ as f}from"./ClientareaLayout-de6aa682.js";import{C as b}from"./Carbon-e7b34390.js";import{B as h,e as y,l as B,o as t,k as d,g as m,b as o,a as v,c as s,t as S,u as k,f as x,F as C,O as $}from"./app-5deccacc.js";import{I as l}from"./IconCurrencyDollar-13527179.js";import"./createVueComponent-7151f76d.js";const w=o("span",{class:"title"}," Balance ",-1),L={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 text-gray-600"},V={key:0,class:"mb-4"},I={key:1,class:"mb-4"},O={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},j={__name:"Balance",props:{balance:{type:Object,required:!0},seller:{type:Object,required:!0}},setup(u){const a=u,e=h({date:""}),c=new URLSearchParams(window.location.search);c.get("date")&&(e.date=c.get("date")),y(()=>[e.date],([n])=>{n||delete e.date,$.get(route("clientarea.sellers.balance",a.seller.id),e,{preserveState:!0,preserveScroll:!0,only:["balance"]})});const p=B(()=>[{title:"Ingresos",value:"C$"+a.balance.income.toLocaleString(),icon:l},{title:"Egresos",value:"C$"+a.balance.expenditure.toLocaleString(),icon:l},{title:"Balance",value:"C$"+(a.balance.income-a.balance.expenditure).toLocaleString(),icon:l}]);return(n,i)=>(t(),d(f,{title:"Balance"},{header:m(()=>[w]),default:m(()=>[o("div",L,[v(_,{modelValue:e.date,"onUpdate:modelValue":i[0]||(i[0]=r=>e.date=r),text:"Fecha",type:"date"},null,8,["modelValue"])]),e.date?(t(),s("h2",I,"Balance del DIA "+S(k(b).create(e.date).format("d/m/Y")),1)):(t(),s("h2",V,"Balance de la SEMANA en curso")),o("div",O,[(t(!0),s(C,null,x(p.value,r=>(t(),d(g,{stat:r,key:r.title},null,8,["stat"]))),128))])]),_:1}))}};export{j as default};
