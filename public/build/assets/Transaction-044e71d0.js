import{C as o}from"./Carbon-e7b34390.js";import{o as e,c as s,b as a,t as n,u as r,d as c}from"./app-820371dd.js";const i={class:"bg-card p-3 rounded-xl"},l={class:"flex items-center justify-between text-sm mb-2"},m={class:"text-gray-400"},u={class:"text-primary"},d={key:0,class:"block text-sm text-gray-600 mb-2"},g={class:"text-gray-600 grid grid-cols-2 gap-1 text-sm"},x={key:0},C={__name:"Transaction",props:{transaction:{type:Object,required:!0}},setup(t){return(f,h)=>(e(),s("div",i,[a("div",l,[a("span",m,n(r(o).create(t.transaction.created_at).format("d/m/Y H:i")),1),a("span",u,n(t.transaction.status),1)]),t.transaction.user?(e(),s("span",d,n(t.transaction.user.name),1)):c("",!0),a("div",g,[t.transaction.raffle?(e(),s("span",x," Rifa: "+n(t.transaction.raffle.name),1)):c("",!0),a("span",null,"Hora: "+n(r(o).create().setTime(t.transaction.hour).getTimeFormat()),1),a("span",null,"Digito: "+n(t.transaction.digit),1),a("span",null,"Super X: "+n(t.transaction.super_x?"Si":"No"),1),a("span",null,"Monto: C$"+n(t.transaction.super_x?t.transaction.amount/2:t.transaction.amount),1),a("strong",null,"Total: C$"+n(t.transaction.amount.toLocaleString()),1),a("strong",null,"Premio: C$"+n(t.transaction.prize.toLocaleString()),1)])]))}};export{C as _};
