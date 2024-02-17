import{_ as w,a as j}from"./Dropdown-38dc4f7b.js";import{_ as x}from"./InputForm-5a4e93ad.js";import{_ as q}from"./SelectForm-afbc3c4d.js";import{_ as B}from"./FormModal-ef51eef5.js";import{_ as A}from"./ClientareaLayout-b8c18104.js";import{C as v}from"./Carbon-d935ed77.js";import{I as $,c as I}from"./helpers-8775c1a5.js";import{t as b}from"./toast-c646ff4c.js";import{l as S,T as U,m as M,j as z,o as a,g as T,e as p,b as o,c as i,F as h,k as g,t as u,a as d,u as l,d as H,O as L}from"./app-37ee622e.js";import{I as G}from"./IconEdit-6e1b140e.js";import"./IconUser-46d1c8b9.js";import"./use-resolve-button-type-df376edb.js";import"./IconList-f1371340.js";const J=o("span",{class:"title"}," Horario ",-1),K={key:0,class:"w-full text-center text-gray-400"},P={key:1,class:"grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4"},Q={class:"bg-card p-4 rounded-xl text-gray-600"},R={class:"flex justify-between items-center mb-2"},W={class:"px-1 py-1"},X={class:"grid grid-cols-2 gap-2 mb-4"},Y=o("strong",{class:"text-sm"},"Hora de inicio",-1),Z=o("strong",{class:"text-sm"},"Hora de fin",-1),ee=o("h2",{class:"font-semibold mb-2 text-sm"},"Sorteos",-1),te={class:"flex items-center gap-3 overflow-x-auto hide-scrollbar text-sm"},oe={class:"inline-flex items-center bg-white px-2 py-1 rounded-xl whitespace-nowrap"},re={key:0,value:"",disabled:"",selected:""},se={key:1,value:"",disabled:"",selected:""},ae=["value"],le={class:"grid grid-cols-2 gap-2"},ie={key:1,class:"text-sm text-primary mt-1"},ne=o("div",{class:"mt-4 mb-2"}," Sorteos ",-1),de={class:"grid grid-cols-2 lg:grid-cols-3 gap-2"},ue={class:"border px-2 py-1 rounded-xl flex items-center justify-between"},ce={role:"button"},we={__name:"Availability",props:{availability:{type:Object,required:!0},raffle:{type:Object,required:!0}},setup(y){const c=y,_=S(!1),f=S(!0),n=S(null),t=U({id:null,order:null,day:null,start_time:"07:00:00",end_time:"21:00:00",raffle_id:c.raffle.id,blocked_hours:["11:00:00","15:00:00","21:00:00"]}),V=[{order:0,name:"Domingo"},{order:1,name:"Lunes"},{order:2,name:"Martes"},{order:3,name:"Miercoles"},{order:4,name:"Jueves"},{order:5,name:"Viernes"},{order:6,name:"Sabado"}],C=M(()=>{let r=[];return V.forEach(s=>{c.availability.find(e=>e.day==s.name)||r.push(s)}),r});z(()=>t.order,r=>{r&&(t.day=V.find(s=>s.order==r).name)});const k=()=>{t.reset(),f.value=!0,_.value=!1,n.value=null},D=r=>{t.id=r.id,t.start_time=r.start_time,t.end_time=r.end_time,t.blocked_hours=r.blocked_hours,f.value=!1,_.value=!0},E=()=>{if(!n.value){b.error("Debe seleccionar una hora");return}n.value&&(t.blocked_hours.find(r=>r==n.value+":00")||t.blocked_hours.push(n.value+":00"),n.value=null)},N=()=>{f.value?t.post(route("clientarea.raffles.availability.store",c.raffle.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{k(),b.success("Guardado correctamente")}}):t.put(route("clientarea.raffles.availability.update",[c.raffle.id,t.id]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{k(),b.success("Actualizado correctamente")}})},F=r=>{t.blocked_hours.splice(r,1)},O=r=>{I({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{L.delete(route("clientarea.raffles.availability.destroy",[c.raffle.id,r]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{b.success("Eliminado correctamente")}})}})};return(r,s)=>(a(),T(A,{title:"Horario"},{header:p(()=>[J,o("button",{type:"button",class:"simple-button",onClick:s[0]||(s[0]=e=>_.value=!0)}," Nuevo ")]),default:p(()=>[y.availability.length==0?(a(),i("div",K," No hay horario ")):(a(),i("div",P,[(a(!0),i(h,null,g(y.availability,e=>(a(),i("div",Q,[o("div",R,[o("span",null,u(e.day),1),d(j,null,{default:p(()=>[o("div",W,[d(w,{onClick:m=>D(e),title:"Editar",icon:l(G)},null,8,["onClick","icon"]),d(w,{onClick:m=>O(e.id),title:"Eliminar",icon:l($)},null,8,["onClick","icon"])])]),_:2},1024)]),o("div",X,[o("div",null,[Y,o("div",null,u(l(v).create().setTime(e.start_time).getTimeFormat()),1)]),o("div",null,[Z,o("div",null,u(l(v).create().setTime(e.end_time).getTimeFormat()),1)])]),ee,o("div",te,[(a(!0),i(h,null,g(e.blocked_hours,m=>(a(),i("div",oe,u(l(v).create().setTime(m).getTimeFormat()),1))),256))])]))),256))])),d(B,{show:_.value,title:"Horario",onOnCancel:k,onOnSubmit:N},{default:p(()=>[f.value?(a(),T(q,{key:0,modelValue:l(t).order,"onUpdate:modelValue":s[1]||(s[1]=e=>l(t).order=e),text:"Dia",required:""},{default:p(()=>[C.value.length>0?(a(),i("option",re,"Seleccione un dia")):(a(),i("option",se,"No hay dias disponibles")),(a(!0),i(h,null,g(C.value,e=>(a(),i("option",{value:e.order},u(e.name),9,ae))),256))]),_:1},8,["modelValue"])):H("",!0),o("div",le,[d(x,{text:"Hora incio",modelValue:l(t).start_time,"onUpdate:modelValue":s[2]||(s[2]=e=>l(t).start_time=e),type:"time",required:""},null,8,["modelValue"]),d(x,{text:"Hora fin",modelValue:l(t).end_time,"onUpdate:modelValue":s[3]||(s[3]=e=>l(t).end_time=e),type:"time",required:""},null,8,["modelValue"])]),d(x,{modelValue:n.value,"onUpdate:modelValue":s[4]||(s[4]=e=>n.value=e),type:"time",text:"Sorteo"},null,8,["modelValue"]),o("button",{type:"button",class:"primary-button",onClick:E}," Agregar "),r.$page.props.errors.blocked_hours?(a(),i("p",ie,u(r.$page.props.errors.blocked_hours),1)):H("",!0),ne,o("div",de,[(a(!0),i(h,null,g(l(t).blocked_hours,(e,m)=>(a(),i("div",ue,[o("span",null,u(l(v).create().setTime(e).getTimeFormat()),1),o("span",ce,[d(l($),{size:"18",onClick:me=>F(m)},null,8,["onClick"])])]))),256))])]),_:1},8,["show"])]),_:1}))}};export{we as default};
