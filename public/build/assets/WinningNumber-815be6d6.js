import{_ as p}from"./StatCard-ca032027.js";import{_ as g}from"./Transaction-044e71d0.js";import{_}from"./ClientareaLayout-2355c935.js";import{C as f}from"./Carbon-e7b34390.js";import{c as b}from"./createVueComponent-4db92639.js";import{l as k,o as e,k as o,g as c,b as a,c as r,f as l,F as u}from"./app-820371dd.js";var h=b("check","IconCheck",[["path",{d:"M5 12l5 5l10 -10",key:"svg-0"}]]);const y=a("span",{class:"title"}," Ganadores ",-1),v={class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},w={key:0,class:"w-full text-center text-gray-400"},C={key:1,class:"grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"},j={__name:"WinningNumber",props:{winning_numbers:{type:Object,required:!0},winners:{type:Object,required:!0}},setup(s){const m=s,d=k(()=>m.winning_numbers.map(n=>({title:"Turno: "+f.create().setTime(n.hour).getTimeFormat(),value:"Dígito: "+n.number,icon:h})));return(n,i)=>(e(),o(_,{title:"Ganadores"},{header:c(()=>[y,a("button",{type:"button",class:"simple-button",onClick:i[0]||(i[0]=t=>n.openModal=!0)}," Nuevo ")]),default:c(()=>[a("div",v,[(e(!0),r(u,null,l(d.value,t=>(e(),o(p,{stat:t,key:t.title},null,8,["stat"]))),128))]),s.winners.length==0?(e(),r("div",w," No hay transacciones ")):(e(),r("div",C,[(e(!0),r(u,null,l(s.winners,t=>(e(),o(g,{transaction:t,key:t.id},null,8,["transaction"]))),128))]))]),_:1}))}};export{j as default};