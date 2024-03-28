import{_ as V}from"./InputForm-b3d4eebc.js";import{_ as p}from"./SelectForm-a3d3b0fe.js";import{_ as y}from"./ReportView-a77a1cfe.js";import{_ as x}from"./ClientareaLayout-cae29f17.js";import{h as b,p as k,j as R,o as l,k as _,f as s,d as i,t as u,b as m,c as d,l as g,F as h,e as q,O as w}from"./app-b9c931a0.js";import"./DropdownItem-b62aa329.js";import"./createVueComponent-5a0326f8.js";import"./useAuth-6ae4d293.js";import"./toast-a35b6174.js";import"./IconUser-5bef4d49.js";const N={class:"title"},O={class:"grid grid-cols-2 lg:grid-cols-4 gap-4 text-gray-600"},S=i("option",{value:"",selected:""},"Ninguna",-1),j=["value"],B=i("option",{value:"",selected:""},"Ninguno",-1),U=["value"],G={__name:"Report",props:{seller:{type:Object,required:!0},raffles:{type:Object,required:!0},sales:{type:Object,required:!0},total:{type:String,required:!0}},setup(o){const c=o,n=new URLSearchParams(window.location.search),t=b({raffle_id:n.get("raffle_id")??"",hour:n.get("hour")??"",date:n.get("date")??""}),v=k(()=>c.raffles.find(r=>r.id==t.raffle_id));return R(()=>t,()=>{let r={...t};for(const a in r)r[a]||delete r[a];w.get(route("clientarea.sellers.reports.index",c.seller.id),r,{preserveState:!0,preserveScroll:!0,only:["sales","total"],replace:!0})},{deep:!0,immediate:!0}),(r,a)=>(l(),_(x,{title:"Reportes"},{header:s(()=>[i("span",N,u(o.seller.name)+": Reporte de ventas ",1)]),default:s(()=>[i("div",O,[m(p,{modelValue:t.raffle_id,"onUpdate:modelValue":a[0]||(a[0]=e=>t.raffle_id=e),text:"Rifa",class:"mb-0"},{default:s(()=>[S,(l(!0),d(h,null,g(o.raffles,e=>(l(),d("option",{value:e.id},u(e.name),9,j))),256))]),_:1},8,["modelValue"]),t.raffle_id?(l(),_(p,{key:0,modelValue:t.hour,"onUpdate:modelValue":a[1]||(a[1]=e=>t.hour=e),text:"Turno",class:"mb-0"},{default:s(()=>{var e;return[B,(l(!0),d(h,null,g((e=v.value)==null?void 0:e.hours,f=>(l(),d("option",{value:f},u(f),9,U))),256))]}),_:1},8,["modelValue"])):q("",!0),m(V,{modelValue:t.date,"onUpdate:modelValue":a[2]||(a[2]=e=>t.date=e),text:"Fecha",type:"date"},null,8,["modelValue"])]),m(y,{sales:o.sales,total:o.total},null,8,["sales","total"])]),_:1}))}};export{G as default};