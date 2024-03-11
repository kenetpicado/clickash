import{I as l}from"./helpers-aa058c0e.js";import{o as s,c as i,d as e,t as n,b as c,u as _,g as o,e as r,k as u,f as m,q as g}from"./app-c30d065f.js";const h={class:"bg-card p-3 rounded-xl text-gray-600"},x={class:"flex justify-between items-center mb-2"},v={class:"text-xl font-bold"},y={class:"grid grid-cols-1 gap-2"},f={key:0},b=e("small",null,"Limite general de ventas:",-1),p=e("br",null,null,-1),k={key:1},$=e("small",null,"Limite individual de ventas:",-1),B=e("br",null,null,-1),E={__name:"BlockedNumber",props:{digit:{type:Object,required:!0}},emits:["destroy"],setup(t){return(d,a)=>(s(),i("div",h,[e("div",x,[e("span",v,n(t.digit.number),1),c(_(l),{class:"text-primary",size:"20",onClick:a[0]||(a[0]=A=>d.$emit("destroy",t.digit.id)),role:"button"})]),e("div",y,[t.digit.settings.general_limit?(s(),i("div",f,[b,p,o(" C$ "+n(t.digit.settings.general_limit),1)])):r("",!0),t.digit.settings.individual_limit?(s(),i("div",k,[$,B,o(" C$ "+n(t.digit.settings.individual_limit),1)])):r("",!0)])]))}};const C={key:0,class:"bg-red-100 px-3 py-3 my-2 rounded-md text-xs flex items-center mx-auto"},N=e("svg",{viewBox:"0 0 24 24",class:"text-red-400 w-4 h-4 mr-2"},[e("path",{fill:"currentColor",d:"M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"})],-1),w={class:"text-red-800"},M={__name:"Error",props:{message:{type:String,required:!1}},setup(t){return(d,a)=>(s(),u(g,null,{default:m(()=>[t.message?(s(),i("div",C,[N,e("span",w,n(t.message),1)])):r("",!0)]),_:1}))}};export{E as _,M as a};
