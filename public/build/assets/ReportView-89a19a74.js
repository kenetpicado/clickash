import{o as t,c as s,b as l,t as a,F as r,l as n}from"./app-0d1166d4.js";const i={class:"text-lg font-bold mb-2"},d={class:"grid grid-cols-4 lg:grid-cols-8 gap-4 text-gray-600"},g={class:"rounded-xl bg-card p-2 flex flex-col items-center justify-center"},_={class:"font-bold"},u={key:1,class:"text-center text-gray-400 mt-4"},h={__name:"ReportView",props:{sales:{type:Object,required:!1}},setup(o){return(m,x)=>o.sales.length>0?(t(),s(r,{key:0},[l("div",i," Total: C$ "+a(o.sales.reduce((e,c)=>e+c.total,0).toLocaleString()),1),l("div",d,[(t(!0),s(r,null,n(o.sales,e=>(t(),s("div",g,[l("div",_,a(e.digit),1),l("small",null," C$ "+a(e.total.toLocaleString()),1)]))),256))])],64)):(t(),s("div",u," No hay registros 😥️ "))}};export{h as _};