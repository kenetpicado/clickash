import{_ as o}from"./ClientareaLayout-e660f941.js";import{_ as c}from"./Transaction-4bc6b851.js";import{o as r,k as n,f as l,d as e,t as a,c as s,F as u,l as d}from"./app-3eeff63f.js";import"./DropdownItem-86acfc7a.js";import"./createVueComponent-06cc832b.js";import"./IconUser-1b332bbc.js";const m=e("span",{class:"title"}," Detalles ",-1),g={class:"mb-4 text-gray-600 space-y-2"},f={key:0,class:"w-full text-center text-gray-400"},h={key:1,class:"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-4"},v={__name:"Show",props:{transactions:{type:Object,required:!0},total:{type:[String,Number],required:!0},invoice_number:{type:String,required:!0},raffle:{type:String,required:!0},user:{type:String,required:!0}},setup(t){return(y,_)=>(r(),n(o,{title:"Detalles"},{header:l(()=>[m]),default:l(()=>[e("div",g,[e("h2",null,"Recibo: "+a(t.invoice_number),1),e("h2",null,"Rifa: "+a(t.raffle),1),e("h2",null,"Vendedor: "+a(t.user),1),e("h2",null,"Total: C$ "+a(t.total.toLocaleString()),1)]),t.transactions.length==0?(r(),s("div",f," No hay datos que mostrar ")):(r(),s("div",h,[(r(!0),s(u,null,d(t.transactions,i=>(r(),n(c,{transaction:i,key:i.id},null,8,["transaction"]))),128))]))]),_:1}))}};export{v as default};
