import{_ as o}from"./ClientareaLayout-2a59cfe4.js";import{_ as c}from"./Transaction-0433e34e.js";import{o as r,j as i,e as l,b as t,t as a,c as s,F as u,k as d}from"./app-c522cbdb.js";import"./IconUser-2e22d4e3.js";import"./Carbon-d935ed77.js";const m=t("span",{class:"title"}," Detalles ",-1),g={class:"mb-4 text-gray-600 bg-card p-3 rounded-xl"},f={key:0,class:"w-full text-center text-gray-400"},h={key:1,class:"grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4"},q={__name:"Show",props:{transactions:{type:Object,required:!0},total:{type:[String,Number],required:!0},invoice_number:{type:String,required:!0},raffle:{type:String,required:!0},user:{type:String,required:!0}},setup(e){return(_,y)=>(r(),i(o,{title:"Detalles"},{header:l(()=>[m]),default:l(()=>[t("div",g,[t("h2",null,"Recibo: "+a(e.invoice_number),1),t("h2",null,"Rifa: "+a(e.raffle),1),t("h2",null,"Vendedor: "+a(e.user),1),t("h2",null,"Total: C$ "+a(e.total.toLocaleString()),1)]),e.transactions.length==0?(r(),s("div",f," No hay datos que mostrar ")):(r(),s("div",h,[(r(!0),s(u,null,d(e.transactions,n=>(r(),i(c,{transaction:n,key:n.id},null,8,["transaction"]))),128))]))]),_:1}))}};export{q as default};