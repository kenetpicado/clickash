import{o as t,c as e,d as s,t as a,F as r,l as c}from"./app-c30d065f.js";const i={class:"text-lg font-bold mb-2"},n={class:"grid grid-cols-4 lg:grid-cols-8 gap-4 text-gray-600"},d={class:"rounded-xl bg-card p-2 flex flex-col items-center justify-center"},g={class:"font-bold"},_={key:1,class:"text-center text-gray-400 mt-4"},x={__name:"ReportView",props:{sales:{type:Object,required:!1},total:{type:String,required:!1}},setup(l){return(u,f)=>l.sales.length>0?(t(),e(r,{key:0},[s("div",i," Total: "+a(l.total),1),s("div",n,[(t(!0),e(r,null,c(l.sales,o=>(t(),e("div",d,[s("div",g,a(o.digit),1),s("small",null,a(o.total),1)]))),256))])],64)):(t(),e("div",_," No hay registros 😥️ "))}};export{x as _};