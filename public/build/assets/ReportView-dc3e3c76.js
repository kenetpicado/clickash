import{o as t,c as s,b as o,t as l,F as r,k as n}from"./app-c522cbdb.js";const i={class:"text-lg font-bold mb-2"},d={class:"grid grid-cols-4 lg:grid-cols-8 gap-4 text-gray-600"},g={class:"rounded-xl bg-card p-2 flex flex-col items-center justify-center"},_={class:"font-bold"},u={key:1,class:"text-center text-gray-400 mt-4"},h={__name:"ReportView",props:{sales:{type:Object,required:!1}},setup(a){return(m,x)=>a.sales.length>0?(t(),s(r,{key:0},[o("div",i," Total: C$ "+l(a.sales.reduce((e,c)=>e+c.total,0).toLocaleString()),1),o("div",d,[(t(!0),s(r,null,n(a.sales,e=>(t(),s("div",g,[o("div",_,l(e.digit),1),o("small",null," C$ "+l(e.total.toLocaleString()),1)]))),256))])],64)):(t(),s("div",u," No hay registros 😥️ "))}};export{h as _};